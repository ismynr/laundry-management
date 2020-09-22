<script>
$(function(){

    // COMBOBOX AUTO COMPLETE ID SERVICE
    $('.select2_id_customer').select2({
            theme: "bootstrap",
            placeholder: 'Pilih Customer',
            ajax: {
                url: "/api/karyawan/customers/search/select",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return { q: params.term }
                },
                processResults: function (data) {
                    return {
                        results:  $.map(data.results, function (item) {
                            return {
                                text: item.name+' - (id: '+item.id+')',
                                id: item.id
                            }
                        })
                    };
                }, cache: true
            },
            templateSelection: function (selection) {
                var result = selection.text.split('-');
                return result[0];
            }
        });

})

</script>

