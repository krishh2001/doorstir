  // Open specific modal by type
    function openSliderModal(type) {
        closeSliderModals();

        const modalId = {
            create: 'sliderCreateModal',
            edit: 'sliderEditModal',
            delete: 'sliderDeleteModal'
        }[type];

        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('active');
            modal.style.display = 'flex';

            // Optional: add outside click listener
            setTimeout(() => {
                window.addEventListener('click', outsideClickHandler);
            }, 0);
        }
    }

    // Close all modals
    function closeSliderModals() {
        document.querySelectorAll('.slider-modal-overlay').forEach(modal => {
            modal.classList.remove('active');
            modal.style.display = 'none';
        });

        window.removeEventListener('click', outsideClickHandler);
    }

    // Close modal on outside click
    function outsideClickHandler(event) {
        document.querySelectorAll('.slider-modal-overlay.active').forEach(modal => {
            const modalBox = modal.querySelector('.slider-modal');
            if (modalBox && !modalBox.contains(event.target)) {
                closeSliderModals();
            }
        });
    }

    // Static switch status logger
    function handleStaticStatus(checkbox) {
        console.log(checkbox.checked ? "Status: Active" : "Status: Inactive");
    }