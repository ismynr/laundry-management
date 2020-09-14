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
                {data: 'status', name: 'status', searchable: false,
                render: function( data, _type, _full ) {
                            return '<span class="badge badge-'+(data=='Berjalan' ? 'success':'dark')+'">'+ data +'</span>';
                }},
                {data: 'total_harga', name: 'total_harga'},
                {data: 'jml_transaction', name: 'jml_transaction'},
                {data: 'action', name: 'action', orderable: false, searchable: false,
                render: function( data, _type, _full ) {
                            let btn;
                            btn = '<a href="{{ route("admin.transactions.index") }}/'+ data +'/edit" class="viewBtn btn btn-gradient-primary btn-sm mr-1" title="view"><i class="mdi mdi-eye menu-icon"></i></a>';
                            btn += '<button data-id="/api/admin/transactions/' + data + '" data-id_item="/api/admin/transaction-details/delete-by-idtrans/' + data + '" class="deleteBtn btn btn-gradient-danger btn-sm"><i class="mdi mdi-delete menu-icon"></i> Delete</button>';
                            return btn;
                }},
            ]
        });

        // DELETE OR DESTROY DATA SWEET ALERT
        $('.table').on('click','.deleteBtn[data-id]',function(e){
            e.preventDefault();
            var urlTrans = $(this).data('id');    
            var urlTransItem = $(this).data('id_item'); //url remove by id_transaction     
            Swal.fire({
                title: 'Yakin?',
                text: "Item yang terkait dengan transaksi ini akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#fe496d',
                cancelButtonColor: '#b1a9a9',
                confirmButtonText: 'Yes, delete it!'
            })
            .then((result) => {
                if (result.value) {
                    $.ajax({
                        url : urlTransItem,
                        type: 'DELETE',
                        dataType : 'json',
                        data : { 
                            method : '_DELETE', 
                            submit : true
                        },
                        success: function(data){
                            $.ajax({
                                url : urlTrans,
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