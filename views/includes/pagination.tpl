<nav class="pagination">
    {if $totalPages > 1}
        {if $page > 1}
            <a href="/?page={$page - 1}{if $catId}&id={$catId}{/if}" class="number-page">
                ← Назад
            </a>
        {/if}

        {for $i = 1 to $totalPages}
            {if $i == $page}
                <span class="current number-page-select">{$i}</span>
            {else}
                <a href="/?page={$i}{if $catId}&id={$catId}{/if}" class="number-page">{$i}</a>
            {/if}
        {/for}

        {if $page < $totalPages}
            <a href="/?page={$page + 1}{if $catId}&id={$catId}{/if}" class="number-page">Вперёд →</a>
        {/if}
    {/if}
</nav>
