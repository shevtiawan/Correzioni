<?php
class GoogleMapHelper extends AppHelper {
    public $helpers = array('Html');

    function simple($container, $lat, $lng) {
        $View = ClassRegistry::getObject('View');
        echo $View->Html->script(
            array(
                'http://maps.google.com/maps/api/js?sensor=false',
                'gmap'
            ),
            array('inline' => false)
        );
        echo "<script type='text/javascript'>initialize('{$container}', {$lat}, {$lng});</script>";
    }
}
