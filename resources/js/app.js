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

        const menu = document.createElement('div');
        menu.className = 'bj-select-menu';

        select.parentNode.insertBefore(wrapper, select.nextSibling);
        wrapper.appendChild(button);
        wrapper.appendChild(menu);

        const getSelectedOption = () => {
            return select.options[select.selectedIndex] || select.options[0];
        };

        const closeSelect = () => {
            wrapper.classList.remove('is-open');
        };

        const openSelect = () => {
            document.querySelectorAll('.bj-select-wrapper.is-open').forEach((item) => {
                if (item !== wrapper) {
                    item.classList.remove('is-open');
                }
            });

            wrapper.classList.add('is-open');
        };

        const updateLabel = () => {
            const selected = getSelectedOption();
            label.textContent = selected ? selected.textContent : 'Pilih opsi';
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
                text.textContent = option.textContent;

                const check = document.createElement('span');
                check.className = 'bj-select-option-check';
                check.innerHTML = '<i class="fa-solid fa-check"></i>';

                item.appendChild(text);
                item.appendChild(check);

                item.addEventListener('click', () => {
                    select.value = option.value;

                    Array.from(select.options).forEach((opt) => {
                        opt.selected = opt.value === option.value;
                    });

                    select.dispatchEvent(new Event('change', { bubbles: true }));

                    updateLabel();
                    renderOptions();
                    closeSelect();
                });

                menu.appendChild(item);
            });
        };

        button.addEventListener('click', () => {
            if (select.disabled) {
                return;
            }

            if (wrapper.classList.contains('is-open')) {
                closeSelect();
            } else {
                openSelect();
            }
        });

        select.addEventListener('change', () => {
            updateLabel();
            renderOptions();
        });

        updateLabel();
        renderOptions();
    });
}

document.addEventListener('DOMContentLoaded', initAdminSelects);

document.addEventListener('click', function (event) {
    if (!event.target.closest('.bj-select-wrapper')) {
        document.querySelectorAll('.bj-select-wrapper.is-open').forEach((item) => {
            item.classList.remove('is-open');
        });
    }
});

document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape') {
        document.querySelectorAll('.bj-select-wrapper.is-open').forEach((item) => {
            item.classList.remove('is-open');
        });
    }
});