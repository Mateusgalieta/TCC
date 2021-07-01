@extends('layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Adicionar Contato</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item active">Adicionar Contato</li>
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
                {!!  Form::open(['route' => 'contact.create', 'method' => 'POST', 'class' => 'form-horizontal', 'id' => 'registerForm', 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-group">
                        <label for="inputName">Nome do Contato</label>
                        {!! Form::text('name', '', ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Nome', 'required' => true]); !!}
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="category">Categoria</label>
                            </div>
                            <select name="category_id" class="custom-select" id="category">
                                <option selected>Categoria</option>
                                @foreach ($categories_list as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
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
      <input type="submit" id="saveBtn" value="Adicionar" class="btn btn-success float-right">
      {!! Form::close() !!}

        <div class="alert col-4" id="resultRequest" role="alert">

        </div>

    </section>
    <!-- /.content -->



    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <script type="text/javascript">

        $('#saveBtn').click(function(){
            var content = $('#registerForm').serialize();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "{!! route('contact.create') !!}",
                data: content,
                    success: function(response){
                        if(response.status == 'success'){
                            $('#resultRequest').html('Criado com sucesso!');
                            $('#resultRequest').addClass("alert-success");
                        } else {
                            $('#resultRequest').html("Ocorreu um erro!");
                            $('#resultRequest').addClass("alert-danger");
                        }

                    },
                error: function(error){
                    $('#resultRequest').html(error.responseText);
                    $('#resultRequest').addClass("alert-danger");
                }
            });

        });




    </script> --}}


@endsection
