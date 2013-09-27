<?php
namespace GanttChart;

use GanttChart\GanttChart;

class GanttChartTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Load array data
     */
    private function loadArrayData()
    {
        return include __DIR__ . '/../array_data.php';
    }

    /**
     * Load array data legend
     */
    private function loadArrayDataLegend()
    {
        return include __DIR__ . '/../array_legend_data.php';
    }

    /**
     * Load output html
     */
    private function loadHtmlOutput()
    {
        return file_get_contents( __DIR__ . '/../output.html' );
    }

    /**
     * Test setData
     */
    public function testSetData()
    {
        $instance = new GanttChart( 'pt_BR' );

        $if = $instance->setData( $this->loadArrayData() );

        $this->assertInstanceOf('GanttChart\GanttChart', $if);
    }

    /**
     * Test setDataLegend
     */
    public function testSetDataLegend()
    {
        $instance = new GanttChart( 'pt_BR' );

        $if = $instance->setDataLegend( $this->loadArrayDataLegend() );

        $this->assertInstanceOf('GanttChart\GanttChart', $if);
    }

    /**
     * Test setDayFirst
     */
    public function testSetDayFirst()
    {
        $instance = new GanttChart();

        $if = $instance->setData( $this->loadArrayData() )
                       ->setDayFirst( 20 );

        $this->assertInstanceOf('GanttChart\GanttChart', $if);
    }

    /**
     * Test setDayFirst
     */
    public function testSetDayFirstInvalidDayValue()
    {
        $this->setExpectedException('Exception');

        $instance = new GanttChart();

        $if = $instance->setData( $this->loadArrayData() )
                       ->setDayFirst( "value invalid" );

        $this->assertInstanceOf('\Exception', $if);

    }

    /**
     * Test setDayFirst
     */
    public function testSetDayFirstInvalidArrayDataNotLoaded()
    {
        $this->setExpectedException('Exception');

        $instance = new GanttChart();

        $if = $instance->setDayFirst( 10 );

        $this->assertInstanceOf('\Exception', $if);
    }

    /**
     * Test setCellWidth
     */
    public function testSetCellWidth()
    {
        $instance = new GanttChart();

        $if = $instance->setCellWidth(30);

        $this->assertInstanceOf('GanttChart\GanttChart', $if);
    }

    /**
     * Test setCellWidth
     */
    public function testSetCellWidthInvalid()
    {
        $this->setExpectedException('Exception');

        $instance = new GanttChart();

        $if = $instance->setCellWidth( 'invalid_value' );

        $this->assertInstanceOf('\Exception', $if);
    }

    /**
     * Test setCellHeight
     */
    public function testSetCellHeight()
    {
        $instance = new GanttChart();

        $if = $instance->setCellHeight(30);

        $this->assertInstanceOf('GanttChart\GanttChart', $if);
    }

    /**
     * Test setCellHeight
     */
    public function testSetCellHeightInvalid()
    {
        $this->setExpectedException('Exception');

        $instance = new GanttChart();

        $if = $instance->setCellHeight( 'invalid_value' );

        $this->assertInstanceOf('\Exception', $if);
    }

    /**
     * Test Render
     */
    public function testRender()
    {
        $instance = new GanttChart();
        $instance->setData( $this->loadArrayData() )
                 ->setDataLegend( $this->loadArrayDataLegend() );

        $if = $instance->render( false );

        $this->assertEquals($this->loadHtmlOutput(), $if);

        $this->expectOutputString( $this->loadHtmlOutput() );
        $instance->render( true );
    }

    /**
     * Test Render
     */
    public function testRenderException()
    {
        $instance = new GanttChart();

        $this->setExpectedException('Exception');
        $instance->render( true );
    }

    /**
     * Test setConflictLabel
     */
    public function testSetConflictLabel()
    {
        $instance = new GanttChart();

        $if = $instance->setData( $this->loadArrayData() )
                       ->setConflictLabel('Conflict label value');

        $this->assertInstanceOf('GanttChart\GanttChart', $if);
    }

    /**
     * Test setConflictLabel
     */
    public function testSetConflictLabelInvalid()
    {
        $this->setExpectedException('Exception');

        $instance = new GanttChart();

        $if = $instance->setData( $this->loadArrayData() )
                       ->setConflictLabel( array() );

        $this->assertInstanceOf('\Exception', $if);
    }

    /**
     * Test setToday
     */
    public function testSetToday()
    {
        $instance = new GanttChart();

        $if = $instance->setData( $this->loadArrayData() )
                       ->setToday( false );

        $this->assertInstanceOf('GanttChart\GanttChart', $if);
    }

    /**
     * Test setToday
     */
    public function testSetTodayInvalidValue()
    {
        $this->setExpectedException('Exception');

        $instance = new GanttChart();

        $if = $instance->setData( $this->loadArrayData() )
                       ->setToday( "value invalid" );

        $this->assertInstanceOf('\Exception', $if);

    }

    /**
     * Test setConflictColor
     */
    public function testSetConflictColor()
    {
        $instance = new GanttChart();

        $if = $instance->setConflictColor( '#000000' );

        $this->assertInstanceOf('GanttChart\GanttChart', $if);
    }

    /**
     * Test setConflictColor
     */
    public function testSetConflictColorInvalidValue()
    {
        $this->setExpectedException('Exception');

        $instance = new GanttChart();

       $if = $instance->setConflictColor( '000000' );

        $this->assertInstanceOf('\Exception', $if);

    }

    /**
     * Test setConflictDescriptionLegend
     */
    public function testSetConflictDescriptionLegend()
    {
        $instance = new GanttChart();

        $if = $instance->setConflictDescriptionLegend( 'Legend Conflict' );

        $this->assertInstanceOf('GanttChart\GanttChart', $if);
    }

    /**
     * Test setConflictDescriptionLegend
     */
    public function testSetConflictDescriptionLegendInvalidValue()
    {
        $this->setExpectedException('Exception');

        $instance = new GanttChart();

       $if = $instance->setConflictDescriptionLegend( 1212 );

        $this->assertInstanceOf('\Exception', $if);

    }

    /**
     * Call protected/private method of a class.
     *
     * @param object &$object    Instantiated object that we will run method on.
     * @param string $methodName Method name to call
     * @param array  $parameters Array of parameters to pass into method.
     *
     * @return mixed Method return.
     */
    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}