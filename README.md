# OwnDiary

## Описание

Личный дневник.

База данных - SQLite3.
CSS framework - Bootstrap 4

## История изменений

### 15.04.2019

* Полностью изменен дизайн. Фреймворк - Bootstrap 4
* Убран редактор CKEditor за ненадобностью.
* Изменена структура проекта.
* Добавлена простая админ-панель. Просмотр пользователей, всех записей и удаление записи.
* Добавлен просмотр профиля.

### 12.04.2019

* Добавлено нормальное экранирование строк при запросе в базу данных.
* Добавлено разделение по пользователям. Теперь пользователь видит только свои записи, а не все.
* Добавлено поле никнейма, емейл используется только для регистрации.

### 07.04.2019

* Создание базы происходит только во время регистрации.
* К паролю добавляется уникальная соль, которая хранится в базе.
* Переписана авторизация.
* Рефакторинг кода добавления записи

### 23.02.2019

* Добавил автоматическое изменение прав на файл базы данных. Теперь не возникает ошибки, если грузить на хостинг с линуксом.

### 30.01.2019

* Убрал ненужный скрипт с главной.
* Добавил автоматическую вставку даты. 
* Добавил защиту базы данных через .htaccess
* Добавил авторизацию и email автора при просмотре

### 21.01.2019

* Добавил CKEditor
* Сортировка по убыванию id
* Сделал подобие защиты от XSS атаки и теперь отображаются не все теги, а только некоторые
(` <p> <b> <i> <blockquote> <br> <del> <strong> <em> <s> <li> <ol>`)

## TODO

* Добавить настройки 
* Возможность прикрепления файлов 
* Проверка на пустую строку в редакторе.
* Переделать код обрезания тегов. Описан в файле *record.php*
* Добавить проверку на существование почты
* Добавить поле возраста в базу.
* Добавить дату регистрации в базу.

* В php имеются свои собственные функции хеширования и проверки, в будущем нужно переписать код под их использование.