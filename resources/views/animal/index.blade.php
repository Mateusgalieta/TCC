@extends('layouts.app')

@section('content')
    <!-- /.row -->
    <div class="row">
        <div class="col-12">
          <div class="card">
            {!! Form::open(['method' => 'GET']) !!}
            <div class="card-header">
              <h3 class="card-title">Lista de Animais</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">

                  <input type="text" name="search" class="form-control float-right" placeholder="Pesquisar">

                  <div class="input-group-append">
                    <button type="submit" id="search" class="btn btn-default">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            {!! Form::close() !!}

            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th width="150">Código</th>
                    <th>Nome</th>
                    <th>Categoria</th>
                  </tr>
                </thead>
                @foreach ($animal_list ?? [] as $animal)
                    <tbody>
                        <tr>
                            <td>{{ $animal->name ?? '' }}</td>
                            <td class="project-actions text-right">
                                <a class="btn btn-info btn-sm" href="{{ route('animal.edit', $department->id) }}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Editar
                                </a>
                                <a class="btn btn-danger btn-sm" href="{{ route('animal.destroy', $department->id) }}">
                                    <i class="fas fa-trash">
                                    </i>
                                    Excluir
                                </a>
                            </td>
                        </tr>
                    </tbody>
                @endforeach
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- /.row -->


@endsection
