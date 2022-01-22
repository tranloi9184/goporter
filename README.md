# goporter
1, Steps for build app:
* cp .env.example .env => and set all the .env variable as mentioned above. Once the variables have been set, generate the application key
* composer install => install packages in composer.json file
* php artisan key:generate
* php artisan storage:link
* php artisan vendor:publish -> Press 0 and then press enter to publish all assets and configurations.
You should create a symbolic link of storage directory with the public using the below command so images will be publicly accessible
Now the database will be seeded with default data using seed classes.

* php artisan migrate
* php artisan db:seed or `php artisan migrate --seed`
* php artisan serve

2. Login account:
- Supper Admin: admin@fastlaravel.dev/123@12
- Guest: guest@fastlaravel.dev/123@123
- Leader: leader@fastlaravel.dev/123@123