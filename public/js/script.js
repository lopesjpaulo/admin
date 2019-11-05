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

    if($(".filetree")[0]){
        $(".file-tree").filetree();
    }

    if($(".datepicker")[0]){
        $(".datepicker").datepicker({
            format: 'dd/mm/yyyy'
        });
    }
    //$(".conteudo").wysihtml5();

    if($("#my-select")[0]){
        $("#my-select").multiSelect();
    }

    if($(".categoria-select")[0]){
        $(".categoria-select").on('change', function (e) {
            $(".subcategoria-select").empty();
            $.ajax({
                type: "POST",
                url: "/docfacil/public/admin/categorias/findSubcategoria",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {categoria: $(".categoria-select").find(':selected').val()},
                success: function (data) {
                    $(".subcategoria-select").append(new Option('Selecione subcategoria', 0));
                    data.forEach(function (valor) {
                        $(".subcategoria-select").append(new Option(valor.title, valor.id));
                    });
                }
            });
        });
    }

    if($(".organizacao-select")[0]){
        $(".organizacao-select").on('change', function (e) {
            $(".catorganizacao-select").empty();
            $.ajax({
                type: "POST",
                url: "/docfacil/public/admin/organizacoes/findCatorganizacao",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {organizacao: $(".organizacao-select").find(':selected').val()},
                success: function (data) {
                    $(".catorganizacao-select").append(new Option('Selecione categoria de organização', 0));
                    data.forEach(function (valor) {
                        $(".catorganizacao-select").append(new Option(valor.title, valor.id));
                    });
                }
            });
        });
    }

    if($(".categoria-folder")[0]){
        $(".categoria-folder").on('click', function (e) {
            var categoria_id = $(this).attr('data-id');
            window.location.href = "/docfacil/public/admin/folder/categoria/"+categoria_id;
        });
    }

    if($(".subcategoria-folder")[0]){
        $(".subcategoria-folder").on('click', function (e) {
            var subcategoria_id = $(this).attr('data-id');
            window.location.href = "/docfacil/public/admin/folder/subcategoria/"+subcategoria_id;
        });
    }

    /*if($(".file-folder")[0]){
        $(".file-folder").on('click', function (e) {
            var file_id = $(this).attr('data-id');
            window.location.href = "/docfacil/public/admin/folder/subcategoria/"+subcategoria_id;
        });
    }*/

    /*if($(".categoria-folder")[0]){
        $(".categoria-folder").on('click', function (e) {
           var categoria_id = $(this).attr('data-id');
           var folder = $(this);
           $.ajax({
               type: "POST",
               url: "/docfacil/public/admin/categorias/findSubcategoria",
               headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
               data: {categoria: categoria_id},
               success: function (data) {
                   data.forEach(function (valor) {
                       console.log($(folder));
                       $(folder).parent().children().eq(1).append(
                           "<li class='folder-root closed'>"+
                           "<a href='#' class='subcategoria-folder' data-id='"+valor.id+"'>"+valor.title+"</a>"+
                           "<ul></ul>"+
                           "</li>"
                       );
                   });
               }
           });
        });
    }*/

    if($(".subcategoria-folder")[0]){
        $(".subcategoria-folder").on('click', function (e) {
           var subcategoria_id = $(this).attr('data-id');
           var folder = $(this);
           $.ajax({
               type: "POST",
               url: "/docfacil/public/admin/categorias/findFiles",
               headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
               data: {subcategoria_id: subcategoria_id},
               success: function (data) {
                   data.forEach(function (valor) {
                       $(folder).parent().children().eq(1).append(
                           "<li>"+
                           "<a href='#' data-id='"+valor.id+"'>"+valor.title+"</a>"+
                           "<ul></ul>"+
                           "</li>"
                       );
                   });
               }
           });
        });
    }

    $('.conteudo').each(function (e) {
        var editor = CKEDITOR.replace( this.id, {
            filebrowserBrowseUrl: 'http://localhost/docfacil/public/node_modules/ckfinder/ckfinder.html',
            filebrowserUploadUrl: 'http://localhost/docfacil/public/node_modules/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
        });
        CKFinder.setupCKEditor( editor , 'ckfinder/');
    })
  });