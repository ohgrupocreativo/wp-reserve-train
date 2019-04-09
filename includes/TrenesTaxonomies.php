<?php
defined("ABSPATH") or die("");

class TrenesTaxonomies
{
  static  $trenesTaxonomies = null;
  private $origenLabels;
  private $origenarguments;
  private $empresaLabels;
  private $empresaArguments;
  private $disponibilidadLabels;
  private $disponibilidadArguments;

  private function __construct()
  {
    $this->origenLabels = array(
      'name'              => _x( 'Estación', 'taxonomy general name', 'textdomain' ),
      'singular_name'     => _x( 'Estación', 'taxonomy singular name', 'textdomain' ),
      'search_items'      => __( 'Buscar estaciones', 'textdomain' ),
      'all_items'         => __( 'Todos las estaciones', 'textdomain' ),
      'parent_item'       => __( 'Estación padre:', 'textdomain' ),
      'parent_item_colon' => __( 'Estación padre:', 'textdomain' ),
      'edit_item'         => __( 'Editar estación', 'textdomain' ),
      'update_item'       => __( 'Actualizar estación', 'textdomain' ),
      'add_new_item'      => __( 'Agregar nueva estación', 'textdomain' ),
      'new_item_name'     => __( 'Nombre de nueva estación', 'textdomain' ),
      'menu_name'         => __( 'Estación', 'textdomain' ),
    );
  
    $this->origenarguments = array(
      'hierarchical'      => true,
      'labels'            => $this->origenLabels,
      'show_ui'           => true,
      'show_admin_column' => true,
      'query_var'         => true,
      'rewrite'           => array( 'slug' => 'origen' ),
    );

    $this->empresaLabels = array(
      'name'              => _x( 'Empresa', 'taxonomy general name', 'textdomain' ),
      'singular_name'     => _x( 'Empresa', 'taxonomy singular name', 'textdomain' ),
      'search_items'      => __( 'Buscar empresas', 'textdomain' ),
      'all_items'         => __( 'Todos las empresas', 'textdomain' ),
      'parent_item'       => __( 'Empresa padre:', 'textdomain' ),
      'parent_item_colon' => __( 'Empresa padre:', 'textdomain' ),
      'edit_item'         => __( 'Editar empresa', 'textdomain' ),
      'update_item'       => __( 'Actualizar empresa', 'textdomain' ),
      'add_new_item'      => __( 'Agregar nueva empresa', 'textdomain' ),
      'new_item_name'     => __( 'Nombre de nueva empresa', 'textdomain' ),
      'menu_name'         => __( 'Empresa', 'textdomain' ),
    );
  
    $this->empresaArguments = array(
      'hierarchical'      => true,
      'labels'            => $this->empresaLabels,
      'show_ui'           => true,
      'show_admin_column' => true,
      'query_var'         => true,
      'rewrite'           => array( 'slug' => 'empresa' ),
    );

    $this->disponibilidadLabels = array(
      'name'              => _x( 'Disponibilida', 'taxonomy general name', 'textdomain' ),
      'singular_name'     => _x( 'Disponibilida', 'taxonomy singular name', 'textdomain' ),
      'search_items'      => __( 'Buscar disponibilidades', 'textdomain' ),
      'all_items'         => __( 'Todos las disponibilidades', 'textdomain' ),
      'parent_item'       => __( 'Disponibilida padre:', 'textdomain' ),
      'parent_item_colon' => __( 'Disponibilida padre:', 'textdomain' ),
      'edit_item'         => __( 'Editar disponibilida', 'textdomain' ),
      'update_item'       => __( 'Actualizar disponibilida', 'textdomain' ),
      'add_new_item'      => __( 'Agregar nueva disponibilida', 'textdomain' ),
      'new_item_name'     => __( 'Nombre de nueva disponibilida', 'textdomain' ),
      'menu_name'         => __( 'Disponibilida', 'textdomain' ),
    );
  
    $this->disponibilidadArguments = array(
      'hierarchical'      => true,
      'labels'            => $this->disponibilidadLabels,
      'show_ui'           => true,
      'show_admin_column' => true,
      'query_var'         => true,
      'rewrite'           => array( 'slug' => 'disponibilida' ),
    );

    add_action('init', array($this, 'createOrigenTaxonomies'));
    add_action('init', array($this, 'createEmpresaTaxonomies'));
    add_action('init', array($this, 'createDisponibilidadTaxonomies'));
  }

  static function getSelfObject()
  {
    if ( self::$trenesTaxonomies === null) {
      self::$trenesTaxonomies = new TrenesTaxonomies();
      return self::$trenesTaxonomies;
    } else {
      self::$trenesTaxonomies;
    }
  }

	function createOrigenTaxonomies() 
	{
    register_taxonomy( 'origen', array( 'rt-trains' ), $this->origenarguments );
  }
  
  function createEmpresaTaxonomies() 
	{
    register_taxonomy( 'empresa', array( 'rt-trains' ), $this->empresaArguments );
  }
  
  function createDisponibilidadTaxonomies()
	{
    register_taxonomy( 'disponibilidad', array( 'rt-trains' ), $this->disponibilidadArguments);
	}
		
}

	