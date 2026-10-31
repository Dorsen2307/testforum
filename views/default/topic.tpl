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
        {if $posts|@count > 0}
            <div class="posts-list">
                {foreach $posts as $post}
                    <article class="post-item" id="post-{$post.id}">
                        <div class="post-header">
                            <span class="post-author"><strong>{$post.author|escape}</strong></span>
                            <span class="post-date">{$post.user_created_at}</span>
                        </div>

                        <div class="post-content">
                            <!-- Если нужны авто-переносы строк -->
                            {$post.content|nl2br}
                        </div>

                        <!-- Кнопка ответа (если пользователь авторизован) -->
                        {if $arrUser}
                            <div class="post-actions">
                                <button type="button" class="btn btn-sm btn-outline" onclick="openReplyForm({$post.id})">Ответить</button>
                            </div>
                        {/if}
                    </article>
                {/foreach}
            </div>
        {else}
            <div class="empty-state">
                В этой теме пока нет сообщений. Будь первым!
            </div>
        {/if}

{*        {include '../includes/pagination.tpl'}*}

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