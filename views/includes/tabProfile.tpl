{if $tab === 'about'}
    <!-- Панель: О себе -->
    <div class="profile-panel" id="panel-info" role="tabpanel">
        <div class="profile-card profile-about">
            <p class="profile-about-text">
                {$arrUser['about']}
            </p>
        </div>
    </div>
{/if}

{if $tab === 'topics'}
    <!-- Панель: Темы -->
    {if $allTopics}
    <div class="profile-panel" id="panel-topics" role="tabpanel">
        <ul class="topics-list">
            {foreach $allTopics as $topic}
            <li class="topic-row">
                <div>
                    <div class="topic-card-title"><a href="#">{$topic['title']}</a></div>
                    <div class="topic-card-meta">Создана {$topic['user_created_at']}</div>
                    <div class="topic-card-meta">Последние изменения {$topic['user_last_post_at']}</div>
                </div>
                <div></div>
                <div class="stats">{$topic['post_count']} ответов</div>
            </li>
            {/foreach}
        </ul>

        {include '../includes/pagination.tpl'}
    </div>
    {else}
    <div class="empty-state">Тем пока нет</div>
    {/if}
{/if}

{if $tab === 'posts'}
    <!-- Панель: Комментарии -->
    {include '../includes/posts.tpl'}
    {include '../includes/pagination.tpl'}
{/if}

{if $tab == 'settings' and $isCurrentUser}
    <!-- Панель: Настройки -->
    <div class="profile-panel" id="panel-settings" role="tabpanel">
        <form id="updateProfileForm" class="profile-form" enctype="multipart/form-data">
            <div class="form-group">
                <label class="form-label" for="login">Логин <span>*</span></label>
                <input class="form-input" id="login" name="login" type="text" value="{$arrUser['username']}" required>
                <div class="hint">От 3 до 32 символов</div>
                <div class="error" id="error_login"></div>
            </div>

            <div class="form-group">
                <label class="form-label" for="email">Почта</label>
                <input class="form-input" id="email" name="email" type="email">
                <div class="error" id="error_email"></div>
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Новый пароль</label>
                <input class="form-input" id="password" name="password" type="password" placeholder="Оставьте пустым, чтобы не менять">
                <div class="error" id="error_password"></div>
                <div class="hint">Минимум 8 символов</div>
            </div>

            <div class="form-group">
                <label class="form-label" for="about">О себе</label>
                <textarea class="form-textarea" id="about" name="about" placeholder="Расскажите о себе…">{$arrUser['about']}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label" for="photo">Фото профиля</label>
                <input class="form-input" id="photo" name="photo" type="file" accept="image/*">
                <div class="error" id="error_photo"></div>
                <div class="hint">JPG или PNG, до 2 МБ</div>
            </div>

            <button class="btn-submit" type="button" onclick="updateProfileUserData()">Сохранить изменения</button>
            <div class="error" id="error_new-data"></div>
        </form>
    </div>
{/if}