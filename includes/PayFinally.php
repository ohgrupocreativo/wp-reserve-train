<?php
defined("ABSPATH") or die("");

class PayFinally
{
  static $payFinally = null;

  private function __construct()
  {
    add_action('wp', array($this, 'payFinallyShortcode'));
  }

  static function getSelfObject() 
  {
    if (self::$payFinally === null) {
      self::$payFinally = new payFinally();
      return self::$payFinally;
    } else {
      self::$payFinally;
    }
  }

  function payFinallyShortCode()
  {
    add_shortcode('pay-finally', array($this, 'payFinallyRender'));
  }

  function payFinallyRender($attr = [])
  {
    include __DIR__ . '/../templates/payFinally.php';
  }

  function getData()
  {
    $data = str_replace('\\', '', $_POST['all-reserve-data']);
    $data = json_decode($data);

    return $data;
  }

}