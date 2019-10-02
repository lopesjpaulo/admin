@extends('adminlte::page')

@section('title', 'Contatos')

@section('content_header')

    <h1>Contatos</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
        <li><a href="{{ route('contacts.index') }}">Contatos</a></li>
        <li class="active">Visualizar contato</li>
    </ol>

@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Visualizar contato</h3>
        </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="inputTitle">Nome</label>
                            <input type="text" name="title" class="form-control" id="inputTitle" disabled value="{{ $contact->name }}">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="inputPhone">Telefone</label>
                            <input type="text" name="phone" class="form-control" id="inputPhone" disabled value="{{ $contact->phone }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="inputEmail">Email</label>
                            <input type="text" name="email" class="form-control" id="inputEmail" disabled value="{{ $contact->email }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="inputSubject">Assunto</label>
                            <input type="text" name="subject" class="form-control" id="inputSubject" disabled value="{{ $contact->subject }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="inputContent">Conteúdo</label>
                            <textarea rows="4" name="content" class="form-control" id="inputContent" disabled>{{ $contact->content }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
    </div>
@stop