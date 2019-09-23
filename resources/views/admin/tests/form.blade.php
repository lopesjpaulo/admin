@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ asset('node_modules/bootstrap3-wysihtml5-npm/dist/bootstrap3-wysihtml5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/multi-select/css/multi-select.css') }}">
@stop

@section('title', $subtitle)

@section('content_header')

    <h1>{{$title}}</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
        <li><a href="{{ route('tests.index') }}">{{$title}}</a></li>
        <li class="active">{{ $subtitle }}</li>
    </ol>

    <meta name="csrf-token" content="{{ csrf_token() }}">

@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $subtitle }}</h3>
        </div>
        <form role="form" method="POST" action="{{ isset($test) ? route('tests.update', $test->id) : route('tests.store')}}" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label for="inputTitle">Título do simulado</label>
                            <input type="text" name="title" class="form-control" id="inputTitle" value="{{ isset($test) ? $test->title : old('title') }}">
                            @if ($errors->has('title'))
                                <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group @error('title') has-error @enderror">
                            <label for="inputTitle">Descrição</label>
                            <textarea name="description" class="form-control conteudo" id="inputTitle" placeholder="Descrição da questão">{{ isset($test) ? $test->title : old('title') }}</textarea>
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
                        <div class="form-group {{ $errors->has('time') ? 'has-error' : '' }}">
                            <label for="inputTime">Tempo de resposta (em minutos)</label>
                            <input type="number" name="time" class="form-control" id="inputTime" value="{{ isset($test) ? $test->time : old('time') }}">
                            @if ($errors->has('time'))
                                <span class="help-block">
                                <strong>{{ $errors->first('time') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="inputTheme">Tema</label>
                            <select class="form-control select2 theme-questions" name="theme_id" id="inputTheme" style="width: 100%;">
                                <option value="">Selecione um tema para carregar as questõss</option>
                                @foreach ($temas as $item)
                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <!--
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="inputQuestion">Questão</label>
                            <div class="input-group">
                                <select class="form-control select2 question-select" name="question_id" id="inputQuestion" style="width: 100%;">
                                    <option value="">Selecione o tema</option>
                                </select>
                                <span class="input-group-btn">
                                  <button type="button" class="btn btn-success btn-flat">Adicionar</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>-->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="inputQuestion">Questões</label>
                            <select multiple="multiple" id="my-select" name="question_id[]">
                                @if($test && $test->questions)
                                    @foreach($test->questions as $question)
                                    <option selected value="{{ $question->id }}">{{ strip_tags($question->title) }}</option>
                                    @endforeach
                                @endif
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
    <script src="{{ asset('node_modules/bootstrap3-wysihtml5-npm/dist/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <script src="{{ asset('plugins/multi-select/js/jquery.multi-select.js') }}"></script>
@stop
