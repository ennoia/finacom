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
$ctipomonto_view = new ctipomonto_view();

// Run the page
$ctipomonto_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ctipomonto_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$ctipomonto->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fctipomontoview = currentForm = new ew.Form("fctipomontoview", "view");

// Form_CustomValidate event
fctipomontoview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fctipomontoview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$ctipomonto->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $ctipomonto_view->ExportOptions->render("body") ?>
<?php $ctipomonto_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $ctipomonto_view->showPageHeader(); ?>
<?php
$ctipomonto_view->showMessage();
?>
<?php if (!$ctipomonto_view->IsModal) { ?>
<?php if (!$ctipomonto->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($ctipomonto_view->Pager)) $ctipomonto_view->Pager = new NumericPager($ctipomonto_view->StartRec, $ctipomonto_view->DisplayRecs, $ctipomonto_view->TotalRecs, $ctipomonto_view->RecRange, $ctipomonto_view->AutoHidePager) ?>
<?php if ($ctipomonto_view->Pager->RecordCount > 0 && $ctipomonto_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($ctipomonto_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $ctipomonto_view->pageUrl() ?>start=<?php echo $ctipomonto_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($ctipomonto_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $ctipomonto_view->pageUrl() ?>start=<?php echo $ctipomonto_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($ctipomonto_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $ctipomonto_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($ctipomonto_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $ctipomonto_view->pageUrl() ?>start=<?php echo $ctipomonto_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($ctipomonto_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $ctipomonto_view->pageUrl() ?>start=<?php echo $ctipomonto_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fctipomontoview" id="fctipomontoview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($ctipomonto_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $ctipomonto_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ctipomonto">
<input type="hidden" name="modal" value="<?php echo (int)$ctipomonto_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($ctipomonto->idtipomonto->Visible) { // idtipomonto ?>
	<tr id="r_idtipomonto">
		<td class="<?php echo $ctipomonto_view->TableLeftColumnClass ?>"><span id="elh_ctipomonto_idtipomonto"><?php echo $ctipomonto->idtipomonto->caption() ?></span></td>
		<td data-name="idtipomonto"<?php echo $ctipomonto->idtipomonto->cellAttributes() ?>>
<span id="el_ctipomonto_idtipomonto">
<span<?php echo $ctipomonto->idtipomonto->viewAttributes() ?>>
<?php echo $ctipomonto->idtipomonto->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ctipomonto->descripcion->Visible) { // descripcion ?>
	<tr id="r_descripcion">
		<td class="<?php echo $ctipomonto_view->TableLeftColumnClass ?>"><span id="elh_ctipomonto_descripcion"><?php echo $ctipomonto->descripcion->caption() ?></span></td>
		<td data-name="descripcion"<?php echo $ctipomonto->descripcion->cellAttributes() ?>>
<span id="el_ctipomonto_descripcion">
<span<?php echo $ctipomonto->descripcion->viewAttributes() ?>>
<?php echo $ctipomonto->descripcion->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$ctipomonto_view->IsModal) { ?>
<?php if (!$ctipomonto->isExport()) { ?>
<?php if (!isset($ctipomonto_view->Pager)) $ctipomonto_view->Pager = new NumericPager($ctipomonto_view->StartRec, $ctipomonto_view->DisplayRecs, $ctipomonto_view->TotalRecs, $ctipomonto_view->RecRange, $ctipomonto_view->AutoHidePager) ?>
<?php if ($ctipomonto_view->Pager->RecordCount > 0 && $ctipomonto_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($ctipomonto_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $ctipomonto_view->pageUrl() ?>start=<?php echo $ctipomonto_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($ctipomonto_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $ctipomonto_view->pageUrl() ?>start=<?php echo $ctipomonto_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($ctipomonto_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $ctipomonto_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($ctipomonto_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $ctipomonto_view->pageUrl() ?>start=<?php echo $ctipomonto_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($ctipomonto_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $ctipomonto_view->pageUrl() ?>start=<?php echo $ctipomonto_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$ctipomonto_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$ctipomonto->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$ctipomonto_view->terminate();
?>