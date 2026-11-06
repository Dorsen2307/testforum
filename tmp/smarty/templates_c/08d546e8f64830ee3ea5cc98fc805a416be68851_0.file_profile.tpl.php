<?php
/* Smarty version 5.8.5, created on 2026-11-06 10:42:52
  from 'file:profile.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6aed84fc0bdf53_33305253',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '08d546e8f64830ee3ea5cc98fc805a416be68851' => 
    array (
      0 => 'profile.tpl',
      1 => 1793950971,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../includes/head.tpl' => 1,
    'file:../includes/header.tpl' => 1,
    'file:../includes/tabProfile.tpl' => 1,
    'file:../includes/footer.tpl' => 1,
  ),
))) {
function content_6aed84fc0bdf53_33305253 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\OSPanel\\domains\\testforum\\views\\default';
?><!doctype html>
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
        <h1 class="profile-title">Профиль</h1>

        <!-- Шапка профиля -->
        <div class="profile-card">
            <div class="profile-avatar">
                <?php if ($_smarty_tpl->getValue('arrProfile')['photo']) {?>
                    <img src="<?php echo $_smarty_tpl->getValue('uploadUrl');
echo $_smarty_tpl->getValue('arrProfile')['photo'];?>
" alt="Фото профиля">
                <?php } else { ?>
                    <h1 style="display: block; text-align: center"><\></h1>
                <?php }?>
            </div>
            <div class="profile-head">
                <h2 class="profile-login"><?php echo $_smarty_tpl->getValue('arrProfile')['username'];?>
 <span class="profile-meta">(<?php echo $_smarty_tpl->getValue('arrProfile')['roleName'];?>
)</span></h2>
                <div class="profile-meta">
                    <span>Почта: <a href="mailto:<?php echo $_smarty_tpl->getValue('arrProfile')['email'];?>
"><?php echo $_smarty_tpl->getValue('arrProfile')['email'];?>
</a></span>
                    <span class="meta-sep">•</span>
                    <span>Дата регистрации: <?php echo $_smarty_tpl->getValue('arrProfile')['created_at'];?>
</span>
                </div>
            </div>
        </div>

        <!-- Вкладки -->
        <div class="profile-tabs" role="tablist">
            <a class="profile-tab <?php if ($_smarty_tpl->getValue('tab') === 'about') {?>active<?php }?>" href="/?controller=user&action=profile&user_id=<?php echo $_smarty_tpl->getValue('arrProfile')['id'];?>
&tab=about">
                О себе
            </a>
            <a class="profile-tab <?php if ($_smarty_tpl->getValue('tab') === 'topics') {?>active<?php }?>" href="/?controller=user&action=profile&user_id=<?php echo $_smarty_tpl->getValue('arrProfile')['id'];?>
&tab=topics">
                Темы
            </a>
            <a class="profile-tab <?php if ($_smarty_tpl->getValue('tab') === 'posts') {?>active<?php }?>" href="/?controller=user&action=profile&user_id=<?php echo $_smarty_tpl->getValue('arrProfile')['id'];?>
&tab=posts">
                Комментарии
            </a>
            <?php if ($_smarty_tpl->getValue('isCurrentUser')) {?>
            <a class="profile-tab <?php if ($_smarty_tpl->getValue('tab') === 'settings') {?>active<?php }?>" href="/?controller=user&action=profile&user_id=<?php echo $_smarty_tpl->getValue('arrProfile')['id'];?>
&tab=settings">
                Настройки
            </a>
            <?php }?>
        </div>

        <?php $_smarty_tpl->renderSubTemplate('file:../includes/tabProfile.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

        <footer>
            <?php $_smarty_tpl->renderSubTemplate('file:../includes/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
        </footer>
    </div>
</body>
</html><?php }
}
