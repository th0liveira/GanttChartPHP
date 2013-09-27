<html>
    <head>
        <title>Gantt Graph</title>
    </head>
    <body>
<?php
require '../autoloader.php';

use GanttGraph\GanttGraph;

$array_data = include '../tests/array_data.php';

$array_legend_data = include '../tests/array_legend_data.php';

$gantt_graph = new GanttGraph( 'pt_BR' );

$gantt_graph->setData( $array_data )
            ->setDataLegend($array_legend_data)
            ->render();
?>
    </body>
</html>