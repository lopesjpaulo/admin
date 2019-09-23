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
            @can('create_questions', \App\Models\Question::class)
                <a href="{{ route('questions.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Adicionar</a>
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
                    <th>Id</th>
                    <th>Data de criação</th>
                    <th>Título</th>
                    <th>Tema</th>
                    <th>Tipo</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($questions as $question)
                    <tr>
                        <td>{{ $question->id }}</td>
                        <td>{{ convertdata_tosite($question->created_at) }}</td>
                        <td>{{ $question->title }}</td>
                        <td>{{ $question->theme->title }}</td>
                        <td>{{ isset($question->type->title) ? $question->type->title : ' - ' }}</td>
                        <td class="action">
                            <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-primary">Editar</a>
                            <form action="{{ route('questions.destroy', $question->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {!! $questions->links() !!}

        </div>
        <!-- /.box-body -->
    </div>
@stop