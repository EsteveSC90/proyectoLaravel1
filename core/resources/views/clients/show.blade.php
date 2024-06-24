@extends('template')

@section('title', "Editar Cliente")

@section('css')
    <link href=""></link> {{-- Coloca aquí tus estilos CSS si es necesario --}}
@endsection

@section('content')

    <div class="container-fluid">
        <h3 style="text-align: center">Editar Cliente</h3>
        <div class="row">
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
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
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <form action="{{ route('clients.edit', $client) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="dni">DNI:</label>
                            <input type="text" id="dni" name="dni" value="{{ $client->dni }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" id="name" name="name" value="{{ $client->name }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="surname">Apellido:</label>
                            <input type="text" id="surname" name="surname" value="{{ $client->surname }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="telephone">Teléfono:</label>
                            <input type="text" id="telephone" name="telephone" value="{{ $client->telephone_num }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="address_name">Nombre de la Dirección:</label>
                            <input type="text" id="address_name" name="address_name" value="{{ $client->address ? $client->address->address_name : '' }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="city">Ciudad:</label>
                            <input type="text" id="city" name="city" value="{{ $client->address ? $client->address->city : '' }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="postal_code">Código Postal:</label>
                            <input type="text" id="postal_code" name="postal_code" value="{{ $client->address ? $client->address->postal_code : '' }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="country">País:</label>
                            <input type="text" id="country" name="country" value="{{ $client->address ? $client->address->country : '' }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Correo electrónico:</label>
                            <input type="email" id="email" name="email" value="{{ $client->email_address }}" class="form-control" required>
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
    <script src=""></script> {{-- Coloca aquí tus scripts JavaScript si es necesario --}}
@endsection
