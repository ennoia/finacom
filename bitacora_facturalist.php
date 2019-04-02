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
$bitacora_factura_list = new bitacora_factura_list();

// Run the page
$bitacora_factura_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bitacora_factura_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$bitacora_factura->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fbitacora_facturalist = currentForm = new ew.Form("fbitacora_facturalist", "list");
fbitacora_facturalist.formKeyCountName = '<?php echo $bitacora_factura_list->FormKeyCountName ?>';

// Form_CustomValidate event
fbitacora_facturalist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fbitacora_facturalist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fbitacora_facturalistsrch = currentSearchForm = new ew.Form("fbitacora_facturalistsrch");

// Filters
fbitacora_facturalistsrch.filterList = <?php echo $bitacora_factura_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$bitacora_factura->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($bitacora_factura_list->TotalRecs > 0 && $bitacora_factura_list->ExportOptions->visible()) { ?>
<?php $bitacora_factura_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($bitacora_factura_list->ImportOptions->visible()) { ?>
<?php $bitacora_factura_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($bitacora_factura_list->SearchOptions->visible()) { ?>
<?php $bitacora_factura_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($bitacora_factura_list->FilterOptions->visible()) { ?>
<?php $bitacora_factura_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$bitacora_factura_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$bitacora_factura->isExport() && !$bitacora_factura->CurrentAction) { ?>
<form name="fbitacora_facturalistsrch" id="fbitacora_facturalistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($bitacora_factura_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fbitacora_facturalistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="bitacora_factura">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($bitacora_factura_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($bitacora_factura_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $bitacora_factura_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($bitacora_factura_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($bitacora_factura_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($bitacora_factura_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($bitacora_factura_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $bitacora_factura_list->showPageHeader(); ?>
<?php
$bitacora_factura_list->showMessage();
?>
<?php if ($bitacora_factura_list->TotalRecs > 0 || $bitacora_factura->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($bitacora_factura_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> bitacora_factura">
<?php if (!$bitacora_factura->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$bitacora_factura->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($bitacora_factura_list->Pager)) $bitacora_factura_list->Pager = new NumericPager($bitacora_factura_list->StartRec, $bitacora_factura_list->DisplayRecs, $bitacora_factura_list->TotalRecs, $bitacora_factura_list->RecRange, $bitacora_factura_list->AutoHidePager) ?>
<?php if ($bitacora_factura_list->Pager->RecordCount > 0 && $bitacora_factura_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($bitacora_factura_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $bitacora_factura_list->pageUrl() ?>start=<?php echo $bitacora_factura_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($bitacora_factura_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $bitacora_factura_list->pageUrl() ?>start=<?php echo $bitacora_factura_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($bitacora_factura_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $bitacora_factura_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($bitacora_factura_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $bitacora_factura_list->pageUrl() ?>start=<?php echo $bitacora_factura_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($bitacora_factura_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $bitacora_factura_list->pageUrl() ?>start=<?php echo $bitacora_factura_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($bitacora_factura_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $bitacora_factura_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $bitacora_factura_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $bitacora_factura_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $bitacora_factura_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fbitacora_facturalist" id="fbitacora_facturalist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($bitacora_factura_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $bitacora_factura_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bitacora_factura">
<div id="gmp_bitacora_factura" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($bitacora_factura_list->TotalRecs > 0 || $bitacora_factura->isGridEdit()) { ?>
<table id="tbl_bitacora_facturalist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$bitacora_factura_list->RowType = ROWTYPE_HEADER;

// Render list options
$bitacora_factura_list->renderListOptions();

// Render list options (header, left)
$bitacora_factura_list->ListOptions->render("header", "left");
?>
<?php if ($bitacora_factura->idfregfactura->Visible) { // idfregfactura ?>
	<?php if ($bitacora_factura->sortUrl($bitacora_factura->idfregfactura) == "") { ?>
		<th data-name="idfregfactura" class="<?php echo $bitacora_factura->idfregfactura->headerCellClass() ?>"><div id="elh_bitacora_factura_idfregfactura" class="bitacora_factura_idfregfactura"><div class="ew-table-header-caption"><?php echo $bitacora_factura->idfregfactura->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idfregfactura" class="<?php echo $bitacora_factura->idfregfactura->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $bitacora_factura->SortUrl($bitacora_factura->idfregfactura) ?>',2);"><div id="elh_bitacora_factura_idfregfactura" class="bitacora_factura_idfregfactura">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bitacora_factura->idfregfactura->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($bitacora_factura->idfregfactura->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($bitacora_factura->idfregfactura->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bitacora_factura->ofertacomision->Visible) { // ofertacomision ?>
	<?php if ($bitacora_factura->sortUrl($bitacora_factura->ofertacomision) == "") { ?>
		<th data-name="ofertacomision" class="<?php echo $bitacora_factura->ofertacomision->headerCellClass() ?>"><div id="elh_bitacora_factura_ofertacomision" class="bitacora_factura_ofertacomision"><div class="ew-table-header-caption"><?php echo $bitacora_factura->ofertacomision->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ofertacomision" class="<?php echo $bitacora_factura->ofertacomision->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $bitacora_factura->SortUrl($bitacora_factura->ofertacomision) ?>',2);"><div id="elh_bitacora_factura_ofertacomision" class="bitacora_factura_ofertacomision">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bitacora_factura->ofertacomision->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($bitacora_factura->ofertacomision->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($bitacora_factura->ofertacomision->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bitacora_factura->fecha_movimiento->Visible) { // fecha_movimiento ?>
	<?php if ($bitacora_factura->sortUrl($bitacora_factura->fecha_movimiento) == "") { ?>
		<th data-name="fecha_movimiento" class="<?php echo $bitacora_factura->fecha_movimiento->headerCellClass() ?>"><div id="elh_bitacora_factura_fecha_movimiento" class="bitacora_factura_fecha_movimiento"><div class="ew-table-header-caption"><?php echo $bitacora_factura->fecha_movimiento->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecha_movimiento" class="<?php echo $bitacora_factura->fecha_movimiento->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $bitacora_factura->SortUrl($bitacora_factura->fecha_movimiento) ?>',2);"><div id="elh_bitacora_factura_fecha_movimiento" class="bitacora_factura_fecha_movimiento">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bitacora_factura->fecha_movimiento->caption() ?></span><span class="ew-table-header-sort"><?php if ($bitacora_factura->fecha_movimiento->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($bitacora_factura->fecha_movimiento->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bitacora_factura->fondeadore->Visible) { // fondeadore ?>
	<?php if ($bitacora_factura->sortUrl($bitacora_factura->fondeadore) == "") { ?>
		<th data-name="fondeadore" class="<?php echo $bitacora_factura->fondeadore->headerCellClass() ?>"><div id="elh_bitacora_factura_fondeadore" class="bitacora_factura_fondeadore"><div class="ew-table-header-caption"><?php echo $bitacora_factura->fondeadore->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fondeadore" class="<?php echo $bitacora_factura->fondeadore->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $bitacora_factura->SortUrl($bitacora_factura->fondeadore) ?>',2);"><div id="elh_bitacora_factura_fondeadore" class="bitacora_factura_fondeadore">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bitacora_factura->fondeadore->caption() ?></span><span class="ew-table-header-sort"><?php if ($bitacora_factura->fondeadore->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($bitacora_factura->fondeadore->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bitacora_factura->movimiento->Visible) { // movimiento ?>
	<?php if ($bitacora_factura->sortUrl($bitacora_factura->movimiento) == "") { ?>
		<th data-name="movimiento" class="<?php echo $bitacora_factura->movimiento->headerCellClass() ?>"><div id="elh_bitacora_factura_movimiento" class="bitacora_factura_movimiento"><div class="ew-table-header-caption"><?php echo $bitacora_factura->movimiento->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="movimiento" class="<?php echo $bitacora_factura->movimiento->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $bitacora_factura->SortUrl($bitacora_factura->movimiento) ?>',2);"><div id="elh_bitacora_factura_movimiento" class="bitacora_factura_movimiento">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bitacora_factura->movimiento->caption() ?></span><span class="ew-table-header-sort"><?php if ($bitacora_factura->movimiento->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($bitacora_factura->movimiento->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bitacora_factura->oferta->Visible) { // oferta ?>
	<?php if ($bitacora_factura->sortUrl($bitacora_factura->oferta) == "") { ?>
		<th data-name="oferta" class="<?php echo $bitacora_factura->oferta->headerCellClass() ?>"><div id="elh_bitacora_factura_oferta" class="bitacora_factura_oferta"><div class="ew-table-header-caption"><?php echo $bitacora_factura->oferta->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="oferta" class="<?php echo $bitacora_factura->oferta->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $bitacora_factura->SortUrl($bitacora_factura->oferta) ?>',2);"><div id="elh_bitacora_factura_oferta" class="bitacora_factura_oferta">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bitacora_factura->oferta->caption() ?></span><span class="ew-table-header-sort"><?php if ($bitacora_factura->oferta->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($bitacora_factura->oferta->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bitacora_factura->factrfc_idfac->Visible) { // factrfc_idfac ?>
	<?php if ($bitacora_factura->sortUrl($bitacora_factura->factrfc_idfac) == "") { ?>
		<th data-name="factrfc_idfac" class="<?php echo $bitacora_factura->factrfc_idfac->headerCellClass() ?>"><div id="elh_bitacora_factura_factrfc_idfac" class="bitacora_factura_factrfc_idfac"><div class="ew-table-header-caption"><?php echo $bitacora_factura->factrfc_idfac->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="factrfc_idfac" class="<?php echo $bitacora_factura->factrfc_idfac->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $bitacora_factura->SortUrl($bitacora_factura->factrfc_idfac) ?>',2);"><div id="elh_bitacora_factura_factrfc_idfac" class="bitacora_factura_factrfc_idfac">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bitacora_factura->factrfc_idfac->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($bitacora_factura->factrfc_idfac->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($bitacora_factura->factrfc_idfac->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bitacora_factura->Column->Visible) { // Column ?>
	<?php if ($bitacora_factura->sortUrl($bitacora_factura->Column) == "") { ?>
		<th data-name="Column" class="<?php echo $bitacora_factura->Column->headerCellClass() ?>"><div id="elh_bitacora_factura_Column" class="bitacora_factura_Column"><div class="ew-table-header-caption"><?php echo $bitacora_factura->Column->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Column" class="<?php echo $bitacora_factura->Column->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $bitacora_factura->SortUrl($bitacora_factura->Column) ?>',2);"><div id="elh_bitacora_factura_Column" class="bitacora_factura_Column">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bitacora_factura->Column->caption() ?></span><span class="ew-table-header-sort"><?php if ($bitacora_factura->Column->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($bitacora_factura->Column->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$bitacora_factura_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($bitacora_factura->ExportAll && $bitacora_factura->isExport()) {
	$bitacora_factura_list->StopRec = $bitacora_factura_list->TotalRecs;
} else {

	// Set the last record to display
	if ($bitacora_factura_list->TotalRecs > $bitacora_factura_list->StartRec + $bitacora_factura_list->DisplayRecs - 1)
		$bitacora_factura_list->StopRec = $bitacora_factura_list->StartRec + $bitacora_factura_list->DisplayRecs - 1;
	else
		$bitacora_factura_list->StopRec = $bitacora_factura_list->TotalRecs;
}
$bitacora_factura_list->RecCnt = $bitacora_factura_list->StartRec - 1;
if ($bitacora_factura_list->Recordset && !$bitacora_factura_list->Recordset->EOF) {
	$bitacora_factura_list->Recordset->moveFirst();
	$selectLimit = $bitacora_factura_list->UseSelectLimit;
	if (!$selectLimit && $bitacora_factura_list->StartRec > 1)
		$bitacora_factura_list->Recordset->move($bitacora_factura_list->StartRec - 1);
} elseif (!$bitacora_factura->AllowAddDeleteRow && $bitacora_factura_list->StopRec == 0) {
	$bitacora_factura_list->StopRec = $bitacora_factura->GridAddRowCount;
}

// Initialize aggregate
$bitacora_factura->RowType = ROWTYPE_AGGREGATEINIT;
$bitacora_factura->resetAttributes();
$bitacora_factura_list->renderRow();
while ($bitacora_factura_list->RecCnt < $bitacora_factura_list->StopRec) {
	$bitacora_factura_list->RecCnt++;
	if ($bitacora_factura_list->RecCnt >= $bitacora_factura_list->StartRec) {
		$bitacora_factura_list->RowCnt++;

		// Set up key count
		$bitacora_factura_list->KeyCount = $bitacora_factura_list->RowIndex;

		// Init row class and style
		$bitacora_factura->resetAttributes();
		$bitacora_factura->CssClass = "";
		if ($bitacora_factura->isGridAdd()) {
		} else {
			$bitacora_factura_list->loadRowValues($bitacora_factura_list->Recordset); // Load row values
		}
		$bitacora_factura->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$bitacora_factura->RowAttrs = array_merge($bitacora_factura->RowAttrs, array('data-rowindex'=>$bitacora_factura_list->RowCnt, 'id'=>'r' . $bitacora_factura_list->RowCnt . '_bitacora_factura', 'data-rowtype'=>$bitacora_factura->RowType));

		// Render row
		$bitacora_factura_list->renderRow();

		// Render list options
		$bitacora_factura_list->renderListOptions();
?>
	<tr<?php echo $bitacora_factura->rowAttributes() ?>>
<?php

// Render list options (body, left)
$bitacora_factura_list->ListOptions->render("body", "left", $bitacora_factura_list->RowCnt);
?>
	<?php if ($bitacora_factura->idfregfactura->Visible) { // idfregfactura ?>
		<td data-name="idfregfactura"<?php echo $bitacora_factura->idfregfactura->cellAttributes() ?>>
<span id="el<?php echo $bitacora_factura_list->RowCnt ?>_bitacora_factura_idfregfactura" class="bitacora_factura_idfregfactura">
<span<?php echo $bitacora_factura->idfregfactura->viewAttributes() ?>>
<?php echo $bitacora_factura->idfregfactura->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bitacora_factura->ofertacomision->Visible) { // ofertacomision ?>
		<td data-name="ofertacomision"<?php echo $bitacora_factura->ofertacomision->cellAttributes() ?>>
<span id="el<?php echo $bitacora_factura_list->RowCnt ?>_bitacora_factura_ofertacomision" class="bitacora_factura_ofertacomision">
<span<?php echo $bitacora_factura->ofertacomision->viewAttributes() ?>>
<?php echo $bitacora_factura->ofertacomision->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bitacora_factura->fecha_movimiento->Visible) { // fecha_movimiento ?>
		<td data-name="fecha_movimiento"<?php echo $bitacora_factura->fecha_movimiento->cellAttributes() ?>>
<span id="el<?php echo $bitacora_factura_list->RowCnt ?>_bitacora_factura_fecha_movimiento" class="bitacora_factura_fecha_movimiento">
<span<?php echo $bitacora_factura->fecha_movimiento->viewAttributes() ?>>
<?php echo $bitacora_factura->fecha_movimiento->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bitacora_factura->fondeadore->Visible) { // fondeadore ?>
		<td data-name="fondeadore"<?php echo $bitacora_factura->fondeadore->cellAttributes() ?>>
<span id="el<?php echo $bitacora_factura_list->RowCnt ?>_bitacora_factura_fondeadore" class="bitacora_factura_fondeadore">
<span<?php echo $bitacora_factura->fondeadore->viewAttributes() ?>>
<?php echo $bitacora_factura->fondeadore->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bitacora_factura->movimiento->Visible) { // movimiento ?>
		<td data-name="movimiento"<?php echo $bitacora_factura->movimiento->cellAttributes() ?>>
<span id="el<?php echo $bitacora_factura_list->RowCnt ?>_bitacora_factura_movimiento" class="bitacora_factura_movimiento">
<span<?php echo $bitacora_factura->movimiento->viewAttributes() ?>>
<?php echo $bitacora_factura->movimiento->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bitacora_factura->oferta->Visible) { // oferta ?>
		<td data-name="oferta"<?php echo $bitacora_factura->oferta->cellAttributes() ?>>
<span id="el<?php echo $bitacora_factura_list->RowCnt ?>_bitacora_factura_oferta" class="bitacora_factura_oferta">
<span<?php echo $bitacora_factura->oferta->viewAttributes() ?>>
<?php echo $bitacora_factura->oferta->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bitacora_factura->factrfc_idfac->Visible) { // factrfc_idfac ?>
		<td data-name="factrfc_idfac"<?php echo $bitacora_factura->factrfc_idfac->cellAttributes() ?>>
<span id="el<?php echo $bitacora_factura_list->RowCnt ?>_bitacora_factura_factrfc_idfac" class="bitacora_factura_factrfc_idfac">
<span<?php echo $bitacora_factura->factrfc_idfac->viewAttributes() ?>>
<?php echo $bitacora_factura->factrfc_idfac->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bitacora_factura->Column->Visible) { // Column ?>
		<td data-name="Column"<?php echo $bitacora_factura->Column->cellAttributes() ?>>
<span id="el<?php echo $bitacora_factura_list->RowCnt ?>_bitacora_factura_Column" class="bitacora_factura_Column">
<span<?php echo $bitacora_factura->Column->viewAttributes() ?>>
<?php echo $bitacora_factura->Column->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$bitacora_factura_list->ListOptions->render("body", "right", $bitacora_factura_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$bitacora_factura->isGridAdd())
		$bitacora_factura_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$bitacora_factura->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($bitacora_factura_list->Recordset)
	$bitacora_factura_list->Recordset->Close();
?>
<?php if (!$bitacora_factura->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$bitacora_factura->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($bitacora_factura_list->Pager)) $bitacora_factura_list->Pager = new NumericPager($bitacora_factura_list->StartRec, $bitacora_factura_list->DisplayRecs, $bitacora_factura_list->TotalRecs, $bitacora_factura_list->RecRange, $bitacora_factura_list->AutoHidePager) ?>
<?php if ($bitacora_factura_list->Pager->RecordCount > 0 && $bitacora_factura_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($bitacora_factura_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $bitacora_factura_list->pageUrl() ?>start=<?php echo $bitacora_factura_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($bitacora_factura_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $bitacora_factura_list->pageUrl() ?>start=<?php echo $bitacora_factura_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($bitacora_factura_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $bitacora_factura_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($bitacora_factura_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $bitacora_factura_list->pageUrl() ?>start=<?php echo $bitacora_factura_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($bitacora_factura_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $bitacora_factura_list->pageUrl() ?>start=<?php echo $bitacora_factura_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($bitacora_factura_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $bitacora_factura_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $bitacora_factura_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $bitacora_factura_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $bitacora_factura_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($bitacora_factura_list->TotalRecs == 0 && !$bitacora_factura->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $bitacora_factura_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$bitacora_factura_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$bitacora_factura->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$bitacora_factura_list->terminate();
?>