(function () {
    'use strict';

    const tooltip = document.querySelectorAll('.bs-tooltip');
    const tooltipTriggerList = [].slice.call(tooltip)
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    const popover = document.querySelectorAll('.bs-popover');
    const popoverTriggerList = [].slice.call(popover);
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });

    const formsValidation = document.querySelectorAll('.needs-validation');
    Array.prototype.slice.call(formsValidation).forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }

            form.classList.add('was-validated');
        }, false);
    });

    /* const toast = document.querySelectorAll('.bs-toast');
    const toastElList = [].slice.call(toast);
    var toastList = toastElList.map(function (toastEl) {
        return new bootstrap.Toast(toastEl)
    }); */
})();
