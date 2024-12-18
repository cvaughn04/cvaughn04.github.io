const CHICKEN_PRICE = 10.00;
const HALIBUT_PRICE = 5.00;
const BURGER_PRICE = 50.00;
// const SALMON_PRICE = 18.95;
// const SALAD_PRICE = 7.95;
const SALES_TAX = 0.07;

window.addEventListener("load", setupForm);

function setupForm() {
    calcTotal(0);
    document.getElementById("chicken").onchange = calcTotal;
    document.getElementById("halibut").onchange = calcTotal;
    document.getElementById("burger").onchange = calcTotal;
    // document.getElementById("salmon").onchange = calcTotal;
    // document.getElementById("salad").onchange = calcTotal;

}

document.getElementById("chicken").onchange = calcTotal;
document.getElementById("halibut").onchange = calcTotal;
document.getElementById("burger").onchange = calcTotal;
// document.getElementById("salmon").onchange = calcTotal;
// document.getElementById("salad").onchange = calcTotal;


function calcTotal() {
   let totalCost = 0;
            let photographers = document.getElementById("chicken").value;
            let hours = document.getElementById("halibut").value;
            let buyBurger = document.getElementById("burger").checked;


            totalCost = totalCost + photographers * CHICKEN_PRICE;

            totalCost = totalCost + hours  * HALIBUT_PRICE;

            totalCost = totalCost + (buyBurger ? BURGER_PRICE : 0);



            document.getElementById("foodTotal").innerHTML = formatCurrency(totalCost);

            tax = SALES_TAX * totalCost;
         
            document.getElementById("foodTax").innerHTML = formatCurrency(tax);
         
            cost = totalCost + tax;
         
            document.getElementById("totalBill").innerHTML = formatCurrency(totalCost);



       

}




// Function to display a numeric value as a text string in the format $##.## 
function formatCurrency(value) {
return "$" + value.toFixed(2);
}
