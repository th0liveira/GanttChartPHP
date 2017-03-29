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
namespace GanttChartPHP\Helper;

/**
 * Class Color
 *
 * @category    Gantt Chart PHP
 * @package     GanttChartPHP\Helper
 * @subpackage  Color
 * @author      Thiago H Oliveira <thiago@tholiveira.com.br>
 */
class Color
{
    /**
     * Color Default
     * @const string
     */
    const DEFAULT_COLOR = '#C9C9C9';

    /**
     * Color Format
     * @const string
     */
    const COLOR_FORMAT = '#{HEX}';

    /**
     * Used colors
     * @var array
     */
    protected static $usedColor = [];

    /**
     * Color constructor.
     */
    public function __construct()
    {
        self::$usedColor[self::DEFAULT_COLOR] = self::DEFAULT_COLOR;
    }

    /**
     * Generate Color
     *
     * @return string
     */
    public function generateColor():string
    {
        do {
            $color = self::COLOR_FORMAT;
            $hex = strtoupper(str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT));
            $color = str_replace('{HEX}', $hex, $color);
            self::$usedColor[$color] = $color;
        } while (array_search($color, self::$usedColor) === false);

        return $color;
    }
}
