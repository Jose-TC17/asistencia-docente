

// funcion de los formularios
const newForm = document.getElementById("new_form");
const containerForms = document.getElementById("container-forms");
const xbutton = document.getElementById("x-button");

newForm.addEventListener("click", () =>{
    containerForms.classList.add("active");
});

xbutton.addEventListener("click", () =>{
    containerForms.classList.remove("active");
});