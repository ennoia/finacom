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
$userlevelpermissions_view = new userlevelpermissions_view();

// Run the page
$userlevelpermissions_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$userlevelpermissions_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$userlevelpermissions->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fuserlevelpermissionsview = currentForm = new ew.Form("fuserlevelpermissionsview", "view");

// Form_CustomValidate event
fuserlevelpermissionsview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fuserlevelpermissionsview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$userlevelpermissions->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $userlevelpermissions_view->ExportOptions->render("body") ?>
<?php $userlevelpermissions_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $userlevelpermissions_view->showPageHeader(); ?>
<?php
$userlevelpermissions_view->showMessage();
?>
<?php if (!$userlevelpermissions_view->IsModal) { ?>
<?php if (!$userlevelpermissions->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($userlevelpermissions_view->Pager)) $userlevelpermissions_view->Pager = new NumericPager($userlevelpermissions_view->StartRec, $userlevelpermissions_view->DisplayRecs, $userlevelpermissions_view->TotalRecs, $userlevelpermissions_view->RecRange, $userlevelpermissions_view->AutoHidePager) ?>
<?php if ($userlevelpermissions_view->Pager->RecordCount > 0 && $userlevelpermissions_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($userlevelpermissions_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $userlevelpermissions_view->pageUrl() ?>start=<?php echo $userlevelpermissions_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($userlevelpermissions_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $userlevelpermissions_view->pageUrl() ?>start=<?php echo $userlevelpermissions_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($userlevelpermissions_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $userlevelpermissions_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($userlevelpermissions_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $userlevelpermissions_view->pageUrl() ?>start=<?php echo $userlevelpermissions_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($userlevelpermissions_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $userlevelpermissions_view->pageUrl() ?>start=<?php echo $userlevelpermissions_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fuserlevelpermissionsview" id="fuserlevelpermissionsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($userlevelpermissions_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $userlevelpermissions_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="userlevelpermissions">
<input type="hidden" name="modal" value="<?php echo (int)$userlevelpermissions_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($userlevelpermissions->userlevelid->Visible) { // userlevelid ?>
	<tr id="r_userlevelid">
		<td class="<?php echo $userlevelpermissions_view->TableLeftColumnClass ?>"><span id="elh_userlevelpermissions_userlevelid"><?php echo $userlevelpermissions->userlevelid->caption() ?></span></td>
		<td data-name="userlevelid"<?php echo $userlevelpermissions->userlevelid->cellAttributes() ?>>
<span id="el_userlevelpermissions_userlevelid">
<span<?php echo $userlevelpermissions->userlevelid->viewAttributes() ?>>
<?php echo $userlevelpermissions->userlevelid->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($userlevelpermissions->_tablename->Visible) { // tablename ?>
	<tr id="r__tablename">
		<td class="<?php echo $userlevelpermissions_view->TableLeftColumnClass ?>"><span id="elh_userlevelpermissions__tablename"><?php echo $userlevelpermissions->_tablename->caption() ?></span></td>
		<td data-name="_tablename"<?php echo $userlevelpermissions->_tablename->cellAttributes() ?>>
<span id="el_userlevelpermissions__tablename">
<span<?php echo $userlevelpermissions->_tablename->viewAttributes() ?>>
<?php echo $userlevelpermissions->_tablename->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($userlevelpermissions->permission->Visible) { // permission ?>
	<tr id="r_permission">
		<td class="<?php echo $userlevelpermissions_view->TableLeftColumnClass ?>"><span id="elh_userlevelpermissions_permission"><?php echo $userlevelpermissions->permission->caption() ?></span></td>
		<td data-name="permission"<?php echo $userlevelpermissions->permission->cellAttributes() ?>>
<span id="el_userlevelpermissions_permission">
<span<?php echo $userlevelpermissions->permission->viewAttributes() ?>>
<?php echo $userlevelpermissions->permission->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$userlevelpermissions_view->IsModal) { ?>
<?php if (!$userlevelpermissions->isExport()) { ?>
<?php if (!isset($userlevelpermissions_view->Pager)) $userlevelpermissions_view->Pager = new NumericPager($userlevelpermissions_view->StartRec, $userlevelpermissions_view->DisplayRecs, $userlevelpermissions_view->TotalRecs, $userlevelpermissions_view->RecRange, $userlevelpermissions_view->AutoHidePager) ?>
<?php if ($userlevelpermissions_view->Pager->RecordCount > 0 && $userlevelpermissions_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($userlevelpermissions_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $userlevelpermissions_view->pageUrl() ?>start=<?php echo $userlevelpermissions_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($userlevelpermissions_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $userlevelpermissions_view->pageUrl() ?>start=<?php echo $userlevelpermissions_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($userlevelpermissions_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $userlevelpermissions_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($userlevelpermissions_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $userlevelpermissions_view->pageUrl() ?>start=<?php echo $userlevelpermissions_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($userlevelpermissions_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $userlevelpermissions_view->pageUrl() ?>start=<?php echo $userlevelpermissions_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$userlevelpermissions_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$userlevelpermissions->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$userlevelpermissions_view->terminate();
?>