@extends('layouts.app')

@section('content')
    <!-- /.row -->
    <div class="row">
        <div class="col-12">
          <div class="card">
            {!! Form::open(['method' => 'GET']) !!}
            <div class="card-header">
              <h3 class="card-title">Lista de Contatos</h3>

                <a style="margin-left: 20px; heigth: 10px;" class="btn btn-success btn-sm col-2" href="{{ route('contact.import') }}">
                    <i class="fas fa-plus-square">
                    </i>
                    Importar Vexpenses
                </a>

              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">

                  <input id="search" type="text" name="search" value="{{ request()->search ? request()->search : '' }}" class="form-control typeahead float-right" placeholder="Pesquisar">

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
                    <th witdh="100"></th>
                    <th>Nome</th>
                    <th>Numero</th>
                    <th>Endereço</th>
                  </tr>
                </thead>
                @foreach ($contacts_list ?? [] as $contact)
                    <tbody>
                        <tr>
                            <td width="100">
                                @if($contact->avatar_url)
                                    <img style="width: 50px; border-radius: 50%;" src="{{ 'storage/'. $contact->avatar_url }}" alt="avatar-{{ $contact->name }}">
                                @endif
                            </td>
                            <td>{{ $contact->name ?? '' }}</td>
                            <td>{{ $contact->phones->first() ? $contact->phones->first()->phone : '' }}</td>
                            <td>{{ $contact->addresses->first() ? $contact->addresses->first()->address : '' }}</td>
                            <td class="project-actions text-right">
                                <a class="btn btn-info btn-sm col-1" href="{{ route('contact.edit', $contact->id) }}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                </a>
                                <a class="btn btn-danger btn-sm col-1" href="{{ route('contact.destroy', $contact->id) }}">
                                    <i class="fas fa-trash">
                                    </i>
                                </a>
                                <a class="btn btn-primary btn-sm col-1" href="{{ route('phone.index', $contact->id) }}">
                                    <i class="fas fa-phone">
                                    </i>
                                </a>
                                <a class="btn btn-warning btn-sm col-1" href="{{ route('address.index', $contact->id) }}">
                                    <i class="fas fa-map-marker-alt">
                                    </i>
                                </a>
                                <a class="btn btn-success btn-sm col-1" target="_blank" href="https://api.whatsapp.com/send?phone={{ $contact->phones->first() ? $contact->phones->first()->phone : '#' }}&text=Ol%C3%A1%2C%20tudo%20bem%3F">
                                    <i class="fab fa-whatsapp">
                                    </i>
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
