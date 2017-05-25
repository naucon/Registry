<?php
/**
 * Copyright 2008 Sven Sanzenbacher
 *
 * This file is part of the naucon package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Naucon\Registry;

/**
 * Class RegistryAwareTrait
 *
 * @package     Naucon\Registry
 * @author      Sven Sanzenbacher
 */
trait RegistryAwareTrait
{
    /**
     * @var     RegistryInterface
     */
    protected $registry;

    /**
     * @param   RegistryInterface      $registry
     */
    public function setRegistry(RegistryInterface $registry)
    {
        $this->registry = $registry;
    }
}