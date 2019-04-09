<?php
/*
  Plugin Name: Reserve Train
  Plugin URI: https://www.ovidiojosearteaga.com
  Description: Plugin para manejo y gestion de reserva de trenes
  Version: 1.0
  Author: Ovidio Jose Arteaga
  Author URI: https://www.ovidiojosearteaga.com
  License: GPLv2 or later
*/

include "includes/AddCssAndJs.php";
include "includes/FormReserve.php";
include "includes/DataReserve.php";
include "includes/CPTReserva.php";
include "includes/CPTTrenes.php";
include "includes/TrenesTaxonomies.php";
include "includes/MB_Trenes.php";
include "includes/MB_Reservas.php";
include "includes/ConfigReserva.php";
include "includes/CulqiForm.php";
include "includes/PayFinally.php";
include "includes/SendMail.php";

include "helpers/ajaxcalls.php";

CPTReserva::getSelfObject();
CPTTrenes::getSelfObject();
TrenesTaxonomies::getSelfObject();
MB_Trenes::getSelfObject();
MB_Reservas::getSelfObject();

AddCssAndJs::getSelfObject();
FormReserve::getSelfObject();
DataReserve::getSelfObject();
ConfigReserva::getSelfObject();
CulqiForm::getSelfObject();
PayFinally::getSelfObject();

