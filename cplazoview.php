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
$cplazo_view = new cplazo_view();

// Run the page
$cplazo_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cplazo_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$cplazo->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fcplazoview = currentForm = new ew.Form("fcplazoview", "view");

// Form_CustomValidate event
fcplazoview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcplazoview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$cplazo->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $cplazo_view->ExportOptions->render("body") ?>
<?php $cplazo_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $cplazo_view->showPageHeader(); ?>
<?php
$cplazo_view->showMessage();
?>
<?php if (!$cplazo_view->IsModal) { ?>
<?php if (!$cplazo->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($cplazo_view->Pager)) $cplazo_view->Pager = new NumericPager($cplazo_view->StartRec, $cplazo_view->DisplayRecs, $cplazo_view->TotalRecs, $cplazo_view->RecRange, $cplazo_view->AutoHidePager) ?>
<?php if ($cplazo_view->Pager->RecordCount > 0 && $cplazo_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($cplazo_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cplazo_view->pageUrl() ?>start=<?php echo $cplazo_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($cplazo_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cplazo_view->pageUrl() ?>start=<?php echo $cplazo_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($cplazo_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $cplazo_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($cplazo_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cplazo_view->pageUrl() ?>start=<?php echo $cplazo_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($cplazo_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cplazo_view->pageUrl() ?>start=<?php echo $cplazo_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fcplazoview" id="fcplazoview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($cplazo_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $cplazo_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cplazo">
<input type="hidden" name="modal" value="<?php echo (int)$cplazo_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($cplazo->id_plazo->Visible) { // id_plazo ?>
	<tr id="r_id_plazo">
		<td class="<?php echo $cplazo_view->TableLeftColumnClass ?>"><span id="elh_cplazo_id_plazo"><?php echo $cplazo->id_plazo->caption() ?></span></td>
		<td data-name="id_plazo"<?php echo $cplazo->id_plazo->cellAttributes() ?>>
<span id="el_cplazo_id_plazo">
<span<?php echo $cplazo->id_plazo->viewAttributes() ?>>
<?php echo $cplazo->id_plazo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cplazo->Tipo_Plazo->Visible) { // Tipo Plazo ?>
	<tr id="r_Tipo_Plazo">
		<td class="<?php echo $cplazo_view->TableLeftColumnClass ?>"><span id="elh_cplazo_Tipo_Plazo"><?php echo $cplazo->Tipo_Plazo->caption() ?></span></td>
		<td data-name="Tipo_Plazo"<?php echo $cplazo->Tipo_Plazo->cellAttributes() ?>>
<span id="el_cplazo_Tipo_Plazo">
<span<?php echo $cplazo->Tipo_Plazo->viewAttributes() ?>>
<?php echo $cplazo->Tipo_Plazo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$cplazo_view->IsModal) { ?>
<?php if (!$cplazo->isExport()) { ?>
<?php if (!isset($cplazo_view->Pager)) $cplazo_view->Pager = new NumericPager($cplazo_view->StartRec, $cplazo_view->DisplayRecs, $cplazo_view->TotalRecs, $cplazo_view->RecRange, $cplazo_view->AutoHidePager) ?>
<?php if ($cplazo_view->Pager->RecordCount > 0 && $cplazo_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($cplazo_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cplazo_view->pageUrl() ?>start=<?php echo $cplazo_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($cplazo_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cplazo_view->pageUrl() ?>start=<?php echo $cplazo_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($cplazo_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $cplazo_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($cplazo_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cplazo_view->pageUrl() ?>start=<?php echo $cplazo_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($cplazo_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cplazo_view->pageUrl() ?>start=<?php echo $cplazo_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$cplazo_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$cplazo->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$cplazo_view->terminate();
?>