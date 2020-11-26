@extends('layouts.app')

@section('content')

<div class="row row-cols-1 row-cols-md-3">
    <div class="col mb-4">
      <div class="card h-100">
        <img src="https://i.pinimg.com/474x/b8/4e/3a/b84e3a4a4ebb4f8e7d03432ef642213d.jpg" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Ventas del dia</h5>
          <h2>{{ number_format($salesToDay, 2) }}</h2>
          <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
        </div>
      </div>
    </div>
    <div class="col mb-4">
      <div class="card h-100">
        <img src="https://i.pinimg.com/474x/b8/4e/3a/b84e3a4a4ebb4f8e7d03432ef642213d.jpg" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Compras del dia</h5>
          <h2>{{ number_format($purchasesToDay, 2) }}</h2>
          <p class="card-text">This is a short card.</p>
        </div>
      </div>
    </div>
    <div class="col mb-4">
      <div class="card h-100">
        <img src="https://i.pinimg.com/474x/b8/4e/3a/b84e3a4a4ebb4f8e7d03432ef642213d.jpg" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Utilidad del dia</h5>
          <h2>{{ number_format($utilityToDay, 2) }}</h2>
          <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
        </div>
      </div>
    </div>
  </div>

@endsection
