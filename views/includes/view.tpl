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
        {include '../includes/pagination.tpl'}
    </div>
</section>