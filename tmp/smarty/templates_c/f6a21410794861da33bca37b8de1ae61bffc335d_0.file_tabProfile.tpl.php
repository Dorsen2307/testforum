<?php
/* Smarty version 5.8.5, created on 2026-11-07 10:57:29
  from 'file:C:\OSPanel\domains\testforum\views\default\../includes/tabProfile.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6aeed9e9f05eb8_69778112',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f6a21410794861da33bca37b8de1ae61bffc335d' => 
    array (
      0 => 'C:\\OSPanel\\domains\\testforum\\views\\default\\../includes/tabProfile.tpl',
      1 => 1794038249,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../includes/pagination.tpl' => 2,
    'file:../includes/posts.tpl' => 1,
  ),
))) {
function content_6aeed9e9f05eb8_69778112 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\OSPanel\\domains\\testforum\\views\\includes';
if ($_smarty_tpl->getValue('tab') === 'about') {?>
    <!-- Панель: О себе -->
    <div class="profile-panel" id="panel-info" role="tabpanel">
        <div class="profile-card profile-about">
            <p class="profile-about-text">
                <?php echo $_smarty_tpl->getValue('arrUser')['about'];?>

            </p>
        </div>
    </div>
<?php }?>

<?php if ($_smarty_tpl->getValue('tab') === 'topics') {?>
    <!-- Панель: Темы -->
    <?php if ($_smarty_tpl->getValue('allTopics')) {?>
    <div class="profile-panel" id="panel-topics" role="tabpanel">
        <ul class="topics-list">
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('allTopics'), 'topic');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('topic')->value) {
$foreach0DoElse = false;
?>
            <li class="topic-row">
                <div>
                    <div class="topic-card-title"><a href="/?controller=topic&topic_id=<?php echo $_smarty_tpl->getValue('topic')['id'];?>
"><?php echo $_smarty_tpl->getValue('topic')['title'];?>
</a></div>
                    <div class="topic-card-meta">Создана <?php echo $_smarty_tpl->getValue('topic')['user_created_at'];?>
</div>
                    <div class="topic-card-meta">Последние изменения <?php echo $_smarty_tpl->getValue('topic')['user_last_post_at'];?>
</div>
                </div>
                <div></div>
                <div class="stats"><?php echo $_smarty_tpl->getValue('topic')['post_count'];?>
 ответов</div>
            </li>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </ul>

        <?php $_smarty_tpl->renderSubTemplate('file:../includes/pagination.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
    </div>
    <?php } else { ?>
    <div class="empty-state">Тем пока нет</div>
    <?php }
}?>

<?php if ($_smarty_tpl->getValue('tab') === 'posts') {?>
    <!-- Панель: Комментарии -->
    <?php $_smarty_tpl->renderSubTemplate('file:../includes/posts.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
    <?php $_smarty_tpl->renderSubTemplate('file:../includes/pagination.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}?>

<?php if ($_smarty_tpl->getValue('tab') == 'settings' && $_smarty_tpl->getValue('isCurrentUser')) {?>
    <!-- Панель: Настройки -->
    <div class="profile-panel" id="panel-settings" role="tabpanel">
        <form id="updateProfileForm" class="profile-form" enctype="multipart/form-data">
            <div class="form-group">
                <label class="form-label" for="login">Логин <span>*</span></label>
                <input class="form-input" id="login" name="login" type="text" value="<?php echo $_smarty_tpl->getValue('arrUser')['username'];?>
" required>
                <div class="hint">От 3 до 32 символов</div>
                <div class="error" id="error_login"></div>
            </div>

            <div class="form-group">
                <label class="form-label" for="email">Почта</label>
                <input class="form-input" id="email" name="email" type="email">
                <div class="error" id="error_email"></div>
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Новый пароль</label>
                <input class="form-input" id="password" name="password" type="password" placeholder="Оставьте пустым, чтобы не менять">
                <div class="error" id="error_password"></div>
                <div class="hint">Минимум 8 символов</div>
            </div>

            <div class="form-group">
                <label class="form-label" for="about">О себе</label>
                <textarea class="form-textarea" id="about" name="about" placeholder="Расскажите о себе…"><?php echo $_smarty_tpl->getValue('arrUser')['about'];?>
</textarea>
            </div>

            <div class="form-group">
                <label class="form-label" for="photo">Фото профиля</label>
                <input class="form-input" id="photo" name="photo" type="file" accept="image/*">
                <div class="error" id="error_photo"></div>
                <div class="hint">JPG или PNG, до 2 МБ</div>
            </div>

            <button class="btn-submit" type="button" onclick="updateProfileUserData()">Сохранить изменения</button>
            <div class="error" id="error_new-data"></div>
        </form>
    </div>
<?php }
}
}
