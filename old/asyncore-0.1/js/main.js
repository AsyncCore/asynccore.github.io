let pwd = document.getElementById("pwd");
let pwd2 = document.getElementById("pwd2");
let mail = document.getElementById("mail");

validatePassword(pwd, "pwd_message");
validatePassword(pwd2, "pwd_message2");
validateMail(mail);

/* Función para mostrar u ocultar la contraseña */
function togglePasswordVisibility(className) {
    /* Seleccionar los iconos delos ojos y los inputs*/
    let showPasswordButton1 = document.querySelector('.show_pwd');
    let showPasswordButton2 = document.querySelector('.show_pwd2');
    let passwordInput = document.querySelector('.pwd_input');
    let passwordInput2 = document.querySelector('.pwd_input2');
    let state1 = "fa-eye";
    let state2 = "fa-eye-slash";

    /* Cambiar el tipo de input de password a text y viceversa para mostrar la contraseña */
    if (!className.includes("show_pwd2")) {
        passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
        showPasswordButton1.classList.toggle(state1);
        showPasswordButton1.classList.toggle(state2);
    } else {
        passwordInput2.type = passwordInput2.type === 'password' ? 'text' : 'password';
        showPasswordButton2.classList.toggle(state1);
        showPasswordButton2.classList.toggle(state2);
    }
}

/* Función para validar el mail */
function validateMail(mail) {
    let messageElement = document.getElementById("mail_message");

    mail.onkeyup = function () {
        if (mail.value.match("[a-z0-9._%+-]+@educa\.madrid\.org$")) {
            messageElement.innerText = "El correo es válido";
            messageElement.classList.remove("invalid");
            messageElement.classList.add("valid");
            document.getElementById("delete_p").style.display = "none";
        } else {
            messageElement.innerText = "El correo no es válido";
            messageElement.classList.remove("valid");
            messageElement.classList.add("invalid");
            document.getElementById("delete_p").style.display = "block"
        }
    }

    mail.onfocus = function () {
        document.getElementsByClassName("mail_message")[0].style.display = "block";
    }

    mail.onblur = function () {
        document.getElementsByClassName("mail_message")[0].style.display = "none";
    }
    return false;
}

/* Evento onsubmit para comprobar los campos del formulario al ser enviados*/
var form = document.getElementById("form");
form.onsubmit = function (event) {
    let nombre = document.getElementById("nombre_usuario").value;
    let apellidos = document.getElementById("apellidos").value;
    let pwd = document.getElementById("pwd").value;
    let pwd2 = document.getElementById("pwd2").value;
    event.preventDefault();
    if (nombre.length <= 2 || apellidos.length <= 2) {
        alert("El nombre o los apellidos no pueden ser menor de 2 caracteres");
    } else if (pwd !== pwd2) {
        alert("Las contraseñas no coinciden");
    } else {
        alert("Formulario enviado");
        form.submit();
    }
}

/* Función para validar las contraseñas */
function validatePassword(inputElement, messageClassName) {
    let length;
    let number;
    let capital;
    let letter;
    let message = document.getElementById("message");
    let messageElement = document.getElementsByClassName(messageClassName)[0];
    let equalPasswords = document.getElementsByClassName("pwd_message3")[0];

    if (inputElement === pwd) {
        letter = document.getElementById("letter");
        capital = document.getElementById("capital");
        number = document.getElementById("number");
        length = document.getElementById("length");
    } else {
        letter = document.getElementById("letter2");
        capital = document.getElementById("capital2");
        number = document.getElementById("number2");
        length = document.getElementById("length2");
    }

    /* Mostrar la caja de validación cuando alguno de los campos de
    contraseña tenga el foco */
    inputElement.onfocus = function () {
        messageElement.style.display = "block";
        if (pwd2.value !== "" || pwd.value !== "") {
            equalPasswords.style.display = "block";
        }
    }

    /* Ocultar la caja de validación cuando alguno de los campos de
    contraseña pierda el foco */
    inputElement.onblur = function () {
        messageElement.style.display = "none";
    }

    /* Realizar la validación cada vez que el usuario teclee algo */
    inputElement.onkeyup = function () {
        let lowerCaseLetters = /[a-z]/g;
        let upperCaseLetters = /[A-Z]/g;
        let numbers = /[0-9]/g;

        /* Validar letras minúsculas */
        if (inputElement.value.match(lowerCaseLetters)) {
            letter.classList.remove("invalid");
            letter.classList.add("valid");
        } else {
            letter.classList.remove("valid");
            letter.classList.add("invalid");
        }

        /* Validar letras mayúsculas */
        if (inputElement.value.match(upperCaseLetters)) {
            capital.classList.remove("invalid");
            capital.classList.add("valid");
        } else {
            capital.classList.remove("valid");
            capital.classList.add("invalid");
        }

        /* Validar números */
        if (inputElement.value.match(numbers)) {
            number.classList.remove("invalid");
            number.classList.add("valid");
        } else {
            number.classList.remove("valid");
            number.classList.add("invalid");
        }

        /* Validar longitud */
        if (inputElement.value.length >= 8) {
            length.classList.remove("invalid");
            length.classList.add("valid");
        } else {
            length.classList.remove("valid");
            length.classList.add("invalid");
        }

        /* Validar que las contraseñas coincidan */
        if (pwd2.value === pwd.value) {
            equalPasswords.style.display = "block";
            message.innerText = "Las contraseñas coinciden";
            message.classList.remove("invalid");
            message.classList.add("valid");
        } else {
            equalPasswords.style.display = "block";
            message.innerText = "Las contraseñas no coinciden";
            message.classList.remove("valid");
            message.classList.add("invalid");
        }
    }
}