<?php
/* Smarty version 5.8.5, created on 2026-10-27 12:55:05
  from 'file:authorization.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6ae074f9294b31_93457161',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b6063eb5a5f93c60104688dce174d30b86e60bb0' => 
    array (
      0 => 'authorization.tpl',
      1 => 1793094902,
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
function content_6ae074f9294b31_93457161 (\Smarty\Template $_smarty_tpl) {
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
            <?php $_smarty_tpl->renderSubTemplate('file:../includes/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
        </footer>
    </div>
</body>
</html>
<?php }
}
