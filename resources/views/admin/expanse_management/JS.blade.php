<script>
    $(function () {

        // DATATABLES CONFIG
        let table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('admin.expanses.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'user', name: 'user'},
                {data: 'deskripsi', name: 'deskripsi'},
                {data: 'harga', name: 'harga'},
                {data: 'catatan', name: 'catatan'},
                {data: 'action', name: 'action', orderable: false, searchable: false,
                    render: function( data, _type, _full ) {
                        let btn = null;
                        btn = '<button type="button" data-id="/api/admin/expanses/' + data + '" class="viewBtn btn btn-gradient-success btn-sm mr-1" title="view"><i class="mdi mdi-eye menu-icon"></i></button>';
                        return btn;
                }},
            ]
        });

        // VIEW / SHOW DATA WITH SWEET ALERT
        $('.table').on('click','.viewBtn[data-id]',function(e){
            e.preventDefault();
            var url = $(this).data('id');
            let col2 = $(this).closest("tr").find("td:nth-child(2)");
            
            $.ajax({
                url      : url,
                type     : 'GET',
                datatype : 'json',
                success: function(data){
                    let results = data.results;
                    Swal.fire({
                        title: '<strong>View Data</strong>',
                        icon: 'info',
                        width: 800,
                        html:'<table class="table table-responsive table-borderless">'+
                                '<tr>'+
                                    '<th class="text-right" width="25%">Dibuat Oleh : </th>'+
                                    '<td class="text-left">'+$(col2).text()+'</td>'+
                                '</tr>'+
                                '<tr>'+
                                    '<th class="text-right">Deskripsi : </th>'+
                                    '<td class="text-left">'+results.deskripsi+'</td>'+
                                '</tr>'+
                                '<tr>'+
                                    '<th class="text-right">Harga : </th>'+
                                    '<td class="text-left">'+Rupiah(results.harga)+'</td>'+
                                '</tr>'+
                                '<tr>'+
                                    '<th class="text-right">Catatan : </th>'+
                                    '<td class="text-left">'+results.catatan+'</td>'+
                                '</tr>'+
                                '<tr>'+
                                    '<th class="text-right">Dibuat Pada : </th>'+
                                    '<td class="text-left">'+(new Date(results.updated_at))+'</td>'+
                                '</tr>'+
                            '</table>',
                        showCancelButton: false,
                        focusConfirm: false,
                        confirmButtonText: 'Ok!',
                        confirmButtonAriaLabel: 'Thumbs up, great!',
                    });
                }
            });
        });

        // FORMAT RUPIAH
        function Rupiah(angka){
            var rupiah = '';		
            var angkarev = angka.toString().split('').reverse().join('');
            for(var i = 0; i < angkarev.length; i++){
                if(i%3 == 0){
                    rupiah += angkarev.substr(i,3)+'.';
                } 
            }
            return 'Rp '+rupiah.split('',rupiah.length-1).reverse().join('');
        }

    });
</script>