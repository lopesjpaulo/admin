@extends('adminlte::page')

@section('title', 'Adicionar atendimento')

@section('content_header')

    <h1>Atendimentos</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
        <li><a href="{{ route('attendances.index') }}">Atendimentos</a></li>
        <li class="active">{{ isset($attendance) ? 'Editar atendimento' : 'Adicionar atendimento' }}</li>
    </ol>

@stop

@section('content')
  <div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">{{ isset($attendance) ? 'Editar atendimento' : 'Adicionar atendimento' }}</h3>
    </div>
    <form role="form" method="POST" action="{{ isset($attendance) ? route('attendances.update', $attendance->id) : route('attendances.store')}}">
        {!! csrf_field() !!}
        <div class="box-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="inputName">Nome</label>
                        <input type="text" name="name" class="form-control" id="inputName" placeholder="Nome do atendimento" value="{{ isset($attendance) ? $attendance->name : old('name') }}">
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="inputUser">Usuário</label>
                        <select class="form-control select2" name="user_id" id="inputUser" style="width: 100%;">
                            @foreach ($users as $item)
                                <option value="{{ $item->id }}" {{ ($item->id == $attendance->user->id) ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="inputEmail">E-mail de contato</label>
                        <input type="email" name="email" class="form-control" id="inputEmail" placeholder="E-mail de contato" value="{{ isset($attendance) ? $attendance->email : old('email') }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="inputPhone">Telefone de contato</label>
                        <input type="tel" name="phone" class="form-control telefone" id="inputPhone" placeholder="Telefone de contato" value="{{ isset($attendance) ? $attendance->phone : old('phone') }}">
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" class="btn-block btn-lg btn-success">Enviar</button>
        </div>
    </form>
  </div>
@stop