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
namespace GanttChartPHP\Config;

/**
 * Test: class Config
 *
 * @category    Gantt Chart PHP
 * @package     GanttChartPHP\Config
 * @subpackage  ConfigTest
 * @author      Thiago H Oliveira <thiago@tholiveira.com.br>
 */
class ConfigTest
    extends \PHPUnit_Framework_TestCase
{
    /**
     * Object of AbstractEntity
     * @var \GanttChartPHP\Config\Config
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
        $this->object = new Config();
    }

    /**
     * Test: Get Cell Width
     */
    public function testGetCellWidth()
    {
        $result = $this->object->getCellWidth();

        self::assertEquals(Config::DEFAULT_CELL_WIDTH, $result);
    }

    /**
     * Test: Set Cell Width
     */
    public function testSetCellWidth()
    {
        $result = $this->object->setCellWidth(30);

        self::assertInstanceOf('GanttChartPHP\Config\Config', $result);
        self::assertEquals(30, $this->object->getCellWidth());
    }

    /**
     * Test: Get Cell Height
     */
    public function testGetCellHeight()
    {
        $result = $this->object->getCellHeight();

        self::assertEquals(Config::DEFAULT_CELL_HEIGHT, $result);
    }

    /**
     * Test: Set Cell Height
     */
    public function testSetCellHeight()
    {
        $result = $this->object->setCellHeight(30);

        self::assertInstanceOf('GanttChartPHP\Config\Config', $result);
        self::assertEquals(30, $this->object->getCellHeight());
    }

    /**
     * Test: Is show marker today?
     */
    public function testIsShowMarkerToday()
    {
        $result = $this->object->isShowMarkerToday();

        self::assertTrue($result);
    }

    /**
     * Test: Set Show Marker Today
     */
    public function testSetShowMarkerToday()
    {
        $result = $this->object->setShowMarkerToday(false);

        self::assertInstanceOf('GanttChartPHP\Config\Config', $result);
        self::assertFalse($this->object->isShowMarkerToday());
    }

    /**
     * Test: Get Render Days Before
     */
    public function testGetRenderDaysBefore()
    {
        $result = $this->object->getRenderDaysBefore();

        self::assertEquals(Config::DEFAULT_RENDER_DAYS_BEFORE, $result);
    }

    /**
     * Test; Set Render Days Before
     */
    public function testSetRenderDaysBefore()
    {
        $result = $this->object->setRenderDaysBefore(5);

        self::assertInstanceOf('GanttChartPHP\Config\Config', $result);
        self::assertEquals(5, $this->object->getRenderDaysBefore());
    }

    /**
     * Test: Get Render Days After
     */
    public function testGetRenderDaysAfter()
    {
        $result = $this->object->getRenderDaysAfter();

        self::assertEquals(Config::DEFAULT_RENDER_DAYS_AFTER, $result);
    }

    /**
     * Test; Set Render Days After
     */
    public function testSetRenderDaysAfter()
    {
        $result = $this->object->setRenderDaysAfter(5);

        self::assertInstanceOf('GanttChartPHP\Config\Config', $result);
        self::assertEquals(5, $this->object->getRenderDaysAfter());
    }

    /**
     * Test: Get Day Interval
     */
    public function testGetDayInterval()
    {
        $result = $this->object->getDayInterval();

        self::assertEquals(Config::DAY_INTERVAL, $result);
    }
}
