<html>
    <head>
        <title>Gantt Graph</title>
    </head>
    <body>
<?php
require '../autoloader.php';

use GanttGraph\GanttGraph;

$array_data = include './array_data.php';

$gantt_graph = new GanttGraph( 'pt_BR' );

$gantt_graph->setData( $array_data )
            ->render();
?>
    </body>
</html>