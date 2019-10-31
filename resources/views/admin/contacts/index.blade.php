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
        <div class="box-body">
            <table class="table table-bordered table-striped data-table">
                <thead>
                <tr>
                    <th>Data de criação</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Lido</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($lista as $item)
                    <tr>
                        <td>{{ convertdata_tosite($item->created_at) }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->lido ? 'Lido' : "Não lido" }}</td>
                        <td class="action">
                            <a href="{{ route('contatos.show', $item->id) }}" class="btn btn-primary">Vizualizar</a>
                            <form action="{{ route('contatos.destroy', $item->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {!! $lista->links() !!}

        </div>
        <!-- /.box-body -->
    </div>
@stop