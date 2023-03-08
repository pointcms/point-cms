function applyTheme() {
    let theme = matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
    document.documentElement.setAttribute("data-bs-theme", theme);
}

matchMedia("(prefers-color-scheme: dark)").addEventListener("change", applyTheme);
applyTheme();