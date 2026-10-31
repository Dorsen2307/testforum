<!doctype html>
<html lang="ru">
<head>
    {include '../includes/head.tpl'}
</head>
<body>
    <header>
        {include '../includes/header.tpl'}
    </header>

    <div class="container">
        <section>
            {include '../includes/section.tpl'}
        </section>

        <form id="createTopicForm">
            <input type="hidden" name="csrf_token" id="csrf_token" value="{$csrf_token|escape}">
            <!-- Выбор категории -->
            <div class="form-group">
                <label class="form-label" for="category_id">Категория <span>*</span></label>
                <select id="category_id" name="category_id" class="form-select" required>
                    <option value="" disabled selected>Выберите категорию</option>
                    {if $allCategories}
                        {foreach $allCategories as $category}
                        <option value="{$category['id']}">{$category['name']}</option>
                        {/foreach}
                    {/if}
                </select>
                <div class="error" id="error_category_id">Выберите категорию</div>
                {if $allCategories}
                    <div class="hint">Выберите подходящую категорию, чтобы тему быстрее нашли нужные участники.</div>
                {else}
                    <div class="hint error">Категории не созданы или ошибка загрузки списка.</div>
                {/if}
            </div>

            <!-- Заголовок темы -->
            <div class="form-group">
                <label class="form-label" for="title">Заголовок темы <span>*</span></label>
                <input type="text" id="title" name="title" class="form-input" placeholder="Например: Как типизировать fetch-ответы в TypeScript?" maxlength="150" required>
                <div class="error" id="error_title">Введите заголовок (не более 250 символов)</div>
                <div class="hint">Сделайте заголовок понятным и конкретным: так другие сразу поймут, о чём речь.</div>
            </div>

            <!-- Сообщение/контент темы -->
            <div class="form-group">
                <label class="form-label" for="content">Сообщение <span>*</span></label>
                <textarea id="content" name="content" class="form-textarea" placeholder="Расскажите подробнее: что хотите обсудить, какие варианты уже пробовали, какой результат ожидаете…" maxlength="30000" required></textarea>
                <div class="error" id="error_content">Введите текст сообщения</div>
                <div class="hint">Поддерживается простой текст. Для кода используйте тройные обратные кавычки (```) — позже добавим подсветку.</div>
            </div>

            <button type="button" class="btn-submit" onclick="createNewTopic()">Опубликовать тему</button>
        </form>

        <footer>
            {include '../includes/footer.tpl'}
        </footer>
    </div>
</body>
</html>