"use strict";
/*    JavaScript 7th Edition
      Chapter 7
      Project 07-01

      Project to validate a form used for setting up a new account
      Author: 
      Date:   

      Filename: project07-01.js
*/

let signupForm = document.getElementById("signup");

signupForm.addEventListener("submit", function (e) {
  let pwd = document.getElementById("pwd").value;
  let pwd2 = document.getElementById("pwd2").value;

  let feedback = document.getElementById("feedback");
  let feedbackconfirm = document.getElementById("feedbackconfirm");


  // prevent submit button from being clicked
  e.preventDefault();

  // regular expressions to test
  let regex1 = /^[A-Z]{3}/;
  let regex2 = /[@]/;
  let regex3 = /\d/;
  let regex4 = /[!#\$]/;

  // test if the regular expressions were filled or not
  if (pwd.length < 6) {
    feedback.textContent = "Your password must be at least 6 characters long";
  } else if (!regex1.test(pwd)) {
    feedback.textContent = "Your password must start with 3 uppercase letters";
  } else if (!regex2.test(pwd)) {
    feedback.textContent = "Your password must include the @ symbol";
  } else if (!regex3.test(pwd)) {
    feedback.textContent = "Your password must include a digit";
  } else if (!regex4.test(pwd)) {
    feedback.textContent = "Your password must include one of the following '!#$'";
  } else if (pwd != pwd2) {
    feedbackconfirm.textContent = "Your passwords must match";
  } else {
    signupForm.submit();
  }

});

