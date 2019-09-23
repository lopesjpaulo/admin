@extends('adminlte::page')

@section('title', 'Adicionar cliente')

@section('content_header')

    <h1>Clientes</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
        <li><a href="{{ route('clients.index') }}">Clientes</a></li>
        <li class="active">{{ isset($client) ? 'Editar cliente' : 'Adicionar cliente' }}</li>
    </ol>

@stop

@section('content')
  <div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">{{ isset($client) ? 'Editar cliente' : 'Adicionar cliente' }}</h3>
    </div>
    <form role="form" method="POST" action="{{ isset($client) ? route('clients.update', $client->id) : route('clients.store')}}">
        {!! csrf_field() !!}
        <div class="box-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                        <label for="inputTitle">Nome</label>
                        <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Nome do cliente" value="{{ isset($client) ? $client->title : old('title') }}">
                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="inputSite">Site</label>
                    <input type="text" name="url" class="form-control" id="inputSite" placeholder="Url do site" value="{{ isset($client) ? $client->url : old('url') }}">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="inputData">Data de assinatura</label>
                        <input type="text" name="signed_at" class="form-control datemask" id="inputData" placeholder="" value="{{ isset($client) ? \Carbon\Carbon::parse($client->signed_at)->format('d/m/Y') : old('signed_at') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="inputResp">Responsável</label>
                        <input type="text" name="resp" class="form-control" id="inputResp" placeholder="Nome do contato principal do cliente" value="{{ isset($client) ? $client->resp : old('resp') }}">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="inputCnpj">CNPJ</label>
                        <input type="tel" name="cnpj" class="form-control cnpj" id="inputCnpj" placeholder="CNPJ do cliente" value="{{ isset($client) ? $client->cnpj : old('cnpj') }}">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="inputCpf">CPF</label>
                        <input type="tel" name="resp_cpf" class="form-control cpf" id="inputCpf" placeholder="CPF do responsável" value="{{ isset($client) ? $client->resp_cpf : old('resp_cpf') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="inputEmail">E-mail de contato</label>
                        <input type="email" name="contact_email" class="form-control" id="inputEmail" placeholder="E-mail de contato" value="{{ isset($client) ? $client->contact_email : old('contact_email') }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="inputPhone">Telefone de contato</label>
                        <input type="tel" name="contact_phone" class="form-control telefone" id="inputPhone" placeholder="Telefone de contato" value="{{ isset($client) ? $client->contact_phone : old('contact_phone') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="inputTipo">Tipos de serviços</label>
                        <select class="form-control select2" name="type[]" multiple="multiple" id="inputTipo" data-placeholder="Selecione os serviços"
                        style="width: 100%;">
                            <option value="M" {{ isset($client->type) ? ((strpos($client->type, 'M') !== false) ? 'selected' : '') : '' }}>Manutenção</option>
                            <option value="H" {{ isset($client->type) ? ((strpos($client->type, 'H') !== false) ? 'selected' : '') : '' }}>Hospedagem</option>
                            <option value="SM" {{ isset($client->type) ? ((strpos($client->type, 'SM') !== false) ? 'selected' : '') : '' }}>Social Media</option>
                            <option value="D" {{ isset($client->type) ? ((strpos($client->type, 'D') !== false) ? 'selected' : '') : '' }}>Desenvolvimento</option>
                            <option value="L" {{ isset($client->type) ? ((strpos($client->type, 'L') !== false) ? 'selected' : '') : '' }}>Layout</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="inputAttendance">Responsável pelo atendimento</label>
                        <select class="form-control select2" name="attendance_id" id="inputAttendance" style="width: 100%;">
                            @foreach ($attendances as $item)
                                <option value="{{ $item->id }}" {{ isset($client) ? (($item->id == $client->attendance->id) ? 'selected' : '') : '' }}>{{ $item->name }}</option>
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