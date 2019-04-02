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
$oferta_view = new oferta_view();

// Run the page
$oferta_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$oferta_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$oferta->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fofertaview = currentForm = new ew.Form("fofertaview", "view");

// Form_CustomValidate event
fofertaview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fofertaview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$oferta->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $oferta_view->ExportOptions->render("body") ?>
<?php $oferta_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $oferta_view->showPageHeader(); ?>
<?php
$oferta_view->showMessage();
?>
<?php if (!$oferta_view->IsModal) { ?>
<?php if (!$oferta->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($oferta_view->Pager)) $oferta_view->Pager = new NumericPager($oferta_view->StartRec, $oferta_view->DisplayRecs, $oferta_view->TotalRecs, $oferta_view->RecRange, $oferta_view->AutoHidePager) ?>
<?php if ($oferta_view->Pager->RecordCount > 0 && $oferta_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($oferta_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $oferta_view->pageUrl() ?>start=<?php echo $oferta_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($oferta_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $oferta_view->pageUrl() ?>start=<?php echo $oferta_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($oferta_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $oferta_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($oferta_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $oferta_view->pageUrl() ?>start=<?php echo $oferta_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($oferta_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $oferta_view->pageUrl() ?>start=<?php echo $oferta_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fofertaview" id="fofertaview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($oferta_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $oferta_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="oferta">
<input type="hidden" name="modal" value="<?php echo (int)$oferta_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($oferta->idoferta->Visible) { // idoferta ?>
	<tr id="r_idoferta">
		<td class="<?php echo $oferta_view->TableLeftColumnClass ?>"><span id="elh_oferta_idoferta"><?php echo $oferta->idoferta->caption() ?></span></td>
		<td data-name="idoferta"<?php echo $oferta->idoferta->cellAttributes() ?>>
<span id="el_oferta_idoferta">
<span<?php echo $oferta->idoferta->viewAttributes() ?>>
<?php echo $oferta->idoferta->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($oferta->fechaoferta->Visible) { // fechaoferta ?>
	<tr id="r_fechaoferta">
		<td class="<?php echo $oferta_view->TableLeftColumnClass ?>"><span id="elh_oferta_fechaoferta"><?php echo $oferta->fechaoferta->caption() ?></span></td>
		<td data-name="fechaoferta"<?php echo $oferta->fechaoferta->cellAttributes() ?>>
<span id="el_oferta_fechaoferta">
<span<?php echo $oferta->fechaoferta->viewAttributes() ?>>
<?php echo $oferta->fechaoferta->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($oferta->descripcionoferta->Visible) { // descripcionoferta ?>
	<tr id="r_descripcionoferta">
		<td class="<?php echo $oferta_view->TableLeftColumnClass ?>"><span id="elh_oferta_descripcionoferta"><?php echo $oferta->descripcionoferta->caption() ?></span></td>
		<td data-name="descripcionoferta"<?php echo $oferta->descripcionoferta->cellAttributes() ?>>
<span id="el_oferta_descripcionoferta">
<span<?php echo $oferta->descripcionoferta->viewAttributes() ?>>
<?php echo $oferta->descripcionoferta->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$oferta_view->IsModal) { ?>
<?php if (!$oferta->isExport()) { ?>
<?php if (!isset($oferta_view->Pager)) $oferta_view->Pager = new NumericPager($oferta_view->StartRec, $oferta_view->DisplayRecs, $oferta_view->TotalRecs, $oferta_view->RecRange, $oferta_view->AutoHidePager) ?>
<?php if ($oferta_view->Pager->RecordCount > 0 && $oferta_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($oferta_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $oferta_view->pageUrl() ?>start=<?php echo $oferta_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($oferta_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $oferta_view->pageUrl() ?>start=<?php echo $oferta_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($oferta_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $oferta_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($oferta_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $oferta_view->pageUrl() ?>start=<?php echo $oferta_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($oferta_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $oferta_view->pageUrl() ?>start=<?php echo $oferta_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$oferta_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$oferta->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$oferta_view->terminate();
?>