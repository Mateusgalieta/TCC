<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Resgate de Animais</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
            .background {
                background-image: url('/img/dog.jpg');
                background-repeat: no-repeat;
                background-size: cover;
                background-attachment: fixed;
                background-position: center center;
                position: relative;
            }

            .background label {
                color: #FFF;
            }

            .overlay {
                background: rgba(0, 0, 0, 0.6);
                position: absolute;
                width: 100vw;
                height: 100vh;
                top: 0;
                left: 0;
            }

            .button-backoffice {
                float: right;
                width: 150px;
                background-color: #22D59E;
                color: #FFF;
                border-radius: 5px;
                text-align: center;
                text-decoration: none;
                font-weight: bold;
                padding: 15px 20px;
            }

            .button-backoffice:hover {
                transform: scale(1.05);
                transition: all 0.2s ease-in;
                transition-delay: 0.02s;
                filter: brightness(110%);
                -webkit-transform: scale(1.05);
                color: #FFF;
                box-shadow: 0 0 50px rgba(255,255,255,.3);
            }
        </style>
    </head>

    <body class="background">

        <div class="overlay"></div>


        <div class="container h-100" style="padding-top: 40px; position: relative;">

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block" id="alert1">
                    <button type="button" class="close" data-dismiss="alert1">×</button>
                        <strong>{{ $message }}</strong>
                </div>
            @endif

            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block" id="alert2">
                    <button type="button" class="close" data-dismiss="alert2">×</button>
                        <strong>{{ $message }}</strong>
                </div>
            @endif

            {!!  Form::open(['route' => ['site.rescue.create'], 'method' => 'POST', 'class' => 'form-horizontal', 'id' => 'registerForm', 'enctype' => 'multipart/form-data']) !!}
                <div class="row h-100 justify-content-center align-items-center">
                    <div class="col-12">
                        <a class="button-backoffice" href="{{ route('login') }}">BACKOFFICE</a>
                    </div>

                    <h1 style="text-align: center; color: #FFF">Solicitação de Resgate de Animais</h1>


                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-6">
                                <label>Nome do denunciador</label>
                                <div class="form-group col-12">
                                    {!! Form::text('reporter', '', ['class' => 'form-control', 'placeholder' => 'Nome do denunciador (Opcional)', 'required' => false]); !!}
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group col-12 mt-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="type" style="color: rgba(0,0,0,1)">ONG responsável</label>
                                        </div>
                                        <select required name="organization_id" class="form-control">
                                            @foreach ($organizations ?? [] as $organization)
                                                <option value="{{ $organization->id }}">{{ $organization->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group mt-3 col-6">
                                <label>Nome do Animal</label>
                                {!! Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Nome', 'required' => true]); !!}
                            </div>
                            <div class="form-group mt-3 col-6">
                                <label for="cep">CEP</label>
                                {!! Form::text('cep', '', ['id' => 'cep', 'class' => 'form-control', 'placeholder' => 'CEP', 'required' => true]); !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group mt-3 col-6">
                                <label for="address">Endereço</label>
                                {!! Form::text('address', '', ['id' => 'address', 'class' => 'form-control', 'placeholder' => 'Endereço', 'required' => true]); !!}
                            </div>
                            <div class="form-group mt-3 col-6">
                                <label for="neighborhood">Bairro</label>
                                {!! Form::text('neighborhood', '', ['id' => 'neighborhood', 'class' => 'form-control', 'placeholder' => 'Bairro', 'required' => true]); !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group mt-3 col-6">
                                <label for="state">Estado</label>
                                {!! Form::text('state', '', ['id' => 'state', 'class' => 'form-control', 'placeholder' => 'Estado', 'required' => true]); !!}
                            </div>
                            <div class="form-group mt-3 col-6">
                                <label for="city">Cidade</label>
                                {!! Form::text('city', '', ['id' => 'city', 'class' => 'form-control', 'placeholder' => 'Cidade', 'required' => true]); !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group mt-3 col-12">
                                <label>Observações adicional</label>
                                {!! Form::textarea('observations', '', ['class' => 'form-control', 'placeholder' => 'Observações Adicionais', 'required' => false]); !!}
                            </div>
                        </div>
                    </div>
                    <input type="submit" id="saveBtn" value="Adicionar" class="btn btn-success float-right mt-3">
                </div>
            {!! Form::close() !!}
        </div>
    </body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

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
                                $("#address").val(json.logradouro);
                                $("#neighborhood").val(json.bairro);
                                $("#city").val(json.localidade);
                                $("#state").val(json.uf);
                            }
                        }
                });
            }
        });
    });
</script>
