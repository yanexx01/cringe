<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <meta name="author" content="Lucky"/>
    <!-- Динамический title -->
    <title><?= $pageTitle ?? 'Личный сайт' ?></title>
    
    <!-- Подключаем стили относительно корня сайта (public) -->
    <link rel="stylesheet" href="/assets/css/style.css"/>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <!-- Твои скрипты -->
    <script src="/assets/js/menu.js"></script>
    <script src="/assets/js/clock.js"></script>
    <script src="/assets/js/tracking.js"></script>
    <script src="/assets/js/popover.js"></script>
    <script src="/assets/js/modal.js"></script>

    
    <!-- Скрипт трекинга с правильной переменной -->
    <script>
    // Берем pageTitle, который передал контроллер, или fallback на URL
    const pageName = "<?= $pageName ?? 'unknown' ?>";
    
    // Ждем загрузки DOM, чтобы вызвать функцию трекинга
    $(function() {
        if (typeof trackPageView === 'function') {
            trackPageView(pageName);
        }
    });
    </script>
</head>

<body>
    <header id="top">
        <nav class="main-menu">
            <ul>
                <li><a href="/" class="menu-item" data-page="home">Главная</a></li>
                <li><a href="/about" class="menu-item" data-page="about">Обо мне</a></li>
                
                <!-- Пункт меню с выпадающим списком -->
                <li class="dropdown">
                    <a href="/interests" class="menu-item" data-page="interests">Мои интересы</a>
                    <ul class="dropdown-menu">
                        <li><a href="/interests#hobby" class="dropdown-link">Хобби</a></li>
                        <li><a href="/interests#books" class="dropdown-link">Книги</a></li>
                        <li><a href="/interests#music" class="dropdown-link">Музыка</a></li>
                        <li><a href="/interests#games" class="dropdown-link">Игры</a></li>
                    </ul>
                </li>

                <li><a href="/study" class="menu-item" data-page="study">Учеба</a></li>
                <li><a href="/photos" class="menu-item" data-page="photos">Фотоальбом</a></li>
                <li><a href="/history" class="menu-item" data-page="history">История просмотра</a></li>
                <li><a href="/contacts" class="menu-item" data-page="contacts">Обратная связь</a></li>
                <li><a href="/test" class="menu-item" data-page="test">Тест</a></li>
            </ul>
            
            <div id="clock" class="clock-display">
                <p>Загрузка...</p>
            </div>
        </nav>
    </header>

    <main>
        <!-- Сюда будет вставляться контент конкретной страницы -->
        <?= $content ?>
    </main>

    <!-- Футер или модальные окна можно добавить сюда, если они общие для всех -->
    
    <!-- Подключаем остальные скрипты, если нужно -->
    <script src="/assets/js/photos.js"></script>
    <script src="/assets/js/contacts.js"></script>
    <!-- <script src="/assets/js/test.js"></script> -->
    <script src="/assets/js/interests.js"></script>
</body>
</html>