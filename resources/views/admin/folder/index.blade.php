@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/jQuery-file-explore/css/file-explore.css') }} ">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@stop

@section('title', $title)

@section('content_header')

    <h1>{{$title}}</h1>

    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
        <li class="active">{{$title}}</li>
    </ol>

    <meta name="csrf-token" content="{{ csrf_token() }}">

@stop

@section('content')
    <div class="box-body">
        @if(isset($folders))
            @foreach($folders as $item)
                <div class="folder">
                    <i class="material-icons
                        {{ $class }}"
                       data-id="{{ $item->id }}">folder</i>
                    <h1>{{ $item->title }}</h1>
                </div>
            @endforeach
        @else
            @foreach($files as $item)
                <a href="{{ ($item->file) ? route('files.show', $item->id) : '#' }}">
                    <div class="folder">
                        <i class="material-icons file-folder" data-id="{{ $item->id }}">file_copy</i>
                        <h1 style="top: -20px">{{ $item->title }}</h1>
                    </div>
                </a>
        @endforeach
        @endif
    </div>
@stop

@section('js')
    <script src="{{ asset('plugins/jQuery-file-explore/js/file-explore.js') }}"></script>
@stop