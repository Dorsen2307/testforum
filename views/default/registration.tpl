<!DOCTYPE html>
<html lang="ru">
<head>
    {include '../includes/head.tpl'}
</head>
<body>
    <header>
        {include '../includes/header.tpl'}
    </header>
    <div class="container">
        <form id="registerForm">
            <!-- Имя пользователя -->
            <div class="form-group">
                <label class="form-label" for="username">Имя пользователя <span>*</span></label>
                <input type="text" id="username" name="userName" class="form-input" required minlength="3" maxlength="32"
                       placeholder="Например: dev_alex">
                <div class="hint">От 3 до 32 символов. Только латинские буквы, цифры и подчёркивания.</div>
                <div class="error" id="error_userName">Введите корректное имя пользователя</div>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label class="form-label" for="email">Email <span>*</span></label>
                <input type="email" id="email" name="email" class="form-input" required
                       placeholder="name@example.com">
                <div class="hint">Должен быть уникальным.</div>
                <div class="error" id="error_email">Введите корректный email</div>
            </div>

            <!-- Пароль -->
            <div class="form-group">
                <label class="form-label" for="password">Пароль <span>*</span></label>
                <input type="password" id="password" name="password" class="form-input" required minlength="8"
                       placeholder="Минимум 8 символов">
                <div class="hint">Минимум 8 символов. Используйте заглавные, строчные, цифры.</div>
                <div class="error" id="error_password">Пароль должен быть не короче 8 символов</div>
            </div>

            <!-- Подтверждение пароля -->
            <div class="form-group">
                <label class="form-label" for="confirm_password">Подтвердите пароль <span>*</span></label>
                <input type="password" id="confirm_password" name="confirmPassword" class="form-input" required>
                <div class="error" id="error_confirmPassword">Пароли не совпадают</div>
            </div>

            <!-- Согласие с правилами (обязательно для форума) -->
            <div class="form-group">
                <label style="display:flex;align-items:center;gap:0.5rem;color:var(--text);cursor:pointer;">
                    <input type="checkbox" name="agreeRules" required>
                    Я согласен с <a href="/rules" style="color:var(--accent)">Правилами форума</a> и политикой конфиденциальности
                </label>
            </div>

            <button type="button" class="btn-submit" onclick="registrationNewUser()">Зарегистрироваться</button>
        </form>

        <footer>
            {include '../includes/footer.tpl'}
        </footer>
    </div>
</body>
</html>
