@extends('layouts.app')

@section('content')
    <h2>Editar producto: {{ $product->name}}</h2>

    <form 
        novalidate
        method="POST"
        action="{{ route('products.update', ['product' => $product->id])}}"
        enctype="multipart/form-data"
    >
        @csrf
        @method('PUT')

        <div class="form-group">
            <img 
                class="rounded-circle" 
                width="150" 
                height="150" 
                src="{{ asset("storage/$product->image") }}" 
                alt="{{$product->name}}">
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

        <div class="form-group">
            <label for="name">Nombre</label>
            <input
                type="text" 
                class="form-control @error('name') is-invalid @enderror" 
                id="name" 
                name="name"
                value="{{ $product->name }}"
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
                value="{{ $product->reference }}"
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
                        {{ $product->category_id == $category->id ? 'selected' : '' }}
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
                value="{{ $product->price_sale }}"
            >
            @error('price_sale')
                <div class="alert alert-danger mt-1">
                    <span>&times; {{$message}}</span>
                </div>
            @enderror
        </div>    
        
        <div class="row">
        
            <div class="form-group col-6">
                <label for="quantity">Cantidad en Stock</label>
                <input
                    type="text" 
                    disabled
                    class="form-control" 
                    id="quantity" 
                    value="{{ $product->quantity }}"
                >
                <div class="alert alert-light mt-1">
                    <span>La cantidad no es editable</span>
                </div>
            </div>  

            <div class="form-group col-6">
                <label for="utility">Utiliada Estimada</label>
                <input
                    type="text" 
                    disabled
                    class="form-control" 
                    id="utility" 
                    value="{{ $product->utility }}"
                >
                <div class="alert alert-light mt-1">
                    <span>La utilidad no es editable</span>
                </div>
            </div>  
        
        </div>  

        <button type="submit" class="btn btn-dark text-uppercase mt-4">Guardar cambios</button>
      </form>

@endsection