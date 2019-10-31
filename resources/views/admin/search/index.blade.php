@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ asset('node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }} ">
@stop

@section('content_header')

    <h1>{{$title}}</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
    </ol>

    <meta name="csrf-token" content="{{ csrf_token() }}">

@stop

@section('content')
    <div class="box">
        <form role="form" method="POST" action="{{ route('search.store')}}" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group @error('title') has-error @enderror">
                            <label for="inputTitle">Título</label>
                            <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Título do arquivo" value="{{ old('title') }}">
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
                        <div class="form-group @error('resumo') has-error @enderror">
                            <label for="inputContent">Resumo</label>
                            <input name="resumo" class="form-control" id="inputContent" placeholder="Resumo do arquivo" value="{{ old('resumo') }}">
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
                            <label for="inputCategoria">Categorias</label>
                            <select class="form-control select2 categoria-select" name="categoria_id" id="inputCategoria" style="width: 100%;">
                                <option value="">Selecione a categoria</option>
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
                                <option value="">Selecione a categoria</option>
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
                                    <option value="{{ $item->id }}" {{ isset($file) ? (($item->id == $file->categoria->id) ? 'selected' : '') : '' }}>{{ $item->title }}</option>
                                @endforeach
                            </select>
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
@stop