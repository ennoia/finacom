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
$users_list = new users_list();

// Run the page
$users_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$users_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$users->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fuserslist = currentForm = new ew.Form("fuserslist", "list");
fuserslist.formKeyCountName = '<?php echo $users_list->FormKeyCountName ?>';

// Form_CustomValidate event
fuserslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fuserslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fuserslist.lists["x_IDuser"] = <?php echo $users_list->IDuser->Lookup->toClientList() ?>;
fuserslist.lists["x_IDuser"].options = <?php echo JsonEncode($users_list->IDuser->lookupOptions()) ?>;
fuserslist.lists["x_active[]"] = <?php echo $users_list->active->Lookup->toClientList() ?>;
fuserslist.lists["x_active[]"].options = <?php echo JsonEncode($users_list->active->options(FALSE, TRUE)) ?>;
fuserslist.lists["x_userlevel"] = <?php echo $users_list->userlevel->Lookup->toClientList() ?>;
fuserslist.lists["x_userlevel"].options = <?php echo JsonEncode($users_list->userlevel->lookupOptions()) ?>;

// Form object for search
var fuserslistsrch = currentSearchForm = new ew.Form("fuserslistsrch");

// Filters
fuserslistsrch.filterList = <?php echo $users_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$users->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($users_list->TotalRecs > 0 && $users_list->ExportOptions->visible()) { ?>
<?php $users_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($users_list->ImportOptions->visible()) { ?>
<?php $users_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($users_list->SearchOptions->visible()) { ?>
<?php $users_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($users_list->FilterOptions->visible()) { ?>
<?php $users_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$users_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$users->isExport() && !$users->CurrentAction) { ?>
<form name="fuserslistsrch" id="fuserslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($users_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fuserslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="users">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($users_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($users_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $users_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($users_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($users_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($users_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($users_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $users_list->showPageHeader(); ?>
<?php
$users_list->showMessage();
?>
<?php if ($users_list->TotalRecs > 0 || $users->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($users_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> users">
<?php if (!$users->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$users->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($users_list->Pager)) $users_list->Pager = new NumericPager($users_list->StartRec, $users_list->DisplayRecs, $users_list->TotalRecs, $users_list->RecRange, $users_list->AutoHidePager) ?>
<?php if ($users_list->Pager->RecordCount > 0 && $users_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($users_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $users_list->pageUrl() ?>start=<?php echo $users_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($users_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $users_list->pageUrl() ?>start=<?php echo $users_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($users_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $users_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($users_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $users_list->pageUrl() ?>start=<?php echo $users_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($users_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $users_list->pageUrl() ?>start=<?php echo $users_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($users_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $users_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $users_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $users_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $users_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fuserslist" id="fuserslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($users_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $users_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="users">
<div id="gmp_users" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($users_list->TotalRecs > 0 || $users->isGridEdit()) { ?>
<table id="tbl_userslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$users_list->RowType = ROWTYPE_HEADER;

// Render list options
$users_list->renderListOptions();

// Render list options (header, left)
$users_list->ListOptions->render("header", "left");
?>
<?php if ($users->IDuser->Visible) { // IDuser ?>
	<?php if ($users->sortUrl($users->IDuser) == "") { ?>
		<th data-name="IDuser" class="<?php echo $users->IDuser->headerCellClass() ?>"><div id="elh_users_IDuser" class="users_IDuser"><div class="ew-table-header-caption"><?php echo $users->IDuser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IDuser" class="<?php echo $users->IDuser->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $users->SortUrl($users->IDuser) ?>',2);"><div id="elh_users_IDuser" class="users_IDuser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $users->IDuser->caption() ?></span><span class="ew-table-header-sort"><?php if ($users->IDuser->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($users->IDuser->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($users->password->Visible) { // password ?>
	<?php if ($users->sortUrl($users->password) == "") { ?>
		<th data-name="password" class="<?php echo $users->password->headerCellClass() ?>"><div id="elh_users_password" class="users_password"><div class="ew-table-header-caption"><?php echo $users->password->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="password" class="<?php echo $users->password->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $users->SortUrl($users->password) ?>',2);"><div id="elh_users_password" class="users_password">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $users->password->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($users->password->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($users->password->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($users->user->Visible) { // user ?>
	<?php if ($users->sortUrl($users->user) == "") { ?>
		<th data-name="user" class="<?php echo $users->user->headerCellClass() ?>"><div id="elh_users_user" class="users_user"><div class="ew-table-header-caption"><?php echo $users->user->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="user" class="<?php echo $users->user->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $users->SortUrl($users->user) ?>',2);"><div id="elh_users_user" class="users_user">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $users->user->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($users->user->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($users->user->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($users->correo->Visible) { // correo ?>
	<?php if ($users->sortUrl($users->correo) == "") { ?>
		<th data-name="correo" class="<?php echo $users->correo->headerCellClass() ?>"><div id="elh_users_correo" class="users_correo"><div class="ew-table-header-caption"><?php echo $users->correo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="correo" class="<?php echo $users->correo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $users->SortUrl($users->correo) ?>',2);"><div id="elh_users_correo" class="users_correo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $users->correo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($users->correo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($users->correo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($users->active->Visible) { // active ?>
	<?php if ($users->sortUrl($users->active) == "") { ?>
		<th data-name="active" class="<?php echo $users->active->headerCellClass() ?>"><div id="elh_users_active" class="users_active"><div class="ew-table-header-caption"><?php echo $users->active->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="active" class="<?php echo $users->active->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $users->SortUrl($users->active) ?>',2);"><div id="elh_users_active" class="users_active">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $users->active->caption() ?></span><span class="ew-table-header-sort"><?php if ($users->active->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($users->active->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($users->userlevel->Visible) { // userlevel ?>
	<?php if ($users->sortUrl($users->userlevel) == "") { ?>
		<th data-name="userlevel" class="<?php echo $users->userlevel->headerCellClass() ?>"><div id="elh_users_userlevel" class="users_userlevel"><div class="ew-table-header-caption"><?php echo $users->userlevel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="userlevel" class="<?php echo $users->userlevel->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $users->SortUrl($users->userlevel) ?>',2);"><div id="elh_users_userlevel" class="users_userlevel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $users->userlevel->caption() ?></span><span class="ew-table-header-sort"><?php if ($users->userlevel->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($users->userlevel->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$users_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($users->ExportAll && $users->isExport()) {
	$users_list->StopRec = $users_list->TotalRecs;
} else {

	// Set the last record to display
	if ($users_list->TotalRecs > $users_list->StartRec + $users_list->DisplayRecs - 1)
		$users_list->StopRec = $users_list->StartRec + $users_list->DisplayRecs - 1;
	else
		$users_list->StopRec = $users_list->TotalRecs;
}
$users_list->RecCnt = $users_list->StartRec - 1;
if ($users_list->Recordset && !$users_list->Recordset->EOF) {
	$users_list->Recordset->moveFirst();
	$selectLimit = $users_list->UseSelectLimit;
	if (!$selectLimit && $users_list->StartRec > 1)
		$users_list->Recordset->move($users_list->StartRec - 1);
} elseif (!$users->AllowAddDeleteRow && $users_list->StopRec == 0) {
	$users_list->StopRec = $users->GridAddRowCount;
}

// Initialize aggregate
$users->RowType = ROWTYPE_AGGREGATEINIT;
$users->resetAttributes();
$users_list->renderRow();
while ($users_list->RecCnt < $users_list->StopRec) {
	$users_list->RecCnt++;
	if ($users_list->RecCnt >= $users_list->StartRec) {
		$users_list->RowCnt++;

		// Set up key count
		$users_list->KeyCount = $users_list->RowIndex;

		// Init row class and style
		$users->resetAttributes();
		$users->CssClass = "";
		if ($users->isGridAdd()) {
		} else {
			$users_list->loadRowValues($users_list->Recordset); // Load row values
		}
		$users->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$users->RowAttrs = array_merge($users->RowAttrs, array('data-rowindex'=>$users_list->RowCnt, 'id'=>'r' . $users_list->RowCnt . '_users', 'data-rowtype'=>$users->RowType));

		// Render row
		$users_list->renderRow();

		// Render list options
		$users_list->renderListOptions();
?>
	<tr<?php echo $users->rowAttributes() ?>>
<?php

// Render list options (body, left)
$users_list->ListOptions->render("body", "left", $users_list->RowCnt);
?>
	<?php if ($users->IDuser->Visible) { // IDuser ?>
		<td data-name="IDuser"<?php echo $users->IDuser->cellAttributes() ?>>
<span id="el<?php echo $users_list->RowCnt ?>_users_IDuser" class="users_IDuser">
<span<?php echo $users->IDuser->viewAttributes() ?>>
<?php echo $users->IDuser->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($users->password->Visible) { // password ?>
		<td data-name="password"<?php echo $users->password->cellAttributes() ?>>
<span id="el<?php echo $users_list->RowCnt ?>_users_password" class="users_password">
<span<?php echo $users->password->viewAttributes() ?>>
<?php echo $users->password->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($users->user->Visible) { // user ?>
		<td data-name="user"<?php echo $users->user->cellAttributes() ?>>
<span id="el<?php echo $users_list->RowCnt ?>_users_user" class="users_user">
<span<?php echo $users->user->viewAttributes() ?>>
<?php echo $users->user->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($users->correo->Visible) { // correo ?>
		<td data-name="correo"<?php echo $users->correo->cellAttributes() ?>>
<span id="el<?php echo $users_list->RowCnt ?>_users_correo" class="users_correo">
<span<?php echo $users->correo->viewAttributes() ?>>
<?php echo $users->correo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($users->active->Visible) { // active ?>
		<td data-name="active"<?php echo $users->active->cellAttributes() ?>>
<span id="el<?php echo $users_list->RowCnt ?>_users_active" class="users_active">
<span<?php echo $users->active->viewAttributes() ?>>
<?php if (ConvertToBool($users->active->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $users->active->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $users->active->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($users->userlevel->Visible) { // userlevel ?>
		<td data-name="userlevel"<?php echo $users->userlevel->cellAttributes() ?>>
<span id="el<?php echo $users_list->RowCnt ?>_users_userlevel" class="users_userlevel">
<span<?php echo $users->userlevel->viewAttributes() ?>>
<?php echo $users->userlevel->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$users_list->ListOptions->render("body", "right", $users_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$users->isGridAdd())
		$users_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$users->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($users_list->Recordset)
	$users_list->Recordset->Close();
?>
<?php if (!$users->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$users->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($users_list->Pager)) $users_list->Pager = new NumericPager($users_list->StartRec, $users_list->DisplayRecs, $users_list->TotalRecs, $users_list->RecRange, $users_list->AutoHidePager) ?>
<?php if ($users_list->Pager->RecordCount > 0 && $users_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($users_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $users_list->pageUrl() ?>start=<?php echo $users_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($users_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $users_list->pageUrl() ?>start=<?php echo $users_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($users_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $users_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($users_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $users_list->pageUrl() ?>start=<?php echo $users_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($users_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $users_list->pageUrl() ?>start=<?php echo $users_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($users_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $users_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $users_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $users_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $users_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($users_list->TotalRecs == 0 && !$users->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $users_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$users_list->showPageFooter();
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
$users_list->terminate();
?>