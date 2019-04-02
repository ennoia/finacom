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
$fondeadorfactura_list = new fondeadorfactura_list();

// Run the page
$fondeadorfactura_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$fondeadorfactura_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$fondeadorfactura->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ffondeadorfacturalist = currentForm = new ew.Form("ffondeadorfacturalist", "list");
ffondeadorfacturalist.formKeyCountName = '<?php echo $fondeadorfactura_list->FormKeyCountName ?>';

// Form_CustomValidate event
ffondeadorfacturalist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ffondeadorfacturalist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var ffondeadorfacturalistsrch = currentSearchForm = new ew.Form("ffondeadorfacturalistsrch");

// Filters
ffondeadorfacturalistsrch.filterList = <?php echo $fondeadorfactura_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$fondeadorfactura->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($fondeadorfactura_list->TotalRecs > 0 && $fondeadorfactura_list->ExportOptions->visible()) { ?>
<?php $fondeadorfactura_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($fondeadorfactura_list->ImportOptions->visible()) { ?>
<?php $fondeadorfactura_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($fondeadorfactura_list->SearchOptions->visible()) { ?>
<?php $fondeadorfactura_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($fondeadorfactura_list->FilterOptions->visible()) { ?>
<?php $fondeadorfactura_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$fondeadorfactura_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$fondeadorfactura->isExport() && !$fondeadorfactura->CurrentAction) { ?>
<form name="ffondeadorfacturalistsrch" id="ffondeadorfacturalistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($fondeadorfactura_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ffondeadorfacturalistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="fondeadorfactura">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($fondeadorfactura_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($fondeadorfactura_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $fondeadorfactura_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($fondeadorfactura_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($fondeadorfactura_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($fondeadorfactura_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($fondeadorfactura_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $fondeadorfactura_list->showPageHeader(); ?>
<?php
$fondeadorfactura_list->showMessage();
?>
<?php if ($fondeadorfactura_list->TotalRecs > 0 || $fondeadorfactura->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($fondeadorfactura_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> fondeadorfactura">
<?php if (!$fondeadorfactura->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$fondeadorfactura->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($fondeadorfactura_list->Pager)) $fondeadorfactura_list->Pager = new NumericPager($fondeadorfactura_list->StartRec, $fondeadorfactura_list->DisplayRecs, $fondeadorfactura_list->TotalRecs, $fondeadorfactura_list->RecRange, $fondeadorfactura_list->AutoHidePager) ?>
<?php if ($fondeadorfactura_list->Pager->RecordCount > 0 && $fondeadorfactura_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($fondeadorfactura_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $fondeadorfactura_list->pageUrl() ?>start=<?php echo $fondeadorfactura_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($fondeadorfactura_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $fondeadorfactura_list->pageUrl() ?>start=<?php echo $fondeadorfactura_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($fondeadorfactura_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $fondeadorfactura_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($fondeadorfactura_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $fondeadorfactura_list->pageUrl() ?>start=<?php echo $fondeadorfactura_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($fondeadorfactura_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $fondeadorfactura_list->pageUrl() ?>start=<?php echo $fondeadorfactura_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($fondeadorfactura_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $fondeadorfactura_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $fondeadorfactura_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $fondeadorfactura_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $fondeadorfactura_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ffondeadorfacturalist" id="ffondeadorfacturalist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($fondeadorfactura_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $fondeadorfactura_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="fondeadorfactura">
<div id="gmp_fondeadorfactura" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($fondeadorfactura_list->TotalRecs > 0 || $fondeadorfactura->isGridEdit()) { ?>
<table id="tbl_fondeadorfacturalist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$fondeadorfactura_list->RowType = ROWTYPE_HEADER;

// Render list options
$fondeadorfactura_list->renderListOptions();

// Render list options (header, left)
$fondeadorfactura_list->ListOptions->render("header", "left");
?>
<?php if ($fondeadorfactura->idfondeadorfact->Visible) { // idfondeadorfact ?>
	<?php if ($fondeadorfactura->sortUrl($fondeadorfactura->idfondeadorfact) == "") { ?>
		<th data-name="idfondeadorfact" class="<?php echo $fondeadorfactura->idfondeadorfact->headerCellClass() ?>"><div id="elh_fondeadorfactura_idfondeadorfact" class="fondeadorfactura_idfondeadorfact"><div class="ew-table-header-caption"><?php echo $fondeadorfactura->idfondeadorfact->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idfondeadorfact" class="<?php echo $fondeadorfactura->idfondeadorfact->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $fondeadorfactura->SortUrl($fondeadorfactura->idfondeadorfact) ?>',2);"><div id="elh_fondeadorfactura_idfondeadorfact" class="fondeadorfactura_idfondeadorfact">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fondeadorfactura->idfondeadorfact->caption() ?></span><span class="ew-table-header-sort"><?php if ($fondeadorfactura->idfondeadorfact->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($fondeadorfactura->idfondeadorfact->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($fondeadorfactura->rfcfondeador->Visible) { // rfcfondeador ?>
	<?php if ($fondeadorfactura->sortUrl($fondeadorfactura->rfcfondeador) == "") { ?>
		<th data-name="rfcfondeador" class="<?php echo $fondeadorfactura->rfcfondeador->headerCellClass() ?>"><div id="elh_fondeadorfactura_rfcfondeador" class="fondeadorfactura_rfcfondeador"><div class="ew-table-header-caption"><?php echo $fondeadorfactura->rfcfondeador->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rfcfondeador" class="<?php echo $fondeadorfactura->rfcfondeador->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $fondeadorfactura->SortUrl($fondeadorfactura->rfcfondeador) ?>',2);"><div id="elh_fondeadorfactura_rfcfondeador" class="fondeadorfactura_rfcfondeador">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fondeadorfactura->rfcfondeador->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($fondeadorfactura->rfcfondeador->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($fondeadorfactura->rfcfondeador->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($fondeadorfactura->rfcfactura->Visible) { // rfcfactura ?>
	<?php if ($fondeadorfactura->sortUrl($fondeadorfactura->rfcfactura) == "") { ?>
		<th data-name="rfcfactura" class="<?php echo $fondeadorfactura->rfcfactura->headerCellClass() ?>"><div id="elh_fondeadorfactura_rfcfactura" class="fondeadorfactura_rfcfactura"><div class="ew-table-header-caption"><?php echo $fondeadorfactura->rfcfactura->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rfcfactura" class="<?php echo $fondeadorfactura->rfcfactura->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $fondeadorfactura->SortUrl($fondeadorfactura->rfcfactura) ?>',2);"><div id="elh_fondeadorfactura_rfcfactura" class="fondeadorfactura_rfcfactura">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fondeadorfactura->rfcfactura->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($fondeadorfactura->rfcfactura->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($fondeadorfactura->rfcfactura->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($fondeadorfactura->porcentajedescuento->Visible) { // porcentajedescuento ?>
	<?php if ($fondeadorfactura->sortUrl($fondeadorfactura->porcentajedescuento) == "") { ?>
		<th data-name="porcentajedescuento" class="<?php echo $fondeadorfactura->porcentajedescuento->headerCellClass() ?>"><div id="elh_fondeadorfactura_porcentajedescuento" class="fondeadorfactura_porcentajedescuento"><div class="ew-table-header-caption"><?php echo $fondeadorfactura->porcentajedescuento->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="porcentajedescuento" class="<?php echo $fondeadorfactura->porcentajedescuento->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $fondeadorfactura->SortUrl($fondeadorfactura->porcentajedescuento) ?>',2);"><div id="elh_fondeadorfactura_porcentajedescuento" class="fondeadorfactura_porcentajedescuento">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fondeadorfactura->porcentajedescuento->caption() ?></span><span class="ew-table-header-sort"><?php if ($fondeadorfactura->porcentajedescuento->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($fondeadorfactura->porcentajedescuento->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($fondeadorfactura->fecha_movimiento->Visible) { // fecha_movimiento ?>
	<?php if ($fondeadorfactura->sortUrl($fondeadorfactura->fecha_movimiento) == "") { ?>
		<th data-name="fecha_movimiento" class="<?php echo $fondeadorfactura->fecha_movimiento->headerCellClass() ?>"><div id="elh_fondeadorfactura_fecha_movimiento" class="fondeadorfactura_fecha_movimiento"><div class="ew-table-header-caption"><?php echo $fondeadorfactura->fecha_movimiento->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecha_movimiento" class="<?php echo $fondeadorfactura->fecha_movimiento->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $fondeadorfactura->SortUrl($fondeadorfactura->fecha_movimiento) ?>',2);"><div id="elh_fondeadorfactura_fecha_movimiento" class="fondeadorfactura_fecha_movimiento">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fondeadorfactura->fecha_movimiento->caption() ?></span><span class="ew-table-header-sort"><?php if ($fondeadorfactura->fecha_movimiento->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($fondeadorfactura->fecha_movimiento->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($fondeadorfactura->fondeadorrfc->Visible) { // fondeadorrfc ?>
	<?php if ($fondeadorfactura->sortUrl($fondeadorfactura->fondeadorrfc) == "") { ?>
		<th data-name="fondeadorrfc" class="<?php echo $fondeadorfactura->fondeadorrfc->headerCellClass() ?>"><div id="elh_fondeadorfactura_fondeadorrfc" class="fondeadorfactura_fondeadorrfc"><div class="ew-table-header-caption"><?php echo $fondeadorfactura->fondeadorrfc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fondeadorrfc" class="<?php echo $fondeadorfactura->fondeadorrfc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $fondeadorfactura->SortUrl($fondeadorfactura->fondeadorrfc) ?>',2);"><div id="elh_fondeadorfactura_fondeadorrfc" class="fondeadorfactura_fondeadorrfc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fondeadorfactura->fondeadorrfc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($fondeadorfactura->fondeadorrfc->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($fondeadorfactura->fondeadorrfc->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$fondeadorfactura_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($fondeadorfactura->ExportAll && $fondeadorfactura->isExport()) {
	$fondeadorfactura_list->StopRec = $fondeadorfactura_list->TotalRecs;
} else {

	// Set the last record to display
	if ($fondeadorfactura_list->TotalRecs > $fondeadorfactura_list->StartRec + $fondeadorfactura_list->DisplayRecs - 1)
		$fondeadorfactura_list->StopRec = $fondeadorfactura_list->StartRec + $fondeadorfactura_list->DisplayRecs - 1;
	else
		$fondeadorfactura_list->StopRec = $fondeadorfactura_list->TotalRecs;
}
$fondeadorfactura_list->RecCnt = $fondeadorfactura_list->StartRec - 1;
if ($fondeadorfactura_list->Recordset && !$fondeadorfactura_list->Recordset->EOF) {
	$fondeadorfactura_list->Recordset->moveFirst();
	$selectLimit = $fondeadorfactura_list->UseSelectLimit;
	if (!$selectLimit && $fondeadorfactura_list->StartRec > 1)
		$fondeadorfactura_list->Recordset->move($fondeadorfactura_list->StartRec - 1);
} elseif (!$fondeadorfactura->AllowAddDeleteRow && $fondeadorfactura_list->StopRec == 0) {
	$fondeadorfactura_list->StopRec = $fondeadorfactura->GridAddRowCount;
}

// Initialize aggregate
$fondeadorfactura->RowType = ROWTYPE_AGGREGATEINIT;
$fondeadorfactura->resetAttributes();
$fondeadorfactura_list->renderRow();
while ($fondeadorfactura_list->RecCnt < $fondeadorfactura_list->StopRec) {
	$fondeadorfactura_list->RecCnt++;
	if ($fondeadorfactura_list->RecCnt >= $fondeadorfactura_list->StartRec) {
		$fondeadorfactura_list->RowCnt++;

		// Set up key count
		$fondeadorfactura_list->KeyCount = $fondeadorfactura_list->RowIndex;

		// Init row class and style
		$fondeadorfactura->resetAttributes();
		$fondeadorfactura->CssClass = "";
		if ($fondeadorfactura->isGridAdd()) {
		} else {
			$fondeadorfactura_list->loadRowValues($fondeadorfactura_list->Recordset); // Load row values
		}
		$fondeadorfactura->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$fondeadorfactura->RowAttrs = array_merge($fondeadorfactura->RowAttrs, array('data-rowindex'=>$fondeadorfactura_list->RowCnt, 'id'=>'r' . $fondeadorfactura_list->RowCnt . '_fondeadorfactura', 'data-rowtype'=>$fondeadorfactura->RowType));

		// Render row
		$fondeadorfactura_list->renderRow();

		// Render list options
		$fondeadorfactura_list->renderListOptions();
?>
	<tr<?php echo $fondeadorfactura->rowAttributes() ?>>
<?php

// Render list options (body, left)
$fondeadorfactura_list->ListOptions->render("body", "left", $fondeadorfactura_list->RowCnt);
?>
	<?php if ($fondeadorfactura->idfondeadorfact->Visible) { // idfondeadorfact ?>
		<td data-name="idfondeadorfact"<?php echo $fondeadorfactura->idfondeadorfact->cellAttributes() ?>>
<span id="el<?php echo $fondeadorfactura_list->RowCnt ?>_fondeadorfactura_idfondeadorfact" class="fondeadorfactura_idfondeadorfact">
<span<?php echo $fondeadorfactura->idfondeadorfact->viewAttributes() ?>>
<?php echo $fondeadorfactura->idfondeadorfact->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($fondeadorfactura->rfcfondeador->Visible) { // rfcfondeador ?>
		<td data-name="rfcfondeador"<?php echo $fondeadorfactura->rfcfondeador->cellAttributes() ?>>
<span id="el<?php echo $fondeadorfactura_list->RowCnt ?>_fondeadorfactura_rfcfondeador" class="fondeadorfactura_rfcfondeador">
<span<?php echo $fondeadorfactura->rfcfondeador->viewAttributes() ?>>
<?php echo $fondeadorfactura->rfcfondeador->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($fondeadorfactura->rfcfactura->Visible) { // rfcfactura ?>
		<td data-name="rfcfactura"<?php echo $fondeadorfactura->rfcfactura->cellAttributes() ?>>
<span id="el<?php echo $fondeadorfactura_list->RowCnt ?>_fondeadorfactura_rfcfactura" class="fondeadorfactura_rfcfactura">
<span<?php echo $fondeadorfactura->rfcfactura->viewAttributes() ?>>
<?php echo $fondeadorfactura->rfcfactura->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($fondeadorfactura->porcentajedescuento->Visible) { // porcentajedescuento ?>
		<td data-name="porcentajedescuento"<?php echo $fondeadorfactura->porcentajedescuento->cellAttributes() ?>>
<span id="el<?php echo $fondeadorfactura_list->RowCnt ?>_fondeadorfactura_porcentajedescuento" class="fondeadorfactura_porcentajedescuento">
<span<?php echo $fondeadorfactura->porcentajedescuento->viewAttributes() ?>>
<?php echo $fondeadorfactura->porcentajedescuento->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($fondeadorfactura->fecha_movimiento->Visible) { // fecha_movimiento ?>
		<td data-name="fecha_movimiento"<?php echo $fondeadorfactura->fecha_movimiento->cellAttributes() ?>>
<span id="el<?php echo $fondeadorfactura_list->RowCnt ?>_fondeadorfactura_fecha_movimiento" class="fondeadorfactura_fecha_movimiento">
<span<?php echo $fondeadorfactura->fecha_movimiento->viewAttributes() ?>>
<?php echo $fondeadorfactura->fecha_movimiento->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($fondeadorfactura->fondeadorrfc->Visible) { // fondeadorrfc ?>
		<td data-name="fondeadorrfc"<?php echo $fondeadorfactura->fondeadorrfc->cellAttributes() ?>>
<span id="el<?php echo $fondeadorfactura_list->RowCnt ?>_fondeadorfactura_fondeadorrfc" class="fondeadorfactura_fondeadorrfc">
<span<?php echo $fondeadorfactura->fondeadorrfc->viewAttributes() ?>>
<?php echo $fondeadorfactura->fondeadorrfc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$fondeadorfactura_list->ListOptions->render("body", "right", $fondeadorfactura_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$fondeadorfactura->isGridAdd())
		$fondeadorfactura_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$fondeadorfactura->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($fondeadorfactura_list->Recordset)
	$fondeadorfactura_list->Recordset->Close();
?>
<?php if (!$fondeadorfactura->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$fondeadorfactura->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($fondeadorfactura_list->Pager)) $fondeadorfactura_list->Pager = new NumericPager($fondeadorfactura_list->StartRec, $fondeadorfactura_list->DisplayRecs, $fondeadorfactura_list->TotalRecs, $fondeadorfactura_list->RecRange, $fondeadorfactura_list->AutoHidePager) ?>
<?php if ($fondeadorfactura_list->Pager->RecordCount > 0 && $fondeadorfactura_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($fondeadorfactura_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $fondeadorfactura_list->pageUrl() ?>start=<?php echo $fondeadorfactura_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($fondeadorfactura_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $fondeadorfactura_list->pageUrl() ?>start=<?php echo $fondeadorfactura_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($fondeadorfactura_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $fondeadorfactura_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($fondeadorfactura_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $fondeadorfactura_list->pageUrl() ?>start=<?php echo $fondeadorfactura_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($fondeadorfactura_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $fondeadorfactura_list->pageUrl() ?>start=<?php echo $fondeadorfactura_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($fondeadorfactura_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $fondeadorfactura_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $fondeadorfactura_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $fondeadorfactura_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $fondeadorfactura_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($fondeadorfactura_list->TotalRecs == 0 && !$fondeadorfactura->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $fondeadorfactura_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$fondeadorfactura_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$fondeadorfactura->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$fondeadorfactura_list->terminate();
?>