# AccountBox API Client

Системная библиотека, предназначенная для работы с API сервиса accountbox

Установить с помощью **Composer:**
``
composer require accountbox/api_client
``

## Создание объекта библиотеки
```php
$authClient = new ABAPI\Clients\AuthClient(string $token, string $baseUri); // Создаем клиента для последующих запросов
$ab = new ABAPI\AB($authClient); // Создаем экземпляр библиотеки
```

## Работа с рассылкой

### Получение рассылки
```php
$list = $ab->list()->getList(14);
```

### Создание рассылки
```php
$abList = new ABList();
$list = $ab->list()->createList($abList);
```

### Получение статуса телефона в рассылке
```php
$phoneStatus = $ab->list()->getPhoneStatus(1, "79188680973");
```

### Обновить дедлайн у рассылки
```php
$list = $ab->list()->updateListDeadline(1, "2023-03-03 13:30:00");
```

### Обновить статус рассылки
```php
$list = $ab->list()->updateListStatus(1, "READY");
```

### Обновить изображение у рассылки
```php
$list = $ab->list()->updateImage(1, "image");
```

### Загрузить номера в рассылку
```php
$list = $ab->list()->uploadPhones(1, "79188680973")
```

## Возвращаемый объект

Все методы API возвращают объект `APIResponse`, который содержит в себе HTTP-код ответа, bool-флаг пройденной операции и описание ошибки
