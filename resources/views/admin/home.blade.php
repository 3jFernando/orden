@extends('layouts.app')

@section('content')


    <h4 class="text-dark font-weight-bold text-uppercase card-title">Filtros</h4>
    <v-home-filters since="{{ $since }}" until="{{ $until }}"></v-home-filters>



    <div class="row row-cols-1 row-cols-md-3 mt-4">
        <div class="col mb-4">

            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="https://images.vexels.com/media/users/3/153797/isolated/preview/4c530aaa31fee46760a577666a13708d-icono-de-trazo-coloreado-de-billetes-de-dinero-by-vexels.png"
                            class="card-img" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Ventas</h5>
                            <p class="card-text"><h4 class="stadistic-sales text-muted">0.00</h4>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col mb-4">

            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="https://images.vexels.com/media/users/3/153797/isolated/preview/4c530aaa31fee46760a577666a13708d-icono-de-trazo-coloreado-de-billetes-de-dinero-by-vexels.png"
                            class="card-img" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Compras</h5>
                            <p class="card-text"><h4 class="stadistic-purchases text-muted">0.00</h4></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col mb-4">

            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="https://images.vexels.com/media/users/3/153797/isolated/preview/4c530aaa31fee46760a577666a13708d-icono-de-trazo-coloreado-de-billetes-de-dinero-by-vexels.png"
                            class="card-img" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Utilidad</h5>
                            <p class="card-text"><h4 class="stadistic-utilities text-muted">0.00</h4></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
