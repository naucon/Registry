<?php
/*
 * Copyright 2008 Sven Sanzenbacher
 *
 * This file is part of the naucon package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Naucon\Registry;

/**
 * RegistryInterface
 *
 * @package     Naucon\Registry
 * @author      Sven Sanzenbacher
 */
interface RegistryInterface extends \Countable
{
    /**
     * register entry to registry
     *
     * @param   string      $identifier     identifier to given entry
     * @param   mixed       $entry          entry to be registred
     * @return  self
     */
    public function register($identifier, $entry);

    /**
     * unregister entry from registry
     *
     * @param   string      $identifier     identifier of a registred entry
     * @return  self
     */
    public function unregister($identifier);

    /**
     * return registred entry
     *
     * @param   string      $identifier     identifier of a registred entry
     * @return  mixed|null      returns entry or null if missing
     */
    public function get($identifier);

    /**
     * return if identifier is registred
     *
     * @param   string      $identifier     identifier of a registred entry
     * @return  bool        true if identifier is registred, else false
     */
    public function has($identifier);

    /**
     * return all registred entries
     *
     * @return  array       all registred entries
     */
    public function all();

    /**
     * return how many entries are registred
     *
     * @return  int       how many entries are registred
     */
    public function count();
}