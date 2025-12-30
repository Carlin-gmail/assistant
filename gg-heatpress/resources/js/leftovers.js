document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('imageModal');
    const modalContent = document.getElementById('modalContent');

    document.addEventListener('click', (event) => {
        const trigger = event.target.closest('.open-modal');

        // Open modal
        if (trigger) {
            const fullImage = trigger.dataset.full;
            modalImage.src = fullImage;
            modal.classList.add('is-open');
            return;
        }

        // Close modal when clicking outside content
        if (event.target === modal) {
            modal.classList.remove('is-open');
            modalImage.src = '';
        }
    });
});
