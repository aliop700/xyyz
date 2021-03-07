<link href="/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" media="all" />
<script src="/js/bootstrap3.4.1.min.js"></script>
<script src="/js/jquery.dataTables.min.js"></script>
<script src="/js/dataTables.bootstrap4.min.js"></script>

<script>

function drawDataTable(table_id){
    if ( $.fn.dataTable.isDataTable( '#'+table_id ) ) {
               table = $('#'+table_id).DataTable();
    }
    else {
        table = $('#'+table_id).DataTable({
            "language": {
                "url": lang != 'en' ? "/js/datatable_ar.json": ''
            },
            "initComplete": function(settings, json) {
                $('table#'+table_id).parent().addClass('dataTableFirstWrapper')
            }
        });
    }
}
</script>