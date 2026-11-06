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
                {if $arrProfile['photo']}
                    <img src="{$uploadUrl}{$arrProfile['photo']}" alt="Фото профиля">
                {else}
                    <h1 style="display: block; text-align: center"><\></h1>
                {/if}
            </div>
            <div class="profile-head">
                <h2 class="profile-login">{$arrProfile['username']} <span class="profile-meta">({$arrProfile['roleName']})</span></h2>
                <div class="profile-meta">
                    <span>Почта: <a href="mailto:{$arrProfile['email']}">{$arrProfile['email']}</a></span>
                    <span class="meta-sep">•</span>
                    <span>Дата регистрации: {$arrProfile['created_at']}</span>
                </div>
            </div>
        </div>

        <!-- Вкладки -->
        <div class="profile-tabs" role="tablist">
            <a class="profile-tab {if $tab === 'about'}active{/if}" href="/?controller=user&action=profile&user_id={$arrProfile['id']}&tab=about">
                О себе
            </a>
            <a class="profile-tab {if $tab === 'topics'}active{/if}" href="/?controller=user&action=profile&user_id={$arrProfile['id']}&tab=topics">
                Темы
            </a>
            <a class="profile-tab {if $tab === 'posts'}active{/if}" href="/?controller=user&action=profile&user_id={$arrProfile['id']}&tab=posts">
                Комментарии
            </a>
            {if $isCurrentUser}
            <a class="profile-tab {if $tab === 'settings'}active{/if}" href="/?controller=user&action=profile&user_id={$arrProfile['id']}&tab=settings">
                Настройки
            </a>
            {/if}
        </div>

        {include '../includes/tabProfile.tpl'}

        <footer>
            {include '../includes/footer.tpl'}
        </footer>
    </div>
</body>
</html>