const registerHour = document.getElementById("register-hour");

// funcion para mostrar la hora

function hour(){
    let date = new Date();
    let hour = date.getHours();
    let minutes = date.getMinutes();
    let seconds = date.getSeconds();

    let getHour = (hour < 10) ? "0" + hour : hour;
    let getMinutes = (minutes < 10) ? "0" + minutes : minutes;
    let getSeconds = (seconds < 10) ? "0" + seconds : seconds;

    registerHour.innerHTML = `${getHour}:${getMinutes}:${getSeconds }`
}

setInterval(hour, 1000);

hour();