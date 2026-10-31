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

        <!-- Категории -->
        <div class="categories">
            {include '../includes/categories.tpl'}
        </div>

        <!-- Список тем -->
        <ul class="topics-list">
            {include '../includes/topicCards.tpl'}
        </ul>

        <footer>
            {include '../includes/footer.tpl'}
        </footer>
    </div>
</body>
</html>