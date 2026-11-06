<?php
/* Smarty version 5.8.5, created on 2026-11-06 12:16:53
  from 'file:topic.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6aed9b05588884_21632429',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '85f0a02e439b93c007f06c4594bcfd973cdddf14' => 
    array (
      0 => 'topic.tpl',
      1 => 1793956611,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../includes/head.tpl' => 1,
    'file:../includes/header.tpl' => 1,
    'file:../includes/section.tpl' => 1,
    'file:../includes/posts.tpl' => 1,
    'file:../includes/pagination.tpl' => 1,
    'file:../includes/footer.tpl' => 1,
  ),
))) {
function content_6aed9b05588884_21632429 (\Smarty\Template $_smarty_tpl) {
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
        <?php $_smarty_tpl->renderSubTemplate('file:../includes/posts.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
        <?php $_smarty_tpl->renderSubTemplate('file:../includes/pagination.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

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
