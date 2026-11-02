<?php
/* Smarty version 5.8.5, created on 2026-11-02 14:13:53
  from 'file:C:\OSPanel\domains\testforum\views\default\../includes/pagination.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6ae870714d33c0_72933817',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e74cc833847ab16fa15c14c9f3144bc0c125e691' => 
    array (
      0 => 'C:\\OSPanel\\domains\\testforum\\views\\default\\../includes/pagination.tpl',
      1 => 1793618033,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6ae870714d33c0_72933817 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\OSPanel\\domains\\testforum\\views\\includes';
?><nav class="pagination">
    <?php if ($_smarty_tpl->getValue('totalPages') > 1) {?>
        <?php if ($_smarty_tpl->getValue('page') > 1) {?>
            <a href="/?<?php if ($_smarty_tpl->getValue('isPost')) {?>controller=topic&id=<?php echo $_smarty_tpl->getValue('topic')['id'];?>
&<?php }?>page=<?php echo $_smarty_tpl->getValue('page')-1;
if ($_smarty_tpl->getValue('catId')) {?>&id=<?php echo $_smarty_tpl->getValue('catId');
}?>" class="number-page">
                ← Назад
            </a>
        <?php }?>

        <?php
$_smarty_tpl->assign('i', []);$_smarty_tpl->getVariable('i')->step = 1;$_smarty_tpl->getVariable('i')->total = (int) ceil(($_smarty_tpl->getVariable('i')->step > 0 ? $_smarty_tpl->getValue('totalPages')+1 - (1) : 1-($_smarty_tpl->getValue('totalPages'))+1)/abs($_smarty_tpl->getVariable('i')->step));
if ($_smarty_tpl->getVariable('i')->total > 0) {
for ($_smarty_tpl->getVariable('i')->value = 1, $_smarty_tpl->getVariable('i')->iteration = 1;$_smarty_tpl->getVariable('i')->iteration <= $_smarty_tpl->getVariable('i')->total;$_smarty_tpl->getVariable('i')->value += $_smarty_tpl->getVariable('i')->step, $_smarty_tpl->getVariable('i')->iteration++) {
$_smarty_tpl->getVariable('i')->first = $_smarty_tpl->getVariable('i')->iteration === 1;$_smarty_tpl->getVariable('i')->last = $_smarty_tpl->getVariable('i')->iteration === $_smarty_tpl->getVariable('i')->total;?>
            <?php if ($_smarty_tpl->getValue('i') == $_smarty_tpl->getValue('page')) {?>
                <span class="current number-page-select">
                    <?php echo $_smarty_tpl->getValue('i');?>

                </span>
            <?php } else { ?>
                <a href="/?<?php if ($_smarty_tpl->getValue('isPost')) {?>controller=topic&id=<?php echo $_smarty_tpl->getValue('topic')['id'];?>
&<?php }?>page=<?php echo $_smarty_tpl->getValue('i');
if ($_smarty_tpl->getValue('catId')) {?>&id=<?php echo $_smarty_tpl->getValue('catId');
}?>" class="number-page">
                    <?php echo $_smarty_tpl->getValue('i');?>

                </a>
            <?php }?>
        <?php }
}
?>

        <?php if ($_smarty_tpl->getValue('page') < $_smarty_tpl->getValue('totalPages')) {?>
            <a href="/?<?php if ($_smarty_tpl->getValue('isPost')) {?>controller=topic&id=<?php echo $_smarty_tpl->getValue('topic')['id'];?>
&<?php }?>page=<?php echo $_smarty_tpl->getValue('page')+1;
if ($_smarty_tpl->getValue('catId')) {?>&id=<?php echo $_smarty_tpl->getValue('catId');
}?>" class="number-page">
                Вперёд →
            </a>
        <?php }?>
    <?php }?>
</nav>
<?php }
}
