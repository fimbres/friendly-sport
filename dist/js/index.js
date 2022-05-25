const contenedorTarjetas = [...document.querySelectorAll(".eventos")];
const enfrente = [...document.querySelectorAll(".enfrente")];
const atras = [...document.querySelectorAll(".atras")];

contenedorTarjetas.forEach((item, i) => {
  //let dimensiones = item.getBoundingClientRect();
  let ancho = 311.85;
  console.log(ancho);

  enfrente[i].addEventListener("click", () => {
    item.scrollLeft += ancho;
  });

  atras[i].addEventListener("click", () => {
    item.scrollLeft -= ancho;
  });
});
