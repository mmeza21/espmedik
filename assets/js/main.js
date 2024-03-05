document.getElementById("searchSpecialty").addEventListener("input", function () {
    var inputValue = this.value;

    if (/[^a-zA-Z]/.test(inputValue)) {
        document.getElementById("errorMessage").innerText = "Solo se permiten letras.";
        this.value = inputValue.replace(/[^a-zA-Z]/g, '');  // Eliminar caracteres no permitidos
    } else {
        document.getElementById("errorMessage").innerText = "";
    }
});