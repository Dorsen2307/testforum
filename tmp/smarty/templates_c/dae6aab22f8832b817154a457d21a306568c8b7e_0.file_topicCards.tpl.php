<?php
/* Smarty version 5.8.5, created on 2026-10-30 19:47:19
  from 'file:C:\OSPanel\domains\testforum\views\default\../includes/topicCards.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6ae4ca1721e193_41518523',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dae6aab22f8832b817154a457d21a306568c8b7e' => 
    array (
      0 => 'C:\\OSPanel\\domains\\testforum\\views\\default\\../includes/topicCards.tpl',
      1 => 1793378773,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../includes/pagination.tpl' => 1,
  ),
))) {
function content_6ae4ca1721e193_41518523 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\OSPanel\\domains\\testforum\\views\\includes';
?><div class="error" id="error_topic"><?php echo $_smarty_tpl->getValue('errorMessageTopic');?>
</div>
<?php if ($_smarty_tpl->getValue('allTopics')) {?>
    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('allTopics'), 'topic');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('topic')->value) {
$foreach0DoElse = false;
?>
    <li class="topic-row">
        <div class="topic-card-title">
            <a href="/?controller=topic&id=<?php echo $_smarty_tpl->getValue('topic')['id'];?>
"><?php echo $_smarty_tpl->getValue('topic')['title'];?>
</a>
        </div>
        <div class="topic-card-meta">
            Автор: <?php echo $_smarty_tpl->getValue('topic')['username'];?>
<br>
            <?php echo $_smarty_tpl->getValue('topic')['user_created_at'];?>

        </div>
        <div class="stats">
            Ответов: <?php echo $_smarty_tpl->getValue('topic')['post_count'];?>
<br>
            Последнее: <?php echo $_smarty_tpl->getValue('topic')['user_last_post_at'];?>

        </div>
    </li>
    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>

    <!-- Пагинатор -->
    <?php $_smarty_tpl->renderSubTemplate('file:../includes/pagination.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
} else { ?>
    Темы для обсуждения отсутствуют. Создайте тему.
<?php }
}
}
