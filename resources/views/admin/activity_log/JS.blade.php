<script>
$(function() {

    // DATATABLES CONFIG
    let table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: "{{ route('admin.activity-log.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'log_name', name: 'log_name'},
            {data: 'description', name: 'description'},
            {data: 'user_role', name: 'user_role'},
            {data: 'time', name: 'time'},
            {data: 'subject_id', name: 'subject_id'},
            {data: 'action', name: 'action', orderable: false, searchable: false,
            render: function( data, _type, _full ) {
                        let btn;
                        btn = '<button type="button" data-id="/api/admin/activity-log/' + data + '" class="viewBtn btn btn-gradient-success btn-sm mr-1"><i class="mdi mdi-eye menu-icon"></i></button>';
                        return btn;
            }},
        ]
    });

    // VIEW / SHOW DATA WITH SWEET ALERT
    $('.table').on('click','.viewBtn[data-id]',function(e){
            e.preventDefault();
            var url = $(this).data('id');
            
            $.ajax({
                url      : url,
                type     : 'GET',
                datatype : 'json',
                success: function(data){
                    let results = data.results;
                    Swal.fire({
                        title: '<strong>View Data</strong>',
                        icon: 'info',
                        width: 600,
                        html:'<table class="table table-responsive table-borderless">'+
                                '<tr>'+
                                    '<th class="text-right" width="30%">Properties : </th>'+
                                    '<td class="text-left"> '+results.properties+' </td>'+
                                '</tr>'+
                            '</table>',
                        focusConfirm: false,
                    })
                }
            });
        });

})
</script>