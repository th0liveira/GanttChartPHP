<?php
namespace GanttGraph;

/**
 * Class to generate GanttGraph
 *
 * @category   GanttGraph
 * @package
 * @author     Thiago H Oliveira <thiago.h.oliv@gmail.com>
 */

class GanttGraph
{
    /**
     * @var int
     */
    private $seconds;

    /**
     * @var int
     */
    private $cell_width;

    /**
     * @var int
     */
    private $cell_height;

    /**
     * @var boolean
     */
    private $today;

    /**
     * @var array
     */
    private $data;

    /**
     * @var array
     */
    private $data_legend;

    /**
     * @var int
     */
    private $date_first_ts;

    /**
     * @var int
     */
    private $date_last_ts;

    /**
     * @var array
     */
    private $block;

    /**
     * @var int
     */
    private $day_first;

    /**
     * @var array
     */
    private $calendar_label;

    /**
     * @var array
     */
    private $calendar_days;

    /**
     * @var int
     */
    private $total_days;

    /**
     * @var string
     */
    private $conflict_label;

    /**
     * @var boolean
     */
    private $conflict_detected;

    /**
     * @var string
     */
    private $conflict_color;

    /**
     * @var string
     */
    private $conflict_legend;

    /**
     * Construct
     *
     * @return void
     */
    public function __construct( $locale = 'en_US.utf8' )
    {
        $this->seconds      = 86400;
        $this->cell_height  = 25;
        $this->cell_width   = 25;
        $this->today        = true;
        $this->data         = array();
        $this->data_legend  = array();
        $this->day_first    = 1;
        $this->conflict_label    = 'Conflict';
        $this->conflict_detected = false;
        $this->conflict_color    = '#980000';
        $this->conflict_legend   = 'Conflict Detected';

        setlocale(LC_ALL, "{$locale}");
    }

    /**
     * Set Data
     *
     * @param $data Array
     *
     * @return GanttGraph
     */
    public function setData( Array $data )
    {
        $this->data = $data;

        $this->parse();

        return $this;
    }

    /**
     * Set Data Legend
     *
     * @param $data Array
     *
     * @return GanttGraph
     */
    public function setDataLegend( Array $data )
    {
        $this->data_legend = $data;

        return $this;
    }

    /**
     * Set Cell Height
     *
     * @param $height int
     *
     * @return GanttGraph
     */
    public function setCellHeight( $height )
    {
        if( is_int( $height ) ) {
            $this->cell_height = $height;
            return $this;
        } else {
            throw new \Exception('Error, value of cell height not is integer!');
        }
    }

    /**
     * Set Conflict Color
     *
     * @param $color string
     *
     * @return GanttGraph
     */
    public function setConflictColor( $color )
    {
        if( preg_match("/#([A-Fa-f0-9]{2}){3}/", $color) ) {
            $this->conflict_color = $color;
            return $this;
        } else {
            throw new \Exception('Error, value of conflict color not is valid!');
        }
    }

    /**
     * Set Conflict Description Legend
     *
     * @param $description string
     *
     * @return GanttGraph
     */
    public function setConflictDescriptionLegend( $description )
    {
        if( is_string( $description ) ) {
            $this->conflict_legend = $description;
            return $this;
        } else {
            throw new \Exception('Error, value is not valid!');
        }
    }

    /**
     * Set Today
     *
     * @param $show boolean
     *
     * @return GanttGraph
     */
    public function setToday( $show )
    {
        if( is_bool( $show ) ) {
            $this->today = $show;
            return $this;
        } else {
            throw new \Exception('Error, value of today not is boolean!');
        }
    }

    /**
     * Set Cell Width
     *
     * @param $width int
     *
     * @return GanttGraph
     */
    public function setCellWidth( $width )
    {
        if( is_int( $width ) ) {
            $this->cell_width = $width;
            return $this;
        } else {
            throw new \Exception('Error, value of cell width not is integer!');
        }
    }

    /**
     * Set First Day
     *
     * @param $day int
     *
     * @return GanttGraph
     */
    public function setDayFirst( $day )
    {
        if( is_int( $day ) ) {
            $this->day_first = $day;
            $this->generateLabels();
            return $this;
        } else {
            throw new \Exception('Error, value of day not is integer!');
        }
    }

    /**
     * Set label conflict
     *
     * @param $txt string
     *
     * @return GanttGraph
     */
    public function setConflictLabel( $txt )
    {
        if( is_string( $txt ) ) {
            $this->conflict_label = $txt;
            $this->generateLabels();
            return $this;
        } else {
            throw new \Exception('Error, value of conflict label not is string!');
        }
    }

    /**
     * Parse Array
     *
     * @return void
     */
     private function parse()
     {
        foreach($this->data as $series) {

            $tmp_data = array();
            $tmp_data['label']  = $series['label'];

            foreach( $series['series'] as $serie ) {
                $tmp_serie = array();
                $tmp_serie['label']      = $serie['label'];
                $tmp_serie['allocations']= array();

                foreach( $serie['allocations'] as $allocation ) {

                    $datetime_start = new \DateTime( implode('-', array_reverse(explode('/', $allocation['start']))) );
                    $datetime_end   = new \DateTime( implode('-', array_reverse(explode('/', $allocation['end']))) );

                    $event = array(
                                'label' => $allocation['label'],
                                'start' => $start = $datetime_start->getTimestamp(),
                                'end'   => $end   = $datetime_end->getTimestamp() + $this->seconds,
                                'description'   => $allocation['description'],
                                'color'         => $allocation['color'],
                                'conflict'      => false,
                                'conflict_with' => array(),
                    );

                    $tmp_serie['allocations'][] = $event;

                    if( !$this->date_last_ts  || $this->date_first_ts > $start ) {
                        $this->date_first_ts = $start;
                    }

                    if( !$this->date_last_ts  || $this->date_last_ts  < $end ) {
                        $this->date_last_ts  = $end;
                    }
                }

                $tmp_data['series'][] = $tmp_serie;
            }

            $this->blocks[] = $tmp_data;
        }

        $this->checkConflictEvents();

        $this->generateLabels();

        return $this;
    }

    /**
     * Check if exists conflict of events
     *
     * @return void
     */
    private function checkConflictEvents() {
        foreach( $this->blocks as &$series ) {
            foreach( $series['series'] as &$allocations ) {
                foreach( $allocations['allocations'] as $key => &$allocation ) {
                    foreach( $allocations['allocations'] as $check_key => &$check_allocation ) {
                        if( $key != $check_key ) {
                            if( ( $allocation['start'] >= $check_allocation['start'] && $allocation['start'] <= ($check_allocation['end'] - $this->seconds) )
                                  || ( ($allocation['end'] - $this->seconds) >= $check_allocation['start'] && ($allocation['end'] - $this->seconds)  <= ($check_allocation['end'] - $this->seconds) ) ) {

                                $allocation['conflict']        = true;
                                if( !in_array( $check_allocation['description'], $allocation['conflict_with'] ) ) {
                                    $allocation['conflict_with'][] = $check_allocation['description'];
                                }

                                $check_allocation['conflict']  = true;
                                if( !in_array( $allocation['description'], $check_allocation['conflict_with'] ) ) {
                                    $check_allocation['conflict_with'][]  = $allocation['description'];
                                }
                            }
                        }

                        if( $allocation['conflict'] || $check_allocation['conflict']
                            || $allocation['color'] == $this->conflict_color || $check_allocation['color'] == $this->conflict_color ) {
                            $this->conflict_detected = true;
                        }
                    }
                }
            }
        }
    }

    /**
     * Generate Labels
     *
     * @return void
     */
    private function generateLabels()
    {
        if( !$this->blocks ) {
            throw new \Exception('Error, array data not loaded.');
        }

        $date_first = new \DateTime( date('Y-m-d', $this->date_first_ts ) );
        $date_last  = new \DateTime( date('Y-m-d', $this->date_last_ts ) );

        $date_first = $date_first->sub( new \DateInterval('P1D') );
        $this->day_first = $date_first->format('d');

        $date_first->setDate($date_first->format('Y'), $date_first->format('m'), $this->day_first);

        $this->date_first_ts = $date_first->getTimestamp();

        $current = $date_first->getTimestamp();
        $last    = $date_last->getTimestamp();

        $date_time = new \DateTime();

        $this->calendar_label = array();
        $this->calendar_days  = array();
        $this->total_days     = 0;

        while( $current <= $last ) {
            $date_time->setTimestamp( $current );

            $month =  ucfirst(strftime('%B', $date_time->getTimestamp())).' / '.strftime('%Y', $date_time->getTimestamp());

            if( $index = $this->searchInArray( $month, $this->calendar_label ) ) {
                $label = &$this->calendar_label[ $index ];
            } else {
                $label = &$this->calendar_label[];
                $label = array();
                $label['month'] = $month;
                $label['days']  = array();
            }

            $last_mount_day = $date_time->setDate($date_time->format('Y'), $date_time->format('m'), $date_time->format('t') )
                                        ->getTimestamp();

            while( $current <= $last_mount_day ) {
                $date_time->setTimestamp( $current );

                if( $index = $this->searchInArray( $month, $label['days'] ) ) {
                    $days = &$label['days'][ $index ];
                } else {
                    $days = &$label['days'][];
                }

                $days = array( 'day'   => $date_time->format('d'),
                                          'week_day' => substr( strftime('%a', $date_time->getTimestamp()), 0, 1),
                                          'weekend'  => ( in_array(strftime('%w', $date_time->getTimestamp()), array(0, 6) ) ? true : false ),
                );

                $current += $this->seconds;

                $this->calendar_days[] = array( 'value' => $date_time->format('d/m/Y'),
                                                'weekend'  => ( in_array(strftime('%w', $date_time->getTimestamp()), array(0, 6) ) ? true : false ), );
                $this->total_days++;
            }

        }
    }

    /**
     * Search and get key in multimencional array
     *
     * @param mixed $needle
     * @param array $haystack
     *
     * @return mixed
     */
    private function searchInArray($needle,$haystack)
    {
        foreach( $haystack as $key => $value ) {
            $current_key = $key;
            if( $needle === $value OR ( is_array( $value ) && $this->searchInArray( $needle, $value ) !== false ) ) {
                return $current_key;
            }
        }
        return false;
    }

    /**
     * Render Gantt Graph
     *
     * @param $output boolean
     *
     * @return string
     */
    public function render( $output = true )
    {

        if( !count($this->blocks) ) {
            throw new \Exception('Error, array data not loaded.');
        }

        $html = array();

        // Load CSS
        $html[] = '<style  type="text/css">';

        $line_height = round( $this->cell_height * 0.80 );
        $width_mark  = round( $this->cell_width * 0.90 );

        $style  = file_get_contents( __DIR__ ."/../assets/style.css");
        $style  = str_replace( '{VALUE_BLOCK_LINE_HEIGHT}', $line_height, $style );
        $style  = str_replace( '{VALUE_HEIGHT}', $this->cell_height, $style );
        $style  = str_replace( '{VALUE_WIDTH}', $this->cell_width, $style );
        $style  = str_replace( '{VALUE_LINE_HEIGHT}', $this->cell_height, $style );
        $style  = str_replace( '{WIDTH_MARK_TIME}', $width_mark, $style );
        $style  = str_replace( '{COLOR_CONFLICT}', $this->conflict_color, $style );

        $html[] = $style;

        $html[] = '</style>';
        // End: Load CSS

        // start Gantt Graph
        $html[] = '<div class="ggraph">';

        // sidebar
        $html[] = '<div class="ggraph-sidebar">';
        $html[] = '<ul class="lbls-group" style="margin-top: ' . ( ( $this->cell_height * 3 ) + 1) . 'px">';
        foreach($this->blocks as $i => $block) {
            $html[] = '<li class="lbls" style="height: ' . ( count($block['series']) * ($this->cell_height + 1) ) . 'px">';
            $html[] = "<strong>{$block['label']}</strong>";
            $html[] = '</li>';

            $html[] = '<ul class="lbls">';
            foreach($block['series'] as $serie) {
                $html[] = "<li class=\"lbls-serie\" style=\"height: {$this->cell_height}px\">";
                $html[] = "<strong>{$serie['label']}</strong>";
                $html[] = '</li>';
            }
            $html[] = '</ul>';
            $html[] = '</li>';
        }
        $html[] = '</ul>';
        $html[] = '</div>';


        // start data section
        $html[] = '<div class="ggraph-sc">';

        // data header section
        $html[] = '<header>';

        // months headers
        $html[] = '<ul class="ggraph-sc-ms" style="width: ' . ( $this->total_days * $this->cell_width ) . 'px">';
        foreach($this->calendar_label as $month) {
            $html[] = '<li class="ggraph-sc-m" style="width: ' . ($this->cell_width * count($month['days']) ) . 'px">';
            $html[] = "<strong>{$month['month']}</strong>";
            $html[] = '</li>';
        }
        $html[] = '</ul>';

        // days headers
        $html[] = '<ul class="ggraph-sc-ds" style="width: ' . ( $this->total_days * $this->cell_width ) . 'px">';
        foreach($this->calendar_label as $month) {
            foreach($month['days'] as $day) {
                $style  = $day['weekend'] ? 'weekend' : 'today';
                $html[] = "<li class=\"ggraph-sc-d $style\">";
                $html[] = "<span>{$day['day']}</span>";
                $html[] = '</li>';
            }
        }
        $html[] = '</ul>';

        // days headers
        $html[] = '<ul class="ggraph-sc-ds" style="width: ' . ( $this->total_days * $this->cell_width ) . 'px">';
        foreach($this->calendar_label as $month) {
            foreach($month['days'] as $day) {
                $style  = $day['weekend'] ? 'weekend' : 'today';
                $html[] = "<li class=\"ggraph-sc-d $style\">";
                $html[] = "<span>{$day['week_day']}</span>";
                $html[] = '</li>';
            }
        }
        $html[] = '</ul>';

        // items
        $html[] = '<ul class="ggraph-sc-items" style="width: ' . ( $this->total_days * $this->cell_width ) . 'px">';
        foreach($this->blocks as $block) {
            foreach($block['series'] as $linha => $series) {
                $html[] = '<li class="ggraph-sc-item">';

                // days
                $html[] = '<ul class="ggraph-sc-ds">';
                foreach($this->calendar_days as $day) {
                    $style  = $day['weekend'] ? 'weekend' : 'today';
                    $html[] = "<li class=\"ggraph-sc-d $style\">";
                    $html[] = "<span>&nbsp;</span>";//$day['value'];
                    $html[] = '</li>';
                }
                $html[] = '</ul>';

                foreach( $series['allocations'] as $allocation ) {

                    // the block
                    $days   = ( ( $allocation['end'] - $allocation['start'] ) / $this->seconds );
                    $offset = ( ( $allocation['start'] - $this->date_first_ts ) / $this->seconds );

                    $width  = round( ( ( $days ? $days : 1 ) * $this->cell_width ) - 6 );
                    $height = round( $this->cell_height * 0.80 );

                    $top    = round( ( $linha * $this->cell_height ) );
                    $left   = round( ( $offset * $this->cell_width ) );

                    $conflict= ( $allocation['conflict'] ? ' conflict' : null );
                    $conflict_title  = "{$allocation['description']}\n";
                    $conflict_title .= ( $allocation['conflict'] ? "{$this->conflict_label}:\n".implode("\n", $allocation['conflict_with']) : null );

                    $color  =  ( $allocation['color'] && !$conflict ? "background: {$allocation['color']};" : '' );

                    $html[] = "<span title=\"{$conflict_title}\" class=\"ggraph-sc-blk {$conflict}\" style=\"{$color} left: {$left}px; width: {$width}px; height: {$height}px;\">";
                    $html[] = "<strong class=\"ggraph-sc-blk-lbl\">{$allocation['label']}</strong>";
                    $html[] = '</span>';

                }

                $html[] = '</li>';
            }
        }
        $html[] = '</ul>';

        if( $this->today ) {

            // today
            $today  = new \DateTime();
            $today->setTime(0, 0, 0);

            $date_first = new \DateTime( date('Y-m-d', $this->date_first_ts ) );
            $date_first->setDate($date_first->format('Y'), $date_first->format('m'), $this->day_first);

            $date_last  = new \DateTime( date('Y-m-d', $this->date_last_ts ) );

            $offset = ( ( $today->getTimestamp() - $date_first->getTimestamp() ) / $this->seconds );
            $left   = round( $offset * $this->cell_width ) - round( ( $this->cell_width )  ) + round( $width_mark );

            if( $today->getTimestamp() > $date_first->getTimestamp() && $today->getTimestamp() < $date_last->getTimestamp() ) {
                $html[] = "<div class=\"time\" style=\"top: {$this->cell_height}px; left: {$left}px\" datetime=\"{$today->format('Y-m-d')}\"></div>";
            }
        }

        // end header
        $html[] = '</header>';

        // end data section
        $html[] = '</div>';

        // end Gantt Graph
        $html[] = '</div>';

        if( count( $this->data_legend ) ) {
            $html[] = $this->renderLegend();
        }

        if( $output ) {
            echo implode("\n", $html);
        } else {
            return implode("\n", $html);
        }
    }

    /**
     * Render Legend
     *
     * @return string
     */
    private function renderLegend()
    {
        $html   = array();
        $html[] = '<br>';
        $html[] = '<div class="ggraph ggraph-legend">';
        $html[] = '  <div class="ggraph-lg-items">';

        if( $this->conflict_detected ) {

        }

        foreach( $this->data_legend as $item ) {
            $html[] = '<ul class="ggraph-lg-items">';
            $html[] = '  <li class="ggraph-lg-item color">';
            $html[] = "    <span class=\"ggraph-sc-blk\" style=\"background: {$item['color']}; width: 19px; height: 20px;\">&nbsp;</span>";
            $html[] = '  </li>';
            $html[] = '  <li class="ggraph-lg-item description">';
            $html[] = "    <span>{$item['description']}</span>";
            $html[] = '  </li>';
            $html[] = '</ul>';
        }

        if( $this->conflict_detected ) {
            $html[] = '<ul class="ggraph-lg-items">';
            $html[] = '  <li class="ggraph-lg-item color">';
            $html[] = "    <span class=\"ggraph-sc-blk\" style=\"background: {$this->conflict_color}; width: 19px; height: 20px;\">&nbsp;</span>";
            $html[] = '  </li>';
            $html[] = '  <li class="ggraph-lg-item description">';
            $html[] = "    <span>{$this->conflict_legend}</span>";
            $html[] = '  </li>';
            $html[] = '</ul>';
        }

        $html[] = '  </div>';
        $html[] = '</div>';

        return implode('', $html);

    }
}