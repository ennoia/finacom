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
$ctipomonto_list = new ctipomonto_list();

// Run the page
$ctipomonto_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ctipomonto_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$ctipomonto->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fctipomontolist = currentForm = new ew.Form("fctipomontolist", "list");
fctipomontolist.formKeyCountName = '<?php echo $ctipomonto_list->FormKeyCountName ?>';

// Form_CustomValidate event
fctipomontolist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fctipomontolist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fctipomontolistsrch = currentSearchForm = new ew.Form("fctipomontolistsrch");

// Filters
fctipomontolistsrch.filterList = <?php echo $ctipomonto_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$ctipomonto->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($ctipomonto_list->TotalRecs > 0 && $ctipomonto_list->ExportOptions->visible()) { ?>
<?php $ctipomonto_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($ctipomonto_list->ImportOptions->visible()) { ?>
<?php $ctipomonto_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($ctipomonto_list->SearchOptions->visible()) { ?>
<?php $ctipomonto_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($ctipomonto_list->FilterOptions->visible()) { ?>
<?php $ctipomonto_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$ctipomonto_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$ctipomonto->isExport() && !$ctipomonto->CurrentAction) { ?>
<form name="fctipomontolistsrch" id="fctipomontolistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($ctipomonto_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fctipomontolistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="ctipomonto">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($ctipomonto_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($ctipomonto_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $ctipomonto_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($ctipomonto_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($ctipomonto_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($ctipomonto_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($ctipomonto_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $ctipomonto_list->showPageHeader(); ?>
<?php
$ctipomonto_list->showMessage();
?>
<?php if ($ctipomonto_list->TotalRecs > 0 || $ctipomonto->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ctipomonto_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ctipomonto">
<?php if (!$ctipomonto->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$ctipomonto->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($ctipomonto_list->Pager)) $ctipomonto_list->Pager = new NumericPager($ctipomonto_list->StartRec, $ctipomonto_list->DisplayRecs, $ctipomonto_list->TotalRecs, $ctipomonto_list->RecRange, $ctipomonto_list->AutoHidePager) ?>
<?php if ($ctipomonto_list->Pager->RecordCount > 0 && $ctipomonto_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($ctipomonto_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $ctipomonto_list->pageUrl() ?>start=<?php echo $ctipomonto_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($ctipomonto_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $ctipomonto_list->pageUrl() ?>start=<?php echo $ctipomonto_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($ctipomonto_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $ctipomonto_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($ctipomonto_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $ctipomonto_list->pageUrl() ?>start=<?php echo $ctipomonto_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($ctipomonto_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $ctipomonto_list->pageUrl() ?>start=<?php echo $ctipomonto_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($ctipomonto_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $ctipomonto_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $ctipomonto_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $ctipomonto_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ctipomonto_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fctipomontolist" id="fctipomontolist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($ctipomonto_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $ctipomonto_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ctipomonto">
<div id="gmp_ctipomonto" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($ctipomonto_list->TotalRecs > 0 || $ctipomonto->isGridEdit()) { ?>
<table id="tbl_ctipomontolist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ctipomonto_list->RowType = ROWTYPE_HEADER;

// Render list options
$ctipomonto_list->renderListOptions();

// Render list options (header, left)
$ctipomonto_list->ListOptions->render("header", "left");
?>
<?php if ($ctipomonto->idtipomonto->Visible) { // idtipomonto ?>
	<?php if ($ctipomonto->sortUrl($ctipomonto->idtipomonto) == "") { ?>
		<th data-name="idtipomonto" class="<?php echo $ctipomonto->idtipomonto->headerCellClass() ?>"><div id="elh_ctipomonto_idtipomonto" class="ctipomonto_idtipomonto"><div class="ew-table-header-caption"><?php echo $ctipomonto->idtipomonto->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idtipomonto" class="<?php echo $ctipomonto->idtipomonto->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $ctipomonto->SortUrl($ctipomonto->idtipomonto) ?>',2);"><div id="elh_ctipomonto_idtipomonto" class="ctipomonto_idtipomonto">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ctipomonto->idtipomonto->caption() ?></span><span class="ew-table-header-sort"><?php if ($ctipomonto->idtipomonto->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($ctipomonto->idtipomonto->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ctipomonto->descripcion->Visible) { // descripcion ?>
	<?php if ($ctipomonto->sortUrl($ctipomonto->descripcion) == "") { ?>
		<th data-name="descripcion" class="<?php echo $ctipomonto->descripcion->headerCellClass() ?>"><div id="elh_ctipomonto_descripcion" class="ctipomonto_descripcion"><div class="ew-table-header-caption"><?php echo $ctipomonto->descripcion->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="descripcion" class="<?php echo $ctipomonto->descripcion->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $ctipomonto->SortUrl($ctipomonto->descripcion) ?>',2);"><div id="elh_ctipomonto_descripcion" class="ctipomonto_descripcion">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ctipomonto->descripcion->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ctipomonto->descripcion->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($ctipomonto->descripcion->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ctipomonto_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($ctipomonto->ExportAll && $ctipomonto->isExport()) {
	$ctipomonto_list->StopRec = $ctipomonto_list->TotalRecs;
} else {

	// Set the last record to display
	if ($ctipomonto_list->TotalRecs > $ctipomonto_list->StartRec + $ctipomonto_list->DisplayRecs - 1)
		$ctipomonto_list->StopRec = $ctipomonto_list->StartRec + $ctipomonto_list->DisplayRecs - 1;
	else
		$ctipomonto_list->StopRec = $ctipomonto_list->TotalRecs;
}
$ctipomonto_list->RecCnt = $ctipomonto_list->StartRec - 1;
if ($ctipomonto_list->Recordset && !$ctipomonto_list->Recordset->EOF) {
	$ctipomonto_list->Recordset->moveFirst();
	$selectLimit = $ctipomonto_list->UseSelectLimit;
	if (!$selectLimit && $ctipomonto_list->StartRec > 1)
		$ctipomonto_list->Recordset->move($ctipomonto_list->StartRec - 1);
} elseif (!$ctipomonto->AllowAddDeleteRow && $ctipomonto_list->StopRec == 0) {
	$ctipomonto_list->StopRec = $ctipomonto->GridAddRowCount;
}

// Initialize aggregate
$ctipomonto->RowType = ROWTYPE_AGGREGATEINIT;
$ctipomonto->resetAttributes();
$ctipomonto_list->renderRow();
while ($ctipomonto_list->RecCnt < $ctipomonto_list->StopRec) {
	$ctipomonto_list->RecCnt++;
	if ($ctipomonto_list->RecCnt >= $ctipomonto_list->StartRec) {
		$ctipomonto_list->RowCnt++;

		// Set up key count
		$ctipomonto_list->KeyCount = $ctipomonto_list->RowIndex;

		// Init row class and style
		$ctipomonto->resetAttributes();
		$ctipomonto->CssClass = "";
		if ($ctipomonto->isGridAdd()) {
		} else {
			$ctipomonto_list->loadRowValues($ctipomonto_list->Recordset); // Load row values
		}
		$ctipomonto->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$ctipomonto->RowAttrs = array_merge($ctipomonto->RowAttrs, array('data-rowindex'=>$ctipomonto_list->RowCnt, 'id'=>'r' . $ctipomonto_list->RowCnt . '_ctipomonto', 'data-rowtype'=>$ctipomonto->RowType));

		// Render row
		$ctipomonto_list->renderRow();

		// Render list options
		$ctipomonto_list->renderListOptions();
?>
	<tr<?php echo $ctipomonto->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ctipomonto_list->ListOptions->render("body", "left", $ctipomonto_list->RowCnt);
?>
	<?php if ($ctipomonto->idtipomonto->Visible) { // idtipomonto ?>
		<td data-name="idtipomonto"<?php echo $ctipomonto->idtipomonto->cellAttributes() ?>>
<span id="el<?php echo $ctipomonto_list->RowCnt ?>_ctipomonto_idtipomonto" class="ctipomonto_idtipomonto">
<span<?php echo $ctipomonto->idtipomonto->viewAttributes() ?>>
<?php echo $ctipomonto->idtipomonto->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ctipomonto->descripcion->Visible) { // descripcion ?>
		<td data-name="descripcion"<?php echo $ctipomonto->descripcion->cellAttributes() ?>>
<span id="el<?php echo $ctipomonto_list->RowCnt ?>_ctipomonto_descripcion" class="ctipomonto_descripcion">
<span<?php echo $ctipomonto->descripcion->viewAttributes() ?>>
<?php echo $ctipomonto->descripcion->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ctipomonto_list->ListOptions->render("body", "right", $ctipomonto_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$ctipomonto->isGridAdd())
		$ctipomonto_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$ctipomonto->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ctipomonto_list->Recordset)
	$ctipomonto_list->Recordset->Close();
?>
<?php if (!$ctipomonto->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$ctipomonto->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($ctipomonto_list->Pager)) $ctipomonto_list->Pager = new NumericPager($ctipomonto_list->StartRec, $ctipomonto_list->DisplayRecs, $ctipomonto_list->TotalRecs, $ctipomonto_list->RecRange, $ctipomonto_list->AutoHidePager) ?>
<?php if ($ctipomonto_list->Pager->RecordCount > 0 && $ctipomonto_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($ctipomonto_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $ctipomonto_list->pageUrl() ?>start=<?php echo $ctipomonto_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($ctipomonto_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $ctipomonto_list->pageUrl() ?>start=<?php echo $ctipomonto_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($ctipomonto_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $ctipomonto_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($ctipomonto_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $ctipomonto_list->pageUrl() ?>start=<?php echo $ctipomonto_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($ctipomonto_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $ctipomonto_list->pageUrl() ?>start=<?php echo $ctipomonto_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($ctipomonto_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $ctipomonto_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $ctipomonto_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $ctipomonto_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ctipomonto_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ctipomonto_list->TotalRecs == 0 && !$ctipomonto->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ctipomonto_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$ctipomonto_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$ctipomonto->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$ctipomonto_list->terminate();
?>