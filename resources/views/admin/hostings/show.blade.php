@extends('adminlte::page')

@section('title', 'Visualizar hospedagem')

@section('content_header')

    <h1>Hospedagens</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
        <li><a href="{{ route('hostings.index') }}">Hospedagens</a></li>
        <li class="active">Visualizar hospedagem</li>
    </ol>

@stop

@section('content')
  <div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Visualizar hospedagem</h3>
    </div>
    <form role="form">
        {!! csrf_field() !!}
        <div class="box-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="inputClient">Cliente</label>
                        <select class="form-control select2" id="inputClient" style="width: 100%;" disabled>
                            <option>{{ $hosting->client->title }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="inputData">Data de assinatura</label>
                        <input type="text" class="form-control datemask" id="inputData" disabled value="{{ \Carbon\Carbon::parse($hosting->signed_at)->format('d/m/Y') }}">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="inputDataexpired">Data de expiração</label>
                        <input type="text" name="expired_at" class="form-control datemask" id="inputDataexpired" disabled value="{{ \Carbon\Carbon::parse($hosting->expired_at)->format('d/m/Y') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="inputHost">Host</label>
                        <select class="form-control select2" id="inputHost" style="width: 100%;" disabled>
                            <option>{{ $hosting->host->title }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="inputAmount">Valor</label>
                        <input type="tel" class="form-control amount" id="inputAmount" value="{{ $hosting->amount }}" disabled>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="inputTipo">Tipos de hospedagem</label>
                        <select class="form-control select2" id="inputTipo" style="width: 100%;" disabled>
                            <option>{{ $hosting->type }}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="inputLogin">Login</label>
                        <input type="text" class="form-control" id="inputLogin" value="{{ $hosting->login }}" disabled>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="inputPassword">Senha</label>
                        <input type="text" class="form-control" id="inputPassword" value="{{ $hosting->password }}" disabled>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </form>
  </div>
@stop