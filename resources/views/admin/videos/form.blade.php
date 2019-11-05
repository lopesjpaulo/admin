@extends('adminlte::page')

@section('title', $title)

@section('content_header')

    <h1>{{ $title }}</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
        <li><a href="{{ route('videos.index') }}">{{ $title }}</a></li>
        <li class="active">{{ $subtitle }}</li>
    </ol>

@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $subtitle }}</h3>
        </div>
        <form role="form" method="POST" action="{{ isset($video) ? route('videos.update', $video->id) : route('videos.store')}}" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group @error('title') has-error @enderror">
                            <label for="inputTitle">Título</label>
                            <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Título da notícia" value="{{ isset($video) ? $video->title : old('title') }}">
                            @error('title')
                                <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group @error('content') has-error @enderror">
                            <label for="inputContent">Conteúdo</label>
                            <textarea name="content" class="form-control conteudo" id="inputContent" placeholder="Conteúdo da notícia">{{ isset($video) ? $video->content : old('content') }}</textarea>
                            @error('content')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group @error('file') has-error @enderror">
                            <label for="inputVideo">Video</label>
                            <input type="file" name="file" class="form-control" id="inputVideo">
                            @error('file')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            @if(isset($video->file))
                                <video width="320" height="240" controls>
                                    <source src="{{ url("storage/videos/{$video->file}") }}">
                                </video>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn-block btn-lg btn-success">Enviar</button>
            </div>
        </form>
    </div>
@stop

@section('js')
    <script src="{{ asset('node_modules/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('node_modules/ckfinder/ckfinder.js') }}"></script>
@stop