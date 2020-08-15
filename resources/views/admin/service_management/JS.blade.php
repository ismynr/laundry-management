<script>
  $(function() {
    
    // DATATABLES CONFIG
    let table = $('.data-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: "/admin/services",
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'service_type', name: 'service_type'},
        {data: 'action', name: 'action', orderable: false, searchable: false,
          render: function( data, _type, _full ) {
                    let btn;
                    btn = '<button type="button" data-id="/api/admin/services/' + data + '" class="editBtn btn btn-gradient-info btn-sm mr-1"><i class="mdi mdi-pencil menu-icon"></i> Edit</button>';
                    btn += '<button data-id="/api/admin/services/' + data + '" class="deleteBtn btn btn-gradient-danger btn-sm"><i class="mdi mdi-delete menu-icon"></i> Delete</button>';
                    return btn;
        }},
      ]
    });

    // ADD BUTTON TO SHOW MODAL DIALOG
    $('.addBtn').click(function(){
      $('#storeBtn').html('Create');
      $('#addModal').modal('show');
      $('#addForm').trigger("reset");
    });

    // STORE BUTTON TO SAVE DATA 
    $('#storeBtn').click(function (e) {
      e.preventDefault();
      let error_st = $('.error_service_type');
      let frm = $('#addForm');
      let url = "/api/admin/services/" + $('#id').val();
      let formdata = new FormData(frm[0]);
      showHideComp('hide', '', error_st);
      $(this).html('Sending..');
  
      $.ajax({
        // data: frm.serialize(),
        data : formdata,
        dataType : 'json',
        processData: false,
        contentType: false,
        url: url,
        method: "POST",
        success: function (data) {
          showHideComp('hide', '', error_st);
          $('#addModal').modal('hide');
          Toast.fire({icon: 'success', title: 'Data Added Successfully'})
        },
        error: function (data) {
          if(data.status == 422){
            let msg = data.responseJSON.errors;
            if (msg.service_type) {
                showHideComp('show', msg.service_type, error_st);
            }
          }else {
            alert('Please Reload to read Ajax');
            console.log("ERROR : ", e);
          }
        },
        complete: function(data) {
          $('#storeBtn').html('Create');
          frm.trigger("reset");
          table.draw();
        }
    });
  });

    // EDIT BUTTON TO SHOW MODAL DIALOG
    $('.table').on('click','.editBtn[data-id]',function(e){
        e.preventDefault();
        $('#editForm').trigger("reset");
        let url = $(this).data('id');
        
        $.ajax({
            url      : url,
            type     : 'GET',
            datatype : 'json',
            success: function(data){
                $('#edit_id').val(data.results.id);
                $('#edit_service_type').val(data.results.service_type);
                $('#editModal').modal('show');
            }
        });
    });

    // UPDATE BUTTON TO SAVE DATA
    $('#updateBtn').click(function(e){
        e.preventDefault();
        let error_st = $('.edit_error_service_type');
        let frm = $('#editForm');
        let url = "/api/admin/services/" + $('#edit_id').val();
        let formdata = new FormData(frm[0]);
        formdata.append('_method', 'PUT');
        showHideComp('hide', '', error_st);
        $(this).html('Sending..');

        $.ajax({
            url        : url,
            data       : formdata,
            method     :'POST',
            dataType   :'json',
            processData: false,
            contentType: false,
            success: function(data){
                showHideComp('hide', '', error_st);
                $('#editModal').modal('hide');
                Toast.fire({icon: 'success', title: 'Data Updated Successfully'})
            },
            error: function (data) {
                if(data.status == 422){
                  let msg = data.responseJSON.errors;
                  if (msg.service_type) {
                      showHideComp('show', msg.service_type, error_st);
                  }
                }else {
                  alert('Please Reload to read Ajax');
                  console.log("ERROR : ", e);
                }
            },
            complete: function(){
              $('#updateBtn').html('Ubah');
              frm.trigger('reset');
              table.draw();
            }
        });
    });

    // DELETE OR DESTROY DATA SWEET ALERT
    $('.table').on('click','.deleteBtn[data-id]',function(e){
      e.preventDefault();
      var url = $(this).data('id');
      
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
              url : url,
              type: 'DELETE',
              dataType : 'json',
              data : { 
                method : '_DELETE', 
                submit : true
              },
              success: function(data){
                Swal.fire('Deleted!', 'Your file has been deleted.', 'success');
                table.draw();
              }
            });
          }
        })
    });

    function showHideComp(key, text = "", ...component){
      for (c of component) {
        switch (key) {
          case 'show':
            c.show();
            break;
          case 'hide':
            c.hide();
            break;
        }
        c.text(text);
      }
    };
    
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