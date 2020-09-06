<script>
    $(function() {
        
        // DATATABLES CONFIG
        let table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.users.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'action', name: 'action', orderable: false, searchable: false,
                render: function( data, _type, _full ) {
                            let btn;
                            if(data != {{ Auth::user()->id }}){
                                btn = '<button type="button" data-id="/api/admin/users/' + data + '" class="editBtn btn btn-gradient-info btn-sm mr-1"><i class="mdi mdi-pencil menu-icon"></i> Edit</button>';
                                btn += '<button data-id="/api/admin/users/' + data + '" class="deleteBtn btn btn-gradient-danger btn-sm"><i class="mdi mdi-delete menu-icon"></i> Delete</button>';
                            }else{
                                btn = '<span class="badge badge-dark">You</span>';
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
            'url' : "/api/admin/users/",
        };

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