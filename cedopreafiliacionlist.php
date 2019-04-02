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
$cedopreafiliacion_list = new cedopreafiliacion_list();

// Run the page
$cedopreafiliacion_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cedopreafiliacion_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$cedopreafiliacion->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fcedopreafiliacionlist = currentForm = new ew.Form("fcedopreafiliacionlist", "list");
fcedopreafiliacionlist.formKeyCountName = '<?php echo $cedopreafiliacion_list->FormKeyCountName ?>';

// Form_CustomValidate event
fcedopreafiliacionlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcedopreafiliacionlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fcedopreafiliacionlistsrch = currentSearchForm = new ew.Form("fcedopreafiliacionlistsrch");

// Filters
fcedopreafiliacionlistsrch.filterList = <?php echo $cedopreafiliacion_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$cedopreafiliacion->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($cedopreafiliacion_list->TotalRecs > 0 && $cedopreafiliacion_list->ExportOptions->visible()) { ?>
<?php $cedopreafiliacion_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($cedopreafiliacion_list->ImportOptions->visible()) { ?>
<?php $cedopreafiliacion_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($cedopreafiliacion_list->SearchOptions->visible()) { ?>
<?php $cedopreafiliacion_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($cedopreafiliacion_list->FilterOptions->visible()) { ?>
<?php $cedopreafiliacion_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$cedopreafiliacion_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$cedopreafiliacion->isExport() && !$cedopreafiliacion->CurrentAction) { ?>
<form name="fcedopreafiliacionlistsrch" id="fcedopreafiliacionlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($cedopreafiliacion_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fcedopreafiliacionlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="cedopreafiliacion">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($cedopreafiliacion_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($cedopreafiliacion_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $cedopreafiliacion_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($cedopreafiliacion_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($cedopreafiliacion_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($cedopreafiliacion_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($cedopreafiliacion_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $cedopreafiliacion_list->showPageHeader(); ?>
<?php
$cedopreafiliacion_list->showMessage();
?>
<?php if ($cedopreafiliacion_list->TotalRecs > 0 || $cedopreafiliacion->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($cedopreafiliacion_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> cedopreafiliacion">
<?php if (!$cedopreafiliacion->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$cedopreafiliacion->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($cedopreafiliacion_list->Pager)) $cedopreafiliacion_list->Pager = new NumericPager($cedopreafiliacion_list->StartRec, $cedopreafiliacion_list->DisplayRecs, $cedopreafiliacion_list->TotalRecs, $cedopreafiliacion_list->RecRange, $cedopreafiliacion_list->AutoHidePager) ?>
<?php if ($cedopreafiliacion_list->Pager->RecordCount > 0 && $cedopreafiliacion_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($cedopreafiliacion_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cedopreafiliacion_list->pageUrl() ?>start=<?php echo $cedopreafiliacion_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($cedopreafiliacion_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cedopreafiliacion_list->pageUrl() ?>start=<?php echo $cedopreafiliacion_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($cedopreafiliacion_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $cedopreafiliacion_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($cedopreafiliacion_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cedopreafiliacion_list->pageUrl() ?>start=<?php echo $cedopreafiliacion_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($cedopreafiliacion_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cedopreafiliacion_list->pageUrl() ?>start=<?php echo $cedopreafiliacion_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($cedopreafiliacion_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $cedopreafiliacion_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $cedopreafiliacion_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $cedopreafiliacion_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cedopreafiliacion_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcedopreafiliacionlist" id="fcedopreafiliacionlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($cedopreafiliacion_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $cedopreafiliacion_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cedopreafiliacion">
<div id="gmp_cedopreafiliacion" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($cedopreafiliacion_list->TotalRecs > 0 || $cedopreafiliacion->isGridEdit()) { ?>
<table id="tbl_cedopreafiliacionlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$cedopreafiliacion_list->RowType = ROWTYPE_HEADER;

// Render list options
$cedopreafiliacion_list->renderListOptions();

// Render list options (header, left)
$cedopreafiliacion_list->ListOptions->render("header", "left");
?>
<?php if ($cedopreafiliacion->id_edopreafiliado->Visible) { // id_edopreafiliado ?>
	<?php if ($cedopreafiliacion->sortUrl($cedopreafiliacion->id_edopreafiliado) == "") { ?>
		<th data-name="id_edopreafiliado" class="<?php echo $cedopreafiliacion->id_edopreafiliado->headerCellClass() ?>"><div id="elh_cedopreafiliacion_id_edopreafiliado" class="cedopreafiliacion_id_edopreafiliado"><div class="ew-table-header-caption"><?php echo $cedopreafiliacion->id_edopreafiliado->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_edopreafiliado" class="<?php echo $cedopreafiliacion->id_edopreafiliado->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cedopreafiliacion->SortUrl($cedopreafiliacion->id_edopreafiliado) ?>',2);"><div id="elh_cedopreafiliacion_id_edopreafiliado" class="cedopreafiliacion_id_edopreafiliado">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cedopreafiliacion->id_edopreafiliado->caption() ?></span><span class="ew-table-header-sort"><?php if ($cedopreafiliacion->id_edopreafiliado->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cedopreafiliacion->id_edopreafiliado->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cedopreafiliacion->descpreafiliado->Visible) { // descpreafiliado ?>
	<?php if ($cedopreafiliacion->sortUrl($cedopreafiliacion->descpreafiliado) == "") { ?>
		<th data-name="descpreafiliado" class="<?php echo $cedopreafiliacion->descpreafiliado->headerCellClass() ?>"><div id="elh_cedopreafiliacion_descpreafiliado" class="cedopreafiliacion_descpreafiliado"><div class="ew-table-header-caption"><?php echo $cedopreafiliacion->descpreafiliado->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="descpreafiliado" class="<?php echo $cedopreafiliacion->descpreafiliado->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cedopreafiliacion->SortUrl($cedopreafiliacion->descpreafiliado) ?>',2);"><div id="elh_cedopreafiliacion_descpreafiliado" class="cedopreafiliacion_descpreafiliado">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cedopreafiliacion->descpreafiliado->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cedopreafiliacion->descpreafiliado->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cedopreafiliacion->descpreafiliado->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$cedopreafiliacion_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($cedopreafiliacion->ExportAll && $cedopreafiliacion->isExport()) {
	$cedopreafiliacion_list->StopRec = $cedopreafiliacion_list->TotalRecs;
} else {

	// Set the last record to display
	if ($cedopreafiliacion_list->TotalRecs > $cedopreafiliacion_list->StartRec + $cedopreafiliacion_list->DisplayRecs - 1)
		$cedopreafiliacion_list->StopRec = $cedopreafiliacion_list->StartRec + $cedopreafiliacion_list->DisplayRecs - 1;
	else
		$cedopreafiliacion_list->StopRec = $cedopreafiliacion_list->TotalRecs;
}
$cedopreafiliacion_list->RecCnt = $cedopreafiliacion_list->StartRec - 1;
if ($cedopreafiliacion_list->Recordset && !$cedopreafiliacion_list->Recordset->EOF) {
	$cedopreafiliacion_list->Recordset->moveFirst();
	$selectLimit = $cedopreafiliacion_list->UseSelectLimit;
	if (!$selectLimit && $cedopreafiliacion_list->StartRec > 1)
		$cedopreafiliacion_list->Recordset->move($cedopreafiliacion_list->StartRec - 1);
} elseif (!$cedopreafiliacion->AllowAddDeleteRow && $cedopreafiliacion_list->StopRec == 0) {
	$cedopreafiliacion_list->StopRec = $cedopreafiliacion->GridAddRowCount;
}

// Initialize aggregate
$cedopreafiliacion->RowType = ROWTYPE_AGGREGATEINIT;
$cedopreafiliacion->resetAttributes();
$cedopreafiliacion_list->renderRow();
while ($cedopreafiliacion_list->RecCnt < $cedopreafiliacion_list->StopRec) {
	$cedopreafiliacion_list->RecCnt++;
	if ($cedopreafiliacion_list->RecCnt >= $cedopreafiliacion_list->StartRec) {
		$cedopreafiliacion_list->RowCnt++;

		// Set up key count
		$cedopreafiliacion_list->KeyCount = $cedopreafiliacion_list->RowIndex;

		// Init row class and style
		$cedopreafiliacion->resetAttributes();
		$cedopreafiliacion->CssClass = "";
		if ($cedopreafiliacion->isGridAdd()) {
		} else {
			$cedopreafiliacion_list->loadRowValues($cedopreafiliacion_list->Recordset); // Load row values
		}
		$cedopreafiliacion->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$cedopreafiliacion->RowAttrs = array_merge($cedopreafiliacion->RowAttrs, array('data-rowindex'=>$cedopreafiliacion_list->RowCnt, 'id'=>'r' . $cedopreafiliacion_list->RowCnt . '_cedopreafiliacion', 'data-rowtype'=>$cedopreafiliacion->RowType));

		// Render row
		$cedopreafiliacion_list->renderRow();

		// Render list options
		$cedopreafiliacion_list->renderListOptions();
?>
	<tr<?php echo $cedopreafiliacion->rowAttributes() ?>>
<?php

// Render list options (body, left)
$cedopreafiliacion_list->ListOptions->render("body", "left", $cedopreafiliacion_list->RowCnt);
?>
	<?php if ($cedopreafiliacion->id_edopreafiliado->Visible) { // id_edopreafiliado ?>
		<td data-name="id_edopreafiliado"<?php echo $cedopreafiliacion->id_edopreafiliado->cellAttributes() ?>>
<span id="el<?php echo $cedopreafiliacion_list->RowCnt ?>_cedopreafiliacion_id_edopreafiliado" class="cedopreafiliacion_id_edopreafiliado">
<span<?php echo $cedopreafiliacion->id_edopreafiliado->viewAttributes() ?>>
<?php echo $cedopreafiliacion->id_edopreafiliado->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cedopreafiliacion->descpreafiliado->Visible) { // descpreafiliado ?>
		<td data-name="descpreafiliado"<?php echo $cedopreafiliacion->descpreafiliado->cellAttributes() ?>>
<span id="el<?php echo $cedopreafiliacion_list->RowCnt ?>_cedopreafiliacion_descpreafiliado" class="cedopreafiliacion_descpreafiliado">
<span<?php echo $cedopreafiliacion->descpreafiliado->viewAttributes() ?>>
<?php echo $cedopreafiliacion->descpreafiliado->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cedopreafiliacion_list->ListOptions->render("body", "right", $cedopreafiliacion_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$cedopreafiliacion->isGridAdd())
		$cedopreafiliacion_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$cedopreafiliacion->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($cedopreafiliacion_list->Recordset)
	$cedopreafiliacion_list->Recordset->Close();
?>
<?php if (!$cedopreafiliacion->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$cedopreafiliacion->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($cedopreafiliacion_list->Pager)) $cedopreafiliacion_list->Pager = new NumericPager($cedopreafiliacion_list->StartRec, $cedopreafiliacion_list->DisplayRecs, $cedopreafiliacion_list->TotalRecs, $cedopreafiliacion_list->RecRange, $cedopreafiliacion_list->AutoHidePager) ?>
<?php if ($cedopreafiliacion_list->Pager->RecordCount > 0 && $cedopreafiliacion_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($cedopreafiliacion_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cedopreafiliacion_list->pageUrl() ?>start=<?php echo $cedopreafiliacion_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($cedopreafiliacion_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cedopreafiliacion_list->pageUrl() ?>start=<?php echo $cedopreafiliacion_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($cedopreafiliacion_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $cedopreafiliacion_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($cedopreafiliacion_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cedopreafiliacion_list->pageUrl() ?>start=<?php echo $cedopreafiliacion_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($cedopreafiliacion_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $cedopreafiliacion_list->pageUrl() ?>start=<?php echo $cedopreafiliacion_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($cedopreafiliacion_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $cedopreafiliacion_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $cedopreafiliacion_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $cedopreafiliacion_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cedopreafiliacion_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($cedopreafiliacion_list->TotalRecs == 0 && !$cedopreafiliacion->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $cedopreafiliacion_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$cedopreafiliacion_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$cedopreafiliacion->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$cedopreafiliacion_list->terminate();
?>