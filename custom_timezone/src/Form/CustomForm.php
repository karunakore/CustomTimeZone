<?php

namespace Drupal\custom_timezone\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Custom Class.
 *
 * @category Class
 * @package Custom
 * @license xyz
 * @link demo
 */
class CustomForm extends ConfigFormBase {

  /**
   * Calling the config method .
   */
  protected function getEditableConfigNames() {
    return [
      'custom_timezone.adminsettings',
    ];
  }

  /**
   * Get Form Id.
   */
  public function getFormId() {
    return 'custom_form';
  }

  /**
   * Build Form method  .
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('custom_timezone.adminsettings');

    $form['custom_timezone_label'] = [
      '#type' => 'label',
      '#title' => $this->t('Admin Cofiguration Form'),
      '#description' => $this->t('=================================='),
      '#default_value' => $config->get('custom_timezone_label'),
    ];

    $form['custom_timezone_country'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Country'),
      '#description' => $this->t('Enter the Country.'),
      '#default_value' => $config->get('custom_timezone_country'),
    ];

    $form['custom_timezone_city'] = [
      '#type' => 'textfield',
      '#title' => $this->t('City'),
      '#description' => $this->t('Enter the City.'),
      '#default_value' => $config->get('custom_timezone_city'),
    ];

    $form['custom_timezone_list'] = [
      '#title' => $this->t('Timezone'),
      '#type' => 'select',
      '#description' => $this->t('Select Timezone.'),
      '#options' => [
        '0' => $this->t('--- Select Timezone ---'),
        'America/Chicago'   => $this->t('America/Chicago'),
        'America/New_York'  => $this->t('America/New_York'),
        'Asia/Tokyo'        => $this->t('Asia/Tokyo'),
        'Asia/Dubai'        => $this->t('Asia/Dubai'),
        'Asia/Kolkata'      => $this->t('Asia/Kolkata'),
        'Europe/Amsterdam'  => $this->t('Europe/Amsterdam'),
        'Europe/Oslo'       => $this->t('Europe/Oslo'),
        'Europe/London'     => $this->t('Europe/London'),
      ],
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * Validate Form method  .
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if (strlen($form_state->getValue('custom_timezone_city')) < 1) {
      $form_state->setErrorByName('custom_timezone_city', $this->t('Please enter city'));
    }
    if (strlen($form_state->getValue('custom_timezone_country')) < 1) {
      $form_state->setErrorByName('custom_timezone_country', $this->t('Please enter country'));
    }
    if ($form_state->getValue('custom_timezone_list') == '0') {
      $form_state->setErrorByName('custom_timezone_list', $this->t('Please select the timezone'));
    }
  }

  /**
   * Submit Form method.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $data = [
      'City' => $form_state->getValue('custom_timezone_city'),
      'Country' => $form_state->getValue('custom_timezone_country'),
      'TimeZone' => $form_state->getValue('custom_timezone_list'),
    ];

    // Call service in form.
    $timezoneResult = \Drupal::service('custom_timezone.display_timezone')->displayTimeZone($data);
    // Passing only the timezone as this is required as per requirement.
    foreach ($timezoneResult as $value) {
      \Drupal::messenger()->addMessage($value);
    }
  }

}
