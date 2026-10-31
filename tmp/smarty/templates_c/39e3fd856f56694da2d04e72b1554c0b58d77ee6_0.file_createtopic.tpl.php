<?php
/* Smarty version 5.8.5, created on 2026-10-28 07:49:56
  from 'file:createtopic.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6ae17ef43ab737_76718521',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '39e3fd856f56694da2d04e72b1554c0b58d77ee6' => 
    array (
      0 => 'createtopic.tpl',
      1 => 1793162996,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../includes/head.tpl' => 1,
    'file:../includes/header.tpl' => 1,
    'file:../includes/section.tpl' => 1,
    'file:../includes/footer.tpl' => 1,
  ),
))) {
function content_6ae17ef43ab737_76718521 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\OSPanel\\domains\\testforum\\views\\default';
?><!doctype html>
<html lang="ru">
<head>
    <?php $_smarty_tpl->renderSubTemplate('file:../includes/head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
</head>
<body>
    <header>
        <?php $_smarty_tpl->renderSubTemplate('file:../includes/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
    </header>

    <div class="container">
        <section>
            <?php $_smarty_tpl->renderSubTemplate('file:../includes/section.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
        </section>

        <form id="createTopicForm">
            <input type="hidden" name="csrf_token" id="csrf_token" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('csrf_token'), ENT_QUOTES, 'UTF-8', true);?>
">
            <!-- Выбор категории -->
            <div class="form-group">
                <label class="form-label" for="category_id">Категория <span>*</span></label>
                <select id="category_id" name="category_id" class="form-select" required>
                    <option value="" disabled selected>Выберите категорию</option>
                    <?php if ($_smarty_tpl->getValue('allCategories')) {?>
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('allCategories'), 'category');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('category')->value) {
$foreach0DoElse = false;
?>
                        <option value="<?php echo $_smarty_tpl->getValue('category')['id'];?>
"><?php echo $_smarty_tpl->getValue('category')['name'];?>
</option>
                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    <?php }?>
                </select>
                <div class="error" id="error_category_id">Выберите категорию</div>
                <?php if ($_smarty_tpl->getValue('allCategories')) {?>
                    <div class="hint">Выберите подходящую категорию, чтобы тему быстрее нашли нужные участники.</div>
                <?php } else { ?>
                    <div class="hint error">Категории не созданы или ошибка загрузки списка.</div>
                <?php }?>
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
            <?php $_smarty_tpl->renderSubTemplate('file:../includes/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
        </footer>
    </div>
</body>
</html><?php }
}
