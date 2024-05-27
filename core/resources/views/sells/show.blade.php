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
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>VEHICLE</th>
                            <th>UNIT PRICE</th>
                            <th>QUANTITY</th>
                            <th>TOTAL PRICE</th>
                            <th>DATE</th>
                        </tr>

                        @foreach($lines as $line)
                            <tr>
                                <td>{{ $line->id }}</td>
                                <td>{{ $line->vehicle->registration }}</td>
                                <td>{{ $line->unit_price }}</td>
                                <td>{{ $line->quantity }}</td>
                                <td>{{ number_format($line->total_price, 2) }}</td>
                                <td>{{ \Illuminate\Support\Carbon::parse($line->created_at)->format('d-m-Y H:i:s') }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </main>
        </div>
    </div>

    <div>
        <a href="{{ route('sells.list') }}" class="btn btn-primary">Volver</a>
    </div>

@endsection

@section('js')
    <script href=""></script>
@endsection
