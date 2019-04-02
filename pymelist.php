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
$pyme_list = new pyme_list();

// Run the page
$pyme_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pyme_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$pyme->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fpymelist = currentForm = new ew.Form("fpymelist", "list");
fpymelist.formKeyCountName = '<?php echo $pyme_list->FormKeyCountName ?>';

// Form_CustomValidate event
fpymelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fpymelist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fpymelist.lists["x_compradorrfc"] = <?php echo $pyme_list->compradorrfc->Lookup->toClientList() ?>;
fpymelist.lists["x_compradorrfc"].options = <?php echo JsonEncode($pyme_list->compradorrfc->lookupOptions()) ?>;
fpymelist.autoSuggests["x_compradorrfc"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
var fpymelistsrch = currentSearchForm = new ew.Form("fpymelistsrch");

// Filters
fpymelistsrch.filterList = <?php echo $pyme_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$pyme->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($pyme_list->TotalRecs > 0 && $pyme_list->ExportOptions->visible()) { ?>
<?php $pyme_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($pyme_list->ImportOptions->visible()) { ?>
<?php $pyme_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($pyme_list->SearchOptions->visible()) { ?>
<?php $pyme_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($pyme_list->FilterOptions->visible()) { ?>
<?php $pyme_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$pyme_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$pyme->isExport() && !$pyme->CurrentAction) { ?>
<form name="fpymelistsrch" id="fpymelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($pyme_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fpymelistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="pyme">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($pyme_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($pyme_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $pyme_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($pyme_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($pyme_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($pyme_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($pyme_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $pyme_list->showPageHeader(); ?>
<?php
$pyme_list->showMessage();
?>
<?php if ($pyme_list->TotalRecs > 0 || $pyme->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($pyme_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> pyme">
<?php if (!$pyme->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$pyme->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($pyme_list->Pager)) $pyme_list->Pager = new NumericPager($pyme_list->StartRec, $pyme_list->DisplayRecs, $pyme_list->TotalRecs, $pyme_list->RecRange, $pyme_list->AutoHidePager) ?>
<?php if ($pyme_list->Pager->RecordCount > 0 && $pyme_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($pyme_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $pyme_list->pageUrl() ?>start=<?php echo $pyme_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($pyme_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $pyme_list->pageUrl() ?>start=<?php echo $pyme_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($pyme_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $pyme_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($pyme_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $pyme_list->pageUrl() ?>start=<?php echo $pyme_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($pyme_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $pyme_list->pageUrl() ?>start=<?php echo $pyme_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($pyme_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $pyme_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $pyme_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $pyme_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $pyme_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpymelist" id="fpymelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($pyme_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $pyme_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pyme">
<div id="gmp_pyme" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($pyme_list->TotalRecs > 0 || $pyme->isGridEdit()) { ?>
<table id="tbl_pymelist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$pyme_list->RowType = ROWTYPE_HEADER;

// Render list options
$pyme_list->renderListOptions();

// Render list options (header, left)
$pyme_list->ListOptions->render("header", "left");
?>
<?php if ($pyme->rfcpyme->Visible) { // rfcpyme ?>
	<?php if ($pyme->sortUrl($pyme->rfcpyme) == "") { ?>
		<th data-name="rfcpyme" class="<?php echo $pyme->rfcpyme->headerCellClass() ?>"><div id="elh_pyme_rfcpyme" class="pyme_rfcpyme"><div class="ew-table-header-caption"><?php echo $pyme->rfcpyme->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rfcpyme" class="<?php echo $pyme->rfcpyme->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $pyme->SortUrl($pyme->rfcpyme) ?>',2);"><div id="elh_pyme_rfcpyme" class="pyme_rfcpyme">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pyme->rfcpyme->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($pyme->rfcpyme->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($pyme->rfcpyme->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pyme->id_pyme->Visible) { // id_pyme ?>
	<?php if ($pyme->sortUrl($pyme->id_pyme) == "") { ?>
		<th data-name="id_pyme" class="<?php echo $pyme->id_pyme->headerCellClass() ?>"><div id="elh_pyme_id_pyme" class="pyme_id_pyme"><div class="ew-table-header-caption"><?php echo $pyme->id_pyme->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_pyme" class="<?php echo $pyme->id_pyme->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $pyme->SortUrl($pyme->id_pyme) ?>',2);"><div id="elh_pyme_id_pyme" class="pyme_id_pyme">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pyme->id_pyme->caption() ?></span><span class="ew-table-header-sort"><?php if ($pyme->id_pyme->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($pyme->id_pyme->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pyme->razon_social->Visible) { // razon_social ?>
	<?php if ($pyme->sortUrl($pyme->razon_social) == "") { ?>
		<th data-name="razon_social" class="<?php echo $pyme->razon_social->headerCellClass() ?>"><div id="elh_pyme_razon_social" class="pyme_razon_social"><div class="ew-table-header-caption"><?php echo $pyme->razon_social->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="razon_social" class="<?php echo $pyme->razon_social->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $pyme->SortUrl($pyme->razon_social) ?>',2);"><div id="elh_pyme_razon_social" class="pyme_razon_social">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pyme->razon_social->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($pyme->razon_social->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($pyme->razon_social->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pyme->calle->Visible) { // calle ?>
	<?php if ($pyme->sortUrl($pyme->calle) == "") { ?>
		<th data-name="calle" class="<?php echo $pyme->calle->headerCellClass() ?>"><div id="elh_pyme_calle" class="pyme_calle"><div class="ew-table-header-caption"><?php echo $pyme->calle->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="calle" class="<?php echo $pyme->calle->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $pyme->SortUrl($pyme->calle) ?>',2);"><div id="elh_pyme_calle" class="pyme_calle">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pyme->calle->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($pyme->calle->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($pyme->calle->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pyme->colonia->Visible) { // colonia ?>
	<?php if ($pyme->sortUrl($pyme->colonia) == "") { ?>
		<th data-name="colonia" class="<?php echo $pyme->colonia->headerCellClass() ?>"><div id="elh_pyme_colonia" class="pyme_colonia"><div class="ew-table-header-caption"><?php echo $pyme->colonia->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="colonia" class="<?php echo $pyme->colonia->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $pyme->SortUrl($pyme->colonia) ?>',2);"><div id="elh_pyme_colonia" class="pyme_colonia">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pyme->colonia->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($pyme->colonia->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($pyme->colonia->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pyme->ciudad->Visible) { // ciudad ?>
	<?php if ($pyme->sortUrl($pyme->ciudad) == "") { ?>
		<th data-name="ciudad" class="<?php echo $pyme->ciudad->headerCellClass() ?>"><div id="elh_pyme_ciudad" class="pyme_ciudad"><div class="ew-table-header-caption"><?php echo $pyme->ciudad->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ciudad" class="<?php echo $pyme->ciudad->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $pyme->SortUrl($pyme->ciudad) ?>',2);"><div id="elh_pyme_ciudad" class="pyme_ciudad">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pyme->ciudad->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($pyme->ciudad->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($pyme->ciudad->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pyme->codpostal->Visible) { // codpostal ?>
	<?php if ($pyme->sortUrl($pyme->codpostal) == "") { ?>
		<th data-name="codpostal" class="<?php echo $pyme->codpostal->headerCellClass() ?>"><div id="elh_pyme_codpostal" class="pyme_codpostal"><div class="ew-table-header-caption"><?php echo $pyme->codpostal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="codpostal" class="<?php echo $pyme->codpostal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $pyme->SortUrl($pyme->codpostal) ?>',2);"><div id="elh_pyme_codpostal" class="pyme_codpostal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pyme->codpostal->caption() ?></span><span class="ew-table-header-sort"><?php if ($pyme->codpostal->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($pyme->codpostal->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pyme->correo->Visible) { // correo ?>
	<?php if ($pyme->sortUrl($pyme->correo) == "") { ?>
		<th data-name="correo" class="<?php echo $pyme->correo->headerCellClass() ?>"><div id="elh_pyme_correo" class="pyme_correo"><div class="ew-table-header-caption"><?php echo $pyme->correo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="correo" class="<?php echo $pyme->correo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $pyme->SortUrl($pyme->correo) ?>',2);"><div id="elh_pyme_correo" class="pyme_correo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pyme->correo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($pyme->correo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($pyme->correo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pyme->telefono->Visible) { // telefono ?>
	<?php if ($pyme->sortUrl($pyme->telefono) == "") { ?>
		<th data-name="telefono" class="<?php echo $pyme->telefono->headerCellClass() ?>"><div id="elh_pyme_telefono" class="pyme_telefono"><div class="ew-table-header-caption"><?php echo $pyme->telefono->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="telefono" class="<?php echo $pyme->telefono->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $pyme->SortUrl($pyme->telefono) ?>',2);"><div id="elh_pyme_telefono" class="pyme_telefono">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pyme->telefono->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($pyme->telefono->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($pyme->telefono->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pyme->pais->Visible) { // pais ?>
	<?php if ($pyme->sortUrl($pyme->pais) == "") { ?>
		<th data-name="pais" class="<?php echo $pyme->pais->headerCellClass() ?>"><div id="elh_pyme_pais" class="pyme_pais"><div class="ew-table-header-caption"><?php echo $pyme->pais->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pais" class="<?php echo $pyme->pais->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $pyme->SortUrl($pyme->pais) ?>',2);"><div id="elh_pyme_pais" class="pyme_pais">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pyme->pais->caption() ?></span><span class="ew-table-header-sort"><?php if ($pyme->pais->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($pyme->pais->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pyme->preafiliacion->Visible) { // preafiliacion ?>
	<?php if ($pyme->sortUrl($pyme->preafiliacion) == "") { ?>
		<th data-name="preafiliacion" class="<?php echo $pyme->preafiliacion->headerCellClass() ?>"><div id="elh_pyme_preafiliacion" class="pyme_preafiliacion"><div class="ew-table-header-caption"><?php echo $pyme->preafiliacion->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="preafiliacion" class="<?php echo $pyme->preafiliacion->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $pyme->SortUrl($pyme->preafiliacion) ?>',2);"><div id="elh_pyme_preafiliacion" class="pyme_preafiliacion">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pyme->preafiliacion->caption() ?></span><span class="ew-table-header-sort"><?php if ($pyme->preafiliacion->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($pyme->preafiliacion->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pyme->edooperacionpyme->Visible) { // edooperacionpyme ?>
	<?php if ($pyme->sortUrl($pyme->edooperacionpyme) == "") { ?>
		<th data-name="edooperacionpyme" class="<?php echo $pyme->edooperacionpyme->headerCellClass() ?>"><div id="elh_pyme_edooperacionpyme" class="pyme_edooperacionpyme"><div class="ew-table-header-caption"><?php echo $pyme->edooperacionpyme->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="edooperacionpyme" class="<?php echo $pyme->edooperacionpyme->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $pyme->SortUrl($pyme->edooperacionpyme) ?>',2);"><div id="elh_pyme_edooperacionpyme" class="pyme_edooperacionpyme">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pyme->edooperacionpyme->caption() ?></span><span class="ew-table-header-sort"><?php if ($pyme->edooperacionpyme->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($pyme->edooperacionpyme->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pyme->compradorrfc->Visible) { // compradorrfc ?>
	<?php if ($pyme->sortUrl($pyme->compradorrfc) == "") { ?>
		<th data-name="compradorrfc" class="<?php echo $pyme->compradorrfc->headerCellClass() ?>"><div id="elh_pyme_compradorrfc" class="pyme_compradorrfc"><div class="ew-table-header-caption"><?php echo $pyme->compradorrfc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="compradorrfc" class="<?php echo $pyme->compradorrfc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $pyme->SortUrl($pyme->compradorrfc) ?>',2);"><div id="elh_pyme_compradorrfc" class="pyme_compradorrfc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pyme->compradorrfc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($pyme->compradorrfc->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($pyme->compradorrfc->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pyme->comprador->Visible) { // comprador ?>
	<?php if ($pyme->sortUrl($pyme->comprador) == "") { ?>
		<th data-name="comprador" class="<?php echo $pyme->comprador->headerCellClass() ?>"><div id="elh_pyme_comprador" class="pyme_comprador"><div class="ew-table-header-caption"><?php echo $pyme->comprador->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="comprador" class="<?php echo $pyme->comprador->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $pyme->SortUrl($pyme->comprador) ?>',2);"><div id="elh_pyme_comprador" class="pyme_comprador">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pyme->comprador->caption() ?></span><span class="ew-table-header-sort"><?php if ($pyme->comprador->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($pyme->comprador->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$pyme_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($pyme->ExportAll && $pyme->isExport()) {
	$pyme_list->StopRec = $pyme_list->TotalRecs;
} else {

	// Set the last record to display
	if ($pyme_list->TotalRecs > $pyme_list->StartRec + $pyme_list->DisplayRecs - 1)
		$pyme_list->StopRec = $pyme_list->StartRec + $pyme_list->DisplayRecs - 1;
	else
		$pyme_list->StopRec = $pyme_list->TotalRecs;
}
$pyme_list->RecCnt = $pyme_list->StartRec - 1;
if ($pyme_list->Recordset && !$pyme_list->Recordset->EOF) {
	$pyme_list->Recordset->moveFirst();
	$selectLimit = $pyme_list->UseSelectLimit;
	if (!$selectLimit && $pyme_list->StartRec > 1)
		$pyme_list->Recordset->move($pyme_list->StartRec - 1);
} elseif (!$pyme->AllowAddDeleteRow && $pyme_list->StopRec == 0) {
	$pyme_list->StopRec = $pyme->GridAddRowCount;
}

// Initialize aggregate
$pyme->RowType = ROWTYPE_AGGREGATEINIT;
$pyme->resetAttributes();
$pyme_list->renderRow();
while ($pyme_list->RecCnt < $pyme_list->StopRec) {
	$pyme_list->RecCnt++;
	if ($pyme_list->RecCnt >= $pyme_list->StartRec) {
		$pyme_list->RowCnt++;

		// Set up key count
		$pyme_list->KeyCount = $pyme_list->RowIndex;

		// Init row class and style
		$pyme->resetAttributes();
		$pyme->CssClass = "";
		if ($pyme->isGridAdd()) {
		} else {
			$pyme_list->loadRowValues($pyme_list->Recordset); // Load row values
		}
		$pyme->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$pyme->RowAttrs = array_merge($pyme->RowAttrs, array('data-rowindex'=>$pyme_list->RowCnt, 'id'=>'r' . $pyme_list->RowCnt . '_pyme', 'data-rowtype'=>$pyme->RowType));

		// Render row
		$pyme_list->renderRow();

		// Render list options
		$pyme_list->renderListOptions();
?>
	<tr<?php echo $pyme->rowAttributes() ?>>
<?php

// Render list options (body, left)
$pyme_list->ListOptions->render("body", "left", $pyme_list->RowCnt);
?>
	<?php if ($pyme->rfcpyme->Visible) { // rfcpyme ?>
		<td data-name="rfcpyme"<?php echo $pyme->rfcpyme->cellAttributes() ?>>
<span id="el<?php echo $pyme_list->RowCnt ?>_pyme_rfcpyme" class="pyme_rfcpyme">
<span<?php echo $pyme->rfcpyme->viewAttributes() ?>>
<?php echo $pyme->rfcpyme->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pyme->id_pyme->Visible) { // id_pyme ?>
		<td data-name="id_pyme"<?php echo $pyme->id_pyme->cellAttributes() ?>>
<span id="el<?php echo $pyme_list->RowCnt ?>_pyme_id_pyme" class="pyme_id_pyme">
<span<?php echo $pyme->id_pyme->viewAttributes() ?>>
<?php echo $pyme->id_pyme->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pyme->razon_social->Visible) { // razon_social ?>
		<td data-name="razon_social"<?php echo $pyme->razon_social->cellAttributes() ?>>
<span id="el<?php echo $pyme_list->RowCnt ?>_pyme_razon_social" class="pyme_razon_social">
<span<?php echo $pyme->razon_social->viewAttributes() ?>>
<?php echo $pyme->razon_social->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pyme->calle->Visible) { // calle ?>
		<td data-name="calle"<?php echo $pyme->calle->cellAttributes() ?>>
<span id="el<?php echo $pyme_list->RowCnt ?>_pyme_calle" class="pyme_calle">
<span<?php echo $pyme->calle->viewAttributes() ?>>
<?php echo $pyme->calle->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pyme->colonia->Visible) { // colonia ?>
		<td data-name="colonia"<?php echo $pyme->colonia->cellAttributes() ?>>
<span id="el<?php echo $pyme_list->RowCnt ?>_pyme_colonia" class="pyme_colonia">
<span<?php echo $pyme->colonia->viewAttributes() ?>>
<?php echo $pyme->colonia->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pyme->ciudad->Visible) { // ciudad ?>
		<td data-name="ciudad"<?php echo $pyme->ciudad->cellAttributes() ?>>
<span id="el<?php echo $pyme_list->RowCnt ?>_pyme_ciudad" class="pyme_ciudad">
<span<?php echo $pyme->ciudad->viewAttributes() ?>>
<?php echo $pyme->ciudad->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pyme->codpostal->Visible) { // codpostal ?>
		<td data-name="codpostal"<?php echo $pyme->codpostal->cellAttributes() ?>>
<span id="el<?php echo $pyme_list->RowCnt ?>_pyme_codpostal" class="pyme_codpostal">
<span<?php echo $pyme->codpostal->viewAttributes() ?>>
<?php echo $pyme->codpostal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pyme->correo->Visible) { // correo ?>
		<td data-name="correo"<?php echo $pyme->correo->cellAttributes() ?>>
<span id="el<?php echo $pyme_list->RowCnt ?>_pyme_correo" class="pyme_correo">
<span<?php echo $pyme->correo->viewAttributes() ?>>
<?php echo $pyme->correo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pyme->telefono->Visible) { // telefono ?>
		<td data-name="telefono"<?php echo $pyme->telefono->cellAttributes() ?>>
<span id="el<?php echo $pyme_list->RowCnt ?>_pyme_telefono" class="pyme_telefono">
<span<?php echo $pyme->telefono->viewAttributes() ?>>
<?php echo $pyme->telefono->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pyme->pais->Visible) { // pais ?>
		<td data-name="pais"<?php echo $pyme->pais->cellAttributes() ?>>
<span id="el<?php echo $pyme_list->RowCnt ?>_pyme_pais" class="pyme_pais">
<span<?php echo $pyme->pais->viewAttributes() ?>>
<?php echo $pyme->pais->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pyme->preafiliacion->Visible) { // preafiliacion ?>
		<td data-name="preafiliacion"<?php echo $pyme->preafiliacion->cellAttributes() ?>>
<span id="el<?php echo $pyme_list->RowCnt ?>_pyme_preafiliacion" class="pyme_preafiliacion">
<span<?php echo $pyme->preafiliacion->viewAttributes() ?>>
<?php echo $pyme->preafiliacion->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pyme->edooperacionpyme->Visible) { // edooperacionpyme ?>
		<td data-name="edooperacionpyme"<?php echo $pyme->edooperacionpyme->cellAttributes() ?>>
<span id="el<?php echo $pyme_list->RowCnt ?>_pyme_edooperacionpyme" class="pyme_edooperacionpyme">
<span<?php echo $pyme->edooperacionpyme->viewAttributes() ?>>
<?php echo $pyme->edooperacionpyme->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pyme->compradorrfc->Visible) { // compradorrfc ?>
		<td data-name="compradorrfc"<?php echo $pyme->compradorrfc->cellAttributes() ?>>
<span id="el<?php echo $pyme_list->RowCnt ?>_pyme_compradorrfc" class="pyme_compradorrfc">
<span<?php echo $pyme->compradorrfc->viewAttributes() ?>>
<?php echo $pyme->compradorrfc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pyme->comprador->Visible) { // comprador ?>
		<td data-name="comprador"<?php echo $pyme->comprador->cellAttributes() ?>>
<span id="el<?php echo $pyme_list->RowCnt ?>_pyme_comprador" class="pyme_comprador">
<span<?php echo $pyme->comprador->viewAttributes() ?>>
<?php echo $pyme->comprador->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$pyme_list->ListOptions->render("body", "right", $pyme_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$pyme->isGridAdd())
		$pyme_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$pyme->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($pyme_list->Recordset)
	$pyme_list->Recordset->Close();
?>
<?php if (!$pyme->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$pyme->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($pyme_list->Pager)) $pyme_list->Pager = new NumericPager($pyme_list->StartRec, $pyme_list->DisplayRecs, $pyme_list->TotalRecs, $pyme_list->RecRange, $pyme_list->AutoHidePager) ?>
<?php if ($pyme_list->Pager->RecordCount > 0 && $pyme_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($pyme_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $pyme_list->pageUrl() ?>start=<?php echo $pyme_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($pyme_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $pyme_list->pageUrl() ?>start=<?php echo $pyme_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($pyme_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $pyme_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($pyme_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $pyme_list->pageUrl() ?>start=<?php echo $pyme_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($pyme_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $pyme_list->pageUrl() ?>start=<?php echo $pyme_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($pyme_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $pyme_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $pyme_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $pyme_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $pyme_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($pyme_list->TotalRecs == 0 && !$pyme->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $pyme_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$pyme_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$pyme->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$pyme_list->terminate();
?>