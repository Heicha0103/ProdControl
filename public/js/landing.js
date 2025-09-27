// Smooth scroll para navegación
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Animación al hacer scroll
const observerOptions = {
    threshold: 0.1
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
        }
    });
}, observerOptions);

document.querySelectorAll('.benefit-cards .card, .step, .testimonial').forEach((el) => {
    el.classList.add('fade-up');
    observer.observe(el);
});

// Validación mejorada del formulario
const form = document.querySelector('.contact form');
if (form) {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validación básica
        const inputs = form.querySelectorAll('input, textarea');
        let isValid = true;
        
        inputs.forEach(input => {
            if (input.hasAttribute('required') && !input.value.trim()) {
                isValid = false;
                input.classList.add('error');
            } else {
                input.classList.remove('error');
            }
            
            // Validación de email
            if (input.type === 'email' && input.value) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(input.value)) {
                    isValid = false;
                    input.classList.add('error');
                }
            }
        });
        
        if (isValid) {
            // Simulación de envío
            const button = form.querySelector('button');
            button.disabled = true;
            button.textContent = 'Enviando...';
            
            setTimeout(() => {
                button.disabled = false;
                button.textContent = 'Solicitar Demo';
                alert('¡Gracias por tu mensaje! Nos pondremos en contacto pronto.');
                form.reset();
            }, 1500);
        }
    });
    
    // Eliminar clase de error al escribir
    form.querySelectorAll('input, textarea').forEach(input => {
        input.addEventListener('input', function() {
            this.classList.remove('error');
        });
    });
}
