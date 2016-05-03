LaGet
=====

A NuGet server written using the Laravel PHP Framework.

Features
========
 - Basic searching and listing of packages
 - Pushing via NuGet command line (NuGet.exe)
 - Web interface to browse packages
 - Stores data in SQLite, MySQL or PostgreSQL database
 - Multi-user support

Requirements
============
 - PHP 5.5.9+

Setup
=====

1 - Copy LaGet to your server, you could do a Git clone on the server:
```bash
cd /var/www
git clone https://github.com/cosmomill/LaGet.git
# Make storage and cache directories writable
cd LaGet
chown -R www-data:www-data storage bootstrap/cache
chmod -R 0770 storage bootstrap/cache
```

2 - Install the dependencies using Composer:
```bash
curl -sS https://getcomposer.org/installer | php
php composer.phar install
```

3 - Edit `config/database.php` and change the database credentials according to your installation.

4 - Generating the application key:
```bash
php artisan key:generate
```
Edit `config/app.php` and change `SomeRandomString` on line 81 to the generated string.

5 - Create the database:
```bash
php artisan migrate:install
php artisan migrate:refresh
```

6 - Create a user:
```bash
php artisan user:create "John Doe" "doe@example.com" "secret"
```

7 - Set the API key and test it out. I test using nuget.exe (which is required for pushing):
```bash
nuget.exe setApiKey -Source http://example.com/api/v2/ ChangeThisKey
nuget.exe push Foo.nupkg -Source http://example.com/api/v2/
```

8 - Edit `config/laget.php` to change the sites name, shortname, description and links.

Optional Steps
==============

To use LaGet as [Chocolatey package gallery](https://github.com/chocolatey/choco/wiki/How-To-Host-Feed) edit `config/laget.php` and set `chocolatey_feed` to `true`.

To enable the comment system install [HashOver 2.0](https://github.com/jacobwb/hashover-next) in `public/hashover`. Edit `config/laget.php` and set `enable_hashover` to `true`. Please follow the installation instructions [here](http://tildehash.com/?page=hashover). Edit `public/hashover/scripts/settings.php` and change `$this->httpRoot = $http_directory;` to `$this->httpRoot = "/" . $http_directory;`.

Examples
========
[SampSharp](http://sampsharp.timpotze.nl/) repository at at http://nuget.timpotze.nl/.

Licence
=======
This is free and unencumbered software released into the public domain.
Anyone is free to copy, modify, publish, use, compile, sell, or
distribute this software, either in source code form or as a compiled
binary, for any purpose, commercial or non-commercial, and by any
means.
In jurisdictions that recognize copyright laws, the author or authors
of this software dedicate any and all copyright interest in the
software to the public domain. We make this dedication for the benefit
of the public at large and to the detriment of our heirs and
successors. We intend this dedication to be an overt act of
relinquishment in perpetuity of all present and future rights to this
software under copyright law.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
IN NO EVENT SHALL THE AUTHORS BE LIABLE FOR ANY CLAIM, DAMAGES OR
OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE,
ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
OTHER DEALINGS IN THE SOFTWARE.

For more information, please refer to <http://unlicense.org>
