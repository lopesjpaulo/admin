@extends('adminlte::page')

@section('title', 'Adicionar hospedagem')

@section('content_header')

    <h1>Hospedagens</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
        <li><a href="{{ route('hostings.index') }}">Hospedagens</a></li>
        <li class="active">{{ isset($hosting) ? 'Editar hospedagem' : 'Adicionar hospedagem' }}</li>
    </ol>

@stop

@section('content')
  <div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">{{ isset($hosting) ? 'Editar hospedagem' : 'Adicionar hospedagem' }}</h3>
    </div>
    <form role="form" method="POST" action="{{ isset($hosting) ? route('hostings.update', $hosting->id) : route('hostings.store')}}">
        {!! csrf_field() !!}
        <div class="box-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="inputClient">Cliente</label>
                        <select class="form-control select2" name="client_id" id="inputClient" style="width: 100%;">
                            @foreach ($clients as $item)
                                <option value="{{ $item->id }}" {{ isset($hosting) ? (($item->id == $hosting->client->id) ? 'selected' : '') : '' }}>{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="inputData">Data de assinatura</label>
                        <input type="text" name="signed_at" class="form-control datemask" id="inputData" placeholder="" value="{{ isset($hosting) ? \Carbon\Carbon::parse($hosting->signed_at)->format('d/m/Y') : old('signed_at') }}">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="inputDataexpired">Data de expiração</label>
                        <input type="text" name="expired_at" class="form-control datemask" id="inputDataexpired" placeholder="" value="{{ isset($hosting) ? \Carbon\Carbon::parse($hosting->expired_at)->format('d/m/Y') : old('expired_at') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="inputHost">Host</label>
                        <select class="form-control select2" name="host_id" id="inputHost" style="width: 100%;">
                            @foreach ($hosts as $item)
                                <option value="{{ $item->id }}" {{ isset($hosting) ? (($item->id == $hosting->host->id) ? 'selected' : '') : '' }}>{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="inputAmount">Valor</label>
                        <input type="tel" name="amount" class="form-control amount" id="inputAmount" placeholder="Valor da hospedagem" value="{{ isset($hosting) ? $hosting->amount : old('amount') }}">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="inputTipo">Tipos de hospedagem</label>
                        <select class="form-control select2" name="type" id="inputTipo" data-placeholder="Selecione o tipo de hospedagem"
                        style="width: 100%;">
                            <option value="FTP" {{ isset($hosting->type) ? ((strpos($hosting->type, 'FTP') !== false) ? 'selected' : '') : '' }}>FTP</option>
                            <option value="SFTP" {{ isset($hosting->type) ? ((strpos($hosting->type, 'SFTP') !== false) ? 'selected' : '') : '' }}>SFTP</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="inputLogin">Login</label>
                        <input type="text" name="login" class="form-control" id="inputLogin" placeholder="Login da hospedagem" value="{{ isset($hosting) ? $hosting->login : old('login') }}">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="inputPassword">Senha</label>
                        <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Senha da hospedagem" value="{{ isset($hosting) ? $hosting->password : old('password') }}">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label for="inputPasswordConfirm">Confirmar senha</label>
                        <input type="password" name="password_confirmation" class="form-control" id="inputPasswordConfirm" placeholder="Confirme a senha">
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