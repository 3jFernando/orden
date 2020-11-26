@extends('layouts.app')

@section('content')
    <h2>Historial de compras</h2>

    <div class="d-flex justify-content-end">
        <a href="{{ route('purchases.create') }}" class="btn btn-sm btn-dark text-white my-2">+ Nueva compra</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>ACCIONES</th>
                <th>CREACION</th>
                <th>CONTACTO</th>
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody>

            @if (count($purchases))
                @php
                $total = 0;
                @endphp
                @foreach ($purchases as $purchase)
                    <tr>
                        <td>
                            <a href="{{ route('purchases.show', ['purchase' => $purchase->id]) }}"
                                class="text-info font-weight-bold">
                                Detalles
                            </a>
                        </td>
                        <td>{{ $purchase->created_at->diffForHumans() }}</td>
                        <td>
                            <a class="font-weight-bold"
                                href="{{ route('contacts.edit', ['contact' => $purchase->contact_id]) }}">
                                {{ $purchase->contact->name }}
                            </a>
                        </td>
                        <td>{{ number_format($purchase->total, 2) }} COP</td>
                    </tr>
                    @php
                    $total += $purchase->total;
                    @endphp
                @endforeach
            @else
                <tr>
                    <td colspan="4" class="text-center">No hay resultados</td>
                </tr>
            @endif

        </tbody>
        @if (count($purchases))
            <tfoot>
                <tr class="bg-dark">
                    <td colspan="3" class="text-white text-right font-weight-bold text-uppercase">Total</td>
                    <td colspan="1" class="text-white font-weight-bold">{{ number_format($total, 2) }}</td>
                </tr>
            </tfoot>
        @endif
    </table>

    <div class="d-flex justify-content-center">
        {{ $purchases->links() }}
    </div>

@endsection
