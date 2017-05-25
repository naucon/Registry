<?php
/**
 * Copyright 2008 Sven Sanzenbacher
 *
 * This file is part of the naucon package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
require realpath(__DIR__ . '/../') . '/vendor/autoload.php';

use Naucon\Registry\Registry;

$registry = new Registry();
$registry->register('service_foo', 'foo');
$registry->register('service_bar', 'bar');

var_dump($registry->has('service_foo')); // true
var_dump($registry->has('service_missing')); // false

var_dump($registry->get('service_foo')); // foo
var_dump($registry->get('service_missing')); // null

var_dump($registry->all()); // array ['service_foo' => 'foo', 'service_bar' => 'bar']

$registry->unregister('service_foo');

$registry->has('service_foo'); // false