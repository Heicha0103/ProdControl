document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('newOrderModal');
    const newOrderBtn = document.getElementById('newOrderBtn');
    const closeModalBtn = document.querySelector('.close-modal');
    const cancelOrderBtn = document.getElementById('cancelOrder');
    const newOrderForm = document.getElementById('newOrderForm');

    // Abrir modal
    newOrderBtn.addEventListener('click', () => {
        modal.classList.add('active');
        document.body.style.overflow = 'hidden'; // Prevenir scroll
    });

    // Cerrar modal
    const closeModal = () => {
        modal.classList.remove('active');
        document.body.style.overflow = '';
        newOrderForm.reset(); // Limpiar formulario
    };

    closeModalBtn.addEventListener('click', closeModal);
    cancelOrderBtn.addEventListener('click', closeModal);

    // Cerrar modal al hacer clic fuera
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            closeModal();
        }
    });

    // Manejar envío del formulario
    newOrderForm.addEventListener('submit', (e) => {
        e.preventDefault();
        
        // Aquí iría la lógica para procesar la nueva orden
        const formData = new FormData(newOrderForm);
        const orderData = Object.fromEntries(formData.entries());
        
        console.log('Nueva orden:', orderData);
        
        // Cerrar modal después de procesar
        closeModal();
        
        // Aquí podrías actualizar la UI o mostrar un mensaje de éxito
    });

    // Validar fechas
    const startDate = document.getElementById('startDate');
    const endDate = document.getElementById('endDate');

    startDate.addEventListener('change', () => {
        endDate.min = startDate.value;
    });

    endDate.addEventListener('change', () => {
        startDate.max = endDate.value;
    });

    // Establecer fecha mínima como hoy
    const today = new Date().toISOString().split('T')[0];
    startDate.min = today;
    endDate.min = today;
});