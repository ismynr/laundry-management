<script>
    $(function() {
        
        // DATATABLES CONFIG
        let table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('admin.users.indexKaryawan') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'action', name: 'action', orderable: false, searchable: false,
                render: function( data, _type, _full ) {
                            let btn;
                            btn = '<button type="button" data-id="/api/admin/users/' + data.id_user + '" class="viewBtn btn btn-gradient-success btn-sm mr-1" title="view"><i class="mdi mdi-eye menu-icon"></i></button>';
                            btn += '<button type="button" data-id="/api/admin/users/' + data.id_user + '" class="editBtn btn btn-gradient-info btn-sm mr-1"><i class="mdi mdi-pencil menu-icon"></i> Edit</button>';
                            if(data.id_karyawan == ""){
                                btn += '<button data-id="/api/admin/users/' + data.id_user + '" data-id_kary="" class="deleteBtn btn btn-gradient-danger btn-sm"><i class="mdi mdi-delete menu-icon"></i> Delete</button>';
                            }else{
                                btn += '<button data-id="/api/admin/users/' + data.id_user + '" data-id_kary="/api/admin/karyawans/' + data.id_karyawan + '" class="deleteBtn btn btn-gradient-danger btn-sm"><i class="mdi mdi-delete menu-icon"></i> Delete</button>';
                            }
                            return btn;
                }},
            ]
        });

        // VARIABLE DEFINITION FOR AJAX 
        let Vdef = {
            'column' : { 
                'store' : {
                    'name'      : $('.error_name'),
                    'email'     : $('.error_email'),
                    'password'  : $('.error_password'),
                    'password_confirmation' : $('.error_password_confirmation'),
                },
                'update' : {
                    'name'      : $('.edit_error_name'),
                    'email'     : $('.edit_error_email'),
                    'password'  : $('.edit_error_password'),
                    'password_confirmation' : $('.edit_error_password_confirmation'),
                },
                'saveKaryawan' : {
                    'alamat'    : $('.error_alamat'),
                    'telephone' : $('.error_telephone'),
                    'gender'    : $('.error_gender'),
                },
            },
            'form' : {
                'store'        : $('#addForm'),
                'update'       : $('#editForm'),
                'saveKaryawan' : $('#saveKaryawanForm'),
            },
            'colEdit' : {
                'id'        : $('#edit_id'),
                'name'      : $('#edit_name'),
                'email'     : $('#edit_email'),
            },
            'colSaveKaryawan' : {
                'id'        : $('#save_id'),
                'id_user'   : $('#save_id_user'),
                'alamat'    : $('#save_alamat'),
                'telephone' : $('#save_telephone'),
                'gender'    : $('#save_gender'),
            },
            'url' : "/api/admin/users/",
            'urlKaryawan' : "/api/admin/karyawans/"
        };

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
                                    '<th class="text-right" width="30%">Telephone : </th>'+
                                    '<td class="text-left">'+ (results.karyawan == null ? 'Belum dibuat':results.karyawan.telephone) +'</td>'+
                                '</tr>'+
                                '<tr>'+
                                    '<th class="text-right">Gender : </th>'+
                                    '<td class="text-left">'+ (results.karyawan == null ? 'Belum dibuat':results.karyawan.gender) +'</td>'+
                                '</tr>'+
                                '<tr>'+
                                    '<th class="text-right">Alamat : </th>'+
                                    '<td class="text-left">'+ (results.karyawan == null ? 'Belum dibuat':results.karyawan.alamat) +'</td>'+
                                '</tr>'+
                            '</table>',
                        showCloseButton: true,
                        showCancelButton: true,
                        focusConfirm: false,
                        confirmButtonText: 'Edit!',
                        confirmButtonColor: '#ffd500',
                        cancelButtonText: 'Close',
                    })
                    .then((result) => {
                        let saveAction = (results.karyawan == null ? 'add':'edit');
                        Vdef.form.saveKaryawan.trigger("reset");
                        showHideComp('hide', '', Vdef.column.saveKaryawan);

                        if (result.value) {
                            if(saveAction == 'edit'){
                                let resObject = Object.keys(results.karyawan);
                                let colSaveKaryawanObject = Object.keys(Vdef.colSaveKaryawan);

                                // MATCHING COLUMN DATA FOR FORM
                                colSaveKaryawanObject.forEach((e, i) => {
                                    resObject.forEach((eResult, iResult) => {
                                        if(e == eResult){
                                            Vdef.colSaveKaryawan[e].val(results.karyawan[eResult]);
                                        }
                                    });
                                });

                            }else if(saveAction == 'add'){ 
                                $('#save_id').val(null);
                                $('#save_id_user').val(results.id);
                            }

                            $('#save_action').val(saveAction);
                            $('#saveKaryawanModal').modal('show');
                        }
                    });
                }
            });
        });

        // SAVE (STORE AND UPDATE) DATA KARYAWAN 
        // AFTER CLICK BUTTON IN SWEET ALERT "EDIT!"
        $('#saveKaryawanBtn').click(function(e){
            e.preventDefault();
            let formdata    = new FormData(Vdef.form.saveKaryawan[0]);
            let saveAction  = $('#save_action').val();
            let checkIdEdit = (saveAction == 'add' ? '' : $('#save_id').val());
            showHideComp('hide', '', Vdef.column.saveKaryawan);
            $(this).html('Sending..');
            
            if(saveAction == 'edit'){
                formdata.append('_method', 'PUT');
            }
            
            $.ajax({
                url        : Vdef.urlKaryawan + checkIdEdit,
                data       : formdata,
                method     :'POST',
                dataType   :'json',
                processData: false,
                contentType: false,
                success: function(data){
                    $('#saveKaryawanModal').modal('hide');
                    showHideComp('hide', '', Vdef.column.saveKaryawan);
                    Vdef.form.saveKaryawan.trigger('reset');
                    Toast.fire({icon: 'success', title: 'Data Saved Successfully'})
                },
                error: function (data) {
                    if(data.status == 422){
                        let msg = data.responseJSON.errors;
                        let msgObject = Object.keys(msg);        

                        // MESSAGE ERROR VALIDATION
                        msgObject.forEach((e, i) => {
                            if (msg[msgObject[i]]) {
                                showHideComp('show', msg[msgObject[i]], { [e] : Vdef.column.saveKaryawan[msgObject[i]] });
                            }
                        });
                    }else {
                        alert('Please Reload to read Ajax');
                        console.log("ERROR : ", e);
                    }
                },
                complete: function(){
                    $('#saveKaryawanBtn').html('Save');
                    table.draw();
                }
            });
        });

        // ADD BUTTON TO SHOW MODAL DIALOG
        $('.addBtn').click(function(){
            $('#storeBtn').html('Create');
            $('#addModal').modal('show');
            Vdef.form.store.trigger("reset");
            showHideComp('hide', '', Vdef.column.store);
        });

        // STORE BUTTON TO SAVE DATA 
        $('#storeBtn').click(function (e) {
            e.preventDefault();
            let formdata = new FormData(Vdef.form.store[0]);
            showHideComp('hide', '', Vdef.column.store);
            $(this).html('Sending..');   

            $.ajax({
                // data: form.store.serialize(),
                data : formdata,
                dataType : 'json',
                processData: false,
                contentType: false,
                url: Vdef.url,
                method: "POST",
                success: function (data) {
                    showHideComp('hide', '', Vdef.column.store);
                    $('#addModal').modal('hide');
                    Vdef.form.store.trigger("reset");
                    Toast.fire({icon: 'success', title: 'Data Added Successfully'})
                },

                error: function (data) {
                    if(data.status == 422){
                        let msg = data.responseJSON.errors;
                        let msgObject = Object.keys(msg);      
                        // MESSAGE ERROR VALIDATION
                        msgObject.forEach((e, i) => {
                            if (msg[msgObject[i]]) {
                                showHideComp('show', msg[msgObject[i]], { [e] : Vdef.column.store[msgObject[i]] });
                            }
                        });
                    }else {
                        alert('Please Reload to read Ajax');
                        console.log("ERROR : ", e);
                    }
                },
                complete: function(data) {
                    $('#storeBtn').html('Create');
                    table.draw();
                }
            });
        });

        // EDIT BUTTON TO SHOW MODAL DIALOG
        $('.table').on('click','.editBtn[data-id]',function(e){
            e.preventDefault();
            Vdef.form.update.trigger("reset");
            showHideComp('hide', '', Vdef.column.update);
            let url = $(this).data('id');            
            $.ajax({
                url      : url,
                type     : 'GET',
                datatype : 'json',
                success: function(data){
                    let results = data.results;
                    let resObject = Object.keys(results);
                    let colEditObject = Object.keys(Vdef.colEdit);
                    // MATCHING COLUMN DATA FOR FORM
                    colEditObject.forEach((e, i) => {
                        // SEARCH
                        resObject.forEach((eResult, iResult) => {
                            if(e == eResult){
                                Vdef.colEdit[e].val(results[eResult]);
                            }
                        });
                    });
                    $('#editModal').modal('show');
                }
            });
        });

        // UPDATE BUTTON TO SAVE DATA
        $('#updateBtn').click(function(e){
            e.preventDefault();
            let formdata = new FormData(Vdef.form.update[0]);
            formdata.append('_method', 'PUT');
            showHideComp('hide', '', Vdef.column.update);
            $(this).html('Sending..');
            
            $.ajax({
                url        : Vdef.url + $('#edit_id').val(),
                data       : formdata,
                method     :'POST',
                dataType   :'json',
                processData: false,
                contentType: false,
                success: function(data){
                    $('#editModal').modal('hide');
                    showHideComp('hide', '', Vdef.column.update);
                    Vdef.form.update.trigger('reset');
                    Toast.fire({icon: 'success', title: 'Data Updated Successfully'})
                },
                error: function (data) {
                    if(data.status == 422){
                        let msg = data.responseJSON.errors;
                        let msgObject = Object.keys(msg);                        
                        // MESSAGE ERROR VALIDATION
                        msgObject.forEach((e, i) => {
                            if (msg[msgObject[i]]) {
                                showHideComp('show', msg[msgObject[i]], { [e] : Vdef.column.update[msgObject[i]] });
                            }
                        });
                    }else {
                            alert('Please Reload to read Ajax');
                            console.log("ERROR : ", e);
                        }
                    },
                complete: function(){
                    $('#updateBtn').html('Ubah');
                    table.draw();
                }
            });
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
                if(urlKary == ""){
                    // ONLY DELETE USER ROW 
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
                }else{
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
                                // AND SECOND DELETE USER ROW 
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
                }
            })
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