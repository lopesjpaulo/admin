@extends('adminlte::page')

@section('title', $title)

@section('content_header')

    <h1>{{$title}}</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
        <li class="active">{{$title}}</li>
    </ol>

@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <a href="{{ route('disciplines.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Adicionar</a>
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
                    <th>Id</th>
                    <th>Data de criação</th>
                    <th>Título</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($disciplines as $discipline)
                    <tr>
                        <td>{{ $discipline->id }}</td>
                        <td>{{ convertdata_tosite($discipline->created_at) }}</td>
                        <td>{{ $discipline->title }}</td>
                        <td class="action">
                            <a href="{{ route('disciplines.edit', $discipline->id) }}" class="btn btn-primary">Editar</a>
                            <form action="{{ route('disciplines.destroy', $discipline->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {!! $disciplines->links() !!}

        </div>
        <!-- /.box-body -->
    </div>
@stop