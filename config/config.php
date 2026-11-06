<?php
/**
 * Файл настроек проекта
 */
// Константы для обращения к контроллерам
const PATHPREFIX = '../controllers/';
const PATHPOSTFIX = 'Controller.php';

// Константы для подключения к БД
const DB_HOST = 'localhost';
const DB_NAME = 'testforum';
const DB_USER = 'root';
const DB_PASS = '';

// Константы пагинации
const PER_PAGE_TOPICS = 2;
const PER_PAGE_POSTS = PER_PAGE_TOPICS;
const PER_PAGE_TOPICS_PROFILE = PER_PAGE_TOPICS;
const PER_PAGE_POSTS_PROFILE = PER_PAGE_TOPICS;

// Роли
const ROLE = ['user', 'admin', 'moderator'];

// Папка шаблона
$templateFolders = 'default';

// Константы для работы с файлами
const ALLOWED_FILE = ['jpg', 'jpeg', 'png'];
const UPLOAD_PROFILE_FOLDER = "/../www/uploads/profile/";
const UPLOAD_PROFILE_URL = "/uploads/profile/";

// Путь к шаблонам
define ('TMPLTPREFIX', "../views/$templateFolders/");

// Расширение файла шаблона
const TMPLTPOSTFIX = '.tpl';

// Путь к шаблонам в www
define('TMPLTWEBPATH', "../templates/$templateFolders/");

// Подключаем шаблонизатор
require ('../library/Smarty/libs/Smarty.class.php');
use Smarty\Smarty;
$smarty = new Smarty();

// Конфигурация объекта smarty
$smarty->setTemplateDir(TMPLTPREFIX); // каталог наших шаблонов
$smarty->setCompileDir('../tmp/smarty/templates_c'); // куда складываем скомпелированные страницы
$smarty->setCacheDir('../tmp/smarty/cache'); // хранение кешированных данных
$smarty->setConfigDir('../library/Smarty/configs'); // конфигурация данных

$smarty->assign('templateWebPath', TMPLTWEBPATH);
$smarty->assign('uploadUrl', UPLOAD_PROFILE_URL);