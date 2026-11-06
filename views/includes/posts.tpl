{if $posts}
    <div class="profile-panel" id="panel-comments" role="tabpanel">
        <ul class="posts-list">
            {foreach $posts as $post}
                <li class="post-item" id="post-{$post.id}">
                    <div class="post-header">
                        {if $tab}
                        <span class="post-author"><strong>{$post['author']}</strong></span>
                        {else}
                        <a class="post-author" href="/?controller=user&action=profile&user_id={$post['author_id']}"><strong>{$post['author']}</strong></a>
                        {/if}
                        <span class="post-date">{$post['user_created_at']}</span>
                    </div>
                    <div class="post-content">{$post['content']|nl2br}</div>
                    {if $tab}
                        <!-- Кнопка ссылка на тему -->
                    <div class="post-actions">
                        <a href="/?controller=topic&topic_id={$post['topic_id']}" class="btn btn-sm btn-outline">{$post['topic_title']}</a>
                    </div>
                    {else}
                    <!-- Кнопка ответа (если пользователь авторизован) -->
                        {if $arrUser}
                        <div class="post-actions">
                            <button type="button" class="btn btn-sm btn-outline" onclick="openReplyForm({$post.id})">Ответить</button>
                        </div>
                        {/if}
                    {/if}
                </li>
            {/foreach}
        </ul>
    </div>
{else}
    {if $tab}
    <div class="empty-state">Тем пока нет</div>
    {else}
    <div class="empty-state">
        В этой теме пока нет сообщений. Будь первым!
    </div>
    {/if}
{/if}