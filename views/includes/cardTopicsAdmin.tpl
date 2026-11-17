{foreach $topics as $topic}
    <tr>
        <td><b>{$topic.title}</b></td>
        <td>{$topic.category_name}</td>
        <td>{$topic.author}</td>
        <td>{$topic.post_count}</td>
        {if $topic.is_active}
            <td><span class="badge green">Открыт</span></td>
        {else}
            <td><span class="badge red">Скрыт</span></td>
        {/if}
        <td><a href="#" class="btn btn-sm btn-ghost">{if $topic.is_active}Скрыть{else}Открыть{/if}</a> <a href="#" class="btn btn-sm btn-danger">Удалить</a></td>
    </tr>
{/foreach}