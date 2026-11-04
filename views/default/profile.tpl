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
        <h1 class="profile-title">Профиль</h1>

        <!-- Шапка профиля -->
        <div class="profile-card">
            <div class="profile-avatar">
                {if $arrUser['photo']}
                    <img src="{$uploadUrl}{$arrUser['photo']}" alt="Фото профиля">
                {else}
                    <h1 style="display: block; text-align: center"><\></h1>
                {/if}
            </div>
            <div class="profile-head">
                <h2 class="profile-login">{$arrUser['username']} <span class="profile-meta">({$arrUser['roleName']})</span></h2>
                <div class="profile-meta">
                    <span>Почта: <a href="mailto:{$arrUser['email']}">{$arrUser['email']}</a></span>
                    <span class="meta-sep">•</span>
                    <span>Дата регистрации: {$arrUser['created_at']}</span>
                </div>
            </div>
        </div>

        <!-- Вкладки -->
        <div class="profile-tabs" role="tablist">
            <button class="profile-tab active" data-tab="info" role="tab" aria-selected="true" onclick="showProfileTab('info')">О себе</button>
            <button class="profile-tab" data-tab="topics" role="tab" aria-selected="false" onclick="showProfileTab('topics')">Темы</button>
            <button class="profile-tab" data-tab="comments" role="tab" aria-selected="false" onclick="showProfileTab('comments')">Комментарии</button>
            <button class="profile-tab" data-tab="settings" role="tab" aria-selected="false" onclick="showProfileTab('settings')">Настройки</button>
        </div>

        <!-- Панель: О себе -->
        <div class="profile-panel active" id="panel-info" role="tabpanel">
            <div class="profile-card profile-about">
                <p class="profile-about-text">
                    {$arrUser['about']}
                </p>
            </div>
        </div>

        <!-- Панель: Темы -->
        <div class="profile-panel" id="panel-topics" role="tabpanel">
            <ul class="topics-list">
                <li class="topic-row">
                    <div>
                        <div class="topic-card-title"><a href="#">Как выучить Python за месяц?</a></div>
                        <div class="topic-card-meta">создана 12.03.2024</div>
                    </div>
                    <div class="stats">12 ответов</div>
                    <div class="stats">340 просмотров</div>
                </li>
                <!-- ... -->
            </ul>
            <div class="empty-state" hidden>Тем пока нет</div>
        </div>

        <!-- Панель: Комментарии -->
        <div class="profile-panel" id="panel-comments" role="tabpanel">
            <div class="posts-list">
                <article class="post-item">
                    <div class="post-header">
                        <span class="post-author"><strong>username</strong></span>
                        <span class="post-date">14.03.2024</span>
                    </div>
                    <div class="post-content">Отличный вопрос! Я бы начал с основ синтаксиса…</div>
                    <div class="post-actions">
                        <a href="#" class="btn btn-sm btn-outline">Перейти к теме</a>
                    </div>
                </article>
            </div>
        </div>

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

        <footer>
            {include '../includes/footer.tpl'}
        </footer>
    </div>
</body>
</html>