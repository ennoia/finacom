<?php
namespace PHPMaker2019\Finacom;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start(); 

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$Facturas_Pyme_view = new Facturas_Pyme_view();

// Run the page
$Facturas_Pyme_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Facturas_Pyme_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$Facturas_Pyme->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fFacturas_Pymeview = currentForm = new ew.Form("fFacturas_Pymeview", "view");

// Form_CustomValidate event
fFacturas_Pymeview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fFacturas_Pymeview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$Facturas_Pyme->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Facturas_Pyme_view->ExportOptions->render("body") ?>
<?php $Facturas_Pyme_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Facturas_Pyme_view->showPageHeader(); ?>
<?php
$Facturas_Pyme_view->showMessage();
?>
<?php if (!$Facturas_Pyme_view->IsModal) { ?>
<?php if (!$Facturas_Pyme->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($Facturas_Pyme_view->Pager)) $Facturas_Pyme_view->Pager = new NumericPager($Facturas_Pyme_view->StartRec, $Facturas_Pyme_view->DisplayRecs, $Facturas_Pyme_view->TotalRecs, $Facturas_Pyme_view->RecRange, $Facturas_Pyme_view->AutoHidePager) ?>
<?php if ($Facturas_Pyme_view->Pager->RecordCount > 0 && $Facturas_Pyme_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($Facturas_Pyme_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $Facturas_Pyme_view->pageUrl() ?>start=<?php echo $Facturas_Pyme_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($Facturas_Pyme_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $Facturas_Pyme_view->pageUrl() ?>start=<?php echo $Facturas_Pyme_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($Facturas_Pyme_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $Facturas_Pyme_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($Facturas_Pyme_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $Facturas_Pyme_view->pageUrl() ?>start=<?php echo $Facturas_Pyme_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($Facturas_Pyme_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $Facturas_Pyme_view->pageUrl() ?>start=<?php echo $Facturas_Pyme_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fFacturas_Pymeview" id="fFacturas_Pymeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Facturas_Pyme_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $Facturas_Pyme_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Facturas_Pyme">
<input type="hidden" name="modal" value="<?php echo (int)$Facturas_Pyme_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Facturas_Pyme->rfcfactura->Visible) { // rfcfactura ?>
	<tr id="r_rfcfactura">
		<td class="<?php echo $Facturas_Pyme_view->TableLeftColumnClass ?>"><span id="elh_Facturas_Pyme_rfcfactura"><?php echo $Facturas_Pyme->rfcfactura->caption() ?></span></td>
		<td data-name="rfcfactura"<?php echo $Facturas_Pyme->rfcfactura->cellAttributes() ?>>
<span id="el_Facturas_Pyme_rfcfactura">
<span<?php echo $Facturas_Pyme->rfcfactura->viewAttributes() ?>>
<?php echo $Facturas_Pyme->rfcfactura->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Facturas_Pyme->idfactura->Visible) { // idfactura ?>
	<tr id="r_idfactura">
		<td class="<?php echo $Facturas_Pyme_view->TableLeftColumnClass ?>"><span id="elh_Facturas_Pyme_idfactura"><?php echo $Facturas_Pyme->idfactura->caption() ?></span></td>
		<td data-name="idfactura"<?php echo $Facturas_Pyme->idfactura->cellAttributes() ?>>
<span id="el_Facturas_Pyme_idfactura">
<span<?php echo $Facturas_Pyme->idfactura->viewAttributes() ?>>
<?php echo $Facturas_Pyme->idfactura->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Facturas_Pyme->monto->Visible) { // monto ?>
	<tr id="r_monto">
		<td class="<?php echo $Facturas_Pyme_view->TableLeftColumnClass ?>"><span id="elh_Facturas_Pyme_monto"><?php echo $Facturas_Pyme->monto->caption() ?></span></td>
		<td data-name="monto"<?php echo $Facturas_Pyme->monto->cellAttributes() ?>>
<span id="el_Facturas_Pyme_monto">
<span<?php echo $Facturas_Pyme->monto->viewAttributes() ?>>
<?php echo $Facturas_Pyme->monto->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Facturas_Pyme->estado_operacion->Visible) { // estado_operacion ?>
	<tr id="r_estado_operacion">
		<td class="<?php echo $Facturas_Pyme_view->TableLeftColumnClass ?>"><span id="elh_Facturas_Pyme_estado_operacion"><?php echo $Facturas_Pyme->estado_operacion->caption() ?></span></td>
		<td data-name="estado_operacion"<?php echo $Facturas_Pyme->estado_operacion->cellAttributes() ?>>
<span id="el_Facturas_Pyme_estado_operacion">
<span<?php echo $Facturas_Pyme->estado_operacion->viewAttributes() ?>>
<?php echo $Facturas_Pyme->estado_operacion->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Facturas_Pyme->pymerfc->Visible) { // pymerfc ?>
	<tr id="r_pymerfc">
		<td class="<?php echo $Facturas_Pyme_view->TableLeftColumnClass ?>"><span id="elh_Facturas_Pyme_pymerfc"><?php echo $Facturas_Pyme->pymerfc->caption() ?></span></td>
		<td data-name="pymerfc"<?php echo $Facturas_Pyme->pymerfc->cellAttributes() ?>>
<span id="el_Facturas_Pyme_pymerfc">
<span<?php echo $Facturas_Pyme->pymerfc->viewAttributes() ?>>
<?php echo $Facturas_Pyme->pymerfc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Facturas_Pyme->compradorfc->Visible) { // compradorfc ?>
	<tr id="r_compradorfc">
		<td class="<?php echo $Facturas_Pyme_view->TableLeftColumnClass ?>"><span id="elh_Facturas_Pyme_compradorfc"><?php echo $Facturas_Pyme->compradorfc->caption() ?></span></td>
		<td data-name="compradorfc"<?php echo $Facturas_Pyme->compradorfc->cellAttributes() ?>>
<span id="el_Facturas_Pyme_compradorfc">
<span<?php echo $Facturas_Pyme->compradorfc->viewAttributes() ?>>
<?php echo $Facturas_Pyme->compradorfc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Facturas_Pyme->cadena->Visible) { // cadena ?>
	<tr id="r_cadena">
		<td class="<?php echo $Facturas_Pyme_view->TableLeftColumnClass ?>"><span id="elh_Facturas_Pyme_cadena"><?php echo $Facturas_Pyme->cadena->caption() ?></span></td>
		<td data-name="cadena"<?php echo $Facturas_Pyme->cadena->cellAttributes() ?>>
<span id="el_Facturas_Pyme_cadena">
<span<?php echo $Facturas_Pyme->cadena->viewAttributes() ?>>
<?php echo $Facturas_Pyme->cadena->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Facturas_Pyme->vencimiento->Visible) { // vencimiento ?>
	<tr id="r_vencimiento">
		<td class="<?php echo $Facturas_Pyme_view->TableLeftColumnClass ?>"><span id="elh_Facturas_Pyme_vencimiento"><?php echo $Facturas_Pyme->vencimiento->caption() ?></span></td>
		<td data-name="vencimiento"<?php echo $Facturas_Pyme->vencimiento->cellAttributes() ?>>
<span id="el_Facturas_Pyme_vencimiento">
<span<?php echo $Facturas_Pyme->vencimiento->viewAttributes() ?>>
<?php echo $Facturas_Pyme->vencimiento->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Facturas_Pyme->fondeadorfactura->Visible) { // fondeadorfactura ?>
	<tr id="r_fondeadorfactura">
		<td class="<?php echo $Facturas_Pyme_view->TableLeftColumnClass ?>"><span id="elh_Facturas_Pyme_fondeadorfactura"><?php echo $Facturas_Pyme->fondeadorfactura->caption() ?></span></td>
		<td data-name="fondeadorfactura"<?php echo $Facturas_Pyme->fondeadorfactura->cellAttributes() ?>>
<span id="el_Facturas_Pyme_fondeadorfactura">
<span<?php echo $Facturas_Pyme->fondeadorfactura->viewAttributes() ?>>
<?php echo $Facturas_Pyme->fondeadorfactura->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Facturas_Pyme->factura->Visible) { // factura ?>
	<tr id="r_factura">
		<td class="<?php echo $Facturas_Pyme_view->TableLeftColumnClass ?>"><span id="elh_Facturas_Pyme_factura"><?php echo $Facturas_Pyme->factura->caption() ?></span></td>
		<td data-name="factura"<?php echo $Facturas_Pyme->factura->cellAttributes() ?>>
<span id="el_Facturas_Pyme_factura">
<span<?php echo $Facturas_Pyme->factura->viewAttributes() ?>>
<?php echo GetFileViewTag($Facturas_Pyme->factura, $Facturas_Pyme->factura->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Facturas_Pyme->estatusfactura->Visible) { // estatusfactura ?>
	<tr id="r_estatusfactura">
		<td class="<?php echo $Facturas_Pyme_view->TableLeftColumnClass ?>"><span id="elh_Facturas_Pyme_estatusfactura"><?php echo $Facturas_Pyme->estatusfactura->caption() ?></span></td>
		<td data-name="estatusfactura"<?php echo $Facturas_Pyme->estatusfactura->cellAttributes() ?>>
<span id="el_Facturas_Pyme_estatusfactura">
<span<?php echo $Facturas_Pyme->estatusfactura->viewAttributes() ?>>
<?php echo $Facturas_Pyme->estatusfactura->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Facturas_Pyme->compradorid_comprador->Visible) { // compradorid_comprador ?>
	<tr id="r_compradorid_comprador">
		<td class="<?php echo $Facturas_Pyme_view->TableLeftColumnClass ?>"><span id="elh_Facturas_Pyme_compradorid_comprador"><?php echo $Facturas_Pyme->compradorid_comprador->caption() ?></span></td>
		<td data-name="compradorid_comprador"<?php echo $Facturas_Pyme->compradorid_comprador->cellAttributes() ?>>
<span id="el_Facturas_Pyme_compradorid_comprador">
<span<?php echo $Facturas_Pyme->compradorid_comprador->viewAttributes() ?>>
<?php echo $Facturas_Pyme->compradorid_comprador->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Facturas_Pyme->fondeadorfacturaidfondeadorfact->Visible) { // fondeadorfacturaidfondeadorfact ?>
	<tr id="r_fondeadorfacturaidfondeadorfact">
		<td class="<?php echo $Facturas_Pyme_view->TableLeftColumnClass ?>"><span id="elh_Facturas_Pyme_fondeadorfacturaidfondeadorfact"><?php echo $Facturas_Pyme->fondeadorfacturaidfondeadorfact->caption() ?></span></td>
		<td data-name="fondeadorfacturaidfondeadorfact"<?php echo $Facturas_Pyme->fondeadorfacturaidfondeadorfact->cellAttributes() ?>>
<span id="el_Facturas_Pyme_fondeadorfacturaidfondeadorfact">
<span<?php echo $Facturas_Pyme->fondeadorfacturaidfondeadorfact->viewAttributes() ?>>
<?php echo $Facturas_Pyme->fondeadorfacturaidfondeadorfact->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$Facturas_Pyme_view->IsModal) { ?>
<?php if (!$Facturas_Pyme->isExport()) { ?>
<?php if (!isset($Facturas_Pyme_view->Pager)) $Facturas_Pyme_view->Pager = new NumericPager($Facturas_Pyme_view->StartRec, $Facturas_Pyme_view->DisplayRecs, $Facturas_Pyme_view->TotalRecs, $Facturas_Pyme_view->RecRange, $Facturas_Pyme_view->AutoHidePager) ?>
<?php if ($Facturas_Pyme_view->Pager->RecordCount > 0 && $Facturas_Pyme_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($Facturas_Pyme_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $Facturas_Pyme_view->pageUrl() ?>start=<?php echo $Facturas_Pyme_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($Facturas_Pyme_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $Facturas_Pyme_view->pageUrl() ?>start=<?php echo $Facturas_Pyme_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($Facturas_Pyme_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $Facturas_Pyme_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($Facturas_Pyme_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $Facturas_Pyme_view->pageUrl() ?>start=<?php echo $Facturas_Pyme_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($Facturas_Pyme_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $Facturas_Pyme_view->pageUrl() ?>start=<?php echo $Facturas_Pyme_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$Facturas_Pyme_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$Facturas_Pyme->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$Facturas_Pyme_view->terminate();
?>