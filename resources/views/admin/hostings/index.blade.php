@extends('adminlte::page')

@section('title', 'Hospedagens')

@section('content_header')

    <h1>Hospedagens</h1>

    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
      <li class="active">Hospedagens</li>
  </ol>

@stop

@section('content')
  <div class="box">
    <div class="box-header">
      <a href="{{ route('hostings.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Adicionar</a>
    </div>
    @if(session()->has('success'))
      <div class="box-body">
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
      </div>
    @endif
    <div class="box-body">
      <table class="table table-bordered table-striped data-table">
        <thead>
        <tr>
          <th>Cliente</th>
          <th>Data de criação</th>
          <th>Data de assinatura</th>
          <th>Data de expiração</th>
          <th>Servidor</th>
          <th>Valor</th>
          <th></th>
        </tr>
        </thead>
        <tbody>
          @foreach ($hostings as $hosting)
            <tr>
              <td>{{ $hosting->client->title }}</td>
              <td>{{ \Carbon\Carbon::parse($hosting->created_at)->format('d/m/Y') }}</td>
              <td>{{ \Carbon\Carbon::parse($hosting->signed_at)->format('d/m/Y') }}</td>
              <td>{{ \Carbon\Carbon::parse($hosting->expired_at)->format('d/m/Y') }}</td>
              <td>{{ $hosting->host->title }}</td>
              <td>{{ $hosting->amount }}</td>
              <td class="action">
                <a href="hostings/mail/{{ $hosting->id }}" class="btn btn-warning">E-mail</a>
                <a href="{{ route('hostings.show', $hosting->id) }}" class="btn btn-success">Mostrar</a>
                <a href="{{ route('hostings.edit', $hosting->id) }}" class="btn btn-primary">Editar</a>
                <form action="{{ route('hostings.destroy', $hosting->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
@stop