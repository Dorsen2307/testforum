<!doctype html>
<html lang="ru">
<head>
    {include '../includes/head.tpl'}
</head>
<body>
<header>
    {include '../includes/header.tpl'}
</header>

<div class="container">
    <section>
        {include '../includes/section.tpl'}
    </section>

    <div class="page-topic">
        <!-- Шапка темы -->
        <div class="topic-header">
            <h1 class="topic-title">{$topic.title|escape}</h1>
            <div class="topic-content">{$topic.content|escape}</div>
            <div class="topic-meta">
                <span class="meta-item">Автор: <strong>{$topic.author|escape}</strong></span>
                <span class="meta-sep">•</span>
                <span class="meta-item">Дата: {$topic.user_created_at}</span>
                <!-- Сюда можно добавить ссылку на категорию -->
            </div>
        </div>

        <!-- Список постов -->
        {include '../includes/posts.tpl'}
        {include '../includes/pagination.tpl'}

        <!-- Форма добавления поста (если пользователь авторизован) -->
        {if $arrUser}
            <div class="reply-form-container">
                <h3>Написать ответ</h3>
                <form id="addPostForm">
                    <input type="hidden" name="topic_id" value="{$topic.id|escape}">
                    <input type="hidden" name="parent_id" value="{$post.id|escape}">
                    <textarea name="content" class="form-input" rows="4" required placeholder="Ваш комментарий..."></textarea>
                    <div class="error" id="error_content"></div>
                    <button type="button" class="btn btn-primary" onclick="handleAddPost()">Отправить</button>
                </form>
            </div>
        {/if}
    </div>

    <footer>
        {include '../includes/footer.tpl'}
    </footer>
</div>
</body>
</html>