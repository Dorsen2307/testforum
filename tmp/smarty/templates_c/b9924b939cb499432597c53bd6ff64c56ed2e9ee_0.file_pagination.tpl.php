<?php
/* Smarty version 5.8.5, created on 2026-11-16 09:41:22
  from 'file:C:\OSPanel\domains\testforum\views\includes\../includes/pagination.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6afaa592ab8365_98394233',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b9924b939cb499432597c53bd6ff64c56ed2e9ee' => 
    array (
      0 => 'C:\\OSPanel\\domains\\testforum\\views\\includes\\../includes/pagination.tpl',
      1 => 1794554423,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6afaa592ab8365_98394233 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\OSPanel\\domains\\testforum\\views\\includes';
if ($_smarty_tpl->getValue('pagination')['totalPages'] > 1) {?>
<nav class="pagination">
    <?php if ($_smarty_tpl->getValue('pagination')['currentPage'] > 1) {?>
        <a href="/?<?php if ($_smarty_tpl->getValue('isProfile')) {?>controller=user&action=profile&user_id=<?php echo $_smarty_tpl->getValue('userId');?>
&tab=<?php echo $_smarty_tpl->getValue('tab');
}
if ($_smarty_tpl->getValue('isPost')) {?>controller=topic&topic_id=<?php echo $_smarty_tpl->getValue('topic')['id'];
}
if ($_smarty_tpl->getValue('isAdministration')) {?>controller=admin&action=users<?php }?>&page=<?php echo $_smarty_tpl->getValue('pagination')['currentPage']-1;
if ($_smarty_tpl->getValue('catId')) {?>&cat_id=<?php echo $_smarty_tpl->getValue('catId');
}?>"
        >
            ←
        </a>
    <?php }?>

    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('pagination')['pageList'], 'p');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('p')->value) {
$foreach0DoElse = false;
?>
        <?php if ($_smarty_tpl->getValue('p') == '...') {?>
            <span class="gap">...</span>
        <?php } elseif ($_smarty_tpl->getValue('p') == $_smarty_tpl->getValue('pagination')['currentPage']) {?>
            <span class="active"><?php echo $_smarty_tpl->getValue('p');?>
</span>
        <?php } else { ?>
            <a href="/?<?php if ($_smarty_tpl->getValue('isProfile')) {?>controller=user&action=profile&user_id=<?php echo $_smarty_tpl->getValue('userId');?>
&tab=<?php echo $_smarty_tpl->getValue('tab');
}
if ($_smarty_tpl->getValue('isPost')) {?>controller=topic&topic_id=<?php echo $_smarty_tpl->getValue('topic')['id'];
}
if ($_smarty_tpl->getValue('isAdministration')) {?>controller=admin&action=users<?php }?>&page=<?php echo $_smarty_tpl->getValue('p');
if ($_smarty_tpl->getValue('catId')) {?>&cat_id=<?php echo $_smarty_tpl->getValue('catId');
}?>"
            >
                <?php echo $_smarty_tpl->getValue('p');?>

            </a>
        <?php }?>
    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>

    <?php if ($_smarty_tpl->getValue('pagination')['currentPage'] < $_smarty_tpl->getValue('pagination')['totalPages']) {?>
        <a href="/?<?php if ($_smarty_tpl->getValue('isProfile')) {?>controller=user&action=profile&user_id=<?php echo $_smarty_tpl->getValue('userId');?>
&tab=<?php echo $_smarty_tpl->getValue('tab');
}
if ($_smarty_tpl->getValue('isPost')) {?>controller=topic&topic_id=<?php echo $_smarty_tpl->getValue('topic')['id'];
}
if ($_smarty_tpl->getValue('isAdministration')) {?>controller=admin&action=users<?php }?>&page=<?php echo $_smarty_tpl->getValue('pagination')['currentPage']+1;
if ($_smarty_tpl->getValue('catId')) {?>&cat_id=<?php echo $_smarty_tpl->getValue('catId');
}?>"
        >
            →
        </a>
    <?php }?>
</nav>
<?php }
}
}
