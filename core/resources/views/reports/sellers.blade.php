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
                        <label for="search">Año</label>
                        <select name="year">
                            <option value="2023" @if ($year == "2023") selected @endif>2023</option>
                            <option value="2024" @if ($year == "2024") selected @endif>2024</option>
                        </select>
                        <button type="submit" class="ml-4 btn btn-danger">Buscar</button>
                        <a href="{{ route('report.sellers') }}" class="ml-4 btn btn-info">Limpiar</a>
                    </form>
                </div>
            </main>
            <main role="main" class="col-md-12 px-4 espaciado">
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
        </div>
        <div class="text-center mt-4">
            <a href="{{ url('/') }}" class="ml-4 btn btn-primary">Ir a la página de inicio</a>
        </div>
    </div>

@endsection

@section('js')
    <script href=""></script>

    <script>
        window.onload = function() {
            document.getElementById("añadirVendedor").addEventListener("click", function() {
                var formulario = document.getElementById("formulario");
                if (formulario.style.display === "none") {
                    formulario.style.display = "block";
                    document.getElementById("añadirVendedor").innerText = "Cerrar formulario";
                } else {
                    formulario.style.display = "none";
                    document.getElementById("añadirVendedor").innerText = "Añadir vendedor";
                }
            });
        };
    </script>
@endsection
