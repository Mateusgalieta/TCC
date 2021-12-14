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
                            <td>{{ $animal->code ?? '' }}</td>
                            <td>{{ $animal->name ?? '' }}</td>
                            <td>{{ $animal->category->name ?? '' }}</td>
                            <td class="project-actions text-right">
                                <a class="btn btn-info btn-sm" href="{{ route('animal.edit', $animal->id) }}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Editar
                                </a>
                                @if ($animal->rescueAddress)
                                    <a class="btn btn-warning btn-sm" href="{{ route('address.edit', $animal->rescueAddress->id) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        End. Resgate
                                    </a>
                                @endif
                                <a class="btn btn-danger btn-sm" href="{{ route('animal.destroy', $animal->id) }}">
                                    <i class="fas fa-trash">
                                    </i>
                                    Excluir
                                </a>
                            </td>
                        </tr>
                    </tbody>
                @endforeach
              </table>
                <div class="d-flex justify-content-center">
                    {{ $animal_list->links() }}
                </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- /.row -->


@endsection
