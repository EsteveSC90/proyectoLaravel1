@extends('template')

@section('title', "Inicio")

@section('css')
    <style>
        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .form-group label {
            flex: 0 0 150px; /* Ajusta este valor según el ancho deseado */
            margin-bottom: 0;
            margin-right: 10px;
            text-align: right;
        }

        .form-group input {
            flex: 1;
        }

        .form-actions {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .form-actions .btn {
            margin: 0 10px; /* Espaciado entre botones */
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
        <h3 class="text-center">Seller</h3>
        <div class="row">
            <main role="main" class="col-md-12 px-4">
                <div class="d-flex flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom d-flex justify-content-center">
                    @if ($errors->any())
                        <div class="alert alert-danger mb-4">
                            <h6>Por favor corrige los siguientes errores:</h6>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('sellers.edit', $seller) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="dni">DNI:</label>
                            <input type="text" id="dni" name="dni" value="{{ $seller->dni }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" id="name" name="name" value="{{ $seller->name }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="surname">Apellido:</label>
                            <input type="text" id="surname" name="surname" value="{{ $seller->surname }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="telephone_num">Teléfono:</label>
                            <input type="text" id="telephone_num" name="telephone_num" value="{{ $seller->telephone_num }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Dirección:</label>
                            <input type="text" id="address" name="address" value="{{ $seller->address }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Correo electrónico:</label>
                            <input type="email" id="email_address" name="email_address" value="{{ $seller->email_address }}" class="form-control" required>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-danger">Guardar</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('sellers.list') }}" class="btn btn-primary">Volver</a>
    </div>

@endsection

@section('js')
    <script href=""></script>
@endsection
