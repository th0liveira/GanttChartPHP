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
 * Class AbstractData
 *
 * @category    Gantt Chart PHP
 * @package     GanttChartPHP\Data
 * @subpackage  AbstractData
 * @author      Thiago H Oliveira <thiago@tholiveira.com.br>
 */
abstract class AbstractData
{
    /**
     * Method Add
     * @const string
     */
    const METHOD_ADD = 'add';

    /**
     * Method Set
     * @const string
     */
    const METHOD_SET = 'set';

    /**
     * Method Get
     * @const string
     */
    const METHOD_GET = 'get';

    /**
     * Data
     * @var \stdClass
     */
    protected $data;

    /**
     * Available Property
     * @var array
     */
    protected $availableProperty;

    /**
     * AbstractData constructor.
     */
    public function __construct()
    {
        $this->data = new \stdClass();
        $this->availableProperty = $this->getAvailableProperties();
    }

    /**
     * Get Data
     *
     * @return \stdClass
     */
    public function getData(): \stdClass
    {
        return $this->data;
    }

    /**
     * Set Data
     *
     * @param
     *
     * @return AbstractData
     */
    public function setData(AbstractData $value): AbstractData
    {
        $this->data = $value;
        return $this;
    }

    /**
     * To array
     *
     * @param mixed $data
     *
     * @return array
     */
    public function toArray($data = null): array
    {
        if (is_null($data) === true) {
            $data = $this->getData();
        }

        $return = [];

        foreach ($data as $key => $value) {
            if (is_array($value) === true) {
                $return[$key] = $this->toArray($value);
                continue;
            }

            if ($value instanceof AbstractData) {
                $return[$key] = $value->toArray($value->getData());
                continue;
            }

            $return[$key] = $value;
        }

        return $return;
    }

    /**
     * Call
     *
     * @param string $calledMethod
     * @param array $args
     *
     * @return mixed
     */
    public function __call(string $calledMethod, array $args)
    {
        $prefix = strtolower(substr($calledMethod, 0, 3));
        $property = strtolower(substr($calledMethod, 3));

        if (in_array($property, $this->availableProperty) === false) {
            return null;
        }

        switch ($prefix) {
            case self::METHOD_ADD:
                $newInstance = $this->getInstance($property);
                $this->{$property} = $newInstance;
                return $newInstance;

            case self::METHOD_SET:
                $value = null;
                if (isset($args[0])) {
                    $value = $args[0];
                }
                $this->{$property} = $value;
                return $this;

            case self::METHOD_GET:
                return $this->{$property};
        }

        return null;
    }

    /**
     * Add Value into Data
     *
     * @param string $property
     * @param mixed $value
     *
     * @return void
     */
    public function __set(string $property, $value)
    {
        if (in_array($property, $this->availableProperty) === false) {
            return;
        }

        if (isset($this->{$property}) === false) {
            $this->data->{$property} = $value;
            return;
        }

        if (isset($this->{$property}) === true && empty($this->data->{$property}) === true) {
            $this->data->{$property} = $value;
            return;
        }

        $existValue = $this->{$property};

        if (is_array($existValue) === true) {
            $existValue[]       = $value;
            $this->data->{$property}  = $existValue;
            return;
        }

        $newArray   = [];
        $newArray[] = $existValue;
        $newArray[] = $value;
        $this->data->{$property} = $newArray;
    }

    /**
     * Isset Value into Data
     *
     * @param string $property
     *
     * @return bool
     */
    public function __isset(string $property):bool
    {
        return isset($this->data->{$property});
    }

    /**
     * Get Value into Data
     *
     * @param string $property
     *
     * @return mixed
     */
    public function __get(string $property)
    {
        if (isset($this->{$property})) {
            return $this->data->{$property};
        }

        return null;
    }

    /**
     * Get Instance
     *
     * @param string $type
     *
     * @return null|AbstractData
     */
    abstract protected function getInstance(string $type);

    /**
     * Get Available Properties
     *
     * @return array
     */
    abstract protected function getAvailableProperties(): array;
}
