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
$Facturas_Pyme_list = new Facturas_Pyme_list();

// Run the page
$Facturas_Pyme_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Facturas_Pyme_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$Facturas_Pyme->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fFacturas_Pymelist = currentForm = new ew.Form("fFacturas_Pymelist", "list");
fFacturas_Pymelist.formKeyCountName = '<?php echo $Facturas_Pyme_list->FormKeyCountName ?>';

// Form_CustomValidate event
fFacturas_Pymelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fFacturas_Pymelist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fFacturas_Pymelistsrch = currentSearchForm = new ew.Form("fFacturas_Pymelistsrch");

// Filters
fFacturas_Pymelistsrch.filterList = <?php echo $Facturas_Pyme_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$Facturas_Pyme->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Facturas_Pyme_list->TotalRecs > 0 && $Facturas_Pyme_list->ExportOptions->visible()) { ?>
<?php $Facturas_Pyme_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Facturas_Pyme_list->ImportOptions->visible()) { ?>
<?php $Facturas_Pyme_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Facturas_Pyme_list->SearchOptions->visible()) { ?>
<?php $Facturas_Pyme_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Facturas_Pyme_list->FilterOptions->visible()) { ?>
<?php $Facturas_Pyme_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$Facturas_Pyme_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$Facturas_Pyme->isExport() && !$Facturas_Pyme->CurrentAction) { ?>
<form name="fFacturas_Pymelistsrch" id="fFacturas_Pymelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($Facturas_Pyme_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fFacturas_Pymelistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="Facturas_Pyme">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($Facturas_Pyme_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($Facturas_Pyme_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $Facturas_Pyme_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($Facturas_Pyme_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($Facturas_Pyme_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($Facturas_Pyme_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($Facturas_Pyme_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $Facturas_Pyme_list->showPageHeader(); ?>
<?php
$Facturas_Pyme_list->showMessage();
?>
<?php if ($Facturas_Pyme_list->TotalRecs > 0 || $Facturas_Pyme->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Facturas_Pyme_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> Facturas_Pyme">
<?php if (!$Facturas_Pyme->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$Facturas_Pyme->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($Facturas_Pyme_list->Pager)) $Facturas_Pyme_list->Pager = new NumericPager($Facturas_Pyme_list->StartRec, $Facturas_Pyme_list->DisplayRecs, $Facturas_Pyme_list->TotalRecs, $Facturas_Pyme_list->RecRange, $Facturas_Pyme_list->AutoHidePager) ?>
<?php if ($Facturas_Pyme_list->Pager->RecordCount > 0 && $Facturas_Pyme_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($Facturas_Pyme_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $Facturas_Pyme_list->pageUrl() ?>start=<?php echo $Facturas_Pyme_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($Facturas_Pyme_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $Facturas_Pyme_list->pageUrl() ?>start=<?php echo $Facturas_Pyme_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($Facturas_Pyme_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $Facturas_Pyme_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($Facturas_Pyme_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $Facturas_Pyme_list->pageUrl() ?>start=<?php echo $Facturas_Pyme_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($Facturas_Pyme_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $Facturas_Pyme_list->pageUrl() ?>start=<?php echo $Facturas_Pyme_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($Facturas_Pyme_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $Facturas_Pyme_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $Facturas_Pyme_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $Facturas_Pyme_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Facturas_Pyme_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fFacturas_Pymelist" id="fFacturas_Pymelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Facturas_Pyme_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $Facturas_Pyme_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Facturas_Pyme">
<div id="gmp_Facturas_Pyme" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($Facturas_Pyme_list->TotalRecs > 0 || $Facturas_Pyme->isGridEdit()) { ?>
<table id="tbl_Facturas_Pymelist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$Facturas_Pyme_list->RowType = ROWTYPE_HEADER;

// Render list options
$Facturas_Pyme_list->renderListOptions();

// Render list options (header, left)
$Facturas_Pyme_list->ListOptions->render("header", "left");
?>
<?php if ($Facturas_Pyme->rfcfactura->Visible) { // rfcfactura ?>
	<?php if ($Facturas_Pyme->sortUrl($Facturas_Pyme->rfcfactura) == "") { ?>
		<th data-name="rfcfactura" class="<?php echo $Facturas_Pyme->rfcfactura->headerCellClass() ?>"><div id="elh_Facturas_Pyme_rfcfactura" class="Facturas_Pyme_rfcfactura"><div class="ew-table-header-caption"><?php echo $Facturas_Pyme->rfcfactura->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rfcfactura" class="<?php echo $Facturas_Pyme->rfcfactura->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $Facturas_Pyme->SortUrl($Facturas_Pyme->rfcfactura) ?>',2);"><div id="elh_Facturas_Pyme_rfcfactura" class="Facturas_Pyme_rfcfactura">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Facturas_Pyme->rfcfactura->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Facturas_Pyme->rfcfactura->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Facturas_Pyme->rfcfactura->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Facturas_Pyme->idfactura->Visible) { // idfactura ?>
	<?php if ($Facturas_Pyme->sortUrl($Facturas_Pyme->idfactura) == "") { ?>
		<th data-name="idfactura" class="<?php echo $Facturas_Pyme->idfactura->headerCellClass() ?>"><div id="elh_Facturas_Pyme_idfactura" class="Facturas_Pyme_idfactura"><div class="ew-table-header-caption"><?php echo $Facturas_Pyme->idfactura->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idfactura" class="<?php echo $Facturas_Pyme->idfactura->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $Facturas_Pyme->SortUrl($Facturas_Pyme->idfactura) ?>',2);"><div id="elh_Facturas_Pyme_idfactura" class="Facturas_Pyme_idfactura">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Facturas_Pyme->idfactura->caption() ?></span><span class="ew-table-header-sort"><?php if ($Facturas_Pyme->idfactura->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Facturas_Pyme->idfactura->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Facturas_Pyme->monto->Visible) { // monto ?>
	<?php if ($Facturas_Pyme->sortUrl($Facturas_Pyme->monto) == "") { ?>
		<th data-name="monto" class="<?php echo $Facturas_Pyme->monto->headerCellClass() ?>"><div id="elh_Facturas_Pyme_monto" class="Facturas_Pyme_monto"><div class="ew-table-header-caption"><?php echo $Facturas_Pyme->monto->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="monto" class="<?php echo $Facturas_Pyme->monto->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $Facturas_Pyme->SortUrl($Facturas_Pyme->monto) ?>',2);"><div id="elh_Facturas_Pyme_monto" class="Facturas_Pyme_monto">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Facturas_Pyme->monto->caption() ?></span><span class="ew-table-header-sort"><?php if ($Facturas_Pyme->monto->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Facturas_Pyme->monto->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Facturas_Pyme->estado_operacion->Visible) { // estado_operacion ?>
	<?php if ($Facturas_Pyme->sortUrl($Facturas_Pyme->estado_operacion) == "") { ?>
		<th data-name="estado_operacion" class="<?php echo $Facturas_Pyme->estado_operacion->headerCellClass() ?>"><div id="elh_Facturas_Pyme_estado_operacion" class="Facturas_Pyme_estado_operacion"><div class="ew-table-header-caption"><?php echo $Facturas_Pyme->estado_operacion->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estado_operacion" class="<?php echo $Facturas_Pyme->estado_operacion->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $Facturas_Pyme->SortUrl($Facturas_Pyme->estado_operacion) ?>',2);"><div id="elh_Facturas_Pyme_estado_operacion" class="Facturas_Pyme_estado_operacion">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Facturas_Pyme->estado_operacion->caption() ?></span><span class="ew-table-header-sort"><?php if ($Facturas_Pyme->estado_operacion->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Facturas_Pyme->estado_operacion->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Facturas_Pyme->pymerfc->Visible) { // pymerfc ?>
	<?php if ($Facturas_Pyme->sortUrl($Facturas_Pyme->pymerfc) == "") { ?>
		<th data-name="pymerfc" class="<?php echo $Facturas_Pyme->pymerfc->headerCellClass() ?>"><div id="elh_Facturas_Pyme_pymerfc" class="Facturas_Pyme_pymerfc"><div class="ew-table-header-caption"><?php echo $Facturas_Pyme->pymerfc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pymerfc" class="<?php echo $Facturas_Pyme->pymerfc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $Facturas_Pyme->SortUrl($Facturas_Pyme->pymerfc) ?>',2);"><div id="elh_Facturas_Pyme_pymerfc" class="Facturas_Pyme_pymerfc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Facturas_Pyme->pymerfc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Facturas_Pyme->pymerfc->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Facturas_Pyme->pymerfc->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Facturas_Pyme->compradorfc->Visible) { // compradorfc ?>
	<?php if ($Facturas_Pyme->sortUrl($Facturas_Pyme->compradorfc) == "") { ?>
		<th data-name="compradorfc" class="<?php echo $Facturas_Pyme->compradorfc->headerCellClass() ?>"><div id="elh_Facturas_Pyme_compradorfc" class="Facturas_Pyme_compradorfc"><div class="ew-table-header-caption"><?php echo $Facturas_Pyme->compradorfc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="compradorfc" class="<?php echo $Facturas_Pyme->compradorfc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $Facturas_Pyme->SortUrl($Facturas_Pyme->compradorfc) ?>',2);"><div id="elh_Facturas_Pyme_compradorfc" class="Facturas_Pyme_compradorfc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Facturas_Pyme->compradorfc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Facturas_Pyme->compradorfc->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Facturas_Pyme->compradorfc->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Facturas_Pyme->cadena->Visible) { // cadena ?>
	<?php if ($Facturas_Pyme->sortUrl($Facturas_Pyme->cadena) == "") { ?>
		<th data-name="cadena" class="<?php echo $Facturas_Pyme->cadena->headerCellClass() ?>"><div id="elh_Facturas_Pyme_cadena" class="Facturas_Pyme_cadena"><div class="ew-table-header-caption"><?php echo $Facturas_Pyme->cadena->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cadena" class="<?php echo $Facturas_Pyme->cadena->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $Facturas_Pyme->SortUrl($Facturas_Pyme->cadena) ?>',2);"><div id="elh_Facturas_Pyme_cadena" class="Facturas_Pyme_cadena">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Facturas_Pyme->cadena->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Facturas_Pyme->cadena->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Facturas_Pyme->cadena->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Facturas_Pyme->vencimiento->Visible) { // vencimiento ?>
	<?php if ($Facturas_Pyme->sortUrl($Facturas_Pyme->vencimiento) == "") { ?>
		<th data-name="vencimiento" class="<?php echo $Facturas_Pyme->vencimiento->headerCellClass() ?>"><div id="elh_Facturas_Pyme_vencimiento" class="Facturas_Pyme_vencimiento"><div class="ew-table-header-caption"><?php echo $Facturas_Pyme->vencimiento->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="vencimiento" class="<?php echo $Facturas_Pyme->vencimiento->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $Facturas_Pyme->SortUrl($Facturas_Pyme->vencimiento) ?>',2);"><div id="elh_Facturas_Pyme_vencimiento" class="Facturas_Pyme_vencimiento">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Facturas_Pyme->vencimiento->caption() ?></span><span class="ew-table-header-sort"><?php if ($Facturas_Pyme->vencimiento->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Facturas_Pyme->vencimiento->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Facturas_Pyme->fondeadorfactura->Visible) { // fondeadorfactura ?>
	<?php if ($Facturas_Pyme->sortUrl($Facturas_Pyme->fondeadorfactura) == "") { ?>
		<th data-name="fondeadorfactura" class="<?php echo $Facturas_Pyme->fondeadorfactura->headerCellClass() ?>"><div id="elh_Facturas_Pyme_fondeadorfactura" class="Facturas_Pyme_fondeadorfactura"><div class="ew-table-header-caption"><?php echo $Facturas_Pyme->fondeadorfactura->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fondeadorfactura" class="<?php echo $Facturas_Pyme->fondeadorfactura->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $Facturas_Pyme->SortUrl($Facturas_Pyme->fondeadorfactura) ?>',2);"><div id="elh_Facturas_Pyme_fondeadorfactura" class="Facturas_Pyme_fondeadorfactura">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Facturas_Pyme->fondeadorfactura->caption() ?></span><span class="ew-table-header-sort"><?php if ($Facturas_Pyme->fondeadorfactura->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Facturas_Pyme->fondeadorfactura->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Facturas_Pyme->estatusfactura->Visible) { // estatusfactura ?>
	<?php if ($Facturas_Pyme->sortUrl($Facturas_Pyme->estatusfactura) == "") { ?>
		<th data-name="estatusfactura" class="<?php echo $Facturas_Pyme->estatusfactura->headerCellClass() ?>"><div id="elh_Facturas_Pyme_estatusfactura" class="Facturas_Pyme_estatusfactura"><div class="ew-table-header-caption"><?php echo $Facturas_Pyme->estatusfactura->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estatusfactura" class="<?php echo $Facturas_Pyme->estatusfactura->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $Facturas_Pyme->SortUrl($Facturas_Pyme->estatusfactura) ?>',2);"><div id="elh_Facturas_Pyme_estatusfactura" class="Facturas_Pyme_estatusfactura">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Facturas_Pyme->estatusfactura->caption() ?></span><span class="ew-table-header-sort"><?php if ($Facturas_Pyme->estatusfactura->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Facturas_Pyme->estatusfactura->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Facturas_Pyme->compradorid_comprador->Visible) { // compradorid_comprador ?>
	<?php if ($Facturas_Pyme->sortUrl($Facturas_Pyme->compradorid_comprador) == "") { ?>
		<th data-name="compradorid_comprador" class="<?php echo $Facturas_Pyme->compradorid_comprador->headerCellClass() ?>"><div id="elh_Facturas_Pyme_compradorid_comprador" class="Facturas_Pyme_compradorid_comprador"><div class="ew-table-header-caption"><?php echo $Facturas_Pyme->compradorid_comprador->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="compradorid_comprador" class="<?php echo $Facturas_Pyme->compradorid_comprador->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $Facturas_Pyme->SortUrl($Facturas_Pyme->compradorid_comprador) ?>',2);"><div id="elh_Facturas_Pyme_compradorid_comprador" class="Facturas_Pyme_compradorid_comprador">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Facturas_Pyme->compradorid_comprador->caption() ?></span><span class="ew-table-header-sort"><?php if ($Facturas_Pyme->compradorid_comprador->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Facturas_Pyme->compradorid_comprador->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Facturas_Pyme->fondeadorfacturaidfondeadorfact->Visible) { // fondeadorfacturaidfondeadorfact ?>
	<?php if ($Facturas_Pyme->sortUrl($Facturas_Pyme->fondeadorfacturaidfondeadorfact) == "") { ?>
		<th data-name="fondeadorfacturaidfondeadorfact" class="<?php echo $Facturas_Pyme->fondeadorfacturaidfondeadorfact->headerCellClass() ?>"><div id="elh_Facturas_Pyme_fondeadorfacturaidfondeadorfact" class="Facturas_Pyme_fondeadorfacturaidfondeadorfact"><div class="ew-table-header-caption"><?php echo $Facturas_Pyme->fondeadorfacturaidfondeadorfact->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fondeadorfacturaidfondeadorfact" class="<?php echo $Facturas_Pyme->fondeadorfacturaidfondeadorfact->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $Facturas_Pyme->SortUrl($Facturas_Pyme->fondeadorfacturaidfondeadorfact) ?>',2);"><div id="elh_Facturas_Pyme_fondeadorfacturaidfondeadorfact" class="Facturas_Pyme_fondeadorfacturaidfondeadorfact">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Facturas_Pyme->fondeadorfacturaidfondeadorfact->caption() ?></span><span class="ew-table-header-sort"><?php if ($Facturas_Pyme->fondeadorfacturaidfondeadorfact->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Facturas_Pyme->fondeadorfacturaidfondeadorfact->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$Facturas_Pyme_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($Facturas_Pyme->ExportAll && $Facturas_Pyme->isExport()) {
	$Facturas_Pyme_list->StopRec = $Facturas_Pyme_list->TotalRecs;
} else {

	// Set the last record to display
	if ($Facturas_Pyme_list->TotalRecs > $Facturas_Pyme_list->StartRec + $Facturas_Pyme_list->DisplayRecs - 1)
		$Facturas_Pyme_list->StopRec = $Facturas_Pyme_list->StartRec + $Facturas_Pyme_list->DisplayRecs - 1;
	else
		$Facturas_Pyme_list->StopRec = $Facturas_Pyme_list->TotalRecs;
}
$Facturas_Pyme_list->RecCnt = $Facturas_Pyme_list->StartRec - 1;
if ($Facturas_Pyme_list->Recordset && !$Facturas_Pyme_list->Recordset->EOF) {
	$Facturas_Pyme_list->Recordset->moveFirst();
	$selectLimit = $Facturas_Pyme_list->UseSelectLimit;
	if (!$selectLimit && $Facturas_Pyme_list->StartRec > 1)
		$Facturas_Pyme_list->Recordset->move($Facturas_Pyme_list->StartRec - 1);
} elseif (!$Facturas_Pyme->AllowAddDeleteRow && $Facturas_Pyme_list->StopRec == 0) {
	$Facturas_Pyme_list->StopRec = $Facturas_Pyme->GridAddRowCount;
}

// Initialize aggregate
$Facturas_Pyme->RowType = ROWTYPE_AGGREGATEINIT;
$Facturas_Pyme->resetAttributes();
$Facturas_Pyme_list->renderRow();
while ($Facturas_Pyme_list->RecCnt < $Facturas_Pyme_list->StopRec) {
	$Facturas_Pyme_list->RecCnt++;
	if ($Facturas_Pyme_list->RecCnt >= $Facturas_Pyme_list->StartRec) {
		$Facturas_Pyme_list->RowCnt++;

		// Set up key count
		$Facturas_Pyme_list->KeyCount = $Facturas_Pyme_list->RowIndex;

		// Init row class and style
		$Facturas_Pyme->resetAttributes();
		$Facturas_Pyme->CssClass = "";
		if ($Facturas_Pyme->isGridAdd()) {
		} else {
			$Facturas_Pyme_list->loadRowValues($Facturas_Pyme_list->Recordset); // Load row values
		}
		$Facturas_Pyme->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$Facturas_Pyme->RowAttrs = array_merge($Facturas_Pyme->RowAttrs, array('data-rowindex'=>$Facturas_Pyme_list->RowCnt, 'id'=>'r' . $Facturas_Pyme_list->RowCnt . '_Facturas_Pyme', 'data-rowtype'=>$Facturas_Pyme->RowType));

		// Render row
		$Facturas_Pyme_list->renderRow();

		// Render list options
		$Facturas_Pyme_list->renderListOptions();
?>
	<tr<?php echo $Facturas_Pyme->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Facturas_Pyme_list->ListOptions->render("body", "left", $Facturas_Pyme_list->RowCnt);
?>
	<?php if ($Facturas_Pyme->rfcfactura->Visible) { // rfcfactura ?>
		<td data-name="rfcfactura"<?php echo $Facturas_Pyme->rfcfactura->cellAttributes() ?>>
<span id="el<?php echo $Facturas_Pyme_list->RowCnt ?>_Facturas_Pyme_rfcfactura" class="Facturas_Pyme_rfcfactura">
<span<?php echo $Facturas_Pyme->rfcfactura->viewAttributes() ?>>
<?php echo $Facturas_Pyme->rfcfactura->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Facturas_Pyme->idfactura->Visible) { // idfactura ?>
		<td data-name="idfactura"<?php echo $Facturas_Pyme->idfactura->cellAttributes() ?>>
<span id="el<?php echo $Facturas_Pyme_list->RowCnt ?>_Facturas_Pyme_idfactura" class="Facturas_Pyme_idfactura">
<span<?php echo $Facturas_Pyme->idfactura->viewAttributes() ?>>
<?php echo $Facturas_Pyme->idfactura->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Facturas_Pyme->monto->Visible) { // monto ?>
		<td data-name="monto"<?php echo $Facturas_Pyme->monto->cellAttributes() ?>>
<span id="el<?php echo $Facturas_Pyme_list->RowCnt ?>_Facturas_Pyme_monto" class="Facturas_Pyme_monto">
<span<?php echo $Facturas_Pyme->monto->viewAttributes() ?>>
<?php echo $Facturas_Pyme->monto->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Facturas_Pyme->estado_operacion->Visible) { // estado_operacion ?>
		<td data-name="estado_operacion"<?php echo $Facturas_Pyme->estado_operacion->cellAttributes() ?>>
<span id="el<?php echo $Facturas_Pyme_list->RowCnt ?>_Facturas_Pyme_estado_operacion" class="Facturas_Pyme_estado_operacion">
<span<?php echo $Facturas_Pyme->estado_operacion->viewAttributes() ?>>
<?php echo $Facturas_Pyme->estado_operacion->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Facturas_Pyme->pymerfc->Visible) { // pymerfc ?>
		<td data-name="pymerfc"<?php echo $Facturas_Pyme->pymerfc->cellAttributes() ?>>
<span id="el<?php echo $Facturas_Pyme_list->RowCnt ?>_Facturas_Pyme_pymerfc" class="Facturas_Pyme_pymerfc">
<span<?php echo $Facturas_Pyme->pymerfc->viewAttributes() ?>>
<?php echo $Facturas_Pyme->pymerfc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Facturas_Pyme->compradorfc->Visible) { // compradorfc ?>
		<td data-name="compradorfc"<?php echo $Facturas_Pyme->compradorfc->cellAttributes() ?>>
<span id="el<?php echo $Facturas_Pyme_list->RowCnt ?>_Facturas_Pyme_compradorfc" class="Facturas_Pyme_compradorfc">
<span<?php echo $Facturas_Pyme->compradorfc->viewAttributes() ?>>
<?php echo $Facturas_Pyme->compradorfc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Facturas_Pyme->cadena->Visible) { // cadena ?>
		<td data-name="cadena"<?php echo $Facturas_Pyme->cadena->cellAttributes() ?>>
<span id="el<?php echo $Facturas_Pyme_list->RowCnt ?>_Facturas_Pyme_cadena" class="Facturas_Pyme_cadena">
<span<?php echo $Facturas_Pyme->cadena->viewAttributes() ?>>
<?php echo $Facturas_Pyme->cadena->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Facturas_Pyme->vencimiento->Visible) { // vencimiento ?>
		<td data-name="vencimiento"<?php echo $Facturas_Pyme->vencimiento->cellAttributes() ?>>
<span id="el<?php echo $Facturas_Pyme_list->RowCnt ?>_Facturas_Pyme_vencimiento" class="Facturas_Pyme_vencimiento">
<span<?php echo $Facturas_Pyme->vencimiento->viewAttributes() ?>>
<?php echo $Facturas_Pyme->vencimiento->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Facturas_Pyme->fondeadorfactura->Visible) { // fondeadorfactura ?>
		<td data-name="fondeadorfactura"<?php echo $Facturas_Pyme->fondeadorfactura->cellAttributes() ?>>
<span id="el<?php echo $Facturas_Pyme_list->RowCnt ?>_Facturas_Pyme_fondeadorfactura" class="Facturas_Pyme_fondeadorfactura">
<span<?php echo $Facturas_Pyme->fondeadorfactura->viewAttributes() ?>>
<?php echo $Facturas_Pyme->fondeadorfactura->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Facturas_Pyme->estatusfactura->Visible) { // estatusfactura ?>
		<td data-name="estatusfactura"<?php echo $Facturas_Pyme->estatusfactura->cellAttributes() ?>>
<span id="el<?php echo $Facturas_Pyme_list->RowCnt ?>_Facturas_Pyme_estatusfactura" class="Facturas_Pyme_estatusfactura">
<span<?php echo $Facturas_Pyme->estatusfactura->viewAttributes() ?>>
<?php echo $Facturas_Pyme->estatusfactura->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Facturas_Pyme->compradorid_comprador->Visible) { // compradorid_comprador ?>
		<td data-name="compradorid_comprador"<?php echo $Facturas_Pyme->compradorid_comprador->cellAttributes() ?>>
<span id="el<?php echo $Facturas_Pyme_list->RowCnt ?>_Facturas_Pyme_compradorid_comprador" class="Facturas_Pyme_compradorid_comprador">
<span<?php echo $Facturas_Pyme->compradorid_comprador->viewAttributes() ?>>
<?php echo $Facturas_Pyme->compradorid_comprador->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Facturas_Pyme->fondeadorfacturaidfondeadorfact->Visible) { // fondeadorfacturaidfondeadorfact ?>
		<td data-name="fondeadorfacturaidfondeadorfact"<?php echo $Facturas_Pyme->fondeadorfacturaidfondeadorfact->cellAttributes() ?>>
<span id="el<?php echo $Facturas_Pyme_list->RowCnt ?>_Facturas_Pyme_fondeadorfacturaidfondeadorfact" class="Facturas_Pyme_fondeadorfacturaidfondeadorfact">
<span<?php echo $Facturas_Pyme->fondeadorfacturaidfondeadorfact->viewAttributes() ?>>
<?php echo $Facturas_Pyme->fondeadorfacturaidfondeadorfact->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Facturas_Pyme_list->ListOptions->render("body", "right", $Facturas_Pyme_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$Facturas_Pyme->isGridAdd())
		$Facturas_Pyme_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$Facturas_Pyme->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($Facturas_Pyme_list->Recordset)
	$Facturas_Pyme_list->Recordset->Close();
?>
<?php if (!$Facturas_Pyme->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Facturas_Pyme->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($Facturas_Pyme_list->Pager)) $Facturas_Pyme_list->Pager = new NumericPager($Facturas_Pyme_list->StartRec, $Facturas_Pyme_list->DisplayRecs, $Facturas_Pyme_list->TotalRecs, $Facturas_Pyme_list->RecRange, $Facturas_Pyme_list->AutoHidePager) ?>
<?php if ($Facturas_Pyme_list->Pager->RecordCount > 0 && $Facturas_Pyme_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($Facturas_Pyme_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $Facturas_Pyme_list->pageUrl() ?>start=<?php echo $Facturas_Pyme_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($Facturas_Pyme_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $Facturas_Pyme_list->pageUrl() ?>start=<?php echo $Facturas_Pyme_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($Facturas_Pyme_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $Facturas_Pyme_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($Facturas_Pyme_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $Facturas_Pyme_list->pageUrl() ?>start=<?php echo $Facturas_Pyme_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($Facturas_Pyme_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $Facturas_Pyme_list->pageUrl() ?>start=<?php echo $Facturas_Pyme_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($Facturas_Pyme_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $Facturas_Pyme_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $Facturas_Pyme_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $Facturas_Pyme_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Facturas_Pyme_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Facturas_Pyme_list->TotalRecs == 0 && !$Facturas_Pyme->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Facturas_Pyme_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$Facturas_Pyme_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$Facturas_Pyme->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$Facturas_Pyme_list->terminate();
?>