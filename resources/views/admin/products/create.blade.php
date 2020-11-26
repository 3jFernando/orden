@extends('layouts.app')
@section('menu-active4', 'active')

@section('content')
    <h2>Crear productos</h2>

    <form 
        novalidate
        method="POST"
        action="{{ route('products.store')}}"
        enctype="multipart/form-data"
    >
        @csrf

        <div class="form-group">
            <label for="name">Nombre</label>
            <input
                type="text" 
                class="form-control @error('name') is-invalid @enderror" 
                id="name" 
                name="name"
                value="{{ old('name') }}"
            >
            @error('name')
                <div class="alert alert-danger mt-1">
                    <span>&times; {{$message}}</span>
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="reference">Referencia</label>
            <input
                type="text" 
                class="form-control @error('reference') is-invalid @enderror" 
                id="reference" 
                name="reference"
                value="{{ old('reference') }}"
            >
            @error('reference')
                <div class="alert alert-danger mt-1">
                    <span>&times; {{$message}}</span>
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="category_id">Categoria</label>
            <select 
                class="form-control @error('category_id') is-invalid @enderror" 
                id="category_id" 
                name="category_id">
                <option value="" selected disabled>-- selecciona una categoria.</option>
                
                @foreach ($categories as $category)
                    <option 
                        value="{{$category->id}}"
                        {{ old('category_id') == $category->id ? 'selected' : '' }}
                    >{{$category->name}}</option>
                @endforeach

            </select>
            @error('category_id')
                <div class="alert alert-danger mt-1">
                    <span>&times; {{$message}}</span>
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="price_sale">Precio de venta</label>
            <input
                type="text" 
                class="form-control @error('price_sale') is-invalid @enderror" 
                id="price_sale" 
                name="price_sale"
                value="{{ old('price_sale') }}"
            >
            @error('price_sale')
                <div class="alert alert-danger mt-1">
                    <span>&times; {{$message}}</span>
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">Fotografia</label>
            <input
                type="file" 
                class="form-control @error('image') is-invalid @enderror" 
                id="image" 
                name="image"
                accept="image/png, image/jpeg, iamge/jpg"
            >
            @error('image')
                <div class="alert alert-danger mt-1">
                    <span>&times; {{$message}}</span>
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-dark text-uppercase">Crear</button>
      </form>

@endsection