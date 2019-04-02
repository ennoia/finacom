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
$_login_list = new _login_list();

// Run the page
$_login_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$_login_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$_login->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var f_loginlist = currentForm = new ew.Form("f_loginlist", "list");
f_loginlist.formKeyCountName = '<?php echo $_login_list->FormKeyCountName ?>';

// Form_CustomValidate event
f_loginlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
f_loginlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
f_loginlist.lists["x_active[]"] = <?php echo $_login_list->active->Lookup->toClientList() ?>;
f_loginlist.lists["x_active[]"].options = <?php echo JsonEncode($_login_list->active->options(FALSE, TRUE)) ?>;
f_loginlist.lists["x_UserTypes"] = <?php echo $_login_list->UserTypes->Lookup->toClientList() ?>;
f_loginlist.lists["x_UserTypes"].options = <?php echo JsonEncode($_login_list->UserTypes->lookupOptions()) ?>;
f_loginlist.autoSuggests["x_UserTypes"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
var f_loginlistsrch = currentSearchForm = new ew.Form("f_loginlistsrch");

// Filters
f_loginlistsrch.filterList = <?php echo $_login_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$_login->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($_login_list->TotalRecs > 0 && $_login_list->ExportOptions->visible()) { ?>
<?php $_login_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($_login_list->ImportOptions->visible()) { ?>
<?php $_login_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($_login_list->SearchOptions->visible()) { ?>
<?php $_login_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($_login_list->FilterOptions->visible()) { ?>
<?php $_login_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$_login_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$_login->isExport() && !$_login->CurrentAction) { ?>
<form name="f_loginlistsrch" id="f_loginlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($_login_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="f_loginlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="_login">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($_login_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($_login_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $_login_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($_login_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($_login_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($_login_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($_login_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $_login_list->showPageHeader(); ?>
<?php
$_login_list->showMessage();
?>
<?php if ($_login_list->TotalRecs > 0 || $_login->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($_login_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> _login">
<?php if (!$_login->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$_login->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($_login_list->Pager)) $_login_list->Pager = new NumericPager($_login_list->StartRec, $_login_list->DisplayRecs, $_login_list->TotalRecs, $_login_list->RecRange, $_login_list->AutoHidePager) ?>
<?php if ($_login_list->Pager->RecordCount > 0 && $_login_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($_login_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $_login_list->pageUrl() ?>start=<?php echo $_login_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($_login_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $_login_list->pageUrl() ?>start=<?php echo $_login_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($_login_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $_login_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($_login_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $_login_list->pageUrl() ?>start=<?php echo $_login_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($_login_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $_login_list->pageUrl() ?>start=<?php echo $_login_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($_login_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $_login_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $_login_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $_login_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $_login_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="f_loginlist" id="f_loginlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($_login_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $_login_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="_login">
<div id="gmp__login" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($_login_list->TotalRecs > 0 || $_login->isGridEdit()) { ?>
<table id="tbl__loginlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$_login_list->RowType = ROWTYPE_HEADER;

// Render list options
$_login_list->renderListOptions();

// Render list options (header, left)
$_login_list->ListOptions->render("header", "left");
?>
<?php if ($_login->IDuser->Visible) { // IDuser ?>
	<?php if ($_login->sortUrl($_login->IDuser) == "") { ?>
		<th data-name="IDuser" class="<?php echo $_login->IDuser->headerCellClass() ?>"><div id="elh__login_IDuser" class="_login_IDuser"><div class="ew-table-header-caption"><?php echo $_login->IDuser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IDuser" class="<?php echo $_login->IDuser->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $_login->SortUrl($_login->IDuser) ?>',2);"><div id="elh__login_IDuser" class="_login_IDuser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_login->IDuser->caption() ?></span><span class="ew-table-header-sort"><?php if ($_login->IDuser->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($_login->IDuser->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_login->user->Visible) { // user ?>
	<?php if ($_login->sortUrl($_login->user) == "") { ?>
		<th data-name="user" class="<?php echo $_login->user->headerCellClass() ?>"><div id="elh__login_user" class="_login_user"><div class="ew-table-header-caption"><?php echo $_login->user->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="user" class="<?php echo $_login->user->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $_login->SortUrl($_login->user) ?>',2);"><div id="elh__login_user" class="_login_user">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_login->user->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_login->user->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($_login->user->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_login->password->Visible) { // password ?>
	<?php if ($_login->sortUrl($_login->password) == "") { ?>
		<th data-name="password" class="<?php echo $_login->password->headerCellClass() ?>"><div id="elh__login_password" class="_login_password"><div class="ew-table-header-caption"><?php echo $_login->password->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="password" class="<?php echo $_login->password->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $_login->SortUrl($_login->password) ?>',2);"><div id="elh__login_password" class="_login_password">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_login->password->caption() ?></span><span class="ew-table-header-sort"><?php if ($_login->password->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($_login->password->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_login->correo->Visible) { // correo ?>
	<?php if ($_login->sortUrl($_login->correo) == "") { ?>
		<th data-name="correo" class="<?php echo $_login->correo->headerCellClass() ?>"><div id="elh__login_correo" class="_login_correo"><div class="ew-table-header-caption"><?php echo $_login->correo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="correo" class="<?php echo $_login->correo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $_login->SortUrl($_login->correo) ?>',2);"><div id="elh__login_correo" class="_login_correo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_login->correo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_login->correo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($_login->correo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_login->active->Visible) { // active ?>
	<?php if ($_login->sortUrl($_login->active) == "") { ?>
		<th data-name="active" class="<?php echo $_login->active->headerCellClass() ?>"><div id="elh__login_active" class="_login_active"><div class="ew-table-header-caption"><?php echo $_login->active->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="active" class="<?php echo $_login->active->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $_login->SortUrl($_login->active) ?>',2);"><div id="elh__login_active" class="_login_active">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_login->active->caption() ?></span><span class="ew-table-header-sort"><?php if ($_login->active->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($_login->active->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_login->profile->Visible) { // profile ?>
	<?php if ($_login->sortUrl($_login->profile) == "") { ?>
		<th data-name="profile" class="<?php echo $_login->profile->headerCellClass() ?>"><div id="elh__login_profile" class="_login_profile"><div class="ew-table-header-caption"><?php echo $_login->profile->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="profile" class="<?php echo $_login->profile->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $_login->SortUrl($_login->profile) ?>',2);"><div id="elh__login_profile" class="_login_profile">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_login->profile->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_login->profile->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($_login->profile->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_login->UserTypes->Visible) { // UserTypes ?>
	<?php if ($_login->sortUrl($_login->UserTypes) == "") { ?>
		<th data-name="UserTypes" class="<?php echo $_login->UserTypes->headerCellClass() ?>"><div id="elh__login_UserTypes" class="_login_UserTypes"><div class="ew-table-header-caption"><?php echo $_login->UserTypes->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UserTypes" class="<?php echo $_login->UserTypes->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $_login->SortUrl($_login->UserTypes) ?>',2);"><div id="elh__login_UserTypes" class="_login_UserTypes">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_login->UserTypes->caption() ?></span><span class="ew-table-header-sort"><?php if ($_login->UserTypes->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($_login->UserTypes->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$_login_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($_login->ExportAll && $_login->isExport()) {
	$_login_list->StopRec = $_login_list->TotalRecs;
} else {

	// Set the last record to display
	if ($_login_list->TotalRecs > $_login_list->StartRec + $_login_list->DisplayRecs - 1)
		$_login_list->StopRec = $_login_list->StartRec + $_login_list->DisplayRecs - 1;
	else
		$_login_list->StopRec = $_login_list->TotalRecs;
}
$_login_list->RecCnt = $_login_list->StartRec - 1;
if ($_login_list->Recordset && !$_login_list->Recordset->EOF) {
	$_login_list->Recordset->moveFirst();
	$selectLimit = $_login_list->UseSelectLimit;
	if (!$selectLimit && $_login_list->StartRec > 1)
		$_login_list->Recordset->move($_login_list->StartRec - 1);
} elseif (!$_login->AllowAddDeleteRow && $_login_list->StopRec == 0) {
	$_login_list->StopRec = $_login->GridAddRowCount;
}

// Initialize aggregate
$_login->RowType = ROWTYPE_AGGREGATEINIT;
$_login->resetAttributes();
$_login_list->renderRow();
while ($_login_list->RecCnt < $_login_list->StopRec) {
	$_login_list->RecCnt++;
	if ($_login_list->RecCnt >= $_login_list->StartRec) {
		$_login_list->RowCnt++;

		// Set up key count
		$_login_list->KeyCount = $_login_list->RowIndex;

		// Init row class and style
		$_login->resetAttributes();
		$_login->CssClass = "";
		if ($_login->isGridAdd()) {
		} else {
			$_login_list->loadRowValues($_login_list->Recordset); // Load row values
		}
		$_login->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$_login->RowAttrs = array_merge($_login->RowAttrs, array('data-rowindex'=>$_login_list->RowCnt, 'id'=>'r' . $_login_list->RowCnt . '__login', 'data-rowtype'=>$_login->RowType));

		// Render row
		$_login_list->renderRow();

		// Render list options
		$_login_list->renderListOptions();
?>
	<tr<?php echo $_login->rowAttributes() ?>>
<?php

// Render list options (body, left)
$_login_list->ListOptions->render("body", "left", $_login_list->RowCnt);
?>
	<?php if ($_login->IDuser->Visible) { // IDuser ?>
		<td data-name="IDuser"<?php echo $_login->IDuser->cellAttributes() ?>>
<span id="el<?php echo $_login_list->RowCnt ?>__login_IDuser" class="_login_IDuser">
<span<?php echo $_login->IDuser->viewAttributes() ?>>
<?php echo $_login->IDuser->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_login->user->Visible) { // user ?>
		<td data-name="user"<?php echo $_login->user->cellAttributes() ?>>
<span id="el<?php echo $_login_list->RowCnt ?>__login_user" class="_login_user">
<span<?php echo $_login->user->viewAttributes() ?>>
<?php echo $_login->user->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_login->password->Visible) { // password ?>
		<td data-name="password"<?php echo $_login->password->cellAttributes() ?>>
<span id="el<?php echo $_login_list->RowCnt ?>__login_password" class="_login_password">
<span<?php echo $_login->password->viewAttributes() ?>>
<?php echo $_login->password->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_login->correo->Visible) { // correo ?>
		<td data-name="correo"<?php echo $_login->correo->cellAttributes() ?>>
<span id="el<?php echo $_login_list->RowCnt ?>__login_correo" class="_login_correo">
<span<?php echo $_login->correo->viewAttributes() ?>>
<?php echo $_login->correo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_login->active->Visible) { // active ?>
		<td data-name="active"<?php echo $_login->active->cellAttributes() ?>>
<span id="el<?php echo $_login_list->RowCnt ?>__login_active" class="_login_active">
<span<?php echo $_login->active->viewAttributes() ?>>
<?php if (ConvertToBool($_login->active->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $_login->active->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $_login->active->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($_login->profile->Visible) { // profile ?>
		<td data-name="profile"<?php echo $_login->profile->cellAttributes() ?>>
<span id="el<?php echo $_login_list->RowCnt ?>__login_profile" class="_login_profile">
<span<?php echo $_login->profile->viewAttributes() ?>>
<?php echo $_login->profile->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_login->UserTypes->Visible) { // UserTypes ?>
		<td data-name="UserTypes"<?php echo $_login->UserTypes->cellAttributes() ?>>
<span id="el<?php echo $_login_list->RowCnt ?>__login_UserTypes" class="_login_UserTypes">
<span<?php echo $_login->UserTypes->viewAttributes() ?>>
<?php echo $_login->UserTypes->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$_login_list->ListOptions->render("body", "right", $_login_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$_login->isGridAdd())
		$_login_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$_login->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($_login_list->Recordset)
	$_login_list->Recordset->Close();
?>
<?php if (!$_login->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$_login->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($_login_list->Pager)) $_login_list->Pager = new NumericPager($_login_list->StartRec, $_login_list->DisplayRecs, $_login_list->TotalRecs, $_login_list->RecRange, $_login_list->AutoHidePager) ?>
<?php if ($_login_list->Pager->RecordCount > 0 && $_login_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($_login_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $_login_list->pageUrl() ?>start=<?php echo $_login_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($_login_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $_login_list->pageUrl() ?>start=<?php echo $_login_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($_login_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $_login_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($_login_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $_login_list->pageUrl() ?>start=<?php echo $_login_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($_login_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $_login_list->pageUrl() ?>start=<?php echo $_login_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($_login_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $_login_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $_login_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $_login_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $_login_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($_login_list->TotalRecs == 0 && !$_login->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $_login_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$_login_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$_login->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$_login_list->terminate();
?>