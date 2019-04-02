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
$users_view = new users_view();

// Run the page
$users_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$users_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$users->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fusersview = currentForm = new ew.Form("fusersview", "view");

// Form_CustomValidate event
fusersview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fusersview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fusersview.lists["x_IDuser"] = <?php echo $users_view->IDuser->Lookup->toClientList() ?>;
fusersview.lists["x_IDuser"].options = <?php echo JsonEncode($users_view->IDuser->lookupOptions()) ?>;
fusersview.lists["x_active[]"] = <?php echo $users_view->active->Lookup->toClientList() ?>;
fusersview.lists["x_active[]"].options = <?php echo JsonEncode($users_view->active->options(FALSE, TRUE)) ?>;
fusersview.lists["x_userlevel"] = <?php echo $users_view->userlevel->Lookup->toClientList() ?>;
fusersview.lists["x_userlevel"].options = <?php echo JsonEncode($users_view->userlevel->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$users->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $users_view->ExportOptions->render("body") ?>
<?php $users_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $users_view->showPageHeader(); ?>
<?php
$users_view->showMessage();
?>
<?php if (!$users_view->IsModal) { ?>
<?php if (!$users->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($users_view->Pager)) $users_view->Pager = new NumericPager($users_view->StartRec, $users_view->DisplayRecs, $users_view->TotalRecs, $users_view->RecRange, $users_view->AutoHidePager) ?>
<?php if ($users_view->Pager->RecordCount > 0 && $users_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($users_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $users_view->pageUrl() ?>start=<?php echo $users_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($users_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $users_view->pageUrl() ?>start=<?php echo $users_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($users_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $users_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($users_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $users_view->pageUrl() ?>start=<?php echo $users_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($users_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $users_view->pageUrl() ?>start=<?php echo $users_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fusersview" id="fusersview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($users_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $users_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="users">
<input type="hidden" name="modal" value="<?php echo (int)$users_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($users->IDuser->Visible) { // IDuser ?>
	<tr id="r_IDuser">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_IDuser"><?php echo $users->IDuser->caption() ?></span></td>
		<td data-name="IDuser"<?php echo $users->IDuser->cellAttributes() ?>>
<span id="el_users_IDuser">
<span<?php echo $users->IDuser->viewAttributes() ?>>
<?php echo $users->IDuser->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($users->password->Visible) { // password ?>
	<tr id="r_password">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_password"><?php echo $users->password->caption() ?></span></td>
		<td data-name="password"<?php echo $users->password->cellAttributes() ?>>
<span id="el_users_password">
<span<?php echo $users->password->viewAttributes() ?>>
<?php echo $users->password->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($users->user->Visible) { // user ?>
	<tr id="r_user">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_user"><?php echo $users->user->caption() ?></span></td>
		<td data-name="user"<?php echo $users->user->cellAttributes() ?>>
<span id="el_users_user">
<span<?php echo $users->user->viewAttributes() ?>>
<?php echo $users->user->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($users->correo->Visible) { // correo ?>
	<tr id="r_correo">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_correo"><?php echo $users->correo->caption() ?></span></td>
		<td data-name="correo"<?php echo $users->correo->cellAttributes() ?>>
<span id="el_users_correo">
<span<?php echo $users->correo->viewAttributes() ?>>
<?php echo $users->correo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($users->active->Visible) { // active ?>
	<tr id="r_active">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_active"><?php echo $users->active->caption() ?></span></td>
		<td data-name="active"<?php echo $users->active->cellAttributes() ?>>
<span id="el_users_active">
<span<?php echo $users->active->viewAttributes() ?>>
<?php if (ConvertToBool($users->active->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $users->active->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $users->active->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($users->userlevel->Visible) { // userlevel ?>
	<tr id="r_userlevel">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_userlevel"><?php echo $users->userlevel->caption() ?></span></td>
		<td data-name="userlevel"<?php echo $users->userlevel->cellAttributes() ?>>
<span id="el_users_userlevel">
<span<?php echo $users->userlevel->viewAttributes() ?>>
<?php echo $users->userlevel->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($users->memo->Visible) { // memo ?>
	<tr id="r_memo">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_memo"><?php echo $users->memo->caption() ?></span></td>
		<td data-name="memo"<?php echo $users->memo->cellAttributes() ?>>
<span id="el_users_memo">
<span<?php echo $users->memo->viewAttributes() ?>>
<?php echo $users->memo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$users_view->IsModal) { ?>
<?php if (!$users->isExport()) { ?>
<?php if (!isset($users_view->Pager)) $users_view->Pager = new NumericPager($users_view->StartRec, $users_view->DisplayRecs, $users_view->TotalRecs, $users_view->RecRange, $users_view->AutoHidePager) ?>
<?php if ($users_view->Pager->RecordCount > 0 && $users_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($users_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $users_view->pageUrl() ?>start=<?php echo $users_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($users_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $users_view->pageUrl() ?>start=<?php echo $users_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($users_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $users_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($users_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $users_view->pageUrl() ?>start=<?php echo $users_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($users_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $users_view->pageUrl() ?>start=<?php echo $users_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$users_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$users->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$users_view->terminate();
?>