<?php
/* Smarty version 5.8.5, created on 2026-10-30 19:47:19
  from 'file:index.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6ae4ca1706b963_68965153',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '69c3af97f5c2ae8cd159681ff5879283d01d8c85' => 
    array (
      0 => 'index.tpl',
      1 => 1793378838,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../includes/head.tpl' => 1,
    'file:../includes/header.tpl' => 1,
    'file:../includes/section.tpl' => 1,
    'file:../includes/categories.tpl' => 1,
    'file:../includes/topicCards.tpl' => 1,
    'file:../includes/footer.tpl' => 1,
  ),
))) {
function content_6ae4ca1706b963_68965153 (\Smarty\Template $_smarty_tpl) {
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
        <section>
            <?php $_smarty_tpl->renderSubTemplate('file:../includes/section.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
        </section>

        <!-- Категории -->
        <div class="categories">
            <?php $_smarty_tpl->renderSubTemplate('file:../includes/categories.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
        </div>

        <!-- Список тем -->
        <ul class="topics-list">
            <?php $_smarty_tpl->renderSubTemplate('file:../includes/topicCards.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
        </ul>

        <footer>
            <?php $_smarty_tpl->renderSubTemplate('file:../includes/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
        </footer>
    </div>
</body>
</html><?php }
}
