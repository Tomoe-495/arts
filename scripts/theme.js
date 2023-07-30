
const accent = localStorage.getItem("accent");

if(accent == null){
    localStorage.setItem("accent", "#005A70");
    location.reload()
}

const root = document.querySelector(":root");

root.style.setProperty("--accent", accent);


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