culqi = undefined;
var dataReserve = {};
dataReserve.totalPago = 0;
dataReserve.medioPago = 'culqi';

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

  if ($('#form-reserve-sidebar input#ida').prop('checked')) {
    disableInput($('#form-reserve-sidebar #fecha-vuelta'));
  }

  $('#form-reserve-sidebar input#ida').change(function() {
    if ($(this).prop('checked')) {
      disableInput($('#form-reserve-sidebar #fecha-vuelta'));
    }
  });

  $('#form-reserve input#ida').change(function() {
    if ($(this).prop('checked')) {
      disableInput($('#form-reserve #fecha-vuelta'));
    }
  });

  $('#form-reserve-sidebar input#ida-vuelta').change(function() {
    if ($(this).prop('checked')) {
      enableInput($('#form-reserve-sidebar #fecha-vuelta'), 'white');
    }
  });

  $('#form-reserve input#ida-vuelta').change(function() {
    if ($(this).prop('checked')) {
      enableInput($('#form-reserve #fecha-vuelta'), 'white');
    }
  });

  $('#destino').change(function(){     
    getRutas(this);
  });

  function getRutas(element)
  {
    var idDestino = $(element).val();
    if (idDestino === '')
      return;

    var nameDestino = $('option[value='+idDestino+']').html();

    $.ajax({
      url: proyectosformjs_vars.ajaxurl,
      type: 'post',
      data: {
        action: 'proyectosformjs_ajax_getRutas',
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
      }
    }); 
  }
  getRutas($('#destino'));

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
    dateFormat: "mm-dd-yy"
  });

  $('#fecha-vuelta').datepicker({
    minDate: new Date(
      getMinimunDate(minimunDate)[0], 
      getMinimunDate(minimunDate)[1]-1, 
      getMinimunDate(minimunDate)[2]),
    dateFormat: "mm-dd-yy"
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

});


