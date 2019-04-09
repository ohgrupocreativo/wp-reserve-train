<?php
defined("ABSPATH") or die("");

class FormReserve
{
  static $formReserve = null;
  private $urlAction = 'http://localhost:8085/';

  private function __construct()
  {
    add_action('wp', array($this, 'formShortcode'));
    add_action('wp', array($this, 'formShortcodeSidebar'));

    $this->setUrlAction();
  }

  static function getSelfObject() 
  {
    if (self::$formReserve === null) {
      self::$formReserve = new FormReserve();
      return self::$formReserve;
    } else {
      self::$formReserve;
    }
  }

  private function setUrlAction()
  {
    $this->urlAction = get_site_url() .'/'. get_option('data_form_page');
  }

  function getMinimunDay()
  {
    $dias = get_option('day_for_reserve');
    $dayForReserve = new \DateTime();
    $dayForReserve->add(new \DateInterval('P'.$dias.'D'));

    return $dayForReserve->format('Y-m-d');
  }

  function formShortCode()
  {
    add_shortcode('form-reserve', array($this, 'formRender'));
  }

  function formRender($attr = [])
  {
    include __DIR__ . '/../templates/formReserve.php';   
  }

  function formShortCodeSidebar()
  {
    add_shortcode('form-reserve-sidebar', array($this, 'formRenderSidebar'));
  }

  function formRenderSidebar($attr = [])
  {
    include __DIR__ . '/../templates/formReserveSidebar.php';
  }
}

