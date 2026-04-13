# Инструкция по установке Laravel-проекта

## Шаг 1: Создание нового проекта Laravel

Откройте терминал и выполните команду для создания нового проекта Laravel:

```bash
composer create-project laravel/laravel my-website
cd my-website
```

## Шаг 2: Копирование файлов

Скопируйте следующие файлы из папки `laravel-files` в ваш Laravel-проект:

### Контроллеры
- `app/Http/Controllers/HomeController.php` → скопировать в `my-website/app/Http/Controllers/`
- `app/Http/Controllers/TestController.php` → скопировать в `my-website/app/Http/Controllers/`

### Модели
- `app/Models/Interest.php` → скопировать в `my-website/app/Models/`
- `app/Models/Photo.php` → скопировать в `my-website/app/Models/`

### Маршруты
- `routes/web.php` → заменить содержимое `my-website/routes/web.php`

### Представления (Blade шаблоны)
- `resources/views/layouts/main.blade.php` → скопировать в `my-website/resources/views/layouts/`
- `resources/views/home/index.blade.php` → скопировать в `my-website/resources/views/home/`
- `resources/views/home/about.blade.php` → скопировать в `my-website/resources/views/home/`
- `resources/views/home/interests.blade.php` → скопировать в `my-website/resources/views/home/`
- `resources/views/home/photos.blade.php` → скопировать в `my-website/resources/views/home/`
- `resources/views/home/study.blade.php` → скопировать в `my-website/resources/views/home/`
- `resources/views/home/history.blade.php` → скопировать в `my-website/resources/views/home/`
- `resources/views/home/contacts.blade.php` → скопировать в `my-website/resources/views/home/`
- `resources/views/test/index.blade.php` → скопировать в `my-website/resources/views/test/`

### Ассеты (CSS, JS, изображения)
Скопируйте всю папку `public/assets` из вашего старого проекта в `my-website/public/`:

```bash
# Из исходного проекта
cp -r /path/to/old/project/public/assets my-website/public/
```

## Шаг 3: Настройка окружения

1. Скопируйте файл `.env.example` в `.env`:
```bash
cp .env.example .env
```

2. Сгенерируйте ключ приложения:
```bash
php artisan key:generate
```

3. При необходимости настройте подключение к базе данных в файле `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

## Шаг 4: Запуск проекта

Запустите локальный сервер разработки:

```bash
php artisan serve
```

Откройте браузер и перейдите по адресу: http://localhost:8000

## Основные изменения при миграции

### 1. Роутинг
- Было: Custom Router с regex паттернами
- Стало: Laravel routes в `routes/web.php`

### 2. Контроллеры
- Было: Наследование от `App\Core\Controller`
- Стало: Наследование от `App\Http\Controllers\Controller`

### 3. Представления
- Было: PHP шаблоны с `<?= $variable ?>`
- Стало: Blade шаблоны с `{{ $variable }}` и `@extends`, `@section`

### 4. Валидация форм
- Было: Custom `FormValidation` класс
- Стало: Laravel `Validator::make()` или `$request->validate()`

### 5. CSRF защита
- Добавлена директива `@csrf` во все формы

### 6. Старые данные форм
- Было: Ручная передача `$oldInput`
- Стало: Helper `old('field_name', $fallback)`

## Структура файлов Laravel

```
my-website/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── HomeController.php
│   │       └── TestController.php
│   └── Models/
│       ├── Interest.php
│       └── Photo.php
├── routes/
│   └── web.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── main.blade.php
│       ├── home/
│       │   ├── index.blade.php
│       │   ├── about.blade.php
│       │   ├── interests.blade.php
│       │   ├── photos.blade.php
│       │   ├── study.blade.php
│       │   ├── history.blade.php
│       │   └── contacts.blade.php
│       └── test/
│           └── index.blade.php
├── public/
│   └── assets/
│       ├── css/
│       ├── js/
│       └── img/
└── .env
```

## Примечания

1. **Модели Interest и Photo** не наследуются от `Illuminate\Database\Eloquent\Model`, так как используют константы вместо базы данных. Если хотите использовать БД, нужно создать миграции и изменить модели.

2. **Трекинг просмотров** работает через localStorage и cookies как в оригинальной версии.

3. **Валидация** использует встроенные правила Laravel с кастомными сообщениями об ошибках.

4. **Все ассеты** (CSS, JS, изображения) должны быть скопированы из оригинального проекта в `public/assets`.
