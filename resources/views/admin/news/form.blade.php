@extends('adminlte::page')

@section('css')
<link rel="stylesheet" href="{{ asset('node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }} ">
<link rel="stylesheet" href="{{ asset('node_modules/bootstrap3-wysihtml5-npm/dist/bootstrap3-wysihtml5.min.css') }}">
@stop

@section('title', 'Adicionar notícia')

@section('content_header')

    <h1>Notícias</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
        <li><a href="{{ route('news.index') }}">Notícias</a></li>
        <li class="active">{{ isset($news) ? 'Editar notícia' : 'Adicionar notícia' }}</li>
    </ol>

@stop

@section('content')
  <div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">{{ isset($news) ? 'Editar notícia' : 'Adicionar notícia' }}</h3>
    </div>
    <form role="form" method="POST" action="{{ isset($news) ? route('news.update', $news->id) : route('news.store')}}" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <div class="box-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                        <label for="inputTitle">Título</label>
                        <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Título da notícia" value="{{ isset($news) ? $news->title : old('title') }}">
                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group @error('published_at') has-error @enderror">
                        <label for="inputData">Data de publicação</label>
                        <input type="text" name="published_at" class="form-control datepicker" id="inputData" placeholder="" value="{{ isset($news) ? \Carbon\Carbon::parse($news->published_at)->format('d/m/Y') : old('published_at') }}">
                        @error('published_at')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group @error('description') has-error @enderror">
                        <label for="inputDesc">Descrição</label>
                        <textarea name="description" class="form-control" id="inputDesc" placeholder="Descrição breve da notícia" rows="4">{{ isset($news) ? $news->description : old('description') }}</textarea>
                        @error('description')
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
                        <textarea name="content" class="form-control conteudo" id="inputContent" placeholder="Conteúdo da notícia">{{ isset($news) ? $news->content : old('content') }}</textarea>
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
                    <div class="form-group">
                        <label for="inputAuthor">Autor da notícia</label>
                        <input type="text" name="author" class="form-control" id="inputAuthor" placeholder="" value="{{ isset($news) ? $news->author : old('author') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group @error('image') has-error @enderror">
                        <label for="inputImage">Imagem</label>
                        <input type="file" name="image" class="form-control" id="inputImage">
                        @error('image')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        @if(isset($news->file))
                            <img class="img-responsive pad" src="{{ asset("storage/news/{$news->file}") }}" alt="{{ $news->title }}">
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
    <script src="{{ asset('node_modules/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('node_modules/bootstrap3-wysihtml5-npm/dist/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <script src="{{ asset('node_modules/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('node_modules/ckfinder/ckfinder.js') }}"></script>
@stop