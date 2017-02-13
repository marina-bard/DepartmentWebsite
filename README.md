## Department Website

To run the applicaton:  
1. Clone this repository.  
2. Execute in project folder:
```
    $ composer install
    $ bin/console doctrine:database:create
    $ bin/console doctrine:schema:update --force
    $ bin/console doctrine:fixtures:load
    $ bin/console assets:install web --symlink
``` 
3. Start the server:
```
    $ bin/console server:start 
```
You can go deep with [Symfony Documentation](http://symfony.com/doc/3.1/index.html)

*Created on April 12, 2016, 3:05 pm.*  
