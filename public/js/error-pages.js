document.addEventListener("DOMContentLoaded", function() {
    type(8);
});

function type(t) {
    let codes = document.querySelectorAll("pre code");

    codes.forEach(code => {
        code.style.display = 'none'; // Ocultar todo el bloque de código inicialmente
    });

    function typeLine(codeElement, t, callback) {
        let text = codeElement.textContent;
        let i = 0;
        codeElement.textContent = ''; // Limpiar el contenido inicial
        codeElement.style.display = 'inline'; // Mostrar el bloque de código

        let se = setInterval(function () {
            i++;
            codeElement.textContent = text.slice(0, i);
            if (i === text.length) {
                clearInterval(se);
                Prism.highlightElement(codeElement); // Aplicar Prism manualmente
                callback(); // Llama al callback para procesar la siguiente línea
            }
        }, t);
    }

    function processCode(index) {
        if (index < codes.length) {
            typeLine(codes[index], t, () => processCode(index + 1));
        }
    }

    processCode(0); // Inicia el proceso con el primer elemento code
}


