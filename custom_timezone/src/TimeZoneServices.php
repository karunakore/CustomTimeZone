<?php

namespace Drupal\custom_timezone;

use Drupal\Core\Datetime\DrupalDateTime;

/**
 * Service for timezone.
 */
class TimeZoneServices {

  /**
   * Function that display the timezone in particular format.
   */
  public function displayTimeZone($data = '') {
    $city     = $data['City'];
    $country  = $data['Country'];
    $timezone = $data['TimeZone'];
    $time     = new DrupalDateTime();
    $time->setTimezone(new \DateTimeZone($timezone));

    $zoneTime = $time->format("h:i a");
    $zoneDate = $time->format("l, jS F Y");
    // $zoneFormat = $time->format('e');
    // Since the city code is not found displaying the default time zone.
    $time_format = 'Time in ' . $city . ', ' . date_default_timezone_get() . ', ' . $country;
    $time_data   = [
      'time' => $zoneTime,
      'date' => $zoneDate,
      'city_coutry' => $time_format,
    ];
    return $time_data;
  }

}
