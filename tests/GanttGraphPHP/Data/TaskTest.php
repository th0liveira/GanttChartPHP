<?php
/**
 * Gantt Chart PHP
 *
 * LICENSE: The MIT License (MIT)
 *
 * Copyright (C) 2017 - Thiago H Oliveira / TH0liveira
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this
 * software and associated documentation files (the "Software"), to deal in the Software
 * without restriction, including without limitation the rights to use, copy, modify,
 * merge, publish, distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to the following
 * conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies
 * or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED,
 * INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A
 * PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
namespace GanttChartPHP\Data;

/**
 * Test: class Task
 *
 * @category    Gantt Chart PHP
 * @package     GanttChartPHP\Data
 * @subpackage  TaskTest
 * @author      Thiago H Oliveira <thiago@tholiveira.com.br>
 */
class TaskTest
    extends \PHPUnit_Framework_TestCase
{
    /**
     * Object of AbstractEntity
     * @var \GanttChartPHP\Data\Task
     */
    protected $object;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->object = new Task();
    }

    /**
     * Test: Get Instance (invalid Type)
     */
    public function testGetInstanceInvalidType()
    {
        $reflection = new \ReflectionObject($this->object);

        $methodGetInstance = $reflection->getMethod('getInstance');
        $methodGetInstance->setAccessible(true);

        $result = $methodGetInstance->invoke($this->object, 'invalidType');

        self::assertNull($result);
    }

    /**
     * Test: Get Instance (Type Label)
     */
    public function testGetInstanceTypeLabel()
    {
        $reflection = new \ReflectionObject($this->object);

        $methodGetInstance = $reflection->getMethod('getInstance');
        $methodGetInstance->setAccessible(true);

        $result = $methodGetInstance->invoke($this->object, 'label');

        self::assertNull($result);
    }

    /**
     * Test: Get Instance (Type Code)
     */
    public function testGetInstanceTypeCode()
    {
        $reflection = new \ReflectionObject($this->object);

        $methodGetInstance = $reflection->getMethod('getInstance');
        $methodGetInstance->setAccessible(true);

        $result = $methodGetInstance->invoke($this->object, 'code');

        self::assertNull($result);
    }

    /**
     * Test: Get Instance (Type Description)
     */
    public function testGetInstanceTypeDescription()
    {
        $reflection = new \ReflectionObject($this->object);

        $methodGetInstance = $reflection->getMethod('getInstance');
        $methodGetInstance->setAccessible(true);

        $result = $methodGetInstance->invoke($this->object, 'description');

        self::assertNull($result);
    }

    /**
     * Test: Get Instance (Type Bar)
     */
    public function testGetInstanceTypeBar()
    {
        $reflection = new \ReflectionObject($this->object);

        $methodGetInstance = $reflection->getMethod('getInstance');
        $methodGetInstance->setAccessible(true);

        $result = $methodGetInstance->invoke($this->object, 'bar');

        self::assertInstanceOf('GanttChartPHP\Data\Bar', $result);
    }

    /**
     * Test: Get Available Properties
     */
    public function testGetAvailableProperties()
    {
        $reflection = new \ReflectionObject($this->object);

        $methodGetAvailableProperties = $reflection->getMethod('getAvailableProperties');
        $methodGetAvailableProperties->setAccessible(true);

        $result = $methodGetAvailableProperties->invoke($this->object);

        self::assertEquals([
            'label',
            'code',
            'description',
            'bar',
        ], $result);
    }
}
