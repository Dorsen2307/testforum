{if $allCategories}
    <a href="/" class="cat-pill {if not $catId}active{/if}">
        Все
    </a>
    {foreach $allCategories as $category}
    <a href="/?id={$category['id']}" class="cat-pill {if $catId==$category['id']}active{/if}">
        {$category['name']}
    </a>
    {/foreach}
{else}
    Категории еще не добавлены
{/if}
