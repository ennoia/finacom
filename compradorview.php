
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
$comprador_view = new comprador_view();

// Run the page
$comprador_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$comprador_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$comprador->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fcompradorview = currentForm = new ew.Form("fcompradorview", "view");

// Form_CustomValidate event
fcompradorview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcompradorview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcompradorview.lists["x_pymerfc"] = <?php echo $comprador_view->pymerfc->Lookup->toClientList() ?>;
fcompradorview.lists["x_pymerfc"].options = <?php echo JsonEncode($comprador_view->pymerfc->lookupOptions()) ?>;
fcompradorview.autoSuggests["x_pymerfc"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>


<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$comprador->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $comprador_view->ExportOptions->render("body") ?>
<?php $comprador_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $comprador_view->showPageHeader(); ?>
<?php
$comprador_view->showMessage();
?>
<?php if (!$comprador_view->IsModal) { ?>
<?php if (!$comprador->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($comprador_view->Pager)) $comprador_view->Pager = new NumericPager($comprador_view->StartRec, $comprador_view->DisplayRecs, $comprador_view->TotalRecs, $comprador_view->RecRange, $comprador_view->AutoHidePager) ?>
<?php if ($comprador_view->Pager->RecordCount > 0 && $comprador_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($comprador_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $comprador_view->pageUrl() ?>start=<?php echo $comprador_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($comprador_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $comprador_view->pageUrl() ?>start=<?php echo $comprador_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($comprador_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $comprador_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($comprador_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $comprador_view->pageUrl() ?>start=<?php echo $comprador_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($comprador_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $comprador_view->pageUrl() ?>start=<?php echo $comprador_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fcompradorview" id="fcompradorview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($comprador_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $comprador_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="comprador">
<input type="hidden" name="modal" value="<?php echo (int)$comprador_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($comprador->id_comprador->Visible) { // id_comprador ?>
	<tr id="r_id_comprador">
		<td class="<?php echo $comprador_view->TableLeftColumnClass ?>"><span id="elh_comprador_id_comprador"><?php echo $comprador->id_comprador->caption() ?></span></td>
		<td data-name="id_comprador"<?php echo $comprador->id_comprador->cellAttributes() ?>>
<span id="el_comprador_id_comprador">
<span<?php echo $comprador->id_comprador->viewAttributes() ?>>
<?php echo $comprador->id_comprador->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($comprador->razon_social->Visible) { // razon_social ?>
	<tr id="r_razon_social">
		<td class="<?php echo $comprador_view->TableLeftColumnClass ?>"><span id="elh_comprador_razon_social"><?php echo $comprador->razon_social->caption() ?></span></td>
		<td data-name="razon_social"<?php echo $comprador->razon_social->cellAttributes() ?>>
<span id="el_comprador_razon_social">
<span<?php echo $comprador->razon_social->viewAttributes() ?>>
<?php echo $comprador->razon_social->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($comprador->rfc->Visible) { // rfc ?>
	<tr id="r_rfc">
		<td class="<?php echo $comprador_view->TableLeftColumnClass ?>"><span id="elh_comprador_rfc"><?php echo $comprador->rfc->caption() ?></span></td>
		<td data-name="rfc"<?php echo $comprador->rfc->cellAttributes() ?>>
<span id="el_comprador_rfc">
<span<?php echo $comprador->rfc->viewAttributes() ?>>
<?php echo $comprador->rfc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($comprador->calle->Visible) { // calle ?>
	<tr id="r_calle">
		<td class="<?php echo $comprador_view->TableLeftColumnClass ?>"><span id="elh_comprador_calle"><?php echo $comprador->calle->caption() ?></span></td>
		<td data-name="calle"<?php echo $comprador->calle->cellAttributes() ?>>
<span id="el_comprador_calle">
<span<?php echo $comprador->calle->viewAttributes() ?>>
<?php echo $comprador->calle->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($comprador->colonia->Visible) { // colonia ?>
	<tr id="r_colonia">
		<td class="<?php echo $comprador_view->TableLeftColumnClass ?>"><span id="elh_comprador_colonia"><?php echo $comprador->colonia->caption() ?></span></td>
		<td data-name="colonia"<?php echo $comprador->colonia->cellAttributes() ?>>
<span id="el_comprador_colonia">
<span<?php echo $comprador->colonia->viewAttributes() ?>>
<?php echo $comprador->colonia->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($comprador->codpostal->Visible) { // codpostal ?>
	<tr id="r_codpostal">
		<td class="<?php echo $comprador_view->TableLeftColumnClass ?>"><span id="elh_comprador_codpostal"><?php echo $comprador->codpostal->caption() ?></span></td>
		<td data-name="codpostal"<?php echo $comprador->codpostal->cellAttributes() ?>>
<span id="el_comprador_codpostal">
<span<?php echo $comprador->codpostal->viewAttributes() ?>>
<?php echo $comprador->codpostal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($comprador->ciudad->Visible) { // ciudad ?>
	<tr id="r_ciudad">
		<td class="<?php echo $comprador_view->TableLeftColumnClass ?>"><span id="elh_comprador_ciudad"><?php echo $comprador->ciudad->caption() ?></span></td>
		<td data-name="ciudad"<?php echo $comprador->ciudad->cellAttributes() ?>>
<span id="el_comprador_ciudad">
<span<?php echo $comprador->ciudad->viewAttributes() ?>>
<?php echo $comprador->ciudad->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($comprador->telefono->Visible) { // telefono ?>
	<tr id="r_telefono">
		<td class="<?php echo $comprador_view->TableLeftColumnClass ?>"><span id="elh_comprador_telefono"><?php echo $comprador->telefono->caption() ?></span></td>
		<td data-name="telefono"<?php echo $comprador->telefono->cellAttributes() ?>>
<span id="el_comprador_telefono">
<span<?php echo $comprador->telefono->viewAttributes() ?>>
<?php echo $comprador->telefono->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($comprador->correo->Visible) { // correo ?>
	<tr id="r_correo">
		<td class="<?php echo $comprador_view->TableLeftColumnClass ?>"><span id="elh_comprador_correo"><?php echo $comprador->correo->caption() ?></span></td>
		<td data-name="correo"<?php echo $comprador->correo->cellAttributes() ?>>
<span id="el_comprador_correo">
<span<?php echo $comprador->correo->viewAttributes() ?>>
<?php echo $comprador->correo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($comprador->pais->Visible) { // pais ?>
	<tr id="r_pais">
		<td class="<?php echo $comprador_view->TableLeftColumnClass ?>"><span id="elh_comprador_pais"><?php echo $comprador->pais->caption() ?></span></td>
		<td data-name="pais"<?php echo $comprador->pais->cellAttributes() ?>>
<span id="el_comprador_pais">
<span<?php echo $comprador->pais->viewAttributes() ?>>
<?php echo $comprador->pais->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($comprador->pymerfc->Visible) { // pymerfc ?>
	<tr id="r_pymerfc">
		<td class="<?php echo $comprador_view->TableLeftColumnClass ?>"><span id="elh_comprador_pymerfc"><?php echo $comprador->pymerfc->caption() ?></span></td>
		<td data-name="pymerfc"<?php echo $comprador->pymerfc->cellAttributes() ?>>
<span id="el_comprador_pymerfc">
<span<?php echo $comprador->pymerfc->viewAttributes() ?>>
<?php echo $comprador->pymerfc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$comprador_view->IsModal) { ?>
<?php if (!$comprador->isExport()) { ?>
<?php if (!isset($comprador_view->Pager)) $comprador_view->Pager = new NumericPager($comprador_view->StartRec, $comprador_view->DisplayRecs, $comprador_view->TotalRecs, $comprador_view->RecRange, $comprador_view->AutoHidePager) ?>
<?php if ($comprador_view->Pager->RecordCount > 0 && $comprador_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($comprador_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $comprador_view->pageUrl() ?>start=<?php echo $comprador_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($comprador_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $comprador_view->pageUrl() ?>start=<?php echo $comprador_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($comprador_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $comprador_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($comprador_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $comprador_view->pageUrl() ?>start=<?php echo $comprador_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($comprador_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $comprador_view->pageUrl() ?>start=<?php echo $comprador_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$comprador_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$comprador->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>

<?php } ?>
<?php include_once "footer.php" ?>

<?php
$comprador_view->terminate();
?>