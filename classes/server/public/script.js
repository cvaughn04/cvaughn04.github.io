// const YOUR_API = 'RHweuBK9bfvbWTghTDrURotHxR_0dtDIQvUG8Vd46iunzqCdFCxdu9Ez-zXTdGu7kCQr17dTuxynDLkECY_OshCP06hSuswYGgmm_dh1FRHH_3WBUMMVF3Y8m6XGZXYx';
// const Authorization = 'Bearer ' + YOUR_API;

// const requestOptions = {
//     method: 'GET',
//     headers: {
//         'Authorization': Authorization,
//         // 'Access-Control-Allow-Origin': 'http://localhost:3000'

//     }
// };

function searchButtonFunc() {
    const searchText = document.getElementsByClassName("food-input-box")[0].value;
    const searchRadius = document.getElementsByClassName("radius-select")[0].value;
    

    ///////////////////////////////////////////////////////////////////////
    
    //grabbing users lat and long from ip, getting search term from element,
    //then running fetch based on the search term, and lat/long

    ///////////////////////////////////////////////////////////////////////
    getLocationByIP().then(ipLocation => {
        console.log(ipLocation)
        getWithTerm(searchText, ipLocation.latitude, ipLocation.longitude);

    }).catch(error => {
        console.error("Error getting location by IP:", error);
    });


    
}


const cardImage = document.getElementsByClassName("card-media");
const cardName = document.getElementsByClassName("place-name");
const cardNumber = document.getElementsByClassName("place-speciality");
const cardDistance = document.getElementsByClassName("distance");
const cardStars = document.getElementsByClassName("rating");
const cardOpen = document.getElementsByClassName("per-person");
let isOpen = false;
// Function to get businesses based on search term and location
function getWithTerm (term, latitude, longitude) {
   fetch(`/search?term=${term}&latitude=${latitude}&longitude=${longitude}`)
   .then(response => response.json())
    .then(data => {
        for (let i = 0; i < data.businesses.length; i++) {
            console.log("Name: ", data.businesses[i].name);
            console.log("Rating: ", data.businesses[i].rating);
            console.log("Phone Number: ", data.businesses[i].display_phone);
            console.log("Distance: ", (data.businesses[i].distance / 1609.34).toFixed(2), "miles");
            console.log("\n");

            cardImage[i].style = "background-image: url(" + data.businesses[i].image_url + ")";
            cardName[i].innerHTML = data.businesses[i].name;
            cardName[i].href = data.businesses[i].url;
            cardNumber[i].innerHTML = data.businesses[i].display_phone;
            cardDistance[i].innerHTML = (data.businesses[i].distance / 1609.34).toFixed(2) + " miles";
            cardStars[i].textContent = data.businesses[i].rating + cardStars[i].textContent;
            if(data.businesses[i].is_closed == false){
                cardOpen[i].textContent = "Open Now";
            }else{
                cardOpen[i].textContent = "Closed";
            }

    }
  })
    .catch(error => console.log('error', error));


}


// Function to get user's location using IP address
async function getLocationByIP() {
    try {
      const response = await fetch("https://ipapi.co/json/");
      const data = await response.json();
      return {
        city: data.city,
        region: data.region,
        country: data.country_name,
        latitude: data.latitude,
        longitude: data.longitude
      };
    } catch (error) {
      console.error("Error fetching location by IP:", error);
      return null;
    }
  }
  
  // Function to get user's latitude and longitude using Geolocation API
  function getLocationByGeolocation() {
    return new Promise((resolve, reject) => {
      if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(
          position => {
            resolve({
              latitude: position.coords.latitude,
              longitude: position.coords.longitude
            });
          },
          error => {
            reject(error);
          }
        );
      } else {
        reject("Geolocation is not supported by this browser.");
      }
    });
  }



