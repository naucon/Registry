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
use Naucon\Registry\RegistryInterface;

$registry = new Registry(RegistryInterface::class);
$registry->register('plugins', new Registry());
$registry->register('filters', new Registry());
//$registry->register('filters', new stdClass()); // throws InvalidArgumentException

var_dump($registry->has('plugins')); // true
var_dump($registry->has('missing')); // false

var_dump($registry->get('filters')); // object
var_dump($registry->get('missing')); // null

var_dump($registry->all());  // array ['plugins' => object, 'filters' => object]

$registry->unregister('plugins');

$registry->has('plugins'); // false