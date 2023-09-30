// Responsive, permet de faire apparaître les éléments de la nav lorsuq'on clique sur le menu
const links = document.querySelectorAll('nav li');

icons.addEventListener("click", () => {
    nav.classList.toggle("active")
})

links.forEach((link)=>{
    link.addEventListener('click', ()=>{
        nav.classList.remove("active");
    });
});

// Theme color : dark/light

function myFunction() {
  var element = document.body;
  element.classList.toggle("dark-mode");
}
