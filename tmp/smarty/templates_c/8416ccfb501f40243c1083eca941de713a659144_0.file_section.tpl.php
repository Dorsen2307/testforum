<?php
/* Smarty version 5.8.5, created on 2026-10-26 11:13:09
  from 'file:C:\OSPanel\domains\testforum\views\default\../includes/section.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6adf0b958f20f2_54226280',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8416ccfb501f40243c1083eca941de713a659144' => 
    array (
      0 => 'C:\\OSPanel\\domains\\testforum\\views\\default\\../includes/section.tpl',
      1 => 1793002389,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6adf0b958f20f2_54226280 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\OSPanel\\domains\\testforum\\views\\includes';
?><h1><?php echo $_smarty_tpl->getValue('topicName');?>
</h1>
<p style="color: var(--text-muted); margin-bottom: 1.5rem;">
    <?php echo $_smarty_tpl->getValue('topicDescription');?>

</p><?php }
}
