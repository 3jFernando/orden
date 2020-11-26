<template>
    <div class="row">
        <div class="input-group mb-3 col">
            <div
                class="mr-2 input-group-append p-2 bg-light d-flex justify-content-center align-items-center"
            >
                <strong>Fecha Desde</strong>
            </div>
            <input type="date" v-model="since" class="form-control m-0" />
        </div>
        <div class="input-group mb-3 col">
            <div
                class="mr-2 input-group-append p-2 bg-light d-flex justify-content-center align-items-center"
            >
                <strong>Fecha Hasta</strong>
            </div>
            <input type="date" v-model="until" class="form-control m-0" />
        </div>
        <div class="col">
            <button type="button" v-on:click.prevent="load()" class="btn btn-dark">
                Buscar
            </button>
        </div>
    </div>
</template>

<script>

import NumberFormatCurrency from '../../utils/NumberFormat'

export default {
    props: ['since', 'until'],
    created() {
        this.load();
    },
    methods: {
      /**
       * Format currency
       */
      formatCurrency(since) {
        return NumberFormatCurrency(since);
      },
      /**
       * Cargar datos
       */
        async load() {
          await axios.post('/api/v1/home-filters', {
            since: this.since, 
            until: this.until
          }).then(response => {
            
            const data = response.data.data;

            document.querySelector('.stadistic-sales').textContent = this.formatCurrency(data.sales);
            document.querySelector('.stadistic-purchases').textContent = this.formatCurrency(data.purchases);
            document.querySelector('.stadistic-utilities').textContent = this.formatCurrency(data.utility);

          }).catch(e => {
            alert("No fue posible cargar los datos del Inicio");
          }); 
        }
    }
};
</script>
