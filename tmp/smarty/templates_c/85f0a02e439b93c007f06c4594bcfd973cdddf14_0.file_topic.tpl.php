<?php
/* Smarty version 5.8.5, created on 2026-10-30 20:28:52
  from 'file:topic.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6ae4d3d4b9b524_73700605',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '85f0a02e439b93c007f06c4594bcfd973cdddf14' => 
    array (
      0 => 'topic.tpl',
      1 => 1793378072,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../includes/head.tpl' => 1,
    'file:../includes/header.tpl' => 1,
    'file:../includes/section.tpl' => 1,
    'file:../includes/footer.tpl' => 1,
  ),
))) {
function content_6ae4d3d4b9b524_73700605 (\Smarty\Template $_smarty_tpl) {
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

    <div class="page-topic">
        <!-- Шапка темы -->
        <div class="topic-header">
            <h1 class="topic-title"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('topic')['title'], ENT_QUOTES, 'UTF-8', true);?>
</h1>
            <div class="topic-content"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('topic')['content'], ENT_QUOTES, 'UTF-8', true);?>
</div>
            <div class="topic-meta">
                <span class="meta-item">Автор: <strong><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('topic')['author'], ENT_QUOTES, 'UTF-8', true);?>
</strong></span>
                <span class="meta-sep">•</span>
                <span class="meta-item">Дата: <?php echo $_smarty_tpl->getValue('topic')['user_created_at'];?>
</span>
                <!-- Сюда можно добавить ссылку на категорию -->
            </div>
        </div>

        <!-- Список постов -->
        <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('posts')) > 0) {?>
            <div class="posts-list">
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('posts'), 'post');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('post')->value) {
$foreach0DoElse = false;
?>
                    <article class="post-item" id="post-<?php echo $_smarty_tpl->getValue('post')['id'];?>
">
                        <div class="post-header">
                            <span class="post-author"><strong><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('post')['author'], ENT_QUOTES, 'UTF-8', true);?>
</strong></span>
                            <span class="post-date"><?php echo $_smarty_tpl->getValue('post')['user_created_at'];?>
</span>
                        </div>

                        <div class="post-content">
                            <!-- Если нужны авто-переносы строк -->
                            <?php echo nl2br((string) $_smarty_tpl->getValue('post')['content'], (bool) 1);?>

                        </div>

                        <!-- Кнопка ответа (если пользователь авторизован) -->
                        <?php if ($_smarty_tpl->getValue('arrUser')) {?>
                            <div class="post-actions">
                                <button type="button" class="btn btn-sm btn-outline" onclick="openReplyForm(<?php echo $_smarty_tpl->getValue('post')['id'];?>
)">Ответить</button>
                            </div>
                        <?php }?>
                    </article>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            </div>
        <?php } else { ?>
            <div class="empty-state">
                В этой теме пока нет сообщений. Будь первым!
            </div>
        <?php }?>


        <!-- Форма добавления поста (если пользователь авторизован) -->
        <?php if ($_smarty_tpl->getValue('arrUser')) {?>
            <div class="reply-form-container">
                <h3>Написать ответ</h3>
                <form id="addPostForm">
                    <input type="hidden" name="topic_id" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('topic')['id'], ENT_QUOTES, 'UTF-8', true);?>
">
                    <input type="hidden" name="parent_id" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('post')['id'], ENT_QUOTES, 'UTF-8', true);?>
">
                    <textarea name="content" class="form-input" rows="4" required placeholder="Ваш комментарий..."></textarea>
                    <div class="error" id="error_content"></div>
                    <button type="button" class="btn btn-primary" onclick="handleAddPost()">Отправить</button>
                </form>
            </div>
        <?php }?>
    </div>

    <footer>
        <?php $_smarty_tpl->renderSubTemplate('file:../includes/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
    </footer>
</div>
</body>
</html><?php }
}
