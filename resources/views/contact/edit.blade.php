@extends('layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Editar Contato</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item active">Editar Contato | {{ $contact->name }}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Informações Gerais</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
                {!!  Form::open(['route' => ['contact.update', $contact->id], 'method' => 'PUT', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-group">
                        <label for="inputName">Nome do Contato</label>
                        {!! Form::text('name', $contact->name, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Nome', 'required' => true]); !!}
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="category">Categoria</label>
                            </div>
                            <select name="category_id" class="custom-select" id="category">
                                <option selected>Categoria</option>
                                @foreach ($categories_list as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $contact->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Foto</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" name="avatar_url" class="custom-file-input" id="inputGroupFile01">
                            <label class="custom-file-label" for="inputGroupFile01">Escolher arquivo</label>
                        </div>
                    </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <input type="submit" value="Editar" class="btn btn-success float-right">
      {!! Form::close() !!}

    </section>
    <!-- /.content -->

@endsection
