
const accent = localStorage.getItem("accent");

if(accent == null){
    localStorage.setItem("accent", "#1d67c7");
    location.reload()
}

const root = document.querySelector(":root");

root.style.setProperty("--accent", accent);

const changeAccent = (color) => {
  root.style.setProperty("--accent", color);
  localStorage.setItem("accent", color)
}

function checkCookies(){
    let cookies = document.cookie.split(';');
    let cookiesObj = {};

    for (let i = 0; i < cookies.length; i++) {
      let cookie = cookies[i].trim();
      let parts = cookie.split('=');
      let name = parts[0];
      let value = parts[1];
      cookiesObj[name] = value;
    }

    return cookiesObj;
}