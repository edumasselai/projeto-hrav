document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form');
    form.addEventListener('submit', (event) => {
        const inputs = document.querySelectorAll('input[type="number"]');
        for (let input of inputs) {
            if (input.value < 0 || input.value > 10) {
                alert('As respostas devem estar entre 0 e 10.');
                event.preventDefault();
                break;
            }
        }
    });
});
