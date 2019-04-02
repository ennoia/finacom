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
$View1_list = new View1_list();

// Run the page
$View1_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$View1_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$View1->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fView1list = currentForm = new ew.Form("fView1list", "list");
fView1list.formKeyCountName = '<?php echo $View1_list->FormKeyCountName ?>';

// Form_CustomValidate event
fView1list.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fView1list.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fView1listsrch = currentSearchForm = new ew.Form("fView1listsrch");

// Filters
fView1listsrch.filterList = <?php echo $View1_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$View1->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($View1_list->TotalRecs > 0 && $View1_list->ExportOptions->visible()) { ?>
<?php $View1_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($View1_list->ImportOptions->visible()) { ?>
<?php $View1_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($View1_list->SearchOptions->visible()) { ?>
<?php $View1_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($View1_list->FilterOptions->visible()) { ?>
<?php $View1_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$View1_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$View1->isExport() && !$View1->CurrentAction) { ?>
<form name="fView1listsrch" id="fView1listsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($View1_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fView1listsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="View1">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($View1_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($View1_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $View1_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($View1_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($View1_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($View1_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($View1_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $View1_list->showPageHeader(); ?>
<?php
$View1_list->showMessage();
?>
<?php if ($View1_list->TotalRecs > 0 || $View1->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($View1_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> View1">
<?php if (!$View1->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$View1->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($View1_list->Pager)) $View1_list->Pager = new NumericPager($View1_list->StartRec, $View1_list->DisplayRecs, $View1_list->TotalRecs, $View1_list->RecRange, $View1_list->AutoHidePager) ?>
<?php if ($View1_list->Pager->RecordCount > 0 && $View1_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($View1_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $View1_list->pageUrl() ?>start=<?php echo $View1_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($View1_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $View1_list->pageUrl() ?>start=<?php echo $View1_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($View1_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $View1_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($View1_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $View1_list->pageUrl() ?>start=<?php echo $View1_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($View1_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $View1_list->pageUrl() ?>start=<?php echo $View1_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($View1_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $View1_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $View1_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $View1_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $View1_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fView1list" id="fView1list" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($View1_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $View1_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="View1">
<div id="gmp_View1" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($View1_list->TotalRecs > 0 || $View1->isGridEdit()) { ?>
<table id="tbl_View1list" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$View1_list->RowType = ROWTYPE_HEADER;

// Render list options
$View1_list->renderListOptions();

// Render list options (header, left)
$View1_list->ListOptions->render("header", "left");
?>
<?php if ($View1->rfcfactura->Visible) { // rfcfactura ?>
	<?php if ($View1->sortUrl($View1->rfcfactura) == "") { ?>
		<th data-name="rfcfactura" class="<?php echo $View1->rfcfactura->headerCellClass() ?>"><div id="elh_View1_rfcfactura" class="View1_rfcfactura"><div class="ew-table-header-caption"><?php echo $View1->rfcfactura->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rfcfactura" class="<?php echo $View1->rfcfactura->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $View1->SortUrl($View1->rfcfactura) ?>',2);"><div id="elh_View1_rfcfactura" class="View1_rfcfactura">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $View1->rfcfactura->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($View1->rfcfactura->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($View1->rfcfactura->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($View1->idfactura->Visible) { // idfactura ?>
	<?php if ($View1->sortUrl($View1->idfactura) == "") { ?>
		<th data-name="idfactura" class="<?php echo $View1->idfactura->headerCellClass() ?>"><div id="elh_View1_idfactura" class="View1_idfactura"><div class="ew-table-header-caption"><?php echo $View1->idfactura->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idfactura" class="<?php echo $View1->idfactura->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $View1->SortUrl($View1->idfactura) ?>',2);"><div id="elh_View1_idfactura" class="View1_idfactura">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $View1->idfactura->caption() ?></span><span class="ew-table-header-sort"><?php if ($View1->idfactura->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($View1->idfactura->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($View1->monto->Visible) { // monto ?>
	<?php if ($View1->sortUrl($View1->monto) == "") { ?>
		<th data-name="monto" class="<?php echo $View1->monto->headerCellClass() ?>"><div id="elh_View1_monto" class="View1_monto"><div class="ew-table-header-caption"><?php echo $View1->monto->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="monto" class="<?php echo $View1->monto->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $View1->SortUrl($View1->monto) ?>',2);"><div id="elh_View1_monto" class="View1_monto">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $View1->monto->caption() ?></span><span class="ew-table-header-sort"><?php if ($View1->monto->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($View1->monto->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($View1->estado_operacion->Visible) { // estado_operacion ?>
	<?php if ($View1->sortUrl($View1->estado_operacion) == "") { ?>
		<th data-name="estado_operacion" class="<?php echo $View1->estado_operacion->headerCellClass() ?>"><div id="elh_View1_estado_operacion" class="View1_estado_operacion"><div class="ew-table-header-caption"><?php echo $View1->estado_operacion->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estado_operacion" class="<?php echo $View1->estado_operacion->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $View1->SortUrl($View1->estado_operacion) ?>',2);"><div id="elh_View1_estado_operacion" class="View1_estado_operacion">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $View1->estado_operacion->caption() ?></span><span class="ew-table-header-sort"><?php if ($View1->estado_operacion->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($View1->estado_operacion->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($View1->pymerfc->Visible) { // pymerfc ?>
	<?php if ($View1->sortUrl($View1->pymerfc) == "") { ?>
		<th data-name="pymerfc" class="<?php echo $View1->pymerfc->headerCellClass() ?>"><div id="elh_View1_pymerfc" class="View1_pymerfc"><div class="ew-table-header-caption"><?php echo $View1->pymerfc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pymerfc" class="<?php echo $View1->pymerfc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $View1->SortUrl($View1->pymerfc) ?>',2);"><div id="elh_View1_pymerfc" class="View1_pymerfc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $View1->pymerfc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($View1->pymerfc->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($View1->pymerfc->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($View1->compradorfc->Visible) { // compradorfc ?>
	<?php if ($View1->sortUrl($View1->compradorfc) == "") { ?>
		<th data-name="compradorfc" class="<?php echo $View1->compradorfc->headerCellClass() ?>"><div id="elh_View1_compradorfc" class="View1_compradorfc"><div class="ew-table-header-caption"><?php echo $View1->compradorfc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="compradorfc" class="<?php echo $View1->compradorfc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $View1->SortUrl($View1->compradorfc) ?>',2);"><div id="elh_View1_compradorfc" class="View1_compradorfc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $View1->compradorfc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($View1->compradorfc->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($View1->compradorfc->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($View1->cadena->Visible) { // cadena ?>
	<?php if ($View1->sortUrl($View1->cadena) == "") { ?>
		<th data-name="cadena" class="<?php echo $View1->cadena->headerCellClass() ?>"><div id="elh_View1_cadena" class="View1_cadena"><div class="ew-table-header-caption"><?php echo $View1->cadena->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cadena" class="<?php echo $View1->cadena->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $View1->SortUrl($View1->cadena) ?>',2);"><div id="elh_View1_cadena" class="View1_cadena">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $View1->cadena->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($View1->cadena->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($View1->cadena->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($View1->vencimiento->Visible) { // vencimiento ?>
	<?php if ($View1->sortUrl($View1->vencimiento) == "") { ?>
		<th data-name="vencimiento" class="<?php echo $View1->vencimiento->headerCellClass() ?>"><div id="elh_View1_vencimiento" class="View1_vencimiento"><div class="ew-table-header-caption"><?php echo $View1->vencimiento->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="vencimiento" class="<?php echo $View1->vencimiento->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $View1->SortUrl($View1->vencimiento) ?>',2);"><div id="elh_View1_vencimiento" class="View1_vencimiento">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $View1->vencimiento->caption() ?></span><span class="ew-table-header-sort"><?php if ($View1->vencimiento->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($View1->vencimiento->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($View1->fondeadorfactura->Visible) { // fondeadorfactura ?>
	<?php if ($View1->sortUrl($View1->fondeadorfactura) == "") { ?>
		<th data-name="fondeadorfactura" class="<?php echo $View1->fondeadorfactura->headerCellClass() ?>"><div id="elh_View1_fondeadorfactura" class="View1_fondeadorfactura"><div class="ew-table-header-caption"><?php echo $View1->fondeadorfactura->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fondeadorfactura" class="<?php echo $View1->fondeadorfactura->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $View1->SortUrl($View1->fondeadorfactura) ?>',2);"><div id="elh_View1_fondeadorfactura" class="View1_fondeadorfactura">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $View1->fondeadorfactura->caption() ?></span><span class="ew-table-header-sort"><?php if ($View1->fondeadorfactura->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($View1->fondeadorfactura->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($View1->estatusfactura->Visible) { // estatusfactura ?>
	<?php if ($View1->sortUrl($View1->estatusfactura) == "") { ?>
		<th data-name="estatusfactura" class="<?php echo $View1->estatusfactura->headerCellClass() ?>"><div id="elh_View1_estatusfactura" class="View1_estatusfactura"><div class="ew-table-header-caption"><?php echo $View1->estatusfactura->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estatusfactura" class="<?php echo $View1->estatusfactura->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $View1->SortUrl($View1->estatusfactura) ?>',2);"><div id="elh_View1_estatusfactura" class="View1_estatusfactura">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $View1->estatusfactura->caption() ?></span><span class="ew-table-header-sort"><?php if ($View1->estatusfactura->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($View1->estatusfactura->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($View1->compradorid_comprador->Visible) { // compradorid_comprador ?>
	<?php if ($View1->sortUrl($View1->compradorid_comprador) == "") { ?>
		<th data-name="compradorid_comprador" class="<?php echo $View1->compradorid_comprador->headerCellClass() ?>"><div id="elh_View1_compradorid_comprador" class="View1_compradorid_comprador"><div class="ew-table-header-caption"><?php echo $View1->compradorid_comprador->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="compradorid_comprador" class="<?php echo $View1->compradorid_comprador->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $View1->SortUrl($View1->compradorid_comprador) ?>',2);"><div id="elh_View1_compradorid_comprador" class="View1_compradorid_comprador">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $View1->compradorid_comprador->caption() ?></span><span class="ew-table-header-sort"><?php if ($View1->compradorid_comprador->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($View1->compradorid_comprador->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($View1->fondeadorfacturaidfondeadorfact->Visible) { // fondeadorfacturaidfondeadorfact ?>
	<?php if ($View1->sortUrl($View1->fondeadorfacturaidfondeadorfact) == "") { ?>
		<th data-name="fondeadorfacturaidfondeadorfact" class="<?php echo $View1->fondeadorfacturaidfondeadorfact->headerCellClass() ?>"><div id="elh_View1_fondeadorfacturaidfondeadorfact" class="View1_fondeadorfacturaidfondeadorfact"><div class="ew-table-header-caption"><?php echo $View1->fondeadorfacturaidfondeadorfact->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fondeadorfacturaidfondeadorfact" class="<?php echo $View1->fondeadorfacturaidfondeadorfact->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $View1->SortUrl($View1->fondeadorfacturaidfondeadorfact) ?>',2);"><div id="elh_View1_fondeadorfacturaidfondeadorfact" class="View1_fondeadorfacturaidfondeadorfact">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $View1->fondeadorfacturaidfondeadorfact->caption() ?></span><span class="ew-table-header-sort"><?php if ($View1->fondeadorfacturaidfondeadorfact->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($View1->fondeadorfacturaidfondeadorfact->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$View1_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($View1->ExportAll && $View1->isExport()) {
	$View1_list->StopRec = $View1_list->TotalRecs;
} else {

	// Set the last record to display
	if ($View1_list->TotalRecs > $View1_list->StartRec + $View1_list->DisplayRecs - 1)
		$View1_list->StopRec = $View1_list->StartRec + $View1_list->DisplayRecs - 1;
	else
		$View1_list->StopRec = $View1_list->TotalRecs;
}
$View1_list->RecCnt = $View1_list->StartRec - 1;
if ($View1_list->Recordset && !$View1_list->Recordset->EOF) {
	$View1_list->Recordset->moveFirst();
	$selectLimit = $View1_list->UseSelectLimit;
	if (!$selectLimit && $View1_list->StartRec > 1)
		$View1_list->Recordset->move($View1_list->StartRec - 1);
} elseif (!$View1->AllowAddDeleteRow && $View1_list->StopRec == 0) {
	$View1_list->StopRec = $View1->GridAddRowCount;
}

// Initialize aggregate
$View1->RowType = ROWTYPE_AGGREGATEINIT;
$View1->resetAttributes();
$View1_list->renderRow();
while ($View1_list->RecCnt < $View1_list->StopRec) {
	$View1_list->RecCnt++;
	if ($View1_list->RecCnt >= $View1_list->StartRec) {
		$View1_list->RowCnt++;

		// Set up key count
		$View1_list->KeyCount = $View1_list->RowIndex;

		// Init row class and style
		$View1->resetAttributes();
		$View1->CssClass = "";
		if ($View1->isGridAdd()) {
		} else {
			$View1_list->loadRowValues($View1_list->Recordset); // Load row values
		}
		$View1->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$View1->RowAttrs = array_merge($View1->RowAttrs, array('data-rowindex'=>$View1_list->RowCnt, 'id'=>'r' . $View1_list->RowCnt . '_View1', 'data-rowtype'=>$View1->RowType));

		// Render row
		$View1_list->renderRow();

		// Render list options
		$View1_list->renderListOptions();
?>
	<tr<?php echo $View1->rowAttributes() ?>>
<?php

// Render list options (body, left)
$View1_list->ListOptions->render("body", "left", $View1_list->RowCnt);
?>
	<?php if ($View1->rfcfactura->Visible) { // rfcfactura ?>
		<td data-name="rfcfactura"<?php echo $View1->rfcfactura->cellAttributes() ?>>
<span id="el<?php echo $View1_list->RowCnt ?>_View1_rfcfactura" class="View1_rfcfactura">
<span<?php echo $View1->rfcfactura->viewAttributes() ?>>
<?php echo $View1->rfcfactura->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($View1->idfactura->Visible) { // idfactura ?>
		<td data-name="idfactura"<?php echo $View1->idfactura->cellAttributes() ?>>
<span id="el<?php echo $View1_list->RowCnt ?>_View1_idfactura" class="View1_idfactura">
<span<?php echo $View1->idfactura->viewAttributes() ?>>
<?php echo $View1->idfactura->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($View1->monto->Visible) { // monto ?>
		<td data-name="monto"<?php echo $View1->monto->cellAttributes() ?>>
<span id="el<?php echo $View1_list->RowCnt ?>_View1_monto" class="View1_monto">
<span<?php echo $View1->monto->viewAttributes() ?>>
<?php echo $View1->monto->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($View1->estado_operacion->Visible) { // estado_operacion ?>
		<td data-name="estado_operacion"<?php echo $View1->estado_operacion->cellAttributes() ?>>
<span id="el<?php echo $View1_list->RowCnt ?>_View1_estado_operacion" class="View1_estado_operacion">
<span<?php echo $View1->estado_operacion->viewAttributes() ?>>
<?php echo $View1->estado_operacion->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($View1->pymerfc->Visible) { // pymerfc ?>
		<td data-name="pymerfc"<?php echo $View1->pymerfc->cellAttributes() ?>>
<span id="el<?php echo $View1_list->RowCnt ?>_View1_pymerfc" class="View1_pymerfc">
<span<?php echo $View1->pymerfc->viewAttributes() ?>>
<?php echo $View1->pymerfc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($View1->compradorfc->Visible) { // compradorfc ?>
		<td data-name="compradorfc"<?php echo $View1->compradorfc->cellAttributes() ?>>
<span id="el<?php echo $View1_list->RowCnt ?>_View1_compradorfc" class="View1_compradorfc">
<span<?php echo $View1->compradorfc->viewAttributes() ?>>
<?php echo $View1->compradorfc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($View1->cadena->Visible) { // cadena ?>
		<td data-name="cadena"<?php echo $View1->cadena->cellAttributes() ?>>
<span id="el<?php echo $View1_list->RowCnt ?>_View1_cadena" class="View1_cadena">
<span<?php echo $View1->cadena->viewAttributes() ?>>
<?php echo $View1->cadena->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($View1->vencimiento->Visible) { // vencimiento ?>
		<td data-name="vencimiento"<?php echo $View1->vencimiento->cellAttributes() ?>>
<span id="el<?php echo $View1_list->RowCnt ?>_View1_vencimiento" class="View1_vencimiento">
<span<?php echo $View1->vencimiento->viewAttributes() ?>>
<?php echo $View1->vencimiento->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($View1->fondeadorfactura->Visible) { // fondeadorfactura ?>
		<td data-name="fondeadorfactura"<?php echo $View1->fondeadorfactura->cellAttributes() ?>>
<span id="el<?php echo $View1_list->RowCnt ?>_View1_fondeadorfactura" class="View1_fondeadorfactura">
<span<?php echo $View1->fondeadorfactura->viewAttributes() ?>>
<?php echo $View1->fondeadorfactura->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($View1->estatusfactura->Visible) { // estatusfactura ?>
		<td data-name="estatusfactura"<?php echo $View1->estatusfactura->cellAttributes() ?>>
<span id="el<?php echo $View1_list->RowCnt ?>_View1_estatusfactura" class="View1_estatusfactura">
<span<?php echo $View1->estatusfactura->viewAttributes() ?>>
<?php echo $View1->estatusfactura->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($View1->compradorid_comprador->Visible) { // compradorid_comprador ?>
		<td data-name="compradorid_comprador"<?php echo $View1->compradorid_comprador->cellAttributes() ?>>
<span id="el<?php echo $View1_list->RowCnt ?>_View1_compradorid_comprador" class="View1_compradorid_comprador">
<span<?php echo $View1->compradorid_comprador->viewAttributes() ?>>
<?php echo $View1->compradorid_comprador->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($View1->fondeadorfacturaidfondeadorfact->Visible) { // fondeadorfacturaidfondeadorfact ?>
		<td data-name="fondeadorfacturaidfondeadorfact"<?php echo $View1->fondeadorfacturaidfondeadorfact->cellAttributes() ?>>
<span id="el<?php echo $View1_list->RowCnt ?>_View1_fondeadorfacturaidfondeadorfact" class="View1_fondeadorfacturaidfondeadorfact">
<span<?php echo $View1->fondeadorfacturaidfondeadorfact->viewAttributes() ?>>
<?php echo $View1->fondeadorfacturaidfondeadorfact->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$View1_list->ListOptions->render("body", "right", $View1_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$View1->isGridAdd())
		$View1_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$View1->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($View1_list->Recordset)
	$View1_list->Recordset->Close();
?>
<?php if (!$View1->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$View1->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($View1_list->Pager)) $View1_list->Pager = new NumericPager($View1_list->StartRec, $View1_list->DisplayRecs, $View1_list->TotalRecs, $View1_list->RecRange, $View1_list->AutoHidePager) ?>
<?php if ($View1_list->Pager->RecordCount > 0 && $View1_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($View1_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $View1_list->pageUrl() ?>start=<?php echo $View1_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($View1_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $View1_list->pageUrl() ?>start=<?php echo $View1_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($View1_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $View1_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($View1_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $View1_list->pageUrl() ?>start=<?php echo $View1_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($View1_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $View1_list->pageUrl() ?>start=<?php echo $View1_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($View1_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $View1_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $View1_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $View1_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $View1_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($View1_list->TotalRecs == 0 && !$View1->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $View1_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$View1_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$View1->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$View1_list->terminate();
?>