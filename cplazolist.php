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
$cplazo_list = new cplazo_list();

// Run the page
$cplazo_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cplazo_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$cplazo->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fcplazolist = currentForm = new ew.Form("fcplazolist", "list");
fcplazolist.formKeyCountName = '<?php echo $cplazo_list->FormKeyCountName ?>';

// Form_CustomValidate event
fcplazolist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcplazolist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fcplazolistsrch = currentSearchForm = new ew.Form("fcplazolistsrch");

// Filters
fcplazolistsrch.filterList = <?php echo $cplazo_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$cplazo->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($cplazo_list->TotalRecs > 0 && $cplazo_list->ExportOptions->visible()) { ?>
<?php $cplazo_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($cplazo_list->ImportOptions->visible()) { ?>
<?php $cplazo_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($cplazo_list->SearchOptions->visible()) { ?>
<?php $cplazo_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($cplazo_list->FilterOptions->visible()) { ?>
<?php $cplazo_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$cplazo_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$cplazo->isExport() && !$cplazo->CurrentAction) { ?>
<form name="fcplazolistsrch" id="fcplazolistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($cplazo_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fcplazolistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="cplazo">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($cplazo_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($cplazo_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $cplazo_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($cplazo_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($cplazo_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($cplazo_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($cplazo_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $cplazo_list->showPageHeader(); ?>
<?php
$cplazo_list->showMessage();
?>
<?php if ($cplazo_list->TotalRecs > 0 || $cplazo->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($cplazo_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> cplazo">
<?php if (!$cplazo->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$cplazo->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($cplazo_list->Pager)) $cplazo_list->Pager = new NumericPager($cplazo_list->StartRec, $cplazo_list->DisplayRecs, $cplazo_list->TotalRecs, $cplazo_list->RecRange, $cplazo_list->AutoHidePager) ?>
<?php if ($cplazo_list->Pager->RecordCount > 0 && $cplazo_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($cplazo_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cplazo_list->pageUrl() ?>start=<?php echo $cplazo_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($cplazo_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cplazo_list->pageUrl() ?>start=<?php echo $cplazo_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($cplazo_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $cplazo_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($cplazo_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cplazo_list->pageUrl() ?>start=<?php echo $cplazo_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($cplazo_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cplazo_list->pageUrl() ?>start=<?php echo $cplazo_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($cplazo_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $cplazo_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $cplazo_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $cplazo_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cplazo_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcplazolist" id="fcplazolist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($cplazo_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $cplazo_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cplazo">
<div id="gmp_cplazo" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($cplazo_list->TotalRecs > 0 || $cplazo->isGridEdit()) { ?>
<table id="tbl_cplazolist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$cplazo_list->RowType = ROWTYPE_HEADER;

// Render list options
$cplazo_list->renderListOptions();

// Render list options (header, left)
$cplazo_list->ListOptions->render("header", "left");
?>
<?php if ($cplazo->id_plazo->Visible) { // id_plazo ?>
	<?php if ($cplazo->sortUrl($cplazo->id_plazo) == "") { ?>
		<th data-name="id_plazo" class="<?php echo $cplazo->id_plazo->headerCellClass() ?>"><div id="elh_cplazo_id_plazo" class="cplazo_id_plazo"><div class="ew-table-header-caption"><?php echo $cplazo->id_plazo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_plazo" class="<?php echo $cplazo->id_plazo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cplazo->SortUrl($cplazo->id_plazo) ?>',2);"><div id="elh_cplazo_id_plazo" class="cplazo_id_plazo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cplazo->id_plazo->caption() ?></span><span class="ew-table-header-sort"><?php if ($cplazo->id_plazo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cplazo->id_plazo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cplazo->Tipo_Plazo->Visible) { // Tipo Plazo ?>
	<?php if ($cplazo->sortUrl($cplazo->Tipo_Plazo) == "") { ?>
		<th data-name="Tipo_Plazo" class="<?php echo $cplazo->Tipo_Plazo->headerCellClass() ?>"><div id="elh_cplazo_Tipo_Plazo" class="cplazo_Tipo_Plazo"><div class="ew-table-header-caption"><?php echo $cplazo->Tipo_Plazo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Tipo_Plazo" class="<?php echo $cplazo->Tipo_Plazo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cplazo->SortUrl($cplazo->Tipo_Plazo) ?>',2);"><div id="elh_cplazo_Tipo_Plazo" class="cplazo_Tipo_Plazo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cplazo->Tipo_Plazo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cplazo->Tipo_Plazo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cplazo->Tipo_Plazo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$cplazo_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($cplazo->ExportAll && $cplazo->isExport()) {
	$cplazo_list->StopRec = $cplazo_list->TotalRecs;
} else {

	// Set the last record to display
	if ($cplazo_list->TotalRecs > $cplazo_list->StartRec + $cplazo_list->DisplayRecs - 1)
		$cplazo_list->StopRec = $cplazo_list->StartRec + $cplazo_list->DisplayRecs - 1;
	else
		$cplazo_list->StopRec = $cplazo_list->TotalRecs;
}
$cplazo_list->RecCnt = $cplazo_list->StartRec - 1;
if ($cplazo_list->Recordset && !$cplazo_list->Recordset->EOF) {
	$cplazo_list->Recordset->moveFirst();
	$selectLimit = $cplazo_list->UseSelectLimit;
	if (!$selectLimit && $cplazo_list->StartRec > 1)
		$cplazo_list->Recordset->move($cplazo_list->StartRec - 1);
} elseif (!$cplazo->AllowAddDeleteRow && $cplazo_list->StopRec == 0) {
	$cplazo_list->StopRec = $cplazo->GridAddRowCount;
}

// Initialize aggregate
$cplazo->RowType = ROWTYPE_AGGREGATEINIT;
$cplazo->resetAttributes();
$cplazo_list->renderRow();
while ($cplazo_list->RecCnt < $cplazo_list->StopRec) {
	$cplazo_list->RecCnt++;
	if ($cplazo_list->RecCnt >= $cplazo_list->StartRec) {
		$cplazo_list->RowCnt++;

		// Set up key count
		$cplazo_list->KeyCount = $cplazo_list->RowIndex;

		// Init row class and style
		$cplazo->resetAttributes();
		$cplazo->CssClass = "";
		if ($cplazo->isGridAdd()) {
		} else {
			$cplazo_list->loadRowValues($cplazo_list->Recordset); // Load row values
		}
		$cplazo->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$cplazo->RowAttrs = array_merge($cplazo->RowAttrs, array('data-rowindex'=>$cplazo_list->RowCnt, 'id'=>'r' . $cplazo_list->RowCnt . '_cplazo', 'data-rowtype'=>$cplazo->RowType));

		// Render row
		$cplazo_list->renderRow();

		// Render list options
		$cplazo_list->renderListOptions();
?>
	<tr<?php echo $cplazo->rowAttributes() ?>>
<?php

// Render list options (body, left)
$cplazo_list->ListOptions->render("body", "left", $cplazo_list->RowCnt);
?>
	<?php if ($cplazo->id_plazo->Visible) { // id_plazo ?>
		<td data-name="id_plazo"<?php echo $cplazo->id_plazo->cellAttributes() ?>>
<span id="el<?php echo $cplazo_list->RowCnt ?>_cplazo_id_plazo" class="cplazo_id_plazo">
<span<?php echo $cplazo->id_plazo->viewAttributes() ?>>
<?php echo $cplazo->id_plazo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cplazo->Tipo_Plazo->Visible) { // Tipo Plazo ?>
		<td data-name="Tipo_Plazo"<?php echo $cplazo->Tipo_Plazo->cellAttributes() ?>>
<span id="el<?php echo $cplazo_list->RowCnt ?>_cplazo_Tipo_Plazo" class="cplazo_Tipo_Plazo">
<span<?php echo $cplazo->Tipo_Plazo->viewAttributes() ?>>
<?php echo $cplazo->Tipo_Plazo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cplazo_list->ListOptions->render("body", "right", $cplazo_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$cplazo->isGridAdd())
		$cplazo_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$cplazo->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($cplazo_list->Recordset)
	$cplazo_list->Recordset->Close();
?>
<?php if (!$cplazo->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$cplazo->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($cplazo_list->Pager)) $cplazo_list->Pager = new NumericPager($cplazo_list->StartRec, $cplazo_list->DisplayRecs, $cplazo_list->TotalRecs, $cplazo_list->RecRange, $cplazo_list->AutoHidePager) ?>
<?php if ($cplazo_list->Pager->RecordCount > 0 && $cplazo_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($cplazo_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cplazo_list->pageUrl() ?>start=<?php echo $cplazo_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($cplazo_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cplazo_list->pageUrl() ?>start=<?php echo $cplazo_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($cplazo_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $cplazo_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($cplazo_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cplazo_list->pageUrl() ?>start=<?php echo $cplazo_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($cplazo_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cplazo_list->pageUrl() ?>start=<?php echo $cplazo_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($cplazo_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $cplazo_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $cplazo_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $cplazo_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cplazo_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($cplazo_list->TotalRecs == 0 && !$cplazo->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $cplazo_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$cplazo_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$cplazo->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$cplazo_list->terminate();
?>