@extends('template')

@section('title', "Inicio")

@section('css')
    <link href=""></link>
@endsection

@section('content')

    <div class="container-fluid">
        <h3 style="text-align: center">Client</h3>
        <div class="row">
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

                    <form action="{{ route('clients.edit', $client) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="dni">DNI:</label>
                            <input type="text" id="dni" name="dni" value="{{ $client->dni }}" required>
                        </div>
                        <div>
                            <label for="name">Nombre:</label>
                            <input type="text" id="name" name="name" value="{{ $client->name }}" required>
                        </div>
                        <div>
                            <label for="surname">Apellido:</label>
                            <input type="text" id="surname" name="surname" value="{{ $client->surname }}" required>
                        </div>
                        <div>
                            <label for="telephone">Teléfono:</label>
                            <input type="text" id="telephone" name="telephone" value="{{ $client->telephone_num }}" required>
                        </div>
                        <div>
                            <label for="address">Dirección:</label>
                            <input type="text" id="address" name="address" value="{{ $client->address }}" required>
                        </div>
                        <div>
                            <label for="email">Correo electrónico:</label>
                            <input type="email" id="email" name="email" value="{{ $client->email_address }}" required>
                        </div>

                        <button type="submit" class="btn btn-danger">Guardar</button>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <div>
        <a href="{{ route('clients.list') }}" class="btn btn-primary">Volver</a>
    </div>

@endsection

@section('js')
    <script href=""></script>
@endsection
