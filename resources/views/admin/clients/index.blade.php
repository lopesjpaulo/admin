@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')

    <h1>Clientes</h1>

    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
      <li class="active">Clientes</li>
  </ol>

@stop

@section('content')
  <div class="box">
    <div class="box-header">
      <a href="{{ route('clients.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Adicionar</a>
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
          <th>Telefone</th>
          <th>E-mail</th>
          <th>Tipo</th>
          <th>Atendimento</th>
          <th></th>
        </tr>
        </thead>
        <tbody>
          @foreach ($clients as $client)
            <tr>
              <td>{{ $client->title }}</td>
              <td>{{ \Carbon\Carbon::parse($client->created_at)->format('d/m/Y') }}</td>
              <td>{{ \Carbon\Carbon::parse($client->signed_at)->format('d/m/Y') }}</td>
              <td>{{ $client->contact_phone }}</td>
              <td>{{ $client->contact_email }}</td>
              <td>{{ $client->type }}</td>
              <td>{{ $client->attendance->name }}</td>
              <td class="action">
                <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-primary">Editar</a>
                <form action="{{ route('clients.destroy', $client->id)}}" method="post">
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