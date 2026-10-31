-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 31 2026 г., 08:48
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `testforum`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text,
  `parent_id` int UNSIGNED DEFAULT NULL,
  `sort_order` int DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `parent_id`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Backend', 'backend', 'Создание логики на серверной стороне', NULL, 0, 1, '2026-10-26 12:38:26', '2026-10-26 12:38:26'),
(2, 'Frontend', 'frontend', 'Создание логики на клиентской стороне', NULL, 0, 1, '2026-10-26 12:38:26', '2026-10-26 12:38:26'),
(3, 'DevOps', 'devops', 'Организации процессов разработки и эксплуатации программного обеспечения, которая объединяет команды разработки (Development) и эксплуатации (Operations) в единое рабочее пространство', NULL, 0, 1, '2026-10-26 12:39:33', '2026-10-26 12:39:33'),
(4, 'QA', 'qa', 'Обеспечение качества', NULL, 0, 1, '2026-10-26 12:40:15', '2026-10-26 12:40:15'),
(5, 'Базы данных', 'database', 'Работа с базами данных', NULL, 0, 1, '2026-10-26 12:41:07', '2026-10-26 12:41:07'),
(6, 'Карьера и собеседования', 'сareer', 'Все что связано с карьерой и поиском работы и прохождениями собеседований', NULL, 0, 1, '2026-10-26 12:42:33', '2026-10-26 15:08:28');

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int NOT NULL,
  `topic_id` int NOT NULL,
  `user_id` int NOT NULL,
  `parent_id` int DEFAULT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `topic_id`, `user_id`, `parent_id`, `content`, `created_at`) VALUES
(3, 3, 4, NULL, 'Про', '2026-10-28 22:08:59'),
(6, 4, 4, NULL, 'ПРивет', '2026-10-29 09:37:39'),
(7, 4, 4, NULL, 'Ответил', '2026-10-29 11:50:13'),
(8, 3, 5, 3, '> Про\r\n\r\nОтвечаем, цитируя', '2026-10-29 12:02:14'),
(9, 3, 5, 3, '> Про\r\n\r\nВторой ответ', '2026-10-29 12:09:21'),
(10, 3, 5, 9, 'Привет\nПроверяем цитирование\nВот еще 1 строка', '2026-10-29 13:21:57'),
(11, 3, 5, 10, '> Привет\r\n> Проверяем цитирование\r\n> Вот еще 1 строка\r\n\r\nЦитата вставлена', '2026-10-29 21:23:49'),
(12, 4, 5, 7, '> Ответил\r\nБла бла', '2026-10-30 12:32:01');

-- --------------------------------------------------------

--
-- Структура таблицы `topics`
--

CREATE TABLE `topics` (
  `id` int NOT NULL,
  `category_id` int NOT NULL,
  `user_id` int NOT NULL,
  `title` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `post_count` int NOT NULL,
  `is_active` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_post_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `topics`
--

INSERT INTO `topics` (`id`, `category_id`, `user_id`, `title`, `content`, `post_count`, `is_active`, `created_at`, `last_post_at`) VALUES
(1, 5, 4, 'Как правильно делать миграции БД в PHP-проекте?', 'Правильный подход к миграциям базы данных в PHP-проекте — это не просто написание SQL-запросов, а целый процесс, который обеспечивает целостность данных, упрощает командную работу и позволяет легко откатываться при ошибках. Я подобрала ключевые принципы, которые стоит соблюдать независимо от того, используете вы фреймворк или пишете код вручную. ', 0, 1, '2026-10-26 15:38:19', '2026-10-26 15:38:19'),
(2, 2, 5, 'TypeScript: как типизировать fetch-ответы?', 'Типизация ответов от fetch в TypeScript — это про то, чтобы компилятор проверял, правильно ли вы используете данные, которые приходят с сервера. Я подобрала несколько рабочих подходов — от простого к более надёжному', 0, 1, '2026-10-26 15:38:19', '2026-10-26 15:38:19'),
(3, 3, 4, 'Git flow: как делить задачи между 3 разработчиками?', 'В модели Git Flow работа над задачами для трёх разработчиков строится на чётком разделении потоков и использовании вспомогательных веток. Основная идея — изолировать изменения каждого разработчика, чтобы избежать конфликтов и сохранить стабильность основной ветки.', 5, 1, '2026-10-26 15:38:40', '2026-10-26 15:38:40'),
(4, 6, 5, 'Как найти работу мечты?', 'Найти «работу мечты» — это не про одну удачную вакансию, а про систему: понять, что тебе по-настоящему близко, собрать релевантные навыки, грамотно себя подать и целенаправленно искать. Учитывая, что ты активно работаешь с PHP, SQL, Smarty, AJAX, делаешь форум и разбираешься в структуре данных, у тебя уже есть база для IT‑направления — и это можно прямо использовать в поиске.', 3, 1, '2026-10-28 07:53:58', '2026-10-28 07:53:58'),
(7, 2, 5, 'Подключение CSS на странице', 'Объясните как подключить файл css в html странице, для полноценного оформления?', 0, 1, '2026-10-30 20:28:50', '2026-10-30 20:28:50');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'user',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password_hash`, `role`, `created_at`) VALUES
(4, 'Litron', 'musorschik2008@yandex.ru', '$2y$10$G/s2/c0IsZXX5a/zNSIf/OkVPtHfN9CIn5Nf.6xWnZydM9E0pVo7y', 'user', '2026-10-27 11:54:54'),
(5, 'Serg9', 'test@mail.ru', '$2y$10$KRdazlJl4SyAFbePALHhvuGcP3n3EwGgcd2yj3RhIlTPN5MJrG9q.', 'user', '2026-10-28 07:35:36');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `idx_slug` (`slug`),
  ADD KEY `idx_parent` (`parent_id`),
  ADD KEY `idx_sort` (`sort_order`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topic_id` (`topic_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `idx_parent_id` (`parent_id`);

--
-- Индексы таблицы `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `topics_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
