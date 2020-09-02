# 🛡 PhpInsights Badger Server
[Lumen Service](https://github.com/Lukasss93/phpinsights-badger-server) for hosting [PhpInsights](https://github.com/nunomaduro/phpinsights) badges sended by this [GitHub Action](https://github.com/Lukasss93/phpinsights-badger-action). 

## Requirements
- PHP >= 7.3
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Sqlite PHP Extensions

## Installation
1. Clone this project in your server.
2. Set the document root domain to `project-root/public` folder.
3. Install vendor packages with `php composer.phar install`.
4. Create the .env file with `php composer.phar run post-root-package-install`.
5. Change your `APP_URL` and `SERVICE_PASSWORD` in your .env file according to your preferences.

## Usage
Check the [GitHub Action](https://github.com/Lukasss93/phpinsights-badger-action) for the usage in your projects!
