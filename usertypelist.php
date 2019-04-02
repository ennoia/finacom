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
$usertype_list = new usertype_list();

// Run the page
$usertype_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$usertype_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$usertype->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fusertypelist = currentForm = new ew.Form("fusertypelist", "list");
fusertypelist.formKeyCountName = '<?php echo $usertype_list->FormKeyCountName ?>';

// Form_CustomValidate event
fusertypelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fusertypelist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fusertypelistsrch = currentSearchForm = new ew.Form("fusertypelistsrch");

// Filters
fusertypelistsrch.filterList = <?php echo $usertype_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$usertype->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($usertype_list->TotalRecs > 0 && $usertype_list->ExportOptions->visible()) { ?>
<?php $usertype_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($usertype_list->ImportOptions->visible()) { ?>
<?php $usertype_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($usertype_list->SearchOptions->visible()) { ?>
<?php $usertype_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($usertype_list->FilterOptions->visible()) { ?>
<?php $usertype_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$usertype_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$usertype->isExport() && !$usertype->CurrentAction) { ?>
<form name="fusertypelistsrch" id="fusertypelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($usertype_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fusertypelistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="usertype">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($usertype_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($usertype_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $usertype_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($usertype_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($usertype_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($usertype_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($usertype_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $usertype_list->showPageHeader(); ?>
<?php
$usertype_list->showMessage();
?>
<?php if ($usertype_list->TotalRecs > 0 || $usertype->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($usertype_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> usertype">
<?php if (!$usertype->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$usertype->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($usertype_list->Pager)) $usertype_list->Pager = new NumericPager($usertype_list->StartRec, $usertype_list->DisplayRecs, $usertype_list->TotalRecs, $usertype_list->RecRange, $usertype_list->AutoHidePager) ?>
<?php if ($usertype_list->Pager->RecordCount > 0 && $usertype_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($usertype_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $usertype_list->pageUrl() ?>start=<?php echo $usertype_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($usertype_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $usertype_list->pageUrl() ?>start=<?php echo $usertype_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($usertype_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $usertype_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($usertype_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $usertype_list->pageUrl() ?>start=<?php echo $usertype_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($usertype_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $usertype_list->pageUrl() ?>start=<?php echo $usertype_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($usertype_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $usertype_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $usertype_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $usertype_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $usertype_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fusertypelist" id="fusertypelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($usertype_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $usertype_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="usertype">
<div id="gmp_usertype" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($usertype_list->TotalRecs > 0 || $usertype->isGridEdit()) { ?>
<table id="tbl_usertypelist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$usertype_list->RowType = ROWTYPE_HEADER;

// Render list options
$usertype_list->renderListOptions();

// Render list options (header, left)
$usertype_list->ListOptions->render("header", "left");
?>
<?php if ($usertype->oidusertypes->Visible) { // oidusertypes ?>
	<?php if ($usertype->sortUrl($usertype->oidusertypes) == "") { ?>
		<th data-name="oidusertypes" class="<?php echo $usertype->oidusertypes->headerCellClass() ?>"><div id="elh_usertype_oidusertypes" class="usertype_oidusertypes"><div class="ew-table-header-caption"><?php echo $usertype->oidusertypes->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="oidusertypes" class="<?php echo $usertype->oidusertypes->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $usertype->SortUrl($usertype->oidusertypes) ?>',2);"><div id="elh_usertype_oidusertypes" class="usertype_oidusertypes">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $usertype->oidusertypes->caption() ?></span><span class="ew-table-header-sort"><?php if ($usertype->oidusertypes->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($usertype->oidusertypes->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($usertype->usertypesdesc->Visible) { // usertypesdesc ?>
	<?php if ($usertype->sortUrl($usertype->usertypesdesc) == "") { ?>
		<th data-name="usertypesdesc" class="<?php echo $usertype->usertypesdesc->headerCellClass() ?>"><div id="elh_usertype_usertypesdesc" class="usertype_usertypesdesc"><div class="ew-table-header-caption"><?php echo $usertype->usertypesdesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="usertypesdesc" class="<?php echo $usertype->usertypesdesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $usertype->SortUrl($usertype->usertypesdesc) ?>',2);"><div id="elh_usertype_usertypesdesc" class="usertype_usertypesdesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $usertype->usertypesdesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($usertype->usertypesdesc->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($usertype->usertypesdesc->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$usertype_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($usertype->ExportAll && $usertype->isExport()) {
	$usertype_list->StopRec = $usertype_list->TotalRecs;
} else {

	// Set the last record to display
	if ($usertype_list->TotalRecs > $usertype_list->StartRec + $usertype_list->DisplayRecs - 1)
		$usertype_list->StopRec = $usertype_list->StartRec + $usertype_list->DisplayRecs - 1;
	else
		$usertype_list->StopRec = $usertype_list->TotalRecs;
}
$usertype_list->RecCnt = $usertype_list->StartRec - 1;
if ($usertype_list->Recordset && !$usertype_list->Recordset->EOF) {
	$usertype_list->Recordset->moveFirst();
	$selectLimit = $usertype_list->UseSelectLimit;
	if (!$selectLimit && $usertype_list->StartRec > 1)
		$usertype_list->Recordset->move($usertype_list->StartRec - 1);
} elseif (!$usertype->AllowAddDeleteRow && $usertype_list->StopRec == 0) {
	$usertype_list->StopRec = $usertype->GridAddRowCount;
}

// Initialize aggregate
$usertype->RowType = ROWTYPE_AGGREGATEINIT;
$usertype->resetAttributes();
$usertype_list->renderRow();
while ($usertype_list->RecCnt < $usertype_list->StopRec) {
	$usertype_list->RecCnt++;
	if ($usertype_list->RecCnt >= $usertype_list->StartRec) {
		$usertype_list->RowCnt++;

		// Set up key count
		$usertype_list->KeyCount = $usertype_list->RowIndex;

		// Init row class and style
		$usertype->resetAttributes();
		$usertype->CssClass = "";
		if ($usertype->isGridAdd()) {
		} else {
			$usertype_list->loadRowValues($usertype_list->Recordset); // Load row values
		}
		$usertype->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$usertype->RowAttrs = array_merge($usertype->RowAttrs, array('data-rowindex'=>$usertype_list->RowCnt, 'id'=>'r' . $usertype_list->RowCnt . '_usertype', 'data-rowtype'=>$usertype->RowType));

		// Render row
		$usertype_list->renderRow();

		// Render list options
		$usertype_list->renderListOptions();
?>
	<tr<?php echo $usertype->rowAttributes() ?>>
<?php

// Render list options (body, left)
$usertype_list->ListOptions->render("body", "left", $usertype_list->RowCnt);
?>
	<?php if ($usertype->oidusertypes->Visible) { // oidusertypes ?>
		<td data-name="oidusertypes"<?php echo $usertype->oidusertypes->cellAttributes() ?>>
<span id="el<?php echo $usertype_list->RowCnt ?>_usertype_oidusertypes" class="usertype_oidusertypes">
<span<?php echo $usertype->oidusertypes->viewAttributes() ?>>
<?php echo $usertype->oidusertypes->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($usertype->usertypesdesc->Visible) { // usertypesdesc ?>
		<td data-name="usertypesdesc"<?php echo $usertype->usertypesdesc->cellAttributes() ?>>
<span id="el<?php echo $usertype_list->RowCnt ?>_usertype_usertypesdesc" class="usertype_usertypesdesc">
<span<?php echo $usertype->usertypesdesc->viewAttributes() ?>>
<?php echo $usertype->usertypesdesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$usertype_list->ListOptions->render("body", "right", $usertype_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$usertype->isGridAdd())
		$usertype_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$usertype->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($usertype_list->Recordset)
	$usertype_list->Recordset->Close();
?>
<?php if (!$usertype->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$usertype->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($usertype_list->Pager)) $usertype_list->Pager = new NumericPager($usertype_list->StartRec, $usertype_list->DisplayRecs, $usertype_list->TotalRecs, $usertype_list->RecRange, $usertype_list->AutoHidePager) ?>
<?php if ($usertype_list->Pager->RecordCount > 0 && $usertype_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($usertype_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $usertype_list->pageUrl() ?>start=<?php echo $usertype_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($usertype_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $usertype_list->pageUrl() ?>start=<?php echo $usertype_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($usertype_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $usertype_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($usertype_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $usertype_list->pageUrl() ?>start=<?php echo $usertype_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($usertype_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $usertype_list->pageUrl() ?>start=<?php echo $usertype_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($usertype_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $usertype_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $usertype_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $usertype_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $usertype_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($usertype_list->TotalRecs == 0 && !$usertype->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $usertype_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$usertype_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$usertype->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$usertype_list->terminate();
?>