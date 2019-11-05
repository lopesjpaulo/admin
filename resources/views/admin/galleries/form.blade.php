@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/gallery/css/jquery.fileupload.css') }} ">
    <link rel="stylesheet" href="{{ asset('plugins/gallery/css/jquery.fileupload-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/gallery/css/jquery.fileupload-noscript.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/gallery/css/jquery.fileupload-ui-noscript.css') }}">
@stop

@section('title', $title)

@section('content_header')

    <h1>{{$title}}</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
        <li><a href="{{ route('gallery.index') }}">{{$title}}</a></li>
        <li class="active">{{$subtitle}}</li>
    </ol>

@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ isset($news) ? 'Editar notícia' : 'Adicionar notícia' }}</h3>
        </div>
        <div id="fileupload">
            <form role="form" method="POST" action="{{ isset($news) ? route('news.update', $news->id) : route('news.store')}}" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="row fileupload-buttonbar">
                    <div class="col-lg-7">
                        <!-- The fileinput-button span is used to style the file input field as button -->
                        <span class="btn btn-success fileinput-button">
                            <i class="glyphicon glyphicon-plus"></i>
                            <span>Adicionar imagens...</span>
                            <input type="file" name="files[]" multiple>
                        </span>
                        <button type="submit" class="btn btn-primary start">
                            <i class="glyphicon glyphicon-upload"></i>
                            <span>Iniciar envio</span>
                        </button>
                        <button type="reset" class="btn btn-warning cancel">
                            <i class="glyphicon glyphicon-ban-circle"></i>
                            <span>Cancelar envio</span>
                        </button>
                        <button type="button" class="btn btn-danger delete">
                            <i class="glyphicon glyphicon-trash"></i>
                            <span>Apagar</span>
                        </button>
                        <input type="checkbox" class="toggle">
                        <!-- The global file processing state -->
                        <span class="fileupload-process"></span>
                    </div>
                    <!-- The global progress state -->
                    <div class="col-lg-5 fileupload-progress fade">
                        <!-- The global progress bar -->
                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                        </div>
                        <!-- The extended global progress state -->
                        <div class="progress-extended">&nbsp;</div>
                    </div>
                </div>
                <!-- The table listing the files available for upload/download -->
                <div class="row">
                    <div class="col-md-12 table-products">
                        <table id="table-listing-files" role="presentation" class="table table-hover">
                            <thead>
                            <tr>
                                <th class="col-md-2 sortable text-center">
                                    <figure class="loading-order-gallery" style="display:none;">
                                        <img id="loading" src="{{ asset('bundles/base/images/ajax_loader.gif') }}" alt="">
                                    </figure>
                                    <button type="button" class="btn btn-default button-order-submit" value="">
                                        <i class="glyphicon glyphicon-upload"></i>
                                        <span></span>
                                    </button>
                                </th>
                                <th class="col-md-2 sortable">

                                </th>
                                <th class="col-md-3 sortable">
                                    <span class="line"></span>
                                </th>
                                <th class="col-md-2 sortable">
                                    <span class="line"></span>
                                </th>
                                <th class="col-md-2 sortable">
                                    <span class="line"></span>
                                </th>
                                <th class="col-md-3 sortable">
                                    <span class="line"></span>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="files"></tbody>
                        </table>
                    </div>
                </div>
                <div class="row fileupload-buttonbar">
                    <div class="col-lg-7">
                        <!-- The fileinput-button span is used to style the file input field as button -->
                        <span class="btn btn-success fileinput-button2">
                            <i class="glyphicon glyphicon-plus"></i>
                            <span>Adicionar imagens...</span>
                        </span>
                        <button type="submit" class="btn btn-primary start">
                            <i class="glyphicon glyphicon-upload"></i>
                            <span>Iniciar envio</span>
                        </button>
                        <button type="reset" class="btn btn-warning cancel">
                            <i class="glyphicon glyphicon-ban-circle"></i>
                            <span>Cancelar envio</span>
                        </button>
                        <button type="button" class="btn btn-danger delete">
                            <i class="glyphicon glyphicon-trash"></i>
                            <span>Apagar</span>
                        </button>
                        <input type="checkbox" class="toggle">
                        <!-- The global file processing state -->
                        <span class="fileupload-process"></span>
                    </div>
                    <!-- The global progress state -->
                    <div class="col-lg-5 fileupload-progress fade">
                        <!-- The global progress bar -->
                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                        </div>
                        <!-- The extended global progress state -->
                        <div class="progress-extended">&nbsp;</div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('node_modules/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('node_modules/ckfinder/ckfinder.js') }}"></script>
    <script src="{{ asset('plugins/gallery/js/vendor/jquery.ui.widget.js') }}"></script>
    <script src="{{ asset('plugins/gallery/js/load-image.min.js') }}"></script>
    <script src="{{ asset('plugins/gallery/js/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('plugins/gallery/js/jquery.fileupload.js') }}"></script>
    <script src="{{ asset('plugins/gallery/js/jquery.fileupload-process.js') }}"></script>
    <script src="{{ asset('plugins/gallery/js/jquery.fileupload-image.js') }}"></script>
    <script src="{{ asset('plugins/gallery/js/jquery.fileupload-audio.js') }}"></script>
    <script src="{{ asset('plugins/gallery/js/jquery.fileupload-video.js') }}"></script>
    <script src="{{ asset('plugins/gallery/js/jquery.fileupload-validate.js') }}"></script>
    <script src="{{ asset('plugins/gallery/js/jquery.fileupload-ui.js') }}"></script>
    <script>
        $(document).ready(function(){
            'use strict';

            // Initialize the jQuery File Upload widget:
            $('#fileupload').fileupload({
                // Uncomment the following to send cross-domain cookies:
                //xhrFields: {withCredentials: true},
                url: $('#fileupload form').prop('action')
                // autoUpload: true
            }).on('fileuploadsubmit', function (e, data){
                data.formData = data.context.find(':input').serializeArray();
            });


            // Load existing files:
            $('#fileupload').addClass('fileupload-processing');
            $.ajax({
                // Uncomment the following to send cross-domain cookies:
                //xhrFields: {withCredentials: true},
                url: $('#fileupload').fileupload('option', 'url'),
                dataType: 'json',
                context: $('#fileupload')[0]
            }).always(function () {
                $(this).removeClass('fileupload-processing');
            }).done(function (result) {
                $(this).fileupload('option', 'done')
                    .call(this, $.Event('done'), {result: result});
            });

            $(".button-order-submit").click(function(){
                var doSubmit = true;
                var dataPost = {};
                var i = 0;

                var alerta   = $("#alert-mail").fadeOut(500);
                var button = $(this).hide();
                var loading = $("figure.loading-order-gallery").fadeIn(500);

                // Cria array de Objetos com ID e order
                // Checa se input é válido
                $(".td-ordem-images :input").each(function(index, input){
                    var id =  $(this).attr('data-id');

                    dataPost['data' + i] = {id: id, ordem: input.value};

                    if(!input.checkValidity()){
                        doSubmit = false;
                        input.reportValidity();
                    }

                    i++;

                });

                if(doSubmit){
                    $.ajax({
                        url: this.value,
                        type: 'POST',
                        "dataType": 'json',
                        "data": dataPost
                    })
                        .success(function(data) {

                            if (data.success) {
                                location.reload();
                            }

                            if ( ! data.success) {
                                alerta.fadeIn(500);
                                loading.fadeOut(500);
                                button.fadeIn(500);
                            }
                        });
                }

            });
        });
    </script>
@stop