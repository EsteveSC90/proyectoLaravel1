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
            padding: 0; /* Elimina el padding de la tabla */
        }

        th, td {
            border: 1px solid #ddd;
            text-align: left;
            padding: 8px;
            padding-left: 10px;
            padding-right: 10px;
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

        td:last-child {
            padding-bottom: 0px !important;
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
                    <form action="{{ route('sellers.search') }}" method="get">
                        <label for="search">Búsqueda</label>
                        <input type="text" name="search" value="{{ $search ?? '' }}" class="input-lg" />
                        <button type="submit" class="ml-4 btn btn-danger">Buscar</button>
                        <a href="{{ route('sellers.list') }}" class="ml-4 btn btn-info">Limpiar</a>
                    </form>
                </div>
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

            <main role="main" class="col-md-12 px-4"> <!-- Cambié col-md-9 col-lg-10 a col-md-12 -->
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <table>
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>DNI</th>
                            <th>NAME</th>
                            <th>SURNAME</th>
                            <th>TELEPHONE</th>
                            <th>ADDRESS</th>
                            <th>EMAIL</th>
                            <th>DETAIL</th>
                            <th>DELETE</th>
                        </tr>
                        </thead>
                        <tbody>
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
                                    <a href="{{ route('sellers.get', $seller) }}" class="ml-4 btn btn-primary">Ver detalle</a>
                                </td>
                                <td>
                                    <form action="{{ route('sellers.delete', $seller) }}" method="post">
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
                {{ $sellers->links('pagination.custom') }}
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
