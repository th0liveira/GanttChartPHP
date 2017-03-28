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
 * Class Task
 *
 * @category    Gantt Chart PHP
 * @package     GanttChartPHP\Data
 * @subpackage  Task
 * @author      Thiago H Oliveira <thiago@tholiveira.com.br>
 *
 * Methods:
 * @method  string      getLabel()                      Get Task Label
 * @method  Task        setLabel(string $value)         Set Task Label
 * @method  string      getCode()                       Get Task Code
 * @method  Task        setCode(string $value)          Set Task Code
 * @method  string      getDescription()                Get Task Description
 * @method  Task        setDescription(string $value)   Set Task Description
 * @method  Bar         addBar()                        Add new Bar into Task
 * @method  Bar         getBar()                        Get Bar(s)
 * @method  Task        setBar(Bar $value)              Set Bar into Task
 */
class Task
    extends AbstractData
{
    /**
     * Element Label
     * @const string
     */
    const ELEMENT_LABEL = 'label';

    /**
     * Element Code
     * @const string
     */
    const ELEMENT_CODE = 'code';

    /**
     * Element Description
     * @const string
     */
    const ELEMENT_DESCRIPTION = 'description';

    /**
     * Element Bar
     * @const string
     */
    const ELEMENT_BAR = 'bar';

    /**
     * Get Instance
     *
     * @param string $type
     *
     * @return null|AbstractData
     */
    protected function getInstance(string $type)
    {
        $return = null;

        if ($type === self::ELEMENT_BAR) {
            $return = new Bar();
        }

        return $return;
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
            self::ELEMENT_CODE,
            self::ELEMENT_DESCRIPTION,
            self::ELEMENT_BAR,
        ];
    }
}
