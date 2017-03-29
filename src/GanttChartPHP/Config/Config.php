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
 * Class Config
 *
 * @category    Gantt Chart PHP
 * @package     GanttChartPHP\Config
 * @subpackage  Config
 * @author      Thiago H Oliveira <thiago@tholiveira.com.br>
 */
class Config
{
    /**
     * Interval 1 day in seconds
     * @const int
     */
    const DAY_INTERVAL = 86400;

    /**
     * Default Cell Height
     * @const int
     */
    const DEFAULT_CELL_HEIGHT = 25;

    /**
     * Default Cell Width
     * @const int
     */
    const DEFAULT_CELL_WIDTH = 25;

    /**
     * Default Render Days Before
     * @const int
     */
    const DEFAULT_RENDER_DAYS_BEFORE = 1;

    /**
     * Default Render Days After
     * @const int
     */
    const DEFAULT_RENDER_DAYS_AFTER = 1;

    /**
     * Cell Width
     * @var int
     */
    protected $cellWidth;

    /**
     * Cell Height
     * @var int
     */
    protected $cellHeight;

    /**
     * Show Marker Today
     * @var bool
     */
    protected $showMarkerToday;

    /**
     * Render Days Before
     * @var integer
     */
    protected $renderDaysBefore;

    /**
     * Render Days After
     * @var integer
     */
    protected $renderDaysAfter;

    /**
     * Config constructor.
     */
    public function __construct()
    {
        $this->cellHeight       = self::DEFAULT_CELL_HEIGHT;
        $this->cellWidth        = self::DEFAULT_CELL_WIDTH;
        $this->renderDaysAfter  = self::DEFAULT_RENDER_DAYS_AFTER;
        $this->renderDaysBefore = self::DEFAULT_RENDER_DAYS_BEFORE;
        $this->showMarkerToday  = true;
    }

    /**
     * Get Cell Width
     *
     * @return int
     */
    public function getCellWidth(): int
    {
        return $this->cellWidth;
    }

    /**
     * Set Cell Width
     *
     * @param int $cellWidth
     *
     * @return Config
     */
    public function setCellWidth(int $cellWidth):Config
    {
        $this->cellWidth = $cellWidth;

        return $this;
    }

    /**
     * Get Cell Height
     *
     * @return int
     */
    public function getCellHeight(): int
    {
        return $this->cellHeight;
    }

    /**
     * Set Cell Height
     *
     * @param int $cellHeight
     *
     * @return Config
     */
    public function setCellHeight(int $cellHeight):Config
    {
        $this->cellHeight = $cellHeight;

        return $this;
    }

    /**
     * Is show marker today?
     *
     * @return bool
     */
    public function isShowMarkerToday():bool
    {
        return $this->showMarkerToday;
    }

    /**
     * Set Show Marker Today
     *
     * @param bool $showMarkerToday
     *
     * @return Config
     */
    public function setShowMarkerToday(bool $showMarkerToday):Config
    {
        $this->showMarkerToday = $showMarkerToday;

        return $this;
    }

    /**
     * Get Render Days Before
     *
     * @return int
     */
    public function getRenderDaysBefore(): int
    {
        return $this->renderDaysBefore;
    }

    /**
     * Set Render Days Before
     *
     * @param int $renderDaysBefore
     *
     * @return Config
     */
    public function setRenderDaysBefore(int $renderDaysBefore):Config
    {
        $this->renderDaysBefore = $renderDaysBefore;

        return $this;
    }

    /**
     * Get Render Days After
     *
     * @return int
     */
    public function getRenderDaysAfter(): int
    {
        return $this->renderDaysAfter;
    }

    /**
     * Set Render Days After
     *
     * @param int $renderDaysAfter
     *
     * @return Config
     */
    public function setRenderDaysAfter(int $renderDaysAfter):Config
    {
        $this->renderDaysAfter = $renderDaysAfter;

        return $this;
    }

    /**
     * Get Day Interval
     *
     * @return int
     */
    public function getDayInterval():int
    {
        return self::DAY_INTERVAL;
    }
}
