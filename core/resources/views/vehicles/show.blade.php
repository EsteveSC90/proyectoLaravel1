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
            width: 150px;
            margin-right: 10px;
            text-align: right;
        }

        .form-group input,
        .form-group select {
            flex: 1;
        }

        /* Regla para centrar el botón */
        .form-actions {
            display: flex;
            justify-content: center;
            margin-top: 1.5rem;
        }

        .form-actions .btn {
            margin: 0 10px; /* Espaciado entre botones */
        }
    </style>
@endsection

@section('content')

    <div class="container-fluid">
        <h3 class="text-center">Vehicle</h3>
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
                    <form action="{{ route('vehicles.edit', $vehicle) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="registration">Registration:</label>
                            <input type="text" id="registration" name="registration" value="{{ $vehicle->registration }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="type">Tipo de vehículo:</label>
                            <select name="type" id="type" class="form-control">
                                @foreach($types as $value => $name)
                                    <option value="{{ $value }}" @if($vehicle->type == $value) selected @endif>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="brand">Brand:</label>
                            <input type="text" id="brand" name="brand" value="{{ $vehicle->brand }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="color">Color:</label>
                            <input type="text" id="color" name="color" value="{{ $vehicle->color }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="number" id="price" name="price" step="0.01" value="{{ $vehicle->price }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="is_second_hand">Is Second Hand?</label>
                            <input type="checkbox" id="is_second_hand" name="is_second_hand" @if($vehicle->is_second_hand) checked @endif>
                        </div>

                        <div class="form-group">
                            <label for="km">KM:</label>
                            <input type="number" id="km" name="km" value="{{ $vehicle->km }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="is_available">Is Available?</label>
                            <input type="checkbox" id="is_available" name="is_available" @if($vehicle->is_available) checked @endif>
                        </div>

                        <!-- Div para centrar el botón de guardar -->
                        <div class="form-actions">
                            <button type="submit" class="btn btn-danger">Guardar</button>
                        </div>

                    </form>
                </div>
            </main>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('vehicles.list') }}" class="btn btn-primary">Volver</a>
    </div>



@endsection

@section('js')
    <script href=""></script>
@endsection
