<h1>Запуск проекта</h1>

<ul>
    <li>git clone https://github.com/mbacon-hub/test-task.git</li>
    <li>cd test-task/</li>
    <li>docker-compose up -d</li>
    <li>docker exec -it app_php composer install</li>
    <li>docker exec -it app_php cp .env.example .env</li>
    <li>docker exec -it app_php php artisan key:generate</li>
    <li>docker exec -it app_php php artisan migrate --seed</li>
    <li>docker exec -it app_php php artisan passport:install</li>
    <li>docker exec -it app_php php artisan queue:work</li>
</ul>

<h2>Пользователи</h2>
<ul>
    <li>Email: admin@test.com Password: password</li>
    <li>Email: test@test.com  Password: password</li>
</ul>
