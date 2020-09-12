<script>
    $(function(){

        // DATATABLES PACKAGE CONFIG
        let tablePackage = $('#table-package').DataTable({
            processing: true,
            serverSide: true,
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
                searching: false,
                ajax: {
                    'type': 'GET',
                    'url': '{{ route("admin.transaction-details.index") }}',
                    'data': { id_transaction: '{{ $transaction->id }}' }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'package', name: 'package'},
                    {data: 'qty', name: 'qty'},
                    {data: 'harga', name: 'harga'},
                    {data: 'action', name: 'action', orderable: false, searchable: false,
                        render: function( data, _type, _full ) {
                            let btn, colorClass;
                            if(data.status == "diterima"){
                                colorClass = 'btn-info';
                            }else if(data.status == "proses"){
                                colorClass = 'btn-success';
                            }else{
                                colorClass = 'btn-dark';
                            }
                            btn = '<button data-id="/api/admin/transaction-details/' + data.id + '" class="removeItemBtn btn btn-danger btn-sm mb-1"><i class="mdi mdi-delete menu-icon"></i></button>';
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
                ]
            });
    
        // FIND PACKAGE
        $('#find-package').click(function(){
            $('#packageModal').modal('show');
            tablePackage.draw();
        });
    
        // GET ID PACKAGE
        $('#table-package tbody').on('click', 'tr', function () {
            let row = tablePackage.row($(this)).data();
            $('#packageModal').modal('hide');
            $("#id_package").val(row.id);
            $("#nama_paket").val(row.nama_paket);
            $("#harga_package").val(row.harga);
            let harga = $("#harga_package").val();
            let qty = $('#qty').val();
            $('#harga').val(harga * qty);
            
        });
    
        // CALCULATE HARGA
        $('#qty').keyup(function() {
            let harga = $("#harga_package").val();
            let qty = $(this).val();
            $('#harga').val(harga * qty);
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
    
        // ADD TRANSACTION ITEM DETAIL
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

        // UPDATE STATUS TO DITERIMA TRANSACTION ITEM DETAIL
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
    
    