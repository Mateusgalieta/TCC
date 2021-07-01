@extends('layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Editar Usuário</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item active">Editar Usuário | {{ $user->name }}</li>
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
                {!!  Form::open(['route' => ['user.update', $user->id], 'method' => 'PUT', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Nome</label>
                    <div class="col-sm-10">
                        {!! Form::text('name', $user->name ?? '', ['class' => 'form-control', 'placeholder' => 'Nome', 'required' => true]); !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        {!! Form::email('email', $user->email ?? '', ['class' => 'form-control', 'placeholder' => 'Email', 'required' => true]); !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputName2" class="col-sm-2 col-form-label">Senha</label>
                    <div class="col-sm-10">
                        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Senha', 'required' => false]); !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputSkills" class="col-sm-2 col-form-label">Data de Nascimento</label>
                    <div class="col-sm-10">
                        {!! Form::date('birthday_date', $user->birthday_date ?? '', ['class' => 'form-control', 'required' => true]) !!}
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
