/**
 * Регистрация нового пользователя
 */
function registrationNewUser() {
    let form = $('#registerForm')[0];
    const formData = new FormData(form);

    $.ajax({
        type: 'POST',
        url: '/?controller=user&action=registration',
        data: formData,
        dataType: 'json',
        success: function(data) {
            console.log(data);
            if (data.success) {
                window.location.href = '/';
            } else {
                showFormErrors(data.errors || {});
            }
        },
        error: function(xhr, status, error) {
            let response;
            try {
                response = JSON.parse(xhr.responseText);
            } catch (e) {
                console.error('Не удалось распарсить ответ сервера', xhr.responseText);
                alert('Произошла ошибка на сервере. Проверьте консоль.');
                return;
            }

            showFormErrors(response.errors || {});

            if (!response.errors) {
                alert(response.message || 'Произошла ошибка при регистрации');
            }
        }
    });
}

/**
 * Авторизация пользователя
 */
function loginUser() {
    let form = $('#authForm')[0];
    const formData = new FormData(form);

    $.ajax({
        type: 'POST',
        url: '/?controller=user&action=authorization',
        data: formData,
        dataType: 'json',
        success: function(data) {
            if (data.success) {
                window.location.href = '/';
            } else {
                showFormErrors(data.errors || {});
            }
        },
        error: function(xhr, status, error) {
            let response;
            try {
                response = JSON.parse(xhr.responseText);
            } catch (e) {
                console.error('Не удалось распарсить ответ сервера', xhr.responseText);
                alert('Произошла ошибка на сервере. Проверьте консоль.');
                return;
            }

            showFormErrors(response.errors || {});

            if (!response.errors) {
                alert(response.message || 'Произошла ошибка при авторизации');
            }
        }
    });
}

/**
 * Создание новой темы
 */
function createNewTopic() {
    let form = $('#createTopicForm')[0];
    const formData = new FormData(form);

    $.ajax({
        type: 'POST',
        url: '/?controller=topic&action=createtopic',
        data: formData,
        dataType: 'json',
        success: function(data) {
            if (data.success) {
                alert(data.message);
                window.location.href = "/?controller=topic&id=" + data['topicId'];
            } else {
                showFormErrors(data.errors || {});
            }
        },
        error: function(xhr, status, error) {
            let response;
            try {
                response = JSON.parse(xhr.responseText);
            } catch (e) {
                console.error('Не удалось распарсить ответ сервера', xhr.responseText);
                alert('Произошла ошибка на сервере. Проверьте консоль.');
                return;
            }

            showFormErrors(response.errors || {});

            if (!response.errors) {
                alert(response.message || 'Произошла ошибка при создании темы');
            }
        }
    });
}

/**
 * Отображает сообщения об ошибках в блоках с error_...
 * @param errorsData массив ошибок
 */
function showFormErrors(errorsData) {
    // Сбрасываем старые ошибки
    $('.error').removeClass('visible').text('');

    if (!errorsData || typeof errorsData !== 'object') {
        return;
    }

    Object.keys(errorsData).forEach(function(fieldName) {
        const errorText = errorsData[fieldName];
        const $block = $('#error_' + fieldName);

        if ($block.length) {
            $block.text(errorText).addClass('visible');
        } else {
            console.warn('Не найден блок ошибки для поля:', fieldName);
        }
    });
}

/**
 * Отправка нового поста через AJAX
 */
function handleAddPost() {
    let form = $('#addPostForm')[0];
    const formData = new FormData(form);

    $.ajax({
        type: 'POST',
        url: '/?controller=post&action=add',
        data: formData,
        dataType: 'json',
        success: function (data) {
            if (data.success) {
                // Очищаем форму
                form.reset();
                // Перезагружаем список постов или добавляем один пост динамически
                location.reload();
            } else {
                showFormErrors(data.errors || {});
            }
        },
        error: function(xhr, status, error) {
            let response;
            try {
                response = JSON.parse(xhr.responseText);
            } catch (e) {
                console.error('Не удалось распарсить ответ сервера', xhr.responseText);
                alert('Произошла ошибка на сервере. Проверьте консоль.');
                return;
            }

            showFormErrors(response.errors || {});

            if (!response.errors) {
                alert(response.message || 'Произошла ошибка при создании темы');
            }
        }
    });
}

/**
 * Подставляет цитату по кнопке Ответить в textarea
 * @param postId id поста
 */
function openReplyForm(postId) {
    const textarea = document.querySelector('#addPostForm textarea');
    if (!textarea) {
        console.warn('Текстовое поле для ответа не найдено');
        return;
    }

    const postElement = document.getElementById('post-' + postId);
    if (!postElement) {
        console.error('Пост с ID ' + postId + ' не найден');
        return;
    }

    const contentElement = postElement.querySelector('.post-content');
    if (!contentElement) {
        console.error('Контент поста не найден');
        return;
    }

    // Получаем текст, сохраняя структуру абзацев
    let content = contentElement.innerText || contentElement.textContent || '';

    // Если текст пустой — не вставляем пустую цитату
    if (!content.trim()) {
        textarea.value = '';
        textarea.focus();
        return;
    }

    // Формируем цитату: каждую строку начинаем с "> "
    const quotedText = content
        .split(/\r?\n/)                 // корректно разбиваем по переносам
        .map(line => '> ' + line)       // добавляем префикс к каждой строке
        .join('\n') + '\n\n';           // два переноса в конце, чтобы курсор был ниже цитаты

    textarea.value = quotedText;
    textarea.focus();
    window.scrollTo(0, document.body.scrollHeight);
}