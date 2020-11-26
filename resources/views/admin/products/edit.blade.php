@extends('layouts.app')

@section('content')
    <h2>Editar producto: {{ $product->name }}</h2>

    <br>

    <v-products-edit-menu></v-products-edit-menu>

    <div class="p-2">

        <div class="section-1" style="display: block">
            <form novalidate method="POST" action="{{ route('products.update', ['product' => $product->id]) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <img class="rounded-circle" width="150" height="150" src="{{ asset("storage/$product->image") }}"
                        alt="{{ $product->name }}">
                </div>
                <div class="form-group">
                    <label for="image">Fotografia</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image"
                        accept="image/png, image/jpeg, iamge/jpg">
                    @error('image')
                        <div class="alert alert-danger mt-1">
                            <span>&times; {{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                        value="{{ $product->name }}">
                    @error('name')
                        <div class="alert alert-danger mt-1">
                            <span>&times; {{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="reference">Referencia</label>
                    <input type="text" class="form-control @error('reference') is-invalid @enderror" id="reference"
                        name="reference" value="{{ $product->reference }}">
                    @error('reference')
                        <div class="alert alert-danger mt-1">
                            <span>&times; {{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="category_id">Categoria</label>
                    <select class="form-control @error('category_id') is-invalid @enderror" id="category_id"
                        name="category_id">
                        <option value="" selected disabled>-- selecciona una categoria.</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach

                    </select>
                    @error('category_id')
                        <div class="alert alert-danger mt-1">
                            <span>&times; {{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="price_sale">Precio de venta</label>
                    <input type="text" class="form-control @error('price_sale') is-invalid @enderror" id="price_sale"
                        name="price_sale" value="{{ $product->price_sale }}">
                    @error('price_sale')
                        <div class="alert alert-danger mt-1">
                            <span>&times; {{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="row">

                    <div class="form-group col-6">
                        <label for="quantity">Cantidad en Stock</label>
                        <input type="text" disabled class="form-control" id="quantity" value="{{ $product->quantity }}">
                        <div class="alert alert-light mt-1">
                            <span>La cantidad no es editable</span>
                        </div>
                    </div>

                    <div class="form-group col-6">
                        <label for="utility">Utiliada Estimada</label>
                        <input type="text" disabled class="form-control" id="utility" value="{{ $product->utility }}">
                        <div class="alert alert-light mt-1">
                            <span>La utilidad no es editable</span>
                        </div>
                    </div>

                </div>

                <button type="submit" class="btn btn-dark text-uppercase mt-4">Guardar cambios</button>
            </form>
        </div>

        <div class="section-2 p-2" style="display: none">

            <h2>Historial de ingresos</h2>
            <p>Ingresos en compras, alteración del stock en compras</p>

            <table class="table">
                <thead>
                    <tr>
                        <th>COMPRA</th>
                        <th>INGRESO</th>
                        <th>PRECIO DE COMPRA</th>
                        <th>CANTIDAD</th>
                        <th>VALOR</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($historyPurchases as $product)
                        <tr>
                            <td>
                                <a href="{{ route('purchases.show', ['purchase' => $product->purchase_id]) }}"
                                class="btn btn-sm btn-outline-dark font-weight-bold">
                                COMPRA::{{ $product->purchase_id }}
                            </a></td>
                            <td>{{ $product->created_at->diffForHumans() }}</td>
                            <td>{{ number_format($product->price_purchase, 2) }} COP</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ number_format($product->total, 2) }} COP</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                {{ $historyPurchases->links() }}
            </div>

        </div>

        <div class="section-3 p-2" style="display: none">

            <h2>Historial de salidas</h2>
            <p>Ingresos en salidas, alteración del stock en ventas</p>

            <table class="table">
                <thead>
                    <tr>
                        <th>VENTA</th>
                        <th>SALIDA</th>
                        <th>PRECIO DE VENTA</th>
                        <th>CANTIDAD</th>                        
                        <th>VALOR</th>
                        <th>UTLIDAD</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($historySales as $product)
                        <tr>
                            <td>
                                <a href="{{ route('sales.show', ['sale' => $product->sale_id]) }}"
                                class="btn btn-sm btn-outline-dark font-weight-bold">
                                VENTA::{{ $product->sale_id }}
                            </a></td>
                            <td>{{ $product->created_at->diffForHumans() }}</td>
                            <td>{{ number_format($product->price_sale_unit, 2) }} COP</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ number_format($product->total, 2) }} COP</td>
                            <td>{{ number_format($product->utility, 2) }} COP</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                {{ $historyPurchases->links() }}
            </div>

        </div>

    </div>

@endsection
