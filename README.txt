.htaccess     - Настройки конфигуратора Apache-сервера
autoload.php  - Автозагрузка классов, моделей, функций, переменных 
function.php  - Функции используемые во всем проекте 
route.php     - Роутинг, индексная страница (настроил в .htaccess)
variables.php - Переменные используемые во всем проекте

controllers/LoginController        - Обработчик запросов пользователя при входе 
controllers/RegistrationController - Обработчик запросов пользователя при регистрации 

models/DatabaseConfig - Модель осуществляет подключение к БД, возвращает объект подключения 
models/Users          - Модель работает с запросами к таблице Users (в БД)
models/UsersAdressIP  - Модель работает с запросами к таблице users_adress_ip (в БД)  

views/js/ajax.js       - Предотвращает перезагрузку страницы 
views/login.php        - Страница Входа
views/registration.php - Страница Регистрации
views/index.php        - Страница на которую зайдет пользователь после регистрации и входа
views/error404         - Страница для ошибки 404 ("Станица не найдена")