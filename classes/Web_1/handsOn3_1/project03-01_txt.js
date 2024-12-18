/*    JavaScript 7th Edition
      Chapter 3
      Project 03-01

      Application to calculate total order cost
      Author: 
      Date:   

      Filename: project03-01.js
*/

const menuItems = document.getElementsByClassName('menuItem');

for(let index = 0; index < menuItems.length; index++) {
      menuItems[index].addEventListener("click", calcTotal);
}

function calcTotal(){
      let orderTotal = 0;
      for(let index = 0; index < menuItems.length; index++){
            if(menuItems[index].checked === true){
                  orderTotal += Number(menuItems[index].value);
            }
      }
      document.getElementById('billTotal').innerHTML = formatCurrency(orderTotal);
}

 // Function to display a numeric value as a text string in the format $##.## 
 function formatCurrency(value) {
    return "$" + value.toFixed(2);
 }