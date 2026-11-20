{if $pagination.totalPages > 1}
<nav class="pagination">
    {if $pagination.currentPage > 1}
        <a href="/?{if $isProfile}controller=user&action=profile&user_id={$userId}&tab={$tab}{/if}{if $isPost}controller=topic&topic_id={$topic['id']}{/if}{if $tab==='users'}controller=admin&action=users{/if}{if $tab==='view'}controller=admin{/if}&page={$pagination.currentPage - 1}{if $catId}&cat_id={$catId}{/if}"
        >
            ←
        </a>
    {/if}

    {foreach $pagination.pageList as $p}
        {if $p eq '...'}
            <span class="gap">...</span>
        {elseif $p eq $pagination.currentPage}
            <span class="active">{$p}</span>
        {else}
            <a href="/?{if $isProfile}controller=user&action=profile&user_id={$userId}&tab={$tab}{/if}{if $isPost}controller=topic&topic_id={$topic['id']}{/if}{if $tab==='users'}controller=admin&action=users{/if}{if $tab==='view'}controller=admin{/if}&page={$p}{if $catId}&cat_id={$catId}{/if}"
            >
                {$p}
            </a>
        {/if}
    {/foreach}

    {if $pagination.currentPage < $pagination.totalPages}
        <a href="/?{if $isProfile}controller=user&action=profile&user_id={$userId}&tab={$tab}{/if}{if $isPost}controller=topic&topic_id={$topic['id']}{/if}{if $tab==='users'}controller=admin&action=users{/if}{if $tab==='view'}controller=admin{/if}&page={$pagination.currentPage + 1}{if $catId}&cat_id={$catId}{/if}"
        >
            →
        </a>
    {/if}
</nav>
{/if}