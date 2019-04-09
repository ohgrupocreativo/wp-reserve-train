<?php
defined("ABSPATH") or die("");

class MB_Trenes 
{
  static  $mbTrenes = null;

  private function __construct()
  {
    add_action('add_meta_boxes', array($this, 'addMetaBoxes'));
    add_action( 'save_post', array($this, 'saveTrenMetabox'));
  }

  static function getSelfObject()
  {
    if ( self::$mbTrenes === null) {
      self::$mbTrenes = new MB_Trenes();
      return self::$mbTrenes;
    } else {
      self::$mbTrenes;
    }
  }

  function saveTrenMetaBox($post_id)
  {
    if( isset( $_POST['value-train-pen'] ) )
      update_post_meta( $post_id, 'value_train_pen', esc_attr( $_POST['value-train-pen'] ) );

    if( isset( $_POST['value-train-usd'] ) )
      update_post_meta( $post_id, 'value_train_usd', esc_attr( $_POST['value-train-usd'] ) );

    if( isset( $_POST['departure-time'] ) )
      update_post_meta( $post_id, 'departure_time', esc_attr( $_POST['departure-time'] ) );

    if( isset( $_POST['check-in'] ) )
      update_post_meta( $post_id, 'check_in', esc_attr( $_POST['check-in'] ) );

    if( isset( $_POST['ida-vuelta'] ) )
      update_post_meta( $post_id, 'ida_vuelta', esc_attr( $_POST['ida-vuelta'] ) );

    if( isset( $_POST['estacion-llegada'] ) )
      update_post_meta( $post_id, 'estacion_llegada', esc_attr( $_POST['estacion-llegada'] ) );
  }

  function addMetaBoxes() 
  {
    add_meta_box( 
      'tren-meta-data', 
      'Data', 
      array($this, 'renderMetaBoxes'), 
      'rt-trains', 
      'normal', 
      'high' 
    );
  }

  function renderMetaBoxes($post)
  {
    $idaVuelta = get_post_meta($post->ID, 'ida_vuelta', true);
    ?>
      <table class="form-table">
        <tr>
          <th>
            Ida
          </th>
          <td>
            <input type="radio" name="ida-vuelta" id="ida" value="ida" <?= ($idaVuelta === 'ida' or $idaVuelta == '') ? 'checked' : '';?>>
          </td>
        </tr>
        <tr>
          <th>
            Vuelta
          </th>
          <td>
            <input type="radio" name="ida-vuelta" id="vuelta" value="vuelta" <?= ($idaVuelta === 'vuelta') ? 'checked' : '';?>>
          </td>
        </tr>
        <tr>
          <th>
            Hora de salida:
          </th>
          <td>
            <input type="time" name="departure-time" id="departure-time" value="<?=get_post_meta($post->ID, 'departure_time', true)?>" required>
          </td>
        </tr>
        <tr>
          <th>
            Hora de llegada:
          </th>
          <td>
            <input type="time" name="check-in" id="check-in" value="<?=get_post_meta($post->ID, 'check_in', true)?>" required>
          </td>
        </tr>
        <!--
        <tr>
          <th>
            Valor PEN:
          </th>
          <td>
            <input step="0.01" type="number" name="value-train-pen" id="value-train-pen" value="<?=get_post_meta($post->ID, 'value_train_pen', true)?>" step="0.1" required>
          </td>
        </tr>
        -->
        <tr>
          <th>
            Valor USD:
          </th>
          <td>
            <input step="0.01" type="number" name="value-train-usd" id="value-train-usd" value="<?=get_post_meta($post->ID, 'value_train_usd', true)?>" step="0.1" required>
          </td>
        </tr>
        <tr>
          <th>
          Estación de llegada:
          </th>
          <td>
            <?php
              $idEstacionLlegada = get_post_meta($post->ID, 'estacion_llegada', true);
            ?>
            <select name="estacion-llegada" id="estacion-llegado">
              <option value="">Seleccionar</option>
              <?php
                $taxonomy = 'origen';
                $origenes = get_terms(['taxonomy' => $taxonomy,'hide_empty' => false,]);
                foreach ($origenes as $value => $key) {
                  $selected = $idEstacionLlegada == $key->term_id ? 'selected' : '';
                  echo '<option value="'.$key->term_id.'"'.$selected.'>'.$key->name.'</option>';
                }
              ?>
            </select>
          </td>
        </tr>
      </table>
    <?php
  }

  
}