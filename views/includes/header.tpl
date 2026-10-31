<div class="header-inner">
    <span class="logo">IT Forum</span>
    <nav class="nav-links">
        <a href="/">Главная</a>
        <a href="/categories">Категории</a>
    </nav>
    <div class="user-actions">
        {if not $arrUser}
            {if not $flagAuth}
                <a type="button" href="/?controller=user&action=templateauth">Войти</a>
            {/if}
            {if not $flagReg}
                <a type="button" href="/?controller=user&action=templateregistration">Зарегистрироваться</a>
            {/if}
        {else}
            {if not $flagCreateTopic}
                <a type="button" href="/?controller=topic&action=templatecreatetopic">Создать тему</a>
            {/if}
            <a href="/profile" class="username">{$arrUser['displayName']}</a>
            <a type="button" href="/?controller=user&action=logout">Выйти</a>
        {/if}
    </div>
</div>