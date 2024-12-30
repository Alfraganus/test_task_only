# Инструкция по установке и настройке

**Требования:**
- PHP 8.1.9
- MariaDB 10.7.5

1. Выполните команду для получения последних изменений из репозитория:
    ```bash
    git pull
    ```

2. Установите зависимости с помощью Composer:
    ```bash
   composer install --ignore-platform-reqs
    ```

3. Настройте подключение к базе данных в файле `.env`:
    - Укажите параметры подключения к вашей базе данных.

4. Выполните миграции для создания таблиц в базе данных:
    ```bash
    php artisan migrate
    ```

5. Запустите сидеры для наполнения базы данных данными:
    ```bash
    php artisan db:seed
    ```

### Список endpoint
1) Документация для API доступна по следующему пути:

- **URL**: `{{url}}/api/auth/login`  
  **Метод**: POST  
  **Body параметры**:
    - `username` (string): Имя пользователя или email.
    - `password` (string): Пароль пользователя.

### Пример запроса:

```bash
curl -X POST {{url}}/api/available-cars \
     -d "start_date=2024-12-31" \
     -d "end_date=2024-01-10" \
     -d "car_model_id=5" \
     -d "comfort_category_id=2"
```
### Список пользователей
| User Email          | Password |
|---------------------|----------|
| user1@gmail.com     | 1234     |
| user2@gmail.com     | 1234     |
| user3@gmail.com     | 1234     |
| user4@gmail.com     | 1234     |
| user5@gmail.com     | 1234     |
| user6@gmail.com     | 1234     |
| user7@gmail.com     | 1234     |
| user8@gmail.com     | 1234     |
| user9@gmail.com     | 1234     |
| user10@gmail.com    | 1234     |

### Используйте этот endpoint для получения Bearer-токена.

2) - **URL**: `{{url}}/api/available-cars`  
     **Метод**: POST  
     **Body параметры**:
- `start_date` (string): Дата начала аренды в формате `YYYY-mm-dd`.
- `end_date` (string): Дата окончания аренды в формате `YYYY-mm-dd`.
- `car_model_id` (integer): Идентификатор модели автомобиля.
- `comfort_category_id` (integer): Идентификатор категории комфорта.


### Доступ для администратора
Для доступа к админке используйте следующие данные:
- **URL**: `{{url}}/admin`
- **Логин**: `admin@gmail.com`
- **Пароль**: `1234`
