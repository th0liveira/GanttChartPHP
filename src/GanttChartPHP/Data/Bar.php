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

use GanttChartPHP\Render\Color;

/**
 * Class Bar
 *
 * @category    Gantt Chart PHP
 * @package     GanttChartPHP\Data
 * @subpackage  Bar
 * @author      Thiago H Oliveira <thiago@tholiveira.com.br>
 *
 * Methods:
 * @method  string      getLabel()                      Get Bar  Label
 * @method  Bar         setLabel(string $value)         Set Bar  Label
 * @method  string      getDescription()                Get Bar  Description
 * @method  Bar         setDescription(string $value)   Set Bar  Description
 */
class Bar 
    extends AbstractData
{
    /**
     * Element Label
     * @const string
     */
    const ELEMENT_LABEL = 'label';

    /**
     * Element Description
     * @const string
     */
    const ELEMENT_DESCRIPTION = 'description';

    /**
     * Element Start
     * @const string
     */
    const ELEMENT_START = 'start';

    /**
     * Element End
     * @const string
     */
    const ELEMENT_END = 'end';

    /**
     * Element Color
     * @const string
     */
    const ELEMENT_COLOR = 'color';

    /**
     * Bar constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setValue(self::ELEMENT_COLOR, Color::DEFAULT_COLOR);
    }

    /**
     * Get Instance
     *
     * @param string $type
     *
     * @return null|AbstractData
     */
    protected function getInstance(string $type)
    {
        return null;
    }

    /**
     * Get Available Properties
     *
     * @return array
     */
    protected function getAvailableProperties():array
    {
        return [
            self::ELEMENT_LABEL,
            self::ELEMENT_DESCRIPTION,
            self::ELEMENT_START,
            self::ELEMENT_END,
            self::ELEMENT_COLOR,
        ];
    }
}
