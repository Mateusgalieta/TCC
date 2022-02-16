@extends('layouts.app')

@section('content')
    <!-- /.row -->
    <div class="row">
        <div class="col-12">
          <div class="card">
            {!! Form::open(['method' => 'GET']) !!}
            <div class="card-header">
              <h3 class="card-title">Lista de Resgates</h3>

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
              <div style="float:right">
                <a class="btn btn-danger btn-sm" style="margin-right: 10px;" href="{{  route('rescue.pdfExport')  }}">
                    <i class="fas fa-file-pdf"></i>
                    </i>
                    Exp. PDF
                </a>
                <a class="btn btn-success btn-sm" href="{{  route('rescue.excelExport')  }}" style="margin-right: 10px;">
                    <i class="fas fa-file-excel"></i>
                    </i>
                    Exp. Excel
                </a></div>
            </div>
            {!! Form::close() !!}

            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>Status</th>
                    <th>Nome do Denunciador</th>
                    <th>Nome do animal</th>
                    <th>Cidade</th>
                    <th>Estado</th>
                  </tr>
                </thead>
                @foreach ($rescues_list ?? [] as $rescue)
                    <tbody>
                        <tr>
                            <td class="table-success" style="color: #FFF;">{{ $rescue->status ?? '' }}</td>
                            <td>{{ $rescue->reporter ?? '' }}</td>
                            <td>{{ $rescue->animal_name ?? '' }}</td>
                            <td>{{ $rescue->address ? $rescue->address->city : '' }}</td>
                            <td>{{ $rescue->address ? $rescue->address->state : '' }}</td>
                            <td class="project-actions text-right">
                                <a class="btn btn-info btn-sm" href="{{ route('rescue.intern.edit', $rescue->id) }}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Editar
                                </a>
                                <a class="btn btn-danger btn-sm" href="{{ route('rescue.intern.destroy', $rescue->id) }}">
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
                    {{ $rescues_list->links() }}
                </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- /.row -->


@endsection
