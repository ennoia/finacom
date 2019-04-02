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
$ccalificacion_list = new ccalificacion_list();

// Run the page
$ccalificacion_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ccalificacion_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$ccalificacion->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fccalificacionlist = currentForm = new ew.Form("fccalificacionlist", "list");
fccalificacionlist.formKeyCountName = '<?php echo $ccalificacion_list->FormKeyCountName ?>';

// Form_CustomValidate event
fccalificacionlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fccalificacionlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fccalificacionlistsrch = currentSearchForm = new ew.Form("fccalificacionlistsrch");

// Filters
fccalificacionlistsrch.filterList = <?php echo $ccalificacion_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$ccalificacion->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($ccalificacion_list->TotalRecs > 0 && $ccalificacion_list->ExportOptions->visible()) { ?>
<?php $ccalificacion_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($ccalificacion_list->ImportOptions->visible()) { ?>
<?php $ccalificacion_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($ccalificacion_list->SearchOptions->visible()) { ?>
<?php $ccalificacion_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($ccalificacion_list->FilterOptions->visible()) { ?>
<?php $ccalificacion_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$ccalificacion_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$ccalificacion->isExport() && !$ccalificacion->CurrentAction) { ?>
<form name="fccalificacionlistsrch" id="fccalificacionlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($ccalificacion_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fccalificacionlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="ccalificacion">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($ccalificacion_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($ccalificacion_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $ccalificacion_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($ccalificacion_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($ccalificacion_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($ccalificacion_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($ccalificacion_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $ccalificacion_list->showPageHeader(); ?>
<?php
$ccalificacion_list->showMessage();
?>
<?php if ($ccalificacion_list->TotalRecs > 0 || $ccalificacion->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ccalificacion_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ccalificacion">
<?php if (!$ccalificacion->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$ccalificacion->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($ccalificacion_list->Pager)) $ccalificacion_list->Pager = new NumericPager($ccalificacion_list->StartRec, $ccalificacion_list->DisplayRecs, $ccalificacion_list->TotalRecs, $ccalificacion_list->RecRange, $ccalificacion_list->AutoHidePager) ?>
<?php if ($ccalificacion_list->Pager->RecordCount > 0 && $ccalificacion_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($ccalificacion_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $ccalificacion_list->pageUrl() ?>start=<?php echo $ccalificacion_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($ccalificacion_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $ccalificacion_list->pageUrl() ?>start=<?php echo $ccalificacion_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($ccalificacion_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $ccalificacion_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($ccalificacion_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $ccalificacion_list->pageUrl() ?>start=<?php echo $ccalificacion_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($ccalificacion_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $ccalificacion_list->pageUrl() ?>start=<?php echo $ccalificacion_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($ccalificacion_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $ccalificacion_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $ccalificacion_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $ccalificacion_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ccalificacion_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fccalificacionlist" id="fccalificacionlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($ccalificacion_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $ccalificacion_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ccalificacion">
<div id="gmp_ccalificacion" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($ccalificacion_list->TotalRecs > 0 || $ccalificacion->isGridEdit()) { ?>
<table id="tbl_ccalificacionlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ccalificacion_list->RowType = ROWTYPE_HEADER;

// Render list options
$ccalificacion_list->renderListOptions();

// Render list options (header, left)
$ccalificacion_list->ListOptions->render("header", "left");
?>
<?php if ($ccalificacion->idcalificacion->Visible) { // idcalificacion ?>
	<?php if ($ccalificacion->sortUrl($ccalificacion->idcalificacion) == "") { ?>
		<th data-name="idcalificacion" class="<?php echo $ccalificacion->idcalificacion->headerCellClass() ?>"><div id="elh_ccalificacion_idcalificacion" class="ccalificacion_idcalificacion"><div class="ew-table-header-caption"><?php echo $ccalificacion->idcalificacion->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idcalificacion" class="<?php echo $ccalificacion->idcalificacion->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $ccalificacion->SortUrl($ccalificacion->idcalificacion) ?>',2);"><div id="elh_ccalificacion_idcalificacion" class="ccalificacion_idcalificacion">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ccalificacion->idcalificacion->caption() ?></span><span class="ew-table-header-sort"><?php if ($ccalificacion->idcalificacion->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($ccalificacion->idcalificacion->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ccalificacion->descripcion->Visible) { // descripcion ?>
	<?php if ($ccalificacion->sortUrl($ccalificacion->descripcion) == "") { ?>
		<th data-name="descripcion" class="<?php echo $ccalificacion->descripcion->headerCellClass() ?>"><div id="elh_ccalificacion_descripcion" class="ccalificacion_descripcion"><div class="ew-table-header-caption"><?php echo $ccalificacion->descripcion->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="descripcion" class="<?php echo $ccalificacion->descripcion->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $ccalificacion->SortUrl($ccalificacion->descripcion) ?>',2);"><div id="elh_ccalificacion_descripcion" class="ccalificacion_descripcion">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ccalificacion->descripcion->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ccalificacion->descripcion->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($ccalificacion->descripcion->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ccalificacion->fondeadorrfc->Visible) { // fondeadorrfc ?>
	<?php if ($ccalificacion->sortUrl($ccalificacion->fondeadorrfc) == "") { ?>
		<th data-name="fondeadorrfc" class="<?php echo $ccalificacion->fondeadorrfc->headerCellClass() ?>"><div id="elh_ccalificacion_fondeadorrfc" class="ccalificacion_fondeadorrfc"><div class="ew-table-header-caption"><?php echo $ccalificacion->fondeadorrfc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fondeadorrfc" class="<?php echo $ccalificacion->fondeadorrfc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $ccalificacion->SortUrl($ccalificacion->fondeadorrfc) ?>',2);"><div id="elh_ccalificacion_fondeadorrfc" class="ccalificacion_fondeadorrfc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ccalificacion->fondeadorrfc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ccalificacion->fondeadorrfc->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($ccalificacion->fondeadorrfc->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ccalificacion_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($ccalificacion->ExportAll && $ccalificacion->isExport()) {
	$ccalificacion_list->StopRec = $ccalificacion_list->TotalRecs;
} else {

	// Set the last record to display
	if ($ccalificacion_list->TotalRecs > $ccalificacion_list->StartRec + $ccalificacion_list->DisplayRecs - 1)
		$ccalificacion_list->StopRec = $ccalificacion_list->StartRec + $ccalificacion_list->DisplayRecs - 1;
	else
		$ccalificacion_list->StopRec = $ccalificacion_list->TotalRecs;
}
$ccalificacion_list->RecCnt = $ccalificacion_list->StartRec - 1;
if ($ccalificacion_list->Recordset && !$ccalificacion_list->Recordset->EOF) {
	$ccalificacion_list->Recordset->moveFirst();
	$selectLimit = $ccalificacion_list->UseSelectLimit;
	if (!$selectLimit && $ccalificacion_list->StartRec > 1)
		$ccalificacion_list->Recordset->move($ccalificacion_list->StartRec - 1);
} elseif (!$ccalificacion->AllowAddDeleteRow && $ccalificacion_list->StopRec == 0) {
	$ccalificacion_list->StopRec = $ccalificacion->GridAddRowCount;
}

// Initialize aggregate
$ccalificacion->RowType = ROWTYPE_AGGREGATEINIT;
$ccalificacion->resetAttributes();
$ccalificacion_list->renderRow();
while ($ccalificacion_list->RecCnt < $ccalificacion_list->StopRec) {
	$ccalificacion_list->RecCnt++;
	if ($ccalificacion_list->RecCnt >= $ccalificacion_list->StartRec) {
		$ccalificacion_list->RowCnt++;

		// Set up key count
		$ccalificacion_list->KeyCount = $ccalificacion_list->RowIndex;

		// Init row class and style
		$ccalificacion->resetAttributes();
		$ccalificacion->CssClass = "";
		if ($ccalificacion->isGridAdd()) {
		} else {
			$ccalificacion_list->loadRowValues($ccalificacion_list->Recordset); // Load row values
		}
		$ccalificacion->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$ccalificacion->RowAttrs = array_merge($ccalificacion->RowAttrs, array('data-rowindex'=>$ccalificacion_list->RowCnt, 'id'=>'r' . $ccalificacion_list->RowCnt . '_ccalificacion', 'data-rowtype'=>$ccalificacion->RowType));

		// Render row
		$ccalificacion_list->renderRow();

		// Render list options
		$ccalificacion_list->renderListOptions();
?>
	<tr<?php echo $ccalificacion->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ccalificacion_list->ListOptions->render("body", "left", $ccalificacion_list->RowCnt);
?>
	<?php if ($ccalificacion->idcalificacion->Visible) { // idcalificacion ?>
		<td data-name="idcalificacion"<?php echo $ccalificacion->idcalificacion->cellAttributes() ?>>
<span id="el<?php echo $ccalificacion_list->RowCnt ?>_ccalificacion_idcalificacion" class="ccalificacion_idcalificacion">
<span<?php echo $ccalificacion->idcalificacion->viewAttributes() ?>>
<?php echo $ccalificacion->idcalificacion->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ccalificacion->descripcion->Visible) { // descripcion ?>
		<td data-name="descripcion"<?php echo $ccalificacion->descripcion->cellAttributes() ?>>
<span id="el<?php echo $ccalificacion_list->RowCnt ?>_ccalificacion_descripcion" class="ccalificacion_descripcion">
<span<?php echo $ccalificacion->descripcion->viewAttributes() ?>>
<?php echo $ccalificacion->descripcion->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ccalificacion->fondeadorrfc->Visible) { // fondeadorrfc ?>
		<td data-name="fondeadorrfc"<?php echo $ccalificacion->fondeadorrfc->cellAttributes() ?>>
<span id="el<?php echo $ccalificacion_list->RowCnt ?>_ccalificacion_fondeadorrfc" class="ccalificacion_fondeadorrfc">
<span<?php echo $ccalificacion->fondeadorrfc->viewAttributes() ?>>
<?php echo $ccalificacion->fondeadorrfc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ccalificacion_list->ListOptions->render("body", "right", $ccalificacion_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$ccalificacion->isGridAdd())
		$ccalificacion_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$ccalificacion->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ccalificacion_list->Recordset)
	$ccalificacion_list->Recordset->Close();
?>
<?php if (!$ccalificacion->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$ccalificacion->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($ccalificacion_list->Pager)) $ccalificacion_list->Pager = new NumericPager($ccalificacion_list->StartRec, $ccalificacion_list->DisplayRecs, $ccalificacion_list->TotalRecs, $ccalificacion_list->RecRange, $ccalificacion_list->AutoHidePager) ?>
<?php if ($ccalificacion_list->Pager->RecordCount > 0 && $ccalificacion_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($ccalificacion_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $ccalificacion_list->pageUrl() ?>start=<?php echo $ccalificacion_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($ccalificacion_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $ccalificacion_list->pageUrl() ?>start=<?php echo $ccalificacion_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($ccalificacion_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $ccalificacion_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($ccalificacion_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $ccalificacion_list->pageUrl() ?>start=<?php echo $ccalificacion_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($ccalificacion_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $ccalificacion_list->pageUrl() ?>start=<?php echo $ccalificacion_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($ccalificacion_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $ccalificacion_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $ccalificacion_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $ccalificacion_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ccalificacion_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ccalificacion_list->TotalRecs == 0 && !$ccalificacion->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ccalificacion_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$ccalificacion_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$ccalificacion->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$ccalificacion_list->terminate();
?>