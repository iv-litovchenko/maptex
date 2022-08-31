<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Изучаем Laravel http://maptex.ru/

-------------------------------
# Установка
-------------------------------

- // Настройка прав доступа для Docker-а
- $ which docker-compose
- $ sudo chmod +x /usr/bin/docker-compose;
- $ sudo usermod -aG docker $USER // to add myself to docker group
- $ sudo chgrp docker /usr/bin/docker-compose // to give docker-compose to docker group,
- $ sudo chmod 750 /usr/bin/docker-compose // to allow docker group users to execute it

- // Запуск проекта (часть 1)
- $ git clone https://github.com/iv-litovchenko/maptex.git
- $ cd maptex
- $ cp .env.example .env
- $ sudo chmod 777 . -R (для локальной разработки - не обязательно!)
- $ docker-compose up -d --build
- $ docker exec -ti php-apache bash

- // Запуск проекта (часть 2 - внутри контейнера сервиса)
- $ > composer install
- $ > npm install
- $ > npm run dev
- $ > php artisan storage:link
- $ > php artisan key:generate
- $ > php artisan migrate:auto
- $ > php artisan db:seed
- $ > php artisan tinker
- $ > DB::connection()->getDatabaseName();
- $ > exit

- Логин и пароль для входа
- http://localhost:8011/
- http://localhost:8011/login
- Login: iv-litovchenko@mail.ru
- Password: 100
- http://localhost:8012/
- http://localhost:8013/

-------------------------------
Деплой
-------------------------------

- 0

-------------------------------
Двигаемся
-------------------------------

- Vue
- Docker
- Composer (установка расширений для Laravel)
- NPM (Note.js) - сборка клиентской части на основе Mix
- Маршрутизация и контроллеры
- Модели и миграции
- Загрузка и извлечение файлов Storage::disk('public');
    - php artisan storage:link
- TinyMCE (wysiwyg editor) и composer require mews/purifier
- Request-валидация
- Шаблонизатор Blade
    - Layout
    - Template
    - Partials
    - Component (для шаблона)
- Полноценные компоненты
- Аутентификация и авторизация
- Гейты и политики (проверка прав доступа)
    - Политики
- Посредники (middlware)
- Проверка кода на стандарты PSR (инструменты)
- Документации (генерация документации по классам)
- Документация (вставка: doc/ER-диаграмма, doc/диаграммы классов)
- [todo] Доразобраться с прикреплением картинок (аналог fk внешних ключей в связях между таблицами)
- [todo] Почта
- [todo] Ajax - попробовать на чем-то
- [todo] Очереди
- [todo] Работа с файлами

-------------------------------
Использованные пакеты
-------------------------------

- laravel backup (базы/файлов) - composer require spatie/laravel-backup (php artisan backup:run)

-------------------------------
Редактор текста (аналог)
-------------------------------

- https://github.com/VanOns/laraberg
- https://github.com/VanOns/laraberg-demo
- http://demo.laraberg.io/articles/1706/post.php?post=1&action=edit

-------------------------------
Блоги
-------------------------------

1) https://jonathanbriehl.com/
3) https://laravel.demiart.ru/
4) https://badcode.ru/

-------------------------------
Diff-для истории
-------------------------------

- https://github.com/caxy/php-htmldiff
- https://github.com/vi-kon/laravel-diff

-------------------------------
Идеи
-------------------------------

- миграции (по шагам) - пакет
- создание связей link, unlink + автосвязи, mediaLink, mediaUnlink (понравилась идея репозитория отвечающего только за связывание записей UserRepo RoleRepo UserRoleRepo
- html CSS вертска (фрейм)
- json для загрузки файлов
- автомиграции
- crud из TYPO3

-------------------------------
Идея фич для проекта
-------------------------------

- Можно еще для сервиса загрузки картинок сделать замену файла... А также выбор из существующих файлов
- Светофоры - Вывести иконки на всех страницах
- Добавить другой способ создания подразделов (прямо на меню справа добавить 2 иконки - создать подраздел, добавить после, добавить перед)
- оглавление подразделов новый тип
- Идея парсить исходный код этого проекта (любые файлы, все что нельзя задокументирвать через phpdoc) и забирать комментарии в таблицу
- Посмотри то меню (можно ли там делать хлебные крошки, можно ли задавать название страницы в Route?)
- Добавить роли на проекте - выпилить мидлваре "isMe"
- Идея с кодами и словами (на примере английского и git команд)
- Как быть с тип "раздел" (он не отображает всех дочек подстраниц страниц)
- МиндМап - веточка в лево (на примере английского языка)
- МиндМап - выделение зелененьким активного раздела для Mindmap
- Файлы (перекинуть файл в другую запись, json для файлов)
- Прикрепление файла в заметках
- Паттерн репозиторий
- Модерация комментариев
- Комментарии к постам (страницам) 
- MindMap на основе SVG
- Вставать мою фотку в йоги Вставить баннер с яндекса Диска Вывести тот баннер приветствие на главной с
- Создать инсталл баш, создать деплой баш
-------------------------------

- CI CD
- мастер слейв (master slave), https://www.digitalocean.com/community/tutorials/how-to-set-up-replication-in-mysql
- nrock
