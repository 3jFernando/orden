<template>
  <div>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" :class="{ 'active': active == 1 }" @click="changeMenu(1)" href="#">Producto</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" :class="{ 'active': active == 2 }" @click="changeMenu(2)" href="#">Ingresos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" :class="{ 'active': active == 3 }" @click="changeMenu(3)" href="#">Salidas</a>
        </li>
    </ul>
  </div>
</template>

<script>
export default {
  data () {
    return {
      active: 1
    }
  },
  methods: {
    changeMenu(menu) {
      this.active = menu;

      if(menu == 2) {
        
        document.querySelector('.section-1').style.display = 'none';
        document.querySelector('.section-3').style.display = 'none';
        document.querySelector('.section-2').style.display = 'block';

      } else if(menu == 3) {
        document.querySelector('.section-1').style.display = 'none';
        document.querySelector('.section-2').style.display = 'none';
        document.querySelector('.section-3').style.display = 'block';
      } else {
        document.querySelector('.section-3').style.display = 'none';
        document.querySelector('.section-2').style.display = 'none';
        document.querySelector('.section-1').style.display = 'block';
      }

    }
  },
}
</script>