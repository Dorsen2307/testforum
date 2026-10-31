<?php
/* Smarty version 5.8.5, created on 2026-10-29 12:01:37
  from 'file:post_item.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6ae30b71c3fc27_59782753',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '981b5d602b71f4aa95422f3f8a57ff6baf8897a0' => 
    array (
      0 => 'post_item.tpl',
      1 => 1793264497,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:post_item.tpl' => 2,
  ),
))) {
function content_6ae30b71c3fc27_59782753 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\OSPanel\\domains\\testforum\\views\\default';
$_smarty_tpl->assign('indent', $_smarty_tpl->getValue('level')*20, false, NULL);?>

<article id="post-<?php echo $_smarty_tpl->getValue('post')['id'];?>
" class="post-item" style="margin-left: <?php echo $_smarty_tpl->getValue('indent');?>
px;">
    <header class="post-header">
        <span class="post-author"><strong><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('post')['author'], ENT_QUOTES, 'UTF-8', true);?>
</strong></span>
        <span class="post-date"><?php echo $_smarty_tpl->getValue('post')['created_at'];?>
</span>
        <?php if ($_smarty_tpl->getValue('level') > 0) {?><span class="reply-marker">→ ответ</span><?php }?>
    </header>

    <div class="post-content">
        <?php echo htmlspecialchars((string)nl2br((string) $_smarty_tpl->getValue('post')['content'], (bool) 1), ENT_QUOTES, 'UTF-8', true);?>

    </div>

    <?php if ($_smarty_tpl->getValue('arrUser')) {?>
        <div class="post-actions">
            <button type="button" class="btn btn-sm btn-outline"
                    onclick="openReplyForm(<?php echo $_smarty_tpl->getValue('post')['id'];?>
)">
                Ответить
            </button>
        </div>
    <?php }?>

        <?php if (!( !true || empty($_smarty_tpl->getValue('post')['replies']))) {?>
        <div class="replies-container">
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('post')['replies'], 'reply');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('reply')->value) {
$foreach0DoElse = false;
?>
                <?php $_smarty_tpl->renderSubTemplate("file:post_item.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('post'=>$_smarty_tpl->getValue('reply'),'level'=>$_smarty_tpl->getValue('level')+1), (int) 0, $_smarty_current_dir);
?>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </div>
    <?php }?>
</article>
<?php }
}
