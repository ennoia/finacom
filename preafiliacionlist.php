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
$preafiliacion_list = new preafiliacion_list();

// Run the page
$preafiliacion_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$preafiliacion_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$preafiliacion->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fpreafiliacionlist = currentForm = new ew.Form("fpreafiliacionlist", "list");
fpreafiliacionlist.formKeyCountName = '<?php echo $preafiliacion_list->FormKeyCountName ?>';

// Form_CustomValidate event
fpreafiliacionlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fpreafiliacionlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fpreafiliacionlist.lists["x_estadopreaafilia"] = <?php echo $preafiliacion_list->estadopreaafilia->Lookup->toClientList() ?>;
fpreafiliacionlist.lists["x_estadopreaafilia"].options = <?php echo JsonEncode($preafiliacion_list->estadopreaafilia->lookupOptions()) ?>;
fpreafiliacionlist.autoSuggests["x_estadopreaafilia"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
var fpreafiliacionlistsrch = currentSearchForm = new ew.Form("fpreafiliacionlistsrch");

// Filters
fpreafiliacionlistsrch.filterList = <?php echo $preafiliacion_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$preafiliacion->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($preafiliacion_list->TotalRecs > 0 && $preafiliacion_list->ExportOptions->visible()) { ?>
<?php $preafiliacion_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($preafiliacion_list->ImportOptions->visible()) { ?>
<?php $preafiliacion_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($preafiliacion_list->SearchOptions->visible()) { ?>
<?php $preafiliacion_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($preafiliacion_list->FilterOptions->visible()) { ?>
<?php $preafiliacion_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$preafiliacion_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$preafiliacion->isExport() && !$preafiliacion->CurrentAction) { ?>
<form name="fpreafiliacionlistsrch" id="fpreafiliacionlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($preafiliacion_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fpreafiliacionlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="preafiliacion">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($preafiliacion_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($preafiliacion_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $preafiliacion_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($preafiliacion_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($preafiliacion_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($preafiliacion_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($preafiliacion_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $preafiliacion_list->showPageHeader(); ?>
<?php
$preafiliacion_list->showMessage();
?>
<?php if ($preafiliacion_list->TotalRecs > 0 || $preafiliacion->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($preafiliacion_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> preafiliacion">
<?php if (!$preafiliacion->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$preafiliacion->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($preafiliacion_list->Pager)) $preafiliacion_list->Pager = new NumericPager($preafiliacion_list->StartRec, $preafiliacion_list->DisplayRecs, $preafiliacion_list->TotalRecs, $preafiliacion_list->RecRange, $preafiliacion_list->AutoHidePager) ?>
<?php if ($preafiliacion_list->Pager->RecordCount > 0 && $preafiliacion_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($preafiliacion_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $preafiliacion_list->pageUrl() ?>start=<?php echo $preafiliacion_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($preafiliacion_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $preafiliacion_list->pageUrl() ?>start=<?php echo $preafiliacion_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($preafiliacion_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $preafiliacion_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($preafiliacion_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $preafiliacion_list->pageUrl() ?>start=<?php echo $preafiliacion_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($preafiliacion_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $preafiliacion_list->pageUrl() ?>start=<?php echo $preafiliacion_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($preafiliacion_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $preafiliacion_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $preafiliacion_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $preafiliacion_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $preafiliacion_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpreafiliacionlist" id="fpreafiliacionlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($preafiliacion_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $preafiliacion_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="preafiliacion">
<div id="gmp_preafiliacion" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($preafiliacion_list->TotalRecs > 0 || $preafiliacion->isGridEdit()) { ?>
<table id="tbl_preafiliacionlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$preafiliacion_list->RowType = ROWTYPE_HEADER;

// Render list options
$preafiliacion_list->renderListOptions();

// Render list options (header, left)
$preafiliacion_list->ListOptions->render("header", "left");
?>
<?php if ($preafiliacion->idafiliado->Visible) { // idafiliado ?>
	<?php if ($preafiliacion->sortUrl($preafiliacion->idafiliado) == "") { ?>
		<th data-name="idafiliado" class="<?php echo $preafiliacion->idafiliado->headerCellClass() ?>"><div id="elh_preafiliacion_idafiliado" class="preafiliacion_idafiliado"><div class="ew-table-header-caption"><?php echo $preafiliacion->idafiliado->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idafiliado" class="<?php echo $preafiliacion->idafiliado->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $preafiliacion->SortUrl($preafiliacion->idafiliado) ?>',2);"><div id="elh_preafiliacion_idafiliado" class="preafiliacion_idafiliado">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $preafiliacion->idafiliado->caption() ?></span><span class="ew-table-header-sort"><?php if ($preafiliacion->idafiliado->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($preafiliacion->idafiliado->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($preafiliacion->tipoentidad->Visible) { // tipoentidad ?>
	<?php if ($preafiliacion->sortUrl($preafiliacion->tipoentidad) == "") { ?>
		<th data-name="tipoentidad" class="<?php echo $preafiliacion->tipoentidad->headerCellClass() ?>"><div id="elh_preafiliacion_tipoentidad" class="preafiliacion_tipoentidad"><div class="ew-table-header-caption"><?php echo $preafiliacion->tipoentidad->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipoentidad" class="<?php echo $preafiliacion->tipoentidad->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $preafiliacion->SortUrl($preafiliacion->tipoentidad) ?>',2);"><div id="elh_preafiliacion_tipoentidad" class="preafiliacion_tipoentidad">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $preafiliacion->tipoentidad->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($preafiliacion->tipoentidad->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($preafiliacion->tipoentidad->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($preafiliacion->fechaafiliacion->Visible) { // fechaafiliacion ?>
	<?php if ($preafiliacion->sortUrl($preafiliacion->fechaafiliacion) == "") { ?>
		<th data-name="fechaafiliacion" class="<?php echo $preafiliacion->fechaafiliacion->headerCellClass() ?>"><div id="elh_preafiliacion_fechaafiliacion" class="preafiliacion_fechaafiliacion"><div class="ew-table-header-caption"><?php echo $preafiliacion->fechaafiliacion->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fechaafiliacion" class="<?php echo $preafiliacion->fechaafiliacion->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $preafiliacion->SortUrl($preafiliacion->fechaafiliacion) ?>',2);"><div id="elh_preafiliacion_fechaafiliacion" class="preafiliacion_fechaafiliacion">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $preafiliacion->fechaafiliacion->caption() ?></span><span class="ew-table-header-sort"><?php if ($preafiliacion->fechaafiliacion->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($preafiliacion->fechaafiliacion->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($preafiliacion->nombrerazon->Visible) { // nombrerazon ?>
	<?php if ($preafiliacion->sortUrl($preafiliacion->nombrerazon) == "") { ?>
		<th data-name="nombrerazon" class="<?php echo $preafiliacion->nombrerazon->headerCellClass() ?>"><div id="elh_preafiliacion_nombrerazon" class="preafiliacion_nombrerazon"><div class="ew-table-header-caption"><?php echo $preafiliacion->nombrerazon->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nombrerazon" class="<?php echo $preafiliacion->nombrerazon->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $preafiliacion->SortUrl($preafiliacion->nombrerazon) ?>',2);"><div id="elh_preafiliacion_nombrerazon" class="preafiliacion_nombrerazon">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $preafiliacion->nombrerazon->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($preafiliacion->nombrerazon->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($preafiliacion->nombrerazon->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($preafiliacion->telefono->Visible) { // telefono ?>
	<?php if ($preafiliacion->sortUrl($preafiliacion->telefono) == "") { ?>
		<th data-name="telefono" class="<?php echo $preafiliacion->telefono->headerCellClass() ?>"><div id="elh_preafiliacion_telefono" class="preafiliacion_telefono"><div class="ew-table-header-caption"><?php echo $preafiliacion->telefono->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="telefono" class="<?php echo $preafiliacion->telefono->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $preafiliacion->SortUrl($preafiliacion->telefono) ?>',2);"><div id="elh_preafiliacion_telefono" class="preafiliacion_telefono">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $preafiliacion->telefono->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($preafiliacion->telefono->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($preafiliacion->telefono->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($preafiliacion->rfcentidad->Visible) { // rfcentidad ?>
	<?php if ($preafiliacion->sortUrl($preafiliacion->rfcentidad) == "") { ?>
		<th data-name="rfcentidad" class="<?php echo $preafiliacion->rfcentidad->headerCellClass() ?>"><div id="elh_preafiliacion_rfcentidad" class="preafiliacion_rfcentidad"><div class="ew-table-header-caption"><?php echo $preafiliacion->rfcentidad->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rfcentidad" class="<?php echo $preafiliacion->rfcentidad->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $preafiliacion->SortUrl($preafiliacion->rfcentidad) ?>',2);"><div id="elh_preafiliacion_rfcentidad" class="preafiliacion_rfcentidad">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $preafiliacion->rfcentidad->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($preafiliacion->rfcentidad->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($preafiliacion->rfcentidad->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($preafiliacion->estadopreaafilia->Visible) { // estadopreaafilia ?>
	<?php if ($preafiliacion->sortUrl($preafiliacion->estadopreaafilia) == "") { ?>
		<th data-name="estadopreaafilia" class="<?php echo $preafiliacion->estadopreaafilia->headerCellClass() ?>"><div id="elh_preafiliacion_estadopreaafilia" class="preafiliacion_estadopreaafilia"><div class="ew-table-header-caption"><?php echo $preafiliacion->estadopreaafilia->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estadopreaafilia" class="<?php echo $preafiliacion->estadopreaafilia->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $preafiliacion->SortUrl($preafiliacion->estadopreaafilia) ?>',2);"><div id="elh_preafiliacion_estadopreaafilia" class="preafiliacion_estadopreaafilia">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $preafiliacion->estadopreaafilia->caption() ?></span><span class="ew-table-header-sort"><?php if ($preafiliacion->estadopreaafilia->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($preafiliacion->estadopreaafilia->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$preafiliacion_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($preafiliacion->ExportAll && $preafiliacion->isExport()) {
	$preafiliacion_list->StopRec = $preafiliacion_list->TotalRecs;
} else {

	// Set the last record to display
	if ($preafiliacion_list->TotalRecs > $preafiliacion_list->StartRec + $preafiliacion_list->DisplayRecs - 1)
		$preafiliacion_list->StopRec = $preafiliacion_list->StartRec + $preafiliacion_list->DisplayRecs - 1;
	else
		$preafiliacion_list->StopRec = $preafiliacion_list->TotalRecs;
}
$preafiliacion_list->RecCnt = $preafiliacion_list->StartRec - 1;
if ($preafiliacion_list->Recordset && !$preafiliacion_list->Recordset->EOF) {
	$preafiliacion_list->Recordset->moveFirst();
	$selectLimit = $preafiliacion_list->UseSelectLimit;
	if (!$selectLimit && $preafiliacion_list->StartRec > 1)
		$preafiliacion_list->Recordset->move($preafiliacion_list->StartRec - 1);
} elseif (!$preafiliacion->AllowAddDeleteRow && $preafiliacion_list->StopRec == 0) {
	$preafiliacion_list->StopRec = $preafiliacion->GridAddRowCount;
}

// Initialize aggregate
$preafiliacion->RowType = ROWTYPE_AGGREGATEINIT;
$preafiliacion->resetAttributes();
$preafiliacion_list->renderRow();
while ($preafiliacion_list->RecCnt < $preafiliacion_list->StopRec) {
	$preafiliacion_list->RecCnt++;
	if ($preafiliacion_list->RecCnt >= $preafiliacion_list->StartRec) {
		$preafiliacion_list->RowCnt++;

		// Set up key count
		$preafiliacion_list->KeyCount = $preafiliacion_list->RowIndex;

		// Init row class and style
		$preafiliacion->resetAttributes();
		$preafiliacion->CssClass = "";
		if ($preafiliacion->isGridAdd()) {
		} else {
			$preafiliacion_list->loadRowValues($preafiliacion_list->Recordset); // Load row values
		}
		$preafiliacion->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$preafiliacion->RowAttrs = array_merge($preafiliacion->RowAttrs, array('data-rowindex'=>$preafiliacion_list->RowCnt, 'id'=>'r' . $preafiliacion_list->RowCnt . '_preafiliacion', 'data-rowtype'=>$preafiliacion->RowType));

		// Render row
		$preafiliacion_list->renderRow();

		// Render list options
		$preafiliacion_list->renderListOptions();
?>
	<tr<?php echo $preafiliacion->rowAttributes() ?>>
<?php

// Render list options (body, left)
$preafiliacion_list->ListOptions->render("body", "left", $preafiliacion_list->RowCnt);
?>
	<?php if ($preafiliacion->idafiliado->Visible) { // idafiliado ?>
		<td data-name="idafiliado"<?php echo $preafiliacion->idafiliado->cellAttributes() ?>>
<span id="el<?php echo $preafiliacion_list->RowCnt ?>_preafiliacion_idafiliado" class="preafiliacion_idafiliado">
<span<?php echo $preafiliacion->idafiliado->viewAttributes() ?>>
<?php echo $preafiliacion->idafiliado->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($preafiliacion->tipoentidad->Visible) { // tipoentidad ?>
		<td data-name="tipoentidad"<?php echo $preafiliacion->tipoentidad->cellAttributes() ?>>
<span id="el<?php echo $preafiliacion_list->RowCnt ?>_preafiliacion_tipoentidad" class="preafiliacion_tipoentidad">
<span<?php echo $preafiliacion->tipoentidad->viewAttributes() ?>>
<?php echo $preafiliacion->tipoentidad->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($preafiliacion->fechaafiliacion->Visible) { // fechaafiliacion ?>
		<td data-name="fechaafiliacion"<?php echo $preafiliacion->fechaafiliacion->cellAttributes() ?>>
<span id="el<?php echo $preafiliacion_list->RowCnt ?>_preafiliacion_fechaafiliacion" class="preafiliacion_fechaafiliacion">
<span<?php echo $preafiliacion->fechaafiliacion->viewAttributes() ?>>
<?php echo $preafiliacion->fechaafiliacion->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($preafiliacion->nombrerazon->Visible) { // nombrerazon ?>
		<td data-name="nombrerazon"<?php echo $preafiliacion->nombrerazon->cellAttributes() ?>>
<span id="el<?php echo $preafiliacion_list->RowCnt ?>_preafiliacion_nombrerazon" class="preafiliacion_nombrerazon">
<span<?php echo $preafiliacion->nombrerazon->viewAttributes() ?>>
<?php echo $preafiliacion->nombrerazon->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($preafiliacion->telefono->Visible) { // telefono ?>
		<td data-name="telefono"<?php echo $preafiliacion->telefono->cellAttributes() ?>>
<span id="el<?php echo $preafiliacion_list->RowCnt ?>_preafiliacion_telefono" class="preafiliacion_telefono">
<span<?php echo $preafiliacion->telefono->viewAttributes() ?>>
<?php echo $preafiliacion->telefono->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($preafiliacion->rfcentidad->Visible) { // rfcentidad ?>
		<td data-name="rfcentidad"<?php echo $preafiliacion->rfcentidad->cellAttributes() ?>>
<span id="el<?php echo $preafiliacion_list->RowCnt ?>_preafiliacion_rfcentidad" class="preafiliacion_rfcentidad">
<span<?php echo $preafiliacion->rfcentidad->viewAttributes() ?>>
<?php echo $preafiliacion->rfcentidad->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($preafiliacion->estadopreaafilia->Visible) { // estadopreaafilia ?>
		<td data-name="estadopreaafilia"<?php echo $preafiliacion->estadopreaafilia->cellAttributes() ?>>
<span id="el<?php echo $preafiliacion_list->RowCnt ?>_preafiliacion_estadopreaafilia" class="preafiliacion_estadopreaafilia">
<span<?php echo $preafiliacion->estadopreaafilia->viewAttributes() ?>>
<?php echo $preafiliacion->estadopreaafilia->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$preafiliacion_list->ListOptions->render("body", "right", $preafiliacion_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$preafiliacion->isGridAdd())
		$preafiliacion_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$preafiliacion->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($preafiliacion_list->Recordset)
	$preafiliacion_list->Recordset->Close();
?>
<?php if (!$preafiliacion->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$preafiliacion->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($preafiliacion_list->Pager)) $preafiliacion_list->Pager = new NumericPager($preafiliacion_list->StartRec, $preafiliacion_list->DisplayRecs, $preafiliacion_list->TotalRecs, $preafiliacion_list->RecRange, $preafiliacion_list->AutoHidePager) ?>
<?php if ($preafiliacion_list->Pager->RecordCount > 0 && $preafiliacion_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($preafiliacion_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $preafiliacion_list->pageUrl() ?>start=<?php echo $preafiliacion_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($preafiliacion_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $preafiliacion_list->pageUrl() ?>start=<?php echo $preafiliacion_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($preafiliacion_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $preafiliacion_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($preafiliacion_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $preafiliacion_list->pageUrl() ?>start=<?php echo $preafiliacion_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($preafiliacion_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $preafiliacion_list->pageUrl() ?>start=<?php echo $preafiliacion_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($preafiliacion_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $preafiliacion_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $preafiliacion_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $preafiliacion_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $preafiliacion_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($preafiliacion_list->TotalRecs == 0 && !$preafiliacion->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $preafiliacion_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$preafiliacion_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$preafiliacion->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$preafiliacion_list->terminate();
?>