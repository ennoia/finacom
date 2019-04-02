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
$comprador_list = new comprador_list();

// Run the page
$comprador_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$comprador_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$comprador->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fcompradorlist = currentForm = new ew.Form("fcompradorlist", "list");
fcompradorlist.formKeyCountName = '<?php echo $comprador_list->FormKeyCountName ?>';

// Form_CustomValidate event
fcompradorlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcompradorlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcompradorlist.lists["x_pymerfc"] = <?php echo $comprador_list->pymerfc->Lookup->toClientList() ?>;
fcompradorlist.lists["x_pymerfc"].options = <?php echo JsonEncode($comprador_list->pymerfc->lookupOptions()) ?>;
fcompradorlist.autoSuggests["x_pymerfc"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
var fcompradorlistsrch = currentSearchForm = new ew.Form("fcompradorlistsrch");

// Filters
fcompradorlistsrch.filterList = <?php echo $comprador_list->getFilterList() ?>;
</script>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>

<div id="container" style="min-width: 200px; height: 300px; max-width: 350px; margin: 0 auto"></div>

<script>
// Build the chart
Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Browser market shares in January, 2018'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: [{
            name: 'Pyme1',
            y: 61.41,
            sliced: true,
            selected: true
        }, {
            name: 'Pyme2',
            y: 11.84
        }, {
            name: 'Pyme3',
            y: 10.85
        }, {
            name: 'Pyme4',
            y: 4.67
        }, {
            name: 'Pyme5',
            y: 4.18
        }, {
            name: 'Pyme6',
            y: 7.05
        }]
    }]
});

</script>



<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$comprador->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($comprador_list->TotalRecs > 0 && $comprador_list->ExportOptions->visible()) { ?>
<?php $comprador_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($comprador_list->ImportOptions->visible()) { ?>
<?php $comprador_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($comprador_list->SearchOptions->visible()) { ?>
<?php $comprador_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($comprador_list->FilterOptions->visible()) { ?>
<?php $comprador_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$comprador_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$comprador->isExport() && !$comprador->CurrentAction) { ?>
<form name="fcompradorlistsrch" id="fcompradorlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($comprador_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fcompradorlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="comprador">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($comprador_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($comprador_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $comprador_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($comprador_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($comprador_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($comprador_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($comprador_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $comprador_list->showPageHeader(); ?>
<?php
$comprador_list->showMessage();
?>
<?php if ($comprador_list->TotalRecs > 0 || $comprador->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($comprador_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> comprador">
<?php if (!$comprador->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$comprador->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($comprador_list->Pager)) $comprador_list->Pager = new NumericPager($comprador_list->StartRec, $comprador_list->DisplayRecs, $comprador_list->TotalRecs, $comprador_list->RecRange, $comprador_list->AutoHidePager) ?>
<?php if ($comprador_list->Pager->RecordCount > 0 && $comprador_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($comprador_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $comprador_list->pageUrl() ?>start=<?php echo $comprador_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($comprador_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $comprador_list->pageUrl() ?>start=<?php echo $comprador_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($comprador_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $comprador_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($comprador_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $comprador_list->pageUrl() ?>start=<?php echo $comprador_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($comprador_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $comprador_list->pageUrl() ?>start=<?php echo $comprador_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($comprador_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $comprador_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $comprador_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $comprador_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $comprador_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcompradorlist" id="fcompradorlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($comprador_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $comprador_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="comprador">
<div id="gmp_comprador" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($comprador_list->TotalRecs > 0 || $comprador->isGridEdit()) { ?>
<table id="tbl_compradorlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$comprador_list->RowType = ROWTYPE_HEADER;

// Render list options
$comprador_list->renderListOptions();

// Render list options (header, left)
$comprador_list->ListOptions->render("header", "left");
?>
<?php if ($comprador->id_comprador->Visible) { // id_comprador ?>
	<?php if ($comprador->sortUrl($comprador->id_comprador) == "") { ?>
		<th data-name="id_comprador" class="<?php echo $comprador->id_comprador->headerCellClass() ?>"><div id="elh_comprador_id_comprador" class="comprador_id_comprador"><div class="ew-table-header-caption"><?php echo $comprador->id_comprador->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_comprador" class="<?php echo $comprador->id_comprador->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $comprador->SortUrl($comprador->id_comprador) ?>',2);"><div id="elh_comprador_id_comprador" class="comprador_id_comprador">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $comprador->id_comprador->caption() ?></span><span class="ew-table-header-sort"><?php if ($comprador->id_comprador->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($comprador->id_comprador->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($comprador->razon_social->Visible) { // razon_social ?>
	<?php if ($comprador->sortUrl($comprador->razon_social) == "") { ?>
		<th data-name="razon_social" class="<?php echo $comprador->razon_social->headerCellClass() ?>"><div id="elh_comprador_razon_social" class="comprador_razon_social"><div class="ew-table-header-caption"><?php echo $comprador->razon_social->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="razon_social" class="<?php echo $comprador->razon_social->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $comprador->SortUrl($comprador->razon_social) ?>',2);"><div id="elh_comprador_razon_social" class="comprador_razon_social">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $comprador->razon_social->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($comprador->razon_social->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($comprador->razon_social->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($comprador->rfc->Visible) { // rfc ?>
	<?php if ($comprador->sortUrl($comprador->rfc) == "") { ?>
		<th data-name="rfc" class="<?php echo $comprador->rfc->headerCellClass() ?>"><div id="elh_comprador_rfc" class="comprador_rfc"><div class="ew-table-header-caption"><?php echo $comprador->rfc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rfc" class="<?php echo $comprador->rfc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $comprador->SortUrl($comprador->rfc) ?>',2);"><div id="elh_comprador_rfc" class="comprador_rfc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $comprador->rfc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($comprador->rfc->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($comprador->rfc->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($comprador->calle->Visible) { // calle ?>
	<?php if ($comprador->sortUrl($comprador->calle) == "") { ?>
		<th data-name="calle" class="<?php echo $comprador->calle->headerCellClass() ?>"><div id="elh_comprador_calle" class="comprador_calle"><div class="ew-table-header-caption"><?php echo $comprador->calle->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="calle" class="<?php echo $comprador->calle->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $comprador->SortUrl($comprador->calle) ?>',2);"><div id="elh_comprador_calle" class="comprador_calle">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $comprador->calle->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($comprador->calle->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($comprador->calle->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($comprador->colonia->Visible) { // colonia ?>
	<?php if ($comprador->sortUrl($comprador->colonia) == "") { ?>
		<th data-name="colonia" class="<?php echo $comprador->colonia->headerCellClass() ?>"><div id="elh_comprador_colonia" class="comprador_colonia"><div class="ew-table-header-caption"><?php echo $comprador->colonia->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="colonia" class="<?php echo $comprador->colonia->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $comprador->SortUrl($comprador->colonia) ?>',2);"><div id="elh_comprador_colonia" class="comprador_colonia">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $comprador->colonia->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($comprador->colonia->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($comprador->colonia->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($comprador->codpostal->Visible) { // codpostal ?>
	<?php if ($comprador->sortUrl($comprador->codpostal) == "") { ?>
		<th data-name="codpostal" class="<?php echo $comprador->codpostal->headerCellClass() ?>"><div id="elh_comprador_codpostal" class="comprador_codpostal"><div class="ew-table-header-caption"><?php echo $comprador->codpostal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="codpostal" class="<?php echo $comprador->codpostal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $comprador->SortUrl($comprador->codpostal) ?>',2);"><div id="elh_comprador_codpostal" class="comprador_codpostal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $comprador->codpostal->caption() ?></span><span class="ew-table-header-sort"><?php if ($comprador->codpostal->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($comprador->codpostal->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($comprador->ciudad->Visible) { // ciudad ?>
	<?php if ($comprador->sortUrl($comprador->ciudad) == "") { ?>
		<th data-name="ciudad" class="<?php echo $comprador->ciudad->headerCellClass() ?>"><div id="elh_comprador_ciudad" class="comprador_ciudad"><div class="ew-table-header-caption"><?php echo $comprador->ciudad->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ciudad" class="<?php echo $comprador->ciudad->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $comprador->SortUrl($comprador->ciudad) ?>',2);"><div id="elh_comprador_ciudad" class="comprador_ciudad">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $comprador->ciudad->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($comprador->ciudad->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($comprador->ciudad->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($comprador->telefono->Visible) { // telefono ?>
	<?php if ($comprador->sortUrl($comprador->telefono) == "") { ?>
		<th data-name="telefono" class="<?php echo $comprador->telefono->headerCellClass() ?>"><div id="elh_comprador_telefono" class="comprador_telefono"><div class="ew-table-header-caption"><?php echo $comprador->telefono->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="telefono" class="<?php echo $comprador->telefono->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $comprador->SortUrl($comprador->telefono) ?>',2);"><div id="elh_comprador_telefono" class="comprador_telefono">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $comprador->telefono->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($comprador->telefono->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($comprador->telefono->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($comprador->correo->Visible) { // correo ?>
	<?php if ($comprador->sortUrl($comprador->correo) == "") { ?>
		<th data-name="correo" class="<?php echo $comprador->correo->headerCellClass() ?>"><div id="elh_comprador_correo" class="comprador_correo"><div class="ew-table-header-caption"><?php echo $comprador->correo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="correo" class="<?php echo $comprador->correo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $comprador->SortUrl($comprador->correo) ?>',2);"><div id="elh_comprador_correo" class="comprador_correo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $comprador->correo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($comprador->correo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($comprador->correo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($comprador->pais->Visible) { // pais ?>
	<?php if ($comprador->sortUrl($comprador->pais) == "") { ?>
		<th data-name="pais" class="<?php echo $comprador->pais->headerCellClass() ?>"><div id="elh_comprador_pais" class="comprador_pais"><div class="ew-table-header-caption"><?php echo $comprador->pais->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pais" class="<?php echo $comprador->pais->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $comprador->SortUrl($comprador->pais) ?>',2);"><div id="elh_comprador_pais" class="comprador_pais">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $comprador->pais->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($comprador->pais->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($comprador->pais->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($comprador->pymerfc->Visible) { // pymerfc ?>
	<?php if ($comprador->sortUrl($comprador->pymerfc) == "") { ?>
		<th data-name="pymerfc" class="<?php echo $comprador->pymerfc->headerCellClass() ?>"><div id="elh_comprador_pymerfc" class="comprador_pymerfc"><div class="ew-table-header-caption"><?php echo $comprador->pymerfc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pymerfc" class="<?php echo $comprador->pymerfc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $comprador->SortUrl($comprador->pymerfc) ?>',2);"><div id="elh_comprador_pymerfc" class="comprador_pymerfc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $comprador->pymerfc->caption() ?></span><span class="ew-table-header-sort"><?php if ($comprador->pymerfc->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($comprador->pymerfc->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$comprador_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($comprador->ExportAll && $comprador->isExport()) {
	$comprador_list->StopRec = $comprador_list->TotalRecs;
} else {

	// Set the last record to display
	if ($comprador_list->TotalRecs > $comprador_list->StartRec + $comprador_list->DisplayRecs - 1)
		$comprador_list->StopRec = $comprador_list->StartRec + $comprador_list->DisplayRecs - 1;
	else
		$comprador_list->StopRec = $comprador_list->TotalRecs;
}
$comprador_list->RecCnt = $comprador_list->StartRec - 1;
if ($comprador_list->Recordset && !$comprador_list->Recordset->EOF) {
	$comprador_list->Recordset->moveFirst();
	$selectLimit = $comprador_list->UseSelectLimit;
	if (!$selectLimit && $comprador_list->StartRec > 1)
		$comprador_list->Recordset->move($comprador_list->StartRec - 1);
} elseif (!$comprador->AllowAddDeleteRow && $comprador_list->StopRec == 0) {
	$comprador_list->StopRec = $comprador->GridAddRowCount;
}

// Initialize aggregate
$comprador->RowType = ROWTYPE_AGGREGATEINIT;
$comprador->resetAttributes();
$comprador_list->renderRow();
while ($comprador_list->RecCnt < $comprador_list->StopRec) {
	$comprador_list->RecCnt++;
	if ($comprador_list->RecCnt >= $comprador_list->StartRec) {
		$comprador_list->RowCnt++;

		// Set up key count
		$comprador_list->KeyCount = $comprador_list->RowIndex;

		// Init row class and style
		$comprador->resetAttributes();
		$comprador->CssClass = "";
		if ($comprador->isGridAdd()) {
		} else {
			$comprador_list->loadRowValues($comprador_list->Recordset); // Load row values
		}
		$comprador->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$comprador->RowAttrs = array_merge($comprador->RowAttrs, array('data-rowindex'=>$comprador_list->RowCnt, 'id'=>'r' . $comprador_list->RowCnt . '_comprador', 'data-rowtype'=>$comprador->RowType));

		// Render row
		$comprador_list->renderRow();

		// Render list options
		$comprador_list->renderListOptions();
?>
	<tr<?php echo $comprador->rowAttributes() ?>>
<?php

// Render list options (body, left)
$comprador_list->ListOptions->render("body", "left", $comprador_list->RowCnt);
?>
	<?php if ($comprador->id_comprador->Visible) { // id_comprador ?>
		<td data-name="id_comprador"<?php echo $comprador->id_comprador->cellAttributes() ?>>
<span id="el<?php echo $comprador_list->RowCnt ?>_comprador_id_comprador" class="comprador_id_comprador">
<span<?php echo $comprador->id_comprador->viewAttributes() ?>>
<?php echo $comprador->id_comprador->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($comprador->razon_social->Visible) { // razon_social ?>
		<td data-name="razon_social"<?php echo $comprador->razon_social->cellAttributes() ?>>
<span id="el<?php echo $comprador_list->RowCnt ?>_comprador_razon_social" class="comprador_razon_social">
<span<?php echo $comprador->razon_social->viewAttributes() ?>>
<?php echo $comprador->razon_social->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($comprador->rfc->Visible) { // rfc ?>
		<td data-name="rfc"<?php echo $comprador->rfc->cellAttributes() ?>>
<span id="el<?php echo $comprador_list->RowCnt ?>_comprador_rfc" class="comprador_rfc">
<span<?php echo $comprador->rfc->viewAttributes() ?>>
<?php echo $comprador->rfc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($comprador->calle->Visible) { // calle ?>
		<td data-name="calle"<?php echo $comprador->calle->cellAttributes() ?>>
<span id="el<?php echo $comprador_list->RowCnt ?>_comprador_calle" class="comprador_calle">
<span<?php echo $comprador->calle->viewAttributes() ?>>
<?php echo $comprador->calle->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($comprador->colonia->Visible) { // colonia ?>
		<td data-name="colonia"<?php echo $comprador->colonia->cellAttributes() ?>>
<span id="el<?php echo $comprador_list->RowCnt ?>_comprador_colonia" class="comprador_colonia">
<span<?php echo $comprador->colonia->viewAttributes() ?>>
<?php echo $comprador->colonia->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($comprador->codpostal->Visible) { // codpostal ?>
		<td data-name="codpostal"<?php echo $comprador->codpostal->cellAttributes() ?>>
<span id="el<?php echo $comprador_list->RowCnt ?>_comprador_codpostal" class="comprador_codpostal">
<span<?php echo $comprador->codpostal->viewAttributes() ?>>
<?php echo $comprador->codpostal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($comprador->ciudad->Visible) { // ciudad ?>
		<td data-name="ciudad"<?php echo $comprador->ciudad->cellAttributes() ?>>
<span id="el<?php echo $comprador_list->RowCnt ?>_comprador_ciudad" class="comprador_ciudad">
<span<?php echo $comprador->ciudad->viewAttributes() ?>>
<?php echo $comprador->ciudad->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($comprador->telefono->Visible) { // telefono ?>
		<td data-name="telefono"<?php echo $comprador->telefono->cellAttributes() ?>>
<span id="el<?php echo $comprador_list->RowCnt ?>_comprador_telefono" class="comprador_telefono">
<span<?php echo $comprador->telefono->viewAttributes() ?>>
<?php echo $comprador->telefono->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($comprador->correo->Visible) { // correo ?>
		<td data-name="correo"<?php echo $comprador->correo->cellAttributes() ?>>
<span id="el<?php echo $comprador_list->RowCnt ?>_comprador_correo" class="comprador_correo">
<span<?php echo $comprador->correo->viewAttributes() ?>>
<?php echo $comprador->correo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($comprador->pais->Visible) { // pais ?>
		<td data-name="pais"<?php echo $comprador->pais->cellAttributes() ?>>
<span id="el<?php echo $comprador_list->RowCnt ?>_comprador_pais" class="comprador_pais">
<span<?php echo $comprador->pais->viewAttributes() ?>>
<?php echo $comprador->pais->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($comprador->pymerfc->Visible) { // pymerfc ?>
		<td data-name="pymerfc"<?php echo $comprador->pymerfc->cellAttributes() ?>>
<span id="el<?php echo $comprador_list->RowCnt ?>_comprador_pymerfc" class="comprador_pymerfc">
<span<?php echo $comprador->pymerfc->viewAttributes() ?>>
<?php echo $comprador->pymerfc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$comprador_list->ListOptions->render("body", "right", $comprador_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$comprador->isGridAdd())
		$comprador_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$comprador->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($comprador_list->Recordset)
	$comprador_list->Recordset->Close();
?>
<?php if (!$comprador->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$comprador->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($comprador_list->Pager)) $comprador_list->Pager = new NumericPager($comprador_list->StartRec, $comprador_list->DisplayRecs, $comprador_list->TotalRecs, $comprador_list->RecRange, $comprador_list->AutoHidePager) ?>
<?php if ($comprador_list->Pager->RecordCount > 0 && $comprador_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($comprador_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $comprador_list->pageUrl() ?>start=<?php echo $comprador_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($comprador_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $comprador_list->pageUrl() ?>start=<?php echo $comprador_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($comprador_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $comprador_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($comprador_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $comprador_list->pageUrl() ?>start=<?php echo $comprador_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($comprador_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $comprador_list->pageUrl() ?>start=<?php echo $comprador_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($comprador_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $comprador_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $comprador_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $comprador_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $comprador_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($comprador_list->TotalRecs == 0 && !$comprador->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $comprador_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$comprador_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$comprador->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$comprador_list->terminate();
?>




