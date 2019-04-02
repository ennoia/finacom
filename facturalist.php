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
$factura_list = new factura_list();

// Run the page
$factura_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$factura_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$factura->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ffacturalist = currentForm = new ew.Form("ffacturalist", "list");
ffacturalist.formKeyCountName = '<?php echo $factura_list->FormKeyCountName ?>';

// Form_CustomValidate event
ffacturalist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ffacturalist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var ffacturalistsrch = currentSearchForm = new ew.Form("ffacturalistsrch");

// Filters
ffacturalistsrch.filterList = <?php echo $factura_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$factura->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($factura_list->TotalRecs > 0 && $factura_list->ExportOptions->visible()) { ?>
<?php $factura_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($factura_list->ImportOptions->visible()) { ?>
<?php $factura_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($factura_list->SearchOptions->visible()) { ?>
<?php $factura_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($factura_list->FilterOptions->visible()) { ?>
<?php $factura_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$factura_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$factura->isExport() && !$factura->CurrentAction) { ?>
<form name="ffacturalistsrch" id="ffacturalistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($factura_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ffacturalistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="factura">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($factura_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($factura_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $factura_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($factura_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($factura_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($factura_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($factura_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $factura_list->showPageHeader(); ?>
<?php
$factura_list->showMessage();
?>
<?php if ($factura_list->TotalRecs > 0 || $factura->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($factura_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> factura">
<?php if (!$factura->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$factura->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($factura_list->Pager)) $factura_list->Pager = new NumericPager($factura_list->StartRec, $factura_list->DisplayRecs, $factura_list->TotalRecs, $factura_list->RecRange, $factura_list->AutoHidePager) ?>
<?php if ($factura_list->Pager->RecordCount > 0 && $factura_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($factura_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $factura_list->pageUrl() ?>start=<?php echo $factura_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($factura_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $factura_list->pageUrl() ?>start=<?php echo $factura_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($factura_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $factura_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($factura_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $factura_list->pageUrl() ?>start=<?php echo $factura_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($factura_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $factura_list->pageUrl() ?>start=<?php echo $factura_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($factura_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $factura_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $factura_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $factura_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $factura_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ffacturalist" id="ffacturalist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($factura_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $factura_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="factura">
<div id="gmp_factura" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($factura_list->TotalRecs > 0 || $factura->isGridEdit()) { ?>
<table id="tbl_facturalist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$factura_list->RowType = ROWTYPE_HEADER;

// Render list options
$factura_list->renderListOptions();

// Render list options (header, left)
$factura_list->ListOptions->render("header", "left");
?>
<?php if ($factura->rfcfactura->Visible) { // rfcfactura ?>
	<?php if ($factura->sortUrl($factura->rfcfactura) == "") { ?>
		<th data-name="rfcfactura" class="<?php echo $factura->rfcfactura->headerCellClass() ?>"><div id="elh_factura_rfcfactura" class="factura_rfcfactura"><div class="ew-table-header-caption"><?php echo $factura->rfcfactura->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rfcfactura" class="<?php echo $factura->rfcfactura->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $factura->SortUrl($factura->rfcfactura) ?>',2);"><div id="elh_factura_rfcfactura" class="factura_rfcfactura">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $factura->rfcfactura->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($factura->rfcfactura->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($factura->rfcfactura->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($factura->idfactura->Visible) { // idfactura ?>
	<?php if ($factura->sortUrl($factura->idfactura) == "") { ?>
		<th data-name="idfactura" class="<?php echo $factura->idfactura->headerCellClass() ?>"><div id="elh_factura_idfactura" class="factura_idfactura"><div class="ew-table-header-caption"><?php echo $factura->idfactura->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idfactura" class="<?php echo $factura->idfactura->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $factura->SortUrl($factura->idfactura) ?>',2);"><div id="elh_factura_idfactura" class="factura_idfactura">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $factura->idfactura->caption() ?></span><span class="ew-table-header-sort"><?php if ($factura->idfactura->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($factura->idfactura->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($factura->monto->Visible) { // monto ?>
	<?php if ($factura->sortUrl($factura->monto) == "") { ?>
		<th data-name="monto" class="<?php echo $factura->monto->headerCellClass() ?>"><div id="elh_factura_monto" class="factura_monto"><div class="ew-table-header-caption"><?php echo $factura->monto->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="monto" class="<?php echo $factura->monto->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $factura->SortUrl($factura->monto) ?>',2);"><div id="elh_factura_monto" class="factura_monto">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $factura->monto->caption() ?></span><span class="ew-table-header-sort"><?php if ($factura->monto->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($factura->monto->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($factura->estado_operacion->Visible) { // estado_operacion ?>
	<?php if ($factura->sortUrl($factura->estado_operacion) == "") { ?>
		<th data-name="estado_operacion" class="<?php echo $factura->estado_operacion->headerCellClass() ?>"><div id="elh_factura_estado_operacion" class="factura_estado_operacion"><div class="ew-table-header-caption"><?php echo $factura->estado_operacion->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estado_operacion" class="<?php echo $factura->estado_operacion->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $factura->SortUrl($factura->estado_operacion) ?>',2);"><div id="elh_factura_estado_operacion" class="factura_estado_operacion">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $factura->estado_operacion->caption() ?></span><span class="ew-table-header-sort"><?php if ($factura->estado_operacion->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($factura->estado_operacion->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($factura->pymerfc->Visible) { // pymerfc ?>
	<?php if ($factura->sortUrl($factura->pymerfc) == "") { ?>
		<th data-name="pymerfc" class="<?php echo $factura->pymerfc->headerCellClass() ?>"><div id="elh_factura_pymerfc" class="factura_pymerfc"><div class="ew-table-header-caption"><?php echo $factura->pymerfc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pymerfc" class="<?php echo $factura->pymerfc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $factura->SortUrl($factura->pymerfc) ?>',2);"><div id="elh_factura_pymerfc" class="factura_pymerfc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $factura->pymerfc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($factura->pymerfc->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($factura->pymerfc->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($factura->compradorfc->Visible) { // compradorfc ?>
	<?php if ($factura->sortUrl($factura->compradorfc) == "") { ?>
		<th data-name="compradorfc" class="<?php echo $factura->compradorfc->headerCellClass() ?>"><div id="elh_factura_compradorfc" class="factura_compradorfc"><div class="ew-table-header-caption"><?php echo $factura->compradorfc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="compradorfc" class="<?php echo $factura->compradorfc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $factura->SortUrl($factura->compradorfc) ?>',2);"><div id="elh_factura_compradorfc" class="factura_compradorfc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $factura->compradorfc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($factura->compradorfc->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($factura->compradorfc->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($factura->cadena->Visible) { // cadena ?>
	<?php if ($factura->sortUrl($factura->cadena) == "") { ?>
		<th data-name="cadena" class="<?php echo $factura->cadena->headerCellClass() ?>"><div id="elh_factura_cadena" class="factura_cadena"><div class="ew-table-header-caption"><?php echo $factura->cadena->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cadena" class="<?php echo $factura->cadena->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $factura->SortUrl($factura->cadena) ?>',2);"><div id="elh_factura_cadena" class="factura_cadena">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $factura->cadena->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($factura->cadena->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($factura->cadena->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($factura->vencimiento->Visible) { // vencimiento ?>
	<?php if ($factura->sortUrl($factura->vencimiento) == "") { ?>
		<th data-name="vencimiento" class="<?php echo $factura->vencimiento->headerCellClass() ?>"><div id="elh_factura_vencimiento" class="factura_vencimiento"><div class="ew-table-header-caption"><?php echo $factura->vencimiento->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="vencimiento" class="<?php echo $factura->vencimiento->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $factura->SortUrl($factura->vencimiento) ?>',2);"><div id="elh_factura_vencimiento" class="factura_vencimiento">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $factura->vencimiento->caption() ?></span><span class="ew-table-header-sort"><?php if ($factura->vencimiento->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($factura->vencimiento->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($factura->fondeadorfactura->Visible) { // fondeadorfactura ?>
	<?php if ($factura->sortUrl($factura->fondeadorfactura) == "") { ?>
		<th data-name="fondeadorfactura" class="<?php echo $factura->fondeadorfactura->headerCellClass() ?>"><div id="elh_factura_fondeadorfactura" class="factura_fondeadorfactura"><div class="ew-table-header-caption"><?php echo $factura->fondeadorfactura->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fondeadorfactura" class="<?php echo $factura->fondeadorfactura->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $factura->SortUrl($factura->fondeadorfactura) ?>',2);"><div id="elh_factura_fondeadorfactura" class="factura_fondeadorfactura">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $factura->fondeadorfactura->caption() ?></span><span class="ew-table-header-sort"><?php if ($factura->fondeadorfactura->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($factura->fondeadorfactura->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($factura->estatusfactura->Visible) { // estatusfactura ?>
	<?php if ($factura->sortUrl($factura->estatusfactura) == "") { ?>
		<th data-name="estatusfactura" class="<?php echo $factura->estatusfactura->headerCellClass() ?>"><div id="elh_factura_estatusfactura" class="factura_estatusfactura"><div class="ew-table-header-caption"><?php echo $factura->estatusfactura->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estatusfactura" class="<?php echo $factura->estatusfactura->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $factura->SortUrl($factura->estatusfactura) ?>',2);"><div id="elh_factura_estatusfactura" class="factura_estatusfactura">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $factura->estatusfactura->caption() ?></span><span class="ew-table-header-sort"><?php if ($factura->estatusfactura->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($factura->estatusfactura->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($factura->compradorid_comprador->Visible) { // compradorid_comprador ?>
	<?php if ($factura->sortUrl($factura->compradorid_comprador) == "") { ?>
		<th data-name="compradorid_comprador" class="<?php echo $factura->compradorid_comprador->headerCellClass() ?>"><div id="elh_factura_compradorid_comprador" class="factura_compradorid_comprador"><div class="ew-table-header-caption"><?php echo $factura->compradorid_comprador->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="compradorid_comprador" class="<?php echo $factura->compradorid_comprador->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $factura->SortUrl($factura->compradorid_comprador) ?>',2);"><div id="elh_factura_compradorid_comprador" class="factura_compradorid_comprador">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $factura->compradorid_comprador->caption() ?></span><span class="ew-table-header-sort"><?php if ($factura->compradorid_comprador->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($factura->compradorid_comprador->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($factura->fondeadorfacturaidfondeadorfact->Visible) { // fondeadorfacturaidfondeadorfact ?>
	<?php if ($factura->sortUrl($factura->fondeadorfacturaidfondeadorfact) == "") { ?>
		<th data-name="fondeadorfacturaidfondeadorfact" class="<?php echo $factura->fondeadorfacturaidfondeadorfact->headerCellClass() ?>"><div id="elh_factura_fondeadorfacturaidfondeadorfact" class="factura_fondeadorfacturaidfondeadorfact"><div class="ew-table-header-caption"><?php echo $factura->fondeadorfacturaidfondeadorfact->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fondeadorfacturaidfondeadorfact" class="<?php echo $factura->fondeadorfacturaidfondeadorfact->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $factura->SortUrl($factura->fondeadorfacturaidfondeadorfact) ?>',2);"><div id="elh_factura_fondeadorfacturaidfondeadorfact" class="factura_fondeadorfacturaidfondeadorfact">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $factura->fondeadorfacturaidfondeadorfact->caption() ?></span><span class="ew-table-header-sort"><?php if ($factura->fondeadorfacturaidfondeadorfact->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($factura->fondeadorfacturaidfondeadorfact->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$factura_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($factura->ExportAll && $factura->isExport()) {
	$factura_list->StopRec = $factura_list->TotalRecs;
} else {

	// Set the last record to display
	if ($factura_list->TotalRecs > $factura_list->StartRec + $factura_list->DisplayRecs - 1)
		$factura_list->StopRec = $factura_list->StartRec + $factura_list->DisplayRecs - 1;
	else
		$factura_list->StopRec = $factura_list->TotalRecs;
}
$factura_list->RecCnt = $factura_list->StartRec - 1;
if ($factura_list->Recordset && !$factura_list->Recordset->EOF) {
	$factura_list->Recordset->moveFirst();
	$selectLimit = $factura_list->UseSelectLimit;
	if (!$selectLimit && $factura_list->StartRec > 1)
		$factura_list->Recordset->move($factura_list->StartRec - 1);
} elseif (!$factura->AllowAddDeleteRow && $factura_list->StopRec == 0) {
	$factura_list->StopRec = $factura->GridAddRowCount;
}

// Initialize aggregate
$factura->RowType = ROWTYPE_AGGREGATEINIT;
$factura->resetAttributes();
$factura_list->renderRow();
while ($factura_list->RecCnt < $factura_list->StopRec) {
	$factura_list->RecCnt++;
	if ($factura_list->RecCnt >= $factura_list->StartRec) {
		$factura_list->RowCnt++;

		// Set up key count
		$factura_list->KeyCount = $factura_list->RowIndex;

		// Init row class and style
		$factura->resetAttributes();
		$factura->CssClass = "";
		if ($factura->isGridAdd()) {
		} else {
			$factura_list->loadRowValues($factura_list->Recordset); // Load row values
		}
		$factura->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$factura->RowAttrs = array_merge($factura->RowAttrs, array('data-rowindex'=>$factura_list->RowCnt, 'id'=>'r' . $factura_list->RowCnt . '_factura', 'data-rowtype'=>$factura->RowType));

		// Render row
		$factura_list->renderRow();

		// Render list options
		$factura_list->renderListOptions();
?>
	<tr<?php echo $factura->rowAttributes() ?>>
<?php

// Render list options (body, left)
$factura_list->ListOptions->render("body", "left", $factura_list->RowCnt);
?>
	<?php if ($factura->rfcfactura->Visible) { // rfcfactura ?>
		<td data-name="rfcfactura"<?php echo $factura->rfcfactura->cellAttributes() ?>>
<span id="el<?php echo $factura_list->RowCnt ?>_factura_rfcfactura" class="factura_rfcfactura">
<span<?php echo $factura->rfcfactura->viewAttributes() ?>>
<?php echo $factura->rfcfactura->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($factura->idfactura->Visible) { // idfactura ?>
		<td data-name="idfactura"<?php echo $factura->idfactura->cellAttributes() ?>>
<span id="el<?php echo $factura_list->RowCnt ?>_factura_idfactura" class="factura_idfactura">
<span<?php echo $factura->idfactura->viewAttributes() ?>>
<?php echo $factura->idfactura->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($factura->monto->Visible) { // monto ?>
		<td data-name="monto"<?php echo $factura->monto->cellAttributes() ?>>
<span id="el<?php echo $factura_list->RowCnt ?>_factura_monto" class="factura_monto">
<span<?php echo $factura->monto->viewAttributes() ?>>
<?php echo $factura->monto->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($factura->estado_operacion->Visible) { // estado_operacion ?>
		<td data-name="estado_operacion"<?php echo $factura->estado_operacion->cellAttributes() ?>>
<span id="el<?php echo $factura_list->RowCnt ?>_factura_estado_operacion" class="factura_estado_operacion">
<span<?php echo $factura->estado_operacion->viewAttributes() ?>>
<?php echo $factura->estado_operacion->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($factura->pymerfc->Visible) { // pymerfc ?>
		<td data-name="pymerfc"<?php echo $factura->pymerfc->cellAttributes() ?>>
<span id="el<?php echo $factura_list->RowCnt ?>_factura_pymerfc" class="factura_pymerfc">
<span<?php echo $factura->pymerfc->viewAttributes() ?>>
<?php echo $factura->pymerfc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($factura->compradorfc->Visible) { // compradorfc ?>
		<td data-name="compradorfc"<?php echo $factura->compradorfc->cellAttributes() ?>>
<span id="el<?php echo $factura_list->RowCnt ?>_factura_compradorfc" class="factura_compradorfc">
<span<?php echo $factura->compradorfc->viewAttributes() ?>>
<?php echo $factura->compradorfc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($factura->cadena->Visible) { // cadena ?>
		<td data-name="cadena"<?php echo $factura->cadena->cellAttributes() ?>>
<span id="el<?php echo $factura_list->RowCnt ?>_factura_cadena" class="factura_cadena">
<span<?php echo $factura->cadena->viewAttributes() ?>>
<?php echo $factura->cadena->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($factura->vencimiento->Visible) { // vencimiento ?>
		<td data-name="vencimiento"<?php echo $factura->vencimiento->cellAttributes() ?>>
<span id="el<?php echo $factura_list->RowCnt ?>_factura_vencimiento" class="factura_vencimiento">
<span<?php echo $factura->vencimiento->viewAttributes() ?>>
<?php echo $factura->vencimiento->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($factura->fondeadorfactura->Visible) { // fondeadorfactura ?>
		<td data-name="fondeadorfactura"<?php echo $factura->fondeadorfactura->cellAttributes() ?>>
<span id="el<?php echo $factura_list->RowCnt ?>_factura_fondeadorfactura" class="factura_fondeadorfactura">
<span<?php echo $factura->fondeadorfactura->viewAttributes() ?>>
<?php echo $factura->fondeadorfactura->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($factura->estatusfactura->Visible) { // estatusfactura ?>
		<td data-name="estatusfactura"<?php echo $factura->estatusfactura->cellAttributes() ?>>
<span id="el<?php echo $factura_list->RowCnt ?>_factura_estatusfactura" class="factura_estatusfactura">
<span<?php echo $factura->estatusfactura->viewAttributes() ?>>
<?php echo $factura->estatusfactura->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($factura->compradorid_comprador->Visible) { // compradorid_comprador ?>
		<td data-name="compradorid_comprador"<?php echo $factura->compradorid_comprador->cellAttributes() ?>>
<span id="el<?php echo $factura_list->RowCnt ?>_factura_compradorid_comprador" class="factura_compradorid_comprador">
<span<?php echo $factura->compradorid_comprador->viewAttributes() ?>>
<?php echo $factura->compradorid_comprador->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($factura->fondeadorfacturaidfondeadorfact->Visible) { // fondeadorfacturaidfondeadorfact ?>
		<td data-name="fondeadorfacturaidfondeadorfact"<?php echo $factura->fondeadorfacturaidfondeadorfact->cellAttributes() ?>>
<span id="el<?php echo $factura_list->RowCnt ?>_factura_fondeadorfacturaidfondeadorfact" class="factura_fondeadorfacturaidfondeadorfact">
<span<?php echo $factura->fondeadorfacturaidfondeadorfact->viewAttributes() ?>>
<?php echo $factura->fondeadorfacturaidfondeadorfact->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$factura_list->ListOptions->render("body", "right", $factura_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$factura->isGridAdd())
		$factura_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$factura->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($factura_list->Recordset)
	$factura_list->Recordset->Close();
?>
<?php if (!$factura->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$factura->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($factura_list->Pager)) $factura_list->Pager = new NumericPager($factura_list->StartRec, $factura_list->DisplayRecs, $factura_list->TotalRecs, $factura_list->RecRange, $factura_list->AutoHidePager) ?>
<?php if ($factura_list->Pager->RecordCount > 0 && $factura_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($factura_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $factura_list->pageUrl() ?>start=<?php echo $factura_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($factura_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $factura_list->pageUrl() ?>start=<?php echo $factura_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($factura_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $factura_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($factura_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $factura_list->pageUrl() ?>start=<?php echo $factura_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($factura_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $factura_list->pageUrl() ?>start=<?php echo $factura_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($factura_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $factura_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $factura_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $factura_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $factura_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($factura_list->TotalRecs == 0 && !$factura->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $factura_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$factura_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$factura->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$factura_list->terminate();
?>