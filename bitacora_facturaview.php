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
$bitacora_factura_view = new bitacora_factura_view();

// Run the page
$bitacora_factura_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bitacora_factura_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$bitacora_factura->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fbitacora_facturaview = currentForm = new ew.Form("fbitacora_facturaview", "view");

// Form_CustomValidate event
fbitacora_facturaview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fbitacora_facturaview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$bitacora_factura->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $bitacora_factura_view->ExportOptions->render("body") ?>
<?php $bitacora_factura_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $bitacora_factura_view->showPageHeader(); ?>
<?php
$bitacora_factura_view->showMessage();
?>
<?php if (!$bitacora_factura_view->IsModal) { ?>
<?php if (!$bitacora_factura->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($bitacora_factura_view->Pager)) $bitacora_factura_view->Pager = new NumericPager($bitacora_factura_view->StartRec, $bitacora_factura_view->DisplayRecs, $bitacora_factura_view->TotalRecs, $bitacora_factura_view->RecRange, $bitacora_factura_view->AutoHidePager) ?>
<?php if ($bitacora_factura_view->Pager->RecordCount > 0 && $bitacora_factura_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($bitacora_factura_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $bitacora_factura_view->pageUrl() ?>start=<?php echo $bitacora_factura_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($bitacora_factura_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $bitacora_factura_view->pageUrl() ?>start=<?php echo $bitacora_factura_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($bitacora_factura_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $bitacora_factura_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($bitacora_factura_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $bitacora_factura_view->pageUrl() ?>start=<?php echo $bitacora_factura_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($bitacora_factura_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $bitacora_factura_view->pageUrl() ?>start=<?php echo $bitacora_factura_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fbitacora_facturaview" id="fbitacora_facturaview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($bitacora_factura_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $bitacora_factura_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bitacora_factura">
<input type="hidden" name="modal" value="<?php echo (int)$bitacora_factura_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($bitacora_factura->idfregfactura->Visible) { // idfregfactura ?>
	<tr id="r_idfregfactura">
		<td class="<?php echo $bitacora_factura_view->TableLeftColumnClass ?>"><span id="elh_bitacora_factura_idfregfactura"><?php echo $bitacora_factura->idfregfactura->caption() ?></span></td>
		<td data-name="idfregfactura"<?php echo $bitacora_factura->idfregfactura->cellAttributes() ?>>
<span id="el_bitacora_factura_idfregfactura">
<span<?php echo $bitacora_factura->idfregfactura->viewAttributes() ?>>
<?php echo $bitacora_factura->idfregfactura->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bitacora_factura->ofertacomision->Visible) { // ofertacomision ?>
	<tr id="r_ofertacomision">
		<td class="<?php echo $bitacora_factura_view->TableLeftColumnClass ?>"><span id="elh_bitacora_factura_ofertacomision"><?php echo $bitacora_factura->ofertacomision->caption() ?></span></td>
		<td data-name="ofertacomision"<?php echo $bitacora_factura->ofertacomision->cellAttributes() ?>>
<span id="el_bitacora_factura_ofertacomision">
<span<?php echo $bitacora_factura->ofertacomision->viewAttributes() ?>>
<?php echo $bitacora_factura->ofertacomision->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bitacora_factura->fecha_movimiento->Visible) { // fecha_movimiento ?>
	<tr id="r_fecha_movimiento">
		<td class="<?php echo $bitacora_factura_view->TableLeftColumnClass ?>"><span id="elh_bitacora_factura_fecha_movimiento"><?php echo $bitacora_factura->fecha_movimiento->caption() ?></span></td>
		<td data-name="fecha_movimiento"<?php echo $bitacora_factura->fecha_movimiento->cellAttributes() ?>>
<span id="el_bitacora_factura_fecha_movimiento">
<span<?php echo $bitacora_factura->fecha_movimiento->viewAttributes() ?>>
<?php echo $bitacora_factura->fecha_movimiento->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bitacora_factura->fondeadore->Visible) { // fondeadore ?>
	<tr id="r_fondeadore">
		<td class="<?php echo $bitacora_factura_view->TableLeftColumnClass ?>"><span id="elh_bitacora_factura_fondeadore"><?php echo $bitacora_factura->fondeadore->caption() ?></span></td>
		<td data-name="fondeadore"<?php echo $bitacora_factura->fondeadore->cellAttributes() ?>>
<span id="el_bitacora_factura_fondeadore">
<span<?php echo $bitacora_factura->fondeadore->viewAttributes() ?>>
<?php echo $bitacora_factura->fondeadore->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bitacora_factura->movimiento->Visible) { // movimiento ?>
	<tr id="r_movimiento">
		<td class="<?php echo $bitacora_factura_view->TableLeftColumnClass ?>"><span id="elh_bitacora_factura_movimiento"><?php echo $bitacora_factura->movimiento->caption() ?></span></td>
		<td data-name="movimiento"<?php echo $bitacora_factura->movimiento->cellAttributes() ?>>
<span id="el_bitacora_factura_movimiento">
<span<?php echo $bitacora_factura->movimiento->viewAttributes() ?>>
<?php echo $bitacora_factura->movimiento->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bitacora_factura->oferta->Visible) { // oferta ?>
	<tr id="r_oferta">
		<td class="<?php echo $bitacora_factura_view->TableLeftColumnClass ?>"><span id="elh_bitacora_factura_oferta"><?php echo $bitacora_factura->oferta->caption() ?></span></td>
		<td data-name="oferta"<?php echo $bitacora_factura->oferta->cellAttributes() ?>>
<span id="el_bitacora_factura_oferta">
<span<?php echo $bitacora_factura->oferta->viewAttributes() ?>>
<?php echo $bitacora_factura->oferta->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bitacora_factura->factrfc_idfac->Visible) { // factrfc_idfac ?>
	<tr id="r_factrfc_idfac">
		<td class="<?php echo $bitacora_factura_view->TableLeftColumnClass ?>"><span id="elh_bitacora_factura_factrfc_idfac"><?php echo $bitacora_factura->factrfc_idfac->caption() ?></span></td>
		<td data-name="factrfc_idfac"<?php echo $bitacora_factura->factrfc_idfac->cellAttributes() ?>>
<span id="el_bitacora_factura_factrfc_idfac">
<span<?php echo $bitacora_factura->factrfc_idfac->viewAttributes() ?>>
<?php echo $bitacora_factura->factrfc_idfac->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bitacora_factura->Column->Visible) { // Column ?>
	<tr id="r_Column">
		<td class="<?php echo $bitacora_factura_view->TableLeftColumnClass ?>"><span id="elh_bitacora_factura_Column"><?php echo $bitacora_factura->Column->caption() ?></span></td>
		<td data-name="Column"<?php echo $bitacora_factura->Column->cellAttributes() ?>>
<span id="el_bitacora_factura_Column">
<span<?php echo $bitacora_factura->Column->viewAttributes() ?>>
<?php echo $bitacora_factura->Column->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$bitacora_factura_view->IsModal) { ?>
<?php if (!$bitacora_factura->isExport()) { ?>
<?php if (!isset($bitacora_factura_view->Pager)) $bitacora_factura_view->Pager = new NumericPager($bitacora_factura_view->StartRec, $bitacora_factura_view->DisplayRecs, $bitacora_factura_view->TotalRecs, $bitacora_factura_view->RecRange, $bitacora_factura_view->AutoHidePager) ?>
<?php if ($bitacora_factura_view->Pager->RecordCount > 0 && $bitacora_factura_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($bitacora_factura_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $bitacora_factura_view->pageUrl() ?>start=<?php echo $bitacora_factura_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($bitacora_factura_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $bitacora_factura_view->pageUrl() ?>start=<?php echo $bitacora_factura_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($bitacora_factura_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $bitacora_factura_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($bitacora_factura_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $bitacora_factura_view->pageUrl() ?>start=<?php echo $bitacora_factura_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($bitacora_factura_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $bitacora_factura_view->pageUrl() ?>start=<?php echo $bitacora_factura_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$bitacora_factura_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$bitacora_factura->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$bitacora_factura_view->terminate();
?>