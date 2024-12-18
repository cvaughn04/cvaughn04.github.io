document.addEventListener("DOMContentLoaded", function() {
  const check = document.getElementById("check");
  const loginForm = document.querySelector(".login.form form");
  const registrationForm = document.querySelector(".registration.form form");
  const forgotPasswordForm = document.querySelector(".forgot-password.form form");

  // Function to validate email format
  function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+.[^\s@]+$/;
    return emailRegex.test(email);
  }

  function isValidPassword(password) {
    const passwordRegex = /^(?=.[A-Z])(?=.[!@#$%^&()_+}{"':;?/>.<,])(?=.\d).{8,}$/;
    return passwordRegex.test(password);
  }

  // Function to handle form submission
  function handleFormSubmit(event, form) {
    event.preventDefault();

    const emailInput = form.querySelector('input[type="text"]');
    const passwordInput = form.querySelector('input[type="password"]');
    const emailValue = emailInput.value.trim();
    const passwordValue = passwordInput.value.trim();

    // Validation checks
    if (!isValidEmail(emailValue)) {
      alert("Please enter a valid email address.");
      emailInput.focus();
      return;
    }

    if (!isValidPassword(passwordValue)) {
      alert("Password must be at least 8 characters long, contain at least one capital letter, and one special character.");
      passwordInput.focus();
      return;
    }
   
    // If all validations pass, you can proceed with form submission
    // For now, let's just log the email and password
    console.log("Email:", emailValue);
    console.log("Password:", passwordValue);

    // Clear form inputs (optional)
    emailInput.value = "";
    passwordInput.value = "";
  }

  // Function to handle "Forgot Password" form submission
  function handleForgotPasswordFormSubmit(event) {
    event.preventDefault();

    const emailInput = forgotPasswordForm.querySelector('input[type="text"]');
    const emailValue = emailInput.value.trim();

    // Validation check for email
    if (!isValidEmail(emailValue)) {
      alert("Please enter a valid email address.");
      emailInput.focus();
      return;
    }

  }

  // Add form submission event listeners
  loginForm.addEventListener("submit", function(event) {
    handleFormSubmit(event, loginForm);
  });

  registrationForm.addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent the form from submitting by default
    const passwordInput = registrationForm.querySelector('input[type="password"]');
    const passwordValue = passwordInput.value.trim();
    if (!isValidPassword(passwordValue)) {
      alert("Password must be at least 8 characters long, contain at least one capital letter, and one special character.");
      passwordInput.focus();
      return;
    }
    handleFormSubmit(event, registrationForm);
  });

  forgotPasswordForm.addEventListener("submit", handleForgotPasswordFormSubmit);

  // Toggle between login, registration, and forgot password forms
  check.addEventListener("change", function() {
    if (this.checked) {
      loginForm.style.display = "none";
      registrationForm.style.display = "none";
      forgotPasswordForm.style.display = "block";
    } else {
      loginForm.style.display = "block";
      registrationForm.style.display = "none";
      forgotPasswordForm.style.display = "none";
    }
  });
});