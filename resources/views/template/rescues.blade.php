<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exportação de Resgates da Organização {{ $organization->name }}</title>

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
        background-color: #007bff;
        color: white;
      }
    </style>
</head>
<body>
    <table id="table">
        <tr>
            <th>Status</th>
            <th>Nome do Denunciador</th>
            <th>Nome do animal</th>
            <th>Cidade</th>
            <th>Estado</th>
        </tr>
        @foreach($rescue_list ?? [] as $rescue)
            <tr>
                <td class="table-success" style="color: #FFF;">{{ $rescue->status ?? '' }}</td>
                <td>{{ $rescue->reporter ?? '' }}</td>
                <td>{{ $rescue->animal_name ?? '' }}</td>
                <td>{{ $rescue->address ? $rescue->address->city : '' }}</td>
                <td>{{ $rescue->address ? $rescue->address->state : '' }}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>
