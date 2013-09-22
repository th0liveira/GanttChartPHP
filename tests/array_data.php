<?php
return array(
        array (
                'label' => 'Nome Sala',
                'series' => array (
                        array (
                                'label' => 'Periodo 1',
                                'allocations' => array (
                                        array (
                                                'label' => 'Label 1',
                                                'start' => '2013-09-15',
                                                'end' => '2013-09-29',
                                                'description' => 'Description x',
                                                'color' => '#00ff00',
                                        ),
                                        array (
                                                'label' => 'Label 2',
                                                'start' => '2013-09-04',
                                                'end' => '2013-09-06',
                                                'description' => 'Description y',
                                                'color' => '#0000ff',
                                        ),
                                        array (
                                                'label' => 'Label 3 (Example Conflict)',
                                                'start' => '2013-09-17',
                                                'end' => '2013-09-24',
                                                'description' => 'Description z',
                                                'color' => null, # color default
                                        ),
                                ),
                        ),
                ),
        ),
);