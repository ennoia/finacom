<?php
namespace PHPMaker2019\Finacom;

// Menu Language
if ($Language && $Language->LanguageFolder == $LANGUAGE_FOLDER)
	$MenuLanguage = &$Language;
else
	$MenuLanguage = new Language();

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
$topMenu->addMenuItem(12, "mci_Administración", $MenuLanguage->MenuPhrase("12", "MenuText"), "", -1, "", IsLoggedIn(), TRUE, TRUE, "", "", TRUE);
$topMenu->addMenuItem(7, "mi_audittrail", $MenuLanguage->MenuPhrase("7", "MenuText"), "audittraillist.php", 12, "", AllowListMenu('{DE7733FD-5E8C-4B2A-908C-9F9564113BFC}audittrail'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(17, "mi_bitacora_factura", $MenuLanguage->MenuPhrase("17", "MenuText"), "bitacora_facturalist.php", 12, "", AllowListMenu('{DE7733FD-5E8C-4B2A-908C-9F9564113BFC}bitacora_factura'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(1, "mi_parametros", $MenuLanguage->MenuPhrase("1", "MenuText"), "parametroslist.php", 12, "", AllowListMenu('{DE7733FD-5E8C-4B2A-908C-9F9564113BFC}parametros'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(11, "mi_userlevels", $MenuLanguage->MenuPhrase("11", "MenuText"), "userlevelslist.php", 12, "", AllowListMenu('{DE7733FD-5E8C-4B2A-908C-9F9564113BFC}userlevels'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(9, "mi_users", $MenuLanguage->MenuPhrase("9", "MenuText"), "userslist.php", 12, "", AllowListMenu('{DE7733FD-5E8C-4B2A-908C-9F9564113BFC}users'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(10, "mi_userlevelpermissions", $MenuLanguage->MenuPhrase("10", "MenuText"), "userlevelpermissionslist.php", 12, "", AllowListMenu('{DE7733FD-5E8C-4B2A-908C-9F9564113BFC}userlevelpermissions'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(35, "mci_Catalogos", $MenuLanguage->MenuPhrase("35", "MenuText"), "", 12, "", TRUE, FALSE, TRUE, "", "", TRUE);
$topMenu->addMenuItem(22, "mi_cestadofactura", $MenuLanguage->MenuPhrase("22", "MenuText"), "cestadofacturalist.php", 35, "", AllowListMenu('{DE7733FD-5E8C-4B2A-908C-9F9564113BFC}cestadofactura'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(15, "mi_cplazo", $MenuLanguage->MenuPhrase("15", "MenuText"), "cplazolist.php", 35, "", AllowListMenu('{DE7733FD-5E8C-4B2A-908C-9F9564113BFC}cplazo'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(16, "mi_cedopreafiliacion", $MenuLanguage->MenuPhrase("16", "MenuText"), "cedopreafiliacionlist.php", 35, "", AllowListMenu('{DE7733FD-5E8C-4B2A-908C-9F9564113BFC}cedopreafiliacion'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(19, "mi_cedooperacionpyme", $MenuLanguage->MenuPhrase("19", "MenuText"), "cedooperacionpymelist.php", 35, "", AllowListMenu('{DE7733FD-5E8C-4B2A-908C-9F9564113BFC}cedooperacionpyme'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(20, "mi_ccalificacion", $MenuLanguage->MenuPhrase("20", "MenuText"), "ccalificacionlist.php", 35, "", AllowListMenu('{DE7733FD-5E8C-4B2A-908C-9F9564113BFC}ccalificacion'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(21, "mi_cestadosolicitud", $MenuLanguage->MenuPhrase("21", "MenuText"), "cestadosolicitudlist.php", 35, "", AllowListMenu('{DE7733FD-5E8C-4B2A-908C-9F9564113BFC}cestadosolicitud'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(53, "mci_Compradores", $MenuLanguage->MenuPhrase("53", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "", "", TRUE);
$topMenu->addMenuItem(6, "mi_comprador", $MenuLanguage->MenuPhrase("6", "MenuText"), "compradorlist.php", 53, "", AllowListMenu('{DE7733FD-5E8C-4B2A-908C-9F9564113BFC}comprador'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(14, "mi_preafiliacion", $MenuLanguage->MenuPhrase("14", "MenuText"), "preafiliacionlist.php", 6, "", AllowListMenu('{DE7733FD-5E8C-4B2A-908C-9F9564113BFC}preafiliacion'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(54, "mi_prefiliacionproc", $MenuLanguage->MenuPhrase("54", "MenuText"), "prefiliacionproclist.php", 6, "", AllowListMenu('{DE7733FD-5E8C-4B2A-908C-9F9564113BFC}prefiliacionproc'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(52, "mci_Fondeadores", $MenuLanguage->MenuPhrase("52", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "", "", TRUE);
$topMenu->addMenuItem(5, "mi_fondeador", $MenuLanguage->MenuPhrase("5", "MenuText"), "fondeadorlist.php", 52, "", AllowListMenu('{DE7733FD-5E8C-4B2A-908C-9F9564113BFC}fondeador'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(3, "mi_oferta", $MenuLanguage->MenuPhrase("3", "MenuText"), "ofertalist.php", 5, "", AllowListMenu('{DE7733FD-5E8C-4B2A-908C-9F9564113BFC}oferta'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(51, "mci_Pymes", $MenuLanguage->MenuPhrase("51", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "", "", TRUE);
$topMenu->addMenuItem(4, "mi_pyme", $MenuLanguage->MenuPhrase("4", "MenuText"), "pymelist.php", 51, "", AllowListMenu('{DE7733FD-5E8C-4B2A-908C-9F9564113BFC}pyme'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(2, "mi_factura", $MenuLanguage->MenuPhrase("2", "MenuText"), "facturalist.php", 4, "", AllowListMenu('{DE7733FD-5E8C-4B2A-908C-9F9564113BFC}factura'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(23, "mi_solicitud_fondeo", $MenuLanguage->MenuPhrase("23", "MenuText"), "solicitud_fondeolist.php", 4, "", AllowListMenu('{DE7733FD-5E8C-4B2A-908C-9F9564113BFC}solicitud_fondeo'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(18, "mi_fondeadorfactura", $MenuLanguage->MenuPhrase("18", "MenuText"), "fondeadorfacturalist.php", 4, "", AllowListMenu('{DE7733FD-5E8C-4B2A-908C-9F9564113BFC}fondeadorfactura'), FALSE, FALSE, "", "", TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(12, "mci_Administración", $MenuLanguage->MenuPhrase("12", "MenuText"), "", -1, "", IsLoggedIn(), TRUE, TRUE, "", "", TRUE);
$sideMenu->addMenuItem(7, "mi_audittrail", $MenuLanguage->MenuPhrase("7", "MenuText"), "audittraillist.php", 12, "", AllowListMenu('{DE7733FD-5E8C-4B2A-908C-9F9564113BFC}audittrail'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(17, "mi_bitacora_factura", $MenuLanguage->MenuPhrase("17", "MenuText"), "bitacora_facturalist.php", 12, "", AllowListMenu('{DE7733FD-5E8C-4B2A-908C-9F9564113BFC}bitacora_factura'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(1, "mi_parametros", $MenuLanguage->MenuPhrase("1", "MenuText"), "parametroslist.php", 12, "", AllowListMenu('{DE7733FD-5E8C-4B2A-908C-9F9564113BFC}parametros'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(11, "mi_userlevels", $MenuLanguage->MenuPhrase("11", "MenuText"), "userlevelslist.php", 12, "", AllowListMenu('{DE7733FD-5E8C-4B2A-908C-9F9564113BFC}userlevels'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(9, "mi_users", $MenuLanguage->MenuPhrase("9", "MenuText"), "userslist.php", 12, "", AllowListMenu('{DE7733FD-5E8C-4B2A-908C-9F9564113BFC}users'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(10, "mi_userlevelpermissions", $MenuLanguage->MenuPhrase("10", "MenuText"), "userlevelpermissionslist.php", 12, "", AllowListMenu('{DE7733FD-5E8C-4B2A-908C-9F9564113BFC}userlevelpermissions'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(35, "mci_Catalogos", $MenuLanguage->MenuPhrase("35", "MenuText"), "", 12, "", TRUE, FALSE, TRUE, "", "", TRUE);
$sideMenu->addMenuItem(22, "mi_cestadofactura", $MenuLanguage->MenuPhrase("22", "MenuText"), "cestadofacturalist.php", 35, "", AllowListMenu('{DE7733FD-5E8C-4B2A-908C-9F9564113BFC}cestadofactura'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(15, "mi_cplazo", $MenuLanguage->MenuPhrase("15", "MenuText"), "cplazolist.php", 35, "", AllowListMenu('{DE7733FD-5E8C-4B2A-908C-9F9564113BFC}cplazo'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(16, "mi_cedopreafiliacion", $MenuLanguage->MenuPhrase("16", "MenuText"), "cedopreafiliacionlist.php", 35, "", AllowListMenu('{DE7733FD-5E8C-4B2A-908C-9F9564113BFC}cedopreafiliacion'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(19, "mi_cedooperacionpyme", $MenuLanguage->MenuPhrase("19", "MenuText"), "cedooperacionpymelist.php", 35, "", AllowListMenu('{DE7733FD-5E8C-4B2A-908C-9F9564113BFC}cedooperacionpyme'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(20, "mi_ccalificacion", $MenuLanguage->MenuPhrase("20", "MenuText"), "ccalificacionlist.php", 35, "", AllowListMenu('{DE7733FD-5E8C-4B2A-908C-9F9564113BFC}ccalificacion'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(21, "mi_cestadosolicitud", $MenuLanguage->MenuPhrase("21", "MenuText"), "cestadosolicitudlist.php", 35, "", AllowListMenu('{DE7733FD-5E8C-4B2A-908C-9F9564113BFC}cestadosolicitud'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(53, "mci_Compradores", $MenuLanguage->MenuPhrase("53", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "", "", TRUE);
$sideMenu->addMenuItem(6, "mi_comprador", $MenuLanguage->MenuPhrase("6", "MenuText"), "compradorlist.php", 53, "", AllowListMenu('{DE7733FD-5E8C-4B2A-908C-9F9564113BFC}comprador'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(14, "mi_preafiliacion", $MenuLanguage->MenuPhrase("14", "MenuText"), "preafiliacionlist.php", 6, "", AllowListMenu('{DE7733FD-5E8C-4B2A-908C-9F9564113BFC}preafiliacion'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(54, "mi_prefiliacionproc", $MenuLanguage->MenuPhrase("54", "MenuText"), "prefiliacionproclist.php", 6, "", AllowListMenu('{DE7733FD-5E8C-4B2A-908C-9F9564113BFC}prefiliacionproc'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(52, "mci_Fondeadores", $MenuLanguage->MenuPhrase("52", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "", "", TRUE);
$sideMenu->addMenuItem(5, "mi_fondeador", $MenuLanguage->MenuPhrase("5", "MenuText"), "fondeadorlist.php", 52, "", AllowListMenu('{DE7733FD-5E8C-4B2A-908C-9F9564113BFC}fondeador'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(3, "mi_oferta", $MenuLanguage->MenuPhrase("3", "MenuText"), "ofertalist.php", 5, "", AllowListMenu('{DE7733FD-5E8C-4B2A-908C-9F9564113BFC}oferta'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(51, "mci_Pymes", $MenuLanguage->MenuPhrase("51", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "", "", TRUE);
$sideMenu->addMenuItem(4, "mi_pyme", $MenuLanguage->MenuPhrase("4", "MenuText"), "pymelist.php", 51, "", AllowListMenu('{DE7733FD-5E8C-4B2A-908C-9F9564113BFC}pyme'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(2, "mi_factura", $MenuLanguage->MenuPhrase("2", "MenuText"), "facturalist.php", 4, "", AllowListMenu('{DE7733FD-5E8C-4B2A-908C-9F9564113BFC}factura'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(23, "mi_solicitud_fondeo", $MenuLanguage->MenuPhrase("23", "MenuText"), "solicitud_fondeolist.php", 4, "", AllowListMenu('{DE7733FD-5E8C-4B2A-908C-9F9564113BFC}solicitud_fondeo'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(18, "mi_fondeadorfactura", $MenuLanguage->MenuPhrase("18", "MenuText"), "fondeadorfacturalist.php", 4, "", AllowListMenu('{DE7733FD-5E8C-4B2A-908C-9F9564113BFC}fondeadorfactura'), FALSE, FALSE, "", "", TRUE);
echo $sideMenu->toScript();
?>