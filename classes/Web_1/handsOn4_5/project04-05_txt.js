"use strict";
/*    JavaScript 7th Edition
      Chapter 4
      Project 04-05

      Degrees <-> Radians Coverter
      Author: 
      Date:   

      Filename: project04-05.js
 */

// Event handler that converts radians to degrees when the input box is changed
document.getElementById("rValue").onchange = function() {
   let radians = document.getElementById("rValue").value;
   document.getElementById("aValue").value = formatValue3(radiansToDegrees(radians));
}

// Event handler that converts degrees to radians when the input box is changed
document.getElementById("aValue").onchange = function() {
   let degrees = document.getElementById("aValue").value;
   document.getElementById("rValue").value = formatValue3(degreesToRadians(degrees));
}

// Function to convert degrees to radians 
function degreesToRadians(degrees) {
   degrees = degrees*Math.PI/180;
   return degrees;
}

// Function to convert radians to degrees
function radiansToDegrees(radians) {
   radians = radians*180/Math.PI;
   return radians;
}

/* ================================================================= */
 // Function to display a numeric value in the format ##.### 
 function formatValue3(value) {
    value = value.toFixed(3);
    return value;
 }