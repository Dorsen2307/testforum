<!DOCTYPE html>
<html lang="ru">
<head>
    {include '../includes/head.tpl'}
</head>
<body>
<!-- Сайдбар -->
<aside class="sidebar">
    <div class="logo">⚙ <span class="txt">Форум · Админ</span></div>
    <nav class="nav">
        <a href="/?controller=admin" class="nav-dashboard {if $tab=='view'}active{/if}">🏠 <span class="txt">Обзор</span></a>
        <a href="/?controller=admin&action=users" class="nav-users {if $tab=='users'}active{/if}">👥 <span class="txt">Пользователи</span></a>
        <a href="/?controller=admin&action=topics" class="nav-topics {if $tab=='topics'}active{/if}">💬 <span class="txt">Топики</span></a>
        <a href="/?controller=admin&action=moderation" class="nav-moderation {if $tab=='moderation'}active{/if}">🚩 <span class="txt">Модерация</span> <span class="badge-nav">3</span></a>
        <a href="/?controller=admin&action=settings" class="nav-settings {if $tab=='settings'}active{/if}">🔧 <span class="txt">Настройки</span></a>
    </nav>
    <div class="admin-user">
        <b>admin_ivan</b>
        <a href="/">Выйти из панели</a>
    </div>
</aside>

<main>
    <!-- Верхняя панель -->
    <div class="topbar">
        <h1 id="page-title">{$tabTitle}</h1>
        <input type="search" class="search" placeholder="Поиск по форуму… (Ctrl+K)">
        <button class="btn-bell" title="Уведомления">🔔</button>
    </div>

    <div class="content">
        {if $tab=='view'}
        <!-- ======== ОБЗОР ======== -->
        <section class="panel" id="panel-dashboard">
            <div class="stats">
                {assign var="stats" value=$data[0]}
                <div class="stat"><div class="num">{$stats['total_users']}</div><div class="label">Пользователей</div></div>
                <div class="stat green"><div class="num">{$stats['total_posts']}</div><div class="label">Сообщений</div></div>
                <div class="stat amber"><div class="num">{$stats['total_topics']}</div><div class="label">Топиков</div></div>
                <div class="stat red"><div class="num">3</div><div class="label">Жалоб в очереди</div></div>
            </div>

            <div class="card">
                <h3>Последняя активность</h3>
                <ul class="activity">
                    {include '../includes/recentActivity.tpl'}
                </ul>
            </div>
        </section>
        {/if}

        {if $tab=='users'}
        <!-- ======== ПОЛЬЗОВАТЕЛИ ======== -->
        <section class="panel" id="panel-users">
            <div class="toolbar">
                <input type="search" placeholder="Ник или email…">
                <select>
                    <option>Все роли</option>
                    <option>Администраторы</option>
                    <option>Модераторы</option>
                    <option>Забаненные</option>
                </select>
                <div class="spacer"></div>
                <a href="#" class="btn btn-primary">+ Пригласить пользователя</a>
            </div>

            <div class="card">
                <div class="table-wrap">
                    <table>
                        <thead>
                        <tr>
                            <th>Пользователь</th><th>Email</th><th>Роль</th>
                            <th>Сообщений</th><th>Регистрация</th><th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        {include '../includes/cardUsersAdmin.tpl'}
                        </tbody>
                    </table>
                </div>
                {include "../includes/pagination.tpl"}
            </div>
        </section>
        {/if}

        {if $tab=='topics'}
        <!-- ======== ТОПИКИ ======== -->
        <section class="panel" id="panel-topics">
            <div class="toolbar">
                <input type="search" placeholder="Название топика…">
                <select>
                    <option>Все разделы</option>
                    <option>Веб-разработка</option>
                    <option>Общение</option>
                </select>
                <div class="spacer"></div>
                <a href="#" class="btn btn-primary">+ Создать топик</a>
            </div>

            <div class="card">
                <div class="table-wrap">
                    <table>
                        <thead>
                        <tr><th>Заголовок</th><th>Раздел</th><th>Автор</th><th>Ответов</th><th>Статус</th><th>Действия</th></tr>
                        </thead>
                        <tbody>
                        {include '../includes/cardTopicsAdmin.tpl'}
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        {/if}

        {if $tab=='moderation'}
        <!-- ======== МОДЕРАЦИЯ ======== -->
        <section class="panel" id="panel-moderation">
            <div class="card">
                <h3>Очередь жалоб (3)</h3>

                <div class="queue-item">
                    <div>
                        <div class="reason">Жалоба: оскорбление</div>
                        <div class="body">«Да ты вообще ничего не понимаешь в коде, лол»</div>
                        <div class="meta">Топик «Обсуждение релиза 2.1» · автор <b>crypto_dude</b> · пожаловался: Алексей</div>
                    </div>
                    <div class="queue-actions">
                        <a href="#" class="btn btn-sm btn-ghost">Посмотреть контекст</a>
                        <a href="#" class="btn btn-sm btn-green">Отклонить</a>
                        <a href="#" class="btn btn-sm btn-danger">Скрыть + бан 7 дней</a>
                    </div>
                </div>

                <div class="queue-item">
                    <div>
                        <div class="reason">Жалоба: спам / реклама</div>
                        <div class="body">«Забирайте бесплатный курс, переходите по ссылке…»</div>
                        <div class="meta">Топик «Флудилка» · автор <b>spam_bot_42</b> · пожаловался: Мария</div>
                    </div>
                    <div class="queue-actions">
                        <a href="#" class="btn btn-sm btn-ghost">Посмотреть контекст</a>
                        <a href="#" class="btn btn-sm btn-green">Отклонить</a>
                        <a href="#" class="btn btn-sm btn-danger">Скрыть + бан навсегда</a>
                    </div>
                </div>

                <div class="queue-item">
                    <div>
                        <div class="reason">Жалоба: некорректное содержимое</div>
                        <div class="body">«Продам стиральную машину недорого, пишите в личку»</div>
                        <div class="meta">Топик «Куплю/продам» · автор <b>vova88</b> · пожаловался: анонимно</div>
                    </div>
                    <div class="queue-actions">
                        <a href="#" class="btn btn-sm btn-ghost">Посмотреть контекст</a>
                        <a href="#" class="btn btn-sm btn-green">Отклонить</a>
                        <a href="#" class="btn btn-sm btn-danger">Скрыть сообщение</a>
                    </div>
                </div>
            </div>
        </section>
        {/if}

        {if $tab=='settings'}
        <!-- ======== НАСТРОЙКИ ======== -->
        <section class="panel" id="panel-settings">
            <div class="settings-grid">
                <div class="card">
                    <h3>Основные</h3>
                    <div class="form-row">
                        <label>Название форума</label>
                        <input type="text" value="Мой Форум">
                    </div>
                    <div class="form-row">
                        <label>Описание</label>
                        <textarea>Сообщество разработчиков</textarea>
                    </div>
                    <div class="form-row">
                        <label>Сообщений на страницу</label>
                        <input type="number" value="20">
                    </div>
                </div>

                <div class="card">
                    <h3>Регистрация и доступ</h3>
                    <div class="switch"><input type="checkbox" checked> Регистрация открыта</div>
                    <div class="switch"><input type="checkbox" checked> Требовать подтверждение email</div>
                    <div class="switch"><input type="checkbox"> Автобан по 3 жалобам</div>
                    <div class="form-row" style="margin-top:14px">
                        <label>Минимальная длина пароля</label>
                        <input type="number" value="8">
                        <div class="hint">Рекомендуется не менее 8 символов</div>
                    </div>
                </div>
            </div>
            <div class="card">
                <a href="#" class="btn btn-primary">Сохранить настройки</a>
                <a href="#" class="btn btn-ghost">Отменить</a>
            </div>
        </section>
        {/if}

    </div>
</main>

</body>
</html>
