banUser();

function banUser() {
    const modal   = document.getElementById('banModal');
    const form    = document.getElementById('banForm');
    const inputId = document.getElementById('banUserId');
    const nameEl  = document.getElementById('banUserName');
    const preset  = document.getElementById('banReasonPreset');
    const reason  = document.getElementById('banReason');

    // Кнопки "Бан" в таблице
    document.querySelectorAll('[data-ban-user]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            inputId.value = btn.dataset.banUser;
            nameEl.textContent = btn.dataset.banName;
            modal.classList.add('is-open');
            reason.focus();
        });
    });

    // Выбор причины из списка подставляет её в поле
    preset.addEventListener('change', function () {
        if (preset.value) {
            reason.value = preset.value;
        }
    });

    function closeModal() {
        modal.classList.remove('is-open');
        form.reset();
    }

    document.getElementById('banModalClose').addEventListener('click', closeModal);
    document.getElementById('banModalCancel').addEventListener('click', closeModal);

    // Клик по тёмному фону — тоже закрыть
    modal.addEventListener('click', function (e) {
        if (e.target === modal) closeModal();
    });

    // Esc — закрыть
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && !modal.hidden) closeModal();
    });
}