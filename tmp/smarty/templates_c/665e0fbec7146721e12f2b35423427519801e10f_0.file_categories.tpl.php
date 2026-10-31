<?php
/* Smarty version 5.8.5, created on 2026-10-30 20:40:10
  from 'file:C:\OSPanel\domains\testforum\views\default\../includes/categories.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6ae4d67ade7d39_85817215',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '665e0fbec7146721e12f2b35423427519801e10f' => 
    array (
      0 => 'C:\\OSPanel\\domains\\testforum\\views\\default\\../includes/categories.tpl',
      1 => 1793382010,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6ae4d67ade7d39_85817215 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\OSPanel\\domains\\testforum\\views\\includes';
if ($_smarty_tpl->getValue('allCategories')) {?>
    <a href="/" class="cat-pill <?php if (!$_smarty_tpl->getValue('catId')) {?>active<?php }?>">
        Все
    </a>
    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('allCategories'), 'category');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('category')->value) {
$foreach0DoElse = false;
?>
    <a href="/?id=<?php echo $_smarty_tpl->getValue('category')['id'];?>
" class="cat-pill <?php if ($_smarty_tpl->getValue('catId') == $_smarty_tpl->getValue('category')['id']) {?>active<?php }?>">
        <?php echo $_smarty_tpl->getValue('category')['name'];?>

    </a>
    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);
} else { ?>
    Категории еще не добавлены
<?php }
}
}
