<?php
/* Smarty version 5.8.5, created on 2026-11-06 11:15:48
  from 'file:C:\OSPanel\domains\testforum\views\includes\../includes/posts.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6aed8cb4e63624_32488805',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '59733866d8b44164916bf834e555aae2ff46bd5f' => 
    array (
      0 => 'C:\\OSPanel\\domains\\testforum\\views\\includes\\../includes/posts.tpl',
      1 => 1793952903,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6aed8cb4e63624_32488805 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\OSPanel\\domains\\testforum\\views\\includes';
if ($_smarty_tpl->getValue('posts')) {?>
    <div class="profile-panel" id="panel-comments" role="tabpanel">
        <ul class="posts-list">
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('posts'), 'post');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('post')->value) {
$foreach0DoElse = false;
?>
                <li class="post-item">
                    <div class="post-header">
                        <?php if ($_smarty_tpl->getValue('tab')) {?>
                        <span class="post-author"><strong><?php echo $_smarty_tpl->getValue('post')['author'];?>
</strong></span>
                        <?php } else { ?>
                        <a class="post-author" href="/?controller=user&action=profile&user_id=<?php echo $_smarty_tpl->getValue('post')['author_id'];?>
"><strong><?php echo $_smarty_tpl->getValue('post')['author'];?>
</strong></a>
                        <?php }?>
                        <span class="post-date"><?php echo $_smarty_tpl->getValue('post')['user_created_at'];?>
</span>
                    </div>
                    <div class="post-content"><?php echo nl2br((string) $_smarty_tpl->getValue('post')['content'], (bool) 1);?>
</div>
                    <?php if ($_smarty_tpl->getValue('tab')) {?>
                        <!-- Кнопка ссылка на тему -->
                    <div class="post-actions">
                        <a href="/?controller=topic&topic_id=<?php echo $_smarty_tpl->getValue('post')['topic_id'];?>
" class="btn btn-sm btn-outline"><?php echo $_smarty_tpl->getValue('post')['topic_title'];?>
</a>
                    </div>
                    <?php } else { ?>
                    <!-- Кнопка ответа (если пользователь авторизован) -->
                        <?php if ($_smarty_tpl->getValue('arrUser')) {?>
                        <div class="post-actions">
                            <button type="button" class="btn btn-sm btn-outline" onclick="openReplyForm(<?php echo $_smarty_tpl->getValue('post')['id'];?>
)">Ответить</button>
                        </div>
                        <?php }?>
                    <?php }?>
                </li>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </ul>
    </div>
<?php } else { ?>
    <?php if ($_smarty_tpl->getValue('tab')) {?>
    <div class="empty-state">Тем пока нет</div>
    <?php } else { ?>
    <div class="empty-state">
        В этой теме пока нет сообщений. Будь первым!
    </div>
    <?php }
}
}
}
