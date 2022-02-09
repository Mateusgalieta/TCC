<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exportação de Animais da Organização {{ $organization->name }}</title>

    <style>
      table {
        width:100%;
      }
      table, th, td {
        border: 1px solid black;
        border-radius: 8px;
        border-collapse: collapse;
      }
      th, td {
        text-align: left;
        padding: 10px;
      }
      #table tr:nth-child(even) {
        background-color: #eee;
      }
      #table tr:nth-child(odd) {
        background-color: #fff;
      }
      #table th {
        background-color: #3FA1FF;
        color: white;
      }
    </style>
</head>
<body>
    <table id="table">
        <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>Categoria</th>
            <th>Resgatado por</th>
            <th>Data de resgate</th>
        </tr>
        @foreach($animal_list ?? [] as $animal)
            <tr>
                <td>{{ $animal->code }}</td>
                <td>{{ $animal->name }}</td>
                <td>{{ $animal->category ? $animal->category->name : '' }}</td>
                <td>{{ $animal->rescuer_name ?? '' }}</td>
                <td>{{ $animal->created_at->format('d/m/Y H:i') }}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>
