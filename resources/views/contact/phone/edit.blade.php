@extends('layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Editar Telefone/Celular</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item active">Editar Telefone/Celular | {{ $phone->name }}</li>
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
                {!!  Form::open(['route' => ['phone.update', $contact->id, $phone->id], 'method' => 'PUT', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-group">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="type">Tipo</label>
                                </div>
                                <select name="type" class="custom-select" id="type">
                                    <option value="">Selecione</option>
                                    <option value="1" {{ $phone->type == 1 ? 'selected' : '' }}>Telefone</option>
                                    <option value="2" {{ $phone->type == 2 ? 'selected' : '' }}>Celular</option>
                                </select>
                            </div>
                        </div>

                        <label for="inputName">Telefone/Celular (55+ddd+numero) E164</label>
                        {!! Form::text('phone', $phone ? $phone->phone : '', ['id' => 'phone', 'class' => 'form-control', 'placeholder' => 'Nome', 'required' => true]); !!}
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

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}

    {{-- <script type="text/javascript">
        $(document).ready(function(){
            var type = $('#type').val();

            if(type == 1){
                $('#phone').mask('(00) 0000 0000');
            }
            else {
                $('#phone').mask('(00) 00000 0000');
            }
        });
    </script> --}}

@endsection
