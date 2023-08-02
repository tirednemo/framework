1. Install PHP 8.1 or higher.
2. Install Composer, which is used to install PHP packages.
3. Install Symfony CLI. This creates a binary called symfony that provides all the tools you need to develop and run your Symfony application locally.
```
Set-ExecutionPolicy RemoteSigned -Scope CurrentUser
irm get.scoop.sh | iex
scoop install symfony-cli
```  
4. Clone this repository
```
git clone https://github.com/tirednemo/framework.git
```
5. Make Composer install the dependencies into the vendor/
```
cd framework/
composer install
```
6. Run the app and navigate to http://127.0.0.1:8000/is_leap_year/{year}
```
 symfony server:start
 ```
7. Unit testing
```
./vendor/bin/phpunit
``` 
