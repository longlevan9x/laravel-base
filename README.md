## How to install

### Using composer
    $ git clone https://github.com/longlevan9x/laravel-base.git <name project>
    
Then run following command to install vendor

    $ composer install
or run:
 
    $ composer update 

Continue run following command `using gitbash`:

    $ cp .env.example .env

And config database connection:
    
    DB_DATABASE=your_database
    DB_USERNAME=your_username
    DB_PASSWORD=your_password

Generate key:

    $ php artisan key:generate     
## How to create repository
Add repository:
    
    $ git remote add <name repository> <url>
    
Push: 
    
    $ git push <repository name> branch(master)
    
After add repository. You can pull code base from repository `origin` and `push code to repository added`. 
## Install plugin && Library
##### Plugin require
kartik-v bootstrap file-input:
> - File added to resource/views/admin/partials/script.blade.php  
> - File added to resource/views/admin/partials/style.blade.php  

    $ php composer.phar require kartik-v/bootstrap-fileinput "@dev"
    
or add:

    "kartik-v/bootstrap-fileinput": "@dev"
    And run: $ composer update 
     
##### Plugin other
    $ composer require fabpot/goutte
    $ composer require guzzlehttp/guzzle
    $ composer require symfony/browser-kit
    $ composer require symfony/dom-crawler
    
### Library