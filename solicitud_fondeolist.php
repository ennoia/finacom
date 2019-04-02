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
$solicitud_fondeo_list = new solicitud_fondeo_list();

// Run the page
$solicitud_fondeo_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$solicitud_fondeo_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$solicitud_fondeo->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fsolicitud_fondeolist = currentForm = new ew.Form("fsolicitud_fondeolist", "list");
fsolicitud_fondeolist.formKeyCountName = '<?php echo $solicitud_fondeo_list->FormKeyCountName ?>';

// Form_CustomValidate event
fsolicitud_fondeolist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fsolicitud_fondeolist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fsolicitud_fondeolist.lists["x_evaluacion[]"] = <?php echo $solicitud_fondeo_list->evaluacion->Lookup->toClientList() ?>;
fsolicitud_fondeolist.lists["x_evaluacion[]"].options = <?php echo JsonEncode($solicitud_fondeo_list->evaluacion->options(FALSE, TRUE)) ?>;

// Form object for search
var fsolicitud_fondeolistsrch = currentSearchForm = new ew.Form("fsolicitud_fondeolistsrch");

// Filters
fsolicitud_fondeolistsrch.filterList = <?php echo $solicitud_fondeo_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$solicitud_fondeo->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($solicitud_fondeo_list->TotalRecs > 0 && $solicitud_fondeo_list->ExportOptions->visible()) { ?>
<?php $solicitud_fondeo_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($solicitud_fondeo_list->ImportOptions->visible()) { ?>
<?php $solicitud_fondeo_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($solicitud_fondeo_list->SearchOptions->visible()) { ?>
<?php $solicitud_fondeo_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($solicitud_fondeo_list->FilterOptions->visible()) { ?>
<?php $solicitud_fondeo_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$solicitud_fondeo_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$solicitud_fondeo->isExport() && !$solicitud_fondeo->CurrentAction) { ?>
<form name="fsolicitud_fondeolistsrch" id="fsolicitud_fondeolistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($solicitud_fondeo_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fsolicitud_fondeolistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="solicitud_fondeo">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($solicitud_fondeo_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($solicitud_fondeo_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $solicitud_fondeo_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($solicitud_fondeo_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($solicitud_fondeo_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($solicitud_fondeo_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($solicitud_fondeo_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $solicitud_fondeo_list->showPageHeader(); ?>
<?php
$solicitud_fondeo_list->showMessage();
?>
<?php if ($solicitud_fondeo_list->TotalRecs > 0 || $solicitud_fondeo->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($solicitud_fondeo_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> solicitud_fondeo">
<?php if (!$solicitud_fondeo->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$solicitud_fondeo->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($solicitud_fondeo_list->Pager)) $solicitud_fondeo_list->Pager = new NumericPager($solicitud_fondeo_list->StartRec, $solicitud_fondeo_list->DisplayRecs, $solicitud_fondeo_list->TotalRecs, $solicitud_fondeo_list->RecRange, $solicitud_fondeo_list->AutoHidePager) ?>
<?php if ($solicitud_fondeo_list->Pager->RecordCount > 0 && $solicitud_fondeo_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($solicitud_fondeo_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $solicitud_fondeo_list->pageUrl() ?>start=<?php echo $solicitud_fondeo_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($solicitud_fondeo_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $solicitud_fondeo_list->pageUrl() ?>start=<?php echo $solicitud_fondeo_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($solicitud_fondeo_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $solicitud_fondeo_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($solicitud_fondeo_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $solicitud_fondeo_list->pageUrl() ?>start=<?php echo $solicitud_fondeo_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($solicitud_fondeo_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $solicitud_fondeo_list->pageUrl() ?>start=<?php echo $solicitud_fondeo_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($solicitud_fondeo_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $solicitud_fondeo_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $solicitud_fondeo_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $solicitud_fondeo_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $solicitud_fondeo_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fsolicitud_fondeolist" id="fsolicitud_fondeolist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($solicitud_fondeo_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $solicitud_fondeo_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="solicitud_fondeo">
<div id="gmp_solicitud_fondeo" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($solicitud_fondeo_list->TotalRecs > 0 || $solicitud_fondeo->isGridEdit()) { ?>
<table id="tbl_solicitud_fondeolist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$solicitud_fondeo_list->RowType = ROWTYPE_HEADER;

// Render list options
$solicitud_fondeo_list->renderListOptions();

// Render list options (header, left)
$solicitud_fondeo_list->ListOptions->render("header", "left");
?>
<?php if ($solicitud_fondeo->id_solicitud->Visible) { // id_solicitud ?>
	<?php if ($solicitud_fondeo->sortUrl($solicitud_fondeo->id_solicitud) == "") { ?>
		<th data-name="id_solicitud" class="<?php echo $solicitud_fondeo->id_solicitud->headerCellClass() ?>"><div id="elh_solicitud_fondeo_id_solicitud" class="solicitud_fondeo_id_solicitud"><div class="ew-table-header-caption"><?php echo $solicitud_fondeo->id_solicitud->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_solicitud" class="<?php echo $solicitud_fondeo->id_solicitud->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $solicitud_fondeo->SortUrl($solicitud_fondeo->id_solicitud) ?>',2);"><div id="elh_solicitud_fondeo_id_solicitud" class="solicitud_fondeo_id_solicitud">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $solicitud_fondeo->id_solicitud->caption() ?></span><span class="ew-table-header-sort"><?php if ($solicitud_fondeo->id_solicitud->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($solicitud_fondeo->id_solicitud->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($solicitud_fondeo->fondeador->Visible) { // fondeador ?>
	<?php if ($solicitud_fondeo->sortUrl($solicitud_fondeo->fondeador) == "") { ?>
		<th data-name="fondeador" class="<?php echo $solicitud_fondeo->fondeador->headerCellClass() ?>"><div id="elh_solicitud_fondeo_fondeador" class="solicitud_fondeo_fondeador"><div class="ew-table-header-caption"><?php echo $solicitud_fondeo->fondeador->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fondeador" class="<?php echo $solicitud_fondeo->fondeador->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $solicitud_fondeo->SortUrl($solicitud_fondeo->fondeador) ?>',2);"><div id="elh_solicitud_fondeo_fondeador" class="solicitud_fondeo_fondeador">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $solicitud_fondeo->fondeador->caption() ?></span><span class="ew-table-header-sort"><?php if ($solicitud_fondeo->fondeador->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($solicitud_fondeo->fondeador->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($solicitud_fondeo->monto->Visible) { // monto ?>
	<?php if ($solicitud_fondeo->sortUrl($solicitud_fondeo->monto) == "") { ?>
		<th data-name="monto" class="<?php echo $solicitud_fondeo->monto->headerCellClass() ?>"><div id="elh_solicitud_fondeo_monto" class="solicitud_fondeo_monto"><div class="ew-table-header-caption"><?php echo $solicitud_fondeo->monto->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="monto" class="<?php echo $solicitud_fondeo->monto->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $solicitud_fondeo->SortUrl($solicitud_fondeo->monto) ?>',2);"><div id="elh_solicitud_fondeo_monto" class="solicitud_fondeo_monto">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $solicitud_fondeo->monto->caption() ?></span><span class="ew-table-header-sort"><?php if ($solicitud_fondeo->monto->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($solicitud_fondeo->monto->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($solicitud_fondeo->plazo->Visible) { // plazo ?>
	<?php if ($solicitud_fondeo->sortUrl($solicitud_fondeo->plazo) == "") { ?>
		<th data-name="plazo" class="<?php echo $solicitud_fondeo->plazo->headerCellClass() ?>"><div id="elh_solicitud_fondeo_plazo" class="solicitud_fondeo_plazo"><div class="ew-table-header-caption"><?php echo $solicitud_fondeo->plazo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="plazo" class="<?php echo $solicitud_fondeo->plazo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $solicitud_fondeo->SortUrl($solicitud_fondeo->plazo) ?>',2);"><div id="elh_solicitud_fondeo_plazo" class="solicitud_fondeo_plazo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $solicitud_fondeo->plazo->caption() ?></span><span class="ew-table-header-sort"><?php if ($solicitud_fondeo->plazo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($solicitud_fondeo->plazo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($solicitud_fondeo->fecha_fondeo->Visible) { // fecha_fondeo ?>
	<?php if ($solicitud_fondeo->sortUrl($solicitud_fondeo->fecha_fondeo) == "") { ?>
		<th data-name="fecha_fondeo" class="<?php echo $solicitud_fondeo->fecha_fondeo->headerCellClass() ?>"><div id="elh_solicitud_fondeo_fecha_fondeo" class="solicitud_fondeo_fecha_fondeo"><div class="ew-table-header-caption"><?php echo $solicitud_fondeo->fecha_fondeo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecha_fondeo" class="<?php echo $solicitud_fondeo->fecha_fondeo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $solicitud_fondeo->SortUrl($solicitud_fondeo->fecha_fondeo) ?>',2);"><div id="elh_solicitud_fondeo_fecha_fondeo" class="solicitud_fondeo_fecha_fondeo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $solicitud_fondeo->fecha_fondeo->caption() ?></span><span class="ew-table-header-sort"><?php if ($solicitud_fondeo->fecha_fondeo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($solicitud_fondeo->fecha_fondeo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($solicitud_fondeo->estado_operacion->Visible) { // estado_operacion ?>
	<?php if ($solicitud_fondeo->sortUrl($solicitud_fondeo->estado_operacion) == "") { ?>
		<th data-name="estado_operacion" class="<?php echo $solicitud_fondeo->estado_operacion->headerCellClass() ?>"><div id="elh_solicitud_fondeo_estado_operacion" class="solicitud_fondeo_estado_operacion"><div class="ew-table-header-caption"><?php echo $solicitud_fondeo->estado_operacion->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estado_operacion" class="<?php echo $solicitud_fondeo->estado_operacion->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $solicitud_fondeo->SortUrl($solicitud_fondeo->estado_operacion) ?>',2);"><div id="elh_solicitud_fondeo_estado_operacion" class="solicitud_fondeo_estado_operacion">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $solicitud_fondeo->estado_operacion->caption() ?></span><span class="ew-table-header-sort"><?php if ($solicitud_fondeo->estado_operacion->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($solicitud_fondeo->estado_operacion->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($solicitud_fondeo->vencimiento->Visible) { // vencimiento ?>
	<?php if ($solicitud_fondeo->sortUrl($solicitud_fondeo->vencimiento) == "") { ?>
		<th data-name="vencimiento" class="<?php echo $solicitud_fondeo->vencimiento->headerCellClass() ?>"><div id="elh_solicitud_fondeo_vencimiento" class="solicitud_fondeo_vencimiento"><div class="ew-table-header-caption"><?php echo $solicitud_fondeo->vencimiento->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="vencimiento" class="<?php echo $solicitud_fondeo->vencimiento->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $solicitud_fondeo->SortUrl($solicitud_fondeo->vencimiento) ?>',2);"><div id="elh_solicitud_fondeo_vencimiento" class="solicitud_fondeo_vencimiento">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $solicitud_fondeo->vencimiento->caption() ?></span><span class="ew-table-header-sort"><?php if ($solicitud_fondeo->vencimiento->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($solicitud_fondeo->vencimiento->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($solicitud_fondeo->pymerfc->Visible) { // pymerfc ?>
	<?php if ($solicitud_fondeo->sortUrl($solicitud_fondeo->pymerfc) == "") { ?>
		<th data-name="pymerfc" class="<?php echo $solicitud_fondeo->pymerfc->headerCellClass() ?>"><div id="elh_solicitud_fondeo_pymerfc" class="solicitud_fondeo_pymerfc"><div class="ew-table-header-caption"><?php echo $solicitud_fondeo->pymerfc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pymerfc" class="<?php echo $solicitud_fondeo->pymerfc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $solicitud_fondeo->SortUrl($solicitud_fondeo->pymerfc) ?>',2);"><div id="elh_solicitud_fondeo_pymerfc" class="solicitud_fondeo_pymerfc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $solicitud_fondeo->pymerfc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($solicitud_fondeo->pymerfc->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($solicitud_fondeo->pymerfc->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($solicitud_fondeo->compradorrfc->Visible) { // compradorrfc ?>
	<?php if ($solicitud_fondeo->sortUrl($solicitud_fondeo->compradorrfc) == "") { ?>
		<th data-name="compradorrfc" class="<?php echo $solicitud_fondeo->compradorrfc->headerCellClass() ?>"><div id="elh_solicitud_fondeo_compradorrfc" class="solicitud_fondeo_compradorrfc"><div class="ew-table-header-caption"><?php echo $solicitud_fondeo->compradorrfc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="compradorrfc" class="<?php echo $solicitud_fondeo->compradorrfc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $solicitud_fondeo->SortUrl($solicitud_fondeo->compradorrfc) ?>',2);"><div id="elh_solicitud_fondeo_compradorrfc" class="solicitud_fondeo_compradorrfc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $solicitud_fondeo->compradorrfc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($solicitud_fondeo->compradorrfc->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($solicitud_fondeo->compradorrfc->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($solicitud_fondeo->facturarfc->Visible) { // facturarfc ?>
	<?php if ($solicitud_fondeo->sortUrl($solicitud_fondeo->facturarfc) == "") { ?>
		<th data-name="facturarfc" class="<?php echo $solicitud_fondeo->facturarfc->headerCellClass() ?>"><div id="elh_solicitud_fondeo_facturarfc" class="solicitud_fondeo_facturarfc"><div class="ew-table-header-caption"><?php echo $solicitud_fondeo->facturarfc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="facturarfc" class="<?php echo $solicitud_fondeo->facturarfc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $solicitud_fondeo->SortUrl($solicitud_fondeo->facturarfc) ?>',2);"><div id="elh_solicitud_fondeo_facturarfc" class="solicitud_fondeo_facturarfc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $solicitud_fondeo->facturarfc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($solicitud_fondeo->facturarfc->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($solicitud_fondeo->facturarfc->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($solicitud_fondeo->pronostico_vencimiento->Visible) { // pronostico_vencimiento ?>
	<?php if ($solicitud_fondeo->sortUrl($solicitud_fondeo->pronostico_vencimiento) == "") { ?>
		<th data-name="pronostico_vencimiento" class="<?php echo $solicitud_fondeo->pronostico_vencimiento->headerCellClass() ?>"><div id="elh_solicitud_fondeo_pronostico_vencimiento" class="solicitud_fondeo_pronostico_vencimiento"><div class="ew-table-header-caption"><?php echo $solicitud_fondeo->pronostico_vencimiento->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pronostico_vencimiento" class="<?php echo $solicitud_fondeo->pronostico_vencimiento->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $solicitud_fondeo->SortUrl($solicitud_fondeo->pronostico_vencimiento) ?>',2);"><div id="elh_solicitud_fondeo_pronostico_vencimiento" class="solicitud_fondeo_pronostico_vencimiento">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $solicitud_fondeo->pronostico_vencimiento->caption() ?></span><span class="ew-table-header-sort"><?php if ($solicitud_fondeo->pronostico_vencimiento->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($solicitud_fondeo->pronostico_vencimiento->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($solicitud_fondeo->evaluacion->Visible) { // evaluacion ?>
	<?php if ($solicitud_fondeo->sortUrl($solicitud_fondeo->evaluacion) == "") { ?>
		<th data-name="evaluacion" class="<?php echo $solicitud_fondeo->evaluacion->headerCellClass() ?>"><div id="elh_solicitud_fondeo_evaluacion" class="solicitud_fondeo_evaluacion"><div class="ew-table-header-caption"><?php echo $solicitud_fondeo->evaluacion->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="evaluacion" class="<?php echo $solicitud_fondeo->evaluacion->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $solicitud_fondeo->SortUrl($solicitud_fondeo->evaluacion) ?>',2);"><div id="elh_solicitud_fondeo_evaluacion" class="solicitud_fondeo_evaluacion">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $solicitud_fondeo->evaluacion->caption() ?></span><span class="ew-table-header-sort"><?php if ($solicitud_fondeo->evaluacion->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($solicitud_fondeo->evaluacion->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($solicitud_fondeo->fecha_solicitud->Visible) { // fecha_solicitud ?>
	<?php if ($solicitud_fondeo->sortUrl($solicitud_fondeo->fecha_solicitud) == "") { ?>
		<th data-name="fecha_solicitud" class="<?php echo $solicitud_fondeo->fecha_solicitud->headerCellClass() ?>"><div id="elh_solicitud_fondeo_fecha_solicitud" class="solicitud_fondeo_fecha_solicitud"><div class="ew-table-header-caption"><?php echo $solicitud_fondeo->fecha_solicitud->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecha_solicitud" class="<?php echo $solicitud_fondeo->fecha_solicitud->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $solicitud_fondeo->SortUrl($solicitud_fondeo->fecha_solicitud) ?>',2);"><div id="elh_solicitud_fondeo_fecha_solicitud" class="solicitud_fondeo_fecha_solicitud">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $solicitud_fondeo->fecha_solicitud->caption() ?></span><span class="ew-table-header-sort"><?php if ($solicitud_fondeo->fecha_solicitud->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($solicitud_fondeo->fecha_solicitud->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($solicitud_fondeo->oferta->Visible) { // oferta ?>
	<?php if ($solicitud_fondeo->sortUrl($solicitud_fondeo->oferta) == "") { ?>
		<th data-name="oferta" class="<?php echo $solicitud_fondeo->oferta->headerCellClass() ?>"><div id="elh_solicitud_fondeo_oferta" class="solicitud_fondeo_oferta"><div class="ew-table-header-caption"><?php echo $solicitud_fondeo->oferta->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="oferta" class="<?php echo $solicitud_fondeo->oferta->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $solicitud_fondeo->SortUrl($solicitud_fondeo->oferta) ?>',2);"><div id="elh_solicitud_fondeo_oferta" class="solicitud_fondeo_oferta">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $solicitud_fondeo->oferta->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($solicitud_fondeo->oferta->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($solicitud_fondeo->oferta->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($solicitud_fondeo->compradorid_comprador->Visible) { // compradorid_comprador ?>
	<?php if ($solicitud_fondeo->sortUrl($solicitud_fondeo->compradorid_comprador) == "") { ?>
		<th data-name="compradorid_comprador" class="<?php echo $solicitud_fondeo->compradorid_comprador->headerCellClass() ?>"><div id="elh_solicitud_fondeo_compradorid_comprador" class="solicitud_fondeo_compradorid_comprador"><div class="ew-table-header-caption"><?php echo $solicitud_fondeo->compradorid_comprador->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="compradorid_comprador" class="<?php echo $solicitud_fondeo->compradorid_comprador->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $solicitud_fondeo->SortUrl($solicitud_fondeo->compradorid_comprador) ?>',2);"><div id="elh_solicitud_fondeo_compradorid_comprador" class="solicitud_fondeo_compradorid_comprador">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $solicitud_fondeo->compradorid_comprador->caption() ?></span><span class="ew-table-header-sort"><?php if ($solicitud_fondeo->compradorid_comprador->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($solicitud_fondeo->compradorid_comprador->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$solicitud_fondeo_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($solicitud_fondeo->ExportAll && $solicitud_fondeo->isExport()) {
	$solicitud_fondeo_list->StopRec = $solicitud_fondeo_list->TotalRecs;
} else {

	// Set the last record to display
	if ($solicitud_fondeo_list->TotalRecs > $solicitud_fondeo_list->StartRec + $solicitud_fondeo_list->DisplayRecs - 1)
		$solicitud_fondeo_list->StopRec = $solicitud_fondeo_list->StartRec + $solicitud_fondeo_list->DisplayRecs - 1;
	else
		$solicitud_fondeo_list->StopRec = $solicitud_fondeo_list->TotalRecs;
}
$solicitud_fondeo_list->RecCnt = $solicitud_fondeo_list->StartRec - 1;
if ($solicitud_fondeo_list->Recordset && !$solicitud_fondeo_list->Recordset->EOF) {
	$solicitud_fondeo_list->Recordset->moveFirst();
	$selectLimit = $solicitud_fondeo_list->UseSelectLimit;
	if (!$selectLimit && $solicitud_fondeo_list->StartRec > 1)
		$solicitud_fondeo_list->Recordset->move($solicitud_fondeo_list->StartRec - 1);
} elseif (!$solicitud_fondeo->AllowAddDeleteRow && $solicitud_fondeo_list->StopRec == 0) {
	$solicitud_fondeo_list->StopRec = $solicitud_fondeo->GridAddRowCount;
}

// Initialize aggregate
$solicitud_fondeo->RowType = ROWTYPE_AGGREGATEINIT;
$solicitud_fondeo->resetAttributes();
$solicitud_fondeo_list->renderRow();
while ($solicitud_fondeo_list->RecCnt < $solicitud_fondeo_list->StopRec) {
	$solicitud_fondeo_list->RecCnt++;
	if ($solicitud_fondeo_list->RecCnt >= $solicitud_fondeo_list->StartRec) {
		$solicitud_fondeo_list->RowCnt++;

		// Set up key count
		$solicitud_fondeo_list->KeyCount = $solicitud_fondeo_list->RowIndex;

		// Init row class and style
		$solicitud_fondeo->resetAttributes();
		$solicitud_fondeo->CssClass = "";
		if ($solicitud_fondeo->isGridAdd()) {
		} else {
			$solicitud_fondeo_list->loadRowValues($solicitud_fondeo_list->Recordset); // Load row values
		}
		$solicitud_fondeo->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$solicitud_fondeo->RowAttrs = array_merge($solicitud_fondeo->RowAttrs, array('data-rowindex'=>$solicitud_fondeo_list->RowCnt, 'id'=>'r' . $solicitud_fondeo_list->RowCnt . '_solicitud_fondeo', 'data-rowtype'=>$solicitud_fondeo->RowType));

		// Render row
		$solicitud_fondeo_list->renderRow();

		// Render list options
		$solicitud_fondeo_list->renderListOptions();
?>
	<tr<?php echo $solicitud_fondeo->rowAttributes() ?>>
<?php

// Render list options (body, left)
$solicitud_fondeo_list->ListOptions->render("body", "left", $solicitud_fondeo_list->RowCnt);
?>
	<?php if ($solicitud_fondeo->id_solicitud->Visible) { // id_solicitud ?>
		<td data-name="id_solicitud"<?php echo $solicitud_fondeo->id_solicitud->cellAttributes() ?>>
<span id="el<?php echo $solicitud_fondeo_list->RowCnt ?>_solicitud_fondeo_id_solicitud" class="solicitud_fondeo_id_solicitud">
<span<?php echo $solicitud_fondeo->id_solicitud->viewAttributes() ?>>
<?php echo $solicitud_fondeo->id_solicitud->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($solicitud_fondeo->fondeador->Visible) { // fondeador ?>
		<td data-name="fondeador"<?php echo $solicitud_fondeo->fondeador->cellAttributes() ?>>
<span id="el<?php echo $solicitud_fondeo_list->RowCnt ?>_solicitud_fondeo_fondeador" class="solicitud_fondeo_fondeador">
<span<?php echo $solicitud_fondeo->fondeador->viewAttributes() ?>>
<?php echo $solicitud_fondeo->fondeador->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($solicitud_fondeo->monto->Visible) { // monto ?>
		<td data-name="monto"<?php echo $solicitud_fondeo->monto->cellAttributes() ?>>
<span id="el<?php echo $solicitud_fondeo_list->RowCnt ?>_solicitud_fondeo_monto" class="solicitud_fondeo_monto">
<span<?php echo $solicitud_fondeo->monto->viewAttributes() ?>>
<?php echo $solicitud_fondeo->monto->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($solicitud_fondeo->plazo->Visible) { // plazo ?>
		<td data-name="plazo"<?php echo $solicitud_fondeo->plazo->cellAttributes() ?>>
<span id="el<?php echo $solicitud_fondeo_list->RowCnt ?>_solicitud_fondeo_plazo" class="solicitud_fondeo_plazo">
<span<?php echo $solicitud_fondeo->plazo->viewAttributes() ?>>
<?php echo $solicitud_fondeo->plazo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($solicitud_fondeo->fecha_fondeo->Visible) { // fecha_fondeo ?>
		<td data-name="fecha_fondeo"<?php echo $solicitud_fondeo->fecha_fondeo->cellAttributes() ?>>
<span id="el<?php echo $solicitud_fondeo_list->RowCnt ?>_solicitud_fondeo_fecha_fondeo" class="solicitud_fondeo_fecha_fondeo">
<span<?php echo $solicitud_fondeo->fecha_fondeo->viewAttributes() ?>>
<?php echo $solicitud_fondeo->fecha_fondeo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($solicitud_fondeo->estado_operacion->Visible) { // estado_operacion ?>
		<td data-name="estado_operacion"<?php echo $solicitud_fondeo->estado_operacion->cellAttributes() ?>>
<span id="el<?php echo $solicitud_fondeo_list->RowCnt ?>_solicitud_fondeo_estado_operacion" class="solicitud_fondeo_estado_operacion">
<span<?php echo $solicitud_fondeo->estado_operacion->viewAttributes() ?>>
<?php echo $solicitud_fondeo->estado_operacion->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($solicitud_fondeo->vencimiento->Visible) { // vencimiento ?>
		<td data-name="vencimiento"<?php echo $solicitud_fondeo->vencimiento->cellAttributes() ?>>
<span id="el<?php echo $solicitud_fondeo_list->RowCnt ?>_solicitud_fondeo_vencimiento" class="solicitud_fondeo_vencimiento">
<span<?php echo $solicitud_fondeo->vencimiento->viewAttributes() ?>>
<?php echo $solicitud_fondeo->vencimiento->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($solicitud_fondeo->pymerfc->Visible) { // pymerfc ?>
		<td data-name="pymerfc"<?php echo $solicitud_fondeo->pymerfc->cellAttributes() ?>>
<span id="el<?php echo $solicitud_fondeo_list->RowCnt ?>_solicitud_fondeo_pymerfc" class="solicitud_fondeo_pymerfc">
<span<?php echo $solicitud_fondeo->pymerfc->viewAttributes() ?>>
<?php echo $solicitud_fondeo->pymerfc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($solicitud_fondeo->compradorrfc->Visible) { // compradorrfc ?>
		<td data-name="compradorrfc"<?php echo $solicitud_fondeo->compradorrfc->cellAttributes() ?>>
<span id="el<?php echo $solicitud_fondeo_list->RowCnt ?>_solicitud_fondeo_compradorrfc" class="solicitud_fondeo_compradorrfc">
<span<?php echo $solicitud_fondeo->compradorrfc->viewAttributes() ?>>
<?php echo $solicitud_fondeo->compradorrfc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($solicitud_fondeo->facturarfc->Visible) { // facturarfc ?>
		<td data-name="facturarfc"<?php echo $solicitud_fondeo->facturarfc->cellAttributes() ?>>
<span id="el<?php echo $solicitud_fondeo_list->RowCnt ?>_solicitud_fondeo_facturarfc" class="solicitud_fondeo_facturarfc">
<span<?php echo $solicitud_fondeo->facturarfc->viewAttributes() ?>>
<?php echo $solicitud_fondeo->facturarfc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($solicitud_fondeo->pronostico_vencimiento->Visible) { // pronostico_vencimiento ?>
		<td data-name="pronostico_vencimiento"<?php echo $solicitud_fondeo->pronostico_vencimiento->cellAttributes() ?>>
<span id="el<?php echo $solicitud_fondeo_list->RowCnt ?>_solicitud_fondeo_pronostico_vencimiento" class="solicitud_fondeo_pronostico_vencimiento">
<span<?php echo $solicitud_fondeo->pronostico_vencimiento->viewAttributes() ?>>
<?php echo $solicitud_fondeo->pronostico_vencimiento->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($solicitud_fondeo->evaluacion->Visible) { // evaluacion ?>
		<td data-name="evaluacion"<?php echo $solicitud_fondeo->evaluacion->cellAttributes() ?>>
<span id="el<?php echo $solicitud_fondeo_list->RowCnt ?>_solicitud_fondeo_evaluacion" class="solicitud_fondeo_evaluacion">
<span<?php echo $solicitud_fondeo->evaluacion->viewAttributes() ?>>
<?php if (ConvertToBool($solicitud_fondeo->evaluacion->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $solicitud_fondeo->evaluacion->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $solicitud_fondeo->evaluacion->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($solicitud_fondeo->fecha_solicitud->Visible) { // fecha_solicitud ?>
		<td data-name="fecha_solicitud"<?php echo $solicitud_fondeo->fecha_solicitud->cellAttributes() ?>>
<span id="el<?php echo $solicitud_fondeo_list->RowCnt ?>_solicitud_fondeo_fecha_solicitud" class="solicitud_fondeo_fecha_solicitud">
<span<?php echo $solicitud_fondeo->fecha_solicitud->viewAttributes() ?>>
<?php echo $solicitud_fondeo->fecha_solicitud->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($solicitud_fondeo->oferta->Visible) { // oferta ?>
		<td data-name="oferta"<?php echo $solicitud_fondeo->oferta->cellAttributes() ?>>
<span id="el<?php echo $solicitud_fondeo_list->RowCnt ?>_solicitud_fondeo_oferta" class="solicitud_fondeo_oferta">
<span<?php echo $solicitud_fondeo->oferta->viewAttributes() ?>>
<?php echo $solicitud_fondeo->oferta->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($solicitud_fondeo->compradorid_comprador->Visible) { // compradorid_comprador ?>
		<td data-name="compradorid_comprador"<?php echo $solicitud_fondeo->compradorid_comprador->cellAttributes() ?>>
<span id="el<?php echo $solicitud_fondeo_list->RowCnt ?>_solicitud_fondeo_compradorid_comprador" class="solicitud_fondeo_compradorid_comprador">
<span<?php echo $solicitud_fondeo->compradorid_comprador->viewAttributes() ?>>
<?php echo $solicitud_fondeo->compradorid_comprador->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$solicitud_fondeo_list->ListOptions->render("body", "right", $solicitud_fondeo_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$solicitud_fondeo->isGridAdd())
		$solicitud_fondeo_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$solicitud_fondeo->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($solicitud_fondeo_list->Recordset)
	$solicitud_fondeo_list->Recordset->Close();
?>
<?php if (!$solicitud_fondeo->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$solicitud_fondeo->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($solicitud_fondeo_list->Pager)) $solicitud_fondeo_list->Pager = new NumericPager($solicitud_fondeo_list->StartRec, $solicitud_fondeo_list->DisplayRecs, $solicitud_fondeo_list->TotalRecs, $solicitud_fondeo_list->RecRange, $solicitud_fondeo_list->AutoHidePager) ?>
<?php if ($solicitud_fondeo_list->Pager->RecordCount > 0 && $solicitud_fondeo_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($solicitud_fondeo_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $solicitud_fondeo_list->pageUrl() ?>start=<?php echo $solicitud_fondeo_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($solicitud_fondeo_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $solicitud_fondeo_list->pageUrl() ?>start=<?php echo $solicitud_fondeo_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($solicitud_fondeo_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $solicitud_fondeo_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($solicitud_fondeo_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $solicitud_fondeo_list->pageUrl() ?>start=<?php echo $solicitud_fondeo_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($solicitud_fondeo_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $solicitud_fondeo_list->pageUrl() ?>start=<?php echo $solicitud_fondeo_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($solicitud_fondeo_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $solicitud_fondeo_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $solicitud_fondeo_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $solicitud_fondeo_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $solicitud_fondeo_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($solicitud_fondeo_list->TotalRecs == 0 && !$solicitud_fondeo->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $solicitud_fondeo_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$solicitud_fondeo_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$solicitud_fondeo->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$solicitud_fondeo_list->terminate();
?>