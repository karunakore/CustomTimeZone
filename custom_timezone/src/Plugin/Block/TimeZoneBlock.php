<?php

namespace Drupal\custom_timezone\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'TimeZoneBlock' block.
 *
 * @Block( * id = "custom_timezone_block".
 * admin_label = @Translation("Custom TimeZone block").
 * category = @Translation("Custom example block").
 */
class TimeZoneBlock extends BlockBase {

  /**
   * Class build.
   */
  public function build() {
    $form = \Drupal::formBuilder()->getForm('Drupal\custom_timezone\Form\CustomForm');
    return $form;
  }

}
