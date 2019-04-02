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
$cestadofactura_view = new cestadofactura_view();

// Run the page
$cestadofactura_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cestadofactura_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$cestadofactura->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fcestadofacturaview = currentForm = new ew.Form("fcestadofacturaview", "view");

// Form_CustomValidate event
fcestadofacturaview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcestadofacturaview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$cestadofactura->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $cestadofactura_view->ExportOptions->render("body") ?>
<?php $cestadofactura_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $cestadofactura_view->showPageHeader(); ?>
<?php
$cestadofactura_view->showMessage();
?>
<?php if (!$cestadofactura_view->IsModal) { ?>
<?php if (!$cestadofactura->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($cestadofactura_view->Pager)) $cestadofactura_view->Pager = new NumericPager($cestadofactura_view->StartRec, $cestadofactura_view->DisplayRecs, $cestadofactura_view->TotalRecs, $cestadofactura_view->RecRange, $cestadofactura_view->AutoHidePager) ?>
<?php if ($cestadofactura_view->Pager->RecordCount > 0 && $cestadofactura_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($cestadofactura_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cestadofactura_view->pageUrl() ?>start=<?php echo $cestadofactura_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($cestadofactura_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cestadofactura_view->pageUrl() ?>start=<?php echo $cestadofactura_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($cestadofactura_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $cestadofactura_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($cestadofactura_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cestadofactura_view->pageUrl() ?>start=<?php echo $cestadofactura_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($cestadofactura_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cestadofactura_view->pageUrl() ?>start=<?php echo $cestadofactura_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fcestadofacturaview" id="fcestadofacturaview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($cestadofactura_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $cestadofactura_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cestadofactura">
<input type="hidden" name="modal" value="<?php echo (int)$cestadofactura_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($cestadofactura->id_edofactura->Visible) { // id_edofactura ?>
	<tr id="r_id_edofactura">
		<td class="<?php echo $cestadofactura_view->TableLeftColumnClass ?>"><span id="elh_cestadofactura_id_edofactura"><?php echo $cestadofactura->id_edofactura->caption() ?></span></td>
		<td data-name="id_edofactura"<?php echo $cestadofactura->id_edofactura->cellAttributes() ?>>
<span id="el_cestadofactura_id_edofactura">
<span<?php echo $cestadofactura->id_edofactura->viewAttributes() ?>>
<?php echo $cestadofactura->id_edofactura->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cestadofactura->descedofactura->Visible) { // descedofactura ?>
	<tr id="r_descedofactura">
		<td class="<?php echo $cestadofactura_view->TableLeftColumnClass ?>"><span id="elh_cestadofactura_descedofactura"><?php echo $cestadofactura->descedofactura->caption() ?></span></td>
		<td data-name="descedofactura"<?php echo $cestadofactura->descedofactura->cellAttributes() ?>>
<span id="el_cestadofactura_descedofactura">
<span<?php echo $cestadofactura->descedofactura->viewAttributes() ?>>
<?php echo $cestadofactura->descedofactura->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$cestadofactura_view->IsModal) { ?>
<?php if (!$cestadofactura->isExport()) { ?>
<?php if (!isset($cestadofactura_view->Pager)) $cestadofactura_view->Pager = new NumericPager($cestadofactura_view->StartRec, $cestadofactura_view->DisplayRecs, $cestadofactura_view->TotalRecs, $cestadofactura_view->RecRange, $cestadofactura_view->AutoHidePager) ?>
<?php if ($cestadofactura_view->Pager->RecordCount > 0 && $cestadofactura_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($cestadofactura_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cestadofactura_view->pageUrl() ?>start=<?php echo $cestadofactura_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($cestadofactura_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cestadofactura_view->pageUrl() ?>start=<?php echo $cestadofactura_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($cestadofactura_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $cestadofactura_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($cestadofactura_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cestadofactura_view->pageUrl() ?>start=<?php echo $cestadofactura_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($cestadofactura_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cestadofactura_view->pageUrl() ?>start=<?php echo $cestadofactura_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$cestadofactura_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$cestadofactura->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$cestadofactura_view->terminate();
?>