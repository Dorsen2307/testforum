<?php
/* Smarty version 5.8.5, created on 2026-11-19 17:19:49
  from 'file:C:\OSPanel\domains\testforum\views\default\../includes/header.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6aff0585dddc18_32710521',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bc3bb399918a52aa364936ee533c9dff2b170324' => 
    array (
      0 => 'C:\\OSPanel\\domains\\testforum\\views\\default\\../includes/header.tpl',
      1 => 1795097989,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6aff0585dddc18_32710521 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\OSPanel\\domains\\testforum\\views\\includes';
?><div class="header-inner">
    <span class="logo">IT Forum</span>
    <nav class="nav-links">
        <a href="/">Главная</a>
        <a href="/categories">Категории</a>
    </nav>
    <div class="user-actions">
        <?php if (!$_smarty_tpl->getValue('arrUser')) {?>
            <?php if (!$_smarty_tpl->getValue('flagAuth')) {?>
                <a type="button" href="/?controller=user&action=templateauth">Войти</a>
            <?php }?>
            <?php if (!$_smarty_tpl->getValue('flagReg')) {?>
                <a type="button" href="/?controller=user&action=templateregistration">Зарегистрироваться</a>
            <?php }?>
        <?php } else { ?>
            <?php if (!$_smarty_tpl->getValue('flagCreateTopic')) {?>
                <a type="button" href="/?controller=topic&action=templatecreatetopic">Создать тему</a>
            <?php }?>
            <a href="/?controller=user" class="username"><?php echo $_smarty_tpl->getValue('arrUser')['displayName'];?>
</a>
            <a type="button" href="/?controller=user&action=logout">Выйти</a>
        <?php }?>
    </div>
</div><?php }
}
