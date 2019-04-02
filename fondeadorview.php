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
$fondeador_view = new fondeador_view();

// Run the page
$fondeador_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$fondeador_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$fondeador->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ffondeadorview = currentForm = new ew.Form("ffondeadorview", "view");

// Form_CustomValidate event
ffondeadorview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ffondeadorview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$fondeador->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $fondeador_view->ExportOptions->render("body") ?>
<?php $fondeador_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $fondeador_view->showPageHeader(); ?>
<?php
$fondeador_view->showMessage();
?>
<?php if (!$fondeador_view->IsModal) { ?>
<?php if (!$fondeador->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($fondeador_view->Pager)) $fondeador_view->Pager = new NumericPager($fondeador_view->StartRec, $fondeador_view->DisplayRecs, $fondeador_view->TotalRecs, $fondeador_view->RecRange, $fondeador_view->AutoHidePager) ?>
<?php if ($fondeador_view->Pager->RecordCount > 0 && $fondeador_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($fondeador_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $fondeador_view->pageUrl() ?>start=<?php echo $fondeador_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($fondeador_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $fondeador_view->pageUrl() ?>start=<?php echo $fondeador_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($fondeador_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $fondeador_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($fondeador_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $fondeador_view->pageUrl() ?>start=<?php echo $fondeador_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($fondeador_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $fondeador_view->pageUrl() ?>start=<?php echo $fondeador_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="ffondeadorview" id="ffondeadorview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($fondeador_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $fondeador_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="fondeador">
<input type="hidden" name="modal" value="<?php echo (int)$fondeador_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($fondeador->id_fondeador->Visible) { // id_fondeador ?>
	<tr id="r_id_fondeador">
		<td class="<?php echo $fondeador_view->TableLeftColumnClass ?>"><span id="elh_fondeador_id_fondeador"><?php echo $fondeador->id_fondeador->caption() ?></span></td>
		<td data-name="id_fondeador"<?php echo $fondeador->id_fondeador->cellAttributes() ?>>
<span id="el_fondeador_id_fondeador">
<span<?php echo $fondeador->id_fondeador->viewAttributes() ?>>
<?php echo $fondeador->id_fondeador->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($fondeador->rfcfondeador->Visible) { // rfcfondeador ?>
	<tr id="r_rfcfondeador">
		<td class="<?php echo $fondeador_view->TableLeftColumnClass ?>"><span id="elh_fondeador_rfcfondeador"><?php echo $fondeador->rfcfondeador->caption() ?></span></td>
		<td data-name="rfcfondeador"<?php echo $fondeador->rfcfondeador->cellAttributes() ?>>
<span id="el_fondeador_rfcfondeador">
<span<?php echo $fondeador->rfcfondeador->viewAttributes() ?>>
<?php echo $fondeador->rfcfondeador->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($fondeador->razon_social->Visible) { // razon_social ?>
	<tr id="r_razon_social">
		<td class="<?php echo $fondeador_view->TableLeftColumnClass ?>"><span id="elh_fondeador_razon_social"><?php echo $fondeador->razon_social->caption() ?></span></td>
		<td data-name="razon_social"<?php echo $fondeador->razon_social->cellAttributes() ?>>
<span id="el_fondeador_razon_social">
<span<?php echo $fondeador->razon_social->viewAttributes() ?>>
<?php echo $fondeador->razon_social->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($fondeador->calle->Visible) { // calle ?>
	<tr id="r_calle">
		<td class="<?php echo $fondeador_view->TableLeftColumnClass ?>"><span id="elh_fondeador_calle"><?php echo $fondeador->calle->caption() ?></span></td>
		<td data-name="calle"<?php echo $fondeador->calle->cellAttributes() ?>>
<span id="el_fondeador_calle">
<span<?php echo $fondeador->calle->viewAttributes() ?>>
<?php echo $fondeador->calle->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($fondeador->colonia->Visible) { // colonia ?>
	<tr id="r_colonia">
		<td class="<?php echo $fondeador_view->TableLeftColumnClass ?>"><span id="elh_fondeador_colonia"><?php echo $fondeador->colonia->caption() ?></span></td>
		<td data-name="colonia"<?php echo $fondeador->colonia->cellAttributes() ?>>
<span id="el_fondeador_colonia">
<span<?php echo $fondeador->colonia->viewAttributes() ?>>
<?php echo $fondeador->colonia->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($fondeador->ciudad->Visible) { // ciudad ?>
	<tr id="r_ciudad">
		<td class="<?php echo $fondeador_view->TableLeftColumnClass ?>"><span id="elh_fondeador_ciudad"><?php echo $fondeador->ciudad->caption() ?></span></td>
		<td data-name="ciudad"<?php echo $fondeador->ciudad->cellAttributes() ?>>
<span id="el_fondeador_ciudad">
<span<?php echo $fondeador->ciudad->viewAttributes() ?>>
<?php echo $fondeador->ciudad->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($fondeador->codpostal->Visible) { // codpostal ?>
	<tr id="r_codpostal">
		<td class="<?php echo $fondeador_view->TableLeftColumnClass ?>"><span id="elh_fondeador_codpostal"><?php echo $fondeador->codpostal->caption() ?></span></td>
		<td data-name="codpostal"<?php echo $fondeador->codpostal->cellAttributes() ?>>
<span id="el_fondeador_codpostal">
<span<?php echo $fondeador->codpostal->viewAttributes() ?>>
<?php echo $fondeador->codpostal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($fondeador->telefono->Visible) { // telefono ?>
	<tr id="r_telefono">
		<td class="<?php echo $fondeador_view->TableLeftColumnClass ?>"><span id="elh_fondeador_telefono"><?php echo $fondeador->telefono->caption() ?></span></td>
		<td data-name="telefono"<?php echo $fondeador->telefono->cellAttributes() ?>>
<span id="el_fondeador_telefono">
<span<?php echo $fondeador->telefono->viewAttributes() ?>>
<?php echo $fondeador->telefono->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($fondeador->correo->Visible) { // correo ?>
	<tr id="r_correo">
		<td class="<?php echo $fondeador_view->TableLeftColumnClass ?>"><span id="elh_fondeador_correo"><?php echo $fondeador->correo->caption() ?></span></td>
		<td data-name="correo"<?php echo $fondeador->correo->cellAttributes() ?>>
<span id="el_fondeador_correo">
<span<?php echo $fondeador->correo->viewAttributes() ?>>
<?php echo $fondeador->correo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($fondeador->pais->Visible) { // pais ?>
	<tr id="r_pais">
		<td class="<?php echo $fondeador_view->TableLeftColumnClass ?>"><span id="elh_fondeador_pais"><?php echo $fondeador->pais->caption() ?></span></td>
		<td data-name="pais"<?php echo $fondeador->pais->cellAttributes() ?>>
<span id="el_fondeador_pais">
<span<?php echo $fondeador->pais->viewAttributes() ?>>
<?php echo $fondeador->pais->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($fondeador->fondeadorfactura->Visible) { // fondeadorfactura ?>
	<tr id="r_fondeadorfactura">
		<td class="<?php echo $fondeador_view->TableLeftColumnClass ?>"><span id="elh_fondeador_fondeadorfactura"><?php echo $fondeador->fondeadorfactura->caption() ?></span></td>
		<td data-name="fondeadorfactura"<?php echo $fondeador->fondeadorfactura->cellAttributes() ?>>
<span id="el_fondeador_fondeadorfactura">
<span<?php echo $fondeador->fondeadorfactura->viewAttributes() ?>>
<?php echo $fondeador->fondeadorfactura->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($fondeador->calificacion->Visible) { // calificacion ?>
	<tr id="r_calificacion">
		<td class="<?php echo $fondeador_view->TableLeftColumnClass ?>"><span id="elh_fondeador_calificacion"><?php echo $fondeador->calificacion->caption() ?></span></td>
		<td data-name="calificacion"<?php echo $fondeador->calificacion->cellAttributes() ?>>
<span id="el_fondeador_calificacion">
<span<?php echo $fondeador->calificacion->viewAttributes() ?>>
<?php echo $fondeador->calificacion->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($fondeador->cedooperacionfondeador->Visible) { // cedooperacionfondeador ?>
	<tr id="r_cedooperacionfondeador">
		<td class="<?php echo $fondeador_view->TableLeftColumnClass ?>"><span id="elh_fondeador_cedooperacionfondeador"><?php echo $fondeador->cedooperacionfondeador->caption() ?></span></td>
		<td data-name="cedooperacionfondeador"<?php echo $fondeador->cedooperacionfondeador->cellAttributes() ?>>
<span id="el_fondeador_cedooperacionfondeador">
<span<?php echo $fondeador->cedooperacionfondeador->viewAttributes() ?>>
<?php echo $fondeador->cedooperacionfondeador->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($fondeador->pymerfc->Visible) { // pymerfc ?>
	<tr id="r_pymerfc">
		<td class="<?php echo $fondeador_view->TableLeftColumnClass ?>"><span id="elh_fondeador_pymerfc"><?php echo $fondeador->pymerfc->caption() ?></span></td>
		<td data-name="pymerfc"<?php echo $fondeador->pymerfc->cellAttributes() ?>>
<span id="el_fondeador_pymerfc">
<span<?php echo $fondeador->pymerfc->viewAttributes() ?>>
<?php echo $fondeador->pymerfc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$fondeador_view->IsModal) { ?>
<?php if (!$fondeador->isExport()) { ?>
<?php if (!isset($fondeador_view->Pager)) $fondeador_view->Pager = new NumericPager($fondeador_view->StartRec, $fondeador_view->DisplayRecs, $fondeador_view->TotalRecs, $fondeador_view->RecRange, $fondeador_view->AutoHidePager) ?>
<?php if ($fondeador_view->Pager->RecordCount > 0 && $fondeador_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($fondeador_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $fondeador_view->pageUrl() ?>start=<?php echo $fondeador_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($fondeador_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $fondeador_view->pageUrl() ?>start=<?php echo $fondeador_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($fondeador_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $fondeador_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($fondeador_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $fondeador_view->pageUrl() ?>start=<?php echo $fondeador_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($fondeador_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $fondeador_view->pageUrl() ?>start=<?php echo $fondeador_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$fondeador_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$fondeador->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$fondeador_view->terminate();
?>