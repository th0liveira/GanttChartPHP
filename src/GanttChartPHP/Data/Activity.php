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
 * Class Activity
 *
 * @category    Gantt Chart PHP
 * @package     GanttChartPHP\Data
 * @subpackage  Activity
 * @author      Thiago H Oliveira <thiago@tholiveira.com.br>
 *
 * Methods:
 * @method  string      getLabel()                      Get Activity Label
 * @method  Activity    setLabel(string $value)         Set Activity Label
 * @method  Task        addTask()                       Add new Task into Activity
 * @method  Task        getTask()                       Get Task(s)
 * @method  Data        setTask(Task $value)            Set Task into Activity
 */
class Activity
    extends AbstractData
{
    /**
     * Element Label
     * @const string
     */
    const ELEMENT_LABEL = 'label';

    /**
     * Element Task
     * @const string
     */
    const ELEMENT_TASK = 'task';

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

        if ($type === self::ELEMENT_TASK) {
            $return = new Task();
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
            self::ELEMENT_TASK,
        ];
    }
}
