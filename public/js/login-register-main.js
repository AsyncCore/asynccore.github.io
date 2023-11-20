function togglePasswordVisibility(passwordFieldId, iconId) {
    let passwordField = document.getElementById(passwordFieldId);
    let icon = document.getElementById(iconId);
    if (passwordField.type === "password") {
        passwordField.type = "text";
        icon.classList.add("fi-prohibited");
        friconix_update();
    } else {
        passwordField.type = "password";
        icon.classList.remove("fi-prohibited");
        friconix_update();
    }
}