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


{/foreach}
{*<li><span><b>Мария</b> создала топик «Помогите с htaccess» в разделе «Веб-разработка»</span><time>5 мин назад</time>*}
{*</li>*}

{*<li><span><b>crypto_dude</b> получил бан на 7 дней (спам)</span><time>1 ч назад</time>*}
{*</li>*}



{*<li><span>Зарегистрировался новый пользователь <b>vova88</b></span><time>3 ч назад</time>*}
{*</li>*}

'', 'user_registered', 'user_banned', 'user_unbanned', 'topic_deleted', 'report_resolved'