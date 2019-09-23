@extends('adminlte::page')

@section('title', 'Notícias')

@section('content_header')

    <h1>Notícias</h1>

    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
      <li class="active">Notícias</li>
  </ol>

@stop

@section('content')
  <div class="box">
    <div class="box-header">
      <a href="{{ route('news.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Adicionar</a>
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
          <th>Data de publicação</th>
          <th>Título</th>
          <th>Autor</th>
          <th></th>
        </tr>
        </thead>
        <tbody>
          @foreach ($news as $new)
            @can('view_news', $new)
            <tr>
              <td>{{ convertdata_tosite($new->created_at) }}</td>
              <td>{{ convertdata_tosite($new->published_at) }}</td>
              <td>{{ $new->title }}</td>
              <td>{{ $new->author }}</td>
              <td class="action">
                @can('edit_news', $new)
                <a href="{{ route('news.edit', $new->id) }}" class="btn btn-primary">Editar</a>
                @endcan
                <form action="{{ route('news.destroy', $new->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
              </td>
            </tr>
            @endcan
          @endforeach
        </tbody>
      </table>

      {!! $news->links() !!}

    </div>
    <!-- /.box-body -->
  </div>
@stop