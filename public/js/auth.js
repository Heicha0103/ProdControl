// Toggle password visibility
document.querySelectorAll('.toggle-password').forEach(button => {
    button.addEventListener('click', function() {
        const input = this.parentElement.querySelector('input');
        const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
        input.setAttribute('type', type);
        const icon = this.querySelector('.material-symbols-rounded');
        icon.textContent = type === 'password' ? 'visibility_off' : 'visibility';
    });
});

// Form validation
function validateForm(form) {
    const inputs = form.querySelectorAll('input');
    let isValid = true;

    inputs.forEach(input => {
        input.classList.remove('error');
        const errorMessage = input.parentElement.querySelector('.error-message');
        if (errorMessage) {
            errorMessage.remove();
        }

        if (input.hasAttribute('required') && !input.value.trim()) {
            showError(input, 'Este campo es requerido');
            isValid = false;
        }

        if (input.type === 'email' && input.value) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(input.value)) {
                showError(input, 'Email inválido');
                isValid = false;
            }
        }

        if (input.id === 'confirmPassword' && input.value) {
            const password = document.getElementById('password');
            if (input.value !== password.value) {
                showError(input, 'Las contraseñas no coinciden');
                isValid = false;
            }
        }
    });

    return isValid;
}

function showError(input, message) {
    const formGroup = input.parentElement;
    formGroup.classList.add('error');
    const error = document.createElement('span');
    error.className = 'error-message';
    error.textContent = message;
    formGroup.appendChild(error);
}

// Login form submission
const loginForm = document.getElementById('loginForm');
if (loginForm) {
    loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        if (validateForm(this)) {
            // Simulate API call
            const button = this.querySelector('button[type="submit"]');
            const originalText = button.textContent;
            button.disabled = true;
            button.textContent = 'Iniciando sesión...';

            setTimeout(() => {
                // Redirect to dashboard
                window.location.href = 'index.html';
            }, 1500);
        }
    });
}

// Register form submission
const registerForm = document.getElementById('registerForm');
if (registerForm) {
    registerForm.addEventListener('submit', function(e) {
        e.preventDefault();
        if (validateForm(this)) {
            // Simulate API call
            const button = this.querySelector('button[type="submit"]');
            const originalText = button.textContent;
            button.disabled = true;
            button.textContent = 'Creando cuenta...';

            setTimeout(() => {
                // Redirect to dashboard
                window.location.href = 'index.html';
            }, 1500);
        }
    });
}