@extends('template')

@section('title', "Inicio")

@section('css')
    <link href=""></link>
@endsection

@section('content')

    <div class="container-fluid">
        <h3 style="text-align: center">Clients</h3>
        <div class="row">
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <form action="{{ route('clients.search') }}" method="get">
                    <label for="search">Búsqueda</label>
                    <input type="text" name="search" value="{{ $search ?? '' }}" class="input-lg" />
                    <button type="submit" class="ml-4 btn btn btn-danger">Buscar</button>
                </form>
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
                    @if(session()->has('result'))
                        <script type="text/javascript">
                            Swal.fire({
                                title: '{{ session()->get('result')->title }}',
                                text: '{{ session()->get('result')->message }}',
                                type: '{{ session()->get('result')->type }}',
                                showCancelButton: false,
                                confirmButtonColor: '#C6682A'
                            });
                        </script>
                    @endif
                    <form action="{{ route('clients.add') }}" method="POST" id="formulario" style="display: none">
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

                    <button id="añadirCliente" class="ml-4 btn btn-primary">Añadir cliente</button>
                </div>
            </main>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
{{--                    <a href="{{ route('main') }}">Volver al menú</a>--}}
                    <table>
                        <tr>
{{--                            @php--}}
{{--                                $columns = Schema::getColumnListing('clients');--}}
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
                            <th>CITY</th>
                            <th>POSTAL CODE</th>
                            <th>COUNTRY</th>
                            <th>EMAIL</th>
                            <th>DETAIL</th>
                        </tr>

                        @foreach($clients as $client)
                            <tr>
                                <td>{{ $client->id }}</td>
                                <td>{{ $client->dni }}</td>
                                <td>{{ $client->name }}</td>
                                <td>{{ $client->surname }}</td>
                                <td>{{ $client->telephone_num }}</td>
                                <td>{{ $client->address->address_name }}</td>
                                <td>{{ $client->address->city }}</td>
                                <td>{{ $client->address->postal_code }}</td>
                                <td>{{ $client->address->country }}</td>
                                <td>{{ $client->email_address }}</td>
                                <td>
                                    <a href="{{ route('clients.get', $client) }}" class="ml-4 btn btn-primary">Ver detalle</a>
                                </td>
                                <td>
                                    <form action="{{ route('clients.delete', $client) }}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                        <button type="submit" class="ml-4 btn btn btn-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                {{ $clients->links('pagination.custom') }}
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
