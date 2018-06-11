<?php
namespace App;

use Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 *
 * @package App
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
*/
class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

   // protected $fillable = ['name', 'email', 'password', 'remember_token'];
    protected $guarded=[];
    
    /**
     * Hash password
     * @param $input
     */
    public function setPasswordAttribute($input)
    {
        if ($input)
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
    }
    

    public function halghe()
    {
        # این کد اشتباه است.بعدا درستش کن
       // return $this->belongsToMany('App\Halghe','halghe_user','halghe_id','user_id');
       return $this->belongsToMany(Halghe::class);
    }
    
    public function dore(){
        return $this->belongsTo(Dore::class);
    }

    public function userSemat(User $user)
    {
        $semat='';
        $roles= $user->roles()->pluck('display_name');
        foreach($roles as $role){
           $semat.=  $role .' ، ';
        }
		return $semat;						
    }
 
    
    
}
