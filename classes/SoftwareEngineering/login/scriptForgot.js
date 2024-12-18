document.addEventListener("DOMContentLoaded", function() {
    // Function to handle form submission
    function handleResetPassword() {
      // Get email input value
      var email = document.getElementById("email").value.trim();

      // Validation check for email
      if (!isValidEmail(email)) {
        alert("Please enter a valid email address.");
        return;
      }

      // Perform password reset process here
      // For demonstration, let's just show an alert
      alert("A password reset link has been sent to your email.");
      emailInput.value = "";

    }

    // Function to validate email format
    function isValidEmail(email) {
      const emailRegex = /^[^\s@]+@[^\s@]+.[^\s@]+$/;
      return emailRegex.test(email);
    }

    // Add click event listener to the "Reset Password" button
    document.getElementById("resetPasswordButton").addEventListener("click", handleResetPassword);
  });
