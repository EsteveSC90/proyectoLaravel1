@extends('template')

@section('title', "Inicio")

@section('css')
    <style>
        th {
            padding-left: 10px;
            padding-right: 10px;
        }

        td {
            padding-left: 10px;
            padding-right: 10px;
        }

        td:last-child {
            padding-bottom: 0px !important;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
            align-items: center;
        }

        .action-buttons .btn {
            margin-bottom: 0;
        }

    </style>
@endsection

@section('content')

    <div class="container-fluid">
        <h3 class="text-center">Sells</h3>
        <div class="row">
            <main role="main" class="col-md-12 px-4">
                <div class="d-flex justify-content-center">
                    <form action="{{ route('sells.search') }}" method="get">
                        <label for="search">Búsqueda</label>
                        <input type="text" name="search" value="{{ $search ?? '' }}" class="input-lg" />
                        <button type="submit" class="ml-4 btn btn-danger">Buscar</button>
                        <a href="{{ route('sells.list') }}" class="ml-4 btn btn-info">Limpiar</a>
                    </form>
                </div>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
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

                    <button id="añadirCliente" class="btn btn-primary">Añadir venta</button>

                    <form action="{{ route('sells.add') }}" method="POST" id="formulario" style="display: none">
                        @csrf

                        <label for="client_id">Client</label>
                        <select name="client_id" id="client_id" class="form-control">
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->name }} {{ $client->surname }}</option>
                            @endforeach
                        </select>

                        <label for="seller_id">Vendedor</label>
                        <select name="seller_id" id="seller_id" class="form-control">
                            @foreach($sellers as $seller)
                                <option value="{{ $seller->id }}">{{ $seller->name }} {{ $seller->surname }}</option>
                            @endforeach
                        </select>

                        <h2>Líneas de venta</h2>
                        <div id="sell_lines">
                            <div class="line-item">
                                <label for="quantity">Cantidad</label>
                                <input type="number" name="quantity[]" />
                                <br/>
                                <label for="vehicle_id">Vehículo</label>
                                <select name="vehicle_id[]" class="form-control">
                                    @foreach($vehicles as $vehicle)
                                        <option value="{{ $vehicle->id }}">{{ $vehicle->registration }} {{ $vehicle->brand }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <a href="#" id="add_line" class="btn btn-warning">Añadir línea</a>
                        <button type="submit" class="btn btn-danger">Guardar</button>
                    </form>
                </div>
            </main>

            <main role="main" class="col-md-12 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>CLIENT</th>
                            <th>SELLER</th>
                            <th>TOTAL</th>
                            <th>DATE</th>
                            <th>DETAIL</th>
                            <th>DELETE</th>
                        </tr>

                        @foreach($sells as $sell)
                            <tr>
                                <td>{{ $sell->id }}</td>
                                <td>{{ $sell->client->name }} {{ $sell->client->surname }}</td>
                                <td>{{ $sell->seller->name }} {{ $sell->seller->surname }}</td>
                                <td>{{ number_format($sell->total(), 2) }}</td>
                                <td>{{ \Illuminate\Support\Carbon::parse($sell->created_at)->format('d-m-Y H:i:s') }}</td>
                                <td>
                                    <a href="{{ route('sells.get', $sell) }}" class="btn btn-primary">Ver detalle</a>
                                </td>
                                <td>
                                    <form action="{{ route('sells.delete', $sell) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                {{ $sells->links('pagination.custom') }}
            </main>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ url('/') }}" class="btn btn-primary">Ir a la página de inicio</a>
    </div>


@endsection

@section('js')
    <script href="">
        $(document).ready(function () {
           $("#add_line").click(function (e) {
               e.preventDefault();
               let cloned = $("#lines_div").clone();
               $("#sell_lines").append(cloned);
           });
        });
    </script>
    <script>
        window.onload = function() {
            document.getElementById("añadirCliente").addEventListener("click", function() {
                var formulario = document.getElementById("formulario");
                if (formulario.style.display === "none") {
                    formulario.style.display = "block";
                    document.getElementById("añadirCliente").innerText = "Cerrar formulario";
                } else {
                    formulario.style.display = "none";
                    document.getElementById("añadirCliente").innerText = "Añadir cliente";
                }
            });
        };
    </script>
@endsection
