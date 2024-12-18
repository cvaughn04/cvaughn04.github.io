window.addEventListener("load", setupForm);
window.addEventListener("load", printUserInfo);


function setupForm() {
    document.getElementById("height").onchange = calcTotal;
    document.getElementById("width").onchange = calcTotal;
}

document.getElementById("height").onchange = calcTotal;
document.getElementById("width").onchange = calcTotal;

function calcTotal() {

            let height = document.getElementById("height").value;
            let width = document.getElementById("width").value;

            if ((height <= 540) && (width <= 960)){
                document.getElementById("foodTotal").innerHTML = "16x16";
            } else if (((height < 1080) && (height > 540)) && ((width < 1920) && (width > 960))) {
                document.getElementById("foodTotal").innerHTML = "32x32";
            } else if ((height >= 1080) && (width >= 1920)) {
                document.getElementById("foodTotal").innerHTML = "64x64";
            } 

            try {
                if((height < 0) || (width < 0)) throw "Dimensions must be greater than 0";
            } catch(err) {
              foodTotal.innerHTML = err;
            } finally {
                width.value = 0;
                height.value = 0;

            }
         

}


function printUserInfo() {
    let appName = window.navigator.appName;
    document.getElementById("appName").innerHTML = "Browser Name: " + appName;

    let geo = window.navigator.geolocation;
    document.getElementById("geolocation").innerHTML = "User Location: " + geo;

    let language = window.navigator.language;
    document.getElementById("language").innerHTML = "Browser language: " + language;

    let online = window.navigator.onLine;
    document.getElementById("online").innerHTML = "Online: " + online;

    let platform = window.navigator.platform;
    document.getElementById("platform").innerHTML = "Platform: " + platform;

    let agent = window.navigator.userAgent;
    document.getElementById("agent").innerHTML = "Browser User Agent Header: " + agent;


}

