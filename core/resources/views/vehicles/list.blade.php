
@extends('template')

@section('title', "Inicio")

@section('css')
    <style>

        .container-fluid {
            padding: 0; /* Elimina el padding del contenedor */
            margin: 0; /* Elimina el margin del contenedor */
        }

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
            margin: 0; /* Elimina el margen de la tabla */
        }

        th, td {
            border: 1px solid #ddd;
            text-align: left;
            padding: 8px;
            padding-left: 10px;
            padding-right: 10px;
        }

        td:last-child {
            padding-bottom: 0px !important;
        }

        .form-control {
            width: 100%; /* Asegura que los campos del formulario ocupen el ancho completo disponible */
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

        .footer {
            background: black;
            color: white;
            height: 55px;
        }


        .row {
            margin-right: 0px !important;
            margin-left: 0px !important;
        }

        .view-height {
            margin-bottom: 30rem;
        }

    </style>
@endsection

@section('content')

    <div class="container-fluid view-height">
        <h3 style="text-align: center">Vehicles</h3>
        <div class="row">

            <main role="main" class="col-md-12 px-4"> <!-- Cambié col-md-9 col-lg-10 a col-md-12 -->
                <div class="text-center">
                    <form action="{{ route('vehicles.search') }}" method="get">
                        <label for="search">Búsqueda</label>
                        <input type="text" name="search" value="{{ $search ?? '' }}" class="input-lg" />
                        <button type="submit" class="ml-4 btn btn-danger">Buscar</button>
                        <a href="{{ route('vehicles.list') }}" class="ml-4 btn btn-info">Limpiar</a>
                    </form>
                </div>

                <main role="main" class="col-md-12 px-4"> <!-- Cambié col-md-9 col-lg-10 a col-md-12 -->
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
                        <form action="{{ route('vehicles.add') }}" method="POST" id="formulario" style="display: none">
                            @csrf

                            <label for="registration">Registration:</label>
                            <input type="text" id="registration" name="registration"><br><br>

                            <div class="form-group">
                                <label for="type">Tipo de vehículo</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="Car">Coche</option>
                                    <option value="Motorbike">Motocicleta</option>
                                    <option value="Tractor">Tractor</option>
                                </select>
                            </div>

                            <label for="brand">Brand:</label>
                            <input type="text" id="brand" name="brand"><br><br>

                            <label for="color">Color:</label>
                            <input type="text" id="color" name="color"><br><br>

                            <label for="price">Price:</label>
                            <input type="number" id="price" name="price" step="0.01"><br><br>

                            <label for="is_second_hand">Is Second Hand?</label>
                            <input type="checkbox" id="is_second_hand" name="is_second_hand"><br><br>

                            <label for="km">KM:</label>
                            <input type="number" id="km" name="km"><br><br>

                            <label for="is_available">Is Available?</label>
                            <input type="checkbox" id="is_available" name="is_available"><br><br>

                            <button type="submit" class="btn btn-danger">Guardar</button>
                        </form>

                        <button id="añadirVehiculo" class="ml-4 btn btn-primary">Añadir vehiculo</button>
                    </div>
                </main>

                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <table>
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>REGISTRATION</th>
                            <th>TYPE</th>
                            <th>BRAND</th>
                            <th>WHEELS</th>
                            <th>SEATS</th>
                            <th>COLOR</th>
                            <th>PRICE</th>
                            <th>IS SECOND HAND?</th>
                            <th>KM</th>
                            <th>IS AVAILABLE?</th>
                            <th>DETAIL</th>
                            <th>DELETE</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($vehicles as $vehicle)
                            <tr>
                                <td>{{ $vehicle->id }}</td>
                                <td>{{ $vehicle->registration }}</td>
                                <td>{{ $vehicle->type }}</td>
                                <td>{{ $vehicle->brand }}</td>
                                <td>{{ $vehicle->wheels }}</td>
                                <td>{{ $vehicle->seats }}</td>
                                <td>{{ $vehicle->color }}</td>
                                <td>{{ $vehicle->price }}</td>
                                <td>{{ $vehicle->is_second_hand == 0 ? 'FALSE' : 'TRUE' }}</td>
                                <td>{{ $vehicle->km }}</td>
                                <td>{{ $vehicle->is_available == 0 ? 'FALSE' : 'TRUE' }}</td>
                                <td>
                                    <a href="{{ route('vehicles.get', $vehicle) }}" class="ml-4 btn btn-primary">Ver detalle</a>
                                </td>
                                <td>
                                    <form action="{{ route('vehicles.delete', $vehicle) }}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                        <button type="submit" class="ml-4 btn btn-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    {{ $vehicles->links('pagination.custom') }}
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
            document.getElementById("añadirVehiculo").addEventListener("click", function() {
                var formulario = document.getElementById("formulario");
                if (formulario.style.display === "none") {
                    formulario.style.display = "block";
                    document.getElementById("añadirVehiculo").innerText = "Cerrar formulario";
                } else {
                    formulario.style.display = "none";
                    document.getElementById("añadirVehiculo").innerText = "Añadir vehiculo";
                }
            });
        };
    </script>
@endsection
