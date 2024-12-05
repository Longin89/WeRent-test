# Задача
Написать микросервис работы с гостями используя язык программирования php, можно пользоваться любыми opensource пакетами, также возможно реализовать с использованием фреймворков или без них.

БД postgresql

Микросервис реализует API для CRUD операций над гостем. То есть принимает данные для создания, изменения, получения, удаления записей гостей хранящихся в выбранной базе данных.

Сущность «Гость»: Имя, фамилия и телефон — обязательные поля. А поля телефон и email уникальны. В итоге у гостя должны быть следующие атрибуты: идентификатор, имя, фамилия, email, телефон, страна.

Если страна не указана, то доставать страну из номера телефона +7 - Россия и т.д.

Микросервис должен запускаться в Docker.

В ответах сервера должны присутствовать два заголовка X-Debug-Time и X-Debug-Memory, которые указывают сколько миллисекунд выполнялся запрос и сколько Кб памяти потребовалось соответственно.

## Общая информация
Сервис представляет собой API, реализующий CRUD-операции, а так-же предоставляющий информацию о времени выполнения запроса и затраченном объеме ОЗУ.
Для документирования методов использован фреймворк Swagger.
Проект реализован на базе докер-контейнера и фреймворка Laravel 10, имеет пошаговую инструкцию по тестированию приложения.

## 0. Подготовка

Находясь в папке, в которую Вы хотите скачать проект, клонируем репозиторий с помощью команды:

```git clone git@github.com:Longin89/WeRent-test.git```

После этого, переходим в папку проекта:

```cd WeRent-test```

## 1. Установка

Для начала нужно скачать все необходимое для  контейнера командой:

```docker-compose build```

После этого запустить сервисы с помощью:

```docker-compose up -d```

Затем зайти в файловую систему контейнера:

```docker exec -it -i php /bin/bash```

В папку ```src```:

```cd src ```

Чтобы установить зависимости командой:

```composer install```

После завершения установки в браузерной строке нужно перейти по адресу:

```http://localhost```

Чтобы убедится, что Laravel работает

![Laravel](/screenshots/1.jpg)

#### Внимание: если страница Laravel не отображается - проверьте наличие полных прав на папку проекта и обновите страницу.
В Ubuntu, например, самый простой способ это сделать - ввести команду:

```sudo chmod -R 777 '/папка_проекта/'```

## 2. Миграция базы данных

Там-же, в файловой системе контейнера введите команду:

```php artisan migrate```

для миграции тестовой базы данных.

Проверить результат (помимо логов) можно с помощью pgAdmin (база данных guests), находящемуся по адресу:

```http://localhost:8080```

E-mail для входа: ```test@gmail.com```

Пароль: ```root```

Пароль для подключения к серверу БД: ```pass```

![pgadmin](/screenshots/2.jpg)

## 3. Проверка работы в Swagger
![Swagger](/screenshots/3.jpg)
Для проверки работы CRUD-операций в сборку интегрирован Swagger, находится он по адресу:

```http://localhost/api/documentation```

API содержит в себе 5 методов:

```GET /api/guests``` - возвращает все записи гостей из БД.

```POST /api/guests``` - добавляет запись нового гостя в БД, если необходимые поля заполнены корректно, или ошибку, если нет.

```GET /api/guests/{guest}``` - возвращает запись гостя с указанным ИД или ошибку, если запись не существует.

```PUT /api/guests/{guest}``` - обновляет запись гостя с указанным ИД или возвращает ошибку, если запись не существует или введенные данные некорректны.

```DELETE /api/guests/{guest}``` - удаляет запись гостя с указанным ИД или возвращает ошибку, если запись не существует.

Поля принимают следующие данные:

```first_name``` - имя.

```last_name``` - фамилия.

```phone``` - номер телефона (максимум 20 знаков).

```email``` - электронная почта.

```country``` - страна (если не заполнено - заполняется автоматически, исходя из кода страны в телефоне).

#### Примечание: поле для номера телефона использует regexp для корректного определения кода страны и принимает значение в формате:
 ```+код страны-номер телефона```

 #### например
 ```+7-960-396-17-11``` или ```+7-9603961711```

 #### Если при обновлении номера телефона будет использован код другой страны, то поле ```country``` меняться не будет, т.к. в ТЗ этого не было указано.

После проведения любой операции вместе с ответом сервера возвращаются необходимые заголовки (```x-debug-time```, ```x-debug-memory```), указанные в ТЗ:

![Swagger headers](/screenshots/4.jpg)

Поле ```country``` заполнилось, исходя из кода в номере телефона:

![Swagger answer](/screenshots/5.jpg)

## 4. Коды стран в номерах телефонов
Список стран хранится в виде массива в модели ```Guest```:

![Countries array](/screenshots/6.jpg)

Список стран неполный и взят для демонстрации работы API, может масштабироваться исходя из нужд.

#### Примечание: в случае, если при добавлении гостя код страны будет отсутствовать в списке и поле ```country``` не будет заполнено - запись будет добавлена с соответствующим комментарием:
![Unknown country](/screenshots/7.jpg)

## 4. Комментарии
Код в проекте снабжен лаконичными, но понятными (надеюсь) комментариями:

![Comment1](/screenshots/8.jpg)

![Comment2](/screenshots/9.jpg)