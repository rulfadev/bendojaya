document.addEventListener('click', function (event) {
    const trigger = event.target.closest('[data-faq-trigger]');

    if (!trigger) {
        return;
    }

    const item = trigger.closest('div');
    const panel = item.querySelector('[data-faq-panel]');
    const icon = item.querySelector('[data-faq-icon]');

    if (!panel) {
        return;
    }

    const isOpen = panel.style.maxHeight && panel.style.maxHeight !== '0px';

    if (isOpen) {
        panel.style.maxHeight = '0px';
        icon?.classList.remove('rotate-45');
    } else {
        panel.style.maxHeight = panel.scrollHeight + 'px';
        icon?.classList.add('rotate-45');
    }
});