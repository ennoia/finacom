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
$pyme_view = new pyme_view();

// Run the page
$pyme_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pyme_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$pyme->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fpymeview = currentForm = new ew.Form("fpymeview", "view");

// Form_CustomValidate event
fpymeview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fpymeview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fpymeview.lists["x_compradorrfc"] = <?php echo $pyme_view->compradorrfc->Lookup->toClientList() ?>;
fpymeview.lists["x_compradorrfc"].options = <?php echo JsonEncode($pyme_view->compradorrfc->lookupOptions()) ?>;
fpymeview.autoSuggests["x_compradorrfc"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$pyme->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $pyme_view->ExportOptions->render("body") ?>
<?php $pyme_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $pyme_view->showPageHeader(); ?>
<?php
$pyme_view->showMessage();
?>
<?php if (!$pyme_view->IsModal) { ?>
<?php if (!$pyme->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($pyme_view->Pager)) $pyme_view->Pager = new NumericPager($pyme_view->StartRec, $pyme_view->DisplayRecs, $pyme_view->TotalRecs, $pyme_view->RecRange, $pyme_view->AutoHidePager) ?>
<?php if ($pyme_view->Pager->RecordCount > 0 && $pyme_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($pyme_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $pyme_view->pageUrl() ?>start=<?php echo $pyme_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($pyme_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $pyme_view->pageUrl() ?>start=<?php echo $pyme_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($pyme_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $pyme_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($pyme_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $pyme_view->pageUrl() ?>start=<?php echo $pyme_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($pyme_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $pyme_view->pageUrl() ?>start=<?php echo $pyme_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fpymeview" id="fpymeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($pyme_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $pyme_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pyme">
<input type="hidden" name="modal" value="<?php echo (int)$pyme_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($pyme->rfcpyme->Visible) { // rfcpyme ?>
	<tr id="r_rfcpyme">
		<td class="<?php echo $pyme_view->TableLeftColumnClass ?>"><span id="elh_pyme_rfcpyme"><?php echo $pyme->rfcpyme->caption() ?></span></td>
		<td data-name="rfcpyme"<?php echo $pyme->rfcpyme->cellAttributes() ?>>
<span id="el_pyme_rfcpyme">
<span<?php echo $pyme->rfcpyme->viewAttributes() ?>>
<?php echo $pyme->rfcpyme->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pyme->id_pyme->Visible) { // id_pyme ?>
	<tr id="r_id_pyme">
		<td class="<?php echo $pyme_view->TableLeftColumnClass ?>"><span id="elh_pyme_id_pyme"><?php echo $pyme->id_pyme->caption() ?></span></td>
		<td data-name="id_pyme"<?php echo $pyme->id_pyme->cellAttributes() ?>>
<span id="el_pyme_id_pyme">
<span<?php echo $pyme->id_pyme->viewAttributes() ?>>
<?php echo $pyme->id_pyme->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pyme->razon_social->Visible) { // razon_social ?>
	<tr id="r_razon_social">
		<td class="<?php echo $pyme_view->TableLeftColumnClass ?>"><span id="elh_pyme_razon_social"><?php echo $pyme->razon_social->caption() ?></span></td>
		<td data-name="razon_social"<?php echo $pyme->razon_social->cellAttributes() ?>>
<span id="el_pyme_razon_social">
<span<?php echo $pyme->razon_social->viewAttributes() ?>>
<?php echo $pyme->razon_social->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pyme->calle->Visible) { // calle ?>
	<tr id="r_calle">
		<td class="<?php echo $pyme_view->TableLeftColumnClass ?>"><span id="elh_pyme_calle"><?php echo $pyme->calle->caption() ?></span></td>
		<td data-name="calle"<?php echo $pyme->calle->cellAttributes() ?>>
<span id="el_pyme_calle">
<span<?php echo $pyme->calle->viewAttributes() ?>>
<?php echo $pyme->calle->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pyme->colonia->Visible) { // colonia ?>
	<tr id="r_colonia">
		<td class="<?php echo $pyme_view->TableLeftColumnClass ?>"><span id="elh_pyme_colonia"><?php echo $pyme->colonia->caption() ?></span></td>
		<td data-name="colonia"<?php echo $pyme->colonia->cellAttributes() ?>>
<span id="el_pyme_colonia">
<span<?php echo $pyme->colonia->viewAttributes() ?>>
<?php echo $pyme->colonia->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pyme->ciudad->Visible) { // ciudad ?>
	<tr id="r_ciudad">
		<td class="<?php echo $pyme_view->TableLeftColumnClass ?>"><span id="elh_pyme_ciudad"><?php echo $pyme->ciudad->caption() ?></span></td>
		<td data-name="ciudad"<?php echo $pyme->ciudad->cellAttributes() ?>>
<span id="el_pyme_ciudad">
<span<?php echo $pyme->ciudad->viewAttributes() ?>>
<?php echo $pyme->ciudad->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pyme->codpostal->Visible) { // codpostal ?>
	<tr id="r_codpostal">
		<td class="<?php echo $pyme_view->TableLeftColumnClass ?>"><span id="elh_pyme_codpostal"><?php echo $pyme->codpostal->caption() ?></span></td>
		<td data-name="codpostal"<?php echo $pyme->codpostal->cellAttributes() ?>>
<span id="el_pyme_codpostal">
<span<?php echo $pyme->codpostal->viewAttributes() ?>>
<?php echo $pyme->codpostal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pyme->correo->Visible) { // correo ?>
	<tr id="r_correo">
		<td class="<?php echo $pyme_view->TableLeftColumnClass ?>"><span id="elh_pyme_correo"><?php echo $pyme->correo->caption() ?></span></td>
		<td data-name="correo"<?php echo $pyme->correo->cellAttributes() ?>>
<span id="el_pyme_correo">
<span<?php echo $pyme->correo->viewAttributes() ?>>
<?php echo $pyme->correo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pyme->telefono->Visible) { // telefono ?>
	<tr id="r_telefono">
		<td class="<?php echo $pyme_view->TableLeftColumnClass ?>"><span id="elh_pyme_telefono"><?php echo $pyme->telefono->caption() ?></span></td>
		<td data-name="telefono"<?php echo $pyme->telefono->cellAttributes() ?>>
<span id="el_pyme_telefono">
<span<?php echo $pyme->telefono->viewAttributes() ?>>
<?php echo $pyme->telefono->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pyme->pais->Visible) { // pais ?>
	<tr id="r_pais">
		<td class="<?php echo $pyme_view->TableLeftColumnClass ?>"><span id="elh_pyme_pais"><?php echo $pyme->pais->caption() ?></span></td>
		<td data-name="pais"<?php echo $pyme->pais->cellAttributes() ?>>
<span id="el_pyme_pais">
<span<?php echo $pyme->pais->viewAttributes() ?>>
<?php echo $pyme->pais->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pyme->contrato_firmado->Visible) { // contrato_firmado ?>
	<tr id="r_contrato_firmado">
		<td class="<?php echo $pyme_view->TableLeftColumnClass ?>"><span id="elh_pyme_contrato_firmado"><?php echo $pyme->contrato_firmado->caption() ?></span></td>
		<td data-name="contrato_firmado"<?php echo $pyme->contrato_firmado->cellAttributes() ?>>
<span id="el_pyme_contrato_firmado">
<span<?php echo $pyme->contrato_firmado->viewAttributes() ?>>
<?php echo GetFileViewTag($pyme->contrato_firmado, $pyme->contrato_firmado->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pyme->preafiliacion->Visible) { // preafiliacion ?>
	<tr id="r_preafiliacion">
		<td class="<?php echo $pyme_view->TableLeftColumnClass ?>"><span id="elh_pyme_preafiliacion"><?php echo $pyme->preafiliacion->caption() ?></span></td>
		<td data-name="preafiliacion"<?php echo $pyme->preafiliacion->cellAttributes() ?>>
<span id="el_pyme_preafiliacion">
<span<?php echo $pyme->preafiliacion->viewAttributes() ?>>
<?php echo $pyme->preafiliacion->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pyme->edooperacionpyme->Visible) { // edooperacionpyme ?>
	<tr id="r_edooperacionpyme">
		<td class="<?php echo $pyme_view->TableLeftColumnClass ?>"><span id="elh_pyme_edooperacionpyme"><?php echo $pyme->edooperacionpyme->caption() ?></span></td>
		<td data-name="edooperacionpyme"<?php echo $pyme->edooperacionpyme->cellAttributes() ?>>
<span id="el_pyme_edooperacionpyme">
<span<?php echo $pyme->edooperacionpyme->viewAttributes() ?>>
<?php echo $pyme->edooperacionpyme->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pyme->compradorrfc->Visible) { // compradorrfc ?>
	<tr id="r_compradorrfc">
		<td class="<?php echo $pyme_view->TableLeftColumnClass ?>"><span id="elh_pyme_compradorrfc"><?php echo $pyme->compradorrfc->caption() ?></span></td>
		<td data-name="compradorrfc"<?php echo $pyme->compradorrfc->cellAttributes() ?>>
<span id="el_pyme_compradorrfc">
<span<?php echo $pyme->compradorrfc->viewAttributes() ?>>
<?php echo $pyme->compradorrfc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pyme->comprador->Visible) { // comprador ?>
	<tr id="r_comprador">
		<td class="<?php echo $pyme_view->TableLeftColumnClass ?>"><span id="elh_pyme_comprador"><?php echo $pyme->comprador->caption() ?></span></td>
		<td data-name="comprador"<?php echo $pyme->comprador->cellAttributes() ?>>
<span id="el_pyme_comprador">
<span<?php echo $pyme->comprador->viewAttributes() ?>>
<?php echo $pyme->comprador->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$pyme_view->IsModal) { ?>
<?php if (!$pyme->isExport()) { ?>
<?php if (!isset($pyme_view->Pager)) $pyme_view->Pager = new NumericPager($pyme_view->StartRec, $pyme_view->DisplayRecs, $pyme_view->TotalRecs, $pyme_view->RecRange, $pyme_view->AutoHidePager) ?>
<?php if ($pyme_view->Pager->RecordCount > 0 && $pyme_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($pyme_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $pyme_view->pageUrl() ?>start=<?php echo $pyme_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($pyme_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $pyme_view->pageUrl() ?>start=<?php echo $pyme_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($pyme_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $pyme_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($pyme_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $pyme_view->pageUrl() ?>start=<?php echo $pyme_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($pyme_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $pyme_view->pageUrl() ?>start=<?php echo $pyme_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$pyme_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$pyme->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$pyme_view->terminate();
?>