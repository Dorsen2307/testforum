<?php
/* Smarty version 5.8.5, created on 2026-11-06 12:10:39
  from 'file:C:\OSPanel\domains\testforum\views\includes\../includes/pagination.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6aed998fd6fa22_74244541',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b9924b939cb499432597c53bd6ff64c56ed2e9ee' => 
    array (
      0 => 'C:\\OSPanel\\domains\\testforum\\views\\includes\\../includes/pagination.tpl',
      1 => 1793956239,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6aed998fd6fa22_74244541 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\OSPanel\\domains\\testforum\\views\\includes';
?><nav class="pagination">
    <?php if ($_smarty_tpl->getValue('totalPages') > 1) {?>
        <?php if ($_smarty_tpl->getValue('page') > 1) {?>
            <a href="/?<?php if ($_smarty_tpl->getValue('isProfile')) {?>controller=user&action=profile&user_id=<?php echo $_smarty_tpl->getValue('userId');?>
&tab=<?php echo $_smarty_tpl->getValue('tab');
}
if ($_smarty_tpl->getValue('isPost')) {?>controller=topic&topic_id=<?php echo $_smarty_tpl->getValue('topic')['id'];
}?>&page=<?php echo $_smarty_tpl->getValue('page')-1;
if ($_smarty_tpl->getValue('catId')) {?>&cat_id=<?php echo $_smarty_tpl->getValue('catId');
}?>" class="number-page"
            >
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
                <a href="/?<?php if ($_smarty_tpl->getValue('isProfile')) {?>controller=user&action=profile&user_id=<?php echo $_smarty_tpl->getValue('userId');?>
&tab=<?php echo $_smarty_tpl->getValue('tab');
}
if ($_smarty_tpl->getValue('isPost')) {?>controller=topic&topic_id=<?php echo $_smarty_tpl->getValue('topic')['id'];
}?>&page=<?php echo $_smarty_tpl->getValue('i');
if ($_smarty_tpl->getValue('catId')) {?>&cat_id=<?php echo $_smarty_tpl->getValue('catId');
}?>" class="number-page"
                >
                    <?php echo $_smarty_tpl->getValue('i');?>

                </a>
            <?php }?>
        <?php }
}
?>

        <?php if ($_smarty_tpl->getValue('page') < $_smarty_tpl->getValue('totalPages')) {?>
            <a href="/?<?php if ($_smarty_tpl->getValue('isProfile')) {?>controller=user&action=profile&user_id=<?php echo $_smarty_tpl->getValue('userId');?>
&tab=<?php echo $_smarty_tpl->getValue('tab');
}
if ($_smarty_tpl->getValue('isPost')) {?>controller=topic&topic_id=<?php echo $_smarty_tpl->getValue('topic')['id'];
}?>&page=<?php echo $_smarty_tpl->getValue('page')+1;
if ($_smarty_tpl->getValue('catId')) {?>&cat_id=<?php echo $_smarty_tpl->getValue('catId');
}?>" class="number-page"
            >
                Вперёд →
            </a>
        <?php }?>
    <?php }?>
</nav>
<?php }
}
