@extends('masterpage') @section('content')
<!-- Custom column filtering -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">لیست حلقه ها</h3>

        <div class="panel-options">
            <a href="#" data-toggle="panel">
                <span class="collapse-icon">&ndash;</span>
                <span class="expand-icon">+</span>
            </a>
            <a href="#" data-toggle="remove">
                &times;
            </a>
        </div>
    </div>
    <div class="panel-body">

        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                $("#example-3").dataTable().yadcf([{
                        column_number: 0
                    },
                    {
                        column_number: 1,
                        filter_type: 'text'
                    },
                    {column_number : 2,filter_type:'text'},

                ]);
            });
        </script>

        <table class="table table-striped table-bordered" id="example-3">
            <thead>
                <tr class="replace-inputs">
                    <th>شناسه حلقه</th>
                    <th>نام حلقه</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($halghes as $halge)
                <tr>
                    <td>{{$halge->id}}</td>
                    <td>{{$halge->name}}</td>
                    <td>
                            <a href="#" class="btn btn-secondary btn-sm btn-icon icon-left">
                                ویرایش
                            </a>
    
                            <a href="#" class="btn btn-danger btn-sm btn-icon icon-left">
                                حدف
                            </a>
                        </td>
                </tr>
                @endforeach



            </tbody>
            <tfoot>
                <tr>
                    <th>شناسه حلقه</th>
                    <th>نام حلقه</th>
                    <th>عملیات</th>
                </tr>
            </tfoot>
        </table>

    </div>
</div>


<!-- Imported styles on this page -->
<link rel="stylesheet" href="assets/js/datatables/dataTables.bootstrap.css">

<!-- Bottom Scripts -->
<script src="assets/js/datatables/js/jquery.dataTables.min.js"></script>


<!-- Imported scripts on this page -->
<script src="assets/js/datatables/dataTables.bootstrap.js"></script>
<script src="assets/js/datatables/yadcf/jquery.dataTables.yadcf.js"></script>
<script src="assets/js/datatables/tabletools/dataTables.tableTools.min.js"></script>


<!-- JavaScripts initializations and stuff -->
<script src="assets/js/xenon-custom.js"></script>

@endsection