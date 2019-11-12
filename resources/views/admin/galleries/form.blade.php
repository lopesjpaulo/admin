@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/uploader/dist/css/jquery.dm-uploader.min.css') }} ">
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
            <h3 class="box-title">{{ $subtitle }}</h3>
        </div>
        <div class="box-body">
            <div class="row" style="display: flex; flex-wrap: wrap;">
                <div class="col-md-6 col-sm-12">

                    <!-- Our markup, the important part here! -->
                    <div id="drag-and-drop-zone" class="dm-uploader p-5">
                        <h3 class="mb-5 mt-5 text-muted">Drag &amp; drop files here</h3>

                        <div class="btn btn-primary btn-block mb-5">
                            <span>Open the file Browser</span>
                            <input type="file" title='Click to add Files' />
                        </div>
                    </div><!-- /uploader -->

                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="card h-100">
                        <div class="card-header">
                            File List
                        </div>

                        <ul class="list-unstyled p-2 d-flex flex-column col" id="files">
                            <li class="text-muted text-center empty">No files uploaded.</li>
                        </ul>
                    </div>
                </div>
            </div><!-- /file list -->

            <div class="box-footer">
                <button class="btn-block btn-lg btn-success" id="send-images">Enviar</button>
            </div>

            <table class="table table-bordered table-striped data-table">
                <thead>
                <tr>
                    <th>Imagem</th>
                    <th>Data de criação</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($photos as $item)
                    <tr>
                        <td> <img class="img-album img-responsive pad" id="list-photos" src="{{ asset("storage/photos/{$item->file}") }}"></td>
                        <td>{{ convertdata_tosite($item->created_at) }}</td>
                        <td class="action">
                            <form action="{{ route('photo.destroy', $item->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('node_modules/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('node_modules/ckfinder/ckfinder.js') }}"></script>
    <script src="{{ asset('plugins/uploader/dist/js/jquery.dm-uploader.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            'use strict';
            const url = '{!! Request::url() !!}';
            const id = url.split('/')[7];

            $("#drag-and-drop-zone").dmUploader({
                url: '/admin/public/admin/gallery/'+id+'/photos',
                auto: false,
                maxFileSize: 3000000, // 3 Megs
                onDragEnter: function(){
                    // Happens when dragging something over the DnD area
                    this.addClass('active');
                },
                onDragLeave: function(){
                    // Happens when dragging something OUT of the DnD area
                    this.removeClass('active');
                },
                onInit: function(){
                    // Plugin is ready to use
                    ui_add_log('Penguin initialized :)', 'info');
                },
                onComplete: function(){
                    // All files in the queue are processed (success or error)
                    ui_add_log('All pending tranfers finished');
                    location.reload();
                },
                onNewFile: function(id, file){
                    // When a new file is added using the file selector or the DnD area
                    ui_add_log('New file added #' + id);
                    ui_multi_add_file(id, file);
                },
                onBeforeUpload: function(id){
                    // about tho start uploading a file
                    ui_add_log('Starting the upload of #' + id);
                    ui_multi_update_file_status(id, 'uploading', 'Uploading...');
                    ui_multi_update_file_progress(id, 0, '', true);
                },
                onUploadCanceled: function(id) {
                    // Happens when a file is directly canceled by the user.
                    ui_multi_update_file_status(id, 'warning', 'Canceled by User');
                    ui_multi_update_file_progress(id, 0, 'warning', false);
                },
                onUploadProgress: function(id, percent){
                    // Updating file progress
                    ui_multi_update_file_progress(id, percent);
                },
                onUploadSuccess: function(id, data){
                    // A file was successfully uploaded
                    ui_add_log('Server Response for file #' + id + ': ' + JSON.stringify(data));
                    ui_add_log('Upload of file #' + id + ' COMPLETED', 'success');
                    ui_multi_update_file_status(id, 'success', 'Upload Complete');
                    ui_multi_update_file_progress(id, 100, 'green', false);
                },
                onUploadError: function(id, xhr, status, message){
                    ui_multi_update_file_status(id, 'danger', message);
                    ui_multi_update_file_progress(id, 0, 'danger', false);
                },
                onFallbackMode: function(){
                    // When the browser doesn't support this plugin :(
                    ui_add_log('Plugin cant be used here, running Fallback callback', 'danger');
                },
                onFileSizeError: function(file){
                    ui_add_log('File \'' + file.name + '\' cannot be added: size excess limit', 'danger');
                }
            });

            $("#send-images").click(function () {
                $("#drag-and-drop-zone").dmUploader("start");
            });
        });
    </script>

    <!-- File item template -->
    <script type="text/html" id="files-template">
        <li class="media">
            <div class="media-body mb-1">
                <p class="mb-2">
                    <strong>%%filename%%</strong> - Status: <span class="text-muted">Waiting</span>
                </p>
                <div class="progress mb-2">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                         role="progressbar"
                         style="width: 0%"
                         aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                    </div>
                </div>
                <hr class="mt-1 mb-1" />
            </div>
        </li>
    </script>

    <!-- Debug item template -->
    <script type="text/html" id="debug-template">
        <li class="list-group-item text-%%color%%"><strong>%%date%%</strong>: %%message%%</li>
    </script>
@stop