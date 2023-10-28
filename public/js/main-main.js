function desplegar() {
    let elemento = document.getElementById("boton");
    let dropdown = document.getElementById("dropdown");

    elemento.addEventListener("mouseenter", (evento) => {
        if (dropdown.style.display === "block" || dropdown.classList.contains("show")) {
            dropdown.style.display = "none";
            dropdown.classList.remove("show");
        } else {
            dropdown.style.display = "block";
            dropdown.classList.add("show");
        }
    });

    dropdown.addEventListener("mouseleave", (evento) => {
        dropdown.style.display = "none";
        dropdown.classList.remove("show");
    });
}

desplegar();