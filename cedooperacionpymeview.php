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
$cedooperacionpyme_view = new cedooperacionpyme_view();

// Run the page
$cedooperacionpyme_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cedooperacionpyme_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$cedooperacionpyme->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fcedooperacionpymeview = currentForm = new ew.Form("fcedooperacionpymeview", "view");

// Form_CustomValidate event
fcedooperacionpymeview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcedooperacionpymeview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$cedooperacionpyme->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $cedooperacionpyme_view->ExportOptions->render("body") ?>
<?php $cedooperacionpyme_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $cedooperacionpyme_view->showPageHeader(); ?>
<?php
$cedooperacionpyme_view->showMessage();
?>
<?php if (!$cedooperacionpyme_view->IsModal) { ?>
<?php if (!$cedooperacionpyme->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($cedooperacionpyme_view->Pager)) $cedooperacionpyme_view->Pager = new NumericPager($cedooperacionpyme_view->StartRec, $cedooperacionpyme_view->DisplayRecs, $cedooperacionpyme_view->TotalRecs, $cedooperacionpyme_view->RecRange, $cedooperacionpyme_view->AutoHidePager) ?>
<?php if ($cedooperacionpyme_view->Pager->RecordCount > 0 && $cedooperacionpyme_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($cedooperacionpyme_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cedooperacionpyme_view->pageUrl() ?>start=<?php echo $cedooperacionpyme_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($cedooperacionpyme_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cedooperacionpyme_view->pageUrl() ?>start=<?php echo $cedooperacionpyme_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($cedooperacionpyme_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $cedooperacionpyme_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($cedooperacionpyme_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cedooperacionpyme_view->pageUrl() ?>start=<?php echo $cedooperacionpyme_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($cedooperacionpyme_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cedooperacionpyme_view->pageUrl() ?>start=<?php echo $cedooperacionpyme_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fcedooperacionpymeview" id="fcedooperacionpymeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($cedooperacionpyme_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $cedooperacionpyme_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cedooperacionpyme">
<input type="hidden" name="modal" value="<?php echo (int)$cedooperacionpyme_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($cedooperacionpyme->id_estaus->Visible) { // id_estaus ?>
	<tr id="r_id_estaus">
		<td class="<?php echo $cedooperacionpyme_view->TableLeftColumnClass ?>"><span id="elh_cedooperacionpyme_id_estaus"><?php echo $cedooperacionpyme->id_estaus->caption() ?></span></td>
		<td data-name="id_estaus"<?php echo $cedooperacionpyme->id_estaus->cellAttributes() ?>>
<span id="el_cedooperacionpyme_id_estaus">
<span<?php echo $cedooperacionpyme->id_estaus->viewAttributes() ?>>
<?php echo $cedooperacionpyme->id_estaus->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cedooperacionpyme->descripcion->Visible) { // descripcion ?>
	<tr id="r_descripcion">
		<td class="<?php echo $cedooperacionpyme_view->TableLeftColumnClass ?>"><span id="elh_cedooperacionpyme_descripcion"><?php echo $cedooperacionpyme->descripcion->caption() ?></span></td>
		<td data-name="descripcion"<?php echo $cedooperacionpyme->descripcion->cellAttributes() ?>>
<span id="el_cedooperacionpyme_descripcion">
<span<?php echo $cedooperacionpyme->descripcion->viewAttributes() ?>>
<?php echo $cedooperacionpyme->descripcion->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$cedooperacionpyme_view->IsModal) { ?>
<?php if (!$cedooperacionpyme->isExport()) { ?>
<?php if (!isset($cedooperacionpyme_view->Pager)) $cedooperacionpyme_view->Pager = new NumericPager($cedooperacionpyme_view->StartRec, $cedooperacionpyme_view->DisplayRecs, $cedooperacionpyme_view->TotalRecs, $cedooperacionpyme_view->RecRange, $cedooperacionpyme_view->AutoHidePager) ?>
<?php if ($cedooperacionpyme_view->Pager->RecordCount > 0 && $cedooperacionpyme_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($cedooperacionpyme_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cedooperacionpyme_view->pageUrl() ?>start=<?php echo $cedooperacionpyme_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($cedooperacionpyme_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cedooperacionpyme_view->pageUrl() ?>start=<?php echo $cedooperacionpyme_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($cedooperacionpyme_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $cedooperacionpyme_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($cedooperacionpyme_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cedooperacionpyme_view->pageUrl() ?>start=<?php echo $cedooperacionpyme_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($cedooperacionpyme_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cedooperacionpyme_view->pageUrl() ?>start=<?php echo $cedooperacionpyme_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$cedooperacionpyme_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$cedooperacionpyme->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$cedooperacionpyme_view->terminate();
?>