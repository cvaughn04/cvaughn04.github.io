"use strict";
/*    JavaScript 7th Edition
      Chapter 7
      Project 07-04

      Project to create a customer queue
      Author: 
      Date:   

      Filename: project07-04.js
*/

let customers = ["Alisha Jordan","Kurt Cunningham", "Ricardo Lopez", "Chanda Rao",
                 "Kevin Grant", "Thomas Bey", "Elizabeth Anderson", "Shirley Falk",
                 "David Babin", "Arthur Blanding", "Brian Vick", "Jaime Aguilar",
                 "Eileen Rios", "Gail Watts", "Margaret Wolfe", "Kathleen Newman",
                 "Jason Searl", "Stephen Gross", "Robin Steinfeldt", "Jacob Bricker",
                 "Gene Bearden", "Charles Sorensen", "John Hilton", "David Johnson",
                 "Wesley Cho"];

let customerName = document.getElementById("customerName");
let customerList = document.getElementById("customerList");

let addButton = document.getElementById("addButton");
let searchButton = document.getElementById("searchButton");
let removeButton = document.getElementById("removeButton");
let topButton = document.getElementById("topButton");

let status = document.getElementById("status");

generateCustomerList();

// Function to generate the ordered list based on the contents of the customers array
function generateCustomerList() {
   customerList.innerHTML = "";
   for (let i = 0; i < customers.length; i++) {
      let customerItem = document.createElement("li");      
      customerItem.textContent = customers[i];     
      customerList.appendChild(customerItem);
   }
}


// Event handler for addButton
addButton.onclick = function () {
   customers.push(customerName.value);
   generateCustomerList();
   status.textContent = `${customerName.value} added to the end of the queue`;
 };
 
 // Event handler for searchButton
 searchButton.onclick = function () {
   const place = customers.indexOf(customerName.value) + 1;
 
   if (place === 0) {
     status.textContent = `${customerName.value} is not found in the queue`;
   } else {
     status.textContent = `${customerName.value} found in position ${place} of the queue`;
   }
 };
 
 // Event handler for removeButton
 removeButton.onclick = function () {
   const index = customers.indexOf(customerName.value);
 
   if (index !== -1) {
     customers.splice(index, 1);
     status.textContent = `${customerName.value} removed from the queue`;
     generateCustomerList();
   } else {
     status.textContent = `${customerName.value} is not found in the queue`;
   }
 };
 
 // Event handler for topButton
 topButton.onclick = function () {
   const topCustomer = customers.shift();
   status.textContent = `${topCustomer} removed from the top of the queue`;
   generateCustomerList();
 };
 

