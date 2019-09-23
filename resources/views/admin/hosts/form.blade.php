@extends('adminlte::page')

@section('title', 'Adicionar servidor')

@section('content_header')

    <h1>Servidores</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
        <li><a href="{{ route('hosts.index') }}">Servidores</a></li>
        <li class="active">{{ isset($host) ? 'Editar servidor' : 'Adicionar servidor' }}</li>
    </ol>

@stop

@section('content')
  <div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">{{ isset($host) ? 'Editar servidor' : 'Adicionar servidor' }}</h3>
    </div>
    <form role="form" method="POST" action="{{ isset($host) ? route('hosts.update', $host->id) : route('hosts.store')}}">
        {!! csrf_field() !!}
        <div class="box-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                        <label for="inputTitle">Nome</label>
                        <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Nome do servidor" value="{{ isset($host) ? $host->title : old('title') }}">
                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="inputPanel">Link do painel</label>
                    <input type="text" name="panel_url" class="form-control" id="inputPanel" placeholder="Link do painel" value="{{ isset($host) ? $host->panel_url : old('panel_url') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="inputEmail">E-mail de contato</label>
                        <input type="email" name="contact_email" class="form-control" id="inputEmail" placeholder="E-mail de contato" value="{{ isset($host) ? $host->contact_email : old('contact_email') }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="inputPhone">Telefone de contato</label>
                        <input type="tel" name="contact_phone" class="form-control telefone" id="inputPhone" placeholder="Telefone de contato" value="{{ isset($host) ? $host->contact_phone : old('contact_phone') }}">
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