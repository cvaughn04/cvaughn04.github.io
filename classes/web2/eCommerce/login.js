document.addEventListener('DOMContentLoaded', function() {
    const links = document.querySelectorAll('.message a');
    const loginForm = document.querySelector('.login-form');
    const registerForm = document.querySelector('.register-form');

    links.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default anchor behavior

            // Toggle the visibility of both forms
            loginForm.style.display = loginForm.style.display === 'none' ? 'block' : 'none';
            registerForm.style.display = registerForm.style.display === 'none' ? 'block' : 'none';

            // Optional: Add a transition effect for opacity
            loginForm.style.opacity = loginForm.style.display === 'block' ? '1' : '0';
            registerForm.style.opacity = registerForm.style.display === 'block' ? '1' : '0';
        });
    });
});
