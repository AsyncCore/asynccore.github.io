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

// Path: public/pag-principal-max/main.js
document.addEventListener("DOMContentLoaded", function() {
    let tabRegisterSwitch = document.getElementById("tab-register-switch");
    let tabLoginSwitch = document.getElementById("tab-login-switch");

    tabRegisterSwitch.addEventListener("click", function() {
        switchTabs("pills-register", "pills-login", "tab-register", "tab-login");
    });

    tabLoginSwitch.addEventListener("click", function() {
        switchTabs("pills-login", "pills-register", "tab-login", "tab-register");
    });

    function switchTabs(showTab, hideTab, activeTab, inactiveTab) {
        document.getElementById(showTab).classList.add("active", "show");
        document.getElementById(hideTab).classList.remove("active", "show");
        document.getElementById(activeTab).classList.add("active");
        document.getElementById(inactiveTab).classList.remove("active");
    }
});