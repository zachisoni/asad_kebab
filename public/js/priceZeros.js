const cost = document.getElementById('cost');
const zero = document.getElementById('zeros');

console.log('test');

cost.addEventListener("change", (event) => {
  zero.innerText = cost.value - Math.floor(cost.value) == 0 ? ".000" : "00"
});