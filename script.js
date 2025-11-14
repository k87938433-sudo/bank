document.addEventListener('DOMContentLoaded', () => {
    const body = document.body;
    const accessibleBtn = document.getElementById('visually-impaired-btn');
    const darkBtn = document.getElementById('darkmode-btn');

    // восстановление состояния из localStorage
    const storedAccessible = localStorage.getItem('accessibleMode') === 'true';
    const storedDark = localStorage.getItem('darkMode') === 'true';

    if (storedAccessible) {
        body.classList.add('accessible');
    } else if (storedDark) {
        body.classList.add('dark');
    }

    // кнопка "Версия для слабовидящих"
    if (accessibleBtn) {
        accessibleBtn.addEventListener('click', () => {
            const isOn = body.classList.toggle('accessible');
            if (isOn) {
                // при включении версии для слабовидящих отключаем тёмный режим
                body.classList.remove('dark');
                localStorage.setItem('darkMode', 'false');
            }
            localStorage.setItem('accessibleMode', String(isOn));
        });
    }

    // кнопка "Тёмная тема"
    if (darkBtn) {
        darkBtn.addEventListener('click', () => {
            const isOn = body.classList.toggle('dark');
            if (isOn) {
                // при включении тёмного режима отключаем версию для слабовидящих
                body.classList.remove('accessible');
                localStorage.setItem('accessibleMode', 'false');
            }
            localStorage.setItem('darkMode', String(isOn));
        });
    }
});
