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
 * Test: class AbstractData
 *
 * @category    Gantt Chart PHP
 * @package     GanttChartPHP\Data
 * @subpackage  AbstractDataTest
 * @author      Thiago H Oliveira <thiago@tholiveira.com.br>
 */
class AbstractDataTest
    extends \PHPUnit_Framework_TestCase
{
    /**
     * Object of AbstractEntity
     * @var \GanttChartPHP\Data\AbstractData
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
        $this->object = $this->getMockForAbstractClass('GanttChartPHP\Data\AbstractData',
            [],
            '',
            true,
            true,
            true,
            [
                'getInstance',
                'getAvailableProperties',
            ]);
    }

    /**
     * Test: Get Data
     */
    public function testGetData()
    {
        $result = $this->object->getData();

        self::assertInstanceOf('stdClass', $result);
    }

    /**
     * Test: Set Data
     */
    public function testSetData()
    {
        $data = $this->getMockForAbstractClass('GanttChartPHP\Data\AbstractData',
            [],
            '',
            true,
            true,
            true,
            [
                'getInstance',
                'getAvailableProperties',
            ]);

        $result = $this->object->setData($data);

        self::assertInstanceOf('GanttChartPHP\Data\AbstractData', $result);
    }

    /**
     * Test: To Array (without data)
     */
    public function testToArrayWithoutData()
    {
        $result = $this->object->toArray();

        self::assertEquals([], $result);
    }

    /**
     * Test: To Array (with one level data)
     */
    public function testToArrayWithOneLevelData()
    {
        $dataObject = new \stdClass();
        $dataObject->test = 'Value test';

        $reflection = new \ReflectionObject($this->object);
        $propertyData = $reflection->getProperty('data');
        $propertyData->setAccessible(true);
        $propertyData->setValue($this->object, $dataObject);

        $result = $this->object->toArray();

        self::assertEquals([
            'test' => 'Value test'
        ], $result);
    }

    /**
     * Test: To Array (with AbstractData)
     */
    public function testToArrayWithAbstractData()
    {
        $value = $this->getMockForAbstractClass('GanttChartPHP\Data\AbstractData',
            [],
            '',
            true,
            true,
            true,
            [
                'getInstance',
                'getAvailableProperties',
            ]);

        $data = new \stdClass();
        $data->testing = 'Value test';

        $reflection = new \ReflectionObject($value);
        $propertyData = $reflection->getProperty('data');
        $propertyData->setAccessible(true);
        $propertyData->setValue($value, $data);

        $arrayData = new \stdClass();
        $arrayData->test = $value;

        $reflection = new \ReflectionObject($this->object);
        $propertyData = $reflection->getProperty('data');
        $propertyData->setAccessible(true);
        $propertyData->setValue($this->object, $arrayData);

        $result = $this->object->toArray();

        self::assertEquals([
            'test' => [
                'testing' => 'Value test',
            ]
        ], $result);
    }

    /**
     * Test: To Array (with array data)
     */
    public function testToArrayWithArrayData()
    {
        $value = $this->getMockForAbstractClass('GanttChartPHP\Data\AbstractData',
            [],
            '',
            true,
            true,
            true,
            [
                'getInstance',
                'getAvailableProperties',
            ]);

        $data = new \stdClass();
        $data->testing = 'Value test';

        $reflection = new \ReflectionObject($value);
        $propertyData = $reflection->getProperty('data');
        $propertyData->setAccessible(true);
        $propertyData->setValue($value, $data);

        $arrayData = new \stdClass();
        $arrayData->test = [
            $value,
            $value,
        ];

        $reflection = new \ReflectionObject($this->object);
        $propertyData = $reflection->getProperty('data');
        $propertyData->setAccessible(true);
        $propertyData->setValue($this->object, $arrayData);

        $result = $this->object->toArray();

        self::assertEquals([
            'test' => [
                0   => [
                    'testing' => 'Value test',
                ],
                1   => [
                    'testing' => 'Value test',
                ],
            ]
        ], $result);
    }

    /**
     * Test: To Array (with one level data and AvailableProperties)
     */
    public function testToArrayWithOneLevelDataAndAvailableProperties()
    {
        $value = $this->getMockForAbstractClass('GanttChartPHP\Data\AbstractData',
            [],
            '',
            true,
            true,
            true,
            [
                'getInstance',
                'getAvailableProperties',
            ]);

        $data = new \stdClass();
        $data->testing = 'Value test';

        $reflection = new \ReflectionObject($value);
        $propertyData = $reflection->getProperty('data');
        $propertyData->setAccessible(true);
        $propertyData->setValue($value, $data);

        $propertyAvailableProperty = $reflection->getProperty('availableProperty');
        $propertyAvailableProperty->setAccessible(true);
        $propertyAvailableProperty->setValue($value, ['test']);

        $arrayData = new \stdClass();
        $arrayData->test = $value;

        $reflection = new \ReflectionObject($this->object);
        $propertyData = $reflection->getProperty('data');
        $propertyData->setAccessible(true);
        $propertyData->setValue($this->object, $arrayData);

        $result = $this->object->toArray();

        self::assertEquals([
            'test' => [
                'testing' => 'Value test',
            ],
        ], $result);
    }

    /**
     * Test: Call (invalid property)
     */
    public function testCallInvalidProperty()
    {
        $result = $this->object->getInvalidProperty();

        self::assertNull($result);
    }

    /**
     * Test: Call (invalid method prefix)
     */
    public function testCallnvalidMethodPrefix()
    {
        $reflection = new \ReflectionObject($this->object);

        $propertyAvailableProperty = $reflection->getProperty('availableProperty');
        $propertyAvailableProperty->setAccessible(true);
        $propertyAvailableProperty->setValue($this->object, ['test']);

        $result = $this->object->unsTest();

        self::assertNull($result);
    }

    /**
     * Test: Call (method prefix get, with value)
     */
    public function testCallMethodPrefixGetWithValue()
    {
        $reflection = new \ReflectionObject($this->object);

        $propertyAvailableProperty = $reflection->getProperty('availableProperty');
        $propertyAvailableProperty->setAccessible(true);
        $propertyAvailableProperty->setValue($this->object, ['test']);

        $data = new \stdClass();
        $data->test = 'Value';

        $propertyData = $reflection->getProperty('data');
        $propertyData->setAccessible(true);
        $propertyData->setValue($this->object, $data);

        $result = $this->object->getTest();

        self::assertEquals('Value', $result);
    }

    /**
     * Test: Call (method prefix get, without value)
     */
    public function testCallMethodPrefixGetWithoutValue()
    {
        $reflection = new \ReflectionObject($this->object);

        $propertyAvailableProperty = $reflection->getProperty('availableProperty');
        $propertyAvailableProperty->setAccessible(true);
        $propertyAvailableProperty->setValue($this->object, ['test']);

        $result = $this->object->getTest();

        self::assertNull($result);
    }

    /**
     * Test: Call (method prefix Set, without param)
     */
    public function testCallMethodPrefixSetWithoutParam()
    {
        $reflection = new \ReflectionObject($this->object);

        $propertyAvailableProperty = $reflection->getProperty('availableProperty');
        $propertyAvailableProperty->setAccessible(true);
        $propertyAvailableProperty->setValue($this->object, ['test']);

        $result = $this->object->setTest();

        self::assertInstanceOf('GanttChartPHP\Data\AbstractData', $result);
    }

    /**
     * Test: Call (method prefix Set, with param)
     */
    public function testCallMethodPrefixSetWithParam()
    {
        $reflection = new \ReflectionObject($this->object);

        $propertyAvailableProperty = $reflection->getProperty('availableProperty');
        $propertyAvailableProperty->setAccessible(true);
        $propertyAvailableProperty->setValue($this->object, ['test']);

        $result = $this->object->setTest('Value');

        self::assertInstanceOf('GanttChartPHP\Data\AbstractData', $result);
    }

    /**
     * Test: Call (method prefix Add)
     */
    public function testCallMethodPrefixAdd()
    {
        $reflection = new \ReflectionObject($this->object);

        $propertyAvailableProperty = $reflection->getProperty('availableProperty');
        $propertyAvailableProperty->setAccessible(true);
        $propertyAvailableProperty->setValue($this->object, ['test']);

        $result = $this->object->addTest();

        self::assertnull($result);
    }

    /**
     * Test: Set (new value)
     */
    public function testSetNewValue()
    {
        $reflection = new \ReflectionObject($this->object);

        $propertyAvailableProperty = $reflection->getProperty('availableProperty');
        $propertyAvailableProperty->setAccessible(true);
        $propertyAvailableProperty->setValue($this->object, ['test']);

        $this->object->test = 'Value';

        self::assertEquals('Value', $this->object->test);
    }

    /**
     * Test: Set (new value and transform in array)
     */
    public function testSetNewValueAndTransformInArray()
    {
        $reflection = new \ReflectionObject($this->object);

        $propertyAvailableProperty = $reflection->getProperty('availableProperty');
        $propertyAvailableProperty->setAccessible(true);
        $propertyAvailableProperty->setValue($this->object, ['test']);

        $this->object->test = 'Value';
        $this->object->test = 'New Value';

        self::assertEquals([
            'Value',
            'New Value'
        ], $this->object->test);
    }

    /**
     * Test: Set (new value in exists array)
     */
    public function testSetNewValueInExistsArray()
    {
        $reflection = new \ReflectionObject($this->object);

        $propertyAvailableProperty = $reflection->getProperty('availableProperty');
        $propertyAvailableProperty->setAccessible(true);
        $propertyAvailableProperty->setValue($this->object, ['test']);

        $data = new \stdClass();
        $data->test = [
            'Value one',
            'Value two',
        ];

        $propertyData = $reflection->getProperty('data');
        $propertyData->setAccessible(true);
        $propertyData->setValue($this->object, $data);

        $this->object->test = 'New Value';

        self::assertEquals([
            'Value one',
            'Value two',
            'New Value'
        ], $this->object->test);
    }
}
