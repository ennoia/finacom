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
$cestadofactura_list = new cestadofactura_list();

// Run the page
$cestadofactura_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cestadofactura_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$cestadofactura->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fcestadofacturalist = currentForm = new ew.Form("fcestadofacturalist", "list");
fcestadofacturalist.formKeyCountName = '<?php echo $cestadofactura_list->FormKeyCountName ?>';

// Form_CustomValidate event
fcestadofacturalist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcestadofacturalist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fcestadofacturalistsrch = currentSearchForm = new ew.Form("fcestadofacturalistsrch");

// Filters
fcestadofacturalistsrch.filterList = <?php echo $cestadofactura_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$cestadofactura->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($cestadofactura_list->TotalRecs > 0 && $cestadofactura_list->ExportOptions->visible()) { ?>
<?php $cestadofactura_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($cestadofactura_list->ImportOptions->visible()) { ?>
<?php $cestadofactura_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($cestadofactura_list->SearchOptions->visible()) { ?>
<?php $cestadofactura_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($cestadofactura_list->FilterOptions->visible()) { ?>
<?php $cestadofactura_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$cestadofactura_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$cestadofactura->isExport() && !$cestadofactura->CurrentAction) { ?>
<form name="fcestadofacturalistsrch" id="fcestadofacturalistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($cestadofactura_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fcestadofacturalistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="cestadofactura">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($cestadofactura_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($cestadofactura_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $cestadofactura_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($cestadofactura_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($cestadofactura_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($cestadofactura_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($cestadofactura_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $cestadofactura_list->showPageHeader(); ?>
<?php
$cestadofactura_list->showMessage();
?>
<?php if ($cestadofactura_list->TotalRecs > 0 || $cestadofactura->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($cestadofactura_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> cestadofactura">
<?php if (!$cestadofactura->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$cestadofactura->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($cestadofactura_list->Pager)) $cestadofactura_list->Pager = new NumericPager($cestadofactura_list->StartRec, $cestadofactura_list->DisplayRecs, $cestadofactura_list->TotalRecs, $cestadofactura_list->RecRange, $cestadofactura_list->AutoHidePager) ?>
<?php if ($cestadofactura_list->Pager->RecordCount > 0 && $cestadofactura_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($cestadofactura_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cestadofactura_list->pageUrl() ?>start=<?php echo $cestadofactura_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($cestadofactura_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cestadofactura_list->pageUrl() ?>start=<?php echo $cestadofactura_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($cestadofactura_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $cestadofactura_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($cestadofactura_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cestadofactura_list->pageUrl() ?>start=<?php echo $cestadofactura_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($cestadofactura_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cestadofactura_list->pageUrl() ?>start=<?php echo $cestadofactura_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($cestadofactura_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $cestadofactura_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $cestadofactura_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $cestadofactura_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cestadofactura_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcestadofacturalist" id="fcestadofacturalist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($cestadofactura_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $cestadofactura_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cestadofactura">
<div id="gmp_cestadofactura" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($cestadofactura_list->TotalRecs > 0 || $cestadofactura->isGridEdit()) { ?>
<table id="tbl_cestadofacturalist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$cestadofactura_list->RowType = ROWTYPE_HEADER;

// Render list options
$cestadofactura_list->renderListOptions();

// Render list options (header, left)
$cestadofactura_list->ListOptions->render("header", "left");
?>
<?php if ($cestadofactura->id_edofactura->Visible) { // id_edofactura ?>
	<?php if ($cestadofactura->sortUrl($cestadofactura->id_edofactura) == "") { ?>
		<th data-name="id_edofactura" class="<?php echo $cestadofactura->id_edofactura->headerCellClass() ?>"><div id="elh_cestadofactura_id_edofactura" class="cestadofactura_id_edofactura"><div class="ew-table-header-caption"><?php echo $cestadofactura->id_edofactura->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_edofactura" class="<?php echo $cestadofactura->id_edofactura->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cestadofactura->SortUrl($cestadofactura->id_edofactura) ?>',2);"><div id="elh_cestadofactura_id_edofactura" class="cestadofactura_id_edofactura">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cestadofactura->id_edofactura->caption() ?></span><span class="ew-table-header-sort"><?php if ($cestadofactura->id_edofactura->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cestadofactura->id_edofactura->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cestadofactura->descedofactura->Visible) { // descedofactura ?>
	<?php if ($cestadofactura->sortUrl($cestadofactura->descedofactura) == "") { ?>
		<th data-name="descedofactura" class="<?php echo $cestadofactura->descedofactura->headerCellClass() ?>"><div id="elh_cestadofactura_descedofactura" class="cestadofactura_descedofactura"><div class="ew-table-header-caption"><?php echo $cestadofactura->descedofactura->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="descedofactura" class="<?php echo $cestadofactura->descedofactura->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cestadofactura->SortUrl($cestadofactura->descedofactura) ?>',2);"><div id="elh_cestadofactura_descedofactura" class="cestadofactura_descedofactura">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cestadofactura->descedofactura->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cestadofactura->descedofactura->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cestadofactura->descedofactura->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$cestadofactura_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($cestadofactura->ExportAll && $cestadofactura->isExport()) {
	$cestadofactura_list->StopRec = $cestadofactura_list->TotalRecs;
} else {

	// Set the last record to display
	if ($cestadofactura_list->TotalRecs > $cestadofactura_list->StartRec + $cestadofactura_list->DisplayRecs - 1)
		$cestadofactura_list->StopRec = $cestadofactura_list->StartRec + $cestadofactura_list->DisplayRecs - 1;
	else
		$cestadofactura_list->StopRec = $cestadofactura_list->TotalRecs;
}
$cestadofactura_list->RecCnt = $cestadofactura_list->StartRec - 1;
if ($cestadofactura_list->Recordset && !$cestadofactura_list->Recordset->EOF) {
	$cestadofactura_list->Recordset->moveFirst();
	$selectLimit = $cestadofactura_list->UseSelectLimit;
	if (!$selectLimit && $cestadofactura_list->StartRec > 1)
		$cestadofactura_list->Recordset->move($cestadofactura_list->StartRec - 1);
} elseif (!$cestadofactura->AllowAddDeleteRow && $cestadofactura_list->StopRec == 0) {
	$cestadofactura_list->StopRec = $cestadofactura->GridAddRowCount;
}

// Initialize aggregate
$cestadofactura->RowType = ROWTYPE_AGGREGATEINIT;
$cestadofactura->resetAttributes();
$cestadofactura_list->renderRow();
while ($cestadofactura_list->RecCnt < $cestadofactura_list->StopRec) {
	$cestadofactura_list->RecCnt++;
	if ($cestadofactura_list->RecCnt >= $cestadofactura_list->StartRec) {
		$cestadofactura_list->RowCnt++;

		// Set up key count
		$cestadofactura_list->KeyCount = $cestadofactura_list->RowIndex;

		// Init row class and style
		$cestadofactura->resetAttributes();
		$cestadofactura->CssClass = "";
		if ($cestadofactura->isGridAdd()) {
		} else {
			$cestadofactura_list->loadRowValues($cestadofactura_list->Recordset); // Load row values
		}
		$cestadofactura->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$cestadofactura->RowAttrs = array_merge($cestadofactura->RowAttrs, array('data-rowindex'=>$cestadofactura_list->RowCnt, 'id'=>'r' . $cestadofactura_list->RowCnt . '_cestadofactura', 'data-rowtype'=>$cestadofactura->RowType));

		// Render row
		$cestadofactura_list->renderRow();

		// Render list options
		$cestadofactura_list->renderListOptions();
?>
	<tr<?php echo $cestadofactura->rowAttributes() ?>>
<?php

// Render list options (body, left)
$cestadofactura_list->ListOptions->render("body", "left", $cestadofactura_list->RowCnt);
?>
	<?php if ($cestadofactura->id_edofactura->Visible) { // id_edofactura ?>
		<td data-name="id_edofactura"<?php echo $cestadofactura->id_edofactura->cellAttributes() ?>>
<span id="el<?php echo $cestadofactura_list->RowCnt ?>_cestadofactura_id_edofactura" class="cestadofactura_id_edofactura">
<span<?php echo $cestadofactura->id_edofactura->viewAttributes() ?>>
<?php echo $cestadofactura->id_edofactura->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cestadofactura->descedofactura->Visible) { // descedofactura ?>
		<td data-name="descedofactura"<?php echo $cestadofactura->descedofactura->cellAttributes() ?>>
<span id="el<?php echo $cestadofactura_list->RowCnt ?>_cestadofactura_descedofactura" class="cestadofactura_descedofactura">
<span<?php echo $cestadofactura->descedofactura->viewAttributes() ?>>
<?php echo $cestadofactura->descedofactura->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cestadofactura_list->ListOptions->render("body", "right", $cestadofactura_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$cestadofactura->isGridAdd())
		$cestadofactura_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$cestadofactura->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($cestadofactura_list->Recordset)
	$cestadofactura_list->Recordset->Close();
?>
<?php if (!$cestadofactura->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$cestadofactura->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($cestadofactura_list->Pager)) $cestadofactura_list->Pager = new NumericPager($cestadofactura_list->StartRec, $cestadofactura_list->DisplayRecs, $cestadofactura_list->TotalRecs, $cestadofactura_list->RecRange, $cestadofactura_list->AutoHidePager) ?>
<?php if ($cestadofactura_list->Pager->RecordCount > 0 && $cestadofactura_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($cestadofactura_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cestadofactura_list->pageUrl() ?>start=<?php echo $cestadofactura_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($cestadofactura_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cestadofactura_list->pageUrl() ?>start=<?php echo $cestadofactura_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($cestadofactura_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $cestadofactura_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($cestadofactura_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cestadofactura_list->pageUrl() ?>start=<?php echo $cestadofactura_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($cestadofactura_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cestadofactura_list->pageUrl() ?>start=<?php echo $cestadofactura_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($cestadofactura_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $cestadofactura_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $cestadofactura_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $cestadofactura_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cestadofactura_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($cestadofactura_list->TotalRecs == 0 && !$cestadofactura->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $cestadofactura_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$cestadofactura_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$cestadofactura->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$cestadofactura_list->terminate();
?>