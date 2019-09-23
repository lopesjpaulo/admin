@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ asset('node_modules/bootstrap3-wysihtml5-npm/dist/bootstrap3-wysihtml5.min.css') }}">
@stop

@section('title', $subtitle)

@section('content_header')

    <h1>{{$title}}</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
        <li><a href="{{ route('questions.index') }}">{{$title}}</a></li>
        <li class="active">{{ $subtitle }}</li>
    </ol>

    <meta name="csrf-token" content="{{ csrf_token() }}">

@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $subtitle }}</h3>
        </div>
        <form role="form" method="POST" action="{{ isset($question) ? route('questions.update', $question->id) : route('questions.store')}}" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group @error('title') has-error @enderror">
                            <label for="inputTitle">Descrição</label>
                            <textarea name="title" class="form-control ckeditor" placeholder="Descrição da questão">{{ isset($question) ? $question->title : old('title') }}</textarea>
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
                            <label>Alternativas (marque a alternativa certa)</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                  <input type="radio" name="choose" value="0" {{ isset($alternatives) ? (($alternatives[0]->choose == 1) ? 'checked' : '') : '' }}>
                                </span>
                                <textarea name="title_question[]" class="form-control ckeditor">{{ isset($alternatives) ? $alternatives[0]->title : '' }}</textarea>
                            </div><br>
                            <div class="input-group">
                                <span class="input-group-addon">
                                  <input type="radio" name="choose" value="1" {{ isset($alternatives) ? (($alternatives[1]->choose == 1) ? 'checked' : '') : '' }}>
                                </span>
                                <textarea name="title_question[]" class="form-control ckeditor">{{ isset($alternatives) ? $alternatives[1]->title : '' }}</textarea>
                            </div><br>
                            <div class="input-group">
                                <span class="input-group-addon">
                                  <input type="radio" name="choose" value="2" {{ isset($alternatives) ? (($alternatives[2]->choose == 1) ? 'checked' : '') : '' }}>
                                </span>
                                <textarea name="title_question[]" class="form-control ckeditor">{{ isset($alternatives) ? $alternatives[2]->title : '' }}</textarea>
                            </div><br>
                            <div class="input-group">
                                <span class="input-group-addon">
                                  <input type="radio" name="choose" value="3" {{ isset($alternatives) ? (($alternatives[3]->choose == 1) ? 'checked' : '') : '' }}>
                                </span>
                                <textarea name="title_question[]" class="form-control ckeditor">{{ isset($alternatives) ? $alternatives[3]->title : '' }}</textarea>
                            </div><br>
                            <div class="input-group">
                                <span class="input-group-addon">
                                  <input type="radio" name="choose" value="4" {{ isset($alternatives) ? (($alternatives[4]->choose == 1) ? 'checked' : '') : '' }}>
                                </span>
                                <textarea name="title_question[]" class="form-control ckeditor">{{ isset($alternatives) ? $alternatives[4]->title : '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="inputNivel">Nível</label>
                            <select class="form-control select2" name="nivel" id="inputNivel" style="width: 100%;">
                                <option value="1" {{ isset($question) ? (($question->nivel == 1) ? 'selected' : '') : '' }}>Nível 1</option>
                                <option value="2" {{ isset($question) ? (($question->nivel == 2) ? 'selected' : '') : '' }}>Nível 2</option>
                                <option value="3" {{ isset($question) ? (($question->nivel == 3) ? 'selected' : '') : '' }}>Nível 3</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group {{ $errors->has('link') ? 'has-error' : '' }}">
                            <label for="inputLink">Link do vídeo da resolução da questão</label>
                            <input type="text" name="link" class="form-control" id="inputLink" placeholder="Link do vídeo da resolução da questão" value="{{ isset($question) ? $question->link : old('link') }}">
                            @if ($errors->has('link'))
                                <span class="help-block">
                                <strong>{{ $errors->first('link') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="inputPlus">André resolve</label>
                            <select class="form-control select2" name="plus" id="inputPlus" style="width: 100%;">
                                <option value="0" {{ isset($question) ? (($question->plus == 0) ? 'selected' : '') : '' }}>Não</option>
                                <option value="1" {{ isset($question) ? (($question->plus == 1) ? 'selected' : '') : '' }}>Sim</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="inputTheme">Tema</label>
                            <select class="form-control select2 theme-select" name="theme_id" id="inputTheme" style="width: 100%;">
                                @foreach ($temas as $item)
                                    <option value="{{ $item->id }}" {{ isset($question) ? (($item->id == $question->theme->id) ? 'selected' : '') : '' }}>{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="inputType">Tipos</label>
                            <select class="form-control select2 type-select" name="type_id" id="inputType" style="width: 100%;">
                                <option value="">Selecione o tema</option>
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
    <script src="{{ asset('node_modules/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('node_modules/ckfinder/ckfinder.js') }}"></script>
@stop
