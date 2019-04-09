<?php
defined("ABSPATH") or die("");

/*
* Agregando archivos css y js
*/

class AddCssAndJs
{
  static $addCssAndJs = null;

	private function __construct() 
	{    
    add_action('wp', array($this, 'checkToLoad'));
    add_action( 'admin_enqueue_scripts', array($this, 'addMainAdminJs'));
    add_action( 'admin_enqueue_scripts', array($this, 'addMainAdminCss'));
  }
  
  static function getSelfObject()
  {
    if (self::$addCssAndJs === null) {
      self::$addCssAndJs = new AddCssAndJs();
      return self::$addCssAndJs;
    } else {
      return self::$addCssAndJs;
    }
  }

  function checkToLoad() 
  { 
    global $post;
    $currentSlug = $post->post_name;
    $reservarSlug = get_option('data_form_page');
    $payCompletedSlug = get_option('completed_page');

    if (is_home() || is_front_page()) {
      $this->loadScripts();

    } else if ($currentSlug == $reservarSlug or $currentSlug == $payCompletedSlug) {
      $this->loadScripts();
      
    } else {
      $this->loadScriptsToForm();
    }
  }

  function loadScriptsToForm()
  {
    add_action( 'wp_enqueue_scripts', array($this, 'addFormJs'));
    add_action( 'wp_print_styles', array($this, 'addFormCss'));
  }

  function loadScripts()
  {
    add_action( 'wp_enqueue_scripts', array($this, 'addCulqiCheckoutJs'));
    add_action( 'wp_enqueue_scripts', array($this, 'addPayPalCheckoutJs'));
		add_action( 'wp_enqueue_scripts', array($this, 'addMainJs'));
		add_action( 'wp_print_styles', array($this, 'addMainCss'));
  }

  function addMainJs() 
  {
    wp_register_script( 'proyectosmainjs', plugin_dir_url( __DIR__ ) . '/assets/js/main.js', '', '1', true );
    wp_enqueue_script( 'proyectosmainjs' );
    wp_localize_script( 'proyectosmainjs', 'proyectosmainjs_vars', ['ajaxurl' => admin_url( 'admin-ajax.php' ) ] );
  }

  function addFormJs() 
  {
    wp_register_script( 'proyectosformjs', plugin_dir_url( __DIR__ ) . '/assets/js/form.js', '', '1', true );
    wp_enqueue_script( 'proyectosformjs' );
    wp_localize_script( 'proyectosformjs', 'proyectosformjs_vars', ['ajaxurl' => admin_url( 'admin-ajax.php' ) ] );
  }
    
  function addMainAdminJs() 
  {	
    wp_register_script( 'proyectosadminjs', plugin_dir_url( __DIR__ ) . '/assets/js/admin.js', '', '1', true );
    wp_enqueue_script( 'proyectosadminjs' );
    wp_localize_script( 'proyectosadminjs', 'proyectosadminjs_vars', ['ajaxurl' => admin_url( 'admin-ajax.php' ) ] );
  }

  function addCulqiCheckoutJs() 
  {	
    wp_register_script( 'culqicheckoutjs', 'https://checkout.culqi.com/js/v3', '', '1', true );
    wp_enqueue_script( 'culqicheckoutjs' );
    wp_localize_script( 'culqicheckoutjs', 'culqicheckoutjs_vars', ['ajaxurl' => admin_url( 'admin-ajax.php' ) ] );
  }
 
  function addPayPalCheckoutJs() 
  {	
    wp_register_script( 'paypalcheckoutjs', 'https://www.paypalobjects.com/api/checkout.js', '', '1', true );
    wp_enqueue_script( 'paypalcheckoutjs' );
    wp_localize_script( 'paypalcheckoutjs', 'paypalcheckoutjs_vars', ['ajaxurl' => admin_url( 'admin-ajax.php' ) ] );
  }
  
  function addMainCss() 
  {
    wp_register_style( 'proyectosmaincss', plugin_dir_url( __DIR__ ) . '/assets/css/main.css', '', 1 );
    wp_enqueue_style( 'proyectosmaincss' );
  }

  function addFormCss() 
  {
    wp_register_style( 'proyectosformcss', plugin_dir_url( __DIR__ ) . '/assets/css/form.css', '', 1 );
    wp_enqueue_style( 'proyectosformcss' );
  }
  
  function addMainAdminCss() 
  {
    wp_register_style( 'proyectosadmincss', plugin_dir_url( __DIR__ ) . '/assets/css/admin.css', '', 1 );
    wp_enqueue_style( 'proyectosadmincss' );
  }
}