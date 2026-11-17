{foreach $users as $user}
    <tr>
        <td>
            <b>{$user.username}</b>
            {if not $user.is_banned}
                <div class="sub">Последний вход: {$user.user_last_login}</div>
            {else}
                <div class="sub">Бан истекает </div>
            {/if}
        </td>
        <td>{$user.email}</td>
        <td>
            {if not $user.is_banned}
                <span class="badge {if $user.role=='admin'}red{/if}{if $user.role=='user'}gray{/if}{if $user.role=='moderator'}blue{/if}">
                    {$user.role_name}
                </span>
            {else}
                <span class="badge amber">Забанен</span>
            {/if}
        </td>
        <td>{$user.user_posts_count}</td>
        <td>{$user.created_at|date_format:"d.m.Y"}</td>
        <td>
            <a href="#" class="btn btn-sm btn-ghost">Профиль</a>
            {if $user.role=='admin'}
                <a href="#" class="btn btn-sm btn-ghost">Права</a>
            {else}
                {if not $user.is_banned}
                    <a href="#" class="btn btn-sm btn-danger">Бан</a>
                {else}
                    <a href="#" class="btn btn-sm btn-green">Разбанить</a>
                {/if}
            {/if}
        </td>
    </tr>
{/foreach}