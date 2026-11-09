<!DOCTYPE html>
<html lang="ru">
<head>
    {include '../includes/head.tpl'}
</head>
<body>

<!-- Разделы: переключение через радиокнопки -->
<input type="radio" name="tab" id="tab-dashboard" class="tab-input" checked>
<input type="radio" name="tab" id="tab-users" class="tab-input">
<input type="radio" name="tab" id="tab-topics" class="tab-input">
<input type="radio" name="tab" id="tab-moderation" class="tab-input">
<input type="radio" name="tab" id="tab-settings" class="tab-input">

<!-- Сайдбар -->
<aside class="sidebar">
    <div class="logo">⚙ <span class="txt">Форум · Админ</span></div>
    <nav class="nav">
        <label for="tab-dashboard" class="nav-dashboard">🏠 <span class="txt">Обзор</span></label>
        <label for="tab-users" class="nav-users">👥 <span class="txt">Пользователи</span></label>
        <label for="tab-topics" class="nav-topics">💬 <span class="txt">Топики</span></label>
        <label for="tab-moderation" class="nav-moderation">🚩 <span class="txt">Модерация</span> <span class="badge-nav">3</span></label>
        <label for="tab-settings" class="nav-settings">🔧 <span class="txt">Настройки</span></label>
    </nav>
    <div class="admin-user">
        <b>admin_ivan</b>
        <a href="/">Выйти из панели</a>
    </div>
</aside>

<main>
    <!-- Верхняя панель -->
    <div class="topbar">
        <h1 id="page-title">Обзор</h1>
        <input type="search" class="search" placeholder="Поиск по форуму… (Ctrl+K)">
        <button class="btn-bell" title="Уведомления">🔔</button>
    </div>

    <div class="content">

        <!-- ======== ОБЗОР ======== -->
        <section class="panel" id="panel-dashboard">
            <div class="stats">
                <div class="stat"><div class="num">{$view['total_users']}</div><div class="label">Пользователей</div></div>
                <div class="stat green"><div class="num">{$view['total_posts']}</div><div class="label">Сообщений</div></div>
                <div class="stat amber"><div class="num">{$view['total_topics']}</div><div class="label">Топиков</div></div>
                <div class="stat red"><div class="num">3</div><div class="label">Жалоб в очереди</div></div>
            </div>

            <div class="card">
                <h3>Последняя активность</h3>
                <ul class="activity">
                    {include '../includes/recentActivity.tpl'}
                </ul>
            </div>
        </section>

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
                        <tr>
                            <td><b>admin_ivan</b><div class="sub">Последний вход: сегодня</div></td>
                            <td>ivan@example.com</td>
                            <td><span class="badge red">Администратор</span></td>
                            <td>1 204</td><td>12.03.2022</td>
                            <td><a href="#" class="btn btn-sm btn-ghost">Профиль</a> <a href="#" class="btn btn-sm btn-ghost">Права</a></td>
                        </tr>
                        <tr>
                            <td><b>Мария</b><div class="sub">Последний вход: 2 ч назад</div></td>
                            <td>maria@example.com</td>
                            <td><span class="badge blue">Модератор</span></td>
                            <td>892</td><td>05.07.2023</td>
                            <td><a href="#" class="btn btn-sm btn-ghost">Профиль</a> <a href="#" class="btn btn-sm btn-danger">Бан</a></td>
                        </tr>
                        <tr>
                            <td><b>crypto_dude</b><div class="sub">Бан истекает 14.11</div></td>
                            <td>spam@trash.io</td>
                            <td><span class="badge amber">Забанен</span></td>
                            <td>3</td><td>01.11.2026</td>
                            <td><a href="#" class="btn btn-sm btn-ghost">Профиль</a> <a href="#" class="btn btn-sm btn-green">Разбанить</a></td>
                        </tr>
                        <tr>
                            <td><b>vova88</b><div class="sub">Последний вход: вчера</div></td>
                            <td>vova88@mail.ru</td>
                            <td><span class="badge gray">Пользователь</span></td>
                            <td>14</td><td>05.11.2026</td>
                            <td><a href="#" class="btn btn-sm btn-ghost">Профиль</a> <a href="#" class="btn btn-sm btn-danger">Бан</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="pagination">
                    <a href="#">←</a><a href="#" class="active">1</a><a href="#">2</a><a href="#">3</a><a href="#">→</a>
                </div>
            </div>
        </section>

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
                        <tr>
                            <td><b>Обсуждение релиза 2.1</b></td>
                            <td>Веб-разработка</td><td>Алексей</td><td>47</td>
                            <td><span class="badge green">Открыт</span></td>
                            <td><a href="#" class="btn btn-sm btn-ghost">Открыть</a> <a href="#" class="btn btn-sm btn-danger">Удалить</a></td>
                        </tr>
                        <tr>
                            <td><b>Помогите с htaccess</b></td>
                            <td>Веб-разработка</td><td>Мария</td><td>3</td>
                            <td><span class="badge green">Открыт</span></td>
                            <td><a href="#" class="btn btn-sm btn-ghost">Открыть</a> <a href="#" class="btn btn-sm btn-ghost">Закрепить</a></td>
                        </tr>
                        <tr>
                            <td><b>[СПАМ] Лучшие курсы крипты!!!</b></td>
                            <td>Общение</td><td>crypto_dude</td><td>0</td>
                            <td><span class="badge red">Скрыт</span></td>
                            <td><a href="#" class="btn btn-sm btn-ghost">Открыть</a> <a href="#" class="btn btn-sm btn-danger">Удалить</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

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

    </div>
</main>

</body>
</html>
