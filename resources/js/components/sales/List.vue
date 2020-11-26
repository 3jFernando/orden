<template>
    <div>
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
                    <tr v-for="(sale, key) in sales" :key="key">
                        <td>
                            <a
                                :href="'/sales/'+sale.id"
                                class="text-info font-weight-bold"
                            >
                                Detalles
                            </a>
                        </td>
                        <td>{{ sale.date_humans }}</td>
                        <td>
                            <a
                                class="font-weight-bold"
                                :href="'/contacts/'+sale.contact_id"
                            >
                                {{ sale.contact.name }}
                            </a>
                        </td>
                        <td>{{ $parent.formatCurrency(sale.total) }}</td>
                        <td>{{ $parent.formatCurrency(sale.total_utility) }}</td>
                    </tr>
                    <tr v-if="sales.length <= 0">
                        <td colspan="5" class="text-center">
                            No hay resultados
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="d-flex justify-content-center"></div>
        </div>
    </div>
</template>

<script>

export default {
    props: {
        sales: {
            type: Array,
            default: []
        },
    }
};
</script>
