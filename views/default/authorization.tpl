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
        <form id="authForm">
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

            <button type="button" class="btn-submit" onclick="loginUser()">Авторизоваться</button>
        </form>

        <footer>
            {include '../includes/footer.tpl'}
        </footer>
    </div>
</body>
</html>
