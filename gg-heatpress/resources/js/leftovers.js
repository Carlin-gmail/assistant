// Modal activator
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('modal');

    document.addEventListener('click', (event) => {
        const trigger = event.target.closest('.open-modal');
        const modalImage = document.getElementById('modalImage');

        // Open modal
        if (trigger) {
            const fullImage = trigger.dataset.image; // if have an image it will be here

            modalImage.src = fullImage;
            modal.classList.add('is-open')
            modal.id = trigger.dataset.id;

            return;
        }

        // Close modal when clicking outside content
        if (event.target === modal) {
            modal.classList.remove('is-open');
            modalImage.src = '';
        }
    });
});
