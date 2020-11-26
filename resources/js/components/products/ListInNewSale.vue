<template>
    <div>
        <div class="input-group mb-3">
            <div class="input-group-append">
                <button
                    type="button"
                    v-on:click.prevent="load(); search = ''"
                    class="btn btn-light"
                >
                    Actualizar listado
                </button>
            </div>
            <input
                v-model="search"
                type="text"
                class="form-control"
                placeholder="Buscar productos, por nombre o referencia"
                aria-label="Recipient's username"
                aria-describedby="basic-addon2"
            />
            <div class="input-group-append">
                <button
                    type="button"
                    v-on:click.prevent="goSearch()"
                    class="btn btn-dark"
                >
                    Buscar
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th>PRODUCTO</th>
                        <th>CANTIDAD</th>
                        <th>PRECIO</th>
                    </tr>
                </thead>
                <tbody>                    
                    <tr v-for="(product, key) in products.data" :key="key">
                        <td>
                            <button
                                type="button"
                                class="btn btn-sm btn-dark rounded-circle"
                                @click="addToCarShop(product, key)"
                            >
                                +
                            </button>
                        </td>
                        <td>
                            <b>{{ product.name }}</b
                            ><br />
                            <i>{{ product.reference }}</i>
                        </td>
                        <td v-text="product.quantity"></td>
                        <td>{{ numberFormatCurrency(product.price_sale) }}</td>
                    </tr>
                </tbody>
            </table>

           <div v-if="products.total <= 0" class="d-flex justify-content-center">
               <span>No hay resultados</span>
           </div>

           <div class="d-flex justify-content-center">
               <v-pagination
                    :data="products"
                    @pagination-change-page="load"
                />
           </div>

        </div>
    </div>
</template>

<script>

// formatos de moneda
import NumberFormat from "../../utils/NumberFormat";

export default {
    props: {
        itemCarShop: {
            type: Array,
            default: []
        },
        action: {
            type: String,
            default: 'sale'
        }
    },
    data() {
        return {
            products: {},
            search: "",
            // paginacion
            page: 1,
            perPage: 10
        };
    },
    created() {
        this.load();
    },
    methods: {
        /**
         * Format currency
         */
        numberFormatCurrency(price) {
            return NumberFormat(price); 
        },
        /**
         * Cargar productos
         */
        async load(page = 1) {
            await axios
                .get(`/api/v1/products?action=${this.action}&page=${page}`)
                .then(response => {
                    this.products = response.data.data;
                })
                .catch(e => {
                    console.log(e);
                });
        },
        /**
         * Agrear producto seleciondo
         * al carrito de compras
         */
        addToCarShop(product, key) {

            // verificar si ya esta en el listado
            let productExists = false;
            const data = this.$parent.$parent.products.filter(x => {

                // ya existe solo aumentamos su cantidad
                if(product.id === x.id) {                    
                    productExists = true;
                    
                    x.quantity_stock += 1;
                    x.total = ( parseFloat(x.price_sale) * x.quantity_stock );
                    
                }
                return [...this.$parent.$parent.products, x]
            });

            // agregar si no existe
            if(!productExists) {

                // crear las propiedes nueva (cantidad a vender, total dpor producto)
                product.quantity_stock = 1;
                product.total = product.price_sale;
                //agregar al carShop
                this.itemCarShop.push(product);                

            } else {

                // actualizar el listado con la cantidad agregada
                this.$parent.$parent.products = data;
            }

            // actualizar total
            this.$parent.$parent.calculeTotals();
            
        },
        /**
         * Buscar productos
         *  */
        async goSearch() {
            if (this.search.trim().length < 3) {
                alert("Ingresa mas caracteres para iniciar tu busqueda");
                return false;
            }

            await axios
                .post("/api/v1/products/search", {
                    search: this.search,
                    action: this.action
                })
                .then(response => {
                    this.products = response.data.data;
                })
                .catch(e => {
                    alert("Error al realizar la busqueda ", e.response.status);
                });
        }
    }
};
</script>
