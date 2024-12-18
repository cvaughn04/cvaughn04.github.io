


document.getElementById("cValue").onchange = function() {
      let cDegree = document.getElementById("cValue").value;
      document.getElementById("fValue").value = CelciusToFarenheit(cDegree);
}

document.getElementById("fValue").onchange = function() {
      let fDegree = document.getElementById("fValue").value;
      let cValue = document.getElementById('cValue');
      cValue.value = FarenheitToCelcius(fDegree);
}


function FarenheitToCelcius(degree) {
      degree = (degree - 32) / 1.8;
      return degree;
}

function CelciusToFarenheit(degree) {
      degree = (degree * 1.8) + 32;
      return degree;
}
