<template>
    <div>
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
      
      <div v-if="loading" class="my-2">
          <v-loading />
      </div>

      <div class="row row-cols-1 row-cols-md-3">
          <div class="col mb-4">

              <div class="card mb-3" style="max-width: 540px;">
                  <div class="row no-gutters">
                      <div class="col-md-4">
                          <img src="https://images.vexels.com/media/users/3/153797/isolated/preview/4c530aaa31fee46760a577666a13708d-icono-de-trazo-coloreado-de-billetes-de-dinero-by-vexels.png"
                              class="card-img" alt="...">
                      </div>
                      <div class="col-md-8">
                          <div class="card-body">
                              <h5 class="card-title">Ventas</h5>
                              <p class="card-text">
                              <h4 class="stadistic-sales text-muted">0.00</h4>
                              </p>
                          </div>
                      </div>
                  </div>
              </div>

          </div>
          <div class="col mb-4">

              <div class="card mb-3" style="max-width: 540px;">
                  <div class="row no-gutters">
                      <div class="col-md-4">
                          <img src="https://images.vexels.com/media/users/3/153797/isolated/preview/4c530aaa31fee46760a577666a13708d-icono-de-trazo-coloreado-de-billetes-de-dinero-by-vexels.png"
                              class="card-img" alt="...">
                      </div>
                      <div class="col-md-8">
                          <div class="card-body">
                              <h5 class="card-title">Compras</h5>
                              <p class="card-text">
                              <h4 class="stadistic-purchases text-muted">0.00</h4>
                              </p>
                          </div>
                      </div>
                  </div>
              </div>

          </div>
          <div class="col mb-4">

              <div class="card mb-3" style="max-width: 540px;">
                  <div class="row no-gutters">
                      <div class="col-md-4">
                          <img src="https://images.vexels.com/media/users/3/153797/isolated/preview/4c530aaa31fee46760a577666a13708d-icono-de-trazo-coloreado-de-billetes-de-dinero-by-vexels.png"
                              class="card-img" alt="...">
                      </div>
                      <div class="col-md-8">
                          <div class="card-body">
                              <h5 class="card-title">Utilidad</h5>
                              <p class="card-text">
                              <h4 class="stadistic-utilities text-muted">0.00</h4>
                              </p>
                          </div>
                      </div>
                  </div>
              </div>

          </div>
      </div>

      <br>
      <h4 class="text-dark font-weight-bold text-uppercase card-title">Ventas</h4>
      <v-sales-list :sales="sales" />

      <br>
      <h4 class="text-dark font-weight-bold text-uppercase card-title">Compras</h4>
      <v-purchases-list :purchases="purchases" />

    </div>
</template>

<script>

import NumberFormatCurrency from '../../utils/NumberFormat'

export default {
  data () {
    return {
        loading: false,
        sales: [],
        purchases: [],
    }
  },
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
            this.loading = true;
          await axios.post('/api/v1/home-filters', {
            since: this.since, 
            until: this.until
          }).then(response => {
            
            const data = response.data.data;

            document.querySelector('.stadistic-sales').textContent = this.formatCurrency(data.salesToDay);
            document.querySelector('.stadistic-purchases').textContent = this.formatCurrency(data.purchasesToDay);
            document.querySelector('.stadistic-utilities').textContent = this.formatCurrency(data.utilityToDay);

            this.sales = data.sales;
            this.purchases = data.purchases;

          }).catch(e => {
            alert("No fue posible cargar los datos del Inicio");
          }).finally(() => this.loading = false); 
        }
    }
};
</script>
