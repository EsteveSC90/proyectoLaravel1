@extends('template')

@section('title', "Inicio")

@section('css')
    <link href=""></link>
@endsection

@section('content')

    <div class="container-fluid">
        <h3 style="text-align: center">Sell</h3>
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
                    <form action="{{ route('sells.edit', $sell) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="seller_id">Seller:</label>
                            <select name="seller_id" id="seller_id" class="form-control">
                                @foreach($sellers as $seller)
                                    <option value="{{ $seller->id }}"
                                            @if ($sell->seller_id == $seller->id) selected="selected" @endif
                                    >{{ $seller->name }} {{ $seller->surname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="client_id">Client:</label>
                            <select name="client_id" id="client_id" class="form-control">
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}"
                                            @if ($sell->client_id == $client->id) selected="selected" @endif
                                    >{{ $client->name }} {{ $client->surname }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-danger">Guardar</button>
                    </form>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>VEHICLE</th>
                            <th>UNIT PRICE</th>
                            <th>QUANTITY</th>
                            <th>TOTAL PRICE</th>
                            <th>DATE</th>
                            <th>ACTIONS</th>
                        </tr>

                        @foreach($sell->lines as $line)
                            <tr>
                                <td>{{ $line->id }}</td>
                                <td>{{ $line->vehicle->registration }}</td>
                                <td>{{ $line->unit_price }}</td>
                                <td>{{ $line->quantity }}</td>
                                <td>{{ number_format($line->total_price, 2) }}</td>
                                <td>{{ \Illuminate\Support\Carbon::parse($line->created_at)->format('d-m-Y H:i:s') }}</td>
                                <td>
                                    <a href="{{ route('sells.lines.get', [$sell, $line]) }}" class="ml-4 btn btn-primary">Ver detalle</a>
                                    <form action="{{ route('sells.lines.delete', [$sell, $line]) }}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                        <button type="submit" class="ml-4 btn btn btn-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="border-bottom">
                    <p>Sell total: <b>{{ number_format($sell->lines->sum('total_price'), 2) }}</b></p>
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
