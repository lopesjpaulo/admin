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
            @can("create_".$module, App\Contact::class)
                <a href="{{ route('contacts.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Adicionar</a>
            @endcan
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
                            <a href="{{ route('contacts.show', $item->id) }}" class="btn btn-primary">Vizualizar</a>
                            <form action="{{ route('contacts.destroy', $item->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                @can("delete_".$module, App\Contact::class)
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                @endcan
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