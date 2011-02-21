<?php
class InfoHelper extends AppHelper {
    function getLocation($city, $state, $country) {
        $location = null;
        if ($city) $location .= $city;
        if ($state) {
            if ($location) $location .= ' - ';
            $location .= $state;
        }
        if ($country) {
            if ($location) $location .= ', ';
            $location .= $country;
        }
        return $location;
    }
}
