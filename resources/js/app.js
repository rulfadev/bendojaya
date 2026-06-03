import '@fortawesome/fontawesome-free/css/all.min.css';

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

const adminSelectInstances = [];

function closeAllAdminSelects(except = null) {
    adminSelectInstances.forEach((instance) => {
        if (instance !== except) {
            instance.close();
        }
    });
}

function initAdminSelects() {
    const adminLayout = document.querySelector('[data-admin-layout]');

    if (!adminLayout) {
        return;
    }

    const selects = adminLayout.querySelectorAll('select:not([data-native-select]):not([data-bj-select-ready])');

    selects.forEach((select) => {
        if (select.multiple) {
            return;
        }

        select.dataset.bjSelectReady = 'true';
        select.classList.add('bj-select-hidden');

        const nativeIcon = select.parentElement?.querySelector('[data-native-select-icon]');

        if (nativeIcon) {
            nativeIcon.classList.add('hidden');
        }

        const wrapper = document.createElement('div');
        wrapper.className = 'bj-select-wrapper';

        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'bj-select-button';
        button.disabled = select.disabled;

        const label = document.createElement('span');
        label.className = 'bj-select-label';

        const icon = document.createElement('span');
        icon.className = 'bj-select-icon';
        icon.innerHTML = '<i class="fa-solid fa-chevron-down text-xs"></i>';

        button.appendChild(label);
        button.appendChild(icon);
        wrapper.appendChild(button);

        const menu = document.createElement('div');
        menu.className = 'bj-select-menu';
        document.body.appendChild(menu);

        select.insertAdjacentElement('afterend', wrapper);

        const instance = {
            wrapper,
            menu,
            close() {
                wrapper.classList.remove('is-open');
                menu.classList.remove('is-open');
            },
            open() {
                closeAllAdminSelects(instance);
                positionMenu();
                wrapper.classList.add('is-open');
                menu.classList.add('is-open');

                const selectedItem = menu.querySelector('.bj-select-option.is-selected');

                if (selectedItem) {
                    selectedItem.scrollIntoView({
                        block: 'nearest',
                    });
                }
            },
        };

        adminSelectInstances.push(instance);

        const getSelectedOption = () => {
            return select.options[select.selectedIndex] || select.options[0] || null;
        };

        const updateLabel = () => {
            const selected = getSelectedOption();
            label.textContent = selected ? selected.textContent.trim() : 'Pilih opsi';
        };

        const positionMenu = () => {
            const rect = button.getBoundingClientRect();
            const gap = 8;
            const menuHeight = Math.min(menu.scrollHeight || 260, 260);
            const spaceBelow = window.innerHeight - rect.bottom;
            const openUp = spaceBelow < menuHeight + gap && rect.top > menuHeight + gap;

            menu.style.width = rect.width + 'px';
            menu.style.left = rect.left + 'px';

            if (openUp) {
                menu.style.top = rect.top - menuHeight - gap + 'px';
                menu.style.transformOrigin = 'bottom';
            } else {
                menu.style.top = rect.bottom + gap + 'px';
                menu.style.transformOrigin = 'top';
            }
        };

        const renderOptions = () => {
            menu.innerHTML = '';

            Array.from(select.options).forEach((option) => {
                const item = document.createElement('button');
                item.type = 'button';
                item.className = 'bj-select-option';
                item.dataset.value = option.value;

                if (option.disabled) {
                    item.classList.add('is-disabled');
                    item.disabled = true;
                }

                if (option.selected) {
                    item.classList.add('is-selected');
                }

                const text = document.createElement('span');
                text.textContent = option.textContent.trim();

                const check = document.createElement('span');
                check.className = 'bj-select-option-check';
                check.innerHTML = '<i class="fa-solid fa-check"></i>';

                item.appendChild(text);
                item.appendChild(check);

                item.addEventListener('click', (event) => {
                    event.preventDefault();

                    select.value = option.value;

                    Array.from(select.options).forEach((opt) => {
                        opt.selected = opt.value === option.value;
                    });

                    select.dispatchEvent(new Event('change', { bubbles: true }));

                    updateLabel();
                    renderOptions();
                    instance.close();
                });

                menu.appendChild(item);
            });
        };

        button.addEventListener('click', (event) => {
            event.preventDefault();
            event.stopPropagation();

            if (select.disabled) {
                return;
            }

            if (wrapper.classList.contains('is-open')) {
                instance.close();
            } else {
                instance.open();
            }
        });

        select.addEventListener('change', () => {
            updateLabel();
            renderOptions();
        });

        window.addEventListener('resize', () => {
            if (wrapper.classList.contains('is-open')) {
                positionMenu();
            }
        });

        window.addEventListener(
            'scroll',
            () => {
                if (wrapper.classList.contains('is-open')) {
                    positionMenu();
                }
            },
            true
        );

        updateLabel();
        renderOptions();
    });
}

document.addEventListener('DOMContentLoaded', initAdminSelects);

document.addEventListener('click', function (event) {
    const clickedInsideCustomSelect =
        event.target.closest('.bj-select-wrapper') ||
        event.target.closest('.bj-select-menu');

    if (!clickedInsideCustomSelect) {
        closeAllAdminSelects();
    }
});

document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape') {
        closeAllAdminSelects();
    }
});

window.initAdminSelects = initAdminSelects;