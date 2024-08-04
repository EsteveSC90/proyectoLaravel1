@extends('template')

@section('title', "Inicio")

@section('css')
    <link href=""></link>
@endsection

@section('content')

    <div class="container-fluid">
        <h3 style="text-align: center">Vehicle</h3>
        <div class="row">
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
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
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <form action="{{ route('vehicles.edit', $vehicle) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('put') }}

                        <label for="registration">Registration:</label>
                        <input type="text" id="registration" name="registration" value="{{ $vehicle->registration }}"><br><br>

                        <div class="form-group">
                            <label for="type">Tipo de vehículo</label>
                            <select name="type" id="type" class="form-control">
                                @foreach($types as $value => $name)
                                    <option value="{{ $value }}" @if($vehicle->type == $value) selected="selected" @endif>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <label for="brand">Brand:</label>
                        <input type="text" id="brand" name="brand" value="{{ $vehicle->brand }}"><br><br>

                        {{--                        <label for="wheels">Wheels:</label>--}}
                        {{--                        <input type="number" id="wheels" name="wheels"><br><br>--}}

                        {{--                        <label for="seats">Seats:</label>--}}
                        {{--                        <input type="number" id="seats" name="seats"><br><br>--}}

                        <label for="color">Color:</label>
                        <input type="text" id="color" name="color" value="{{ $vehicle->color }}"><br><br>

                        <label for="price">Price:</label>
                        <input type="number" id="price" name="price" step="0.01" value="{{ $vehicle->price }}"><br><br>

                        <label for="is_second_hand">Is Second Hand?</label>
                        <input type="checkbox" id="is_second_hand" name="is_second_hand"
                               @if($vehicle->is_second_hand) checked="checked" @endif><br><br>

                        <label for="km">KM:</label>
                        <input type="number" id="km" name="km" value="{{ $vehicle->km }}"><br><br>

                        <label for="is_available">Is Available?</label>
                        <input type="checkbox" id="is_available" name="is_available"
                               @if($vehicle->is_available) checked="checked" @endif><br><br>


                        <button type="submit" class="btn btn-danger">Guardar</button>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <div>
        <a href="{{ route('vehicles.list') }}" class="btn btn-primary">Volver</a>
    </div>

@endsection

@section('js')
    <script href=""></script>
@endsection
