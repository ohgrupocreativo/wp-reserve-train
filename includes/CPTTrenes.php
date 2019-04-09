<?php
defined("ABSPATH") or die("");

class CPTTrenes
{
  static  $cptTrenes = null;
  private $labels;

  private $arguments;

  private function __construct()
  {
    add_action('init', array($this, 'registerPostType'));

    $this->labels = array(
      'name'                   => __('Trenes'),
      'singular_name'          => __('Tren'), 
      'add_new'                => __('Agregar Tren'),
      'add_new_item'           => __('Agregar nuevo tren'),
      'edit_item'              => __('Editar tren'),
      'new_item'               => __('Nuevo tren'),
      'view_item' 						 => __('Ver tren'),
      'view_items'             => __('Ver trenes'),
      'search_items'           => __('Buscar trenes'),
      'not_found'              => __('Tren no encontrada'),
      'not_found_in_trash'     => __('Tren no encontrada en la papelera'),
      'parent_item_colon'      => __('Tren padre'),
      'all_items'              => __('Todos los trenes'),
      'archives'               => __('Archivo de trenes'),
      'attributes'             => __('Atributo de trees'),
      'insert_into_item'       => __('Insertar en el tren'),
      'uploaded_to_this_item'  => __('Subido a este tren'),
      'featured_image'         => __('Imagen destacada'),
      'set_featured_image'     => __('Insertar imagen destacada'),
      'remove_featured_image'  => __('Remover imagen destacada'),
      'use_featured_image'     => __('Usar imagen destacada'),
      'menu_name' 						 => __('Trenes'),			
      'filter_items_list'      => __('Filtrar trenes'),
      'items_list_navigation'  => __('Trenes'),	
      'items_list'             => __('Trenes'),	
      'name_admin_bar'         => __('Trenes'),			
    );

    $this->arguments = array(
      'label' => 'Trenes',
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
      'menu_icon' => 'dashicons-welcome-add-page',				
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
      'query_var' => 'tren',
      'can_export' => true,
      'delete_with_user' => null,
      'show_in_rest' => true,
      'rest_base' => 'trains',
      'rest_controller_class' => 'WP_REST_Posts_Controller',
    );
  }

  static function getSelfObject()
  {
    if ( self::$cptTrenes === null) {
      self::$cptTrenes = new CPTTrenes();
      return self::$cptTrenes;
    } else {
      self::$cptTrenes;
    }
  }

	function registerPostType() 
	{
    register_post_type('rt-trains', $this->arguments);
	}
		
}

	