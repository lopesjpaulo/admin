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
    <div class="box box-primary">
        <form role="form" method="POST" action="{{ route('files.storeshare', $file->id)}}" enctype="multipart/form-data">
            {!! csrf_field() !!}
            {{ Form::hidden('file_id', $file->id) }}
            <div class="box-body">
                <table class="table table-bordered table-striped data-table">
                    <caption><h2>Usuários para atribuir o arquivo</h2></caption>
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Acessar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ Form::checkbox('users[]', $user->id, ($user->files->contains($file->id)) ? true : false) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn-block btn-lg btn-success">Enviar</button>
                </div>
            </div>
        </form>
    </div>
@stop