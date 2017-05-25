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

use Naucon\Utility\Map;
use Naucon\Registry\Exception\InvalidArgumentException;

/**
 * Class Registry
 *
 * @package     Naucon\Registry
 * @author      Sven Sanzenbacher
 */
class Registry implements RegistryInterface
{
    /**
     * @var string
     */
    protected $className;

    /**
     * @var Map
     */
    protected $registry;



    /**
     * Constructor
     *
     * @param   string      $className      optional - class name to restrict registration
     */
    public function __construct($className = null)
    {
        $this->registry = new Map();
        $this->className = $className;
    }


    /**
     * @inheritdoc
     */
    public function register($identifier, $entry)
    {
        if ($this->className !== null) {
            if (!is_object($entry)) {
                throw new InvalidArgumentException(
                    sprintf('register requires a object, "%s" was given.', gettype($entry))
                );
            }

            if (!$entry instanceof $this->className) {
                throw new InvalidArgumentException(
                    sprintf('register rquires a object that implements "%s", "%s" was given.', $this->className, get_class($entry))
                );
            }

        }

        $this->registry->set($identifier, $entry);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function unregister($identifier)
    {
        $this->registry->remove($identifier);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function get($identifier)
    {
        $element = $this->registry->get($identifier);
        return $element;
    }

    /**
     * @inheritdoc
     */
    public function has($identifier)
    {
        $result = $this->registry->hasKey($identifier);
        return $result;
    }

    /**
     * @inheritdoc
     */
    public function all()
    {
        $elements = $this->registry->getAll();
        return $elements;
    }

    /**
     * @inheritdoc
     */
    public function count()
    {
        return $this->registry->count();
    }
}