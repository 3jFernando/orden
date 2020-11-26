<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>ACCIONES</th>
                <th>CREACION</th>
                <th>CONTACTO</th>
                <th>TOTAL</th>
                <th>UTILIDAD</th>
            </tr>
        </thead>
        <tbody>

            @if (count($sales))
                @php
                $total = 0;
                $total_utility = 0;
                @endphp
                @foreach ($sales as $sale)
                    <tr>
                        <td>
                            <a href="{{ route('sales.show', ['sale' => $sale->id]) }}"
                                class="btn btn-sm btn-outline-dark font-weight-bold">
                                Detalles
                            </a>
                        </td>
                        <td>{{ $sale->created_at->diffForHumans() }}</td>
                        <td>
                            <a class="font-weight-bold"
                                href="{{ route('contacts.edit', ['contact' => $sale->contact_id]) }}">
                                {{ $sale->contact->name }}
                            </a>
                        </td>
                        <td>{{ number_format($sale->total, 2) }} COP</td>
                        <td>{{ number_format($sale->total_utility, 2) }} COP</td>
                    </tr>
                    @php
                    $total += $sale->total;
                    $total_utility += $sale->total_utility;
                    @endphp
                @endforeach
            @else
                <tr>
                    <td colspan="5" class="text-center">No hay resultados</td>
                </tr>
            @endif

        </tbody>
        @if (count($sales))
            <tfoot>
                <tr class="bg-dark">
                    <td colspan="3" class="text-white text-right font-weight-bold text-uppercase">Total</td>
                    <td colspan="1" class="text-white font-weight-bold">{{ number_format($total, 2) }}</td>
                    <td colspan="1" class="text-white font-weight-bold">{{ number_format($total_utility, 2) }}</td>
                </tr>
            </tfoot>
        @endif
    </table>

    <div class="d-flex justify-content-center">
        {{ $sales->links() }}
    </div>
</div>
