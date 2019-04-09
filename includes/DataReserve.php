<?php
defined("ABSPATH") or die("");

class DataReserve
{
  static $dataReserve = null;

  private function __construct()
  {
    add_action('wp', array($this, 'formDataShortcode'));
  }

  static function getSelfObject() 
  {
    if (self::$dataReserve === null) {
      self::$dataReserve = new DataReserve();
      return self::$dataReserve;
    } else {
      self::$dataReserve;
    }
  }

  function formDataShortcode()
  {
    add_shortcode('form-data-reserve', array($this, 'formDataRender'));
  }

  function formDataRender($attr = [])
  {
    include __DIR__ . '/../templates/formDataReserve.php';
  }

  function recolectData()
  {
    $data = array();
    $data['ida-vuelta'] = $_POST['ida-vuelta'];
    $data['destino'] = $_POST['destino'];
    $data['ruta'] = $_POST['ruta'];
    $data['fecha-ida'] = $_POST['fecha-ida'];
    $data['fecha-vuelta'] = $_POST['fecha-vuelta'];
    $data['numero-adultos'] = $_POST['numero-adultos'];
    $data['numero-ninos'] = $_POST['numero-ninos'];
    
    return $data;
  }

  function getMinimunDay()
  {
    $dias = get_option('day_for_reserve');
    $dayForReserve = new \DateTime();
    $dayForReserve->add(new \DateInterval('P'.$dias.'D'));

    return $dayForReserve->format('Y-m-d');
  }

  function getRutaType()
  {
    $rutaType;
    if (empty($this->recolectData()['ida-vuelta']) or 
        $this->recolectData()['ida-vuelta'] == 'ida-vuelta') {
      $rutaType = 'ida-vuelta';
    } else {
      $rutaType = 'ida';
    };
    return $rutaType;
  }
}

