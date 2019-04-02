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
$fondeador_list = new fondeador_list();

// Run the page
$fondeador_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$fondeador_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$fondeador->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ffondeadorlist = currentForm = new ew.Form("ffondeadorlist", "list");
ffondeadorlist.formKeyCountName = '<?php echo $fondeador_list->FormKeyCountName ?>';

// Form_CustomValidate event
ffondeadorlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ffondeadorlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var ffondeadorlistsrch = currentSearchForm = new ew.Form("ffondeadorlistsrch");

// Filters
ffondeadorlistsrch.filterList = <?php echo $fondeador_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$fondeador->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($fondeador_list->TotalRecs > 0 && $fondeador_list->ExportOptions->visible()) { ?>
<?php $fondeador_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($fondeador_list->ImportOptions->visible()) { ?>
<?php $fondeador_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($fondeador_list->SearchOptions->visible()) { ?>
<?php $fondeador_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($fondeador_list->FilterOptions->visible()) { ?>
<?php $fondeador_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$fondeador_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$fondeador->isExport() && !$fondeador->CurrentAction) { ?>
<form name="ffondeadorlistsrch" id="ffondeadorlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($fondeador_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ffondeadorlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="fondeador">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($fondeador_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($fondeador_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $fondeador_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($fondeador_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($fondeador_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($fondeador_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($fondeador_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $fondeador_list->showPageHeader(); ?>
<?php
$fondeador_list->showMessage();
?>
<?php if ($fondeador_list->TotalRecs > 0 || $fondeador->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($fondeador_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> fondeador">
<?php if (!$fondeador->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$fondeador->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($fondeador_list->Pager)) $fondeador_list->Pager = new NumericPager($fondeador_list->StartRec, $fondeador_list->DisplayRecs, $fondeador_list->TotalRecs, $fondeador_list->RecRange, $fondeador_list->AutoHidePager) ?>
<?php if ($fondeador_list->Pager->RecordCount > 0 && $fondeador_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($fondeador_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $fondeador_list->pageUrl() ?>start=<?php echo $fondeador_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($fondeador_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $fondeador_list->pageUrl() ?>start=<?php echo $fondeador_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($fondeador_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $fondeador_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($fondeador_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $fondeador_list->pageUrl() ?>start=<?php echo $fondeador_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($fondeador_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $fondeador_list->pageUrl() ?>start=<?php echo $fondeador_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($fondeador_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $fondeador_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $fondeador_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $fondeador_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $fondeador_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ffondeadorlist" id="ffondeadorlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($fondeador_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $fondeador_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="fondeador">
<div id="gmp_fondeador" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($fondeador_list->TotalRecs > 0 || $fondeador->isGridEdit()) { ?>
<table id="tbl_fondeadorlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$fondeador_list->RowType = ROWTYPE_HEADER;

// Render list options
$fondeador_list->renderListOptions();

// Render list options (header, left)
$fondeador_list->ListOptions->render("header", "left");
?>
<?php if ($fondeador->id_fondeador->Visible) { // id_fondeador ?>
	<?php if ($fondeador->sortUrl($fondeador->id_fondeador) == "") { ?>
		<th data-name="id_fondeador" class="<?php echo $fondeador->id_fondeador->headerCellClass() ?>"><div id="elh_fondeador_id_fondeador" class="fondeador_id_fondeador"><div class="ew-table-header-caption"><?php echo $fondeador->id_fondeador->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_fondeador" class="<?php echo $fondeador->id_fondeador->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $fondeador->SortUrl($fondeador->id_fondeador) ?>',2);"><div id="elh_fondeador_id_fondeador" class="fondeador_id_fondeador">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fondeador->id_fondeador->caption() ?></span><span class="ew-table-header-sort"><?php if ($fondeador->id_fondeador->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($fondeador->id_fondeador->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($fondeador->rfcfondeador->Visible) { // rfcfondeador ?>
	<?php if ($fondeador->sortUrl($fondeador->rfcfondeador) == "") { ?>
		<th data-name="rfcfondeador" class="<?php echo $fondeador->rfcfondeador->headerCellClass() ?>"><div id="elh_fondeador_rfcfondeador" class="fondeador_rfcfondeador"><div class="ew-table-header-caption"><?php echo $fondeador->rfcfondeador->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rfcfondeador" class="<?php echo $fondeador->rfcfondeador->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $fondeador->SortUrl($fondeador->rfcfondeador) ?>',2);"><div id="elh_fondeador_rfcfondeador" class="fondeador_rfcfondeador">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fondeador->rfcfondeador->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($fondeador->rfcfondeador->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($fondeador->rfcfondeador->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($fondeador->razon_social->Visible) { // razon_social ?>
	<?php if ($fondeador->sortUrl($fondeador->razon_social) == "") { ?>
		<th data-name="razon_social" class="<?php echo $fondeador->razon_social->headerCellClass() ?>"><div id="elh_fondeador_razon_social" class="fondeador_razon_social"><div class="ew-table-header-caption"><?php echo $fondeador->razon_social->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="razon_social" class="<?php echo $fondeador->razon_social->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $fondeador->SortUrl($fondeador->razon_social) ?>',2);"><div id="elh_fondeador_razon_social" class="fondeador_razon_social">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fondeador->razon_social->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($fondeador->razon_social->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($fondeador->razon_social->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($fondeador->calle->Visible) { // calle ?>
	<?php if ($fondeador->sortUrl($fondeador->calle) == "") { ?>
		<th data-name="calle" class="<?php echo $fondeador->calle->headerCellClass() ?>"><div id="elh_fondeador_calle" class="fondeador_calle"><div class="ew-table-header-caption"><?php echo $fondeador->calle->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="calle" class="<?php echo $fondeador->calle->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $fondeador->SortUrl($fondeador->calle) ?>',2);"><div id="elh_fondeador_calle" class="fondeador_calle">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fondeador->calle->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($fondeador->calle->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($fondeador->calle->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($fondeador->colonia->Visible) { // colonia ?>
	<?php if ($fondeador->sortUrl($fondeador->colonia) == "") { ?>
		<th data-name="colonia" class="<?php echo $fondeador->colonia->headerCellClass() ?>"><div id="elh_fondeador_colonia" class="fondeador_colonia"><div class="ew-table-header-caption"><?php echo $fondeador->colonia->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="colonia" class="<?php echo $fondeador->colonia->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $fondeador->SortUrl($fondeador->colonia) ?>',2);"><div id="elh_fondeador_colonia" class="fondeador_colonia">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fondeador->colonia->caption() ?></span><span class="ew-table-header-sort"><?php if ($fondeador->colonia->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($fondeador->colonia->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($fondeador->ciudad->Visible) { // ciudad ?>
	<?php if ($fondeador->sortUrl($fondeador->ciudad) == "") { ?>
		<th data-name="ciudad" class="<?php echo $fondeador->ciudad->headerCellClass() ?>"><div id="elh_fondeador_ciudad" class="fondeador_ciudad"><div class="ew-table-header-caption"><?php echo $fondeador->ciudad->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ciudad" class="<?php echo $fondeador->ciudad->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $fondeador->SortUrl($fondeador->ciudad) ?>',2);"><div id="elh_fondeador_ciudad" class="fondeador_ciudad">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fondeador->ciudad->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($fondeador->ciudad->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($fondeador->ciudad->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($fondeador->codpostal->Visible) { // codpostal ?>
	<?php if ($fondeador->sortUrl($fondeador->codpostal) == "") { ?>
		<th data-name="codpostal" class="<?php echo $fondeador->codpostal->headerCellClass() ?>"><div id="elh_fondeador_codpostal" class="fondeador_codpostal"><div class="ew-table-header-caption"><?php echo $fondeador->codpostal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="codpostal" class="<?php echo $fondeador->codpostal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $fondeador->SortUrl($fondeador->codpostal) ?>',2);"><div id="elh_fondeador_codpostal" class="fondeador_codpostal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fondeador->codpostal->caption() ?></span><span class="ew-table-header-sort"><?php if ($fondeador->codpostal->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($fondeador->codpostal->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($fondeador->telefono->Visible) { // telefono ?>
	<?php if ($fondeador->sortUrl($fondeador->telefono) == "") { ?>
		<th data-name="telefono" class="<?php echo $fondeador->telefono->headerCellClass() ?>"><div id="elh_fondeador_telefono" class="fondeador_telefono"><div class="ew-table-header-caption"><?php echo $fondeador->telefono->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="telefono" class="<?php echo $fondeador->telefono->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $fondeador->SortUrl($fondeador->telefono) ?>',2);"><div id="elh_fondeador_telefono" class="fondeador_telefono">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fondeador->telefono->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($fondeador->telefono->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($fondeador->telefono->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($fondeador->correo->Visible) { // correo ?>
	<?php if ($fondeador->sortUrl($fondeador->correo) == "") { ?>
		<th data-name="correo" class="<?php echo $fondeador->correo->headerCellClass() ?>"><div id="elh_fondeador_correo" class="fondeador_correo"><div class="ew-table-header-caption"><?php echo $fondeador->correo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="correo" class="<?php echo $fondeador->correo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $fondeador->SortUrl($fondeador->correo) ?>',2);"><div id="elh_fondeador_correo" class="fondeador_correo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fondeador->correo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($fondeador->correo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($fondeador->correo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($fondeador->pais->Visible) { // pais ?>
	<?php if ($fondeador->sortUrl($fondeador->pais) == "") { ?>
		<th data-name="pais" class="<?php echo $fondeador->pais->headerCellClass() ?>"><div id="elh_fondeador_pais" class="fondeador_pais"><div class="ew-table-header-caption"><?php echo $fondeador->pais->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pais" class="<?php echo $fondeador->pais->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $fondeador->SortUrl($fondeador->pais) ?>',2);"><div id="elh_fondeador_pais" class="fondeador_pais">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fondeador->pais->caption() ?></span><span class="ew-table-header-sort"><?php if ($fondeador->pais->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($fondeador->pais->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($fondeador->fondeadorfactura->Visible) { // fondeadorfactura ?>
	<?php if ($fondeador->sortUrl($fondeador->fondeadorfactura) == "") { ?>
		<th data-name="fondeadorfactura" class="<?php echo $fondeador->fondeadorfactura->headerCellClass() ?>"><div id="elh_fondeador_fondeadorfactura" class="fondeador_fondeadorfactura"><div class="ew-table-header-caption"><?php echo $fondeador->fondeadorfactura->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fondeadorfactura" class="<?php echo $fondeador->fondeadorfactura->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $fondeador->SortUrl($fondeador->fondeadorfactura) ?>',2);"><div id="elh_fondeador_fondeadorfactura" class="fondeador_fondeadorfactura">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fondeador->fondeadorfactura->caption() ?></span><span class="ew-table-header-sort"><?php if ($fondeador->fondeadorfactura->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($fondeador->fondeadorfactura->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($fondeador->calificacion->Visible) { // calificacion ?>
	<?php if ($fondeador->sortUrl($fondeador->calificacion) == "") { ?>
		<th data-name="calificacion" class="<?php echo $fondeador->calificacion->headerCellClass() ?>"><div id="elh_fondeador_calificacion" class="fondeador_calificacion"><div class="ew-table-header-caption"><?php echo $fondeador->calificacion->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="calificacion" class="<?php echo $fondeador->calificacion->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $fondeador->SortUrl($fondeador->calificacion) ?>',2);"><div id="elh_fondeador_calificacion" class="fondeador_calificacion">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fondeador->calificacion->caption() ?></span><span class="ew-table-header-sort"><?php if ($fondeador->calificacion->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($fondeador->calificacion->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($fondeador->cedooperacionfondeador->Visible) { // cedooperacionfondeador ?>
	<?php if ($fondeador->sortUrl($fondeador->cedooperacionfondeador) == "") { ?>
		<th data-name="cedooperacionfondeador" class="<?php echo $fondeador->cedooperacionfondeador->headerCellClass() ?>"><div id="elh_fondeador_cedooperacionfondeador" class="fondeador_cedooperacionfondeador"><div class="ew-table-header-caption"><?php echo $fondeador->cedooperacionfondeador->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cedooperacionfondeador" class="<?php echo $fondeador->cedooperacionfondeador->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $fondeador->SortUrl($fondeador->cedooperacionfondeador) ?>',2);"><div id="elh_fondeador_cedooperacionfondeador" class="fondeador_cedooperacionfondeador">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fondeador->cedooperacionfondeador->caption() ?></span><span class="ew-table-header-sort"><?php if ($fondeador->cedooperacionfondeador->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($fondeador->cedooperacionfondeador->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($fondeador->pymerfc->Visible) { // pymerfc ?>
	<?php if ($fondeador->sortUrl($fondeador->pymerfc) == "") { ?>
		<th data-name="pymerfc" class="<?php echo $fondeador->pymerfc->headerCellClass() ?>"><div id="elh_fondeador_pymerfc" class="fondeador_pymerfc"><div class="ew-table-header-caption"><?php echo $fondeador->pymerfc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pymerfc" class="<?php echo $fondeador->pymerfc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $fondeador->SortUrl($fondeador->pymerfc) ?>',2);"><div id="elh_fondeador_pymerfc" class="fondeador_pymerfc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fondeador->pymerfc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($fondeador->pymerfc->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($fondeador->pymerfc->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$fondeador_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($fondeador->ExportAll && $fondeador->isExport()) {
	$fondeador_list->StopRec = $fondeador_list->TotalRecs;
} else {

	// Set the last record to display
	if ($fondeador_list->TotalRecs > $fondeador_list->StartRec + $fondeador_list->DisplayRecs - 1)
		$fondeador_list->StopRec = $fondeador_list->StartRec + $fondeador_list->DisplayRecs - 1;
	else
		$fondeador_list->StopRec = $fondeador_list->TotalRecs;
}
$fondeador_list->RecCnt = $fondeador_list->StartRec - 1;
if ($fondeador_list->Recordset && !$fondeador_list->Recordset->EOF) {
	$fondeador_list->Recordset->moveFirst();
	$selectLimit = $fondeador_list->UseSelectLimit;
	if (!$selectLimit && $fondeador_list->StartRec > 1)
		$fondeador_list->Recordset->move($fondeador_list->StartRec - 1);
} elseif (!$fondeador->AllowAddDeleteRow && $fondeador_list->StopRec == 0) {
	$fondeador_list->StopRec = $fondeador->GridAddRowCount;
}

// Initialize aggregate
$fondeador->RowType = ROWTYPE_AGGREGATEINIT;
$fondeador->resetAttributes();
$fondeador_list->renderRow();
while ($fondeador_list->RecCnt < $fondeador_list->StopRec) {
	$fondeador_list->RecCnt++;
	if ($fondeador_list->RecCnt >= $fondeador_list->StartRec) {
		$fondeador_list->RowCnt++;

		// Set up key count
		$fondeador_list->KeyCount = $fondeador_list->RowIndex;

		// Init row class and style
		$fondeador->resetAttributes();
		$fondeador->CssClass = "";
		if ($fondeador->isGridAdd()) {
		} else {
			$fondeador_list->loadRowValues($fondeador_list->Recordset); // Load row values
		}
		$fondeador->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$fondeador->RowAttrs = array_merge($fondeador->RowAttrs, array('data-rowindex'=>$fondeador_list->RowCnt, 'id'=>'r' . $fondeador_list->RowCnt . '_fondeador', 'data-rowtype'=>$fondeador->RowType));

		// Render row
		$fondeador_list->renderRow();

		// Render list options
		$fondeador_list->renderListOptions();
?>
	<tr<?php echo $fondeador->rowAttributes() ?>>
<?php

// Render list options (body, left)
$fondeador_list->ListOptions->render("body", "left", $fondeador_list->RowCnt);
?>
	<?php if ($fondeador->id_fondeador->Visible) { // id_fondeador ?>
		<td data-name="id_fondeador"<?php echo $fondeador->id_fondeador->cellAttributes() ?>>
<span id="el<?php echo $fondeador_list->RowCnt ?>_fondeador_id_fondeador" class="fondeador_id_fondeador">
<span<?php echo $fondeador->id_fondeador->viewAttributes() ?>>
<?php echo $fondeador->id_fondeador->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($fondeador->rfcfondeador->Visible) { // rfcfondeador ?>
		<td data-name="rfcfondeador"<?php echo $fondeador->rfcfondeador->cellAttributes() ?>>
<span id="el<?php echo $fondeador_list->RowCnt ?>_fondeador_rfcfondeador" class="fondeador_rfcfondeador">
<span<?php echo $fondeador->rfcfondeador->viewAttributes() ?>>
<?php echo $fondeador->rfcfondeador->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($fondeador->razon_social->Visible) { // razon_social ?>
		<td data-name="razon_social"<?php echo $fondeador->razon_social->cellAttributes() ?>>
<span id="el<?php echo $fondeador_list->RowCnt ?>_fondeador_razon_social" class="fondeador_razon_social">
<span<?php echo $fondeador->razon_social->viewAttributes() ?>>
<?php echo $fondeador->razon_social->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($fondeador->calle->Visible) { // calle ?>
		<td data-name="calle"<?php echo $fondeador->calle->cellAttributes() ?>>
<span id="el<?php echo $fondeador_list->RowCnt ?>_fondeador_calle" class="fondeador_calle">
<span<?php echo $fondeador->calle->viewAttributes() ?>>
<?php echo $fondeador->calle->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($fondeador->colonia->Visible) { // colonia ?>
		<td data-name="colonia"<?php echo $fondeador->colonia->cellAttributes() ?>>
<span id="el<?php echo $fondeador_list->RowCnt ?>_fondeador_colonia" class="fondeador_colonia">
<span<?php echo $fondeador->colonia->viewAttributes() ?>>
<?php echo $fondeador->colonia->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($fondeador->ciudad->Visible) { // ciudad ?>
		<td data-name="ciudad"<?php echo $fondeador->ciudad->cellAttributes() ?>>
<span id="el<?php echo $fondeador_list->RowCnt ?>_fondeador_ciudad" class="fondeador_ciudad">
<span<?php echo $fondeador->ciudad->viewAttributes() ?>>
<?php echo $fondeador->ciudad->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($fondeador->codpostal->Visible) { // codpostal ?>
		<td data-name="codpostal"<?php echo $fondeador->codpostal->cellAttributes() ?>>
<span id="el<?php echo $fondeador_list->RowCnt ?>_fondeador_codpostal" class="fondeador_codpostal">
<span<?php echo $fondeador->codpostal->viewAttributes() ?>>
<?php echo $fondeador->codpostal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($fondeador->telefono->Visible) { // telefono ?>
		<td data-name="telefono"<?php echo $fondeador->telefono->cellAttributes() ?>>
<span id="el<?php echo $fondeador_list->RowCnt ?>_fondeador_telefono" class="fondeador_telefono">
<span<?php echo $fondeador->telefono->viewAttributes() ?>>
<?php echo $fondeador->telefono->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($fondeador->correo->Visible) { // correo ?>
		<td data-name="correo"<?php echo $fondeador->correo->cellAttributes() ?>>
<span id="el<?php echo $fondeador_list->RowCnt ?>_fondeador_correo" class="fondeador_correo">
<span<?php echo $fondeador->correo->viewAttributes() ?>>
<?php echo $fondeador->correo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($fondeador->pais->Visible) { // pais ?>
		<td data-name="pais"<?php echo $fondeador->pais->cellAttributes() ?>>
<span id="el<?php echo $fondeador_list->RowCnt ?>_fondeador_pais" class="fondeador_pais">
<span<?php echo $fondeador->pais->viewAttributes() ?>>
<?php echo $fondeador->pais->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($fondeador->fondeadorfactura->Visible) { // fondeadorfactura ?>
		<td data-name="fondeadorfactura"<?php echo $fondeador->fondeadorfactura->cellAttributes() ?>>
<span id="el<?php echo $fondeador_list->RowCnt ?>_fondeador_fondeadorfactura" class="fondeador_fondeadorfactura">
<span<?php echo $fondeador->fondeadorfactura->viewAttributes() ?>>
<?php echo $fondeador->fondeadorfactura->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($fondeador->calificacion->Visible) { // calificacion ?>
		<td data-name="calificacion"<?php echo $fondeador->calificacion->cellAttributes() ?>>
<span id="el<?php echo $fondeador_list->RowCnt ?>_fondeador_calificacion" class="fondeador_calificacion">
<span<?php echo $fondeador->calificacion->viewAttributes() ?>>
<?php echo $fondeador->calificacion->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($fondeador->cedooperacionfondeador->Visible) { // cedooperacionfondeador ?>
		<td data-name="cedooperacionfondeador"<?php echo $fondeador->cedooperacionfondeador->cellAttributes() ?>>
<span id="el<?php echo $fondeador_list->RowCnt ?>_fondeador_cedooperacionfondeador" class="fondeador_cedooperacionfondeador">
<span<?php echo $fondeador->cedooperacionfondeador->viewAttributes() ?>>
<?php echo $fondeador->cedooperacionfondeador->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($fondeador->pymerfc->Visible) { // pymerfc ?>
		<td data-name="pymerfc"<?php echo $fondeador->pymerfc->cellAttributes() ?>>
<span id="el<?php echo $fondeador_list->RowCnt ?>_fondeador_pymerfc" class="fondeador_pymerfc">
<span<?php echo $fondeador->pymerfc->viewAttributes() ?>>
<?php echo $fondeador->pymerfc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$fondeador_list->ListOptions->render("body", "right", $fondeador_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$fondeador->isGridAdd())
		$fondeador_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$fondeador->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($fondeador_list->Recordset)
	$fondeador_list->Recordset->Close();
?>
<?php if (!$fondeador->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$fondeador->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($fondeador_list->Pager)) $fondeador_list->Pager = new NumericPager($fondeador_list->StartRec, $fondeador_list->DisplayRecs, $fondeador_list->TotalRecs, $fondeador_list->RecRange, $fondeador_list->AutoHidePager) ?>
<?php if ($fondeador_list->Pager->RecordCount > 0 && $fondeador_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($fondeador_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $fondeador_list->pageUrl() ?>start=<?php echo $fondeador_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($fondeador_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $fondeador_list->pageUrl() ?>start=<?php echo $fondeador_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($fondeador_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $fondeador_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($fondeador_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $fondeador_list->pageUrl() ?>start=<?php echo $fondeador_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($fondeador_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $fondeador_list->pageUrl() ?>start=<?php echo $fondeador_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($fondeador_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $fondeador_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $fondeador_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $fondeador_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $fondeador_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($fondeador_list->TotalRecs == 0 && !$fondeador->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $fondeador_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$fondeador_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$fondeador->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$fondeador_list->terminate();
?>