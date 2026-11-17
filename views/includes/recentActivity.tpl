{foreach $recentActivity as $item}
    {if $item['type'] === 'post_created'}
        <li>
            <span>
                <b>{$item.meta.nickname}</b>
                ответил в «{$item.meta.topicName}»
            </span>
            <time>{$item.user_created_at}</time>
        </li>
    {/if}

    {if $item['type'] === 'user_changed_data'}
        <li>
            <span>
                <b>{$item.meta.nickname}{if $item.meta.old_name}({$item.meta.old_name}){/if}</b>
                изменил свои данные в в профиле
            </span>
            <time>{$item.user_created_at}</time>
        </li>
    {/if}

    {if $item['type'] === 'topic_created'}
        <li>
            <span>
                <b>{$item.meta.nickname}</b>
                создал топик «{$item.meta.topicName}» в разделе «{$item.meta.catName}»
            </span>
            <time>{$item.user_created_at}</time>
        </li>
    {/if}

    {if $item['type'] === 'user_registered'}
        <li>
            <span>
                Зарегистрировался новый пользователь <b>{$item.meta.nickname}</b>
            </span>
            <time>{$item.user_created_at}</time>
        </li>
    {/if}

    {if $item['type'] === 'user_banned'}
        <li>
            <span>
                <b>{$item.meta.nickname}</b>
                получил бан на 7 дней ({$item.meta.reason})
            </span>
            <time>{$item.user_created_at}</time>
        </li>
    {/if}

    {if $item['type'] === 'user_unbanned'}
        <li>
            <span>С
                <b>{$item.meta.nickname}</b>
                снят бан
            </span>
            <time>{$item.user_created_at}</time>
        </li>
    {/if}

    {if $item['type'] === 'topic_deleted'}
        <li>
            <span>Тема
                <b>«{$item.meta.topicName}»</b>
                удалена
            </span>
            <time>{$item.user_created_at}</time>
        </li>
    {/if}

{*todo вывод событий в админке*}

{/foreach}

