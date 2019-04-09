<script src="https://checkout.culqi.com/v2"></script>
<script>
    Culqi.publicKey = 'pk_test_2XfOLqCJsVBzRrIv';
    Culqi.init();
</script>
<form id="data-culqi">
  <div>
    <label for="nombres">Nombres:</label>
    <input type="text" name="nombres" id="nombres">
  </div>
  <div>
    <label for="apellidos">Apellidos:</label>
    <input type="text" name="apellidos" id="apellidos">
  </div>
  <div>
    <label for="dni">DNI:</label>
    <input type="text" name="dni" id="dni">
  </div>
  <div>
    <label for="telefono">Teléfono</label>
    <input type="text" name="telefono" id="telefono">
  </div>
  <div>
    <label>Correo Electrónico</label>
    <input type="text" size="50" data-culqi="card[email]" id="card[email]">
  </div>
  <div>
    <label>Número de tarjeta</label>
    <input type="text" size="20" data-culqi="card[number]" id="card[number]">
  </div>
  <div>
    <label>CVV: </label>
    <input type="text" size="4" data-culqi="card[cvv]" id="card[cvv]">
  </div>
  <div>
    <label>Fecha expiración (MM/YYYY): </label>
    <div class="expiration-data">
      <input type="number" data-culqi="card[exp_month]" id="card[exp_month]" class="expiration-month">
      <span class="slash-separator">/</span>
      <input type="number" data-culqi="card[exp_year]" id="card[exp_year]" class="expieration-year">
    </div>
  </div>
  <div>
    <button id="culqui-pagar">Pagar</button>
  </div>
</form>

<script>
  jQuery('#buyButton').on('click', function(e) {
      // Crea el objeto Token con Culqi JS
      Culqi.createToken();
      e.preventDefault();
  });
</script>
