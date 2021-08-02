@extends('layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Adicionar Organização</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item active">Adicionar Organização</li>
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
                    {!!  Form::open(['route' => ['organization.create'], 'method' => 'POST', 'class' => 'form-horizontal', 'id' => 'registerForm', 'enctype' => 'multipart/form-data']) !!}
                        <div class="form-group">
                            <label for="name">Nome</label>
                            {!! Form::text('name', '', ['id' => 'name', 'class' => 'form-control', 'placeholder' => 'Nome', 'required' => true]); !!}
                        </div>
                        <div class="form-group">
                            <label for="document">CNPJ</label>
                            {!! Form::text('document', '', ['id' => 'document', 'class' => 'form-control', 'placeholder' => 'CNPJ', 'required' => true]); !!}
                        </div>
                        <div class="form-group">
                            <label for="cep">CEP</label>
                            {!! Form::text('cep', '', ['id' => 'cep', 'class' => 'form-control', 'placeholder' => 'CEP', 'required' => true]); !!}
                        </div>
                        <div class="form-group">
                            <label for="city">Cidade</label>
                            {!! Form::text('city', '', ['id' => 'city', 'class' => 'form-control', 'placeholder' => 'Cidade', 'required' => true]); !!}
                        </div>
                        <div class="form-group">
                            <label for="state">Estado</label>
                            {!! Form::text('state', '', ['id' => 'state', 'class' => 'form-control', 'placeholder' => 'Estado', 'required' => true]); !!}
                        </div>
                </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <input type="submit" id="saveBtn" value="Adicionar" class="btn btn-success float-right">
        {!! Form::close() !!}

        <div class="alert col-4" id="resultRequest" role="alert">

        </div>

    </section>
    <!-- /.content -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#cep").blur(function(){
                var cep = $(this).val().replace(/[^0-9]/, '');
                if(cep){
                    var url = 'https://correiosapi.apphb.com/cep/' + cep;
                    var url = 'https://viacep.com.br/ws/' + cep + '/json/';
                    $.ajax({
                            url: url,
                            dataType: 'jsonp',
                            crossDomain: true,
                            contentType: "application/json",
                            success : function(json){
                                if(json.localidade){
                                    $("#city").val(json.localidade);
                                    $("#state").val(json.uf);
                                }
                            }
                    });
                }
            });
        });
    </script>


@endsection
