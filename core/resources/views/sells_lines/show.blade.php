@extends('template')

@section('title', "Inicio")

@section('content')

    <div class="container-fluid view-height">
        <h3 class="text-center">Sell Line</h3>
        <div class="row border-bottom">
            <main role="main" class="col-md-12 px-4 d-flex justify-content-center">
                @if ($errors->any())
                    <div class="alert alert-danger mb-3">
                        <h6>Por favor corrige los siguientes errores:</h6>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                    <form action="{{ route('sells.lines.edit', [$sell, $line]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="vehicle_id">Vehículo:</label>
                            <select name="vehicle_id" id="vehicle_id" class="form-control">
                                @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}" @if ($line->vehicle_id == $vehicle->id) selected @endif>
                                        {{ $vehicle->registration }} {{ $vehicle->brand }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="quantity">Quantity:</label>
                            <input type="text" id="quantity" name="quantity" value="{{ $line->quantity }}" class="form-control" required>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-danger">Guardar</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('sells.get', $sell) }}" class="btn btn-primary">Volver</a>
        </div>
    </div>



@endsection

@section('js')
    <script href=""></script>
@endsection
