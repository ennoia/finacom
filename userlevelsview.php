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
$userlevels_view = new userlevels_view();

// Run the page
$userlevels_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$userlevels_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$userlevels->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fuserlevelsview = currentForm = new ew.Form("fuserlevelsview", "view");

// Form_CustomValidate event
fuserlevelsview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fuserlevelsview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$userlevels->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $userlevels_view->ExportOptions->render("body") ?>
<?php $userlevels_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $userlevels_view->showPageHeader(); ?>
<?php
$userlevels_view->showMessage();
?>
<?php if (!$userlevels_view->IsModal) { ?>
<?php if (!$userlevels->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($userlevels_view->Pager)) $userlevels_view->Pager = new NumericPager($userlevels_view->StartRec, $userlevels_view->DisplayRecs, $userlevels_view->TotalRecs, $userlevels_view->RecRange, $userlevels_view->AutoHidePager) ?>
<?php if ($userlevels_view->Pager->RecordCount > 0 && $userlevels_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($userlevels_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $userlevels_view->pageUrl() ?>start=<?php echo $userlevels_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($userlevels_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $userlevels_view->pageUrl() ?>start=<?php echo $userlevels_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($userlevels_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $userlevels_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($userlevels_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $userlevels_view->pageUrl() ?>start=<?php echo $userlevels_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($userlevels_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $userlevels_view->pageUrl() ?>start=<?php echo $userlevels_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fuserlevelsview" id="fuserlevelsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($userlevels_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $userlevels_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="userlevels">
<input type="hidden" name="modal" value="<?php echo (int)$userlevels_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($userlevels->userlevelid->Visible) { // userlevelid ?>
	<tr id="r_userlevelid">
		<td class="<?php echo $userlevels_view->TableLeftColumnClass ?>"><span id="elh_userlevels_userlevelid"><?php echo $userlevels->userlevelid->caption() ?></span></td>
		<td data-name="userlevelid"<?php echo $userlevels->userlevelid->cellAttributes() ?>>
<span id="el_userlevels_userlevelid">
<span<?php echo $userlevels->userlevelid->viewAttributes() ?>>
<?php echo $userlevels->userlevelid->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($userlevels->userlevelname->Visible) { // userlevelname ?>
	<tr id="r_userlevelname">
		<td class="<?php echo $userlevels_view->TableLeftColumnClass ?>"><span id="elh_userlevels_userlevelname"><?php echo $userlevels->userlevelname->caption() ?></span></td>
		<td data-name="userlevelname"<?php echo $userlevels->userlevelname->cellAttributes() ?>>
<span id="el_userlevels_userlevelname">
<span<?php echo $userlevels->userlevelname->viewAttributes() ?>>
<?php echo $userlevels->userlevelname->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$userlevels_view->IsModal) { ?>
<?php if (!$userlevels->isExport()) { ?>
<?php if (!isset($userlevels_view->Pager)) $userlevels_view->Pager = new NumericPager($userlevels_view->StartRec, $userlevels_view->DisplayRecs, $userlevels_view->TotalRecs, $userlevels_view->RecRange, $userlevels_view->AutoHidePager) ?>
<?php if ($userlevels_view->Pager->RecordCount > 0 && $userlevels_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($userlevels_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $userlevels_view->pageUrl() ?>start=<?php echo $userlevels_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($userlevels_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $userlevels_view->pageUrl() ?>start=<?php echo $userlevels_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($userlevels_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $userlevels_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($userlevels_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $userlevels_view->pageUrl() ?>start=<?php echo $userlevels_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($userlevels_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $userlevels_view->pageUrl() ?>start=<?php echo $userlevels_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$userlevels_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$userlevels->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$userlevels_view->terminate();
?>