## REQUIREMENTS
 - PHP  >= 7.4
 - LARAVEL 8
 - MSQL DB

## STEPS

The word document test resides in the root folder of the application

- git clone https://github.com/TeraFumba/Everlytic.git your_project_name
- cd your_project_name
- composer install
- create .env file 
- php artisan db:seed --class=EmployeeSeeder
- php artisan test --filter EmployeesTest

