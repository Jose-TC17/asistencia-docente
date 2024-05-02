// llamando id del html
const header = document.getElementById("header");
const menu = document.getElementById("menu-line");
const sidebar = document.getElementById("sidebar");
const settings = document.getElementById("settings")
const settingsContainer = document.getElementById("settings-container");
const body = document.querySelector("body");
const bodyContainer = document.getElementById("body-container");
const angle = document.getElementById("angle");
const containerGeneral = document.getElementById("container-general");
const titleGeneral = document.getElementById("title-general");
const bodyContainerCheck = document.querySelector(".body-container.activo.check");

// funcionamiento del menu
menu.addEventListener("click", () => {
    sidebar.classList.toggle("activo");
    header.classList.toggle("activo");
    body.classList.toggle("activo");
    bodyContainer.classList.toggle("activo");
});

// funcionamiento de los ajustes
settings.addEventListener("click", () => {
    settingsContainer.classList.toggle("activo");
});

// funcionamiento del angle de contenido de general de la barra lateral
titleGeneral.addEventListener("click", () => {
    containerGeneral.classList.toggle("activo");
    titleGeneral.classList.toggle("activo");
    angle.classList.toggle("activo");
});

// funcionamiento del cerrado de la barra lateral en movil

function checkSize(){
    if(window.innerWidth <= 800){
        bodyContainer.addEventListener("click", ()=>{
            sidebar.classList.remove("activo");
            header.classList.remove("activo");
            bodyContainer.classList.remove("activo");
        });
    }
}

checkSize();

window.addEventListener("resize", checkSize);



