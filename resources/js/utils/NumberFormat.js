export default function NumberFormatCurrency(price) {

  return new Intl.NumberFormat('es-ES', {
    style: 'currency', currency: 'COP'
  }).format(price);

}