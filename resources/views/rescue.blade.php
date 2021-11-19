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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>

    <body style="background-image: url('/img/dog.jpg'); background-repeat: no-repeat; background-size: cover; background-attachment: fixed; background-position: center center;">
        {{-- <div class="container align-middle">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="type">Categoria</label>
                    </div>
                    <select required name="category_id" class="custom-select" id="type">
                        @foreach ($organizations ?? [] as $organization)
                            <option value="{{ $organization->id }}">{{ $organization->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div> --}}
        <div class="container h-100" style="margin-top: 80px;">
            <div class="row h-100 justify-content-center align-items-center">
                <h1 style="text-align: center; color: #FFF">Resgate de Animais</h1>
                <form class="col-12 mt-3">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="type">Categoria</label>
                            </div>
                            <select required name="organization" class="form-control">
                                @foreach ($organizations ?? [] as $organization)
                                    <option value="{{ $organization->id }}">{{ $organization->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <label>Nome do denunciador</label>
                        {!! Form::text('denunciator', '', ['class' => 'form-control', 'placeholder' => 'Nome do denunciador (Opcional)', 'required' => false]); !!}

                        <label class="mt-3">Nome do Animal</label>
                        {!! Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Nome', 'required' => true]); !!}
                    </div>
                </form>
            </div>
          </div>
    </body>
</html>
