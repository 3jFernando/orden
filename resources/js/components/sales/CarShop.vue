<template>
    <div>
        <div class="d-flex justify-content-end">
            <button
                type="button"
                class="btn btn-sm btn-dark text-white"
                data-toggle="modal"
                data-target="#modal-sales-add-product"
            >
                Agregar productos al carrito
            </button>
            <v-modal idmodal="modal-sales-add-product">
                <span slot="header">Agregar productos a la venta</span>
                <div slot="body">
                    <v-products-list-in-new-sale
                        :item-car-shop="products"
                        action="sale"
                    ></v-products-list-in-new-sale>
                </div>
                <div slot="footer" class="text-center">
                    <span>Agregar productos al carrito</span>
                </div>
            </v-modal>
        </div>

        <table class="table mt-2">
            <thead>
                <tr>
                    <th>#</th>
                    <th></th>
                    <th>PRODUCTO</th>
                    <th>PRECIO DE VENTA</th>
                    <th>CANTIDAD</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(product, key) in products" :key="key">
                    <td v-text="product.id"></td>
                    <td>
                        <button
                            type="button"
                            @click="deleteProductToCarshop(key)"
                            class="btn btn-sm btn-danger"
                        >
                            &times;
                        </button>
                    </td>
                    <td>
                        <b>{{ product.name }}</b
                        ><br />
                        <i>{{ product.reference }}</i>
                    </td>
                    <td>{{ formatCurrency(product.price_sale) }}</td>
                    <td>
                        <div
                            class="d-flex justify-content-center align-items-center"
                        >
                            <button
                                type="button"
                                @click="changeQuantityToProduct(false, product, key)"
                                class="btn btn-sm btn-light"
                            >
                                -
                            </button>
                            <b class="mx-2" :key="key">{{
                                product.quantity_stock
                            }}</b>
                            <button
                                type="button"
                                @click="changeQuantityToProduct(true, product, key)"
                                class="btn btn-sm btn-light"
                            >
                                +
                            </button>
                        </div>
                    </td>
                    <td>{{ formatCurrency(product.total) }}</td>
                </tr>
            </tbody>
        </table>

      <div class="d-flex justify-content-end w-100">
        <ul class="list-group">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Cantidad de productos
            <b class="badge badge-dark badge-pill ml-4 p-2">{{products.length}}</b>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Total
            <b class="badge badge-dark badge-pill ml-4 p-2">{{ formatCurrency(total) }}</b>
          </li>
        </ul>
      </div>

    </div>
</template>

<script>

// helpers formatear monead
import NumberFormatCurrency from '../../utils/NumberFormat'

export default {
    data() {
        return {
            products: [],
            total: 0,
        };
    },
    created() {
        this.validSessionErrors();
    },
    methods: { 
        /**
         * Validar si hay sessiones de errors
         *  */  
        validSessionErrors() {

            const sessionTotal = document.querySelector('#sale-total').value;
            const sessionProducts = JSON.parse(document.querySelector('#sale-products').value);

            this.total = sessionTotal; // total
            this.products = sessionProducts; // productos
        },
        /**
         * Formatera los valores de monedas
         */
        formatCurrency(price) {
          return NumberFormatCurrency(price);
        },
        /**
         * Quitar un producto del carrito de compras
         */
        deleteProductToCarshop(key) {
            this.products.splice(key, 1);
            this.calculeTotals();
        },
        /**
         * Aumentar o disminuiir la cantidad en un producto
         */
        changeQuantityToProduct(action, product, key) {

            // valdiar cantidad 
            if(product.quantity_stock < 2 && !action) {
                if(confirm("No puedes vender cantidades en 0 \n\nSi deseas puedes eliminar el producto del carrito de compras"))
                    this.deleteProductToCarshop(key)
                else
                    return false;    
            }  

            this.products = this.products.filter((x,index) => {

                if(x.id === product.id) {
                  // cantidad actual
                  if(action) {
                      product.quantity_stock += 1;
                  } else {
                      product.quantity_stock -= 1;
                  }
                  product.total = ( parseFloat(product.price_sale) * product.quantity_stock ); // precio total
                }

                return [...this.products, product];
            });
            this.calculeTotals();
        },
        /**
         * Calcular total de la venta
         */
        calculeTotals() {
            this.total = 0;
            this.products.map(x => this.total += parseFloat(x.total));

            document.querySelector('#sale-total').value = this.total; // total
            document.querySelector('#sale-products').value = JSON.stringify(this.products); // productos
        }
    }
};
</script>
