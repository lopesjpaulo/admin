@extends('adminlte::page')

@section('title', 'Servidores')

@section('content_header')

    <h1>Servidores</h1>

    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
      <li class="active">Servidores</li>
  </ol>

@stop

@section('content')
  <div class="box">
    <div class="box-header">
      <a href="{{ route('hosts.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Adicionar</a>
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
          <th>Title</th>
          <th>Data de criação</th>
          <th>URL do painel</th>
          <th>Telefone</th>
          <th>E-mail</th>
          <th></th>
        </tr>
        </thead>
        <tbody>
          @foreach ($hosts as $host)
            <tr>
              <td>{{ $host->title }}</td>
              <td>{{ \Carbon\Carbon::parse($host->created_at)->format('d/m/Y') }}</td>
              <td><a target="_blank" href="{{ $host->panel_url }}">{{ $host->panel_url }}</a></td>
              <td>{{ $host->contact_phone }}</td>
              <td>{{ $host->contact_email }}</td>
              <td class="action">
                <a href="{{ route('hosts.edit', $host->id) }}" class="btn btn-primary">Editar</a>
                <form action="{{ route('hosts.destroy', $host->id)}}" method="post">
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