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
$factura_view = new factura_view();

// Run the page
$factura_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$factura_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$factura->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ffacturaview = currentForm = new ew.Form("ffacturaview", "view");

// Form_CustomValidate event
ffacturaview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ffacturaview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$factura->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $factura_view->ExportOptions->render("body") ?>
<?php $factura_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $factura_view->showPageHeader(); ?>
<?php
$factura_view->showMessage();
?>
<?php if (!$factura_view->IsModal) { ?>
<?php if (!$factura->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($factura_view->Pager)) $factura_view->Pager = new NumericPager($factura_view->StartRec, $factura_view->DisplayRecs, $factura_view->TotalRecs, $factura_view->RecRange, $factura_view->AutoHidePager) ?>
<?php if ($factura_view->Pager->RecordCount > 0 && $factura_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($factura_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $factura_view->pageUrl() ?>start=<?php echo $factura_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($factura_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $factura_view->pageUrl() ?>start=<?php echo $factura_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($factura_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $factura_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($factura_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $factura_view->pageUrl() ?>start=<?php echo $factura_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($factura_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $factura_view->pageUrl() ?>start=<?php echo $factura_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="ffacturaview" id="ffacturaview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($factura_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $factura_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="factura">
<input type="hidden" name="modal" value="<?php echo (int)$factura_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($factura->rfcfactura->Visible) { // rfcfactura ?>
	<tr id="r_rfcfactura">
		<td class="<?php echo $factura_view->TableLeftColumnClass ?>"><span id="elh_factura_rfcfactura"><?php echo $factura->rfcfactura->caption() ?></span></td>
		<td data-name="rfcfactura"<?php echo $factura->rfcfactura->cellAttributes() ?>>
<span id="el_factura_rfcfactura">
<span<?php echo $factura->rfcfactura->viewAttributes() ?>>
<?php echo $factura->rfcfactura->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($factura->idfactura->Visible) { // idfactura ?>
	<tr id="r_idfactura">
		<td class="<?php echo $factura_view->TableLeftColumnClass ?>"><span id="elh_factura_idfactura"><?php echo $factura->idfactura->caption() ?></span></td>
		<td data-name="idfactura"<?php echo $factura->idfactura->cellAttributes() ?>>
<span id="el_factura_idfactura">
<span<?php echo $factura->idfactura->viewAttributes() ?>>
<?php echo $factura->idfactura->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($factura->monto->Visible) { // monto ?>
	<tr id="r_monto">
		<td class="<?php echo $factura_view->TableLeftColumnClass ?>"><span id="elh_factura_monto"><?php echo $factura->monto->caption() ?></span></td>
		<td data-name="monto"<?php echo $factura->monto->cellAttributes() ?>>
<span id="el_factura_monto">
<span<?php echo $factura->monto->viewAttributes() ?>>
<?php echo $factura->monto->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($factura->estado_operacion->Visible) { // estado_operacion ?>
	<tr id="r_estado_operacion">
		<td class="<?php echo $factura_view->TableLeftColumnClass ?>"><span id="elh_factura_estado_operacion"><?php echo $factura->estado_operacion->caption() ?></span></td>
		<td data-name="estado_operacion"<?php echo $factura->estado_operacion->cellAttributes() ?>>
<span id="el_factura_estado_operacion">
<span<?php echo $factura->estado_operacion->viewAttributes() ?>>
<?php echo $factura->estado_operacion->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($factura->pymerfc->Visible) { // pymerfc ?>
	<tr id="r_pymerfc">
		<td class="<?php echo $factura_view->TableLeftColumnClass ?>"><span id="elh_factura_pymerfc"><?php echo $factura->pymerfc->caption() ?></span></td>
		<td data-name="pymerfc"<?php echo $factura->pymerfc->cellAttributes() ?>>
<span id="el_factura_pymerfc">
<span<?php echo $factura->pymerfc->viewAttributes() ?>>
<?php echo $factura->pymerfc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($factura->compradorfc->Visible) { // compradorfc ?>
	<tr id="r_compradorfc">
		<td class="<?php echo $factura_view->TableLeftColumnClass ?>"><span id="elh_factura_compradorfc"><?php echo $factura->compradorfc->caption() ?></span></td>
		<td data-name="compradorfc"<?php echo $factura->compradorfc->cellAttributes() ?>>
<span id="el_factura_compradorfc">
<span<?php echo $factura->compradorfc->viewAttributes() ?>>
<?php echo $factura->compradorfc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($factura->cadena->Visible) { // cadena ?>
	<tr id="r_cadena">
		<td class="<?php echo $factura_view->TableLeftColumnClass ?>"><span id="elh_factura_cadena"><?php echo $factura->cadena->caption() ?></span></td>
		<td data-name="cadena"<?php echo $factura->cadena->cellAttributes() ?>>
<span id="el_factura_cadena">
<span<?php echo $factura->cadena->viewAttributes() ?>>
<?php echo $factura->cadena->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($factura->vencimiento->Visible) { // vencimiento ?>
	<tr id="r_vencimiento">
		<td class="<?php echo $factura_view->TableLeftColumnClass ?>"><span id="elh_factura_vencimiento"><?php echo $factura->vencimiento->caption() ?></span></td>
		<td data-name="vencimiento"<?php echo $factura->vencimiento->cellAttributes() ?>>
<span id="el_factura_vencimiento">
<span<?php echo $factura->vencimiento->viewAttributes() ?>>
<?php echo $factura->vencimiento->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($factura->fondeadorfactura->Visible) { // fondeadorfactura ?>
	<tr id="r_fondeadorfactura">
		<td class="<?php echo $factura_view->TableLeftColumnClass ?>"><span id="elh_factura_fondeadorfactura"><?php echo $factura->fondeadorfactura->caption() ?></span></td>
		<td data-name="fondeadorfactura"<?php echo $factura->fondeadorfactura->cellAttributes() ?>>
<span id="el_factura_fondeadorfactura">
<span<?php echo $factura->fondeadorfactura->viewAttributes() ?>>
<?php echo $factura->fondeadorfactura->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($factura->factura->Visible) { // factura ?>
	<tr id="r_factura">
		<td class="<?php echo $factura_view->TableLeftColumnClass ?>"><span id="elh_factura_factura"><?php echo $factura->factura->caption() ?></span></td>
		<td data-name="factura"<?php echo $factura->factura->cellAttributes() ?>>
<span id="el_factura_factura">
<span<?php echo $factura->factura->viewAttributes() ?>>
<?php echo GetFileViewTag($factura->factura, $factura->factura->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($factura->estatusfactura->Visible) { // estatusfactura ?>
	<tr id="r_estatusfactura">
		<td class="<?php echo $factura_view->TableLeftColumnClass ?>"><span id="elh_factura_estatusfactura"><?php echo $factura->estatusfactura->caption() ?></span></td>
		<td data-name="estatusfactura"<?php echo $factura->estatusfactura->cellAttributes() ?>>
<span id="el_factura_estatusfactura">
<span<?php echo $factura->estatusfactura->viewAttributes() ?>>
<?php echo $factura->estatusfactura->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($factura->compradorid_comprador->Visible) { // compradorid_comprador ?>
	<tr id="r_compradorid_comprador">
		<td class="<?php echo $factura_view->TableLeftColumnClass ?>"><span id="elh_factura_compradorid_comprador"><?php echo $factura->compradorid_comprador->caption() ?></span></td>
		<td data-name="compradorid_comprador"<?php echo $factura->compradorid_comprador->cellAttributes() ?>>
<span id="el_factura_compradorid_comprador">
<span<?php echo $factura->compradorid_comprador->viewAttributes() ?>>
<?php echo $factura->compradorid_comprador->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($factura->fondeadorfacturaidfondeadorfact->Visible) { // fondeadorfacturaidfondeadorfact ?>
	<tr id="r_fondeadorfacturaidfondeadorfact">
		<td class="<?php echo $factura_view->TableLeftColumnClass ?>"><span id="elh_factura_fondeadorfacturaidfondeadorfact"><?php echo $factura->fondeadorfacturaidfondeadorfact->caption() ?></span></td>
		<td data-name="fondeadorfacturaidfondeadorfact"<?php echo $factura->fondeadorfacturaidfondeadorfact->cellAttributes() ?>>
<span id="el_factura_fondeadorfacturaidfondeadorfact">
<span<?php echo $factura->fondeadorfacturaidfondeadorfact->viewAttributes() ?>>
<?php echo $factura->fondeadorfacturaidfondeadorfact->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$factura_view->IsModal) { ?>
<?php if (!$factura->isExport()) { ?>
<?php if (!isset($factura_view->Pager)) $factura_view->Pager = new NumericPager($factura_view->StartRec, $factura_view->DisplayRecs, $factura_view->TotalRecs, $factura_view->RecRange, $factura_view->AutoHidePager) ?>
<?php if ($factura_view->Pager->RecordCount > 0 && $factura_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($factura_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $factura_view->pageUrl() ?>start=<?php echo $factura_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($factura_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $factura_view->pageUrl() ?>start=<?php echo $factura_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($factura_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $factura_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($factura_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $factura_view->pageUrl() ?>start=<?php echo $factura_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($factura_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $factura_view->pageUrl() ?>start=<?php echo $factura_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$factura_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$factura->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$factura_view->terminate();
?>