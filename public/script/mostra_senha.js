function togglePasswordVisibility(inputId, iconId) {
    var senhaInput = document.getElementById(inputId);
    var toggleIcon = document.getElementById(iconId);

    if (senhaInput.type === "password") {
        senhaInput.type = "text";
        toggleIcon.classList.remove("fa-eye-slash");
        toggleIcon.classList.add("fa-eye");
    } else {
        senhaInput.type = "password";
        toggleIcon.classList.remove("fa-eye");
        toggleIcon.classList.add("fa-eye-slash");
    }
}