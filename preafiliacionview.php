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
$preafiliacion_view = new preafiliacion_view();

// Run the page
$preafiliacion_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$preafiliacion_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$preafiliacion->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fpreafiliacionview = currentForm = new ew.Form("fpreafiliacionview", "view");

// Form_CustomValidate event
fpreafiliacionview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fpreafiliacionview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fpreafiliacionview.lists["x_estadopreaafilia"] = <?php echo $preafiliacion_view->estadopreaafilia->Lookup->toClientList() ?>;
fpreafiliacionview.lists["x_estadopreaafilia"].options = <?php echo JsonEncode($preafiliacion_view->estadopreaafilia->lookupOptions()) ?>;
fpreafiliacionview.autoSuggests["x_estadopreaafilia"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$preafiliacion->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $preafiliacion_view->ExportOptions->render("body") ?>
<?php $preafiliacion_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $preafiliacion_view->showPageHeader(); ?>
<?php
$preafiliacion_view->showMessage();
?>
<?php if (!$preafiliacion_view->IsModal) { ?>
<?php if (!$preafiliacion->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($preafiliacion_view->Pager)) $preafiliacion_view->Pager = new NumericPager($preafiliacion_view->StartRec, $preafiliacion_view->DisplayRecs, $preafiliacion_view->TotalRecs, $preafiliacion_view->RecRange, $preafiliacion_view->AutoHidePager) ?>
<?php if ($preafiliacion_view->Pager->RecordCount > 0 && $preafiliacion_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($preafiliacion_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $preafiliacion_view->pageUrl() ?>start=<?php echo $preafiliacion_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($preafiliacion_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $preafiliacion_view->pageUrl() ?>start=<?php echo $preafiliacion_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($preafiliacion_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $preafiliacion_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($preafiliacion_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $preafiliacion_view->pageUrl() ?>start=<?php echo $preafiliacion_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($preafiliacion_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $preafiliacion_view->pageUrl() ?>start=<?php echo $preafiliacion_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fpreafiliacionview" id="fpreafiliacionview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($preafiliacion_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $preafiliacion_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="preafiliacion">
<input type="hidden" name="modal" value="<?php echo (int)$preafiliacion_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($preafiliacion->idafiliado->Visible) { // idafiliado ?>
	<tr id="r_idafiliado">
		<td class="<?php echo $preafiliacion_view->TableLeftColumnClass ?>"><span id="elh_preafiliacion_idafiliado"><?php echo $preafiliacion->idafiliado->caption() ?></span></td>
		<td data-name="idafiliado"<?php echo $preafiliacion->idafiliado->cellAttributes() ?>>
<span id="el_preafiliacion_idafiliado">
<span<?php echo $preafiliacion->idafiliado->viewAttributes() ?>>
<?php echo $preafiliacion->idafiliado->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($preafiliacion->tipoentidad->Visible) { // tipoentidad ?>
	<tr id="r_tipoentidad">
		<td class="<?php echo $preafiliacion_view->TableLeftColumnClass ?>"><span id="elh_preafiliacion_tipoentidad"><?php echo $preafiliacion->tipoentidad->caption() ?></span></td>
		<td data-name="tipoentidad"<?php echo $preafiliacion->tipoentidad->cellAttributes() ?>>
<span id="el_preafiliacion_tipoentidad">
<span<?php echo $preafiliacion->tipoentidad->viewAttributes() ?>>
<?php echo $preafiliacion->tipoentidad->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($preafiliacion->fechaafiliacion->Visible) { // fechaafiliacion ?>
	<tr id="r_fechaafiliacion">
		<td class="<?php echo $preafiliacion_view->TableLeftColumnClass ?>"><span id="elh_preafiliacion_fechaafiliacion"><?php echo $preafiliacion->fechaafiliacion->caption() ?></span></td>
		<td data-name="fechaafiliacion"<?php echo $preafiliacion->fechaafiliacion->cellAttributes() ?>>
<span id="el_preafiliacion_fechaafiliacion">
<span<?php echo $preafiliacion->fechaafiliacion->viewAttributes() ?>>
<?php echo $preafiliacion->fechaafiliacion->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($preafiliacion->nombrerazon->Visible) { // nombrerazon ?>
	<tr id="r_nombrerazon">
		<td class="<?php echo $preafiliacion_view->TableLeftColumnClass ?>"><span id="elh_preafiliacion_nombrerazon"><?php echo $preafiliacion->nombrerazon->caption() ?></span></td>
		<td data-name="nombrerazon"<?php echo $preafiliacion->nombrerazon->cellAttributes() ?>>
<span id="el_preafiliacion_nombrerazon">
<span<?php echo $preafiliacion->nombrerazon->viewAttributes() ?>>
<?php echo $preafiliacion->nombrerazon->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($preafiliacion->telefono->Visible) { // telefono ?>
	<tr id="r_telefono">
		<td class="<?php echo $preafiliacion_view->TableLeftColumnClass ?>"><span id="elh_preafiliacion_telefono"><?php echo $preafiliacion->telefono->caption() ?></span></td>
		<td data-name="telefono"<?php echo $preafiliacion->telefono->cellAttributes() ?>>
<span id="el_preafiliacion_telefono">
<span<?php echo $preafiliacion->telefono->viewAttributes() ?>>
<?php echo $preafiliacion->telefono->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($preafiliacion->rfcentidad->Visible) { // rfcentidad ?>
	<tr id="r_rfcentidad">
		<td class="<?php echo $preafiliacion_view->TableLeftColumnClass ?>"><span id="elh_preafiliacion_rfcentidad"><?php echo $preafiliacion->rfcentidad->caption() ?></span></td>
		<td data-name="rfcentidad"<?php echo $preafiliacion->rfcentidad->cellAttributes() ?>>
<span id="el_preafiliacion_rfcentidad">
<span<?php echo $preafiliacion->rfcentidad->viewAttributes() ?>>
<?php echo $preafiliacion->rfcentidad->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($preafiliacion->estadopreaafilia->Visible) { // estadopreaafilia ?>
	<tr id="r_estadopreaafilia">
		<td class="<?php echo $preafiliacion_view->TableLeftColumnClass ?>"><span id="elh_preafiliacion_estadopreaafilia"><?php echo $preafiliacion->estadopreaafilia->caption() ?></span></td>
		<td data-name="estadopreaafilia"<?php echo $preafiliacion->estadopreaafilia->cellAttributes() ?>>
<span id="el_preafiliacion_estadopreaafilia">
<span<?php echo $preafiliacion->estadopreaafilia->viewAttributes() ?>>
<?php echo $preafiliacion->estadopreaafilia->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$preafiliacion_view->IsModal) { ?>
<?php if (!$preafiliacion->isExport()) { ?>
<?php if (!isset($preafiliacion_view->Pager)) $preafiliacion_view->Pager = new NumericPager($preafiliacion_view->StartRec, $preafiliacion_view->DisplayRecs, $preafiliacion_view->TotalRecs, $preafiliacion_view->RecRange, $preafiliacion_view->AutoHidePager) ?>
<?php if ($preafiliacion_view->Pager->RecordCount > 0 && $preafiliacion_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($preafiliacion_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $preafiliacion_view->pageUrl() ?>start=<?php echo $preafiliacion_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($preafiliacion_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $preafiliacion_view->pageUrl() ?>start=<?php echo $preafiliacion_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($preafiliacion_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $preafiliacion_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($preafiliacion_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $preafiliacion_view->pageUrl() ?>start=<?php echo $preafiliacion_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($preafiliacion_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $preafiliacion_view->pageUrl() ?>start=<?php echo $preafiliacion_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$preafiliacion_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$preafiliacion->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$preafiliacion_view->terminate();
?>