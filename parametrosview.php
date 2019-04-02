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
$parametros_view = new parametros_view();

// Run the page
$parametros_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$parametros_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$parametros->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fparametrosview = currentForm = new ew.Form("fparametrosview", "view");

// Form_CustomValidate event
fparametrosview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fparametrosview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$parametros->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $parametros_view->ExportOptions->render("body") ?>
<?php $parametros_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $parametros_view->showPageHeader(); ?>
<?php
$parametros_view->showMessage();
?>
<?php if (!$parametros_view->IsModal) { ?>
<?php if (!$parametros->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($parametros_view->Pager)) $parametros_view->Pager = new NumericPager($parametros_view->StartRec, $parametros_view->DisplayRecs, $parametros_view->TotalRecs, $parametros_view->RecRange, $parametros_view->AutoHidePager) ?>
<?php if ($parametros_view->Pager->RecordCount > 0 && $parametros_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($parametros_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $parametros_view->pageUrl() ?>start=<?php echo $parametros_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($parametros_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $parametros_view->pageUrl() ?>start=<?php echo $parametros_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($parametros_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $parametros_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($parametros_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $parametros_view->pageUrl() ?>start=<?php echo $parametros_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($parametros_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $parametros_view->pageUrl() ?>start=<?php echo $parametros_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fparametrosview" id="fparametrosview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($parametros_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $parametros_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="parametros">
<input type="hidden" name="modal" value="<?php echo (int)$parametros_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($parametros->id_parametro->Visible) { // id_parametro ?>
	<tr id="r_id_parametro">
		<td class="<?php echo $parametros_view->TableLeftColumnClass ?>"><span id="elh_parametros_id_parametro"><?php echo $parametros->id_parametro->caption() ?></span></td>
		<td data-name="id_parametro"<?php echo $parametros->id_parametro->cellAttributes() ?>>
<span id="el_parametros_id_parametro">
<span<?php echo $parametros->id_parametro->viewAttributes() ?>>
<?php echo $parametros->id_parametro->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($parametros->diascalculo->Visible) { // diascalculo ?>
	<tr id="r_diascalculo">
		<td class="<?php echo $parametros_view->TableLeftColumnClass ?>"><span id="elh_parametros_diascalculo"><?php echo $parametros->diascalculo->caption() ?></span></td>
		<td data-name="diascalculo"<?php echo $parametros->diascalculo->cellAttributes() ?>>
<span id="el_parametros_diascalculo">
<span<?php echo $parametros->diascalculo->viewAttributes() ?>>
<?php echo $parametros->diascalculo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($parametros->modulo->Visible) { // modulo ?>
	<tr id="r_modulo">
		<td class="<?php echo $parametros_view->TableLeftColumnClass ?>"><span id="elh_parametros_modulo"><?php echo $parametros->modulo->caption() ?></span></td>
		<td data-name="modulo"<?php echo $parametros->modulo->cellAttributes() ?>>
<span id="el_parametros_modulo">
<span<?php echo $parametros->modulo->viewAttributes() ?>>
<?php echo $parametros->modulo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($parametros->unidadmedida->Visible) { // unidadmedida ?>
	<tr id="r_unidadmedida">
		<td class="<?php echo $parametros_view->TableLeftColumnClass ?>"><span id="elh_parametros_unidadmedida"><?php echo $parametros->unidadmedida->caption() ?></span></td>
		<td data-name="unidadmedida"<?php echo $parametros->unidadmedida->cellAttributes() ?>>
<span id="el_parametros_unidadmedida">
<span<?php echo $parametros->unidadmedida->viewAttributes() ?>>
<?php echo $parametros->unidadmedida->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$parametros_view->IsModal) { ?>
<?php if (!$parametros->isExport()) { ?>
<?php if (!isset($parametros_view->Pager)) $parametros_view->Pager = new NumericPager($parametros_view->StartRec, $parametros_view->DisplayRecs, $parametros_view->TotalRecs, $parametros_view->RecRange, $parametros_view->AutoHidePager) ?>
<?php if ($parametros_view->Pager->RecordCount > 0 && $parametros_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($parametros_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $parametros_view->pageUrl() ?>start=<?php echo $parametros_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($parametros_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $parametros_view->pageUrl() ?>start=<?php echo $parametros_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($parametros_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $parametros_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($parametros_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $parametros_view->pageUrl() ?>start=<?php echo $parametros_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($parametros_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $parametros_view->pageUrl() ?>start=<?php echo $parametros_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$parametros_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$parametros->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$parametros_view->terminate();
?>