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
$cedopreafiliacion_view = new cedopreafiliacion_view();

// Run the page
$cedopreafiliacion_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cedopreafiliacion_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$cedopreafiliacion->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fcedopreafiliacionview = currentForm = new ew.Form("fcedopreafiliacionview", "view");

// Form_CustomValidate event
fcedopreafiliacionview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcedopreafiliacionview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$cedopreafiliacion->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $cedopreafiliacion_view->ExportOptions->render("body") ?>
<?php $cedopreafiliacion_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $cedopreafiliacion_view->showPageHeader(); ?>
<?php
$cedopreafiliacion_view->showMessage();
?>
<?php if (!$cedopreafiliacion_view->IsModal) { ?>
<?php if (!$cedopreafiliacion->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($cedopreafiliacion_view->Pager)) $cedopreafiliacion_view->Pager = new NumericPager($cedopreafiliacion_view->StartRec, $cedopreafiliacion_view->DisplayRecs, $cedopreafiliacion_view->TotalRecs, $cedopreafiliacion_view->RecRange, $cedopreafiliacion_view->AutoHidePager) ?>
<?php if ($cedopreafiliacion_view->Pager->RecordCount > 0 && $cedopreafiliacion_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($cedopreafiliacion_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cedopreafiliacion_view->pageUrl() ?>start=<?php echo $cedopreafiliacion_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($cedopreafiliacion_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cedopreafiliacion_view->pageUrl() ?>start=<?php echo $cedopreafiliacion_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($cedopreafiliacion_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $cedopreafiliacion_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($cedopreafiliacion_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cedopreafiliacion_view->pageUrl() ?>start=<?php echo $cedopreafiliacion_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($cedopreafiliacion_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cedopreafiliacion_view->pageUrl() ?>start=<?php echo $cedopreafiliacion_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fcedopreafiliacionview" id="fcedopreafiliacionview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($cedopreafiliacion_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $cedopreafiliacion_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cedopreafiliacion">
<input type="hidden" name="modal" value="<?php echo (int)$cedopreafiliacion_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($cedopreafiliacion->id_edopreafiliado->Visible) { // id_edopreafiliado ?>
	<tr id="r_id_edopreafiliado">
		<td class="<?php echo $cedopreafiliacion_view->TableLeftColumnClass ?>"><span id="elh_cedopreafiliacion_id_edopreafiliado"><?php echo $cedopreafiliacion->id_edopreafiliado->caption() ?></span></td>
		<td data-name="id_edopreafiliado"<?php echo $cedopreafiliacion->id_edopreafiliado->cellAttributes() ?>>
<span id="el_cedopreafiliacion_id_edopreafiliado">
<span<?php echo $cedopreafiliacion->id_edopreafiliado->viewAttributes() ?>>
<?php echo $cedopreafiliacion->id_edopreafiliado->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cedopreafiliacion->descpreafiliado->Visible) { // descpreafiliado ?>
	<tr id="r_descpreafiliado">
		<td class="<?php echo $cedopreafiliacion_view->TableLeftColumnClass ?>"><span id="elh_cedopreafiliacion_descpreafiliado"><?php echo $cedopreafiliacion->descpreafiliado->caption() ?></span></td>
		<td data-name="descpreafiliado"<?php echo $cedopreafiliacion->descpreafiliado->cellAttributes() ?>>
<span id="el_cedopreafiliacion_descpreafiliado">
<span<?php echo $cedopreafiliacion->descpreafiliado->viewAttributes() ?>>
<?php echo $cedopreafiliacion->descpreafiliado->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$cedopreafiliacion_view->IsModal) { ?>
<?php if (!$cedopreafiliacion->isExport()) { ?>
<?php if (!isset($cedopreafiliacion_view->Pager)) $cedopreafiliacion_view->Pager = new NumericPager($cedopreafiliacion_view->StartRec, $cedopreafiliacion_view->DisplayRecs, $cedopreafiliacion_view->TotalRecs, $cedopreafiliacion_view->RecRange, $cedopreafiliacion_view->AutoHidePager) ?>
<?php if ($cedopreafiliacion_view->Pager->RecordCount > 0 && $cedopreafiliacion_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($cedopreafiliacion_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cedopreafiliacion_view->pageUrl() ?>start=<?php echo $cedopreafiliacion_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($cedopreafiliacion_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cedopreafiliacion_view->pageUrl() ?>start=<?php echo $cedopreafiliacion_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($cedopreafiliacion_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $cedopreafiliacion_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($cedopreafiliacion_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cedopreafiliacion_view->pageUrl() ?>start=<?php echo $cedopreafiliacion_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($cedopreafiliacion_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cedopreafiliacion_view->pageUrl() ?>start=<?php echo $cedopreafiliacion_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$cedopreafiliacion_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$cedopreafiliacion->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$cedopreafiliacion_view->terminate();
?>