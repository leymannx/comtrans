<?php

namespace Drupal\comtrans\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure ComTrans.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'comtrans_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['comtrans.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $settings = $this->config('comtrans.settings');

    $form = [];

    // Install Code.
    $form['google'] = [
      '#type'  => 'details',
      '#title' => $this->t('Google'),
      '#open'  => TRUE,
    ];

    $form['google']['google_api_key'] = [
      '#type'          => 'textfield',
      '#title'         => $this->t('Google API Key'),
      '#description'   => $this->t('Please paste a valid Google API key here.'),
      '#default_value' => $settings->get('google_api_key'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $values = $form_state->getValues();

    $this->config('comtrans.settings')
      ->set('google_api_key', $values['google_api_key'])
      ->save();

    parent::submitForm($form, $form_state);
  }

}
