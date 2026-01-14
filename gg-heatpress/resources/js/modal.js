// Modal for images
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('modal');

    document.addEventListener('click', (event) => {
        console.log(event.target);
        const trigger = event.target.closest('.open-modal');
        const modalImage = document.getElementById('modalImage');

        // Open modal
        if (trigger) {
            if (trigger.dataset.image) {
                const fullImage = trigger.dataset.image; // if have an image it will be here
                modalImage.src = fullImage;
            }
            modal.classList.add('is-open');
            modal.style.display = 'flex';
            modal.id = trigger.dataset.id;

            return;
        }

        // Close modal when clicking outside content
        if (event.target === modal) {
            modal.classList.remove('is-open');
            modal.style.display = 'none';
            modalImage.src = '';
        }
    });
});
