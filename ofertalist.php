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
$oferta_list = new oferta_list();

// Run the page
$oferta_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$oferta_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$oferta->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fofertalist = currentForm = new ew.Form("fofertalist", "list");
fofertalist.formKeyCountName = '<?php echo $oferta_list->FormKeyCountName ?>';

// Form_CustomValidate event
fofertalist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fofertalist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fofertalistsrch = currentSearchForm = new ew.Form("fofertalistsrch");

// Filters
fofertalistsrch.filterList = <?php echo $oferta_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$oferta->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($oferta_list->TotalRecs > 0 && $oferta_list->ExportOptions->visible()) { ?>
<?php $oferta_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($oferta_list->ImportOptions->visible()) { ?>
<?php $oferta_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($oferta_list->SearchOptions->visible()) { ?>
<?php $oferta_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($oferta_list->FilterOptions->visible()) { ?>
<?php $oferta_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$oferta_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$oferta->isExport() && !$oferta->CurrentAction) { ?>
<form name="fofertalistsrch" id="fofertalistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($oferta_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fofertalistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="oferta">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($oferta_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($oferta_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $oferta_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($oferta_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($oferta_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($oferta_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($oferta_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $oferta_list->showPageHeader(); ?>
<?php
$oferta_list->showMessage();
?>
<?php if ($oferta_list->TotalRecs > 0 || $oferta->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($oferta_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> oferta">
<?php if (!$oferta->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$oferta->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($oferta_list->Pager)) $oferta_list->Pager = new NumericPager($oferta_list->StartRec, $oferta_list->DisplayRecs, $oferta_list->TotalRecs, $oferta_list->RecRange, $oferta_list->AutoHidePager) ?>
<?php if ($oferta_list->Pager->RecordCount > 0 && $oferta_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($oferta_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $oferta_list->pageUrl() ?>start=<?php echo $oferta_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($oferta_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $oferta_list->pageUrl() ?>start=<?php echo $oferta_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($oferta_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $oferta_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($oferta_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $oferta_list->pageUrl() ?>start=<?php echo $oferta_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($oferta_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $oferta_list->pageUrl() ?>start=<?php echo $oferta_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($oferta_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $oferta_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $oferta_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $oferta_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $oferta_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fofertalist" id="fofertalist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($oferta_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $oferta_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="oferta">
<div id="gmp_oferta" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($oferta_list->TotalRecs > 0 || $oferta->isGridEdit()) { ?>
<table id="tbl_ofertalist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$oferta_list->RowType = ROWTYPE_HEADER;

// Render list options
$oferta_list->renderListOptions();

// Render list options (header, left)
$oferta_list->ListOptions->render("header", "left");
?>
<?php if ($oferta->idoferta->Visible) { // idoferta ?>
	<?php if ($oferta->sortUrl($oferta->idoferta) == "") { ?>
		<th data-name="idoferta" class="<?php echo $oferta->idoferta->headerCellClass() ?>"><div id="elh_oferta_idoferta" class="oferta_idoferta"><div class="ew-table-header-caption"><?php echo $oferta->idoferta->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idoferta" class="<?php echo $oferta->idoferta->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $oferta->SortUrl($oferta->idoferta) ?>',2);"><div id="elh_oferta_idoferta" class="oferta_idoferta">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $oferta->idoferta->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($oferta->idoferta->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($oferta->idoferta->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($oferta->fechaoferta->Visible) { // fechaoferta ?>
	<?php if ($oferta->sortUrl($oferta->fechaoferta) == "") { ?>
		<th data-name="fechaoferta" class="<?php echo $oferta->fechaoferta->headerCellClass() ?>"><div id="elh_oferta_fechaoferta" class="oferta_fechaoferta"><div class="ew-table-header-caption"><?php echo $oferta->fechaoferta->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fechaoferta" class="<?php echo $oferta->fechaoferta->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $oferta->SortUrl($oferta->fechaoferta) ?>',2);"><div id="elh_oferta_fechaoferta" class="oferta_fechaoferta">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $oferta->fechaoferta->caption() ?></span><span class="ew-table-header-sort"><?php if ($oferta->fechaoferta->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($oferta->fechaoferta->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($oferta->descripcionoferta->Visible) { // descripcionoferta ?>
	<?php if ($oferta->sortUrl($oferta->descripcionoferta) == "") { ?>
		<th data-name="descripcionoferta" class="<?php echo $oferta->descripcionoferta->headerCellClass() ?>"><div id="elh_oferta_descripcionoferta" class="oferta_descripcionoferta"><div class="ew-table-header-caption"><?php echo $oferta->descripcionoferta->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="descripcionoferta" class="<?php echo $oferta->descripcionoferta->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $oferta->SortUrl($oferta->descripcionoferta) ?>',2);"><div id="elh_oferta_descripcionoferta" class="oferta_descripcionoferta">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $oferta->descripcionoferta->caption() ?></span><span class="ew-table-header-sort"><?php if ($oferta->descripcionoferta->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($oferta->descripcionoferta->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$oferta_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($oferta->ExportAll && $oferta->isExport()) {
	$oferta_list->StopRec = $oferta_list->TotalRecs;
} else {

	// Set the last record to display
	if ($oferta_list->TotalRecs > $oferta_list->StartRec + $oferta_list->DisplayRecs - 1)
		$oferta_list->StopRec = $oferta_list->StartRec + $oferta_list->DisplayRecs - 1;
	else
		$oferta_list->StopRec = $oferta_list->TotalRecs;
}
$oferta_list->RecCnt = $oferta_list->StartRec - 1;
if ($oferta_list->Recordset && !$oferta_list->Recordset->EOF) {
	$oferta_list->Recordset->moveFirst();
	$selectLimit = $oferta_list->UseSelectLimit;
	if (!$selectLimit && $oferta_list->StartRec > 1)
		$oferta_list->Recordset->move($oferta_list->StartRec - 1);
} elseif (!$oferta->AllowAddDeleteRow && $oferta_list->StopRec == 0) {
	$oferta_list->StopRec = $oferta->GridAddRowCount;
}

// Initialize aggregate
$oferta->RowType = ROWTYPE_AGGREGATEINIT;
$oferta->resetAttributes();
$oferta_list->renderRow();
while ($oferta_list->RecCnt < $oferta_list->StopRec) {
	$oferta_list->RecCnt++;
	if ($oferta_list->RecCnt >= $oferta_list->StartRec) {
		$oferta_list->RowCnt++;

		// Set up key count
		$oferta_list->KeyCount = $oferta_list->RowIndex;

		// Init row class and style
		$oferta->resetAttributes();
		$oferta->CssClass = "";
		if ($oferta->isGridAdd()) {
		} else {
			$oferta_list->loadRowValues($oferta_list->Recordset); // Load row values
		}
		$oferta->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$oferta->RowAttrs = array_merge($oferta->RowAttrs, array('data-rowindex'=>$oferta_list->RowCnt, 'id'=>'r' . $oferta_list->RowCnt . '_oferta', 'data-rowtype'=>$oferta->RowType));

		// Render row
		$oferta_list->renderRow();

		// Render list options
		$oferta_list->renderListOptions();
?>
	<tr<?php echo $oferta->rowAttributes() ?>>
<?php

// Render list options (body, left)
$oferta_list->ListOptions->render("body", "left", $oferta_list->RowCnt);
?>
	<?php if ($oferta->idoferta->Visible) { // idoferta ?>
		<td data-name="idoferta"<?php echo $oferta->idoferta->cellAttributes() ?>>
<span id="el<?php echo $oferta_list->RowCnt ?>_oferta_idoferta" class="oferta_idoferta">
<span<?php echo $oferta->idoferta->viewAttributes() ?>>
<?php echo $oferta->idoferta->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($oferta->fechaoferta->Visible) { // fechaoferta ?>
		<td data-name="fechaoferta"<?php echo $oferta->fechaoferta->cellAttributes() ?>>
<span id="el<?php echo $oferta_list->RowCnt ?>_oferta_fechaoferta" class="oferta_fechaoferta">
<span<?php echo $oferta->fechaoferta->viewAttributes() ?>>
<?php echo $oferta->fechaoferta->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($oferta->descripcionoferta->Visible) { // descripcionoferta ?>
		<td data-name="descripcionoferta"<?php echo $oferta->descripcionoferta->cellAttributes() ?>>
<span id="el<?php echo $oferta_list->RowCnt ?>_oferta_descripcionoferta" class="oferta_descripcionoferta">
<span<?php echo $oferta->descripcionoferta->viewAttributes() ?>>
<?php echo $oferta->descripcionoferta->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$oferta_list->ListOptions->render("body", "right", $oferta_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$oferta->isGridAdd())
		$oferta_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$oferta->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($oferta_list->Recordset)
	$oferta_list->Recordset->Close();
?>
<?php if (!$oferta->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$oferta->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($oferta_list->Pager)) $oferta_list->Pager = new NumericPager($oferta_list->StartRec, $oferta_list->DisplayRecs, $oferta_list->TotalRecs, $oferta_list->RecRange, $oferta_list->AutoHidePager) ?>
<?php if ($oferta_list->Pager->RecordCount > 0 && $oferta_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($oferta_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $oferta_list->pageUrl() ?>start=<?php echo $oferta_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($oferta_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $oferta_list->pageUrl() ?>start=<?php echo $oferta_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($oferta_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $oferta_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($oferta_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $oferta_list->pageUrl() ?>start=<?php echo $oferta_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($oferta_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $oferta_list->pageUrl() ?>start=<?php echo $oferta_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($oferta_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $oferta_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $oferta_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $oferta_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $oferta_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($oferta_list->TotalRecs == 0 && !$oferta->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $oferta_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$oferta_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$oferta->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$oferta_list->terminate();
?>