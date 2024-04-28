@extends('template')

@section('title', "Inicio")

@section('css')
    <link href=""></link>
@endsection

@section('content')

    <div class="container-fluid">
        <h3 style="text-align: center">Sellers</h3>
        <div class="row">
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <form action="{{ route('sellers.add') }}" method="POST" id="formulario" style="display: none">
                        @csrf

                        <label for="dni">DNI:</label><br>
                        <input type="text" id="dni" name="dni"><br>
                        <label for="name">Name:</label><br>
                        <input type="text" id="name" name="name"><br>
                        <label for="surname">Surname:</label><br>
                        <input type="text" id="surname" name="surname"><br>
                        <label for="telephone">Telephone:</label><br>
                        <input type="tel" id="telephone" name="telephone"><br>
                        <label for="address">Address:</label><br>
                        <input type="text" id="address" name="address"><br>
                        <label for="email">Email:</label><br>
                        <input type="email" id="email" name="email"><br><br>


                        <button type="submit" class="btn btn-danger">Guardar</button>
                    </form>

                    <button id="añadirVendedor" class="ml-4 btn btn-primary">Añadir vendedor</button>
                </div>
            </main>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

                    <table>
                        <tr>
{{--                            @php--}}
{{--                                $columns = Schema::getColumnListing('sellers');--}}
{{--                            @endphp--}}
{{--                            @foreach($columns as $column)--}}
{{--                                <th>{{ $column }}</th>--}}
{{--                            @endforeach--}}
                            <th>ID</th>
                            <th>DNI</th>
                            <th>NAME</th>
                            <th>SURNAME</th>
                            <th>TELEPHONE</th>
                            <th>ADDRESS</th>
                            <th>EMAIL</th>
                            <th>DETAIL</th>
                        </tr>
                        @foreach($sellers as $seller)

                            <tr>
                                <td>{{ $seller->id }}</td>
                                <td>{{ $seller->dni }}</td>
                                <td>{{ $seller->name }}</td>
                                <td>{{ $seller->surname }}</td>
                                <td>{{ $seller->telephone_num }}</td>
                                <td>{{ $seller->address }}</td>
                                <td>{{ $seller->email_address }}</td>
                                <td>
                                    <a href="{{ route('sellers.get', $seller) }} " class="ml-4 btn btn-primary">Ver detalle</a>
                                </td>
                                <td>
                                    <form action="{{ route('sellers.delete', $seller) }}" method="post">
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
