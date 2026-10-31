<?php
/* Smarty version 5.8.5, created on 2026-10-28 08:06:26
  from 'file:C:\OSPanel\domains\testforum\views\default\../includes/topicCards.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6ae182d2c29b19_35585843',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '692d93ed791a069230983dd7dc78de3ea092148e' => 
    array (
      0 => 'C:\\OSPanel\\domains\\testforum\\views\\default\\../includes/topicCards.tpl',
      1 => 1793163986,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6ae182d2c29b19_35585843 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\OSPanel\\domains\\testforum\\views\\includes';
if ($_smarty_tpl->getValue('allTopics')) {?>
    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('allTopics'), 'topic');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('topic')->value) {
$foreach0DoElse = false;
?>
    <li class="topic-row">
        <div class="topic-title">
            <a href="/?controller=topic&id=<?php echo $_smarty_tpl->getValue('topic')['id'];?>
"><?php echo $_smarty_tpl->getValue('topic')['title'];?>
</a>
        </div>
        <div class="topic-meta">
            Автор: <?php echo $_smarty_tpl->getValue('topic')['username'];?>
<br>
            <?php echo $_smarty_tpl->getValue('topic')['created_at'];?>

        </div>
        <div class="stats">
            Ответов: <?php echo $_smarty_tpl->getValue('topic')['post_count'];?>
<br>
            Последнее: <?php echo $_smarty_tpl->getValue('topic')['last_post_at'];?>

        </div>
    </li>
    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);
} else { ?>
    Темы для обсуждения отсутствуют. Создайте тему.
<?php }
}
}
