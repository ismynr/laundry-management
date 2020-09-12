<script>
    $(function() {
        
        // DATATABLES CONFIG
        let table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.transactions.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'code', name: 'code'},
                {data: 'customer', name: 'customer'},
                {data: 'total_harga', name: 'total_harga'},
                {data: 'jml_transaction', name: 'jml_transaction'},
                {data: 'action', name: 'action', orderable: false, searchable: false,
                render: function( data, _type, _full ) {
                            let btn;
                            btn = '<a href="{{ route("admin.transactions.index") }}/'+ data +'/edit" class="viewBtn btn btn-gradient-success btn-sm mr-1" title="view"><i class="mdi mdi-eye menu-icon"></i></a>';
                            btn += '<button data-id="/api/admin/transactions/' + data + '" class="deleteBtn btn btn-gradient-danger btn-sm"><i class="mdi mdi-delete menu-icon"></i> Delete</button>';
                            return btn;
                }},
            ]
        });

        // DELETE OR DESTROY DATA SWEET ALERT
        $('.table').on('click','.deleteBtn[data-id]',function(e){
            e.preventDefault();
            var urlUser = $(this).data('id');    
            var urlKary = $(this).data('id_kary');            
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#fe496d',
                cancelButtonColor: '#b1a9a9',
                confirmButtonText: 'Yes, delete it!'
            })
            .then((result) => {
                if (result.value) {
                    // FIRST DELETE KARYAWAN ROW 
                    $.ajax({
                        url : urlKary,
                        type: 'DELETE',
                        dataType : 'json',
                        data : { 
                            method : '_DELETE', 
                            submit : true
                        },
                        success: function(data){
                            $.ajax({
                                url : urlUser,
                                type: 'DELETE',
                                dataType : 'json',
                                data : { 
                                    method : '_DELETE', 
                                    submit : true
                                },
                                success: function(data){
                                    Swal.fire('Deleted!', 'Your file has been deleted.', 'success');
                                    table.draw();
                                },
                                error: function (data){
                                    alert(data.responseJSON.message);
                                }
                            });
                        },
                        error: function (data){
                            alert(data.responseJSON.message);
                        }
                    });
                }
            })
        });
        
        // TOAST SWEET ALERT CONFIG
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            background: 'linear-gradient(to right, #ffffff, #bc8dff)',
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

    });
</script>