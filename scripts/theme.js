
const accent = localStorage.getItem("accent");

if(accent == null){
    localStorage.setItem("accent", "#005A70");
    location.reload()
}

const root = document.querySelector(":root");

root.style.setProperty("--accent", accent);