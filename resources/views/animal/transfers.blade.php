@extends('layouts.app')

@section('content')
    <!-- /.row -->
    <div class="row">
        <div class="col-12">
          <div class="card">
            {!! Form::open(['method' => 'GET']) !!}
            <div class="card-header">
              <h3 class="card-title">Lista de transferências para aprovação</h3>

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
                    <th>Status</th>
                    <th>Coleira de identificação</th>
                    <th>Organização de origem</th>
                    <th>Organização de destino</th>
                    <th>Nome do animal</th>
                    <th>Categoria do animal</th>
                  </tr>
                </thead>
                @foreach ($transfers_list ?? [] as $transfer)
                    <tbody>
                        <tr>
                            <td>{{ $transfer->status ?? '' }}</td>
                            <td>{{ $transfer->animal->code ?? '' }}</td>
                            <td>{{ $transfer->fromOfOrganization->name ?? '' }}</td>
                            <td>{{ $transfer->toOrganization->name ?? '' }}</td>
                            <td>{{ $transfer->animal->name ?? '' }}</td>
                            <td>{{ $transfer->animal->category->name ?? '' }}</td>
                            <td class="project-actions text-right">
                                @if($transfer->toOrganization == auth()->user()->organization_id)
                                    <a class="btn btn-success btn-sm" href="{{ route('animal.approveTransfer', $transfer->id) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Aprovar Transferência
                                    </a>
                                    <a class="btn btn-danger btn-sm" href="{{ route('animal.refuseTransfer', $transfer->id) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Recusar Transferência
                                    </a>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                @endforeach
              </table>
                <div class="d-flex justify-content-center">
                    {{ $transfers_list->links() }}
                </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- /.row -->


@endsection
