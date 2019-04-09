<h3>Configuración de metodos de pago</h3>
<form>
  <table class="form-table">
    <tr>
      <th>
        Usar método de pago Culqi:
      </th>
      <td>
        <input type="checkbox" name="active-culqi" id="active-culqi" <?= get_option('use_culqi') === 'true' ? 'checked' : ''?>>
      </td>
    </tr>
    <tr>
      <th>
        User Método de pago PayPal:
      </th>
      <td>
        <input type="checkbox" name="active-paypal" id="active-paypal" <?=get_option('use_paypal') === 'true' ? 'checked' : ''?>>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <input class="button" type="submit" id="save-pay-method" name="save-pay-method" value="Guardar">
        <img width="32" height="32" class="form-loader" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/loader.gif" alt="">
        <img width="32" height="32" class="form-success" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/success.png" alt="">
        <img width="32" height="32" class="form-error" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/error.png" alt="">  
      </td>
    </tr>
  </table>
</form>

<h3>Configuración de días para reserva</h3>
<form>
  <table class="form-table">
    <tr>
      <th>
        Días para reserva:
      </th>
      <td>
        <input type="number" name="day-for-reserve" id="day-for-reserve" value="<?=get_option('day_for_reserve')?>" >
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <input class="button" type="submit" id="save-day-for-reserve" name="save-day-for-reserve" value="Guardar">
        <img width="32" height="32" class="form-loader" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/loader.gif" alt="">
        <img width="32" height="32" class="form-success" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/success.png" alt="">
        <img width="32" height="32" class="form-error" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/error.png" alt="">  
      </td>
    </tr>
  </table>
</form>
<h3>Página de formulario para insertar datos</h3>
<form>
  <table class="form-table">
    <tr>
      <th>
        Slug de pagina:
      </th>
      <td>
        <input type="text" name="data-form-page" id="data-form-page" value="<?=get_option('data_form_page')?>" >
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <input class="button" type="submit" id="save-data-form-page" name="save-data-form-page" value="Guardar">
        <img width="32" height="32" class="form-loader" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/loader.gif" alt="">
        <img width="32" height="32" class="form-success" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/success.png" alt="">
        <img width="32" height="32" class="form-error" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/error.png" alt="">  
      </td>
    </tr>
  </table>
</form>

<h3>Página de reserva finalizada</h3>
<form>
  <table class="form-table">
    <tr>
      <th>
        Slug de pagina:
      </th>
      <td>
        <input type="text" name="completed-page" id="completed-page" value="<?=get_option('completed_page')?>" >
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <input class="button" type="submit" id="save-completed-page" name="save-completed-page" value="Guardar">
        <img width="32" height="32" class="form-loader" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/loader.gif" alt="">
        <img width="32" height="32" class="form-success" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/success.png" alt="">
        <img width="32" height="32" class="form-error" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/error.png" alt="">  
      </td>
    </tr>
  </table>
</form>

<!--
<h3>Página de formulario para pago Culqi</h3>
<form>
  <table class="form-table">
    <tr>
      <th>
        Slug de pagina:
      </th>
      <td>
        <input type="text" name="culqi-form-page" id="cuqi-form-page" value="<?=get_option('culqi_form_page')?>" >
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <input class="button" type="submit" id="save-culqi-form-page" name="save-culqi-form-page" value="Guardar">
        <img width="32" height="32" class="form-loader" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/loader.gif" alt="">
        <img width="32" height="32" class="form-success" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/success.png" alt="">
        <img width="32" height="32" class="form-error" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/error.png" alt="">  
      </td>
    </tr>
  </table>
</form>

<h3>Página de formulario para pago PayPal</h3>
<form>
  <table class="form-table">
    <tr>
      <th>
        Slug de pagina:
      </th>
      <td>
        <input type="text" name="paypali-form-page" id="paypal-form-page" value="<?=get_option('paypal_form_page')?>" >
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <input class="button" type="submit" id="save-paypal-form-page" name="save-paypal-form-page" value="Guardar">
        <img width="32" height="32" class="form-loader" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/loader.gif" alt="">
        <img width="32" height="32" class="form-success" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/success.png" alt="">
        <img width="32" height="32" class="form-error" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/error.png" alt="">  
      </td>
    </tr>
  </table>
</form>
-->

<h3>Título formulario home</h3>
<form>
  <table class="form-table">
    <tr>
      <th>
        Título:
      </th>
      <td>
        <input type="text" name="form-home-title" id="form-home-title" value="<?=get_option('form-home-title')?>" >
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <input class="button" type="submit" id="save-form-home-title" name="save-form-home-title" value="Guardar">
        <img width="32" height="32" class="form-loader" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/loader.gif" alt="">
        <img width="32" height="32" class="form-success" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/success.png" alt="">
        <img width="32" height="32" class="form-error" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/error.png" alt="">  
      </td>
    </tr>
  </table>
</form>

<h3>Título formulario sidebar</h3>
<form>
  <table class="form-table">
    <tr>
      <th>
        Título:
      </th>
      <td>
        <input type="text" name="form-sidebar-title" id="form-sidebar-title" value="<?=get_option('form-sidebar-title')?>" >
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <input class="button" type="submit" id="save-form-sidebar-title" name="save-form-sidebar-title" value="Guardar">
        <img width="32" height="32" class="form-loader" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/loader.gif" alt="">
        <img width="32" height="32" class="form-success" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/success.png" alt="">
        <img width="32" height="32" class="form-error" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/error.png" alt="">  
      </td>
    </tr>
  </table>
</form>

<h3>Culqi Public Key</h3>
<form>
  <table class="form-table">
    <tr>
      <th>
        Key:
      </th>
      <td>
        <input type="text" name="culqi-public-key" id="culqi-public-key" value="<?=get_option('culqi_public_key')?>" >
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <input class="button" type="submit" id="save-culqi-public-key" name="save-culqi-public-key" value="Guardar">
        <img width="32" height="32" class="form-loader" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/loader.gif" alt="">
        <img width="32" height="32" class="form-success" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/success.png" alt="">
        <img width="32" height="32" class="form-error" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/error.png" alt="">  
      </td>
    </tr>
  </table>
</form>

<h3>Culqi Private Key</h3>
<form>
  <table class="form-table">
    <tr>
      <th>
        Key:
      </th>
      <td>
        <input type="text" name="culqi-private-key" id="culqi-private-key" value="<?=get_option('culqi_private_key')?>" >
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <input class="button" type="submit" id="save-culqi-private-key" name="save-culqi-private-key" value="Guardar">
        <img width="32" height="32" class="form-loader" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/loader.gif" alt="">
        <img width="32" height="32" class="form-success" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/success.png" alt="">
        <img width="32" height="32" class="form-error" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/error.png" alt="">  
      </td>
    </tr>
  </table>
</form>

<h3>Número de días límite para pago culqi en efectivo.</h3>
<form>
  <table class="form-table">
    <tr>
      <th>
      Número de días:
      </th>
      <td>
        <input type="number" name="expiration-date-culqi" id="expiration-date-culqi" value="<?=get_option('expiration_date_culqi')?>" min="1">
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <input class="button" type="submit" id="save-expiration-date-culqi" name="save-expiration-date-culqi" value="Guardar">
        <img width="32" height="32" class="form-loader" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/loader.gif" alt="">
        <img width="32" height="32" class="form-success" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/success.png" alt="">
        <img width="32" height="32" class="form-error" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/error.png" alt="">  
      </td>
    </tr>
  </table>
</form>

<h3>Tipo de entorno PayPal.</h3>
<form>
  <table class="form-table">
    <tr>
      <th>
        Entorno:
      </th>
      <td>
        <select name="environment-paypal" id="environment-paypal">
          <option value="sandbox" <?=get_option('environment_paypal') == 'sandbox' ? 'selected' : ''; ?>>Sandbox</option>
          <option value="live" <?=get_option('environment_paypal') == 'live' ? 'selected' : ''; ?>>Live</option>
        </select>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <input class="button" type="submit" id="save-environment-paypal" name="save-environment-paypal" value="Guardar">
        <img width="32" height="32" class="form-loader" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/loader.gif" alt="">
        <img width="32" height="32" class="form-success" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/success.png" alt="">
        <img width="32" height="32" class="form-error" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/error.png" alt="">  
      </td>
    </tr>
  </table>
</form>

<h3>Client Id Paypal (Sandbox)</h3>
<form>
  <table class="form-table">
    <tr>
      <th>
        Key:
      </th>
      <td>
        <input type="text" name="client-id-paypal-sandbox" id="client-id-paypal-sandbox" value="<?=get_option('client_id_paypal_sandbox')?>" min="1">
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <input class="button" type="submit" id="save-client-id-paypal-sandbox" name="save-client-id-paypal-sandbox" value="Guardar">
        <img width="32" height="32" class="form-loader" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/loader.gif" alt="">
        <img width="32" height="32" class="form-success" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/success.png" alt="">
        <img width="32" height="32" class="form-error" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/error.png" alt="">  
      </td>
    </tr>
  </table>
</form>

<h3>Client Id Paypal (live)</h3>
<form>
  <table class="form-table">
    <tr>
      <th>
        Key:
      </th>
      <td>
        <input type="text" name="client-id-paypal-live" id="client-id-paypal-live" value="<?=get_option('client_id_paypal_live')?>" min="1">
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <input class="button" type="submit" id="save-client-id-paypal-live" name="save-client-id-paypal-live" value="Guardar">
        <img width="32" height="32" class="form-loader" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/loader.gif" alt="">
        <img width="32" height="32" class="form-success" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/success.png" alt="">
        <img width="32" height="32" class="form-error" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/error.png" alt="">  
      </td>
    </tr>
  </table>
</form>

<h3>Número máximo de pasajeros adultos</h3>
<form>
  <table class="form-table">
    <tr>
      <th>
      Número:
      </th>
      <td>
        <input type="number" name="number-adults" id="number-adults" value="<?=get_option('number_adults')?>" min="1">
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <input class="button" type="submit" id="save-number-adults" name="save-number-adults" value="Guardar">
        <img width="32" height="32" class="form-loader" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/loader.gif" alt="">
        <img width="32" height="32" class="form-success" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/success.png" alt="">
        <img width="32" height="32" class="form-error" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/error.png" alt="">  
      </td>
    </tr>
  </table>
</form>

<h3>Número máximo de pasajeros niños</h3>
<form>
  <table class="form-table">
    <tr>
      <th>
      Número:
      </th>
      <td>
        <input type="number" name="number-children" id="number-children" value="<?=get_option('number_children')?>" min="1">
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <input class="button" type="submit" id="save-number-children" name="save-number-children" value="Guardar">
        <img width="32" height="32" class="form-loader" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/loader.gif" alt="">
        <img width="32" height="32" class="form-success" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/success.png" alt="">
        <img width="32" height="32" class="form-error" src="<?=get_site_url()?>/wp-content/plugins/wp-reserve-train/assets/img/error.png" alt="">  
      </td>
    </tr>
  </table>
</form>