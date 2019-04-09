jQuery(document).ready(function($) { 

  $('#save-pay-method').click(function(evt) {
    evt.preventDefault();

    var that = this;

    var culqi = $('#active-culqi').prop('checked');
    var paypal = $('#active-paypal').prop('checked');

    $.ajax({
      url: proyectosadminjs_vars.ajaxurl,
      type: 'post',
      data: {
        action: 'proyectosadminjs_ajax_payMethodConfig',
        use_culqi: culqi,
        use_paypal: paypal
      }, 
      beforeSend: function() {
        $(that).parent().find('.form-loader').css('display', 'inline');
        $(that).parent().find('.form-error').css('display', 'none');
        $(that).parent().find('.form-success').css('display', 'none');
      },
      success: function(resp) {
        console.log(resp);

        $(that).parent().find('.form-loader').css('display', 'none');
        if (resp == 1) {
          $(that).parent().find('.form-success').css('display', 'inline');
        } else {
          $(that).parent().find('.form-error').css('display', 'inline');
        }
      }
    }); 
  });

  $('#save-day-for-reserve').click(function(evt) {
    evt.preventDefault();
    var that = this;

    var dayForReserve = $('#day-for-reserve').val();

    $.ajax({
      url: proyectosadminjs_vars.ajaxurl,
      type: 'post',
      data: {
        action: 'proyectosadminjs_ajax_dayForReserve',
        day_for_reserve: dayForReserve
      }, 
      beforeSend: function() {
        $(that).parent().find('.form-loader').css('display', 'inline');
        $(that).parent().find('.form-error').css('display', 'none');
        $(that).parent().find('.form-success').css('display', 'none');
      },
      success: function(resp) {
        console.log(resp);

        $(that).parent().find('.form-loader').css('display', 'none');
        if (resp == 1) {
          $(that).parent().find('.form-success').css('display', 'inline');
        } else {
          $(that).parent().find('.form-error').css('display', 'inline');
        }
      }
    }); 
  });

  $('#save-culqi-form-page').click(function(evt) {
    evt.preventDefault();
    var that = this;

    var culqiFormPage = $('#cuqi-form-page').val();

    $.ajax({
      url: proyectosadminjs_vars.ajaxurl,
      type: 'post',
      data: {
        action: 'proyectosadminjs_ajax_culqiFormPage',
        culqi_form_page: culqiFormPage
      }, 
      beforeSend: function() {
        $(that).parent().find('.form-loader').css('display', 'inline');
        $(that).parent().find('.form-error').css('display', 'none');
        $(that).parent().find('.form-success').css('display', 'none');
      },
      success: function(resp) {
        console.log(resp);

        $(that).parent().find('.form-loader').css('display', 'none');
        if (resp == 1) {
          $(that).parent().find('.form-success').css('display', 'inline');
        } else {
          $(that).parent().find('.form-error').css('display', 'inline');
        }
      }
    }); 
  });

  $('#save-paypal-form-page').click(function(evt) {
    evt.preventDefault();
    var that = this;

    var paypalFormPage = $('#paypal-form-page').val();

    $.ajax({
      url: proyectosadminjs_vars.ajaxurl,
      type: 'post',
      data: {
        action: 'proyectosadminjs_ajax_paypalFormPage',
        paypal_form_page: paypalFormPage
      }, 
      beforeSend: function() {
        $(that).parent().find('.form-loader').css('display', 'inline');
        $(that).parent().find('.form-error').css('display', 'none');
        $(that).parent().find('.form-success').css('display', 'none');
      },
      success: function(resp) {
        console.log(resp);

        $(that).parent().find('.form-loader').css('display', 'none');
        if (resp == 1) {
          $(that).parent().find('.form-success').css('display', 'inline');
        } else {
          $(that).parent().find('.form-error').css('display', 'inline');
        }
      }
    }); 
  });

  $('#save-data-form-page').click(function(evt) {
    evt.preventDefault();
    var that = this;

    var dataFormPage = $('#data-form-page').val();

    $.ajax({
      url: proyectosadminjs_vars.ajaxurl,
      type: 'post',
      data: {
        action: 'proyectosadminjs_ajax_dataFormPage',
        data_form_page: dataFormPage
      }, 
      beforeSend: function() {
        $(that).parent().find('.form-loader').css('display', 'inline');
        $(that).parent().find('.form-error').css('display', 'none');
        $(that).parent().find('.form-success').css('display', 'none');
      },
      success: function(resp) {
        console.log(resp);

        $(that).parent().find('.form-loader').css('display', 'none');
        if (resp == 1) {
          $(that).parent().find('.form-success').css('display', 'inline');
        } else {
          $(that).parent().find('.form-error').css('display', 'inline');
        }
      }
    }); 
  });

  $('#save-form-home-title').click(function(evt) {
    evt.preventDefault();
    var that = this;

    var formTitleHome = $('#form-home-title').val();

    $.ajax({
      url: proyectosadminjs_vars.ajaxurl,
      type: 'post',
      data: {
        action: 'proyectosadminjs_ajax_formTitleHome',
        form_title_home: formTitleHome
      }, 
      beforeSend: function() {
        $(that).parent().find('.form-loader').css('display', 'inline');
        $(that).parent().find('.form-error').css('display', 'none');
        $(that).parent().find('.form-success').css('display', 'none');
      },
      success: function(resp) {
        console.log(resp);

        $(that).parent().find('.form-loader').css('display', 'none');
        if (resp == 1) {
          $(that).parent().find('.form-success').css('display', 'inline');
        } else {
          $(that).parent().find('.form-error').css('display', 'inline');
        }
      }
    }); 
  });

  $('#save-form-sidebar-title').click(function(evt) {
    evt.preventDefault();
    var that = this;

    var formTitleSidebar = $('#form-sidebar-title').val();

    $.ajax({
      url: proyectosadminjs_vars.ajaxurl,
      type: 'post',
      data: {
        action: 'proyectosadminjs_ajax_formTitleSidebar',
        form_title_sidebar: formTitleSidebar
      }, 
      beforeSend: function() {
        $(that).parent().find('.form-loader').css('display', 'inline');
        $(that).parent().find('.form-error').css('display', 'none');
        $(that).parent().find('.form-success').css('display', 'none');
      },
      success: function(resp) {
        console.log(resp);

        $(that).parent().find('.form-loader').css('display', 'none');
        if (resp == 1) {
          $(that).parent().find('.form-success').css('display', 'inline');
        } else {
          $(that).parent().find('.form-error').css('display', 'inline');
        }
      }
    }); 
  });

  $('#save-completed-page').click(function(evt) {
    evt.preventDefault();
    var that = this;

    var completedPage = $('#completed-page').val();

    console.log(completedPage);

    $.ajax({
      url: proyectosadminjs_vars.ajaxurl,
      type: 'post',
      data: {
        action: 'proyectosadminjs_ajax_completedPage',
        completed_page: completedPage
      }, 
      beforeSend: function() {
        $(that).parent().find('.form-loader').css('display', 'inline');
        $(that).parent().find('.form-error').css('display', 'none');
        $(that).parent().find('.form-success').css('display', 'none');
      },
      success: function(resp) {
        console.log(resp);

        $(that).parent().find('.form-loader').css('display', 'none');
        if (resp == 1) {
          $(that).parent().find('.form-success').css('display', 'inline');
        } else {
          $(that).parent().find('.form-error').css('display', 'inline');
        }
      }
    }); 
  });

  $('#save-culqi-public-key').click(function(evt) {
    evt.preventDefault();
    var that = this;

    var culqiPublicKey = $('#culqi-public-key').val();

    $.ajax({
      url: proyectosadminjs_vars.ajaxurl,
      type: 'post',
      data: {
        action: 'proyectosadminjs_ajax_saveCulqiPublicKey',
        culqi_public_key: culqiPublicKey
      }, 
      beforeSend: function() {
        $(that).parent().find('.form-loader').css('display', 'inline');
        $(that).parent().find('.form-error').css('display', 'none');
        $(that).parent().find('.form-success').css('display', 'none');
      },
      success: function(resp) {
        console.log(resp);

        $(that).parent().find('.form-loader').css('display', 'none');
        if (resp == 1) {
          $(that).parent().find('.form-success').css('display', 'inline');
        } else {
          $(that).parent().find('.form-error').css('display', 'inline');
        }
      }
    }); 
  });

  $('#save-culqi-private-key').click(function(evt) {
    evt.preventDefault();
    var that = this;

    var culqiPrivateKey = $('#culqi-private-key').val();

    $.ajax({
      url: proyectosadminjs_vars.ajaxurl,
      type: 'post',
      data: {
        action: 'proyectosadminjs_ajax_saveCulqiPrivateKey',
        culqi_private_key: culqiPrivateKey
      }, 
      beforeSend: function() {
        $(that).parent().find('.form-loader').css('display', 'inline');
        $(that).parent().find('.form-error').css('display', 'none');
        $(that).parent().find('.form-success').css('display', 'none');
      },
      success: function(resp) {
        console.log(resp);

        $(that).parent().find('.form-loader').css('display', 'none');
        if (resp == 1) {
          $(that).parent().find('.form-success').css('display', 'inline');
        } else {
          $(that).parent().find('.form-error').css('display', 'inline');
        }
      }
    }); 
  });

  $('#save-expiration-date-culqi').click(function(evt) {
    evt.preventDefault();
    var that = this;

    var expirationDateCulqi = $('#expiration-date-culqi').val();

    $.ajax({
      url: proyectosadminjs_vars.ajaxurl,
      type: 'post',
      data: {
        action: 'proyectosadminjs_ajax_saveExpirationDateCulqi',
        expiration_date_culqi: expirationDateCulqi
      }, 
      beforeSend: function() {
        $(that).parent().find('.form-loader').css('display', 'inline');
        $(that).parent().find('.form-error').css('display', 'none');
        $(that).parent().find('.form-success').css('display', 'none');
      },
      success: function(resp) {
        console.log(resp);

        $(that).parent().find('.form-loader').css('display', 'none');
        if (resp == 1) {
          $(that).parent().find('.form-success').css('display', 'inline');
        } else {
          $(that).parent().find('.form-error').css('display', 'inline');
        }
      }
    }); 
  });

  $('#save-environment-paypal').click(function(evt) {
    evt.preventDefault();
    var that = this;

    var environmentPaypal = $('#environment-paypal').val();

    $.ajax({
      url: proyectosadminjs_vars.ajaxurl,
      type: 'post',
      data: {
        action: 'proyectosadminjs_ajax_environmentPaypal',
        environment_paypal: environmentPaypal
      }, 
      beforeSend: () => {
        $(that).parent().find('.form-loader').css('display', 'inline');
        $(that).parent().find('.form-error').css('display', 'none');
        $(that).parent().find('.form-success').css('display', 'none');
      },
      success: (resp) => {
        console.log(resp);

        $(that).parent().find('.form-loader').css('display', 'none');
        if (resp == 1) {
          $(that).parent().find('.form-success').css('display', 'inline');
        } else {
          $(that).parent().find('.form-error').css('display', 'inline');
        }
      }
    }); 
  });

  $('#save-client-id-paypal-sandbox').click(function(evt) {
    evt.preventDefault();
    var that = this;

    var clientIdPaypalSandbox = $('#client-id-paypal-sandbox').val();

    $.ajax({
      url: proyectosadminjs_vars.ajaxurl,
      type: 'post',
      data: {
        action: 'proyectosadminjs_ajax_clientIdPaypalSandbox',
        client_id_paypal_sandbox: clientIdPaypalSandbox
      }, 
      beforeSend: () => {
        $(that).parent().find('.form-loader').css('display', 'inline');
        $(that).parent().find('.form-error').css('display', 'none');
        $(that).parent().find('.form-success').css('display', 'none');
      },
      success: (resp) => {
        console.log(resp);

        $(that).parent().find('.form-loader').css('display', 'none');
        if (resp == 1) {
          $(that).parent().find('.form-success').css('display', 'inline');
        } else {
          $(that).parent().find('.form-error').css('display', 'inline');
        }
      }
    }); 
  });

  $('#save-client-id-paypal-live').click(function(evt) {
    evt.preventDefault();
    var that = this;

    var clientIdPaypalLive = $('#client-id-paypal-live').val();

    $.ajax({
      url: proyectosadminjs_vars.ajaxurl,
      type: 'post',
      data: {
        action: 'proyectosadminjs_ajax_clientIdPaypalLive',
        client_id_paypal_live: clientIdPaypalLive
      }, 
      beforeSend: () => {
        $(that).parent().find('.form-loader').css('display', 'inline');
        $(that).parent().find('.form-error').css('display', 'none');
        $(that).parent().find('.form-success').css('display', 'none');
      },
      success: (resp) => {
        console.log(resp);

        $(that).parent().find('.form-loader').css('display', 'none');
        if (resp == 1) {
          $(that).parent().find('.form-success').css('display', 'inline');
        } else {
          $(that).parent().find('.form-error').css('display', 'inline');
        }
      }
    }); 
  });
  
  $('#save-number-adults').click(function(evt) {
    evt.preventDefault();
    var that = this;

    var numberAdults = $('#number-adults').val();

    $.ajax({
      url: proyectosadminjs_vars.ajaxurl,
      type: 'post',
      data: {
        action: 'proyectosadminjs_ajax_numberAdults',
        number_adults: numberAdults
      }, 
      beforeSend: () => {
        $(that).parent().find('.form-loader').css('display', 'inline');
        $(that).parent().find('.form-error').css('display', 'none');
        $(that).parent().find('.form-success').css('display', 'none');
      },
      success: (resp) => {
        console.log(resp);

        $(that).parent().find('.form-loader').css('display', 'none');
        if (resp == 1) {
          $(that).parent().find('.form-success').css('display', 'inline');
        } else {
          $(that).parent().find('.form-error').css('display', 'inline');
        }
      }
    }); 
  });  

  $('#save-number-children').click(function(evt) {
    evt.preventDefault();
    var that = this;

    var numberChildren = $('#number-children').val();

    $.ajax({
      url: proyectosadminjs_vars.ajaxurl,
      type: 'post',
      data: {
        action: 'proyectosadminjs_ajax_numberChildren',
        number_children: numberChildren
      }, 
      beforeSend: () => {
        $(that).parent().find('.form-loader').css('display', 'inline');
        $(that).parent().find('.form-error').css('display', 'none');
        $(that).parent().find('.form-success').css('display', 'none');
      },
      success: (resp) => {
        console.log(resp);

        $(that).parent().find('.form-loader').css('display', 'none');
        if (resp == 1) {
          $(that).parent().find('.form-success').css('display', 'inline');
        } else {
          $(that).parent().find('.form-error').css('display', 'inline');
        }
      }
    }); 
  });  
  
});