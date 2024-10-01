@extends('template')

@section('title', "Informe Ventas")

@section('content')

    <div class="container-fluid view-height">
        <h3 style="text-align: center">Sellers</h3>
        <div class="row">
            <main role="main" class="col-md-12 px-4"> <!-- Cambié col-md-9 col-lg-10 a col-md-12 -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <h6>Por favor corrige los siguientes errores:</h6>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="d-flex justify-content-center">
                    <form action="{{ route('report.sellers.search') }}" method="get">
                        <div class="form-group">
                            <label for="search">Vendedor</label>
                            <select name="seller">
                                <option value="">-- Todos --</option>
                                @foreach($sellers as $s)
                                    <option value="{{ $s->id }}" @if (isset($seller) && $s->id == $seller) selected @endif >{{ $s->getFullName() }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="search">Año</label>
                            <select name="year">
                                <option value="2023" @if ($year == "2023") selected @endif>2023</option>
                                <option value="2024" @if ($year == "2024") selected @endif>2024</option>
                            </select>
                        </div>
                        <button type="submit" class="ml-4 btn btn-danger">Buscar</button>
                        <a href="{{ route('report.sellers') }}" class="ml-4 btn btn-info">Limpiar</a>
                        <a href="{{ route('report.sellers.pdf', ['year' => $year]) }}" target="_blank" class="ml-4 btn btn-warning">Descargar PDF</a>

                    </form>
                </div>
            </main>
            @isset($sells)
                <main role="main" class="col-md-6 px-4 espaciado">
                <!-- Añadimos la clase table-responsive para que la tabla sea responsiva -->
                <div class="table-responsive">
                    <table class="table table-striped table-bordered"> <!-- Añadí clases de Bootstrap para mejorar el diseño -->
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
            </main>
                <main role="main" class="col-md-6 px-4">
                    <canvas id="grafica"></canvas>
                </main>
            @endisset
        </div>
        <div class="text-center mt-4">
            <a href="{{ url('/') }}" class="ml-4 btn btn-primary">Ir a la página de inicio</a>
        </div>
    </div>

@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        (async () => {
            // Llamar a nuestra API. Puedes usar cualquier librería para la llamada, yo uso fetch, que viene nativamente en JS
            const respuestaRaw = await fetch("{{ route('report.sellers.charts') }}");
            // Decodificar como JSON
            const respuesta = await respuestaRaw.json();
            // Ahora ya tenemos las etiquetas y datos dentro de "respuesta"
            // Obtener una referencia al elemento canvas del DOM
            const $grafica = document.getElementById("grafica");
            const etiquetas = respuesta.labels; // <- Aquí estamos pasando el valor traído usando AJAX
            // Podemos tener varios conjuntos de datos. Comencemos con uno
            const datos = {
            label: respuesta.chart_name,
                // Pasar los datos igualmente desde PHP
                data: respuesta.values, // <- Aquí estamos pasando el valor traído usando AJAX
                backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo
                borderColor: 'rgba(54, 162, 235, 1)', // Color del borde
                borderWidth: 1, // Ancho del borde
            };
            new Chart($grafica, {
                type: 'line', // Tipo de gráfica
                data: {
                    labels: etiquetas,
                    datasets: [
                        datos,
                        // Aquí más datos...
                    ]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }],
                    },
                }
            });
        })();
    </script>
@endsection
