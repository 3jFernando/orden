@extends('layouts.app')

@section('content')

    <form action="{{ route('shops.update', ['shop' => $shop->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card mb-3">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="{{ asset('/storage/' . $shop->image) }}" class="card-img" alt="...">
                    <div class="my-2 text-center r w-100">
                        <input type="file" accept="image/png, iamge/jpeg, iamge/jpg" name="image">
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror                        
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="name" class="px-3 ext-uppercase font-weight-bold">Nombre de la Tienda. </label>
                            <input id="name" type="text" name="name"
                                class="px-3 py-1 card-title font-weight-bold w-100 text-muted" style="border: 0"
                                value="{{ $shop->name }}">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="bio" class="px-3 ext-uppercase font-weight-bold">Acerca de la Tienda. (Max: 255 caracteres)</label>
                            <textarea id="bio" name="bio" class="w-100 px-3 py-1 font-weight-bold text-muted"
                                style="border: 0; min-height: 80px">{{ $shop->bio }}</textarea>
                            @error('bio')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="px-3">
                            <small class="text-muted">Se unio {{ $shop->created_at->diffForHumans() }}</small><br>
                            <button type="submit" class="btn btn-dark text-uppercase font-weight-bold">Guardar
                                cambios</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>

@endsection
