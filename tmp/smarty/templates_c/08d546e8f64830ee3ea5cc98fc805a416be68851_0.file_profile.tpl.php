<?php
/* Smarty version 5.8.5, created on 2026-11-04 17:53:08
  from 'file:profile.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6aeb46d45fa8a7_79963036',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '08d546e8f64830ee3ea5cc98fc805a416be68851' => 
    array (
      0 => 'profile.tpl',
      1 => 1793803988,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../includes/head.tpl' => 1,
    'file:../includes/header.tpl' => 1,
    'file:../includes/footer.tpl' => 1,
  ),
))) {
function content_6aeb46d45fa8a7_79963036 (\Smarty\Template $_smarty_tpl) {
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
        <h1 class="profile-title">Профиль</h1>

        <!-- Шапка профиля -->
        <div class="profile-card">
            <div class="profile-avatar">
                <?php if ($_smarty_tpl->getValue('arrUser')['photo']) {?>
                    <img src="<?php echo $_smarty_tpl->getValue('uploadUrl');
echo $_smarty_tpl->getValue('arrUser')['photo'];?>
" alt="Фото профиля">
                <?php } else { ?>
                    <h1 style="display: block; text-align: center"><\></h1>
                <?php }?>
            </div>
            <div class="profile-head">
                <h2 class="profile-login"><?php echo $_smarty_tpl->getValue('arrUser')['username'];?>
 <span class="profile-meta">(<?php echo $_smarty_tpl->getValue('arrUser')['roleName'];?>
)</span></h2>
                <div class="profile-meta">
                    <span>Почта: <a href="mailto:<?php echo $_smarty_tpl->getValue('arrUser')['email'];?>
"><?php echo $_smarty_tpl->getValue('arrUser')['email'];?>
</a></span>
                    <span class="meta-sep">•</span>
                    <span>Дата регистрации: <?php echo $_smarty_tpl->getValue('arrUser')['created_at'];?>
</span>
                </div>
            </div>
        </div>

        <!-- Вкладки -->
        <div class="profile-tabs" role="tablist">
            <button class="profile-tab active" data-tab="info" role="tab" aria-selected="true" onclick="showProfileTab('info')">О себе</button>
            <button class="profile-tab" data-tab="topics" role="tab" aria-selected="false" onclick="showProfileTab('topics')">Темы</button>
            <button class="profile-tab" data-tab="comments" role="tab" aria-selected="false" onclick="showProfileTab('comments')">Комментарии</button>
            <button class="profile-tab" data-tab="settings" role="tab" aria-selected="false" onclick="showProfileTab('settings')">Настройки</button>
        </div>

        <!-- Панель: О себе -->
        <div class="profile-panel active" id="panel-info" role="tabpanel">
            <div class="profile-card profile-about">
                <p class="profile-about-text">
                    <?php echo $_smarty_tpl->getValue('arrUser')['about'];?>

                </p>
            </div>
        </div>

        <!-- Панель: Темы -->
        <div class="profile-panel" id="panel-topics" role="tabpanel">
            <ul class="topics-list">
                <li class="topic-row">
                    <div>
                        <div class="topic-card-title"><a href="#">Как выучить Python за месяц?</a></div>
                        <div class="topic-card-meta">создана 12.03.2024</div>
                    </div>
                    <div class="stats">12 ответов</div>
                    <div class="stats">340 просмотров</div>
                </li>
                <!-- ... -->
            </ul>
            <div class="empty-state" hidden>Тем пока нет</div>
        </div>

        <!-- Панель: Комментарии -->
        <div class="profile-panel" id="panel-comments" role="tabpanel">
            <div class="posts-list">
                <article class="post-item">
                    <div class="post-header">
                        <span class="post-author"><strong>username</strong></span>
                        <span class="post-date">14.03.2024</span>
                    </div>
                    <div class="post-content">Отличный вопрос! Я бы начал с основ синтаксиса…</div>
                    <div class="post-actions">
                        <a href="#" class="btn btn-sm btn-outline">Перейти к теме</a>
                    </div>
                </article>
            </div>
        </div>

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

        <footer>
            <?php $_smarty_tpl->renderSubTemplate('file:../includes/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
        </footer>
    </div>
</body>
</html><?php }
}
