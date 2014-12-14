ficbook site parser
===================
Parse content of site

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist phpjim/parse-ficbook "*"
```

or add

```
"phpjim/parse-ficbook": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \phpjim\parsers\ficbook\AutoloadExample::widget(); ?>```