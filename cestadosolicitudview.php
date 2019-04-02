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
$cestadosolicitud_view = new cestadosolicitud_view();

// Run the page
$cestadosolicitud_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cestadosolicitud_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$cestadosolicitud->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fcestadosolicitudview = currentForm = new ew.Form("fcestadosolicitudview", "view");

// Form_CustomValidate event
fcestadosolicitudview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcestadosolicitudview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$cestadosolicitud->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $cestadosolicitud_view->ExportOptions->render("body") ?>
<?php $cestadosolicitud_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $cestadosolicitud_view->showPageHeader(); ?>
<?php
$cestadosolicitud_view->showMessage();
?>
<?php if (!$cestadosolicitud_view->IsModal) { ?>
<?php if (!$cestadosolicitud->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($cestadosolicitud_view->Pager)) $cestadosolicitud_view->Pager = new NumericPager($cestadosolicitud_view->StartRec, $cestadosolicitud_view->DisplayRecs, $cestadosolicitud_view->TotalRecs, $cestadosolicitud_view->RecRange, $cestadosolicitud_view->AutoHidePager) ?>
<?php if ($cestadosolicitud_view->Pager->RecordCount > 0 && $cestadosolicitud_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($cestadosolicitud_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cestadosolicitud_view->pageUrl() ?>start=<?php echo $cestadosolicitud_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($cestadosolicitud_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cestadosolicitud_view->pageUrl() ?>start=<?php echo $cestadosolicitud_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($cestadosolicitud_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $cestadosolicitud_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($cestadosolicitud_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cestadosolicitud_view->pageUrl() ?>start=<?php echo $cestadosolicitud_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($cestadosolicitud_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cestadosolicitud_view->pageUrl() ?>start=<?php echo $cestadosolicitud_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fcestadosolicitudview" id="fcestadosolicitudview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($cestadosolicitud_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $cestadosolicitud_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cestadosolicitud">
<input type="hidden" name="modal" value="<?php echo (int)$cestadosolicitud_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($cestadosolicitud->id_edosolicitud->Visible) { // id_edosolicitud ?>
	<tr id="r_id_edosolicitud">
		<td class="<?php echo $cestadosolicitud_view->TableLeftColumnClass ?>"><span id="elh_cestadosolicitud_id_edosolicitud"><?php echo $cestadosolicitud->id_edosolicitud->caption() ?></span></td>
		<td data-name="id_edosolicitud"<?php echo $cestadosolicitud->id_edosolicitud->cellAttributes() ?>>
<span id="el_cestadosolicitud_id_edosolicitud">
<span<?php echo $cestadosolicitud->id_edosolicitud->viewAttributes() ?>>
<?php echo $cestadosolicitud->id_edosolicitud->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cestadosolicitud->descestadooperacion->Visible) { // descestadooperacion ?>
	<tr id="r_descestadooperacion">
		<td class="<?php echo $cestadosolicitud_view->TableLeftColumnClass ?>"><span id="elh_cestadosolicitud_descestadooperacion"><?php echo $cestadosolicitud->descestadooperacion->caption() ?></span></td>
		<td data-name="descestadooperacion"<?php echo $cestadosolicitud->descestadooperacion->cellAttributes() ?>>
<span id="el_cestadosolicitud_descestadooperacion">
<span<?php echo $cestadosolicitud->descestadooperacion->viewAttributes() ?>>
<?php echo $cestadosolicitud->descestadooperacion->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$cestadosolicitud_view->IsModal) { ?>
<?php if (!$cestadosolicitud->isExport()) { ?>
<?php if (!isset($cestadosolicitud_view->Pager)) $cestadosolicitud_view->Pager = new NumericPager($cestadosolicitud_view->StartRec, $cestadosolicitud_view->DisplayRecs, $cestadosolicitud_view->TotalRecs, $cestadosolicitud_view->RecRange, $cestadosolicitud_view->AutoHidePager) ?>
<?php if ($cestadosolicitud_view->Pager->RecordCount > 0 && $cestadosolicitud_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($cestadosolicitud_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cestadosolicitud_view->pageUrl() ?>start=<?php echo $cestadosolicitud_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($cestadosolicitud_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cestadosolicitud_view->pageUrl() ?>start=<?php echo $cestadosolicitud_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($cestadosolicitud_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $cestadosolicitud_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($cestadosolicitud_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cestadosolicitud_view->pageUrl() ?>start=<?php echo $cestadosolicitud_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($cestadosolicitud_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cestadosolicitud_view->pageUrl() ?>start=<?php echo $cestadosolicitud_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$cestadosolicitud_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$cestadosolicitud->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$cestadosolicitud_view->terminate();
?>