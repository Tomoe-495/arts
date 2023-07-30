
function changeTheme(color){
    root.style.setProperty("--accent", color);
    localStorage.setItem("accent", color);
}

