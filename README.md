# PHP Seeder
a movie seeder API Service that gets **now playing** and **top rated** movies from https://www.themoviedb.org

### Prerequests
  - php
  - mysql
  - composer
  
### Instalation
  - Clone the project
  - run `composer install`
  - add your database credintials to .env file
  - run `php artisan migrate`
  - run `php artisan module:seed Movie`
  - run `php artisan queue:listen`
  - start a cron job for the project `* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1`
  - run `php artisan serve` *in new terminal*

## Functions
  - seed **now playing** and **top rated** movies from the API every duration equal to ***interval_timer*** and gets movies for each category equal to **num_of_records** that can be changed from *Modules/Movie/Config/Config.php* file
  - display all movies at `localhost:8000/movie`
  - filter movies by category_id `ex: localhost:8000/movie?category_id=10749`
  - sort movies by *popularity* and *vote_count* `ex: localhost:8000/movie?popular|desc&rated|asc`
 
### Bonus features implemented
 - Used laravel Queue to handle the seeder task
 - Created the task as laravel module
 - added the project to github repo
 
