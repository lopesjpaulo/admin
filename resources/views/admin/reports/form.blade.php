@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ asset('node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }} ">
@stop

@section('title', $subtitle)

@section('content_header')

    <h1>{{$title}}</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
        <li><a href="{{ route('reports.index') }}">{{$title}}</a></li>
        <li class="active">{{ $subtitle }}</li>
    </ol>

    <meta name="csrf-token" content="{{ csrf_token() }}">

@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $subtitle }}</h3>
        </div>
        <form role="form" method="POST" action="{{ isset($report) ? route('reports.update', $report->id) : route('reports.store')}}" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group @error('title') has-error @enderror">
                            <label for="inputTitle">Título</label>
                            <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Título do relatório" value="{{ isset($report) ? $report->title : old('title') }}">
                            @error('title')
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group @error('gestor') has-error @enderror">
                            <label for="inputGestor">Gestor</label>
                            <input type="text" name="gestor" class="form-control" id="inputGestor" placeholder="Gestor" value="{{ isset($report) ? $report->gestor : old('gestor') }}">
                            @error('gestor')
                            <span class="help-block">
                                <strong>{{ $errors->first('gestor') }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group @error('processo') has-error @enderror">
                            <label for="inputProcesso">Processo</label>
                            <input type="text" name="processo" class="form-control" id="inputProcesso" placeholder="Processo" value="{{ isset($report) ? $report->processo : old('processo') }}">
                            @error('processo')
                            <span class="help-block">
                                <strong>{{ $errors->first('processo') }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group @error('published_at') has-error @enderror">
                            <label for="inputData">Data de início estimada</label>
                            <input type="text" name="data_inicio" class="form-control datepicker" id="inputData" placeholder="" value="{{ isset($report) ? \Carbon\Carbon::parse($report->data_inicio)->format('d/m/Y') : old('data_inicio') }}">
                            @error('data_inicio')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group @error('registered_at') has-error @enderror">
                            <label for="inputRegister">Data de término estimada</label>
                            <input type="text" name="data_final" class="form-control datepicker" id="inputRegister" placeholder="" value="{{ isset($report->data_final) ? \Carbon\Carbon::parse($report->data_final)->format('d/m/Y') : old('data_final') }}">
                            @error('data_final')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group @error('abrangencia') has-error @enderror">
                            <label for="inputAbrangencia">Abrangência</label>
                            <input type="text" name="abrangencia" class="form-control" id="inputAbrangencia" placeholder="Abrangência" value="{{ isset($report) ? $report->abrangencia : old('abrangencia') }}">
                            @error('abrangencia')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group @error('conteudo') has-error @enderror">
                            <label for="inputContent">Conteúdo</label>
                            <textarea name="conteudo" class="form-control conteudo" id="inputContent" placeholder="Resumo do arquivo">{{ isset($report) ? $report->conteudo : old('conteudo') }}</textarea>
                            @error('conteudo')
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
                                        <option value="{{ $item->id }}" {{ isset($report) ? (($item->id == $report->organizacao->id) ? 'selected' : '') : '' }}>{{ $item->title }}</option>
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
                                @if(isset($report))
                                    <option value="{{ $report->catorganizacao_id }}" selected>{{ $report->catorganizacao->title }}</option>
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
                            <label for="inputStatus">Status</label>
                            <select class="form-control select2" name="status" id="inputStatus" style="width: 100%;">
                                <option value="1" {{ isset($report) ? (($report->status == 1) ? 'selected' : '') : '' }}>Em execução</option>
                                <option value="2" {{ isset($report) ? (($report->status == 2) ? 'selected' : '') : '' }}>Finalizado</option>
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
    <script src="{{ asset('node_modules/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('node_modules/ckfinder/ckfinder.js') }}"></script>
@stop