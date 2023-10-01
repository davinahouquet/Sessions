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

// Fonction simple SANS localsotrage
// function myFunction() {
//   var element = document.body;
//   element.classList.toggle("dark-mode");
// }

// Le localstorage permet de conserver le thème choisi pendant qu'on navigue entre les vues
function toggleDarkMode() {
    var element = document.body;
    element.classList.toggle("dark-mode");
    
    // Vérifie si le mode sombre est activé
    var isDarkMode = element.classList.contains("dark-mode");
    
    // Stocke l'état du mode sombre dans le local storage
    if (isDarkMode) {
      localStorage.setItem("darkMode", "enabled");
    } else {
      localStorage.setItem("darkMode", "disabled");
    }
  }
  
  // Vérifie l'état du mode sombre au chargement de la page
  window.onload = function() {
    var darkModeState = localStorage.getItem("darkMode");
    var element = document.body;
    
    // Si le mode sombre était activé lors de la dernière session, activez-le à nouveau
    if (darkModeState === "enabled") {
      element.classList.add("dark-mode");
    }
  };