document.addEventListener("DOMContentLoaded", function () {
    const lightModeSwitcher = document.getElementById("lightModeSwitcher");
    const enlightMode = document.getElementById("enlight-mode");
    lightModeSwitcher.addEventListener("change", function () {
        enlightMode.classList.toggle("light-mode-applied");
    });
});