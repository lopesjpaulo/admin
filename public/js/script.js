$(function () {

    /*** LIBS ***/
    $('.data-table').DataTable({
        "bPaginate": false
    });

    $('.select2').select2();

    $('.cpf').inputmask('999.999.999-99', { 'placeholder': '000.000.000-00' });

    $('.cnpj').inputmask('99.999.999/9999-99', { 'placeholder': '99.999.999/9999-99' });

    $('.telefone').inputmask('(99)99999-9999', { 'placeholder': '(99)99999-9999' });

    $('.datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })

    $(".amount").maskMoney({symbol:'R$ ', thousands:'.', decimal:','});

    if($(".datepicker")[0]){
        $(".datepicker").datepicker({
            format: 'dd/mm/yyyy'
        });
    }

    //$(".conteudo").wysihtml5();

    if($("#my-select")[0]){
        $("#my-select").multiSelect();
    }

    /*** FUNCTIONS ***/
    if($(".theme-select")[0]){
        $(".theme-select").on('change', function (e) {
            $(".type-select").empty();
            $.ajax({
                type: "POST",
                url: "/andrecury/public/admin/questions/findType",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {theme: $(".theme-select").find(':selected').val()},
                success: function (data) {
                    data.forEach(function (valor) {
                       $(".type-select").append(new Option(valor.title, valor.id));
                    });
                }
            });
        });
    }

    if($(".theme-questions")[0]){
        $(".theme-questions").on('change', function (e) {
            $("#my-select").multiSelect('refresh');
            $.ajax({
                type: "POST",
                url: "/andrecury/public/admin/tests/findQuestion",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {theme: $(".theme-questions").find(':selected').val()},
                success: function (data) {
                    console.log(data);
                    data.forEach(function (valor) {
                        $("#my-select").multiSelect('addOption', { value: valor.id, text: (valor.title.replace(/<[^>]*>?/gm, '')) });
                        //$("#my-select").append(new Option(valor.title.replace(/<[^>]*>?/gm, ''), valor.id));
                    });
                }
            });
        });
    }

    var editor = CKEDITOR.replace( 'editor', {
        filebrowserBrowseUrl: 'http://localhost/andrecury/public/node_modules/ckfinder/ckfinder.html',
        filebrowserUploadUrl: 'http://localhost/andrecury/public/node_modules/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
    });
  });