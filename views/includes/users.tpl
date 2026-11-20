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
            {if $flash}
                <div class="flash {$flash.type}">{$flash.text|escape}</div>
            {/if}
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

<div class="modal-overlay" id="banModal" hidden>
    <div class="modal">
        <div class="modal-header">
            <h3>Бан пользователя: <span id="banUserName"></span></h3>
            <button type="button" class="modal-close" id="banModalClose">&times;</button>
        </div>

        <form method="post" action="/?controller=admin&action=ban" id="banForm">
            <input type="hidden" name="user_id" id="banUserId">

            <div class="form-row">
                <label>Срок бана</label>
                <div class="duration-options">
                    <label><input type="radio" name="duration_mode" value="days" checked>
                        На <input type="number" name="days" min="1" max="365" value="7" class="days-input"> дн.</label>
                    <label><input type="radio" name="duration_mode" value="forever">
                        Пожизненно</label>
                </div>
            </div>

            <div class="form-row">
                <label for="banReason">Причина</label>
                <select name="reason_preset" id="banReasonPreset">
                    <option value="">— выбрать из списка —</option>
                    <option value="Спам">Спам</option>
                    <option value="Оскорбления участников">Оскорбления участников</option>
                    <option value="Реклама и ссылки">Реклама и ссылки</option>
                    <option value="Нарушение правил форума">Нарушение правил форума</option>
                </select>
                <input type="text" name="reason" id="banReason"
                       placeholder="Причина (видна пользователю)"
                       maxlength="255" required>
                <div class="hint">Можно выбрать из списка или вписать свою</div>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn btn-ghost" id="banModalCancel">Отмена</button>
                <button type="submit" class="btn btn-danger">Забанить</button>
            </div>
        </form>
    </div>
</div>
