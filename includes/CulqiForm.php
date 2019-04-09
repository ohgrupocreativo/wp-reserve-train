<?php
defined("ABSPATH") or die("");

class CulqiForm
{
  static $culqiForm = null;

  private function __construct()
  {
    add_action('init', array($this, 'culqiShortcode'));
  }

  static function getSelfObject() 
  {
    if (self::$culqiForm === null) {
      self::$culqiForm = new CulqiForm();
      return self::$culqiForm;
    } else {
      self::$culqiForm;
    }
  }

  function culqiShortCode()
  {
    add_shortcode('culqi-form', array($this, 'culqiFormRender'));
  }

  function culqiFormRender($attr = [])
  {
    include __DIR__ . '/../templates/culqiForm.php';
  }

}

