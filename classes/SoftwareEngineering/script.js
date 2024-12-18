const YOUR_API = 'RHweuBK9bfvbWTghTDrURotHxR_0dtDIQvUG8Vd46iunzqCdFCxdu9Ez-zXTdGu7kCQr17dTuxynDLkECY_OshCP06hSuswYGgmm_dh1FRHH_3WBUMMVF3Y8m6XGZXYx';
const Authorization = 'Bearer ' + YOUR_API;

const requestOptions = {
    method: 'GET',
    headers: {
        'Authorization': Authorization
    }
};

let displayRegionRecipe = document.getElementsByClassName("scrolling-box")[1];

function searchButtonFunc() {
  const searchText = document.getElementsByClassName("food-input-box")[0].value;
  const searchRadius = document.getElementsByClassName("radius-select")[0].value;

  displayRegionRecipe.innerHTML = '';
  showRecipeLoad();
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

    try {
      fetchData(searchText);
    } catch (error) {
      console.error("Error getting recipes:", error);
    }


    
}

let displayRegion = document.getElementsByClassName("scrolling-box");

const cardImage = document.getElementsByClassName("card-media");
const cardName = document.getElementsByClassName("place-name");
const cardNumber = document.getElementsByClassName("place-speciality");
const cardDistance = document.getElementsByClassName("distance");
const cardStars = document.getElementsByClassName("rating");
const cardOpen = document.getElementsByClassName("per-person");
let isOpen = false;
// Function to get businesses based on search term and location
function getWithTerm (term, latitude, longitude) {
  fetch(`https://54.90.118.87:3000/?longitude=${longitude}&latitude=${latitude}&term=${term}`, {
    method: 'GET',
  })
    .then(response => response.json())
    .then(data => {
        for (let i = 0; i < data.businesses.length; i++) {
            newRestaurantCard(displayRegion[0]);
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

  //Adds new empty card to the region passed in.
  function newRestaurantCard(region){
    region.innerHTML +=  "<div class='card'>"
                            +       "<div class='card-media'>"
                            +           "<div class='distance'></div>"
                            +       "</div>"
                            +       "<div class='card-description'>"
                            +           "<div class='about-place'>"
                            +               "<div class='place'>"
                            +                   "<p class='place-name'></p>"
                            +                   "<p class='place-speciality'></p>"
                            +               "</div>"
                            +               "<div class='place-review'>"
                            +                   "<p class='rating'></p>"
                            +                   "<p class='per-person'></p>"
                            +               "</div>"
                            +           "</div>"
                            +       "</div>"
                            +   "</div>";
  }





  function fetchData(searchTerm) {
    fetch(`https://54.90.118.87:3000/api/scrape/?searchTerm=${searchTerm}`)
      .then(response => {
        // console.log(response);
        return response.json();
      })
      .then(data => {
        console.log(data);
        hideRecipeLoad();
        displayRegionRecipe.innerHTML = '';
        for (let i = 0; i < data.length; i++) {
          let iHTML = toString(data[i].ingredientsHTML);
          let dHTML = toString(data[i].directionsHTML);
  
          displayRegionRecipe.innerHTML +=  "<div class='card'>"
                            +       "<div class='card-media'>"
                            +           "<img class='background-img' src='" + data[i].imageURL + "' alt=''>"
                            // +           "<button class='time' onclick='makeRecipePage(\"" + data[i].title + "\")'>View Recipe</button>"
                            +           "<button class='time' onclick='makeRecipePage(" + removeApostrophe(JSON.stringify(data[i])) + ")'>View Recipe</button>"
                            +       "</div>"
                            +       "<div class='card-description'>"
                            +           "<div class='about-recipe'>"
                            +               "<div class='recipe'>"
                            +                   "<a class='recipe-name' href='" + data[i].recipeURL + "'>" + data[i].title + "</a>"
                            +               "</div>"
                            +               "<div class='recipe-review'>"
                            +                   "<p class='rating'>" + data[i].rating + "&#x2605;</p>"
                            +               "</div>"
                            +           "</div>"
                            +       "</div>"
                            +   "</div>";
  
        }
  
      })
      .catch(error => {
        console.error('Error fetching scraped data:', error);
      });
  }
  
  
  
  //////////////////////////////////////////////
  function showRecipeLoad() {
    let loadRecipeBox = document.getElementsByClassName("loading-container-recipe")[0];
    loadRecipeBox.style.display = "block";
    let load = document.getElementsByClassName("loader-recipe")[0];
    load.style.display = "block";
  }
  
  function hideRecipeLoad() {
    let loadRecipeBox = document.getElementsByClassName("loading-container-recipe")[0];
    loadRecipeBox.style.display = "none";
    let load = document.getElementsByClassName("loader-recipe")[0];
    load.style.display = "none";
  }
  
  
  // function makeRecipePage(title) {
  //   let opened = window.open('recipepage.html', '_blank');
  //   opened.document.write( "<!DOCTYPE html>"
  //                         +"<html lang='en'>"
  //                         +"<head>"
  //                         +     "<meta charset='UTF-8'>"
  //                         +     "<meta name='viewport' content='width=device-width, initial-scale=1.0'>"
  //                         +     "<title>Software Engineering Group 2</title>"
  //                         +     "<link rel='stylesheet' href='stylesheets/styles.css' />"
  //                         +     "<link rel='stylesheet' href='stylesheets/tabStyles.css' />"
  //                         +     "<link rel='stylesheet' href='stylesheets/scrollStyles.css' />"
  //                         +     "<link rel='stylesheet' href='stylesheets/cardStyles.css' />"
  //                         +     "<link rel='stylesheet' href='stylesheets/cardStylesRecipe.css' />"  
  //                         +     "<script src='script.js' defer></script></head>"
  //                         + "<body>"
  //                         + "<h1>" + title + "<h1>"    
  //                         + "<br>" 
  //                         + "</body>"
  //                         + "</html>");
  // }
  
  function makeRecipePage(data) {
    let opened = window.open('recipepage.html', '_blank');
    opened.document.write( "<!DOCTYPE html>"
                          +"<html lang='en'>"
                          +"<head>"
                          +     "<meta charset='UTF-8'>"
                          +     "<meta name='viewport' content='width=device-width, initial-scale=1.0'>"
                          +     "<title>Software Engineering Group 2</title>"
                          // +     "<link rel='stylesheet' href='stylesheets/styles.css' />"
                          // +     "<link rel='stylesheet' href='stylesheets/tabStyles.css' />"
                          // +     "<link rel='stylesheet' href='stylesheets/scrollStyles.css' />"
                          // +     "<link rel='stylesheet' href='stylesheets/cardStyles.css' />"
                          // +     "<link rel='stylesheet' href='stylesheets/cardStylesRecipe.css' />"  
                          +     "<script src='script.js' defer></script></head>"
                          + "<body>"
                          + "<h1>" + data.title + "<h1>"    
                          + "<br>" 
                          + data.ingredientsHTML
                          + data.directionsHTML
                          + "</body>"
                          + "</html>");
  }

  function removeApostrophe(str) {
    return str.replace(/'/g, '');
  }