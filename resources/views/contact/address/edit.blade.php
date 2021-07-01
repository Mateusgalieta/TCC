@extends('layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Editar Endereço</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item active">Editar Endereço</li>
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
                {!!  Form::open(['route' => ['address.update', $contact->id, $address->id], 'method' => 'PUT', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-group">
                        <div class="form-group">
                            <label for="cep">CEP</label>
                            {!! Form::text('cep', $address->cep, ['id' => 'cep', 'class' => 'form-control', 'placeholder' => 'CEP', 'required' => true]); !!}
                        </div>
                        <div class="form-group">
                            <label for="address">Endereço</label>
                            {!! Form::text('address',  $address->address, ['id' => 'address', 'class' => 'form-control', 'placeholder' => 'Endereço', 'required' => true]); !!}
                        </div>
                        <div class="form-group">
                            <label for="neighborhood">Bairro</label>
                            {!! Form::text('neighborhood', $address->neighborhood, ['id' => 'neighborhood', 'class' => 'form-control', 'placeholder' => 'Bairro', 'required' => true]); !!}
                        </div>
                        <div class="form-group">
                            <label for="city">Cidade</label>
                            {!! Form::text('city', $address->city, ['id' => 'city', 'class' => 'form-control', 'placeholder' => 'Cidade', 'required' => true]); !!}
                        </div>
                        <div class="form-group">
                            <label for="state">Estado</label>
                            {!! Form::text('state', $address->state, ['id' => 'state', 'class' => 'form-control', 'placeholder' => 'Estado', 'required' => true]); !!}
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
