<script type="text/javascript">
            $(document).ready(function() {

              $('#records').DataTable( {
                    "language": {
                        "sEmptyTable":     "هیچ داده ای در جدول وجود ندارد",
                        "sInfo":           "نمایش _START_ تا _END_ از _TOTAL_ رکورد",
                        "sInfoEmpty":      "نمایش 0 تا 0 از 0 رکورد",
                        "sInfoFiltered":   "(فیلتر شده از _MAX_ رکورد)",
                        "sInfoPostFix":    "",
                        "sInfoThousands":  ",",
                        "sLengthMenu":     "نمایش _MENU_ رکورد",
                        "sLoadingRecords": "در حال بارگزاری...",
                        "sProcessing":     "در حال پردازش...",
                        "sSearch":         "جستجو:",
                        "Print":         "جستجو:",
                        "sZeroRecords":    "رکوردی با این مشخصات پیدا نشد",
                        "oPaginate": {
                            "sFirst":    "ابتدا",
                            "sLast":     "انتها",
                            "sNext":     "بعدی",
                            "sPrevious": "قبلی"
                        },
                        "oAria": {
                            "sSortAscending":  ": فعال سازی نمایش به صورت صعودی",
                            "sSortDescending": ": فعال سازی نمایش به صورت نزولی"
                        },
                        "buttons": {
                            copyTitle: 'اطلاعات با موفقیت کپی شد.',
                            copyKeys: 'Appuyez sur <i>ctrl</i> ou <i>\u2318</i> + <i>C</i> pour copier les données du tableau à votre presse-papiers. <br><br>Pour annuler, cliquez sur ce message ou appuyez sur Echap.',
                            copySuccess: {
                                _: '%d lignes copiées',
                                1: '1 ligne copiée'
                            }
                        }
                    },
                    dom: 'Bfrtip',
                    
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print',
                    ],
                    
                } );

            }); // End of use strict 
        </script>
<!-- buttons: [
                        'colvis','copy', 'csv', 'excel', 'pdf', 'print',
                    ], -->

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>
<script src="/assets/js/jquery.dataTables.yadcf.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css" />
    
<!-- JavaScripts initializations and stuff -->
<script src="/assets/js/xenon-custom.js"></script>


<!-- start - This is for export functionality only -->
<script src="/assets/js/DataTables-1.10.15/extensions/Buttons/js/dataTables.buttons.min.js"></script>
<script src="/assets/js/DataTables-1.10.15/extensions/Buttons/js/buttons.flash.min.js"></script>
<script src="/assets/js/DataTables-1.10.15/ex-js/jszip.min.js"></script>
<script src="/assets/js/DataTables-1.10.15/ex-js/pdfmake.min.js"></script>
<script src="/assets/js/DataTables-1.10.15/ex-js/vfs_fonts.js"></script>

<script src="/assets/js/DataTables-1.10.15/extensions/Buttons/js/buttons.html5.min.js"></script>
<script src="/assets/js/DataTables-1.10.15/extensions/Buttons/js/buttons.print.min.js"></script>



<!-- end - This is for export functionality only -->