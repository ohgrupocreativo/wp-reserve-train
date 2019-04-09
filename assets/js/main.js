culqi = undefined;
var dataReserve = {};
dataReserve.totalPagoPen = 0;
dataReserve.totalPagoUsd = 0;
dataReserve.medioPago = 'culqi';
dataReserve.codeReserve = undefined;

jQuery(document).ready(function($) {

  function disableInput(element, background) {
    $(element).prop('disabled', 'disabled');
    $(element).css({
      'backgroundColor':'#999',
      'opacity':'.3',
    });
  }

  function enableInput(element, background) {
    $(element).prop('disabled', '');
    $(element).css({
      'backgroundColor':background,
      'opacity':'1',
    });
  }

  if ($('#form-reserve input#ida').prop('checked')) {
    disableInput($('#form-reserve #fecha-vuelta'));
  }

  $('#form-reserve input#ida').change(function() {
    if ($(this).prop('checked')) {
      disableInput($('#form-reserve #fecha-vuelta'));
    }
  });

  $('#form-reserve input#ida-vuelta').change(function() {
    if ($(this).prop('checked')) {
      enableInput($('#form-reserve #fecha-vuelta'), '#585d6b');
    }
  });

  if ($('#form-reserve-sidebar input#ida').prop('checked')) {
    disableInput($('#form-reserve-sidebar #fecha-vuelta'));
  }

  $('#form-reserve-sidebar input#ida').change(function() {
    if ($(this).prop('checked')) {
      disableInput($('#form-reserve-sidebar #fecha-vuelta'));
    }
  });

  $('#form-reserve-sidebar input#ida-vuelta').change(function() {
    if ($(this).prop('checked')) {
      enableInput($('#form-reserve-sidebar #fecha-vuelta'), 'white');
    }
  });

  if ($('#data-reserve input#ida').prop('checked')) {
    disableInput($('#data-reserve #fecha-vuelta'));
  }

  function hiddenTrenVuelta(ruteType)
  {
    if (ruteType == 'ida') {
      $('.box-tren-vuelta').css('display', 'none');
    } else {
      $('.box-tren-vuelta').css('display', 'block');
    }
  }
  hiddenTrenVuelta($('#rute-type').val());

  $('#data-reserve input#ida').change(function() {
    if ($(this).prop('checked')) {
      disableInput($('#data-reserve #fecha-vuelta'));
      $('#rute-type').val('ida');
      hiddenTrenVuelta('ida');
    }
  });

  $('#data-reserve input#ida-vuelta').change(function() {
    if ($(this).prop('checked')) {
      enableInput($('#data-reserve #fecha-vuelta'), 'white');
      $('#rute-type').val('ida-vuelta');
      hiddenTrenVuelta('ida-vuelta');
    }
  });

  $('#destino-vuelta').change((element)=>{
    setRutaVuelta();
  });

  function setRutaVuelta()
  {
    var idOrigen = $('#destino').val();
    var idDestino = $('#destino-vuelta').val();
    var nameDestino = $('#destino-vuelta option[value="'+idDestino+'"]').html();
    $('#ruta-vuelta').html('<option value="'+idOrigen+'">Machu Picchu - '+nameDestino+'</option>');

    getTrenes($('#destino-vuelta'), $('#ruta-vuelta'), 'vuelta');
  }
  setRutaVuelta();

  function showTrains(data, table) 
  {
    var html = '';
    data.forEach(element => {
      var dataTren = '<tr class="tren-item" data-idtren="'+element.id+'" id="'+element.id+'">';
      dataTren += '<td><h5 class="title-train">'+element.name+'</h5></td>';
      dataTren += '<td><span class="empresa">'+element.empresa+'</span></td>';
      dataTren += '<td><span class="hora-salida">'+element.hora_salida+'</span></td>';
      dataTren += '<td><span class="hora-llegada">'+element.hora_llegada+'</span></td>';
      //dataTren += '<td><span class="value-pen">'+element.valor_pen+'</span></td>';
      dataTren += '<td><span class="value-usd">'+element.valor_usd+'</span></td>';
      dataTren += '</tr>';
      html += dataTren;
    });
    
    $(table).find('tbody').html(html);
  }

  function selectTren(element)
  {
    $(element).parent().find('tr').each(function(index, element){
      if (index%2 == 0 || index%2 == .5) {
        $(element).css({
          'backgroundColor':'#f9f9f9',
          'color':'#949494'
        });
      } else {
        $(element).css({
          'backgroundColor':'#f3f3f3',
          'color':'#949494'
        });
      }
      
    });

    $(element).css({
      'backgroundColor':'rgb(91, 212, 91)',
      'color':'white'
    });
    var idTren = $(element).data('idtren'); 
    var input = $(element).parent().parent().parent().find('input');
    $(input).val(idTren);

    var nameTren = $(element).find('h5').html();

    var mensaje = 'Tren '+nameTren+' seleccionado.';
    showModal(mensaje);
  }

  function getTrenes(destino, origen, idaVuelta)
  {
    var idDestino = $(destino).val();
    var idOrigen = $(origen).val();

    $.ajax({
      url: proyectosmainjs_vars.ajaxurl,
      type: 'post',
      data: {
        action: 'proyectosmainjs_ajax_getTrenes',
        id_destino: idDestino,
        id_origen: idOrigen
      }, 
      beforeSend: function() {
      },
      success: function(resp) {
        if (idaVuelta == 'ida')
          showTrains(JSON.parse(resp), $('#list-trenes'));
        
        if (idaVuelta == 'vuelta')
          showTrains(JSON.parse(resp), $('#list-trenes-vuelta'));

        $('.tren-item').click(function() {
          selectTren(this);
        });
      }
    }); 
  }

  function getRutas(element)
  {
    var idDestino = $(element).val();
    if (idDestino === '')
      return;

    var nameDestino = $('option[value='+idDestino+']').html();

    $.ajax({
      url: proyectosmainjs_vars.ajaxurl,
      type: 'post',
      data: {
        action: 'proyectosmainjs_ajax_getRutas',
        id_destino: idDestino,
      }, 
      beforeSend: function() {
      },
      success: function(resp) {
        var idRutaSelected = $('#id-ruta').val();
        var options = '';
        JSON.parse(resp).forEach(element => {
          var isSelected = idRutaSelected == element[0] ? 'selected' : '';
          options += '<option value="'+element[0]+'"'+isSelected+'>'+element[1]+' - '+nameDestino+'</option>';
        });
        $('#ruta').html(options);
        getTrenes($('#destino'), $('#ruta'), 'ida');
      }
    }); 
  }
  getRutas($('#destino'));

  $('#ruta').change(() => {
    getTrenes($('#destino'), $('#ruta'), 'ida');
  });

  $('#destino').change(function(){     
    getRutas(this);
  });

  $('#reservar').click(function(evt) {
    
    evt.preventDefault();

    var destino = $('#destino').val();
    var rutas = $('#ruta').val();
    var fechaIda = $('#fecha-ida').val();
    var fechaVuelta = $('#fecha-vuelta').val();
    var numeroAdultos = $('#numero-adultos').val();
    var isIdaVuelta = $('#ida-vuelta').prop('checked');

    if ( destino === undefined || destino === '' ||
         rutas === undefined || rutas === '' ||
         numeroAdultos < 1 || fechaIda == '' ||
         (isIdaVuelta == true && fechaVuelta == '')) {

        var mensaje = 'Debes rellenar todos los campos, para la reserva';
        showModal(mensaje);
    } else {
      $('#form-reserve').submit();
      $('#form-reserve-sidebar').submit();
    }
  });

  function showModal(mensaje)
  {
    var modal = '<div class="box-modal"><div class="box-mensaje"><p>'+mensaje+'</p><button class="close-modal">Ok</button></div></div>';

    $('body').append(modal);
    $('.close-modal').click(function(){
      $('.box-modal').remove();
    });
  }

  function verifyBasicData()
  {
    idaVuelta = $('#ida-vuelta').prop('checked');
    fechaIda = $('#fecha-ida').val();
    fechaVuelta = $('#fecha-vuelta').val();

    if (fechaIda == '') return false;
    if (fechaVuelta == '' && idaVuelta) return false;

    return true;
  }

  function verifySeletecTrain()
  {
    var idTrainIda = $('#id-tren-ida').val();
    var idTrainVuelta = $('#id-tren-vuelta').val();
    var idaVuelta = $('#ida-vuelta').prop('checked');

    if (idTrainIda == '') return 0;
    if (idTrainVuelta == '' && idaVuelta) return 1;

  }

  function veryfyPersonData()
  {
    var inputs = $('#box-data-step-3').find('input:not(input[type=hidden])');
    var selects = $('#box-data-step-3').find('select');
    var elements = $.merge(inputs, selects);
    var verify = true;
    
    $(elements).each((i, el) => {
      $(el).css('border', '1px solid #e1e1e1');
      if ($(el).val() == '') {
        verify = false;  
        $(el).css('border', '1px solid #fd6a6a');
      }
    })

    return verify;
  }

  $('#step-1').click(function(){
    $('#box-data-step-1').fadeIn();
    $('#box-data-step-2').fadeOut();
    $('#box-data-step-3').fadeOut();
    $('#box-data-step-4').fadeOut();
    $('.step').removeClass('active');
    $(this).addClass('active');
  });

  $('#to-step-2').click(function(){

    if (verifyBasicData() == false)  {
      showModal('Por favor completa todos los datos del paso 1.');
      return;
    }

    $('#box-data-step-1').fadeOut();
    $('#box-data-step-2').fadeIn();
    $('.step').removeClass('active');
    $('#step-2').addClass('active');
  });

  $('#step-2').click(function(){

    if (verifyBasicData() == false)  {
      showModal('Por favor completa todos los datos del paso 1.');
      return;
    }

    $('#box-data-step-1').fadeOut();
    $('#box-data-step-2').fadeIn();
    $('#box-data-step-3').fadeOut();
    $('#box-data-step-4').fadeOut();
    $('.step').removeClass('active');
    $(this).addClass('active');
  });

  $('#back-step-1').click(function(){
    $('#box-data-step-2').fadeOut();
    $('#box-data-step-1').fadeIn();
    $('.step').removeClass('active');
    $('#step-1').addClass('active');
  });

  $('#to-step-3').click(function(){

    if (verifySeletecTrain() == 0) {
      showModal('Por favor selecciona el tren de ida.');
      return;
    } else if (verifySeletecTrain() == 1) {
      showModal('Por favor selecciona el tren de vuelta.');
      return;
    }

    $('#box-data-step-2').fadeOut();
    $('#box-data-step-3').fadeIn();
    $('.step').removeClass('active');
    $('#step-3').addClass('active');
    loadFormsPasajeros();
  });

  $('#step-3').click(function(){

    if (verifyBasicData() == false)  {
      showModal('Por favor completa todos los datos del paso 1.');
      return;
    }

    if (verifySeletecTrain() == 0) {
      showModal('Por favor selecciona el tren de ida.');
      return;
    } else if (verifySeletecTrain() == 1) {
      showModal('Por favor selecciona el tren de vuelta.');
      return;
    }

    $('#box-data-step-1').fadeOut();
    $('#box-data-step-2').fadeOut();
    $('#box-data-step-3').fadeIn();
    $('#box-data-step-4').fadeOut();
    $('.step').removeClass('active');
    $(this).addClass('active');
    loadFormsPasajeros();
  });

  $('#numero-adultos').change(function() {
    $('#data-numero-adultos').val($(this).val());
  });

  $('#numero-ninos').change(function() {
    $('#data-numero-ninos').val($(this).val());
  });

  function loadFormsPasajeros()
  {
    var dataNumeroAdultos = $('#data-numero-adultos').val();
    var dataNumeroNinos = $('#data-numero-ninos').val();
    var numeroFormsAdultos = $('.data-adulto').length;
    var numeroFormsNinos = $('.data-nino').length;

    if (dataNumeroAdultos != numeroFormsAdultos && dataNumeroAdultos < numeroFormsAdultos) {
      for (let i=numeroFormsAdultos; i>dataNumeroAdultos; i--) {
        $($('.data-adulto')[i-1]).remove();
      }
    }

    if (dataNumeroAdultos != numeroFormsAdultos && dataNumeroAdultos > numeroFormsAdultos) {
      for (let i=numeroFormsAdultos; i<dataNumeroAdultos; i++) {
        var html = '<div id="adulto-'+(i+1)+'" class="data-adulto">'+
                   '<h4 class="hidden-form">Adulto '+(i+1)+'</h4>'+
                   '<div class="form-box">'+
                   '<p><label for="nombres-adulto-'+(i+1)+'">Nombres:</label><input id="nombres-adulto-'+(i+1)+'" name="nombres-adulto-'+(i+1)+'" maxlength="50" type="text"></p>'+
                   '<p><label for="apellidos-adulto-'+(i+1)+'">Apellidos:</label><input id="apellidos-adulto-'+(i+1)+'" name="apellidos-adulto-'+(i+1)+'" maxlength="50" type="text"></p>'+
                   '<p><label for="fecha-nacimiento-adulto-'+(i+1)+'">Fecha de nacimiento</label><input type="text" placeholder="mm-dd-aaaa" class="fecha-nacimiento" id="fecha-nacimiento-adulto-'+(i+1)+'" name="fecha-nacimiento-adulto-'+(i+1)+'"></p>'+
                   '<p><label for="nacionalidad-adulto-'+(i+1)+'">Nacionalidad</label><select id="nacionalidad-adulto-'+(i+1)+'" name="nacionalidad-adulto-'+(i+1)+'"><option value=""></option><option value="AFG">Afghanistan</option><option value="ALB">Albania</option><option value="DZA">Algeria</option><option value="ASM">American Samoa</option><option value="AND">Andorra</option><option value="ANG">Angola</option><option value="AIA">Anguilla&nbsp;</option><option value="ATA">Antartica&nbsp;</option><option value="ATG">Antigua and Barbuda&nbsp;</option><option value="ARG">Argentina</option><option value="ARM">Armenia</option><option value="ARU">Aruba</option><option value="AUS">Australia</option><option value="AUT">Austria</option><option value="BAH">Bahamas</option><option value="BHR">Bahrain&nbsp;</option><option value="BAN">Bangladesh</option><option value="BAR">Barbados</option><option value="BIE">Belarus</option><option value="BEL">Belgium</option><option value="BLZ">Belize</option><option value="BEN">Benin</option><option value="BER">Bermuda</option><option value="BTN">Bhutan</option><option value="BOL">Bolivia</option><option value="BIH">Bosnia and Herzegowina&nbsp;</option><option value="BWA">Botswana</option><option value="BVT">Bouvet Island&nbsp;</option><option value="BRA">Brasil</option><option value="IOT">British Indian Ocean Territory&nbsp;</option><option value="VGB">British Virgin Islands&nbsp;</option><option value="BRN">Brunei Darussalam&nbsp;</option><option value="BUL">Bulgaria</option><option value="BFA">Burkina Faso&nbsp;</option><option value="BDI">Burundi&nbsp;</option><option value="KHM">Cambodia&nbsp;</option><option value="CMR">Cameroon&nbsp;</option><option value="CAN">Canada</option><option value="CPV">Cape Verde&nbsp;</option><option value="CYM">Cayman Islands&nbsp;</option><option value="CAF">Central African Republic&nbsp;</option><option value="TCD">Chad&nbsp;</option><option value="CHL">Chile</option><option value="CHI">China</option><option value="CXR">Christmas Island&nbsp;</option><option value="CCK">Cocos (Keeling) Islands&nbsp;</option><option value="COL">Colombia</option><option value="COM">Comoros&nbsp;</option><option value="COG">Congo&nbsp;</option><option value="COK">Cook Islands&nbsp;</option><option value="COS">Costa Rica</option><option value="CRO">Croatia</option><option value="CUB">Cuba</option><option value="CHP">Cyprus</option><option value="RCH">Czech Republic</option><option value="COD">Democratic Republic of the Congo</option><option value="DIN">Denmark</option><option value="YIB">Djibouti</option><option value="DOM">Dominica</option><option value="TLS">East Timor&nbsp;</option><option value="ECU">Ecuador</option><option value="EGI">Egypt</option><option value="ELS">El Salvador</option><option value="GEC">Equatorial Guinea</option><option value="ERI">Eritrea&nbsp;</option><option value="EST">Estonia</option><option value="ETI">Ethiopia</option><option value="FLK">Falkland Islands (Malvinas)&nbsp;</option><option value="FRO">Faroe Islands&nbsp;</option><option value="FIY">Fiji</option><option value="FI">Finland</option><option value="FRA">France</option><option value="GYF">French Guiana</option><option value="PYF">French Polynesia&nbsp;</option><option value="GAB">Gabon</option><option value="GAM">Gambia</option><option value="GEO">Georgia</option><option value="ALE">Germany</option><option value="GHA">Ghana</option><option value="GIB">Gibraltar</option><option value="GRE">Greece</option><option value="GRL">Greenland&nbsp;</option><option value="GRD">Grenada&nbsp;</option><option value="GLP">Guadeloupe&nbsp;</option><option value="GUM">Guam&nbsp;</option><option value="GUA">Guatemala</option><option value="GUY">Guiana</option><option value="GNA">Guinea</option><option value="GUI">Guinea-Bissau</option><option value="HAI">Haiti</option><option value="HMD">Heard and Mcdonald Islands&nbsp;</option><option value="HON">Honduras</option><option value="HKO">Hong Kong</option><option value="HUN">Hungary</option><option value="ISL">Iceland</option><option value="ID">India</option><option value="IDN">Indonesia</option><option value="IRN">Iran</option><option value="IRQ">Iraq</option><option value="IRL">Ireland</option><option value="ISR">Israel</option><option value="ITA">Italy</option><option value="CIV">Ivory Coast</option><option value="JAM">Jamaica</option><option value="JAP">Japan</option><option value="JOR">Jordan</option><option value="KAZ">Kazakhstan</option><option value="KEN">Kenya</option><option value="KRB">Kiribati</option><option value="KOR">Korea</option><option value="KUW">Kuwait</option><option value="KRG">Kyrgyzstan</option><option value="LAO">Laos</option><option value="LAT">Latvia</option><option value="LIB">Lebanon</option><option value="LES">Lesotho</option><option value="LET">Letonia</option><option value="LBR">Liberia</option><option value="LBA">Libya</option><option value="LIE">Liechtenstein</option><option value="LIT">Lithuania</option><option value="LUX">Luxembourg</option><option value="MAC">Macao</option><option value="MCD">Macedonia</option><option value="MAD">Madagascar</option><option value="MLW">Malawi</option><option value="MAL">Malaysia</option><option value="MLD">Maldives</option><option value="MLI">Mali</option><option value="MLT">Malta</option><option value="MRS">Marshall Islands</option><option value="MAR">Martinique</option><option value="MRT">Mauritania</option><option value="MRC">Mauritius</option><option value="MAY">Mayotte</option><option value="MEX">Mexico</option><option value="MIC">Micronesia</option><option value="MOL">Moldova</option><option value="MON">Monaco</option><option value="MNG">Mongolia&nbsp;</option><option value="MSR">Montserrat&nbsp;</option><option value="MRR">Morocco</option><option value="MOZ">Mozambique</option><option value="MMR">Myanmar/Birmania</option><option value="NAM">Namibia&nbsp;</option><option value="NRU">Nauru&nbsp;</option><option value="NEP">Nepal</option><option value="HOL">Netherlands</option><option value="NLD">Netherlands</option><option value="AN">Netherlands Antilles&nbsp;</option><option value="NCL">New Caledonia&nbsp;</option><option value="NUE">New Zealand</option><option value="NIC">Nicaragua</option><option value="NGA">Nigeria&nbsp;</option><option value="NER">Niger&nbsp;</option><option value="NIU">Niue&nbsp;</option><option value="NFK">Norfolk Island&nbsp;</option><option value="CRN">North Korea</option><option value="MNP">Northern Mariana Islands&nbsp;</option><option value="NOR">Norway</option><option value="OMN">Oman&nbsp;</option><option value="PAK">Pakistan</option><option value="PAL">Palau</option><option value="PLE">Palestine</option><option value="PAN">Panama</option><option value="PNG">Papua New Guinea&nbsp;</option><option value="PAR">Paraguay</option><option value="PER">Peru</option><option value="FIL">Philippines</option><option value="PCN">Pitcairn&nbsp;</option><option value="POL">Poland</option><option value="POR">Portugal</option><option value="PRI">Puerto Rico</option><option value="QAT">Qatar&nbsp;</option><option value="RDO">Republica Dominicana</option><option value="EU">Reunion&nbsp;</option><option value="RUM">Romania</option><option value="RUS">Russia</option><option value="RWA">Rwanda&nbsp;</option><option value="SHN">Saint Helena&nbsp;</option><option value="KNA">Saint Kitts and Nevis&nbsp;</option><option value="LCA">Saint Lucia&nbsp;</option><option value="SMP">Saint Pierre and Miquelon&nbsp;</option><option value="VCT">Saint Vincent and The Grenadines&nbsp;</option><option value="WSM">Samoa&nbsp;</option><option value="RSM">San Marino</option><option value="STP">Sao Tome and Principe&nbsp;</option><option value="ARA">Saudi Arabia</option><option value="SEN">Senegal</option><option value="SER">Serbia</option><option value="SLE">Sierra Leone&nbsp;</option><option value="SIN">Singapore</option><option value="ESQ">Slovakia</option><option value="ESL">Slovenia</option><option value="SOM">Somalia&nbsp;</option>  <option value="SDA">South Africa</option><option value="ZAF">South Africa&nbsp;</option><option value="CRS">South Korea</option><option value="ESP">Spain</option><option value="SRI">Sri Lanka</option><option value="SDN">Sudan&nbsp;</option><option value="SJM">Svalbard and Jan Mayen Islands&nbsp;</option><option value="SWZ">Swaziland&nbsp;</option><option value="SUE">Sweden</option><option value="SUI">Switzerland</option><option value="CHE">Switzerland&nbsp;</option><option value="SYR">Syrian Arab Republic&nbsp;</option><option value="TAW">Taiwan</option><option value="TJK">Tajikistan&nbsp;</option><option value="TAI">Thailand</option><option value="TGO">Togo&nbsp;</option><option value="TKL">Tokelau&nbsp;</option><option value="TON">Tonga&nbsp;</option><option value="TYT">Trinidad and Tobago</option><option value="TUN">Tunisia</option><option value="TUR">Turkey</option><option value="TKM">Turkmenistan&nbsp;</option><option value="TCA">Turks and Caicos Islands&nbsp;</option><option value="TUV">Tuvalu&nbsp;</option><option value="EUA">USA / United States</option><option value="UGA">Uganda</option><option value="UCR">Ukraine</option><option value="EMI">United Arab Emirates</option><option value="ING">United Kingdom</option><option value="GRA">United Kingdom</option><option value="TZA">United Republic of Tanzania&nbsp;</option><option value="UMI">United States Minor Outlaying Islands&nbsp;</option><option value="VIR">United States Virgin Islands&nbsp;</option><option value="URU">Uruguay</option><option value="UZB">Uzbekistan&nbsp;</option>  <option value="VUT">Vanuatu&nbsp;</option>  <option value="VAT">Vatican City</option>  <option value="VEN">Venezuela</option>  <option value="VIE">Vietnam</option>  <option value="WLF">Wallis and Futuna Islands&nbsp;</option>  <option value="ESH">Western Sahara&nbsp;</option>  <option value="YEM">Yemen</option>  <option value="YUG">Yugoslavia</option>  <option value="ZAM">Zambia</option>  <option value="ZIM">Zimbabwe</option>  <option value="AZE">Azerbaijan</option></select></p>'+
                   '<p><label for="tipo-documento-adulto-'+(i+1)+'">Tipo de documento</label><select id="tipo-documento-adulto-'+(i+1)+'" name="tipo-documento-adulto-'+(i+1)+'"><option value=""></option><option value="DNI">Tarjeta de identificación</option><option value="PAS">Pasaporte</option></select></p>'+
                   '<p><label for="numero-documento-adulto-'+(i+1)+'">Número de documento</label><input type="text" id="numero-documento-adulto-'+(i+1)+'" name="numero-documento-adulto-'+(i+1)+'"></p>'+
                   '<p><label for="sexo-adulto-'+(i+1)+'">Sexo</label><select id="sexo-adulto-'+(i+1)+'" name="sexo-adulto-'+(i+1)+'"><option value="" ></option><option value="M">Hombre</option><option value="F">Mujer</option>  </select></p>'+
                   '<p><label for="telefono-adulto-'+(i+1)+'">Teléfono</label><input type="text" name="telefono-adulto-'+(i+1)+'" id="telefono-adulto-'+(i+1)+'"></p>'+
                   '<p><label for="email-adulto-'+(i+1)+'">Email</label><input type="email" name="email-adulto-'+(i+1)+'" id="email-adulto-'+(i+1)+'"></p></div></div>';

        $('#adultos').append(html);
      }
    }

    if (dataNumeroNinos != numeroFormsNinos && dataNumeroNinos < numeroFormsNinos) {
      for (let i=numeroFormsNinos; i>dataNumeroNinos; i--) {
        $($('.data-nino')[i-1]).remove();
      }
    }

    if (dataNumeroNinos != numeroFormsNinos && dataNumeroNinos > numeroFormsNinos) {
      for (let i=numeroFormsNinos; i<dataNumeroNinos; i++) {
        var html = '<div id="nino-'+(i+1)+'" class="data-nino">'+
                    '<h4 class="hidden-form">Niño '+(i+1)+'</h4>'+
                    '<div class="form-box">'+
                    '<p><label for="nombres-nino-'+(i+1)+'">Nombres:</label><input id="nombres-nino-'+(i+1)+'" name="nombres-nino-'+(i+1)+'" maxlength="50" type="text"></p>'+ 
                    '<p><label for="apellidos-nino-'+(i+1)+'">Apellidos:</label><input id="apellidos-nino-'+(i+1)+'" name="apellidos-nino-'+(i+1)+'" maxlength="50" type="text"></p>'+
                    '<p><label for="fecha-nacimiento-nino-'+(i+1)+'">Fecha de nacimiento</label><input type="text" placeholder="mm-dd-aaaa" class="fecha-nacimiento" id="fecha-nacimiento-nino-'+(i+1)+'" name="fecha-nacimiento-nino-'+(i+1)+'"></p>'+
                    '<p><label for="nacionalidad-nino-'+(i+1)+'">Nacionalidad</label><select id="nacionalidad-nino-'+(i+1)+'" name="nacionalidad-nino-'+(i+1)+'"><option value=""></option><option value="AFG">Afghanistan</option><option value="ALB">Albania</option><option value="DZA">Algeria</option><option value="ASM">American Samoa</option><option value="AND">Andorra</option><option value="ANG">Angola</option><option value="AIA">Anguilla&nbsp;</option><option value="ATA">Antartica&nbsp;</option><option value="ATG">Antigua and Barbuda&nbsp;</option><option value="ARG">Argentina</option><option value="ARM">Armenia</option><option value="ARU">Aruba</option><option value="AUS">Australia</option><option value="AUT">Austria</option><option value="BAH">Bahamas</option><option value="BHR">Bahrain&nbsp;</option><option value="BAN">Bangladesh</option><option value="BAR">Barbados</option><option value="BIE">Belarus</option><option value="BEL">Belgium</option><option value="BLZ">Belize</option><option value="BEN">Benin</option><option value="BER">Bermuda</option><option value="BTN">Bhutan</option><option value="BOL">Bolivia</option><option value="BIH">Bosnia and Herzegowina&nbsp;</option><option value="BWA">Botswana</option><option value="BVT">Bouvet Island&nbsp;</option><option value="BRA">Brasil</option><option value="IOT">British Indian Ocean Territory&nbsp;</option><option value="VGB">British Virgin Islands&nbsp;</option><option value="BRN">Brunei Darussalam&nbsp;</option><option value="BUL">Bulgaria</option><option value="BFA">Burkina Faso&nbsp;</option><option value="BDI">Burundi&nbsp;</option><option value="KHM">Cambodia&nbsp;</option><option value="CMR">Cameroon&nbsp;</option><option value="CAN">Canada</option><option value="CPV">Cape Verde&nbsp;</option><option value="CYM">Cayman Islands&nbsp;</option><option value="CAF">Central African Republic&nbsp;</option><option value="TCD">Chad&nbsp;</option><option value="CHL">Chile</option><option value="CHI">China</option><option value="CXR">Christmas Island&nbsp;</option><option value="CCK">Cocos (Keeling) Islands&nbsp;</option><option value="COL">Colombia</option><option value="COM">Comoros&nbsp;</option><option value="COG">Congo&nbsp;</option><option value="COK">Cook Islands&nbsp;</option><option value="COS">Costa Rica</option><option value="CRO">Croatia</option><option value="CUB">Cuba</option><option value="CHP">Cyprus</option><option value="RCH">Czech Republic</option><option value="COD">Democratic Republic of the Congo</option><option value="DIN">Denmark</option><option value="YIB">Djibouti</option><option value="DOM">Dominica</option><option value="TLS">East Timor&nbsp;</option><option value="ECU">Ecuador</option><option value="EGI">Egypt</option><option value="ELS">El Salvador</option><option value="GEC">Equatorial Guinea</option><option value="ERI">Eritrea&nbsp;</option><option value="EST">Estonia</option><option value="ETI">Ethiopia</option><option value="FLK">Falkland Islands (Malvinas)&nbsp;</option><option value="FRO">Faroe Islands&nbsp;</option><option value="FIY">Fiji</option><option value="FI">Finland</option><option value="FRA">France</option><option value="GYF">French Guiana</option><option value="PYF">French Polynesia&nbsp;</option><option value="GAB">Gabon</option><option value="GAM">Gambia</option><option value="GEO">Georgia</option><option value="ALE">Germany</option><option value="GHA">Ghana</option><option value="GIB">Gibraltar</option><option value="GRE">Greece</option><option value="GRL">Greenland&nbsp;</option><option value="GRD">Grenada&nbsp;</option><option value="GLP">Guadeloupe&nbsp;</option><option value="GUM">Guam&nbsp;</option><option value="GUA">Guatemala</option><option value="GUY">Guiana</option><option value="GNA">Guinea</option><option value="GUI">Guinea-Bissau</option><option value="HAI">Haiti</option><option value="HMD">Heard and Mcdonald Islands&nbsp;</option><option value="HON">Honduras</option><option value="HKO">Hong Kong</option><option value="HUN">Hungary</option><option value="ISL">Iceland</option><option value="ID">India</option><option value="IDN">Indonesia</option><option value="IRN">Iran</option><option value="IRQ">Iraq</option><option value="IRL">Ireland</option><option value="ISR">Israel</option><option value="ITA">Italy</option><option value="CIV">Ivory Coast</option><option value="JAM">Jamaica</option><option value="JAP">Japan</option><option value="JOR">Jordan</option><option value="KAZ">Kazakhstan</option><option value="KEN">Kenya</option><option value="KRB">Kiribati</option><option value="KOR">Korea</option><option value="KUW">Kuwait</option><option value="KRG">Kyrgyzstan</option><option value="LAO">Laos</option><option value="LAT">Latvia</option><option value="LIB">Lebanon</option><option value="LES">Lesotho</option><option value="LET">Letonia</option><option value="LBR">Liberia</option><option value="LBA">Libya</option><option value="LIE">Liechtenstein</option><option value="LIT">Lithuania</option><option value="LUX">Luxembourg</option><option value="MAC">Macao</option><option value="MCD">Macedonia</option><option value="MAD">Madagascar</option><option value="MLW">Malawi</option><option value="MAL">Malaysia</option><option value="MLD">Maldives</option><option value="MLI">Mali</option><option value="MLT">Malta</option><option value="MRS">Marshall Islands</option><option value="MAR">Martinique</option><option value="MRT">Mauritania</option><option value="MRC">Mauritius</option><option value="MAY">Mayotte</option><option value="MEX">Mexico</option><option value="MIC">Micronesia</option><option value="MOL">Moldova</option><option value="MON">Monaco</option><option value="MNG">Mongolia&nbsp;</option><option value="MSR">Montserrat&nbsp;</option><option value="MRR">Morocco</option><option value="MOZ">Mozambique</option><option value="MMR">Myanmar/Birmania</option><option value="NAM">Namibia&nbsp;</option><option value="NRU">Nauru&nbsp;</option><option value="NEP">Nepal</option><option value="HOL">Netherlands</option><option value="NLD">Netherlands</option><option value="AN">Netherlands Antilles&nbsp;</option><option value="NCL">New Caledonia&nbsp;</option><option value="NUE">New Zealand</option><option value="NIC">Nicaragua</option><option value="NGA">Nigeria&nbsp;</option><option value="NER">Niger&nbsp;</option><option value="NIU">Niue&nbsp;</option><option value="NFK">Norfolk Island&nbsp;</option><option value="CRN">North Korea</option><option value="MNP">Northern Mariana Islands&nbsp;</option><option value="NOR">Norway</option><option value="OMN">Oman&nbsp;</option><option value="PAK">Pakistan</option><option value="PAL">Palau</option><option value="PLE">Palestine</option><option value="PAN">Panama</option><option value="PNG">Papua New Guinea&nbsp;</option><option value="PAR">Paraguay</option><option value="PER">Peru</option><option value="FIL">Philippines</option><option value="PCN">Pitcairn&nbsp;</option><option value="POL">Poland</option><option value="POR">Portugal</option><option value="PRI">Puerto Rico</option><option value="QAT">Qatar&nbsp;</option><option value="RDO">Republica Dominicana</option><option value="EU">Reunion&nbsp;</option><option value="RUM">Romania</option><option value="RUS">Russia</option><option value="RWA">Rwanda&nbsp;</option><option value="SHN">Saint Helena&nbsp;</option><option value="KNA">Saint Kitts and Nevis&nbsp;</option><option value="LCA">Saint Lucia&nbsp;</option><option value="SMP">Saint Pierre and Miquelon&nbsp;</option><option value="VCT">Saint Vincent and The Grenadines&nbsp;</option><option value="WSM">Samoa&nbsp;</option><option value="RSM">San Marino</option><option value="STP">Sao Tome and Principe&nbsp;</option><option value="ARA">Saudi Arabia</option><option value="SEN">Senegal</option><option value="SER">Serbia</option><option value="SLE">Sierra Leone&nbsp;</option><option value="SIN">Singapore</option><option value="ESQ">Slovakia</option><option value="ESL">Slovenia</option><option value="SOM">Somalia&nbsp;</option><option value="SDA">South Africa</option><option value="ZAF">South Africa&nbsp;</option><option value="CRS">South Korea</option><option value="ESP">Spain</option><option value="SRI">Sri Lanka</option><option value="SDN">Sudan&nbsp;</option><option value="SJM">Svalbard and Jan Mayen Islands&nbsp;</option><option value="SWZ">Swaziland&nbsp;</option><option value="SUE">Sweden</option><option value="SUI">Switzerland</option><option value="CHE">Switzerland&nbsp;</option><option value="SYR">Syrian Arab Republic&nbsp;</option><option value="TAW">Taiwan</option><option value="TJK">Tajikistan&nbsp;</option><option value="TAI">Thailand</option><option value="TGO">Togo&nbsp;</option><option value="TKL">Tokelau&nbsp;</option><option value="TON">Tonga&nbsp;</option><option value="TYT">Trinidad and Tobago</option><option value="TUN">Tunisia</option><option value="TUR">Turkey</option><option value="TKM">Turkmenistan&nbsp;</option><option value="TCA">Turks and Caicos Islands&nbsp;</option><option value="TUV">Tuvalu&nbsp;</option><option value="EUA">USA / United States</option><option value="UGA">Uganda</option><option value="UCR">Ukraine</option><option value="EMI">United Arab Emirates</option><option value="ING">United Kingdom</option><option value="GRA">United Kingdom</option><option value="TZA">United Republic of Tanzania&nbsp;</option><option value="UMI">United States Minor Outlaying Islands&nbsp;</option><option value="VIR">United States Virgin Islands&nbsp;</option><option value="URU">Uruguay</option><option value="UZB">Uzbekistan&nbsp;</option><option value="VUT">Vanuatu&nbsp;</option><option value="VAT">Vatican City</option><option value="VEN">Venezuela</option><option value="VIE">Vietnam</option><option value="WLF">Wallis and Futuna Islands&nbsp;</option>    <option value="ESH">Western Sahara&nbsp;</option><option value="YEM">Yemen</option><option value="YUG">Yugoslavia</option><option value="ZAM">Zambia</option><option value="ZIM">Zimbabwe</option><option value="AZE">Azerbaijan</option></select></p>'+
                    '<p><label for="tipo-documento-nino-'+(i+1)+'">Tipo de documento</label><select id="tipo-documento-nino-'+(i+1)+'" name="tipo-documento-nino-'+(i+1)+'"><option value=""></option><option value="DNI">Tarjeta de identificación</option><option value="PAS">Pasaporte</option></select></p>'+
                    '<p><label for="numero-documento-nino-'+(i+1)+'">Número de documento</label><input type="text" id="numero-documento-nino-'+(i+1)+'" name="numero-documento-nino-'+(i+1)+'"></p>'+
                    '<p><label for="sexo-nino-'+(i+1)+'">Sexo</label><select id="sexo-nino-'+(i+1)+'" name="sexo-nino-'+(i+1)+'"><option value="" ></option><option value="M">Hombre</option><option value="F">Mujer</option></select></p></div></div>';

          $('#ninos').append(html);
      }
    }

    $('body').off('click', 'h4.hidden-form', ocultarFormulario);

    $('body').on('click', 'h4.hidden-form', ocultarFormulario);

    var date = new Date();
    console.log(date.getMonth()+'-'+date.getDate()+'-'+date.getFullYear());

    $('.fecha-nacimiento').datepicker({
      dateFormat: "mm-dd-yy",
      changeYear: true,
      changeMonth: true,
      yearRange: "1920:"+date.getFullYear,
      maxDate: new Date((date.getMonth()+1)+'-'+date.getDate()+'-'+date.getFullYear()),
    });
  }

  $('#step-4').click(function(){

    if (verifyBasicData() == false)  {
      showModal('Por favor completa todos los datos del paso 1.');
      return;
    }

    if (verifySeletecTrain() == 0) {
      showModal('Por favor selecciona el tren de ida.');
      return;
    } else if (verifySeletecTrain() == 1) {
      showModal('Por favor selecciona el tren de vuelta.');
      return;
    }

    if (veryfyPersonData() == false) {
      showModal('Por favor completa los datos de los pasajeros del paso 3.');
      return;
    }

    $('#box-data-step-1').fadeOut();
    $('#box-data-step-2').fadeOut();
    $('#box-data-step-3').fadeOut();
    $('#box-data-step-4').fadeIn();
    $('.step').removeClass('active');
    $(this).addClass('active');

    verificarDatos();
    loadDataReserve();
  });

  $('#back-step-2').click(function(){
    $('#box-data-step-3').fadeOut();
    $('#box-data-step-2').fadeIn();
    $('.step').removeClass('active');
    $('#step-2').addClass('active');
  });

  $('#to-step-4').click(function(){

    if (veryfyPersonData() == false) {
      showModal('Por favor completa los datos de los pasajeros del paso 3.');
      return;
    }

    $('#box-data-step-3').fadeOut();
    $('#box-data-step-4').fadeIn();
    $('.step').removeClass('active');
    $('#step-4').addClass('active');

    verificarDatos();
    loadDataReserve();
  });

  function verificarDatos()
  {
    $('.mensaje-error').css('display', 'none');

    var fechaIda = $('#fecha-ida').val();
    var fechaVuelta = $('#fecha-vuelta').val();
    var isIdaVuelta = $('#ida-vuelta').prop('checked');
    var numeroAdultos = $('#numero-adultos').val();
    var idTrenIda = $('#id-tren-ida').val();
    var idTrenVuelta = $('#id-tren-vuelta').val();

    var inputsDataPasajeros = $('.form-box input');
    var selectsDataPasajeros = $('.form-box select');

    var isError = false;

    if (fechaIda == '') {
      $('#error-fecha-ida').css('display', 'block');
    }


    if (fechaVuelta == '' && isIdaVuelta) {
      $('#error-fecha-vuelta').css('display', 'block');
      isError = true;
    }

    if (numeroAdultos < 1) {
      $('#no-adultos-paso-4').css('display', 'block');
      isError = true;
    }

    if (idTrenIda == '') {
      $('#error-tren-ida').css('display', 'block');
      isError = true;
    }

    if (idTrenVuelta == '') {
      $('#error-tren-vuelta').css('display', 'block');
      isError = true;
    }

    var checkDataPasajeros = false;

    if (inputsDataPasajeros.length == 0){
      isError = true;
      checkDataPasajeros = true;
    }
      
    inputsDataPasajeros.each(function(index, element){
      if ($(element).val() == '') {
        checkDataPasajeros = true;
        isError = true;
      }
    });

    if (selectsDataPasajeros.length == 0){
      isError = true;
      checkDataPasajeros = true;
    }

    selectsDataPasajeros.each(function(index, element){
      if ($(element).val() == '') {
        checkDataPasajeros = true;
        isError = true;
      }
    })

    if (checkDataPasajeros) {
      $('#datos-pasajeros').css('display', 'block');
    }

    if (isError) {
      $('.box-pay').css('display', 'block');
    }
  }

  /*
  function showPayTipe()
  {
    $('.method-pay').each(function(i, el) {
      $(el).css('display', 'none');
      if ($('#select-pago').val() == $(el).prop('id')) {
        dataReserve.medioPago = $(el).prop('id');
        $(el).css('display', 'block');
      }
    });
  }
  showPayTipe();
  */

  function renderPayType()
  {
    /*
    if (dataReserve.medioPago == 'culqi') {
      $('#paypal-button-container').html('');
    } else if (dataReserve.medioPago == 'paypal') {

      console.log(dataReserve);
      $.ajax({
        url: proyectosmainjs_vars.ajaxurl,
        type: 'post',
        data: {
          action: 'proyectosmainjs_ajax_getPayPalConfig',
        }, 
        beforeSend: function() {
        },
        success: function(resp) {
          payPalConfig = JSON.parse(resp);
          console.log(payPalConfig);
          renderPaypalButton(payPalConfig);
        },
        error: function() {
          var mensaje = 'Hubo un error, vuelve a intentarlo.';
          var boxMensaje = '<div class="box-mensaje"><p>'+mensaje+'</p><button class="close-modal" >Ok</button></div>'
          showModalBox(boxMensaje);
        }
      });
    } 
    */

    $.ajax({
      url: proyectosmainjs_vars.ajaxurl,
      type: 'post',
      data: {
        action: 'proyectosmainjs_ajax_getPayPalConfig',
      }, 
      beforeSend: function() {
      },
      success: function(resp) {
        payPalConfig = JSON.parse(resp);
        console.log(payPalConfig);
        renderPaypalButton(payPalConfig);
      },
      error: function() {
        var mensaje = 'Hubo un error, vuelve a intentarlo.';
        var boxMensaje = '<div class="box-mensaje"><p>'+mensaje+'</p><button class="close-modal" >Ok</button></div>'
        showModalBox(boxMensaje);
      }
    });
  }
  if ($('#paypal-button-container').length > 0)
    renderPayType();

  /*
  $('#select-pago').change(function() { 
    showPayTipe();
    renderPayType(); 
  });
  */

  function ocultarFormulario(evt)
  {
    if ($(evt.target).parent().find('.form-box').css('display') == 'none') {
      $(evt.target).parent().find('.form-box').css('display', 'flex');
    } else {
      $(evt.target).parent().find('.form-box').css('display', 'none');
    }
  }

  function loadDataReserve()
  {
    if ($('#ida').prop('checked') === true ) {
      dataReserve.idaVuelta = 'ida';
    } else {
      dataReserve.idaVuelta = 'ida-vuelta';
    }
    
    dataReserve.fechaIda = $('#fecha-ida').val();
    dataReserve.fechaVuelta = $('#fecha-vuelta').val();
    dataReserve.numeroAdultos = $('#numero-adultos').val();
    dataReserve.numeroNinos = $('#numero-ninos').val();

    var idTrenIda = $('#id-tren-ida').val();
    var dataTrenIda = {};
    dataTrenIda.titleTrain = $('tr#'+idTrenIda).find('td').find('.title-train').html();
    dataTrenIda.empresa = $('tr#'+idTrenIda).find('td').find('.empresa').html();
    dataTrenIda.horaSalida = $('tr#'+idTrenIda).find('td').find('.hora-salida').html();
    dataTrenIda.horaLlegada = $('tr#'+idTrenIda).find('td').find('.hora-llegada').html();
    dataTrenIda.valueTrainPen = $('tr#'+idTrenIda).find('td').find('.value-pen').html();
    dataTrenIda.valueTrainUsd = $('tr#'+idTrenIda).find('td').find('.value-usd').html();
    dataReserve.trenIda = dataTrenIda;

    if ($('#rute-type').val() == 'ida-vuelta') {
      var idTrenVuelta = $('#id-tren-vuelta').val();
      var dataTrenVuelta = {};
      dataTrenVuelta.titleTrain = $('tr#'+idTrenVuelta).find('td').find('.title-train').html();
      dataTrenVuelta.empresa = $('tr#'+idTrenVuelta).find('td').find('.empresa').html();
      dataTrenVuelta.horaSalida = $('tr#'+idTrenVuelta).find('td').find('.hora-salida').html();
      dataTrenVuelta.horaLlegada = $('tr#'+idTrenVuelta).find('td').find('.hora-llegada').html();
      dataTrenVuelta.valueTrainPen = $('tr#'+idTrenVuelta).find('td').find('.value-pen').html();
      dataTrenVuelta.valueTrainUsd = $('tr#'+idTrenVuelta).find('td').find('.value-usd').html();
      dataReserve.trenVuelta = dataTrenVuelta;
    } 

    var dataAdultos = {};
    $('.data-adulto').each(function(i, element){
      var data = {};
      data.nombres = $(element).find('input#nombres-adulto-'+(i+1)).val();
      data.apellidos = $(element).find('input#apellidos-adulto-'+(i+1)).val();
      data.fechaNacimiento = $(element).find('input#fecha-nacimiento-adulto-'+(i+1)).val();
      data.nacionalidad = $(element).find('select#nacionalidad-adulto-'+(i+1)).val();
      data.tipoDocumento = $(element).find('select#tipo-documento-adulto-'+(i+1)).val();
      data.numeroDocumento = $(element).find('input#numero-documento-adulto-'+(i+1)).val();
      data.sexo = $(element).find('select#sexo-adulto-'+(i+1)).val(); 
      data.telefono = $(element).find('input#telefono-adulto-'+(i+1)).val(); 
      data.email = $(element).find('input#email-adulto-'+(i+1)).val(); 
      dataAdultos[i] = data;
    });

    dataReserve.adultos = dataAdultos;

    var dataNinos = {};
    $('.data-nino').each(function(i, element){
      var data = {};
      data.nombres = $(element).find('input#nombres-nino-'+(i+1)).val();
      data.apellidos = $(element).find('input#apellidos-nino-'+(i+1)).val();
      data.fechaNacimiento = $(element).find('input#fecha-nacimiento-nino-'+(i+1)).val();
      data.nacionalidad = $(element).find('select#nacionalidad-nino-'+(i+1)).val();
      data.tipoDocumento = $(element).find('select#tipo-documento-nino-'+(i+1)).val();
      data.numeroDocumento = $(element).find('input#numero-documento-nino-'+(i+1)).val();
      data.sexo = $(element).find('select#sexo-nino-'+(i+1)).val(); 
      dataNinos[i] = data;
    });

    dataReserve.ninos = dataNinos;

    var numeroPasajeros = parseInt(dataReserve.numeroAdultos) + parseInt(dataReserve.numeroNinos);
    //var valueTrenIdaPen = parseFloat(dataTrenIda.valueTrainPen);
    var valueTrenIdaUsd = parseFloat(dataTrenIda.valueTrainUsd);
    //var valueTrenVueltaPen = parseFloat(dataTrenVuelta.valueTrainPen);
    
    //var valueIdaPen = numeroPasajeros * valueTrenIdaPen;
    var valueIdaUsd = numeroPasajeros * valueTrenIdaUsd;
    //var valueVueltaPen = numeroPasajeros * valueTrenVueltaPen;
    

    if ($('#rute-type').val() == 'ida-vuelta') {
      var valueTrenVueltaUsd = parseFloat(dataTrenVuelta.valueTrainUsd);
      var valueVueltaUsd = numeroPasajeros * valueTrenVueltaUsd;
    } else {
      var valueVueltaUsd = 0;
    }

    //dataReserve.totalPagoPen = valueIdaPen + valueVueltaPen;
    dataReserve.totalPagoUsd = valueIdaUsd + valueVueltaUsd;

    console.log(dataReserve);
  }

  culqi = function () {

    console.log(Culqi);
    if (Culqi.token) { // ¡Objeto Token creado exitosamente!
      createCharge();   

    } else if (Culqi.order) {
      saveReserve('cash');

    } else { // ¡Hubo algún problema!
      // Mostramos JSON de objeto error en consola
      console.log(Culqi.error);
      var mensaje = 'Hubo un error al procesar tu pago, por favor vuelve a intentarlo.';
      var boxMensaje = '<div class="box-mensaje"><p>'+mensaje+'</p><button class="close-modal">Ok</button></div>'
      $('.procesando-mensaje').remove();
      $('.box-modal').append(boxMensaje);
      $('.close-modal').click(function(){
        $('.box-modal').remove();
      });
      deleteReserve(dataReserve.codeReserve);   
    }
  };

  $('#culqui-pagar').click((e)=>{
    e.preventDefault();  
    console.log(dataReserve);
    $('#todos-obligatorios').css('display', 'none');
    var data = {};
    data.nombres = $('#nombres').val();
    data.apellidos = $('#apellidos').val();
    data.dni = $('#dni').val();
    data.telefono = $('#telefono').val();
    data.email = $('#email').val();

    dataReserve.paymentType = 'culqi';

    var fieldsCompleted = true;
    Object.keys(data).forEach(el => {
      if (data[el] == '') {
        $('#todos-obligatorios').css('display', 'block');
        fieldsCompleted = false;
      }
    });

    if (fieldsCompleted)
    getCulqiPublicKey(data);
  });

  function getCulqiPublicKey(data)
  {
    $.ajax({
      url: proyectosmainjs_vars.ajaxurl,
      type: 'post',
      data: {
        action: 'proyectosmainjs_ajax_getCulqiPublicKey',
      }, 
      beforeSend: function() {
        console.log('Obteniendo public key');
      },
      success: function(resp) {
        console.log(resp);
        Culqi.publicKey = resp;
        
        if (dataReserve.codeReserve == undefined) {
          createReserve(data);
        } else {
          console.log(dataReserve.codeReserve);
          Culqi.settings({
            title: ('Reserva '+dataReserve.codeReserve),
            currency: 'USD',
            description: dataReserve.codeReserve,
            amount: dataReserve.totalPagoUsd * 100, 
          });  
          Culqi.open();
        }
      },
      error: function() {
        var mensaje = 'Hubo un error al intentar obtener la key publica, vuelve a intentarlo.';
        var boxMensaje = '<div class="box-mensaje"><p>'+mensaje+'</p><button class="close-modal" >Ok</button></div>'
        showModalBox(boxMensaje);
      }
    }); 
  }

  function createReserve(data) 
  {
    //showModalProcesando('Procesando pago, espera un momento...');

    $.ajax({
      url: proyectosmainjs_vars.ajaxurl,
      type: 'post',
      data: {
        action: 'proyectosmainjs_ajax_createReserve',
      }, 
      beforeSend: function() {
        console.log('Creando reserva');
      },
      success: function(resp) {
        console.log('code reserve:'+resp);
        dataReserve.codeReserve = resp;
        if (dataReserve.paymentType == 'culqi') {
          //createOrder(data);
          Culqi.settings({
            title: ('Reserva '+dataReserve.codeReserve),
            currency: 'USD',
            description: dataReserve.codeReserve,
            amount: dataReserve.totalPagoUsd * 100, 
          });  
          Culqi.open();
        } else if (dataReserve.paymentType == 'paypal') {
          saveReserve();
        }
        
      },
      error: function() {
        var mensaje = 'Hubo un error al generar esta reserva, vuelve a intentarlo.';
        var boxMensaje = '<div class="box-mensaje"><p>'+mensaje+'</p><button class="close-modal" >Ok</button></div>'
        $('.procesando-mensaje').remove();
        $('.box-modal').append(boxMensaje);
        $('.close-modal').click(function(){
          $('.box-modal').remove();
        });
      }
    }); 
  }

  function createOrder(data)
  {
    $.ajax({
      url: proyectosmainjs_vars.ajaxurl,
      type: 'post',
      data: {
        action: 'proyectosmainjs_ajax_createOrder',
        first_name: data.nombres,
        last_name: data.apellidos,
        dni: data.dni,
        telefono: data.telefono,
        email: data.email,
        code_reserve: dataReserve.codeReserve,
        amount  : dataReserve.totalPagoPen * 100
      }, 
      beforeSend: function() {
        console.log('creando orden...');
        console.log(dataReserve.codeReserve);
      },
      success: function(resp) {
        console.log('configurando formulario culqi');
        var data = JSON.parse(resp);
        console.log(data);
        Culqi.settings({
          title: data.order_number,
          currency: 'PEN',
          description: data.order_number,
          amount: data.amount, 
          order: data.id
        });  
        Culqi.open();
      },
      error: function() {
        var mensaje = 'Hubo un error al generar esta reserva, por favor contacta al administrador.';
        var boxMensaje = '<div class="box-mensaje"><p>'+mensaje+'</p><button class="close-modal" >Ok</button></div>'
        $('.procesando-mensaje').remove();
        $('.box-modal').append(boxMensaje);
        $('.close-modal').click(function(){
          $('.box-modal').remove();
        });
        deleteReserve(dataReserve.codeReserve);
      }
    });   
    
  }

  function createCharge()
  {
    var token = Culqi.token.id;
    var nombres = $('#nombres').val();
    var apellidos = $('#apellidos').val();
    var dni = $('#dni').val();
    var telefono = $('#telefono').val();

    $.ajax({
      url: proyectosmainjs_vars.ajaxurl,
      type: 'post',
      data: {
        action: 'proyectosmainjs_ajax_createChargeCulqi',
        culqi_token: token,
        culqi_email: Culqi.token.email,
        total_pay: dataReserve.totalPagoUsd * 100,
        reserve_id: dataReserve.codeReserve,
        nombres: nombres,
        apellidos: apellidos,
        dni: dni,
        telefono: telefono,
      }, 
      beforeSend: function() {
        console.log('creando cargo');
        showModalProcesando('Procesando pago, espera un momento...');
      },
      success: function(resp) {
        console.log('cargo creado');
        console.log(JSON.parse(resp));

        if (JSON.parse(resp).object == 'error') {
          var mensaje = 'Hubo un error al procesar tu pago, por favor vuelve a intentarlo.';
          var boxMensaje = '<div class="box-mensaje"><p>'+mensaje+'</p><button class="close-modal" >Ok</button></div>'
          showModalBox(boxMensaje);
          deleteReserve(dataReserve.codeReserve);
         } else {
          dataReserve.dataPay = JSON.parse(resp);
          Culqi.close();
          saveReserve('card');
        }
      }
    });
  }

  function saveReserve()
  {
    $.ajax({
      url: proyectosmainjs_vars.ajaxurl,
      type: 'post',
      data: {
        action: 'proyectosmainjs_ajax_saveReserve',
        data_reserve: dataReserve,
        payment_type: dataReserve.paymentType,
      }, 
      beforeSend: function() {
        console.log('guardando...');
      },
      success: function(resp) {
        console.log(resp);
        $('#all-reserve-data').val(JSON.stringify(dataReserve));
        console.log($('#all-reserve-data').val());
        var mensaje = 'Tu pago fue procesado con éxito, en breve recibirás la información de reserva en tu email.';
        var boxMensaje = '<div class="box-mensaje"><p>'+mensaje+'</p><button class="close-modal" >Ok</button></div>';
        console.log(mensaje);
        showModalBox(boxMensaje);

        $('.close-modal').click(function(){
          $('#go-fo-finally').submit();
        }); 

      },
      error: function() {
        var mensaje = 'Hubo un error al generar esta reserva, por favor contacta al administrador.';
        var boxMensaje = '<div class="box-mensaje"><p>'+mensaje+'</p><button class="close-modal" >Ok</button></div>'
        $('.procesando-mensaje').remove();
        $('.box-modal').append(boxMensaje);
        $('.close-modal').click(function(){
          $('.box-modal').remove();
        });

        deleteReserve(dataReserve.codeReserve);
      }
    });     
  }

  function showModalBox(boxMensaje, extraData = undefined)
  {
    if ($('body').find('.box-modal').length == 0) {
      $('body').append('<div class="box-modal"></div>');
    }
    $('.procesando-mensaje').remove();
    $('.box-modal').append(boxMensaje);
    $('.close-modal').click(function(){
      $('.box-modal').remove();
    });
  }

  function showModalProcesando(mensaje)
  {
    var modal = '<div class="box-modal"><div class="box-mensaje procesando-mensaje"><p>'+mensaje+'</p><p><img src="'+location.origin
    +'/wp-content/plugins/wp-reserve-train/assets/img/loader.gif" width="30"></p></div></div>';

    $('body').append(modal);
    $('.close-modal').click(function(){
      $('.box-modal').remove();
    });
  }

  function deleteReserve(idReserve) {
    $.ajax({
      url: proyectosmainjs_vars.ajaxurl,
      type: 'post',
      data: {
        action: 'proyectosmainjs_ajax_deleteReserve',
        id_reserve: idReserve
      }, 
      beforeSend: function() {
        console.log('elminando reserva...');
      },
      success: function(resp) {
        if (resp) 
          console.log('Reserva eliminada');
      }
    });
  }

  function renderPaypalButton(configData)
  {
    paypal.Button.render({
      env: configData.environment,
      
      style: {
        layout: 'horizontal', 
        size:   'responsive',
        shape:  'rect',     
        color:  'blue',    
        fundingicons: false, 
        tagline: false,
      },
      
      funding: {
        allowed: [
          paypal.FUNDING.CARD,
          paypal.FUNDING.CREDIT
        ],
        disallowed: []
      },
      
      commit: true,
      
      client: {
        sandbox: configData.client_id_paypal_sandbox,
        production: configData.client_id_paypal_live,
      },
      
      payment: function (data, actions) {
        return actions.payment.create({
          payment: {
            transactions: [
              {
                amount: {
                  total: dataReserve.totalPagoUsd,
                  currency: 'USD'
                }
              }
            ]
          }
        });
      },
      
      onAuthorize: function (data, actions) {
        return actions.payment.execute()
          .then(function () {
            dataReserve.paymentType = 'paypal';
            dataReserve.paypalData = data;
            dataReserve.medioPago = 'paypal';
            createReserve();
          }).catch( () => {
            var mensaje = 'Hubo un error al procesar el pago, por favor vuelve a intentarlo.';
            var boxMensaje = '<div class="box-mensaje"><p>'+mensaje+'</p><button class="close-modal" >Ok</button></div>'
            showModalBox(boxMensaje);
          });
      },

      onCancel: function (data, actions) {
        var mensaje = 'Hubo un error al procesar el pago, por favor vuelve a intentarlo.';
        var boxMensaje = '<div class="box-mensaje"><p>'+mensaje+'</p><button class="close-modal" >Ok</button></div>'
        showModalBox(boxMensaje);
      }
    }, '#paypal-button-container');
  }

  $('#fecha-ida').change(function() {
    var fechaIda = $(this).val();

    console.log(getMinimunDate(fechaIda)[0]);

    $('#fecha-vuelta').datepicker(
      "option", 
      "minDate", 
      new Date(
        getMinimunDate(fechaIda)[2], 
        getMinimunDate(fechaIda)[0]-1, 
        getMinimunDate(fechaIda)[1])
      );
    console.log(fechaIda);
  });

  function getMinimunDate(minimunDate)
  {
    minimunDate = minimunDate.split('-');
    return minimunDate;
  }

  var minimunDate = $('#fecha-ida').data('min');
  $('#fecha-ida').datepicker({
    minDate: new Date(
      getMinimunDate(minimunDate)[0], 
      getMinimunDate(minimunDate)[1]-1, 
      getMinimunDate(minimunDate)[2]),
    dateFormat: "mm-dd-yy",
    changeYear: true,
    changeMonth: true
  });

  $('#fecha-vuelta').datepicker({
    minDate: new Date(
      getMinimunDate(minimunDate)[0], 
      getMinimunDate(minimunDate)[1]-1, 
      getMinimunDate(minimunDate)[2]),
    dateFormat: "mm-dd-yy",
    changeYear: true,
    changeMonth: true
  });

});


