<?php
defined("ABSPATH") or die(""); 

class ConfigReserva
{
  static $configReserva = null;

  private function __construct()
  {
    add_action( 'admin_menu', array($this, 'configPage') );
  }

  static function getSelfObject()
  {
    if ( self::$configReserva === null) {
      self::$configReserva = new ConfigReserva();
      return self::$configReserva;
    } else {
      self::$configReserva;
    }
  }

  function configPage()
  {
    $parent_slug = 'edit.php?post_type=reserve-train';
    $page_title  = 'Configuración';
    $menu_title  = 'Configuración';
    $capability  = 'manage_options';
    $menu_slug   = 'cofiguracion';
    $function    = array($this, 'renderConfigPage');
    $icon_url    = 'dashicons-admin-generic';
    $position    = 25;

    add_submenu_page( 
      $parent_slug,
      $page_title,
      $menu_title, 
      $capability, 
      $menu_slug, 
      $function );
  }

  function renderConfigPage()
  {
    include __DIR__ . '/../templates/configPage.php';
  } 
}