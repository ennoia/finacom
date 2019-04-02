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
$fondeadorfactura_view = new fondeadorfactura_view();

// Run the page
$fondeadorfactura_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$fondeadorfactura_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$fondeadorfactura->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ffondeadorfacturaview = currentForm = new ew.Form("ffondeadorfacturaview", "view");

// Form_CustomValidate event
ffondeadorfacturaview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ffondeadorfacturaview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$fondeadorfactura->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $fondeadorfactura_view->ExportOptions->render("body") ?>
<?php $fondeadorfactura_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $fondeadorfactura_view->showPageHeader(); ?>
<?php
$fondeadorfactura_view->showMessage();
?>
<?php if (!$fondeadorfactura_view->IsModal) { ?>
<?php if (!$fondeadorfactura->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($fondeadorfactura_view->Pager)) $fondeadorfactura_view->Pager = new NumericPager($fondeadorfactura_view->StartRec, $fondeadorfactura_view->DisplayRecs, $fondeadorfactura_view->TotalRecs, $fondeadorfactura_view->RecRange, $fondeadorfactura_view->AutoHidePager) ?>
<?php if ($fondeadorfactura_view->Pager->RecordCount > 0 && $fondeadorfactura_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($fondeadorfactura_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $fondeadorfactura_view->pageUrl() ?>start=<?php echo $fondeadorfactura_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($fondeadorfactura_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $fondeadorfactura_view->pageUrl() ?>start=<?php echo $fondeadorfactura_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($fondeadorfactura_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $fondeadorfactura_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($fondeadorfactura_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $fondeadorfactura_view->pageUrl() ?>start=<?php echo $fondeadorfactura_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($fondeadorfactura_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $fondeadorfactura_view->pageUrl() ?>start=<?php echo $fondeadorfactura_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="ffondeadorfacturaview" id="ffondeadorfacturaview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($fondeadorfactura_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $fondeadorfactura_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="fondeadorfactura">
<input type="hidden" name="modal" value="<?php echo (int)$fondeadorfactura_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($fondeadorfactura->idfondeadorfact->Visible) { // idfondeadorfact ?>
	<tr id="r_idfondeadorfact">
		<td class="<?php echo $fondeadorfactura_view->TableLeftColumnClass ?>"><span id="elh_fondeadorfactura_idfondeadorfact"><?php echo $fondeadorfactura->idfondeadorfact->caption() ?></span></td>
		<td data-name="idfondeadorfact"<?php echo $fondeadorfactura->idfondeadorfact->cellAttributes() ?>>
<span id="el_fondeadorfactura_idfondeadorfact">
<span<?php echo $fondeadorfactura->idfondeadorfact->viewAttributes() ?>>
<?php echo $fondeadorfactura->idfondeadorfact->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($fondeadorfactura->rfcfondeador->Visible) { // rfcfondeador ?>
	<tr id="r_rfcfondeador">
		<td class="<?php echo $fondeadorfactura_view->TableLeftColumnClass ?>"><span id="elh_fondeadorfactura_rfcfondeador"><?php echo $fondeadorfactura->rfcfondeador->caption() ?></span></td>
		<td data-name="rfcfondeador"<?php echo $fondeadorfactura->rfcfondeador->cellAttributes() ?>>
<span id="el_fondeadorfactura_rfcfondeador">
<span<?php echo $fondeadorfactura->rfcfondeador->viewAttributes() ?>>
<?php echo $fondeadorfactura->rfcfondeador->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($fondeadorfactura->rfcfactura->Visible) { // rfcfactura ?>
	<tr id="r_rfcfactura">
		<td class="<?php echo $fondeadorfactura_view->TableLeftColumnClass ?>"><span id="elh_fondeadorfactura_rfcfactura"><?php echo $fondeadorfactura->rfcfactura->caption() ?></span></td>
		<td data-name="rfcfactura"<?php echo $fondeadorfactura->rfcfactura->cellAttributes() ?>>
<span id="el_fondeadorfactura_rfcfactura">
<span<?php echo $fondeadorfactura->rfcfactura->viewAttributes() ?>>
<?php echo $fondeadorfactura->rfcfactura->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($fondeadorfactura->porcentajedescuento->Visible) { // porcentajedescuento ?>
	<tr id="r_porcentajedescuento">
		<td class="<?php echo $fondeadorfactura_view->TableLeftColumnClass ?>"><span id="elh_fondeadorfactura_porcentajedescuento"><?php echo $fondeadorfactura->porcentajedescuento->caption() ?></span></td>
		<td data-name="porcentajedescuento"<?php echo $fondeadorfactura->porcentajedescuento->cellAttributes() ?>>
<span id="el_fondeadorfactura_porcentajedescuento">
<span<?php echo $fondeadorfactura->porcentajedescuento->viewAttributes() ?>>
<?php echo $fondeadorfactura->porcentajedescuento->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($fondeadorfactura->comprobante->Visible) { // comprobante ?>
	<tr id="r_comprobante">
		<td class="<?php echo $fondeadorfactura_view->TableLeftColumnClass ?>"><span id="elh_fondeadorfactura_comprobante"><?php echo $fondeadorfactura->comprobante->caption() ?></span></td>
		<td data-name="comprobante"<?php echo $fondeadorfactura->comprobante->cellAttributes() ?>>
<span id="el_fondeadorfactura_comprobante">
<span<?php echo $fondeadorfactura->comprobante->viewAttributes() ?>>
<?php echo GetFileViewTag($fondeadorfactura->comprobante, $fondeadorfactura->comprobante->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($fondeadorfactura->fecha_movimiento->Visible) { // fecha_movimiento ?>
	<tr id="r_fecha_movimiento">
		<td class="<?php echo $fondeadorfactura_view->TableLeftColumnClass ?>"><span id="elh_fondeadorfactura_fecha_movimiento"><?php echo $fondeadorfactura->fecha_movimiento->caption() ?></span></td>
		<td data-name="fecha_movimiento"<?php echo $fondeadorfactura->fecha_movimiento->cellAttributes() ?>>
<span id="el_fondeadorfactura_fecha_movimiento">
<span<?php echo $fondeadorfactura->fecha_movimiento->viewAttributes() ?>>
<?php echo $fondeadorfactura->fecha_movimiento->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($fondeadorfactura->fondeadorrfc->Visible) { // fondeadorrfc ?>
	<tr id="r_fondeadorrfc">
		<td class="<?php echo $fondeadorfactura_view->TableLeftColumnClass ?>"><span id="elh_fondeadorfactura_fondeadorrfc"><?php echo $fondeadorfactura->fondeadorrfc->caption() ?></span></td>
		<td data-name="fondeadorrfc"<?php echo $fondeadorfactura->fondeadorrfc->cellAttributes() ?>>
<span id="el_fondeadorfactura_fondeadorrfc">
<span<?php echo $fondeadorfactura->fondeadorrfc->viewAttributes() ?>>
<?php echo $fondeadorfactura->fondeadorrfc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$fondeadorfactura_view->IsModal) { ?>
<?php if (!$fondeadorfactura->isExport()) { ?>
<?php if (!isset($fondeadorfactura_view->Pager)) $fondeadorfactura_view->Pager = new NumericPager($fondeadorfactura_view->StartRec, $fondeadorfactura_view->DisplayRecs, $fondeadorfactura_view->TotalRecs, $fondeadorfactura_view->RecRange, $fondeadorfactura_view->AutoHidePager) ?>
<?php if ($fondeadorfactura_view->Pager->RecordCount > 0 && $fondeadorfactura_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($fondeadorfactura_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $fondeadorfactura_view->pageUrl() ?>start=<?php echo $fondeadorfactura_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($fondeadorfactura_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $fondeadorfactura_view->pageUrl() ?>start=<?php echo $fondeadorfactura_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($fondeadorfactura_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $fondeadorfactura_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($fondeadorfactura_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $fondeadorfactura_view->pageUrl() ?>start=<?php echo $fondeadorfactura_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($fondeadorfactura_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $fondeadorfactura_view->pageUrl() ?>start=<?php echo $fondeadorfactura_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$fondeadorfactura_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$fondeadorfactura->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$fondeadorfactura_view->terminate();
?>