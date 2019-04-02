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
$ccalificacion_view = new ccalificacion_view();

// Run the page
$ccalificacion_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ccalificacion_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$ccalificacion->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fccalificacionview = currentForm = new ew.Form("fccalificacionview", "view");

// Form_CustomValidate event
fccalificacionview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fccalificacionview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$ccalificacion->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $ccalificacion_view->ExportOptions->render("body") ?>
<?php $ccalificacion_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $ccalificacion_view->showPageHeader(); ?>
<?php
$ccalificacion_view->showMessage();
?>
<?php if (!$ccalificacion_view->IsModal) { ?>
<?php if (!$ccalificacion->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($ccalificacion_view->Pager)) $ccalificacion_view->Pager = new NumericPager($ccalificacion_view->StartRec, $ccalificacion_view->DisplayRecs, $ccalificacion_view->TotalRecs, $ccalificacion_view->RecRange, $ccalificacion_view->AutoHidePager) ?>
<?php if ($ccalificacion_view->Pager->RecordCount > 0 && $ccalificacion_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($ccalificacion_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $ccalificacion_view->pageUrl() ?>start=<?php echo $ccalificacion_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($ccalificacion_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $ccalificacion_view->pageUrl() ?>start=<?php echo $ccalificacion_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($ccalificacion_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $ccalificacion_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($ccalificacion_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $ccalificacion_view->pageUrl() ?>start=<?php echo $ccalificacion_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($ccalificacion_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $ccalificacion_view->pageUrl() ?>start=<?php echo $ccalificacion_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fccalificacionview" id="fccalificacionview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($ccalificacion_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $ccalificacion_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ccalificacion">
<input type="hidden" name="modal" value="<?php echo (int)$ccalificacion_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($ccalificacion->idcalificacion->Visible) { // idcalificacion ?>
	<tr id="r_idcalificacion">
		<td class="<?php echo $ccalificacion_view->TableLeftColumnClass ?>"><span id="elh_ccalificacion_idcalificacion"><?php echo $ccalificacion->idcalificacion->caption() ?></span></td>
		<td data-name="idcalificacion"<?php echo $ccalificacion->idcalificacion->cellAttributes() ?>>
<span id="el_ccalificacion_idcalificacion">
<span<?php echo $ccalificacion->idcalificacion->viewAttributes() ?>>
<?php echo $ccalificacion->idcalificacion->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ccalificacion->descripcion->Visible) { // descripcion ?>
	<tr id="r_descripcion">
		<td class="<?php echo $ccalificacion_view->TableLeftColumnClass ?>"><span id="elh_ccalificacion_descripcion"><?php echo $ccalificacion->descripcion->caption() ?></span></td>
		<td data-name="descripcion"<?php echo $ccalificacion->descripcion->cellAttributes() ?>>
<span id="el_ccalificacion_descripcion">
<span<?php echo $ccalificacion->descripcion->viewAttributes() ?>>
<?php echo $ccalificacion->descripcion->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ccalificacion->fondeadorrfc->Visible) { // fondeadorrfc ?>
	<tr id="r_fondeadorrfc">
		<td class="<?php echo $ccalificacion_view->TableLeftColumnClass ?>"><span id="elh_ccalificacion_fondeadorrfc"><?php echo $ccalificacion->fondeadorrfc->caption() ?></span></td>
		<td data-name="fondeadorrfc"<?php echo $ccalificacion->fondeadorrfc->cellAttributes() ?>>
<span id="el_ccalificacion_fondeadorrfc">
<span<?php echo $ccalificacion->fondeadorrfc->viewAttributes() ?>>
<?php echo $ccalificacion->fondeadorrfc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$ccalificacion_view->IsModal) { ?>
<?php if (!$ccalificacion->isExport()) { ?>
<?php if (!isset($ccalificacion_view->Pager)) $ccalificacion_view->Pager = new NumericPager($ccalificacion_view->StartRec, $ccalificacion_view->DisplayRecs, $ccalificacion_view->TotalRecs, $ccalificacion_view->RecRange, $ccalificacion_view->AutoHidePager) ?>
<?php if ($ccalificacion_view->Pager->RecordCount > 0 && $ccalificacion_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($ccalificacion_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $ccalificacion_view->pageUrl() ?>start=<?php echo $ccalificacion_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($ccalificacion_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $ccalificacion_view->pageUrl() ?>start=<?php echo $ccalificacion_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($ccalificacion_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $ccalificacion_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($ccalificacion_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $ccalificacion_view->pageUrl() ?>start=<?php echo $ccalificacion_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($ccalificacion_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $ccalificacion_view->pageUrl() ?>start=<?php echo $ccalificacion_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$ccalificacion_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$ccalificacion->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$ccalificacion_view->terminate();
?>