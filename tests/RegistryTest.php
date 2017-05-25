<?php
/**
 * Copyright 2008 Sven Sanzenbacher
 *
 * This file is part of the naucon package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Naucon\Registry\Tests;

use Naucon\Registry\Registry;
use Naucon\Registry\RegistryInterface;
use Naucon\Registry\Exception\InvalidArgumentException;

class RegistryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider registerProvider
     * @param   array   $registerEntries
     * @param   array   $expectedEntries
     */
    public function testRegister($registerEntries, $expectedEntries)
    {
        $registry = new Registry();
        foreach ($registerEntries as $registerEntry) {
            $identifier = $registerEntry['identifier'];
            $entry = $registerEntry['entry'];

            $registry->register($identifier, $entry);
        }

        $entries = $registry->all();

        $this->assertEquals($expectedEntries, $entries);
    }

    public function testRegisterWithClassNameRestriction()
    {
        $expectedEntries = [
            'plugin' => new Registry(),
            'filter' => new Registry()
        ];

        $registry = new Registry(RegistryInterface::class);
        foreach ($expectedEntries as $identifier => $entry) {
            $registry->register($identifier, $entry);
        }

        $entries = $registry->all();

        $this->assertEquals($expectedEntries, $entries);
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage register requires a object, "string" was given.
     */
    public function testRegisterNonObjectWithClassNameRestriction()
    {
        $expectedEntries = [
            'plugins' => 'foo',
            'filters' => 'bar'
        ];

        $registry = new Registry(RegistryInterface::class);
        foreach ($expectedEntries as $identifier => $entry) {
            $registry->register($identifier, $entry);
        }
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage register rquires a object that implements "Naucon\Registry\RegistryInterface", "stdClass" was given.
     */
    public function testRegisterWrongObjectWithClassNameRestriction()
    {
        $expectedEntries = [
            'plugins' => new \stdClass(),
            'filters' => new \stdClass()
        ];

        $registry = new Registry(RegistryInterface::class);
        foreach ($expectedEntries as $identifier => $entry) {
            $registry->register($identifier, $entry);
        }
    }

    /**
     * @dataProvider registerProvider
     * @param   array   $registerEntries
     * @param   array   $expectedEntries
     */
    public function testHas($registerEntries, $expectedEntries)
    {
        $registry = new Registry();
        foreach ($registerEntries as $registerEntry) {
            $identifier = $registerEntry['identifier'];
            $entry = $registerEntry['entry'];

            $registry->register($identifier, $entry);
        }

        $this->assertFalse($registry->has('missingId'));

        foreach ($expectedEntries as $identifier => $entry) {
            $this->assertTrue($registry->has($identifier));
        }
    }

    /**
     * @dataProvider registerProvider
     * @param   array   $registerEntries
     * @param   array   $expectedEntries
     */
    public function testGet($registerEntries, $expectedEntries)
    {
        $registry = new Registry();
        foreach ($registerEntries as $registerEntry) {
            $identifier = $registerEntry['identifier'];
            $entry = $registerEntry['entry'];

            $registry->register($identifier, $entry);
        }

        $this->assertNull($registry->get('missingId'));

        foreach ($expectedEntries as $identifier => $entry) {
            $this->assertEquals($entry, $registry->get($identifier));
        }
    }

    /**
     * @dataProvider registerProvider
     * @param   array   $registerEntries
     * @param   array   $expectedEntries
     */
    public function testCount($registerEntries, $expectedEntries)
    {
        $registry = new Registry();
        foreach ($registerEntries as $registerEntry) {
            $identifier = $registerEntry['identifier'];
            $entry = $registerEntry['entry'];

            $registry->register($identifier, $entry);
        }

        $this->assertInstanceOf(\Countable::class, $registry);
        $this->assertCount(count($expectedEntries), $registry);

        $this->assertEquals(count($expectedEntries), $registry->count());
    }

    /**
     * @dataProvider unregisterProvider
     * @param   array   $registerEntries
     * @param   array   $unregisterEntries
     * @param   array   $expectedEntries
     */
    public function testUnregister($registerEntries, $unregisterEntries, $expectedEntries)
    {
        $registry = new Registry();
        foreach ($registerEntries as $registerEntry) {
            $identifier = $registerEntry['identifier'];
            $entry = $registerEntry['entry'];

            $registry->register($identifier, $entry);
        }

        foreach ($unregisterEntries as $identifier) {
            $registry->unregister($identifier);
        }

        $entries = $registry->all();

        $this->assertEquals($expectedEntries, $entries);
    }

    /**
     * @return array
     */
    public function registerProvider()
    {
        return array(
            array(
                array(
                    array(
                        'identifier' => 'id1',
                        'entry' => 'foo'
                    ),
                    array(
                        'identifier' => 'id2',
                        'entry' => 'bar'
                    ),
                    array(
                        'identifier' => 'id3',
                        'entry' => 'foobar'
                    )
                ),
                array(
                    'id1' => 'foo',
                    'id2' => 'bar',
                    'id3' => 'foobar'
                )
            )
        );
    }

    /**
     * @return array
     */
    public function unregisterProvider()
    {
        return array(
            array(
                array(
                    array(
                        'identifier' => 'id1',
                        'entry' => 'foo'
                    ),
                    array(
                        'identifier' => 'id2',
                        'entry' => 'bar'
                    ),
                    array(
                        'identifier' => 'id3',
                        'entry' => 'foobar'
                    )
                ),
                array(
                    'id2',
                ),
                array(
                    'id1' => 'foo',
                    'id3' => 'foobar'
                )
            )
        );
    }

}
