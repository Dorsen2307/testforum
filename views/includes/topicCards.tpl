<div class="error" id="error_topic">{$errorMessageTopic}</div>
{if $allTopics}
    {foreach $allTopics as $topic}
    <li class="topic-row">
        <div class="topic-card-title">
            <a href="/?controller=topic&id={$topic['id']}">{$topic['title']}</a>
        </div>
        <div class="topic-card-meta">
            Автор: {$topic['username']}<br>
            {$topic['user_created_at']}
        </div>
        <div class="stats">
            Ответов: {$topic['post_count']}<br>
            Последнее: {$topic['user_last_post_at']}
        </div>
    </li>
    {/foreach}

    <!-- Пагинатор -->
    {include '../includes/pagination.tpl'}
{else}
    Темы для обсуждения отсутствуют. Создайте тему.
{/if}