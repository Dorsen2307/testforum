<?php
/* Smarty version 5.8.5, created on 2026-10-27 11:28:48
  from 'file:registration.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6ae060c0c31591_05567206',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'faffe97d9f0e1830fcf9f91d56a3683f8171fff1' => 
    array (
      0 => 'registration.tpl',
      1 => 1793089721,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../includes/head.tpl' => 1,
    'file:../includes/header.tpl' => 1,
    'file:../includes/footer.tpl' => 1,
  ),
))) {
function content_6ae060c0c31591_05567206 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\OSPanel\\domains\\testforum\\views\\default';
?><!DOCTYPE html>
<html lang="ru">
<head>
    <?php $_smarty_tpl->renderSubTemplate('file:../includes/head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
</head>
<body>
    <header>
        <?php $_smarty_tpl->renderSubTemplate('file:../includes/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
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
            <?php $_smarty_tpl->renderSubTemplate('file:../includes/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
        </footer>
    </div>
</body>
</html>
<?php }
}
