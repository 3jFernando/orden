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
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(purchase, key) in purchases" :key="key">
                        <td>
                            <a
                                :href="'/purchases/'+purchase.id"
                                class="text-info font-weight-bold"
                            >
                                Detalles
                            </a>
                        </td>
                        <td>{{ purchase.date_humans }}</td>
                        <td>
                            <a
                                class="font-weight-bold"
                                :href="'/contacts/'+purchase.contact_id"
                            >
                                {{ purchase.contact.name }}
                            </a>
                        </td>
                        <td>{{ $parent.formatCurrency(purchase.total) }}</td>
                    </tr>
                    <tr v-if="purchases.length <= 0">
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
        purchases: {
            type: Array,
            default: []
        }
    }
};
</script>
