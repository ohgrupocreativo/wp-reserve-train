<form id="data-reserve">
  <div class="steps-box">
    <div class="step" id="step-1">
      <p class="number">1</p>
    </div>
    <hr class="line-connector">
    <div class="step active" id="step-2">
    <p class="number">2</p>
    </div>
    <hr class="line-connector">
    <div class="step" id="step-3">
    <p class="number">3</p>
    </div>
    <hr class="line-connector">
    <div class="step " id="step-4">
    <p class="number">4</p>
    </div>
  </div>

  <div id="box-data-step-1" class="box-data-step">
    <h3>Paso 1: Datos básicos</h3>
    <div class="box-ida-vuelta">
    <div class="input-ida-vuelta">
        <label for="ida-vuelta">Ida y vuelta</label>
        <input type="radio" name="ida-vuelta" id="ida-vuelta" value="ida-vuelta" checked
          <?=$this->recolectData()['ida-vuelta'] == 'ida-vuelta' ? 'checked' : '';?>>
      </div>

      <div class="input-ida">
        <label for="ida">Ida</label>
        <input type="radio" name="ida-vuelta" id="ida" value="ida" 
          <?=$this->recolectData()['ida-vuelta'] == 'ida' ? 'checked' : '';?>>
      </div>
      
    </div>

    <div class="box-fechas-numero">
      <div class="input-fecha-ida">
        <label for="fecha-ida">Fecha ida</label>
        <input type="text" name="fecha-ida" id="fecha-ida" value="<?=$this->recolectData()['fecha-ida'];?>" placeholder="mm/dd/yyyy" data-min="<?=$this->getMinimunDay();?>">
      </div>

      <div class="input-fecha-vuelta">
        <label for="fecha-vuelta">Fecha vuelta</label>
        <input type="text" name="fecha-vuelta" id="fecha-vuelta" value="<?=$this->recolectData()['fecha-vuelta'];?>" placeholder="mm/dd/yyyy" data-min="<?=$this->getMinimunDay();?>">
      </div>

      <div class="input-numero-adultos">
        <label for="numero-adultos">Numero de adultos</label>
        <select name="numero-adultos" id="numero-adultos">
          <?php
            $numberAdultsSelected = $this->recolectData()['numero-adultos'];
            $numberAdults = get_option('number_adults');
            for ($i=1; $i<=$numberAdults; $i++) {
              $selected = $numberAdultsSelected == $i ? 'selected' : '';
              echo '<option val="'.$i.'" '.$selected.'>'.$i.'</option>';
            }  
          ?>
        </select>
      </div>

      <div class="input-numero-ninos">
        <label for="numero-ninos">Numero de niños</label>
        <select name="numero-ninos" id="numero-ninos">
          <?php
            $numberChildrenSelected = $this->recolectData()['numero-ninos']; 
            $numberChildren = get_option('number_children');
            for ($i=0; $i<=$numberChildren; $i++) {
              $selected = $numberChildrenSelected == $i ? 'selected' : '';
              echo '<option val="'.$i.'" '.$selected.'>'.$i.'</option>';
            }  
          ?>
        </select>
      </div>
    </div>

    <button class="next-step" type="button" id="to-step-2">Siguente</button>

  </div>
  
  <div id="box-data-step-2" class="box-data-step">
    <h3>Paso 2: Escoge tu tren</h3>
    <input type="hidden" name="rute-type" id="rute-type" value="<?=$this->getRutaType()?>">
    <div id="box-tren-ida">
      <h4>Tren de ida</h4>
      <div class="box-destino-ruta">
        <div class="input-ruta">
          <input type="hidden" name="id-ruta" id="id-ruta" value="<?=$this->recolectData()['ruta']?>">
          <label for="ruta">Ruta</label>
          <select id="ruta" name="ruta" class="" selected="selected">
          </select>
        </div>
        <div class="input-destino" style="display:none">
          <label for="destino">Destino</label>
          <select id="destino" name="destino" class="" selected="selected">
            <?php
              $machupichu = get_term_by('name', 'Machu Picchu', 'origen');
              echo '<option value="'.$machupichu->term_id.'">'.$machupichu->name.'</option>';
            ?>
          </select>
        </div>
      </div>

      <div class="trenes">
        <!--<h4>Tren de ida</h4>-->
        <input type="hidden" name="id-tren-ida" id="id-tren-ida" value="" >
        <table id="list-trenes" class="list-trenes">
          <thead>
            <tr>
              <th>Tren</th>
              <th>Empresa</th>
              <th>Hora salida</th>
              <th>Hora llegada</th>
              <!--<th>Valor PEN</th>-->
              <th>Valor USD</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>

    <div class="box-tren-vuelta">
      <h4>Tren de vuelta</h4>
      <div class="box-destino-ruta">
        <div class="input-ruta" style="display:none">
          <label for="ruta-vuelta">Ruta</label>
          <input type="hidden" name="id-ruta-vuelta" id="id-ruta-vuelta" value="<?=$this->recolectData()['ruta']?>">
          <select id="ruta-vuelta" name="ruta-vuelta" class="" selected="selected">
          </select>
        </div>
        <div class="input-destino">
          <label for="destino-vuelta">Ruta</label>
          <select id="destino-vuelta" name="destino-vuelta" class="" selected="selected">
            <?php
              $taxonomy = 'origen';
              $origenes = get_terms(['taxonomy' => $taxonomy,'hide_empty' => false,]);
              foreach ($origenes as $value => $key) {
                $isChecked = $this->recolectData()['destino'] == $key->term_id ? 'selected' : '';
                if ($key->name == 'Machu Picchu')
                  continue;

                echo '<option value="'.$key->term_id.'" '.$isChecked.'>Machu Picchu -'.$key->name.'</option>';
              }
            ?>
          </select>
        </div>      
      </div>

      <div class="trenes">
        <!--<h4>Tren de vuelta</h4>-->
        <input type="hidden" name="id-tren-vuelta" id="id-tren-vuelta" value="">
        <table id="list-trenes-vuelta" class="list-trenes">
          <thead>
            <tr>
              <th>Tren</th>
              <th>Empresa</th>
              <th>Hora salida</th>
              <th>Hora llegada</th>
              <!--<th>Valor PEN</th>-->
              <th>Valor USD</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>

    <button class="back-step" type="button" id="back-step-1">Atras</button>
    <button class="next-step" type="button" id="to-step-3">Siguente</button>
  </div>

  <div id="box-data-step-3" class="box-data-step">
    <h3>Paso 3: Datos de pasajeros</h3>
    <!--
    <div class="box-mensajes-error">
      <p class="mensaje-error" id="no-adultos">Parece que nos has indicado el numero de pasajeros adultos, por favor vuelve al paso 1.</p>
      <p class="mensaje-error" id="no-ninos">Parece que nos has indicado el numero de pasajeros niños, por favor vuelve al paso 1.</p>
    </div>
    -->
    
    <div class="adultos" id="adultos">
      <input type="hidden" id="data-numero-adultos" name="data-numero-adultos" value="<?=$this->recolectData()['numero-adultos'] < 1 ? 1 : $this->recolectData()['numero-adultos']?>">
      <?php /*for ($i=1; $i <= $this->recolectData()['numero-adultos']; $i++) { ?>
      <div id="adulto-<?=$i?>" class="data-adulto">
        <h4 class="hidden-form">Adulto <?=$i?></h4>
            <div class="form-box">
              <p>
                <label for="nombres-adulto-<?=$i?>">Nombres:</label>
                <input id="nombres-adulto-<?=$i?>" name="nombres-adulto-<?=$i?>" maxlength="50" type="text">
              </p>
              <p>
                <label for="apellidos-adulto-<?=$i?>">Apellidos:</label>
                <input id="apellidos-adulto-<?=$i?>" name="apellidos-adulto-<?=$i?>" maxlength="50" type="text">
              </p>
              <p>
                <label for="fecha-nacimiento-adulto-<?=$i?>">Fecha de nacimiento</label>
                <input type="date" id="fecha-nacimiento-adulto-<?=$i?>" name="fecha-nacimiento-adulto-<?=$i?>">
              </p>

              <p>
                <label for="nacionalidad-adulto-<?=$i?>">Nacionalidad</label>
                <select id="nacionalidad-adulto-<?=$i?>" name="nacionalidad-adulto-<?=$i?>">
                  <option value=""></option>
                  <option value="AFG">Afghanistan</option>
                  <option value="ALB">Albania</option>
                  <option value="DZA">Algeria</option>
                  <option value="ASM">American Samoa</option>
                  <option value="AND">Andorra</option>
                  <option value="ANG">Angola</option>
                  <option value="AIA">Anguilla&nbsp;</option>
                  <option value="ATA">Antartica&nbsp;</option>
                  <option value="ATG">Antigua and Barbuda&nbsp;</option>
                  <option value="ARG">Argentina</option>
                  <option value="ARM">Armenia</option>
                  <option value="ARU">Aruba</option>
                  <option value="AUS">Australia</option>
                  <option value="AUT">Austria</option>
                  <option value="BAH">Bahamas</option>
                  <option value="BHR">Bahrain&nbsp;</option>
                  <option value="BAN">Bangladesh</option>
                  <option value="BAR">Barbados</option>
                  <option value="BIE">Belarus</option>
                  <option value="BEL">Belgium</option>
                  <option value="BLZ">Belize</option>
                  <option value="BEN">Benin</option>
                  <option value="BER">Bermuda</option>
                  <option value="BTN">Bhutan</option>
                  <option value="BOL">Bolivia</option>
                  <option value="BIH">Bosnia and Herzegowina&nbsp;</option>
                  <option value="BWA">Botswana</option>
                  <option value="BVT">Bouvet Island&nbsp;</option>
                  <option value="BRA">Brasil</option>
                  <option value="IOT">British Indian Ocean Territory&nbsp;</option>
                  <option value="VGB">British Virgin Islands&nbsp;</option>
                  <option value="BRN">Brunei Darussalam&nbsp;</option>
                  <option value="BUL">Bulgaria</option>
                  <option value="BFA">Burkina Faso&nbsp;</option>
                  <option value="BDI">Burundi&nbsp;</option>
                  <option value="KHM">Cambodia&nbsp;</option>
                  <option value="CMR">Cameroon&nbsp;</option>
                  <option value="CAN">Canada</option>
                  <option value="CPV">Cape Verde&nbsp;</option>
                  <option value="CYM">Cayman Islands&nbsp;</option>
                  <option value="CAF">Central African Republic&nbsp;</option>
                  <option value="TCD">Chad&nbsp;</option>
                  <option value="CHL">Chile</option>
                  <option value="CHI">China</option>
                  <option value="CXR">Christmas Island&nbsp;</option>
                  <option value="CCK">Cocos (Keeling) Islands&nbsp;</option>
                  <option value="COL">Colombia</option>
                  <option value="COM">Comoros&nbsp;</option>
                  <option value="COG">Congo&nbsp;</option>
                  <option value="COK">Cook Islands&nbsp;</option>
                  <option value="COS">Costa Rica</option>
                  <option value="CRO">Croatia</option>
                  <option value="CUB">Cuba</option>
                  <option value="CHP">Cyprus</option>
                  <option value="RCH">Czech Republic</option>
                  <option value="COD">Democratic Republic of the Congo</option>
                  <option value="DIN">Denmark</option>
                  <option value="YIB">Djibouti</option>
                  <option value="DOM">Dominica</option>
                  <option value="TLS">East Timor&nbsp;</option>
                  <option value="ECU">Ecuador</option>
                  <option value="EGI">Egypt</option>
                  <option value="ELS">El Salvador</option>
                  <option value="GEC">Equatorial Guinea</option>
                  <option value="ERI">Eritrea&nbsp;</option>
                  <option value="EST">Estonia</option>
                  <option value="ETI">Ethiopia</option>
                  <option value="FLK">Falkland Islands (Malvinas)&nbsp;</option>
                  <option value="FRO">Faroe Islands&nbsp;</option>
                  <option value="FIY">Fiji</option>
                  <option value="FI">Finland</option>
                  <option value="FRA">France</option>
                  <option value="GYF">French Guiana</option>
                  <option value="PYF">French Polynesia&nbsp;</option>
                  <option value="GAB">Gabon</option>
                  <option value="GAM">Gambia</option>
                  <option value="GEO">Georgia</option>
                  <option value="ALE">Germany</option>
                  <option value="GHA">Ghana</option>
                  <option value="GIB">Gibraltar</option>
                  <option value="GRE">Greece</option>
                  <option value="GRL">Greenland&nbsp;</option>
                  <option value="GRD">Grenada&nbsp;</option>
                  <option value="GLP">Guadeloupe&nbsp;</option>
                  <option value="GUM">Guam&nbsp;</option>
                  <option value="GUA">Guatemala</option>
                  <option value="GUY">Guiana</option>
                  <option value="GNA">Guinea</option>
                  <option value="GUI">Guinea-Bissau</option>
                  <option value="HAI">Haiti</option>
                  <option value="HMD">Heard and Mcdonald Islands&nbsp;</option>
                  <option value="HON">Honduras</option>
                  <option value="HKO">Hong Kong</option>
                  <option value="HUN">Hungary</option>
                  <option value="ISL">Iceland</option>
                  <option value="ID">India</option>
                  <option value="IDN">Indonesia</option>
                  <option value="IRN">Iran</option>
                  <option value="IRQ">Iraq</option>
                  <option value="IRL">Ireland</option>
                  <option value="ISR">Israel</option>
                  <option value="ITA">Italy</option>
                  <option value="CIV">Ivory Coast</option>
                  <option value="JAM">Jamaica</option>
                  <option value="JAP">Japan</option>
                  <option value="JOR">Jordan</option>
                  <option value="KAZ">Kazakhstan</option>
                  <option value="KEN">Kenya</option>
                  <option value="KRB">Kiribati</option>
                  <option value="KOR">Korea</option>
                  <option value="KUW">Kuwait</option>
                  <option value="KRG">Kyrgyzstan</option>
                  <option value="LAO">Laos</option>
                  <option value="LAT">Latvia</option>
                  <option value="LIB">Lebanon</option>
                  <option value="LES">Lesotho</option>
                  <option value="LET">Letonia</option>
                  <option value="LBR">Liberia</option>
                  <option value="LBA">Libya</option>
                  <option value="LIE">Liechtenstein</option>
                  <option value="LIT">Lithuania</option>
                  <option value="LUX">Luxembourg</option>
                  <option value="MAC">Macao</option>
                  <option value="MCD">Macedonia</option>
                  <option value="MAD">Madagascar</option>
                  <option value="MLW">Malawi</option>
                  <option value="MAL">Malaysia</option>
                  <option value="MLD">Maldives</option>
                  <option value="MLI">Mali</option>
                  <option value="MLT">Malta</option>
                  <option value="MRS">Marshall Islands</option>
                  <option value="MAR">Martinique</option>
                  <option value="MRT">Mauritania</option>
                  <option value="MRC">Mauritius</option>
                  <option value="MAY">Mayotte</option>
                  <option value="MEX">Mexico</option>
                  <option value="MIC">Micronesia</option>
                  <option value="MOL">Moldova</option>
                  <option value="MON">Monaco</option>
                  <option value="MNG">Mongolia&nbsp;</option>
                  <option value="MSR">Montserrat&nbsp;</option>
                  <option value="MRR">Morocco</option>
                  <option value="MOZ">Mozambique</option>
                  <option value="MMR">Myanmar/Birmania</option>
                  <option value="NAM">Namibia&nbsp;</option>
                  <option value="NRU">Nauru&nbsp;</option>
                  <option value="NEP">Nepal</option>
                  <option value="HOL">Netherlands</option>
                  <option value="NLD">Netherlands</option>
                  <option value="AN">Netherlands Antilles&nbsp;</option>
                  <option value="NCL">New Caledonia&nbsp;</option>
                  <option value="NUE">New Zealand</option>
                  <option value="NIC">Nicaragua</option>
                  <option value="NGA">Nigeria&nbsp;</option>
                  <option value="NER">Niger&nbsp;</option>
                  <option value="NIU">Niue&nbsp;</option>
                  <option value="NFK">Norfolk Island&nbsp;</option>
                  <option value="CRN">North Korea</option>
                  <option value="MNP">Northern Mariana Islands&nbsp;</option>
                  <option value="NOR">Norway</option>
                  <option value="OMN">Oman&nbsp;</option>
                  <option value="PAK">Pakistan</option>
                  <option value="PAL">Palau</option>
                  <option value="PLE">Palestine</option>
                  <option value="PAN">Panama</option>
                  <option value="PNG">Papua New Guinea&nbsp;</option>
                  <option value="PAR">Paraguay</option>
                  <option value="PER">Peru</option>
                  <option value="FIL">Philippines</option>
                  <option value="PCN">Pitcairn&nbsp;</option>
                  <option value="POL">Poland</option>
                  <option value="POR">Portugal</option>
                  <option value="PRI">Puerto Rico</option>
                  <option value="QAT">Qatar&nbsp;</option>
                  <option value="RDO">Republica Dominicana</option>
                  <option value="EU">Reunion&nbsp;</option>
                  <option value="RUM">Romania</option>
                  <option value="RUS">Russia</option>
                  <option value="RWA">Rwanda&nbsp;</option>
                  <option value="SHN">Saint Helena&nbsp;</option>
                  <option value="KNA">Saint Kitts and Nevis&nbsp;</option>
                  <option value="LCA">Saint Lucia&nbsp;</option>
                  <option value="SMP">Saint Pierre and Miquelon&nbsp;</option>
                  <option value="VCT">Saint Vincent and The Grenadines&nbsp;</option>
                  <option value="WSM">Samoa&nbsp;</option>
                  <option value="RSM">San Marino</option>
                  <option value="STP">Sao Tome and Principe&nbsp;</option>
                  <option value="ARA">Saudi Arabia</option>
                  <option value="SEN">Senegal</option>
                  <option value="SER">Serbia</option>
                  <option value="SLE">Sierra Leone&nbsp;</option>
                  <option value="SIN">Singapore</option>
                  <option value="ESQ">Slovakia</option>
                  <option value="ESL">Slovenia</option>
                  <option value="SOM">Somalia&nbsp;</option>
                  <option value="SDA">South Africa</option>
                  <option value="ZAF">South Africa&nbsp;</option>
                  <option value="CRS">South Korea</option>
                  <option value="ESP">Spain</option>
                  <option value="SRI">Sri Lanka</option>
                  <option value="SDN">Sudan&nbsp;</option>
                  <option value="SJM">Svalbard and Jan Mayen Islands&nbsp;</option>
                  <option value="SWZ">Swaziland&nbsp;</option>
                  <option value="SUE">Sweden</option>
                  <option value="SUI">Switzerland</option>
                  <option value="CHE">Switzerland&nbsp;</option>
                  <option value="SYR">Syrian Arab Republic&nbsp;</option>
                  <option value="TAW">Taiwan</option>
                  <option value="TJK">Tajikistan&nbsp;</option>
                  <option value="TAI">Thailand</option>
                  <option value="TGO">Togo&nbsp;</option>
                  <option value="TKL">Tokelau&nbsp;</option>
                  <option value="TON">Tonga&nbsp;</option>
                  <option value="TYT">Trinidad and Tobago</option>
                  <option value="TUN">Tunisia</option>
                  <option value="TUR">Turkey</option>
                  <option value="TKM">Turkmenistan&nbsp;</option>
                  <option value="TCA">Turks and Caicos Islands&nbsp;</option>
                  <option value="TUV">Tuvalu&nbsp;</option>
                  <option value="EUA">USA / United States</option>
                  <option value="UGA">Uganda</option>
                  <option value="UCR">Ukraine</option>
                  <option value="EMI">United Arab Emirates</option>
                  <option value="ING">United Kingdom</option>
                  <option value="GRA">United Kingdom</option>
                  <option value="TZA">United Republic of Tanzania&nbsp;</option>
                  <option value="UMI">United States Minor Outlaying Islands&nbsp;</option>
                  <option value="VIR">United States Virgin Islands&nbsp;</option>
                  <option value="URU">Uruguay</option>
                  <option value="UZB">Uzbekistan&nbsp;</option>
                  <option value="VUT">Vanuatu&nbsp;</option>
                  <option value="VAT">Vatican City</option>
                  <option value="VEN">Venezuela</option>
                  <option value="VIE">Vietnam</option>
                  <option value="WLF">Wallis and Futuna Islands&nbsp;</option>
                  <option value="ESH">Western Sahara&nbsp;</option>
                  <option value="YEM">Yemen</option>
                  <option value="YUG">Yugoslavia</option>
                  <option value="ZAM">Zambia</option>
                  <option value="ZIM">Zimbabwe</option>
                  <option value="AZE">Azerbaijan</option>
                </select>
              </p>

              <p>
                <label for="tipo-documento-adulto-<?=$i?>">Tipo de documento</label>
                <select id="tipo-documento-adulto-<?=$i?>" name="tipo-documento-adulto-<?=$i?>">
                  <option value=""></option>
                  <option value="DNI">Tarjeta de identificación</option>
                  <option value="PAS">Pasaporte</option>
                </select>
              </p>

              <p>
                <label for="numero-documento-adulto-<?=$i?>">Número de documento</label>
                <input type="text" id="numero-documento-adulto-<?=$i?>" name="numero-documento-adulto-<?=$i?>">
              </p>

              <p>
                <label for="sexo-adulto-<?=$i?>">Sexo</label>
                <select id="sexo-adulto-<?=$i?>" name="sexo-adulto-<?=$i?>">
                  <option value="" ></option>
                  <option value="M">Hombre</option>
                  <option value="F">Mujer</option>
                </select>
              </p>

              <p>
                <label for="telefono-adulto-<?=$i?>">Teléfono</label>
                <input type="text" name="telefono-adulto-<?=$i?>" id="telefono-adulto-<?=$i?>">
              </p>
                          
              <p>
                <label for="email-adulto-<?=$i?>">Email</label>
                <input type="email" name="email-adulto-<?=$i?>" id="email-adulto-<?=$i?>">
              </p>
            </div>
      </div>
      <?php }*/ ?>
    </div>     
    
    <div class="ninos" id="ninos">
    <input type="hidden" id="data-numero-ninos" name="data-numero-ninos" value="<?=$this->recolectData()['numero-ninos']?>">
      <?php /*for ($i=1; $i <= $this->recolectData()['numero-ninos']; $i++) {?>
      <div id="nino-<?=$i?>" class="data-nino">
        <h4 class="hidden-form">Niño <?=$i?></h4>
            <div class="form-box">
              <p>
                <label for="nombres-nino-<?=$i?>">Nombres:</label>
                <input id="nombres-nino-<?=$i?>" name="nombres-nino-<?=$i?>" maxlength="50" type="text">
              </p>

              <p>
                <label for="apellidos-nino-<?=$i?>">Apellidos:</label>
                <input id="apellidos-nino-<?=$i?>" name="apellidos-nino-<?=$i?>" maxlength="50" type="text">
              </p>
              
              <p>
                <label for="fecha-nacimiento-nino-<?=$i?>">Fecha de nacimiento</label>
                <input type="date" id="fecha-nacimiento-nino-<?=$i?>" name="fecha-nacimiento-nino-<?=$i?>">
              </p>
              
              <p>
                <label for="nacionalidad-nino-<?=$i?>">Nacionalidad</label>
                <select id="nacionalidad-nino-<?=$i?>" name="nacionalidad-nino-<?=$i?>">
                  <option value=""></option>
                  <option value="AFG">Afghanistan</option>
                  <option value="ALB">Albania</option>
                  <option value="DZA">Algeria</option>
                  <option value="ASM">American Samoa</option>
                  <option value="AND">Andorra</option>
                  <option value="ANG">Angola</option>
                  <option value="AIA">Anguilla&nbsp;</option>
                  <option value="ATA">Antartica&nbsp;</option>
                  <option value="ATG">Antigua and Barbuda&nbsp;</option>
                  <option value="ARG">Argentina</option>
                  <option value="ARM">Armenia</option>
                  <option value="ARU">Aruba</option>
                  <option value="AUS">Australia</option>
                  <option value="AUT">Austria</option>
                  <option value="BAH">Bahamas</option>
                  <option value="BHR">Bahrain&nbsp;</option>
                  <option value="BAN">Bangladesh</option>
                  <option value="BAR">Barbados</option>
                  <option value="BIE">Belarus</option>
                  <option value="BEL">Belgium</option>
                  <option value="BLZ">Belize</option>
                  <option value="BEN">Benin</option>
                  <option value="BER">Bermuda</option>
                  <option value="BTN">Bhutan</option>
                  <option value="BOL">Bolivia</option>
                  <option value="BIH">Bosnia and Herzegowina&nbsp;</option>
                  <option value="BWA">Botswana</option>
                  <option value="BVT">Bouvet Island&nbsp;</option>
                  <option value="BRA">Brasil</option>
                  <option value="IOT">British Indian Ocean Territory&nbsp;</option>
                  <option value="VGB">British Virgin Islands&nbsp;</option>
                  <option value="BRN">Brunei Darussalam&nbsp;</option>
                  <option value="BUL">Bulgaria</option>
                  <option value="BFA">Burkina Faso&nbsp;</option>
                  <option value="BDI">Burundi&nbsp;</option>
                  <option value="KHM">Cambodia&nbsp;</option>
                  <option value="CMR">Cameroon&nbsp;</option>
                  <option value="CAN">Canada</option>
                  <option value="CPV">Cape Verde&nbsp;</option>
                  <option value="CYM">Cayman Islands&nbsp;</option>
                  <option value="CAF">Central African Republic&nbsp;</option>
                  <option value="TCD">Chad&nbsp;</option>
                  <option value="CHL">Chile</option>
                  <option value="CHI">China</option>
                  <option value="CXR">Christmas Island&nbsp;</option>
                  <option value="CCK">Cocos (Keeling) Islands&nbsp;</option>
                  <option value="COL">Colombia</option>
                  <option value="COM">Comoros&nbsp;</option>
                  <option value="COG">Congo&nbsp;</option>
                  <option value="COK">Cook Islands&nbsp;</option>
                  <option value="COS">Costa Rica</option>
                  <option value="CRO">Croatia</option>
                  <option value="CUB">Cuba</option>
                  <option value="CHP">Cyprus</option>
                  <option value="RCH">Czech Republic</option>
                  <option value="COD">Democratic Republic of the Congo</option>
                  <option value="DIN">Denmark</option>
                  <option value="YIB">Djibouti</option>
                  <option value="DOM">Dominica</option>
                  <option value="TLS">East Timor&nbsp;</option>
                  <option value="ECU">Ecuador</option>
                  <option value="EGI">Egypt</option>
                  <option value="ELS">El Salvador</option>
                  <option value="GEC">Equatorial Guinea</option>
                  <option value="ERI">Eritrea&nbsp;</option>
                  <option value="EST">Estonia</option>
                  <option value="ETI">Ethiopia</option>
                  <option value="FLK">Falkland Islands (Malvinas)&nbsp;</option>
                  <option value="FRO">Faroe Islands&nbsp;</option>
                  <option value="FIY">Fiji</option>
                  <option value="FI">Finland</option>
                  <option value="FRA">France</option>
                  <option value="GYF">French Guiana</option>
                  <option value="PYF">French Polynesia&nbsp;</option>
                  <option value="GAB">Gabon</option>
                  <option value="GAM">Gambia</option>
                  <option value="GEO">Georgia</option>
                  <option value="ALE">Germany</option>
                  <option value="GHA">Ghana</option>
                  <option value="GIB">Gibraltar</option>
                  <option value="GRE">Greece</option>
                  <option value="GRL">Greenland&nbsp;</option>
                  <option value="GRD">Grenada&nbsp;</option>
                  <option value="GLP">Guadeloupe&nbsp;</option>
                  <option value="GUM">Guam&nbsp;</option>
                  <option value="GUA">Guatemala</option>
                  <option value="GUY">Guiana</option>
                  <option value="GNA">Guinea</option>
                  <option value="GUI">Guinea-Bissau</option>
                  <option value="HAI">Haiti</option>
                  <option value="HMD">Heard and Mcdonald Islands&nbsp;</option>
                  <option value="HON">Honduras</option>
                  <option value="HKO">Hong Kong</option>
                  <option value="HUN">Hungary</option>
                  <option value="ISL">Iceland</option>
                  <option value="ID">India</option>
                  <option value="IDN">Indonesia</option>
                  <option value="IRN">Iran</option>
                  <option value="IRQ">Iraq</option>
                  <option value="IRL">Ireland</option>
                  <option value="ISR">Israel</option>
                  <option value="ITA">Italy</option>
                  <option value="CIV">Ivory Coast</option>
                  <option value="JAM">Jamaica</option>
                  <option value="JAP">Japan</option>
                  <option value="JOR">Jordan</option>
                  <option value="KAZ">Kazakhstan</option>
                  <option value="KEN">Kenya</option>
                  <option value="KRB">Kiribati</option>
                  <option value="KOR">Korea</option>
                  <option value="KUW">Kuwait</option>
                  <option value="KRG">Kyrgyzstan</option>
                  <option value="LAO">Laos</option>
                  <option value="LAT">Latvia</option>
                  <option value="LIB">Lebanon</option>
                  <option value="LES">Lesotho</option>
                  <option value="LET">Letonia</option>
                  <option value="LBR">Liberia</option>
                  <option value="LBA">Libya</option>
                  <option value="LIE">Liechtenstein</option>
                  <option value="LIT">Lithuania</option>
                  <option value="LUX">Luxembourg</option>
                  <option value="MAC">Macao</option>
                  <option value="MCD">Macedonia</option>
                  <option value="MAD">Madagascar</option>
                  <option value="MLW">Malawi</option>
                  <option value="MAL">Malaysia</option>
                  <option value="MLD">Maldives</option>
                  <option value="MLI">Mali</option>
                  <option value="MLT">Malta</option>
                  <option value="MRS">Marshall Islands</option>
                  <option value="MAR">Martinique</option>
                  <option value="MRT">Mauritania</option>
                  <option value="MRC">Mauritius</option>
                  <option value="MAY">Mayotte</option>
                  <option value="MEX">Mexico</option>
                  <option value="MIC">Micronesia</option>
                  <option value="MOL">Moldova</option>
                  <option value="MON">Monaco</option>
                  <option value="MNG">Mongolia&nbsp;</option>
                  <option value="MSR">Montserrat&nbsp;</option>
                  <option value="MRR">Morocco</option>
                  <option value="MOZ">Mozambique</option>
                  <option value="MMR">Myanmar/Birmania</option>
                  <option value="NAM">Namibia&nbsp;</option>
                  <option value="NRU">Nauru&nbsp;</option>
                  <option value="NEP">Nepal</option>
                  <option value="HOL">Netherlands</option>
                  <option value="NLD">Netherlands</option>
                  <option value="AN">Netherlands Antilles&nbsp;</option>
                  <option value="NCL">New Caledonia&nbsp;</option>
                  <option value="NUE">New Zealand</option>
                  <option value="NIC">Nicaragua</option>
                  <option value="NGA">Nigeria&nbsp;</option>
                  <option value="NER">Niger&nbsp;</option>
                  <option value="NIU">Niue&nbsp;</option>
                  <option value="NFK">Norfolk Island&nbsp;</option>
                  <option value="CRN">North Korea</option>
                  <option value="MNP">Northern Mariana Islands&nbsp;</option>
                  <option value="NOR">Norway</option>
                  <option value="OMN">Oman&nbsp;</option>
                  <option value="PAK">Pakistan</option>
                  <option value="PAL">Palau</option>
                  <option value="PLE">Palestine</option>
                  <option value="PAN">Panama</option>
                  <option value="PNG">Papua New Guinea&nbsp;</option>
                  <option value="PAR">Paraguay</option>
                  <option value="PER">Peru</option>
                  <option value="FIL">Philippines</option>
                  <option value="PCN">Pitcairn&nbsp;</option>
                  <option value="POL">Poland</option>
                  <option value="POR">Portugal</option>
                  <option value="PRI">Puerto Rico</option>
                  <option value="QAT">Qatar&nbsp;</option>
                  <option value="RDO">Republica Dominicana</option>
                  <option value="EU">Reunion&nbsp;</option>
                  <option value="RUM">Romania</option>
                  <option value="RUS">Russia</option>
                  <option value="RWA">Rwanda&nbsp;</option>
                  <option value="SHN">Saint Helena&nbsp;</option>
                  <option value="KNA">Saint Kitts and Nevis&nbsp;</option>
                  <option value="LCA">Saint Lucia&nbsp;</option>
                  <option value="SMP">Saint Pierre and Miquelon&nbsp;</option>
                  <option value="VCT">Saint Vincent and The Grenadines&nbsp;</option>
                  <option value="WSM">Samoa&nbsp;</option>
                  <option value="RSM">San Marino</option>
                  <option value="STP">Sao Tome and Principe&nbsp;</option>
                  <option value="ARA">Saudi Arabia</option>
                  <option value="SEN">Senegal</option>
                  <option value="SER">Serbia</option>
                  <option value="SLE">Sierra Leone&nbsp;</option>
                  <option value="SIN">Singapore</option>
                  <option value="ESQ">Slovakia</option>
                  <option value="ESL">Slovenia</option>
                  <option value="SOM">Somalia&nbsp;</option>
                  <option value="SDA">South Africa</option>
                  <option value="ZAF">South Africa&nbsp;</option>
                  <option value="CRS">South Korea</option>
                  <option value="ESP">Spain</option>
                  <option value="SRI">Sri Lanka</option>
                  <option value="SDN">Sudan&nbsp;</option>
                  <option value="SJM">Svalbard and Jan Mayen Islands&nbsp;</option>
                  <option value="SWZ">Swaziland&nbsp;</option>
                  <option value="SUE">Sweden</option>
                  <option value="SUI">Switzerland</option>
                  <option value="CHE">Switzerland&nbsp;</option>
                  <option value="SYR">Syrian Arab Republic&nbsp;</option>
                  <option value="TAW">Taiwan</option>
                  <option value="TJK">Tajikistan&nbsp;</option>
                  <option value="TAI">Thailand</option>
                  <option value="TGO">Togo&nbsp;</option>
                  <option value="TKL">Tokelau&nbsp;</option>
                  <option value="TON">Tonga&nbsp;</option>
                  <option value="TYT">Trinidad and Tobago</option>
                  <option value="TUN">Tunisia</option>
                  <option value="TUR">Turkey</option>
                  <option value="TKM">Turkmenistan&nbsp;</option>
                  <option value="TCA">Turks and Caicos Islands&nbsp;</option>
                  <option value="TUV">Tuvalu&nbsp;</option>
                  <option value="EUA">USA / United States</option>
                  <option value="UGA">Uganda</option>
                  <option value="UCR">Ukraine</option>
                  <option value="EMI">United Arab Emirates</option>
                  <option value="ING">United Kingdom</option>
                  <option value="GRA">United Kingdom</option>
                  <option value="TZA">United Republic of Tanzania&nbsp;</option>
                  <option value="UMI">United States Minor Outlaying Islands&nbsp;</option>
                  <option value="VIR">United States Virgin Islands&nbsp;</option>
                  <option value="URU">Uruguay</option>
                  <option value="UZB">Uzbekistan&nbsp;</option>
                  <option value="VUT">Vanuatu&nbsp;</option>
                  <option value="VAT">Vatican City</option>
                  <option value="VEN">Venezuela</option>
                  <option value="VIE">Vietnam</option>
                  <option value="WLF">Wallis and Futuna Islands&nbsp;</option>
                  <option value="ESH">Western Sahara&nbsp;</option>
                  <option value="YEM">Yemen</option>
                  <option value="YUG">Yugoslavia</option>
                  <option value="ZAM">Zambia</option>
                  <option value="ZIM">Zimbabwe</option>
                  <option value="AZE">Azerbaijan</option>
                </select>
              </p>
              
              <p>
                <label for="tipo-documento-nino-<?=$i?>">Tipo de documento</label>
                <select id="tipo-documento-nino-<?=$i?>" name="tipo-documento-nino-<?=$i?>">
                  <option value=""></option>
                  <option value="DNI">Tarjeta de identificación</option>
                  <option value="PAS">Pasaporte</option>
                </select>
              </p>

              <p>
                <label for="numero-documento-nino-<?=$i?>">Número de documento</label>
                <input type="text" id="numero-documento-nino-<?=$i?>" name="numero-documento-nino-<?=$i?>">
              </p>
              
              <p>
                <label for="sexo-nino-<?=$i?>">Sexo</label>
                <select id="sexo-nino-<?=$i?>" name="sexo-nino-<?=$i?>">
                  <option value="" ></option>
                  <option value="M">Hombre</option>
                  <option value="F">Mujer</option>
                </select>
              </p>
            </div>
      </div>
      <?php }*/ ?>
    </div> 

    <button class="back-step" type="button" id="back-step-2">Atras</button>
    <button class="next-step" type="button" id="to-step-4">Siguente</button>
  </div>
  <div id="box-data-step-4" class="box-data-step">
    <h3>Paso 4: Finalizar y pagar</h3>
    <div class="box-mensajes-error">
      <p class="mensaje-error" id="error-fecha-ida">El campo fecha ida es obligatorio, por favor vuelve al paso 1 y rellena este campo.</p>
      <p class="mensaje-error" id="error-fecha-vuelta">El campo fecha vuelta es obligatorio, por favor vuelve al paso 1 y rellena este campo.</p>
      <p class="mensaje-error" id="no-adultos-paso-4">Parece que nos has indicado el numero de pasajeros adultos, por favor vuelve al paso 1.</p>
      <p class="mensaje-error" id="error-tren-ida">No has seleccionado un tren de ida, por favor vuelve al paso 2 y selecciona.</p>
      <p class="mensaje-error" id="error-tren-vuelta">No has seleccionado un tren de vuelta, por favor vuelve al paso 2 y selecciona.</p>
      <p class="mensaje-error" id="datos-pasajeros">Todos los campos de pasajeros son obligatorios, por favor vuelve al paso 3 y rellena los datos.</p>
    </div>

    <div class="box-pay">
      <!--
      <div class="select-medio-pago">
        <label for="select-pago">Seleccionar medio de pago</label>
        <select name="select-pago" id="select-pago">
          <?php if (get_option('use_culqi') == 'true') { ?> 
          <option value="culqi">Tarjeta (Credito - Debito)</option>
          <option value="culqi">Efectivo</option>
          <?php } ?>
          <?php if (get_option('use_paypal') == 'true') { ?> 
          <option value="paypal">Paypal</option>
          <?php } ?>
        </select>
      </div>
      -->

      <div class="method-pay" id="culqi">
        <h4>Pagar con Tarjeta (Crédito - Débito)</h4>
        <!--
        <div>
          <label for="nombres">Nombres:</label>
          <input type="text" name="nombres" id="nombres" value="">
        </div>
        <div>
          <label for="apellidos">Apellidos:</label>
          <input type="text" name="apellidos" id="apellidos" value="">
        </div>
        <div>
          <label for="dni">DNI:</label>
          <input type="text" name="dni" id="dni" value="">
        </div>
        <div>
          <label for="telefono">Teléfono</label>
          <input type="text" name="telefono" id="telefono" value="">
        </div>
        <div>
          <label for="email">Email</label>
          <input type="email" name="email" id="email" value="">
        </div>
        <div class="box-mensajes-error">
          <p class="mensaje-error" id="todos-obligatorios">Todos los campos son obligatorios</p>
        </div>
        -->
        <div class="culqi-pay-button">
          <button id="culqui-pagar">Pagar</button>
          <div class="cards">
            <div>
              <img data-card="visa" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCA0MCAyNCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ieE1pbllNaW4gbWVldCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KICA8cGF0aCBkPSJNMCAxLjkyN0MwIC44NjMuODkyIDAgMS45OTIgMGgzNi4wMTZDMzkuMTA4IDAgNDAgLjg2MyA0MCAxLjkyN3YyMC4xNDZDNDAgMjMuMTM3IDM5LjEwOCAyNCAzOC4wMDggMjRIMS45OTJDLjg5MiAyNCAwIDIzLjEzNyAwIDIyLjA3M1YxLjkyN3oiIHN0eWxlPSJmaWxsOiByZ2IoMzMsIDg2LCAxNTQpOyIvPgogIDxwYXRoIGQ9Ik0xOS41OTYgNy44ODVsLTIuMTEgOS40NzhIMTQuOTNsMi4xMS05LjQ3OGgyLjU1NHptMTAuNzQzIDYuMTJsMS4zNDMtMy41Ni43NzMgMy41NkgzMC4zNHptMi44NSAzLjM1OGgyLjM2bC0yLjA2My05LjQ3OEgzMS4zMWMtLjQ5MiAwLS45MDUuMjc0LTEuMDg4LjY5NWwtMy44MzIgOC43ODNoMi42ODJsLjUzMi0xLjQxNWgzLjI3NmwuMzEgMS40MTV6bS02LjY2Ny0zLjA5NGMuMDEtMi41MDItMy42LTIuNjQtMy41NzctMy43Ni4wMDgtLjMzOC4zNDUtLjcgMS4wODMtLjc5My4zNjUtLjA0NSAxLjM3My0uMDggMi41MTcuNDI1bC40NDgtMi4wMWMtLjYxNS0uMjE0LTEuNDA1LS40Mi0yLjM5LS40Mi0yLjUyMyAwLTQuMyAxLjI4OC00LjMxMyAzLjEzMy0uMDE2IDEuMzY0IDEuMjY4IDIuMTI1IDIuMjM0IDIuNTguOTk2LjQ2NCAxLjMzLjc2MiAxLjMyNSAxLjE3Ny0uMDA2LjYzNi0uNzkzLjkxOC0xLjUyNi45MjgtMS4yODUuMDItMi4wMy0uMzMzLTIuNjIzLS42bC0uNDYyIDIuMDhjLjU5OC4yNjIgMS43LjQ5IDIuODQuNTAyIDIuNjgyIDAgNC40MzctMS4yNzMgNC40NDUtMy4yNDN6TTE1Ljk0OCA3Ljg4NGwtNC4xMzggOS40NzhoLTIuN0w3LjA3NiA5LjhjLS4xMjMtLjQ2Ni0uMjMtLjYzNy0uNjA2LS44MzQtLjYxNS0uMzItMS42My0uNjItMi41Mi0uODA2bC4wNi0uMjc1aDQuMzQ1Yy41NTQgMCAxLjA1Mi4zNTQgMS4xNzguOTY2bDEuMDc2IDUuNDg2IDIuNjU1LTYuNDVoMi42ODN6IiBzdHlsZT0iZmlsbDogcmdiKDI1NSwgMjU1LCAyNTUpOyIvPgo8L3N2Zz4=" alt="visa">
            </div>
            <div>
              <img data-card="mastercard" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCA0MCAyNCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ieE1pbllNaW4gbWVldCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KICA8cGF0aCBkPSJNMCAxLjkyN0MwIC44NjMuODkyIDAgMS45OTIgMGgzNi4wMTZDMzkuMTA4IDAgNDAgLjg2MyA0MCAxLjkyN3YyMC4xNDZDNDAgMjMuMTM3IDM5LjEwOCAyNCAzOC4wMDggMjRIMS45OTJDLjg5MiAyNCAwIDIzLjEzNyAwIDIyLjA3M1YxLjkyN3oiIHN0eWxlPSJmaWxsOiByZ2IoNjIsIDU3LCA1Nyk7Ii8+CiAgPHBhdGggc3R5bGU9ImZpbGw6IHJnYigyNTUsIDk1LCAwKTsiIGQ9Ik0gMjIuMjA1IDMuOTAxIEwgMTUuNjg4IDMuOTAxIEwgMTUuNjg4IDE1LjU4OSBMIDIyLjIwNSAxNS41ODkiLz4KICA8cGF0aCBkPSJNIDE2LjEgOS43NDcgQyAxNi4xIDcuMzcxIDE3LjIxOCA1LjI2NSAxOC45MzUgMy45MDEgQyAxNy42NyAyLjkxMiAxNi4wNzggMi4zMTIgMTQuMzQyIDIuMzEyIEMgMTAuMjIzIDIuMzEyIDYuODkyIDUuNjM2IDYuODkyIDkuNzQ2IEMgNi44OTIgMTMuODUzIDEwLjIyMyAxNy4xNzggMTQuMzQyIDE3LjE3OCBDIDE2LjA3OCAxNy4xNzggMTcuNjcgMTYuNTggMTguOTM1IDE1LjU4OCBDIDE3LjIxNiAxNC4yNDYgMTYuMDk5IDEyLjExOSAxNi4wOTkgOS43NDUgWiIgc3R5bGU9ImZpbGw6IHJnYigyMzUsIDAsIDI3KTsiLz4KICA8cGF0aCBkPSJNIDMwLjk5NiA5Ljc0NyBDIDMwLjk5NiAxMy44NTQgMjcuNjYzIDE3LjE3OSAyMy41NDcgMTcuMTc5IEMgMjEuODEgMTcuMTc5IDIwLjIxNiAxNi41ODEgMTguOTU0IDE1LjU4OSBDIDIwLjY5MSAxNC4yMjcgMjEuNzg4IDEyLjEyIDIxLjc4OCA5Ljc0NiBDIDIxLjc4OCA3LjM3IDIwLjY3MSA1LjI2NCAxOC45NTQgMy45IEMgMjAuMjE2IDIuOTExIDIxLjgxIDIuMzExIDIzLjU0NyAyLjMxMSBDIDI3LjY2MyAyLjMxMSAzMC45OTYgNS42NTcgMzAuOTk2IDkuNzQ1IFoiIHN0eWxlPSJmaWxsOiByZ2IoMjQ3LCAxNTgsIDI3KTsiLz4KICA8cGF0aCBkPSJNIDcuMTY3IDIyLjQ4MSBMIDcuMTY3IDIwLjQzIEMgNy4xNjcgMTkuNjQxIDYuNjg1IDE5LjEyNyA1Ljg1NyAxOS4xMjcgQyA1LjQ0MyAxOS4xMjcgNC45OTMgMTkuMjYyIDQuNjgzIDE5LjcxIEMgNC40NCAxOS4zMzIgNC4wOTYgMTkuMTI3IDMuNTc5IDE5LjEyNyBDIDMuMjMzIDE5LjEyNyAyLjg4OCAxOS4yMyAyLjYxMiAxOS42MDcgTCAyLjYxMiAxOS4xOTcgTCAxLjg4NiAxOS4xOTcgTCAxLjg4NiAyMi40ODEgTCAyLjYxMiAyMi40ODEgTCAyLjYxMiAyMC42NjggQyAyLjYxMiAyMC4wODYgMi45MjEgMTkuODEyIDMuNDA2IDE5LjgxMiBDIDMuODg4IDE5LjgxMiA0LjEzMSAyMC4xMjEgNC4xMzEgMjAuNjY5IEwgNC4xMzEgMjIuNDgxIEwgNC44NTYgMjIuNDgxIEwgNC44NTYgMjAuNjY4IEMgNC44NTYgMjAuMDg2IDUuMjA0IDE5LjgxMiA1LjY1MSAxOS44MTIgQyA2LjEzNyAxOS44MTIgNi4zNzcgMjAuMTIxIDYuMzc3IDIwLjY2OSBMIDYuMzc3IDIyLjQ4MSBMIDcuMTcxIDIyLjQ4MSBaIE0gMTcuOTA5IDE5LjE5NyBMIDE2LjczNCAxOS4xOTcgTCAxNi43MzQgMTguMjA0IEwgMTYuMDA3IDE4LjIwNCBMIDE2LjAwNyAxOS4xOTcgTCAxNS4zNTIgMTkuMTk3IEwgMTUuMzUyIDE5Ljg0NSBMIDE2LjAwNyAxOS44NDUgTCAxNi4wMDcgMjEuMzUxIEMgMTYuMDA3IDIyLjEwNiAxNi4zMTkgMjIuNTUxIDE3LjE0NiAyMi41NTEgQyAxNy40NTkgMjIuNTUxIDE3LjgwNCAyMi40NDkgMTguMDQ0IDIyLjMwOSBMIDE3LjgzOSAyMS42OTUgQyAxNy42MzIgMjEuODMxIDE3LjM4OSAyMS44NjcgMTcuMjE2IDIxLjg2NyBDIDE2Ljg3MiAyMS44NjcgMTYuNzM0IDIxLjY2IDE2LjczNCAyMS4zMTkgTCAxNi43MzQgMTkuODQ3IEwgMTcuOTA5IDE5Ljg0NyBMIDE3LjkwOSAxOS4xOTggWiBNIDI0LjA1MyAxOS4xMjcgQyAyMy42MzkgMTkuMTI3IDIzLjM2NCAxOS4zMzIgMjMuMTkxIDE5LjYwNyBMIDIzLjE5MSAxOS4xOTcgTCAyMi40NjUgMTkuMTk3IEwgMjIuNDY1IDIyLjQ4MSBMIDIzLjE5MSAyMi40ODEgTCAyMy4xOTEgMjAuNjMzIEMgMjMuMTkxIDIwLjA4NiAyMy40MzQgMTkuNzc3IDIzLjg4MiAxOS43NzcgQyAyNC4wMTggMTkuNzc3IDI0LjE5MiAxOS44MTIgMjQuMzMgMTkuODQ3IEwgMjQuNTM4IDE5LjE2MiBDIDI0LjQwMSAxOS4xMjcgMjQuMTkyIDE5LjEyNyAyNC4wNTIgMTkuMTI3IFogTSAxNC43NjUgMTkuNDY5IEMgMTQuNDIgMTkuMjI5IDEzLjkzNyAxOS4xMjcgMTMuNDE4IDE5LjEyNyBDIDEyLjU4OCAxOS4xMjcgMTIuMDM2IDE5LjUzOCAxMi4wMzYgMjAuMTg4IEMgMTIuMDM2IDIwLjczNiAxMi40NTMgMjEuMDQ0IDEzLjE3NSAyMS4xNDYgTCAxMy41MjQgMjEuMTgxIEMgMTMuOTAzIDIxLjI0OSAxNC4xMDggMjEuMzUxIDE0LjEwOCAyMS41MjMgQyAxNC4xMDggMjEuNzY1IDEzLjgzMiAyMS45MzQgMTMuMzUgMjEuOTM0IEMgMTIuODY0IDIxLjkzNCAxMi40ODQgMjEuNzY0IDEyLjI0NCAyMS41OTIgTCAxMS44OTggMjIuMTM5IEMgMTIuMjc4IDIyLjQxMSAxMi43OTQgMjIuNTQ5IDEzLjMxMyAyMi41NDkgQyAxNC4yOCAyMi41NDkgMTQuODMxIDIyLjEwNSAxNC44MzEgMjEuNDg4IEMgMTQuODMxIDIwLjkwOCAxNC4zODMgMjAuNTk5IDEzLjY5MiAyMC40OTYgTCAxMy4zNDggMjAuNDYyIEMgMTMuMDM3IDIwLjQyOCAxMi43OTUgMjAuMzYgMTIuNzk1IDIwLjE1NSBDIDEyLjc5NSAxOS45MTQgMTMuMDM4IDE5Ljc3NyAxMy40MTggMTkuNzc3IEMgMTMuODMgMTkuNzc3IDE0LjI0NSAxOS45NDkgMTQuNDUzIDIwLjA1MiBMIDE0Ljc2NCAxOS40NjkgWiBNIDM0LjAzMyAxOS4xMjcgQyAzMy42MTggMTkuMTI3IDMzLjM0MiAxOS4zMzIgMzMuMTcxIDE5LjYwNyBMIDMzLjE3MSAxOS4xOTcgTCAzMi40NDUgMTkuMTk3IEwgMzIuNDQ1IDIyLjQ4MSBMIDMzLjE3MSAyMi40ODEgTCAzMy4xNzEgMjAuNjMzIEMgMzMuMTcxIDIwLjA4NiAzMy40MTQgMTkuNzc3IDMzLjg2MiAxOS43NzcgQyAzMy45OTggMTkuNzc3IDM0LjE3IDE5LjgxMiAzNC4zMDcgMTkuODQ3IEwgMzQuNTE1IDE5LjE2MiBDIDM0LjM4IDE5LjEyNyAzNC4xNzIgMTkuMTI3IDM0LjAzMyAxOS4xMjcgWiBNIDI0Ljc3OSAyMC44MzggQyAyNC43NzkgMjEuODM0IDI1LjQ3IDIyLjU1MSAyNi41NCAyMi41NTEgQyAyNy4wMjUgMjIuNTUxIDI3LjM2OSAyMi40NDkgMjcuNzE1IDIyLjE3MyBMIDI3LjM2OSAyMS41OTMgQyAyNy4wOTIgMjEuNzk4IDI2LjgxNiAyMS45MDEgMjYuNTA0IDIxLjkwMSBDIDI1LjkxOSAyMS45MDEgMjUuNTA1IDIxLjQ5IDI1LjUwNSAyMC44NCBDIDI1LjUwNSAyMC4yMjYgMjUuOTE5IDE5LjgxMyAyNi41MDcgMTkuNzggQyAyNi44MTYgMTkuNzggMjcuMDkyIDE5Ljg4MyAyNy4zNjkgMjAuMDg5IEwgMjcuNzE1IDE5LjUwNyBDIDI3LjM2OSAxOS4yMzMgMjcuMDI0IDE5LjEzIDI2LjU0IDE5LjEzIEMgMjUuNDcgMTkuMTMgMjQuNzc5IDE5Ljg1IDI0Ljc3OSAyMC44NDEgWiBNIDMxLjQ3OCAyMC44MzggTCAzMS40NzggMTkuMTk4IEwgMzAuNzUgMTkuMTk4IEwgMzAuNzUgMTkuNjA4IEMgMzAuNTEgMTkuMyAzMC4xNjUgMTkuMTI4IDI5LjcxNyAxOS4xMjggQyAyOC43ODQgMTkuMTI4IDI4LjA1OCAxOS44NDggMjguMDU4IDIwLjg0IEMgMjguMDU4IDIxLjgzNSAyOC43ODQgMjIuNTUyIDI5LjcxNiAyMi41NTIgQyAzMC4xOTcgMjIuNTUyIDMwLjU0MyAyMi4zODIgMzAuNzQ4IDIyLjA3NCBMIDMwLjc0OCAyMi40ODQgTCAzMS40NzcgMjIuNDg0IEwgMzEuNDc3IDIwLjg0IFogTSAyOC44MTggMjAuODM4IEMgMjguODE4IDIwLjI1OSAyOS4xOTYgMTkuNzc5IDI5LjgxOSAxOS43NzkgQyAzMC40MDYgMTkuNzc5IDMwLjgyMSAyMC4yMjQgMzAuODIxIDIwLjg0IEMgMzAuODIxIDIxLjQyNCAzMC40MDYgMjEuOTAyIDI5LjgxOSAyMS45MDIgQyAyOS4xOTYgMjEuODY5IDI4LjgxOCAyMS40MjQgMjguODE4IDIwLjg0MSBaIE0gMjAuMTQ4IDE5LjEyOCBDIDE5LjE4MyAxOS4xMjggMTguNDk0IDE5LjgxMyAxOC40OTQgMjAuODQgQyAxOC40OTQgMjEuODY5IDE5LjE4MyAyMi41NTIgMjAuMTg1IDIyLjU1MiBDIDIwLjY3MSAyMi41NTIgMjEuMTU0IDIyLjQxNyAyMS41MzMgMjIuMTA4IEwgMjEuMTg4IDIxLjU5NSBDIDIwLjkxNCAyMS43OTkgMjAuNTY1IDIxLjkzNyAyMC4yMjIgMjEuOTM3IEMgMTkuNzcyIDIxLjkzNyAxOS4zMjMgMjEuNzMyIDE5LjIxOSAyMS4xNDkgTCAyMS42NzEgMjEuMTQ5IEwgMjEuNjcxIDIwLjg3OCBDIDIxLjcwNSAxOS44MTUgMjEuMDgzIDE5LjEzIDIwLjE1IDE5LjEzIFogTSAyMC4xNDggMTkuNzQ4IEMgMjAuNiAxOS43NDggMjAuOTExIDIwLjAxOSAyMC45OCAyMC41MzIgTCAxOS4yNTMgMjAuNTMyIEMgMTkuMzIxIDIwLjA4NyAxOS42MzMgMTkuNzQ4IDIwLjE0OCAxOS43NDggWiBNIDM4LjE0MSAyMC44NCBMIDM4LjE0MSAxNy44OTggTCAzNy40MTIgMTcuODk4IEwgMzcuNDEyIDE5LjYxIEMgMzcuMTczIDE5LjMwMiAzNi44MjggMTkuMTMgMzYuMzggMTkuMTMgQyAzNS40NDYgMTkuMTMgMzQuNzIxIDE5Ljg1IDM0LjcyMSAyMC44NDEgQyAzNC43MjEgMjEuODM3IDM1LjQ0NiAyMi41NTQgMzYuMzc5IDIyLjU1NCBDIDM2Ljg2MSAyMi41NTQgMzcuMjA2IDIyLjM4MyAzNy40MSAyMi4wNzYgTCAzNy40MSAyMi40ODYgTCAzOC4xNCAyMi40ODYgTCAzOC4xNCAyMC44NDEgWiBNIDM1LjQ4MSAyMC44NCBDIDM1LjQ4MSAyMC4yNjEgMzUuODYxIDE5Ljc4IDM2LjQ4NCAxOS43OCBDIDM3LjA2OSAxOS43OCAzNy40ODYgMjAuMjI2IDM3LjQ4NiAyMC44NDEgQyAzNy40ODYgMjEuNDI2IDM3LjA2OSAyMS45MDQgMzYuNDg0IDIxLjkwNCBDIDM1Ljg2MSAyMS44NyAzNS40ODEgMjEuNDI2IDM1LjQ4MSAyMC44NDMgWiBNIDExLjIzNyAyMC44NCBMIDExLjIzNyAxOS4yIEwgMTAuNTE1IDE5LjIgTCAxMC41MTUgMTkuNjEgQyAxMC4yNzIgMTkuMzAyIDkuOTI4IDE5LjEzIDkuNDc4IDE5LjEzIEMgOC41NDUgMTkuMTMgNy44MiAxOS44NSA3LjgyIDIwLjg0MSBDIDcuODIgMjEuODM3IDguNTQ1IDIyLjU1NCA5LjQ3NyAyMi41NTQgQyA5Ljk2IDIyLjU1NCAxMC4zMDQgMjIuMzgzIDEwLjUxMiAyMi4wNzYgTCAxMC41MTIgMjIuNDg2IEwgMTEuMjM2IDIyLjQ4NiBMIDExLjIzNiAyMC44NDEgWiBNIDguNTQ2IDIwLjg0IEMgOC41NDYgMjAuMjYxIDguOTI2IDE5Ljc4IDkuNTQ4IDE5Ljc4IEMgMTAuMTM0IDE5Ljc4IDEwLjU1IDIwLjIyNiAxMC41NSAyMC44NDEgQyAxMC41NSAyMS40MjYgMTAuMTM0IDIxLjkwNCA5LjU0OCAyMS45MDQgQyA4LjkyNiAyMS44NyA4LjU0NiAyMS40MjYgOC41NDYgMjAuODQzIFoiIHN0eWxlPSJmaWxsOiByZ2IoMjU1LCAyNTUsIDI1NSk7Ii8+Cjwvc3ZnPg==" alt="mastercard">
            </div>
            <div>
              <img data-card="amex" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCA0MCAyNCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ieE1pbllNaW4gbWVldCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KICA8cGF0aCBkPSJNMzguMzMzIDI0SDEuNjY3Qy43NSAyNCAwIDIzLjI4IDAgMjIuNFYxLjZDMCAuNzIuNzUgMCAxLjY2NyAwaDM2LjY2NkMzOS4yNSAwIDQwIC43MiA0MCAxLjZ2MjAuOGMwIC44OC0uNzUgMS42LTEuNjY3IDEuNnoiIHN0eWxlPSJmaWxsOiByZ2IoMjAsIDExOSwgMTkwKTsiLz4KICA8cGF0aCBkPSJNNi4yNiAxMi4zMmgyLjMxM0w3LjQxNSA5LjY2TTI3LjM1MyA5Ljk3N2gtMy43Mzh2MS4yM2gzLjY2NnYxLjM4NGgtMy42NzV2MS4zODVoMy44MjF2MS4wMDVjLjYyMy0uNzcgMS4zMy0xLjQ2NiAyLjAyNS0yLjIzNWwuNzA3LS43N2MtLjkzNC0xLjAwNC0xLjg3LTIuMDgtMi44MDQtMy4wNzV2MS4wNzd6IiBzdHlsZT0iZmlsbDogcmdiKDI1NSwgMjU1LCAyNTUpOyIvPgogIDxwYXRoIGQ9Ik0zOC4yNSA3aC01LjYwNWwtMS4zMjggMS40TDMwLjA3MiA3SDE2Ljk4NGwtMS4wMTcgMi40MTZMMTQuODc3IDdoLTkuNThMMS4yNSAxNi41aDQuODI2bC42MjMtMS41NTZoMS40bC42MjMgMS41NTZIMjkuOTlsMS4zMjctMS40ODMgMS4zMjggMS40ODNoNS42MDVsLTQuMzYtNC42NjdMMzguMjUgN3ptLTE3LjY4NSA4LjFoLTEuNTU3VjkuODgzTDE2LjY3MyAxNS4xaC0xLjMzTDEzLjAxIDkuODgzbC0uMDg0IDUuMjE3SDkuNzNsLS42MjMtMS41NTZoLTMuMjdMNS4xMzIgMTUuMUgzLjQybDIuODg0LTYuNzcyaDIuNDJsMi42NDUgNi4yMzNWOC4zM2gyLjY0NmwyLjEwNyA0LjUxIDEuODY4LTQuNTFoMi41NzVWMTUuMXptMTQuNzI3IDBoLTIuMDI0bC0yLjAyNC0yLjI2LTIuMDIzIDIuMjZIMjIuMDZWOC4zMjhIMjkuNTNsMS43OTUgMi4xNzcgMi4wMjQtMi4xNzdoMi4wMjVMMzIuMjYgMTEuNzVsMy4wMzIgMy4zNXoiIHN0eWxlPSJmaWxsOiByZ2IoMjU1LCAyNTUsIDI1NSk7Ii8+Cjwvc3ZnPg==" alt="amex">
            </div>
          </div>
        </div>
      </div>

      <div class="method-pay" id="paypal">
        <h4>Pagar a traves de Paypal</h4>
        <div id="paypal-button-container"></div>
      </div>
    </div>

    <!--<button class="back-step" type="button" id="back-step-3">Atras</button>-->
  </div>

</form>
<form action="<?=get_site_url().'/'.get_option('completed_page')?>" method="post" id="go-fo-finally">
  <input type="hidden" id="all-reserve-data" name="all-reserve-data" value=''>
</form>