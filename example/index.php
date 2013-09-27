<html>
    <head>
        <title>Gantt Chart</title>
    </head>
    <body>
<?php
require '../autoloader.php';

use GanttChart\GanttChart;

$array_data = include '../tests/array_data.php';

$array_legend_data = include '../tests/array_legend_data.php';

$gantt_graph = new GanttChart( 'pt_BR' );

$gantt_graph->setData( $array_data )
            ->setDataLegend($array_legend_data)
            ->render();
?>
    </body>
</html>