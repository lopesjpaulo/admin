@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ asset('node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }} ">
@stop

@section('title', $subtitle)

@section('content_header')

    <h1>{{$title}}</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
        <li><a href="{{ route('files.index') }}">{{$title}}</a></li>
        <li class="active">{{ $subtitle }}</li>
    </ol>

    <meta name="csrf-token" content="{{ csrf_token() }}">

@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $subtitle }}</h3>
        </div>
        <form role="form" method="POST" action="{{ isset($file) ? route('files.update', $file->id) : route('files.store')}}" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group @error('title') has-error @enderror">
                            <label for="inputTitle">Título</label>
                            <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Título do arquivo" value="{{ isset($file) ? $file->title : old('title') }}">
                            @error('title')
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group @error('published_at') has-error @enderror">
                            <label for="inputData">Data de cadastro</label>
                            <input type="text" name="published_at" class="form-control datepicker" id="inputData" placeholder="" value="{{ isset($file) ? \Carbon\Carbon::parse($file->published_at)->format('d/m/Y') : old('published_at') }}">
                            @error('published_at')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="inputMonth">Data do arquivo</label>
                            <select class="form-control select2" name="month_id" id="inputMonth" style="width: 100%;">
                                @foreach ($months as $item)
                                    <option value="{{ $item->id }}" {{ isset($file) ? (($item->id == $file->month->id) ? 'selected' : '') : '' }}>{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="inputYear"></label>
                            <select class="form-control select2" name="year_id" id="inputYear" style="width: 100%;">
                                @foreach ($years as $item)
                                    <option value="{{ $item->id }}" {{ isset($file) ? (($item->id == $file->year->id) ? 'selected' : '') : '' }}>{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{--<div class="col-lg-6">
                        <div class="form-group @error('registered_at') has-error @enderror">
                            <label for="inputRegister">Data do arquivo</label>
                            <input type="text" name="registered_at" class="form-control datepicker" id="inputRegister" placeholder="" value="{{ isset($file) ? \Carbon\Carbon::parse($file->registered_at)->format('d/m/Y') : old('registered_at') }}">
                            @error('registered_at')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>--}}
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group @error('resumo') has-error @enderror">
                            <label for="inputContent">Resumo</label>
                            <textarea name="resumo" class="form-control conteudo" id="inputContent" placeholder="Resumo do arquivo">{{ isset($file) ? $file->resumo : old('resumo') }}</textarea>
                            @error('resumo')
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
                            <label for="inputOrganizacao">Organizações</label>
                            <select class="form-control select2 organizacao-select" name="organizacao_id" id="inputOrganizacao" style="width: 100%;">
                                <option value="">Selecione uma opção</option>
                                @if(count(\Illuminate\Support\Facades\Auth::user()->organizations) > 0)
                                    <option value="{{ \Illuminate\Support\Facades\Auth::user()->organizations[0]->id }}" selected>{{ \Illuminate\Support\Facades\Auth::user()->organizations[0]->title }}</option>
                                @else
                                    @foreach ($organizacoes as $item)
                                        <option value="{{ $item->id }}" {{ isset($file) ? (($item->id == $file->organizacao->id) ? 'selected' : '') : '' }}>{{ $item->title }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="inputCatorganizacao">Categoria de organização</label>
                            <select class="form-control select2 catorganizacao-select" name="catorganizacao_id" id="inputCatorganizacao" style="width: 100%;">
                                @if(isset($file))
                                    <option value="{{ $file->catorganizacao_id }}" selected>{{ $file->catorganizacao->title }}</option>
                                @elseif(isset($catorganizacoes))
                                    @foreach ($catorganizacoes as $item)
                                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                                    @endforeach
                                @else
                                    <option value="">Selecione a organização</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="inputCategoria">Categorias</label>
                            <select class="form-control select2 categoria-select" name="categoria_id" id="inputCategoria" style="width: 100%;">
                                <option value="">Selecione uma opção</option>
                                @foreach ($categorias as $item)
                                    <option value="{{ $item->id }}" {{ isset($file) ? (($item->id == $file->categoria->id) ? 'selected' : '') : '' }}>{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="inputSubcategoria">Subcategoria</label>
                            <select class="form-control select2 subcategoria-select" name="subcategoria_id" id="inputSubcategoria" style="width: 100%;">
                                @if(isset($file))
                                    <option value="{{ $file->subcategoria_id }}" selected>{{ $file->subcategoria->title }}</option>
                                @else
                                    <option value="">Selecione a categoria</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="inputTag">Tags</label>
                            <select class="form-control select2" multiple name="tags[]" id="inputTags" style="width: 100%;">
                                    @foreach ($tags as $item)
                                        <option value="{{ $item->id }}" {{ isset($file) ? ($file->tags->contains($item) ? 'selected' : '') : '' }}>{{ $item->title }}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group @error('file') has-error @enderror">
                            <label for="inputFile">Arquivo</label>
                            <input type="file" name="file" class="form-control" id="inputFile">
                            @error('file')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            @if(isset($file->file))
                                <a href="{{ url("storage/files/{$file->file}") }}" class="btn btn-primary pull-left" style="margin-top: 10px;" download>
                                    <i class="fa fa-download"></i> Arquivo</a>
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
    <script src="{{ asset('node_modules/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('node_modules/ckfinder/ckfinder.js') }}"></script>
@stop