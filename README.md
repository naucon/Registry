naucon Registry Package
=======================
version 1.0

About
-----

This package provides a generic registry class to register any type of data under an identifier (key/value).
The registry can also be restricted to take only objects of a specific class or interface.
All registred entries can be returned. A specific entry can be returned or removed by its identifier.

### Features

* key/value storage
* restricting to a specified interface
* fluent interface for register(), unregister()


### Compatibility

* PHP5.3


Installation
------------

install the latest version via composer

    composer require naucon/registry


Usage
-----

create registry instance

    use Naucon\Registry\Registry;
    $registry = new Registry();

restrict a registry instance to a specified interface or class

    use Naucon\Registry\Registry;
    $registry = new Registry('Naucon\Foo\AdapterInterface');

add entry to registry

    $registry->register('service_foo', 'foo');
    $registry->register('service_bar', 'bar');

get entry from registry

    var_dump($registry->get('service_foo')); // foo
    var_dump($registry->get('service_missing')); // null

check if an entry is registred in registry

    var_dump($registry->has('service_foo')); // true
    var_dump($registry->has('service_missing')); // false


get all entries from registry

    var_dump($registry->all()); // foo, bar

remove entry to registry

    $registry->unregister('service_foo');
    $registry->has('service_foo'); // false



Example
-------

Start the build-in webserver to see the examples in action:

    cd examples
    php -S 127.0.0.1:3000

open url in browser

    http://127.0.0.1:3000/index.html


## License

The MIT License (MIT)

Copyright (c) 2015 Sven Sanzenbacher

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.