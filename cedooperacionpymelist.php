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
$cedooperacionpyme_list = new cedooperacionpyme_list();

// Run the page
$cedooperacionpyme_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cedooperacionpyme_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$cedooperacionpyme->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fcedooperacionpymelist = currentForm = new ew.Form("fcedooperacionpymelist", "list");
fcedooperacionpymelist.formKeyCountName = '<?php echo $cedooperacionpyme_list->FormKeyCountName ?>';

// Form_CustomValidate event
fcedooperacionpymelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcedooperacionpymelist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fcedooperacionpymelistsrch = currentSearchForm = new ew.Form("fcedooperacionpymelistsrch");

// Filters
fcedooperacionpymelistsrch.filterList = <?php echo $cedooperacionpyme_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$cedooperacionpyme->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($cedooperacionpyme_list->TotalRecs > 0 && $cedooperacionpyme_list->ExportOptions->visible()) { ?>
<?php $cedooperacionpyme_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($cedooperacionpyme_list->ImportOptions->visible()) { ?>
<?php $cedooperacionpyme_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($cedooperacionpyme_list->SearchOptions->visible()) { ?>
<?php $cedooperacionpyme_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($cedooperacionpyme_list->FilterOptions->visible()) { ?>
<?php $cedooperacionpyme_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$cedooperacionpyme_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$cedooperacionpyme->isExport() && !$cedooperacionpyme->CurrentAction) { ?>
<form name="fcedooperacionpymelistsrch" id="fcedooperacionpymelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($cedooperacionpyme_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fcedooperacionpymelistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="cedooperacionpyme">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($cedooperacionpyme_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($cedooperacionpyme_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $cedooperacionpyme_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($cedooperacionpyme_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($cedooperacionpyme_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($cedooperacionpyme_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($cedooperacionpyme_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $cedooperacionpyme_list->showPageHeader(); ?>
<?php
$cedooperacionpyme_list->showMessage();
?>
<?php if ($cedooperacionpyme_list->TotalRecs > 0 || $cedooperacionpyme->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($cedooperacionpyme_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> cedooperacionpyme">
<?php if (!$cedooperacionpyme->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$cedooperacionpyme->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($cedooperacionpyme_list->Pager)) $cedooperacionpyme_list->Pager = new NumericPager($cedooperacionpyme_list->StartRec, $cedooperacionpyme_list->DisplayRecs, $cedooperacionpyme_list->TotalRecs, $cedooperacionpyme_list->RecRange, $cedooperacionpyme_list->AutoHidePager) ?>
<?php if ($cedooperacionpyme_list->Pager->RecordCount > 0 && $cedooperacionpyme_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($cedooperacionpyme_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cedooperacionpyme_list->pageUrl() ?>start=<?php echo $cedooperacionpyme_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($cedooperacionpyme_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cedooperacionpyme_list->pageUrl() ?>start=<?php echo $cedooperacionpyme_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($cedooperacionpyme_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $cedooperacionpyme_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($cedooperacionpyme_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cedooperacionpyme_list->pageUrl() ?>start=<?php echo $cedooperacionpyme_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($cedooperacionpyme_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cedooperacionpyme_list->pageUrl() ?>start=<?php echo $cedooperacionpyme_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($cedooperacionpyme_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $cedooperacionpyme_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $cedooperacionpyme_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $cedooperacionpyme_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cedooperacionpyme_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcedooperacionpymelist" id="fcedooperacionpymelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($cedooperacionpyme_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $cedooperacionpyme_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cedooperacionpyme">
<div id="gmp_cedooperacionpyme" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($cedooperacionpyme_list->TotalRecs > 0 || $cedooperacionpyme->isGridEdit()) { ?>
<table id="tbl_cedooperacionpymelist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$cedooperacionpyme_list->RowType = ROWTYPE_HEADER;

// Render list options
$cedooperacionpyme_list->renderListOptions();

// Render list options (header, left)
$cedooperacionpyme_list->ListOptions->render("header", "left");
?>
<?php if ($cedooperacionpyme->id_estaus->Visible) { // id_estaus ?>
	<?php if ($cedooperacionpyme->sortUrl($cedooperacionpyme->id_estaus) == "") { ?>
		<th data-name="id_estaus" class="<?php echo $cedooperacionpyme->id_estaus->headerCellClass() ?>"><div id="elh_cedooperacionpyme_id_estaus" class="cedooperacionpyme_id_estaus"><div class="ew-table-header-caption"><?php echo $cedooperacionpyme->id_estaus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_estaus" class="<?php echo $cedooperacionpyme->id_estaus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cedooperacionpyme->SortUrl($cedooperacionpyme->id_estaus) ?>',2);"><div id="elh_cedooperacionpyme_id_estaus" class="cedooperacionpyme_id_estaus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cedooperacionpyme->id_estaus->caption() ?></span><span class="ew-table-header-sort"><?php if ($cedooperacionpyme->id_estaus->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cedooperacionpyme->id_estaus->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cedooperacionpyme->descripcion->Visible) { // descripcion ?>
	<?php if ($cedooperacionpyme->sortUrl($cedooperacionpyme->descripcion) == "") { ?>
		<th data-name="descripcion" class="<?php echo $cedooperacionpyme->descripcion->headerCellClass() ?>"><div id="elh_cedooperacionpyme_descripcion" class="cedooperacionpyme_descripcion"><div class="ew-table-header-caption"><?php echo $cedooperacionpyme->descripcion->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="descripcion" class="<?php echo $cedooperacionpyme->descripcion->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cedooperacionpyme->SortUrl($cedooperacionpyme->descripcion) ?>',2);"><div id="elh_cedooperacionpyme_descripcion" class="cedooperacionpyme_descripcion">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cedooperacionpyme->descripcion->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cedooperacionpyme->descripcion->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cedooperacionpyme->descripcion->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$cedooperacionpyme_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($cedooperacionpyme->ExportAll && $cedooperacionpyme->isExport()) {
	$cedooperacionpyme_list->StopRec = $cedooperacionpyme_list->TotalRecs;
} else {

	// Set the last record to display
	if ($cedooperacionpyme_list->TotalRecs > $cedooperacionpyme_list->StartRec + $cedooperacionpyme_list->DisplayRecs - 1)
		$cedooperacionpyme_list->StopRec = $cedooperacionpyme_list->StartRec + $cedooperacionpyme_list->DisplayRecs - 1;
	else
		$cedooperacionpyme_list->StopRec = $cedooperacionpyme_list->TotalRecs;
}
$cedooperacionpyme_list->RecCnt = $cedooperacionpyme_list->StartRec - 1;
if ($cedooperacionpyme_list->Recordset && !$cedooperacionpyme_list->Recordset->EOF) {
	$cedooperacionpyme_list->Recordset->moveFirst();
	$selectLimit = $cedooperacionpyme_list->UseSelectLimit;
	if (!$selectLimit && $cedooperacionpyme_list->StartRec > 1)
		$cedooperacionpyme_list->Recordset->move($cedooperacionpyme_list->StartRec - 1);
} elseif (!$cedooperacionpyme->AllowAddDeleteRow && $cedooperacionpyme_list->StopRec == 0) {
	$cedooperacionpyme_list->StopRec = $cedooperacionpyme->GridAddRowCount;
}

// Initialize aggregate
$cedooperacionpyme->RowType = ROWTYPE_AGGREGATEINIT;
$cedooperacionpyme->resetAttributes();
$cedooperacionpyme_list->renderRow();
while ($cedooperacionpyme_list->RecCnt < $cedooperacionpyme_list->StopRec) {
	$cedooperacionpyme_list->RecCnt++;
	if ($cedooperacionpyme_list->RecCnt >= $cedooperacionpyme_list->StartRec) {
		$cedooperacionpyme_list->RowCnt++;

		// Set up key count
		$cedooperacionpyme_list->KeyCount = $cedooperacionpyme_list->RowIndex;

		// Init row class and style
		$cedooperacionpyme->resetAttributes();
		$cedooperacionpyme->CssClass = "";
		if ($cedooperacionpyme->isGridAdd()) {
		} else {
			$cedooperacionpyme_list->loadRowValues($cedooperacionpyme_list->Recordset); // Load row values
		}
		$cedooperacionpyme->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$cedooperacionpyme->RowAttrs = array_merge($cedooperacionpyme->RowAttrs, array('data-rowindex'=>$cedooperacionpyme_list->RowCnt, 'id'=>'r' . $cedooperacionpyme_list->RowCnt . '_cedooperacionpyme', 'data-rowtype'=>$cedooperacionpyme->RowType));

		// Render row
		$cedooperacionpyme_list->renderRow();

		// Render list options
		$cedooperacionpyme_list->renderListOptions();
?>
	<tr<?php echo $cedooperacionpyme->rowAttributes() ?>>
<?php

// Render list options (body, left)
$cedooperacionpyme_list->ListOptions->render("body", "left", $cedooperacionpyme_list->RowCnt);
?>
	<?php if ($cedooperacionpyme->id_estaus->Visible) { // id_estaus ?>
		<td data-name="id_estaus"<?php echo $cedooperacionpyme->id_estaus->cellAttributes() ?>>
<span id="el<?php echo $cedooperacionpyme_list->RowCnt ?>_cedooperacionpyme_id_estaus" class="cedooperacionpyme_id_estaus">
<span<?php echo $cedooperacionpyme->id_estaus->viewAttributes() ?>>
<?php echo $cedooperacionpyme->id_estaus->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cedooperacionpyme->descripcion->Visible) { // descripcion ?>
		<td data-name="descripcion"<?php echo $cedooperacionpyme->descripcion->cellAttributes() ?>>
<span id="el<?php echo $cedooperacionpyme_list->RowCnt ?>_cedooperacionpyme_descripcion" class="cedooperacionpyme_descripcion">
<span<?php echo $cedooperacionpyme->descripcion->viewAttributes() ?>>
<?php echo $cedooperacionpyme->descripcion->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cedooperacionpyme_list->ListOptions->render("body", "right", $cedooperacionpyme_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$cedooperacionpyme->isGridAdd())
		$cedooperacionpyme_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$cedooperacionpyme->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($cedooperacionpyme_list->Recordset)
	$cedooperacionpyme_list->Recordset->Close();
?>
<?php if (!$cedooperacionpyme->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$cedooperacionpyme->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($cedooperacionpyme_list->Pager)) $cedooperacionpyme_list->Pager = new NumericPager($cedooperacionpyme_list->StartRec, $cedooperacionpyme_list->DisplayRecs, $cedooperacionpyme_list->TotalRecs, $cedooperacionpyme_list->RecRange, $cedooperacionpyme_list->AutoHidePager) ?>
<?php if ($cedooperacionpyme_list->Pager->RecordCount > 0 && $cedooperacionpyme_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($cedooperacionpyme_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cedooperacionpyme_list->pageUrl() ?>start=<?php echo $cedooperacionpyme_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($cedooperacionpyme_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cedooperacionpyme_list->pageUrl() ?>start=<?php echo $cedooperacionpyme_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($cedooperacionpyme_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $cedooperacionpyme_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($cedooperacionpyme_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cedooperacionpyme_list->pageUrl() ?>start=<?php echo $cedooperacionpyme_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($cedooperacionpyme_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cedooperacionpyme_list->pageUrl() ?>start=<?php echo $cedooperacionpyme_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($cedooperacionpyme_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $cedooperacionpyme_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $cedooperacionpyme_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $cedooperacionpyme_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cedooperacionpyme_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($cedooperacionpyme_list->TotalRecs == 0 && !$cedooperacionpyme->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $cedooperacionpyme_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$cedooperacionpyme_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$cedooperacionpyme->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$cedooperacionpyme_list->terminate();
?>