<script>
    $(function(){

        // DATATABLES PACKAGE CONFIG (MODAL VIEW)
        let tablePackage = $('#table-package').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('admin.packages.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'nama_paket', name: 'nama_paket'},
                {data: 'tipe_berat', name: 'tipe_berat'},
                {data: 'harga', name: 'harga'},
                {data: 'service', name: 'service'},
            ]
        });
    
        // DATATABLES TRANSACTION DETAILS CONFIG
        let tableDetailTr = $('#table-detailTr').DataTable({
            processing: true, serverSide: true, bPaginate: false,
            bFilter: true,    ordering: false,  bInfo: false,
            searching: false, responsive: true,
            ajax: {
                'type': 'GET',
                'url': '{{ route("admin.transaction-details.index") }}',
                'data': { id_transaction: '{{ $transaction->id }}' }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'package', name: 'package'},
                {data: 'qty', name: 'qty'},
                {data: 'harga', name: 'harga', 
                    render: function(data, _type, _full){
                        return rupiah(data);
                    }
                },
                {data: 'action', name: 'action', orderable: false, searchable: false,
                    render: function( data, _type, _full ) {
                        let btn, colorClass;
                        if(data.status == "diterima"){
                            colorClass = 'btn-gradient-info';
                        }else if(data.status == "proses"){
                            colorClass = 'btn-gradient-success';
                        }else{
                            colorClass = 'btn-gradient-dark';
                        }
                        btn = '<button data-id="/api/admin/transaction-details/' + data.id + '" class="removeItemBtn btn btn-gradient-danger btn-sm mb-1"><i class="mdi mdi-delete menu-icon"></i></button>';
                        btn += '<div class="btn-group">'+
                                    '<button id="dmb" class="btn dropdown-toggle btn-sm '+colorClass+'" data-toggle="dropdown">'+data.status+'</button>'+
                                    '<div class="dropdown-menu">'+
                                        '<button class="itemBtn dropdown-item" data-status="diterima" data-id="' + data.id + '">Diterima</button>'+
                                        '<button class="itemBtn dropdown-item" data-status="proses" data-id="' + data.id + '">Proses</button>'+
                                        '<button class="itemBtn dropdown-item" data-status="diambil" data-id="' + data.id + '">Diambil</button>'+
                                    '</div>'+
                                '</div>';
                        return btn;
                }},
            ],
            drawCallback: function () {
                var api = this.api();
                var jml = rupiah(api.column( 3, {page:'current'} ).data().sum());
                $('#jumlah').text( jml );
            }
        });
        
        // FIND PACKAGE
        $('#find-package').click(function(){
            $('#packageModal').modal('show');
            tablePackage.draw();
        });
    
        function setHarga(){
            let harga = $("#harga_package").val();
            let qty = $('#qty').val();
            $('#harga').val(harga * qty);
            $('#harga_view').val(rupiah(harga * qty));
        }

        // GET ID PACKAGE
        $('#table-package tbody').on('click', 'tr', function () {
            let row = tablePackage.row($(this)).data();
            $('#packageModal').modal('hide');
            $("#id_package").val(row.id);
            $("#nama_paket").val(row.nama_paket);
            $("#harga_package").val(row.harga.replace(/[.Rp. ]/g,''));
            setHarga();
        });
    
        // CALCULATE HARGA
        $('#qty').keyup(function() {
            setHarga();
        });

        // DATATABLES COUNT TOTAL PRINT MARK CONFIG (MODAL VIEW)
        let tablePrintMark = $('#table-print-mark').DataTable({
            processing: true, serverSide: true, bPaginate: false,
            bFilter: true,    ordering: false,  bInfo: false,
            searching: false, responsive: true,
            ajax: {
                'type': 'GET',
                'url': '{{ route("admin.transaction-details.indexMark") }}',
                'data': { id_transaction: '{{ $transaction->id }}' }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'package', name: 'package'},
                {data: 'qty', name: 'qty'},
                {data: 'harga', name: 'harga', 
                    render: function(data, _type, _full){
                        return rupiah(data);
                    }
                },
                {data: 'action', name: 'action', orderable: false, searchable: false,
                    render: function( data, _type, _full ) {
                        return '<input type="number" min="1" max="999" style="width:50px;height:40px;" class="" value="1" name="'+data+'" required/>';
                }},
            ]
        });

        // SHOW COUNT TOTAL PRINT MARK
        $('#printMarkBtn').click(function(){
            $('#printMarkModal').modal('show');
            tablePrintMark.draw();
        });
    
        let Vdef = {
            'column' : { 
                'storeItem' : {
                    'id_package': $('.error_id_package'),
                    'qty'       : $('.error_qty'),
                    'harga'     : $('.error_harga'),
                },
            },
            'form' : {
                'storeItem'     : $('#addForm-item'),
            },
            'url'           : "/api/admin/transaction-details/",
            'urlStatusItem' : '/api/admin/transaction-details/update-status/'
        };
    
        // STORE TRANSACTION ITEM DETAIL
        $('#addItemDetail').click(function(e){
            e.preventDefault();
            let formdata = new FormData(Vdef.form.storeItem[0]);
            showHideComp('hide', '', Vdef.column.storeItem);
            $(this).html('Sending..');        

            $.ajax({
                data        : formdata,
                url         : Vdef.url,
                method      : 'POST',
                dataType    : 'json',
                processData : false,
                contentType : false,
                success: function (data) {
                    showHideComp('hide', '', Vdef.column.storeItem);
                    Vdef.form.storeItem.trigger("reset");
                    Toast.fire({icon: 'success', title: 'Data Added Successfully'});
                },
                error: function (data) {
                    if(data.status == 422){
                        let msg = data.responseJSON.errors;
                        let msgObject = Object.keys(msg);
                        msgObject.forEach((e, i) => {
                            if (msg[msgObject[i]]) {
                                showHideComp('show', msg[msgObject[i]], { [e] : Vdef.column.storeItem[msgObject[i]] });
                            }
                        });
                    }else {
                        alert('Please Reload to read Ajax');
                        console.log("ERROR : ", e);
                    }
                },
                complete: function(data) {
                    $('#addItemDetail').html('Add Item');
                    tableDetailTr.draw();
                }
            });
        });

        // UPDATE STATUS TRANSACTION ITEM DETAIL
        $('.table').on('click','.itemBtn',function(e){
            e.preventDefault();
            let status = $(this).data('status');
            let id = $(this).data('id');

            $.ajax({
                url         : Vdef.urlStatusItem + id,
                method      : 'PUT',
                dataType    : 'json',
                data        : {
                    status: status
                },
                success: function (data) {
                    Toast.fire({icon: 'success', title: 'Data updated Successfully'});
                    tableDetailTr.draw();
                },
                error: function (data) {
                    alert("ERROR : ", data);
                },
            });
        });

        // REMOVE TRANSACTION ITEM DETAIL
        $('.table').on('click','.removeItemBtn[data-id]',function(e){
            e.preventDefault();
            var url = $(this).data('id');
            $.ajax({
                url : url,
                type: 'DELETE',
                dataType : 'json',
                data : { 
                    method : '_DELETE', 
                    submit : true
                },
                success: function (data) {
                    Toast.fire({icon: 'success', title: 'Data deleted Successfully'});
                    tableDetailTr.draw();
                },
                error: function (data) {
                    alert("ERROR : ", data);
                },
            });
        });

        // SHOW HIDE AND SET TEXT IN COMPONENT
        function showHideComp(key, text = "", ...component){
            let comp = component[0];
            let object = Object.keys(comp);
            for (let i = 0; i < object.length; i++) {
                switch (key) {
                    case 'show':
                        comp[object[i]].show();
                        break;
                    case 'hide':
                        comp[object[i]].hide();
                        break;
                    default:
                        break;
                }
                comp[object[i]].text(text);
            }
        };   

        jQuery.fn.dataTable.Api.register( 'sum()', function ( ) {
            return this.flatten().reduce( function ( a, b ) {
                if ( typeof a === 'string' ) {
                    a = a.replace(/[^\d.-]/g, '') * 1;
                }
                if ( typeof b === 'string' ) {
                    b = b.replace(/[^\d.-]/g, '') * 1;
                }

                return a + b;
            }, 0 );
        } );
        
        function rupiah(angka){
            var rupiah = '';		
            var angkarev = angka.toString().split('').reverse().join('');
            for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
            return 'Rp. '+rupiah.split('',rupiah.length-1).reverse().join('');
        }  
        
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

    // CLAIM TRANSACTION FINISHED
    function claimTransaction(url){
            Swal.fire({
                title: 'Yakin?',
                text: "Jika transaksi selesai, Anda tidak dapat mengubahnya lagi!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#fe496d',
                cancelButtonColor: '#b1a9a9',
                confirmButtonText: 'Yes, delete it!'
            })
            .then((result) => {
                if (result.value) {
                    window.location.href = url;
                }
            })
        };
    
    </script>
    
    