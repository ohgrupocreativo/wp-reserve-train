<?php
defined("ABSPATH") or die("");

class CPTReserva
{
  static  $cptReserva = null;
  private $labels;

  private $arguments;

  private function __construct()
  {
    add_action('init', array($this, 'registerPostType'));

    $this->labels = array(
      'name'                   => __('Reserva'),
      'singular_name'          => __('Reserva'), 
      'add_new'                => __('Agregar Reserva'),
      'add_new_item'           => __('Agregar nueva reserva'),
      'edit_item'              => __('Editar reserva'),
      'new_item'               => __('Nueva reserva'),
      'view_item' 						 => __('Ver reserva'),
      'view_items'             => __('Ver reserva'),
      'search_items'           => __('Buscar reserva'),
      'not_found'              => __('Reserva no encontrada'),
      'not_found_in_trash'     => __('Reserva no encontrada en la papelera'),
      'parent_item_colon'      => __('Reserva padre'),
      'all_items'              => __('Todas las reservas'),
      'archives'               => __('Archivo de reservas'),
      'attributes'             => __('Atributo de reservas'),
      'insert_into_item'       => __('Insertar en la reserva'),
      'uploaded_to_this_item'  => __('Subido a esta reserva'),
      'featured_image'         => __('Imagen destacada'),
      'set_featured_image'     => __('Insertar imagen destacada'),
      'remove_featured_image'  => __('Remover imagen destacada'),
      'use_featured_image'     => __('Usar imagen destacada'),
      'menu_name' 						 => __('Reserva'),			
      'filter_items_list'      => __('Filtrar reservas'),
      'items_list_navigation'  => __('Reserva'),	
      'items_list'             => __('Reserva'),	
      'name_admin_bar'         => __('Reserva'),			
    );

    $this->arguments = array(
      'label' => 'Reservas',
      'labels' => $this->labels,
      'description' => 'Sistema de gestión de reserva de trenes',
      'public' => true,
      'exclude_from_search' => true,
      'publicly_queryable' => false,
      'show_ui' => true,
      'show_in_menu' => true,
      'show_in_nav_menu' => true,
      'show_in_admin_bar' => true,
      'menu_position' => 20,
      'menu_icon' => 'dashicons-calendar-alt',				
      'capability_type' => 'post',
      'capabilities' => array(
        'publish_posts'       => 'update_core',
        'edit_others_posts'   => 'update_core',
        'delete_posts'        => 'update_core',
        'delete_others_posts' => 'update_core',
        'read_private_posts'  => 'update_core',
        'edit_post'           => 'edit_posts',
        'delete_post'         => 'update_core',
        'read_post'           => 'edit_posts',
      ),
      'map_meta_cap' => null,
      'hierarchical' => false,
      'supports' => array(
        'title',
      ),
      'register_meta_box_cb' => '',
      //'taxonomies' => array('oficina'),
      'has_archive' => true,
      //'rewrite' => true,
      'permalink_epmask' => EP_PERMALINK,
      'query_var' => 'reserva',
      'can_export' => true,
      'delete_with_user' => null,
      'show_in_rest' => true,
      'rest_base' => 'reserve-trains',
      'rest_controller_class' => 'WP_REST_Posts_Controller',
    );
  }

  static function getSelfObject()
  {
    if ( self::$cptReserva === null) {
      self::$cptReserva = new CPTReserva();
      return self::$cptReserva;
    } else {
      self::$cptReserva;
    }
  }

	function registerPostType() 
	{
    register_post_type('reserve-train', $this->arguments);
	}
		
}

	