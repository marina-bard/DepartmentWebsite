## Department Website

There are several steps to run the applicaton:  
1. Clone this repository.  
2. Execute in project folder:

```
    > composer install
    > bin/console doctrine:database:create
    > bin/console doctrine:schema:update --force
    > bin/console doctrine:fixtures:load
    > bin/console assets:install web --symlink
```
3. Start the server:

```
    > bin/console server:start 
```

A Symfony project created on April 12, 2016, 3:05 pm.  
