
@extends('template')

@section('title', "Inicio")

@section('css')
    <link href=""></link>
@endsection

@section('content')

    <div class="container-fluid">
        <h3 style="text-align: center">Vehicles</h3>
        <div class="row">
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <h6>Por favor corrige los siguiente errores:</h6>
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

{{--                        <label for="wheels">Wheels:</label>--}}
{{--                        <input type="number" id="wheels" name="wheels"><br><br>--}}

{{--                        <label for="seats">Seats:</label>--}}
{{--                        <input type="number" id="seats" name="seats"><br><br>--}}

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

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

                    <table>
                        <tr>
{{--                            @php--}}
{{--                                $columns = Schema::getColumnListing('vehicles');--}}
{{--                            @endphp--}}
{{--                            @foreach($columns as $column)--}}
{{--                                <th>{{ $column }}</th>--}}
{{--                            @endforeach--}}
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
                        </tr>

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
                                <td>{{$vehicle->is_second_hand == 0 ? 'FALSE' : 'TRUE' }}</td>
                                <td>{{ $vehicle->km }}</td>
                                <td>{{ $vehicle->is_available == 0 ? 'FALSE' : 'TRUE' }}</td>
                                <td>
                                    <a href="{{ route('vehicles.get', $vehicle) }}" class="ml-4 btn btn-primary">Ver detalle</a>
                                </td>
                                <td>
                                    <form action="{{ route('vehicles.delete', $vehicle) }}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                        <button type="submit" class="ml-4 btn btn btn-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </main>
        </div>
    </div>

    <div>
        <a href="{{ url('/') }}" class="ml-4 btn btn-primary">Ir a la página de inicio</a>
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
