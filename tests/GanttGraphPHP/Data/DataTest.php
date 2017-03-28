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
 * Test: class Data
 *
 * @category    Gantt Chart PHP
 * @package     GanttChartPHP\Data
 * @subpackage  DataTest
 * @author      Thiago H Oliveira <thiago@tholiveira.com.br>
 */
class DataTest
    extends \PHPUnit_Framework_TestCase
{
    /**
     * Object of AbstractEntity
     * @var \GanttChartPHP\Data\Data
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
        $this->object = new Data();
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

        self::assertInstanceOf('GanttChartPHP\Data\Activity', $result);
    }

    /**
     * Test: Get Instance (Type Activity)
     */
    public function testGetInstanceTypeActivity()
    {
        $reflection = new \ReflectionObject($this->object);

        $methodGetInstance = $reflection->getMethod('getInstance');
        $methodGetInstance->setAccessible(true);

        $result = $methodGetInstance->invoke($this->object, 'activity');

        self::assertInstanceOf('GanttChartPHP\Data\Activity', $result);
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
            'activity',
        ], $result);
    }
}
