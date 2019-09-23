@extends('adminlte::page')

@section('title', 'Atendimentos')

@section('content_header')

    <h1>Atendimentos</h1>

    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
      <li class="active">Atendimentos</li>
  </ol>

@stop

@section('content')
  <div class="box">
    <div class="box-header">
      <a href="{{ route('attendances.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Adicionar</a>
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
          <th>Data de criação</th>
          <th>Nome</th>
          <th>Telefone</th>
          <th>Email</th>
          <th></th>
        </tr>
        </thead>
        <tbody>
          @foreach ($attendances as $attendance)
            <tr>
              <td>{{ \Carbon\Carbon::parse($attendance->created_at)->format('d/m/Y') }}</td>
              <td>{{ $attendance->name }}</td>
              <td>{{ $attendance->phone }}</td>
              <td>{{ $attendance->email }}</td>
              <td class="action">
                <a href="{{ route('attendances.edit', $attendance->id) }}" class="btn btn-primary">Editar</a>
                <form action="{{ route('attendances.destroy', $attendance->id)}}" method="post">
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