<nav class="pagination">
    {if $totalPages > 1}
        {if $page > 1}
            <a href="/?{if $isProfile}controller=user&action=profile&user_id={$userId}&tab={$tab}{/if}{if $isPost}controller=topic&topic_id={$topic['id']}{/if}&page={$page - 1}{if $catId}&cat_id={$catId}{/if}" class="number-page"
            >
                ← Назад
            </a>
        {/if}

        {for $i = 1 to $totalPages}
            {if $i == $page}
                <span class="current number-page-select">
                    {$i}
                </span>
            {else}
                <a href="/?{if $isProfile}controller=user&action=profile&user_id={$userId}&tab={$tab}{/if}{if $isPost}controller=topic&topic_id={$topic['id']}{/if}&page={$i}{if $catId}&cat_id={$catId}{/if}" class="number-page"
                >
                    {$i}
                </a>
            {/if}
        {/for}

        {if $page < $totalPages}
            <a href="/?{if $isProfile}controller=user&action=profile&user_id={$userId}&tab={$tab}{/if}{if $isPost}controller=topic&topic_id={$topic['id']}{/if}&page={$page + 1}{if $catId}&cat_id={$catId}{/if}" class="number-page"
            >
                Вперёд →
            </a>
        {/if}
    {/if}
</nav>
