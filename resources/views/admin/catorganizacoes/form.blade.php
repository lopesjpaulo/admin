@extends('adminlte::page')

@section('title', $subtitle)

@section('content_header')

    <h1>{{$title}}</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
        <li><a href="{{ route('catorganizacoes.index') }}">{{$title}}</a></li>
        <li class="active">{{ $subtitle }}</li>
    </ol>

@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $subtitle }}</h3>
        </div>
        <form role="form" method="POST" action="{{ isset($catorganizacao) ? route('catorganizacoes.update', $catorganizacao->id) : route('catorganizacoes.store')}}" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group @error('title') has-error @enderror">
                            <label for="inputTitle">Título</label>
                            <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Título da categoria" value="{{ isset($catorganizacao) ? $catorganizacao->title : old('title') }}">
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
                            <label for="inputResumo">Resumo</label>
                            <textarea type="text" name="resumo" class="form-control" id="inputResumo" placeholder="Resumo da categoria">{{ isset($catorganizacao) ? $catorganizacao->resumo : old('resumo') }}</textarea>
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
                        <div class="form-group">
                            <label for="inputOrganizacao">Organizações</label>
                            <select class="form-control select2" name="organizacao_id" id="inputOrganizacao" style="width: 100%;">
                                @foreach ($organizacoes as $item)
                                    <option value="{{ $item->id }}" {{ isset($catorganizacao) ? (($item->id == $catorganizacao->organizacao->id) ? 'selected' : '') : '' }}>{{ $item->title }}</option>
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