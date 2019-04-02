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
$parametros_list = new parametros_list();

// Run the page
$parametros_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$parametros_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$parametros->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fparametroslist = currentForm = new ew.Form("fparametroslist", "list");
fparametroslist.formKeyCountName = '<?php echo $parametros_list->FormKeyCountName ?>';

// Form_CustomValidate event
fparametroslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fparametroslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fparametroslistsrch = currentSearchForm = new ew.Form("fparametroslistsrch");

// Filters
fparametroslistsrch.filterList = <?php echo $parametros_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$parametros->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($parametros_list->TotalRecs > 0 && $parametros_list->ExportOptions->visible()) { ?>
<?php $parametros_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($parametros_list->ImportOptions->visible()) { ?>
<?php $parametros_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($parametros_list->SearchOptions->visible()) { ?>
<?php $parametros_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($parametros_list->FilterOptions->visible()) { ?>
<?php $parametros_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$parametros_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$parametros->isExport() && !$parametros->CurrentAction) { ?>
<form name="fparametroslistsrch" id="fparametroslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($parametros_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fparametroslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="parametros">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($parametros_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($parametros_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $parametros_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($parametros_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($parametros_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($parametros_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($parametros_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $parametros_list->showPageHeader(); ?>
<?php
$parametros_list->showMessage();
?>
<?php if ($parametros_list->TotalRecs > 0 || $parametros->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($parametros_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> parametros">
<?php if (!$parametros->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$parametros->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($parametros_list->Pager)) $parametros_list->Pager = new NumericPager($parametros_list->StartRec, $parametros_list->DisplayRecs, $parametros_list->TotalRecs, $parametros_list->RecRange, $parametros_list->AutoHidePager) ?>
<?php if ($parametros_list->Pager->RecordCount > 0 && $parametros_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($parametros_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $parametros_list->pageUrl() ?>start=<?php echo $parametros_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($parametros_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $parametros_list->pageUrl() ?>start=<?php echo $parametros_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($parametros_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $parametros_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($parametros_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $parametros_list->pageUrl() ?>start=<?php echo $parametros_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($parametros_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $parametros_list->pageUrl() ?>start=<?php echo $parametros_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($parametros_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $parametros_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $parametros_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $parametros_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $parametros_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fparametroslist" id="fparametroslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($parametros_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $parametros_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="parametros">
<div id="gmp_parametros" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($parametros_list->TotalRecs > 0 || $parametros->isGridEdit()) { ?>
<table id="tbl_parametroslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$parametros_list->RowType = ROWTYPE_HEADER;

// Render list options
$parametros_list->renderListOptions();

// Render list options (header, left)
$parametros_list->ListOptions->render("header", "left");
?>
<?php if ($parametros->id_parametro->Visible) { // id_parametro ?>
	<?php if ($parametros->sortUrl($parametros->id_parametro) == "") { ?>
		<th data-name="id_parametro" class="<?php echo $parametros->id_parametro->headerCellClass() ?>"><div id="elh_parametros_id_parametro" class="parametros_id_parametro"><div class="ew-table-header-caption"><?php echo $parametros->id_parametro->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_parametro" class="<?php echo $parametros->id_parametro->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $parametros->SortUrl($parametros->id_parametro) ?>',2);"><div id="elh_parametros_id_parametro" class="parametros_id_parametro">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $parametros->id_parametro->caption() ?></span><span class="ew-table-header-sort"><?php if ($parametros->id_parametro->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($parametros->id_parametro->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($parametros->diascalculo->Visible) { // diascalculo ?>
	<?php if ($parametros->sortUrl($parametros->diascalculo) == "") { ?>
		<th data-name="diascalculo" class="<?php echo $parametros->diascalculo->headerCellClass() ?>"><div id="elh_parametros_diascalculo" class="parametros_diascalculo"><div class="ew-table-header-caption"><?php echo $parametros->diascalculo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="diascalculo" class="<?php echo $parametros->diascalculo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $parametros->SortUrl($parametros->diascalculo) ?>',2);"><div id="elh_parametros_diascalculo" class="parametros_diascalculo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $parametros->diascalculo->caption() ?></span><span class="ew-table-header-sort"><?php if ($parametros->diascalculo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($parametros->diascalculo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($parametros->modulo->Visible) { // modulo ?>
	<?php if ($parametros->sortUrl($parametros->modulo) == "") { ?>
		<th data-name="modulo" class="<?php echo $parametros->modulo->headerCellClass() ?>"><div id="elh_parametros_modulo" class="parametros_modulo"><div class="ew-table-header-caption"><?php echo $parametros->modulo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="modulo" class="<?php echo $parametros->modulo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $parametros->SortUrl($parametros->modulo) ?>',2);"><div id="elh_parametros_modulo" class="parametros_modulo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $parametros->modulo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($parametros->modulo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($parametros->modulo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($parametros->unidadmedida->Visible) { // unidadmedida ?>
	<?php if ($parametros->sortUrl($parametros->unidadmedida) == "") { ?>
		<th data-name="unidadmedida" class="<?php echo $parametros->unidadmedida->headerCellClass() ?>"><div id="elh_parametros_unidadmedida" class="parametros_unidadmedida"><div class="ew-table-header-caption"><?php echo $parametros->unidadmedida->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="unidadmedida" class="<?php echo $parametros->unidadmedida->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $parametros->SortUrl($parametros->unidadmedida) ?>',2);"><div id="elh_parametros_unidadmedida" class="parametros_unidadmedida">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $parametros->unidadmedida->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($parametros->unidadmedida->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($parametros->unidadmedida->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$parametros_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($parametros->ExportAll && $parametros->isExport()) {
	$parametros_list->StopRec = $parametros_list->TotalRecs;
} else {

	// Set the last record to display
	if ($parametros_list->TotalRecs > $parametros_list->StartRec + $parametros_list->DisplayRecs - 1)
		$parametros_list->StopRec = $parametros_list->StartRec + $parametros_list->DisplayRecs - 1;
	else
		$parametros_list->StopRec = $parametros_list->TotalRecs;
}
$parametros_list->RecCnt = $parametros_list->StartRec - 1;
if ($parametros_list->Recordset && !$parametros_list->Recordset->EOF) {
	$parametros_list->Recordset->moveFirst();
	$selectLimit = $parametros_list->UseSelectLimit;
	if (!$selectLimit && $parametros_list->StartRec > 1)
		$parametros_list->Recordset->move($parametros_list->StartRec - 1);
} elseif (!$parametros->AllowAddDeleteRow && $parametros_list->StopRec == 0) {
	$parametros_list->StopRec = $parametros->GridAddRowCount;
}

// Initialize aggregate
$parametros->RowType = ROWTYPE_AGGREGATEINIT;
$parametros->resetAttributes();
$parametros_list->renderRow();
while ($parametros_list->RecCnt < $parametros_list->StopRec) {
	$parametros_list->RecCnt++;
	if ($parametros_list->RecCnt >= $parametros_list->StartRec) {
		$parametros_list->RowCnt++;

		// Set up key count
		$parametros_list->KeyCount = $parametros_list->RowIndex;

		// Init row class and style
		$parametros->resetAttributes();
		$parametros->CssClass = "";
		if ($parametros->isGridAdd()) {
		} else {
			$parametros_list->loadRowValues($parametros_list->Recordset); // Load row values
		}
		$parametros->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$parametros->RowAttrs = array_merge($parametros->RowAttrs, array('data-rowindex'=>$parametros_list->RowCnt, 'id'=>'r' . $parametros_list->RowCnt . '_parametros', 'data-rowtype'=>$parametros->RowType));

		// Render row
		$parametros_list->renderRow();

		// Render list options
		$parametros_list->renderListOptions();
?>
	<tr<?php echo $parametros->rowAttributes() ?>>
<?php

// Render list options (body, left)
$parametros_list->ListOptions->render("body", "left", $parametros_list->RowCnt);
?>
	<?php if ($parametros->id_parametro->Visible) { // id_parametro ?>
		<td data-name="id_parametro"<?php echo $parametros->id_parametro->cellAttributes() ?>>
<span id="el<?php echo $parametros_list->RowCnt ?>_parametros_id_parametro" class="parametros_id_parametro">
<span<?php echo $parametros->id_parametro->viewAttributes() ?>>
<?php echo $parametros->id_parametro->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($parametros->diascalculo->Visible) { // diascalculo ?>
		<td data-name="diascalculo"<?php echo $parametros->diascalculo->cellAttributes() ?>>
<span id="el<?php echo $parametros_list->RowCnt ?>_parametros_diascalculo" class="parametros_diascalculo">
<span<?php echo $parametros->diascalculo->viewAttributes() ?>>
<?php echo $parametros->diascalculo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($parametros->modulo->Visible) { // modulo ?>
		<td data-name="modulo"<?php echo $parametros->modulo->cellAttributes() ?>>
<span id="el<?php echo $parametros_list->RowCnt ?>_parametros_modulo" class="parametros_modulo">
<span<?php echo $parametros->modulo->viewAttributes() ?>>
<?php echo $parametros->modulo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($parametros->unidadmedida->Visible) { // unidadmedida ?>
		<td data-name="unidadmedida"<?php echo $parametros->unidadmedida->cellAttributes() ?>>
<span id="el<?php echo $parametros_list->RowCnt ?>_parametros_unidadmedida" class="parametros_unidadmedida">
<span<?php echo $parametros->unidadmedida->viewAttributes() ?>>
<?php echo $parametros->unidadmedida->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$parametros_list->ListOptions->render("body", "right", $parametros_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$parametros->isGridAdd())
		$parametros_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$parametros->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($parametros_list->Recordset)
	$parametros_list->Recordset->Close();
?>
<?php if (!$parametros->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$parametros->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($parametros_list->Pager)) $parametros_list->Pager = new NumericPager($parametros_list->StartRec, $parametros_list->DisplayRecs, $parametros_list->TotalRecs, $parametros_list->RecRange, $parametros_list->AutoHidePager) ?>
<?php if ($parametros_list->Pager->RecordCount > 0 && $parametros_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($parametros_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $parametros_list->pageUrl() ?>start=<?php echo $parametros_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($parametros_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $parametros_list->pageUrl() ?>start=<?php echo $parametros_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($parametros_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $parametros_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($parametros_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $parametros_list->pageUrl() ?>start=<?php echo $parametros_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($parametros_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $parametros_list->pageUrl() ?>start=<?php echo $parametros_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($parametros_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $parametros_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $parametros_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $parametros_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $parametros_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($parametros_list->TotalRecs == 0 && !$parametros->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $parametros_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$parametros_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$parametros->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$parametros_list->terminate();
?>