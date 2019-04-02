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
$cestadosolicitud_list = new cestadosolicitud_list();

// Run the page
$cestadosolicitud_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cestadosolicitud_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$cestadosolicitud->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fcestadosolicitudlist = currentForm = new ew.Form("fcestadosolicitudlist", "list");
fcestadosolicitudlist.formKeyCountName = '<?php echo $cestadosolicitud_list->FormKeyCountName ?>';

// Form_CustomValidate event
fcestadosolicitudlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcestadosolicitudlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fcestadosolicitudlistsrch = currentSearchForm = new ew.Form("fcestadosolicitudlistsrch");

// Filters
fcestadosolicitudlistsrch.filterList = <?php echo $cestadosolicitud_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$cestadosolicitud->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($cestadosolicitud_list->TotalRecs > 0 && $cestadosolicitud_list->ExportOptions->visible()) { ?>
<?php $cestadosolicitud_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($cestadosolicitud_list->ImportOptions->visible()) { ?>
<?php $cestadosolicitud_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($cestadosolicitud_list->SearchOptions->visible()) { ?>
<?php $cestadosolicitud_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($cestadosolicitud_list->FilterOptions->visible()) { ?>
<?php $cestadosolicitud_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$cestadosolicitud_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$cestadosolicitud->isExport() && !$cestadosolicitud->CurrentAction) { ?>
<form name="fcestadosolicitudlistsrch" id="fcestadosolicitudlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($cestadosolicitud_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fcestadosolicitudlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="cestadosolicitud">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($cestadosolicitud_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($cestadosolicitud_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $cestadosolicitud_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($cestadosolicitud_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($cestadosolicitud_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($cestadosolicitud_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($cestadosolicitud_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $cestadosolicitud_list->showPageHeader(); ?>
<?php
$cestadosolicitud_list->showMessage();
?>
<?php if ($cestadosolicitud_list->TotalRecs > 0 || $cestadosolicitud->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($cestadosolicitud_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> cestadosolicitud">
<?php if (!$cestadosolicitud->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$cestadosolicitud->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($cestadosolicitud_list->Pager)) $cestadosolicitud_list->Pager = new NumericPager($cestadosolicitud_list->StartRec, $cestadosolicitud_list->DisplayRecs, $cestadosolicitud_list->TotalRecs, $cestadosolicitud_list->RecRange, $cestadosolicitud_list->AutoHidePager) ?>
<?php if ($cestadosolicitud_list->Pager->RecordCount > 0 && $cestadosolicitud_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($cestadosolicitud_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cestadosolicitud_list->pageUrl() ?>start=<?php echo $cestadosolicitud_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($cestadosolicitud_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cestadosolicitud_list->pageUrl() ?>start=<?php echo $cestadosolicitud_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($cestadosolicitud_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $cestadosolicitud_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($cestadosolicitud_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cestadosolicitud_list->pageUrl() ?>start=<?php echo $cestadosolicitud_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($cestadosolicitud_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cestadosolicitud_list->pageUrl() ?>start=<?php echo $cestadosolicitud_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($cestadosolicitud_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $cestadosolicitud_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $cestadosolicitud_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $cestadosolicitud_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cestadosolicitud_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcestadosolicitudlist" id="fcestadosolicitudlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($cestadosolicitud_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $cestadosolicitud_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cestadosolicitud">
<div id="gmp_cestadosolicitud" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($cestadosolicitud_list->TotalRecs > 0 || $cestadosolicitud->isGridEdit()) { ?>
<table id="tbl_cestadosolicitudlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$cestadosolicitud_list->RowType = ROWTYPE_HEADER;

// Render list options
$cestadosolicitud_list->renderListOptions();

// Render list options (header, left)
$cestadosolicitud_list->ListOptions->render("header", "left");
?>
<?php if ($cestadosolicitud->id_edosolicitud->Visible) { // id_edosolicitud ?>
	<?php if ($cestadosolicitud->sortUrl($cestadosolicitud->id_edosolicitud) == "") { ?>
		<th data-name="id_edosolicitud" class="<?php echo $cestadosolicitud->id_edosolicitud->headerCellClass() ?>"><div id="elh_cestadosolicitud_id_edosolicitud" class="cestadosolicitud_id_edosolicitud"><div class="ew-table-header-caption"><?php echo $cestadosolicitud->id_edosolicitud->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_edosolicitud" class="<?php echo $cestadosolicitud->id_edosolicitud->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cestadosolicitud->SortUrl($cestadosolicitud->id_edosolicitud) ?>',2);"><div id="elh_cestadosolicitud_id_edosolicitud" class="cestadosolicitud_id_edosolicitud">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cestadosolicitud->id_edosolicitud->caption() ?></span><span class="ew-table-header-sort"><?php if ($cestadosolicitud->id_edosolicitud->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cestadosolicitud->id_edosolicitud->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cestadosolicitud->descestadooperacion->Visible) { // descestadooperacion ?>
	<?php if ($cestadosolicitud->sortUrl($cestadosolicitud->descestadooperacion) == "") { ?>
		<th data-name="descestadooperacion" class="<?php echo $cestadosolicitud->descestadooperacion->headerCellClass() ?>"><div id="elh_cestadosolicitud_descestadooperacion" class="cestadosolicitud_descestadooperacion"><div class="ew-table-header-caption"><?php echo $cestadosolicitud->descestadooperacion->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="descestadooperacion" class="<?php echo $cestadosolicitud->descestadooperacion->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cestadosolicitud->SortUrl($cestadosolicitud->descestadooperacion) ?>',2);"><div id="elh_cestadosolicitud_descestadooperacion" class="cestadosolicitud_descestadooperacion">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cestadosolicitud->descestadooperacion->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cestadosolicitud->descestadooperacion->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cestadosolicitud->descestadooperacion->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$cestadosolicitud_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($cestadosolicitud->ExportAll && $cestadosolicitud->isExport()) {
	$cestadosolicitud_list->StopRec = $cestadosolicitud_list->TotalRecs;
} else {

	// Set the last record to display
	if ($cestadosolicitud_list->TotalRecs > $cestadosolicitud_list->StartRec + $cestadosolicitud_list->DisplayRecs - 1)
		$cestadosolicitud_list->StopRec = $cestadosolicitud_list->StartRec + $cestadosolicitud_list->DisplayRecs - 1;
	else
		$cestadosolicitud_list->StopRec = $cestadosolicitud_list->TotalRecs;
}
$cestadosolicitud_list->RecCnt = $cestadosolicitud_list->StartRec - 1;
if ($cestadosolicitud_list->Recordset && !$cestadosolicitud_list->Recordset->EOF) {
	$cestadosolicitud_list->Recordset->moveFirst();
	$selectLimit = $cestadosolicitud_list->UseSelectLimit;
	if (!$selectLimit && $cestadosolicitud_list->StartRec > 1)
		$cestadosolicitud_list->Recordset->move($cestadosolicitud_list->StartRec - 1);
} elseif (!$cestadosolicitud->AllowAddDeleteRow && $cestadosolicitud_list->StopRec == 0) {
	$cestadosolicitud_list->StopRec = $cestadosolicitud->GridAddRowCount;
}

// Initialize aggregate
$cestadosolicitud->RowType = ROWTYPE_AGGREGATEINIT;
$cestadosolicitud->resetAttributes();
$cestadosolicitud_list->renderRow();
while ($cestadosolicitud_list->RecCnt < $cestadosolicitud_list->StopRec) {
	$cestadosolicitud_list->RecCnt++;
	if ($cestadosolicitud_list->RecCnt >= $cestadosolicitud_list->StartRec) {
		$cestadosolicitud_list->RowCnt++;

		// Set up key count
		$cestadosolicitud_list->KeyCount = $cestadosolicitud_list->RowIndex;

		// Init row class and style
		$cestadosolicitud->resetAttributes();
		$cestadosolicitud->CssClass = "";
		if ($cestadosolicitud->isGridAdd()) {
		} else {
			$cestadosolicitud_list->loadRowValues($cestadosolicitud_list->Recordset); // Load row values
		}
		$cestadosolicitud->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$cestadosolicitud->RowAttrs = array_merge($cestadosolicitud->RowAttrs, array('data-rowindex'=>$cestadosolicitud_list->RowCnt, 'id'=>'r' . $cestadosolicitud_list->RowCnt . '_cestadosolicitud', 'data-rowtype'=>$cestadosolicitud->RowType));

		// Render row
		$cestadosolicitud_list->renderRow();

		// Render list options
		$cestadosolicitud_list->renderListOptions();
?>
	<tr<?php echo $cestadosolicitud->rowAttributes() ?>>
<?php

// Render list options (body, left)
$cestadosolicitud_list->ListOptions->render("body", "left", $cestadosolicitud_list->RowCnt);
?>
	<?php if ($cestadosolicitud->id_edosolicitud->Visible) { // id_edosolicitud ?>
		<td data-name="id_edosolicitud"<?php echo $cestadosolicitud->id_edosolicitud->cellAttributes() ?>>
<span id="el<?php echo $cestadosolicitud_list->RowCnt ?>_cestadosolicitud_id_edosolicitud" class="cestadosolicitud_id_edosolicitud">
<span<?php echo $cestadosolicitud->id_edosolicitud->viewAttributes() ?>>
<?php echo $cestadosolicitud->id_edosolicitud->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cestadosolicitud->descestadooperacion->Visible) { // descestadooperacion ?>
		<td data-name="descestadooperacion"<?php echo $cestadosolicitud->descestadooperacion->cellAttributes() ?>>
<span id="el<?php echo $cestadosolicitud_list->RowCnt ?>_cestadosolicitud_descestadooperacion" class="cestadosolicitud_descestadooperacion">
<span<?php echo $cestadosolicitud->descestadooperacion->viewAttributes() ?>>
<?php echo $cestadosolicitud->descestadooperacion->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cestadosolicitud_list->ListOptions->render("body", "right", $cestadosolicitud_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$cestadosolicitud->isGridAdd())
		$cestadosolicitud_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$cestadosolicitud->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($cestadosolicitud_list->Recordset)
	$cestadosolicitud_list->Recordset->Close();
?>
<?php if (!$cestadosolicitud->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$cestadosolicitud->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($cestadosolicitud_list->Pager)) $cestadosolicitud_list->Pager = new NumericPager($cestadosolicitud_list->StartRec, $cestadosolicitud_list->DisplayRecs, $cestadosolicitud_list->TotalRecs, $cestadosolicitud_list->RecRange, $cestadosolicitud_list->AutoHidePager) ?>
<?php if ($cestadosolicitud_list->Pager->RecordCount > 0 && $cestadosolicitud_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($cestadosolicitud_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cestadosolicitud_list->pageUrl() ?>start=<?php echo $cestadosolicitud_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($cestadosolicitud_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cestadosolicitud_list->pageUrl() ?>start=<?php echo $cestadosolicitud_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($cestadosolicitud_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $cestadosolicitud_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($cestadosolicitud_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cestadosolicitud_list->pageUrl() ?>start=<?php echo $cestadosolicitud_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($cestadosolicitud_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cestadosolicitud_list->pageUrl() ?>start=<?php echo $cestadosolicitud_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($cestadosolicitud_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $cestadosolicitud_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $cestadosolicitud_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $cestadosolicitud_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cestadosolicitud_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($cestadosolicitud_list->TotalRecs == 0 && !$cestadosolicitud->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $cestadosolicitud_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$cestadosolicitud_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$cestadosolicitud->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$cestadosolicitud_list->terminate();
?>