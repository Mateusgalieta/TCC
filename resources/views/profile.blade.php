@extends('layouts.app')


@section('content')


        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Meu Perfil</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Meu Perfil</li>
                </ol>
            </div>
            </div>
        </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="container-fluid">
            <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                        src="/img/logo-profile.png"
                        alt="Logo di Sistema"
                        style="max-width: 150px;">
                    </div>

                    <h3 class="profile-username text-center">{{ auth()->user()->name }}</h3>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>E-mail</b> <a class="float-right">{{ auth()->user()->email }}</a>
                        </li>
                    </ul>

                </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->


            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Alteração de Dados</a></li>
                    <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">

                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="timeline">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Data/Hora</th>
                                    <th scope="col">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($personal_logs ?? [] as $personal_log)
                                    <tr>
                                        <td>{{ $personal_log->created_at->format("d/m/Y H:i") }}</td>
                                        <td>{{ $personal_log->description }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $personal_logs->links() }}
                        </div>
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane active" id="settings">
                        {!!  Form::open(['route' => 'profile.update', 'method' => 'POST', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">Nome</label>
                                <div class="col-sm-10">
                                    {!! Form::text('name', auth()->user()->name, ['class' => 'form-control', 'placeholder' => 'Nome', 'required' => true]); !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    {!! Form::email('email', auth()->user()->email, ['class' => 'form-control', 'placeholder' => 'Email', 'required' => true]); !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName2" class="col-sm-2 col-form-label">Senha</label>
                                <div class="col-sm-10">
                                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Senha', 'required' => false]); !!}
                                </div>
                            </div>
                            {{-- <div class="form-group row">
                                <label for="inputSkills" class="col-sm-2 col-form-label">Data de Nascimento</label>
                                <div class="col-sm-10">
                                    {!! Form::date('birthday_date', auth()->user()->birthday_date ? auth()->user()->birthday_date : '', ['class' => 'form-control', 'required' => true]) !!}
                                </div>
                            </div> --}}
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger">Alterar</button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                    <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->


@endsection

