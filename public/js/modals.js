// Manejo de dropdowns
function setupDropdowns() {
    // Función para cerrar todos los dropdowns
    function closeAllDropdowns() {
        document.querySelectorAll('.user-profile').forEach(dropdown => {
            dropdown.classList.remove('open');
        });
    }

    // Manejador de clic para los dropdowns de usuario
    document.querySelectorAll('.user-profile').forEach(profile => {
        const button = profile.querySelector('.icon-button');
        if (button) {
            button.addEventListener('click', function(e) {
                e.stopPropagation();
                const isOpen = profile.classList.contains('open');
                closeAllDropdowns();
                if (!isOpen) {
                    profile.classList.add('open');
                }
            });
        }
    });

    // Cerrar dropdowns cuando se hace clic fuera
    document.addEventListener('click', function() {
        closeAllDropdowns();
    });

    // Evitar que se cierren los dropdowns al hacer clic dentro
    document.querySelectorAll('.user-dropdown').forEach(dropdown => {
        dropdown.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    });
}

// Inicializar dropdowns cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', setupDropdowns);

class Modal {
    constructor() {
        this.activeModals = new Set();
        this.setupGlobalListeners();
    }

    setupGlobalListeners() {
        // Cerrar modal con Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                this.closeLastModal();
            }
        });

        // Configurar triggers de modales
        document.addEventListener('click', (e) => {
            // Abrir modal
            const modalTrigger = e.target.closest('[data-modal]');
            if (modalTrigger) {
                const modalId = modalTrigger.dataset.modal;
                this.open(modalId);
            }

            // Cerrar modal
            if (e.target.matches('.modal.active') || e.target.closest('.modal-close') || e.target.closest('.btn-cancel')) {
                this.closeLastModal();
            }
        });
    }

    open(modalId) {
        const modal = document.getElementById(modalId);
        if (!modal) return;

        // Añadir a la pila de modales activos
        this.activeModals.add(modal);

        // Activar el modal
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';

        // Si es un modal de edición, cargar datos
        if (modalId.includes('edit')) {
            this.loadEditData(modal);
        }
    }

    close(modalId) {
        const modal = document.getElementById(modalId);
        if (!modal) return;

        // Remover de la pila de modales activos
        this.activeModals.delete(modal);

        // Desactivar el modal
        modal.classList.remove('active');

        // Restaurar scroll si no hay más modales activos
        if (this.activeModals.size === 0) {
            document.body.style.overflow = '';
        }

        // Limpiar formulario si existe
        const form = modal.querySelector('form');
        if (form) form.reset();
    }

    closeLastModal() {
        const lastModal = Array.from(this.activeModals).pop();
        if (lastModal) {
            this.close(lastModal.id);
        }
    }

    loadEditData(modal) {
        // Implementar lógica de carga de datos para edición
        const itemId = modal.dataset.itemId;
        if (!itemId) return;

        // Ejemplo de carga de datos
        const mockData = {
            name: 'Producto de ejemplo',
            category: 'categoria-1',
            quantity: 100,
            // ... más datos
        };

        // Rellenar formulario
        const form = modal.querySelector('form');
        if (!form) return;

        Object.entries(mockData).forEach(([key, value]) => {
            const input = form.elements[key];
            if (input) input.value = value;
        });
    }
}

// Timeline Component
class Timeline {
    constructor(container) {
        this.container = container;
    }

    addEvent(event) {
        const item = document.createElement('div');
        item.className = 'timeline-item';
        item.innerHTML = `
            <div class="timeline-header">${event.title}</div>
            <div class="timeline-content">${event.content}</div>
            <div class="timeline-time">${event.time}</div>
        `;
        this.container.appendChild(item);
    }
}

// Form Validation
class FormValidation {
    constructor(form) {
        this.form = form;
        this.setupValidation();
    }

    setupValidation() {
        this.form.addEventListener('submit', (e) => {
            e.preventDefault();
            if (this.validateForm()) {
                this.submitForm();
            }
        });
    }

    validateForm() {
        let isValid = true;
        const inputs = this.form.querySelectorAll('input, select, textarea');

        inputs.forEach(input => {
            if (input.hasAttribute('required') && !input.value) {
                this.showError(input, 'Este campo es requerido');
                isValid = false;
            }
        });

        return isValid;
    }

    showError(input, message) {
        const formGroup = input.closest('.form-group');
        let errorDiv = formGroup.querySelector('.error-message');
        
        if (!errorDiv) {
            errorDiv = document.createElement('div');
            errorDiv.className = 'error-message';
            formGroup.appendChild(errorDiv);
        }

        errorDiv.textContent = message;
        input.classList.add('error');
    }

    submitForm() {
        const formData = new FormData(this.form);
        const data = Object.fromEntries(formData);
        
        // Aquí se implementaría la lógica de envío
        console.log('Enviando datos:', data);
        
        // Cerrar modal después de enviar
        const modal = this.form.closest('.modal');
        if (modal) {
            modalManager.close(modal.id);
        }
    }
}

// Notifications
class Notification {
    static show(message, type = 'success') {
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.innerHTML = `
            <span class="material-symbols-rounded">${this.getIcon(type)}</span>
            <span>${message}</span>
        `;

        document.body.appendChild(notification);
        setTimeout(() => notification.classList.add('show'), 100);
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }

    static getIcon(type) {
        const icons = {
            success: 'check_circle',
            error: 'error',
            warning: 'warning',
            info: 'info'
        };
        return icons[type] || icons.info;
    }
}

// Inicializar
const modalManager = new Modal();

// Setup form validation for all modal forms
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.modal form').forEach(form => {
        new FormValidation(form);
    });
});
