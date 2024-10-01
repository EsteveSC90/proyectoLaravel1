<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body class="px-5">
    <div class="row">
        <h1>Informe de ventas del {{ $year }}</h1>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>SELLER</th>
                <th>TOTAL</th>
            </tr>
            </thead>
            <tbody>
            @foreach($sells as $sell)
                <tr>
                    <td>{{ $sell['seller'] }}</td>
                    <td>{{ number_format($sell['total'], 2) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
