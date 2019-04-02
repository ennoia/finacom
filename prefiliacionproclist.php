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
$prefiliacionproc_list = new prefiliacionproc_list();

// Run the page
$prefiliacionproc_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$prefiliacionproc_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$prefiliacionproc->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fprefiliacionproclist = currentForm = new ew.Form("fprefiliacionproclist", "list");
fprefiliacionproclist.formKeyCountName = '<?php echo $prefiliacionproc_list->FormKeyCountName ?>';

// Form_CustomValidate event
fprefiliacionproclist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fprefiliacionproclist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fprefiliacionproclistsrch = currentSearchForm = new ew.Form("fprefiliacionproclistsrch");

// Filters
fprefiliacionproclistsrch.filterList = <?php echo $prefiliacionproc_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$prefiliacionproc->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($prefiliacionproc_list->TotalRecs > 0 && $prefiliacionproc_list->ExportOptions->visible()) { ?>
<?php $prefiliacionproc_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($prefiliacionproc_list->ImportOptions->visible()) { ?>
<?php $prefiliacionproc_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($prefiliacionproc_list->SearchOptions->visible()) { ?>
<?php $prefiliacionproc_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($prefiliacionproc_list->FilterOptions->visible()) { ?>
<?php $prefiliacionproc_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$prefiliacionproc_list->renderOtherOptions();
?>
<?php $prefiliacionproc_list->showPageHeader(); ?>
<?php
$prefiliacionproc_list->showMessage();
?>
<?php if ($prefiliacionproc_list->TotalRecs > 0 || $prefiliacionproc->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($prefiliacionproc_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> prefiliacionproc">
<?php if (!$prefiliacionproc->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$prefiliacionproc->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($prefiliacionproc_list->Pager)) $prefiliacionproc_list->Pager = new NumericPager($prefiliacionproc_list->StartRec, $prefiliacionproc_list->DisplayRecs, $prefiliacionproc_list->TotalRecs, $prefiliacionproc_list->RecRange, $prefiliacionproc_list->AutoHidePager) ?>
<?php if ($prefiliacionproc_list->Pager->RecordCount > 0 && $prefiliacionproc_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($prefiliacionproc_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $prefiliacionproc_list->pageUrl() ?>start=<?php echo $prefiliacionproc_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($prefiliacionproc_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $prefiliacionproc_list->pageUrl() ?>start=<?php echo $prefiliacionproc_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($prefiliacionproc_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $prefiliacionproc_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($prefiliacionproc_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $prefiliacionproc_list->pageUrl() ?>start=<?php echo $prefiliacionproc_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($prefiliacionproc_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $prefiliacionproc_list->pageUrl() ?>start=<?php echo $prefiliacionproc_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($prefiliacionproc_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $prefiliacionproc_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $prefiliacionproc_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $prefiliacionproc_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $prefiliacionproc_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fprefiliacionproclist" id="fprefiliacionproclist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($prefiliacionproc_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $prefiliacionproc_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="prefiliacionproc">
<div id="gmp_prefiliacionproc" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($prefiliacionproc_list->TotalRecs > 0 || $prefiliacionproc->isGridEdit()) { ?>
<table id="tbl_prefiliacionproclist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$prefiliacionproc_list->RowType = ROWTYPE_HEADER;

// Render list options
$prefiliacionproc_list->renderListOptions();

// Render list options (header, left)
$prefiliacionproc_list->ListOptions->render("header", "left");
?>
<?php if ($prefiliacionproc->oidarchivos->Visible) { // oidarchivos ?>
	<?php if ($prefiliacionproc->sortUrl($prefiliacionproc->oidarchivos) == "") { ?>
		<th data-name="oidarchivos" class="<?php echo $prefiliacionproc->oidarchivos->headerCellClass() ?>"><div id="elh_prefiliacionproc_oidarchivos" class="prefiliacionproc_oidarchivos"><div class="ew-table-header-caption"><?php echo $prefiliacionproc->oidarchivos->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="oidarchivos" class="<?php echo $prefiliacionproc->oidarchivos->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $prefiliacionproc->SortUrl($prefiliacionproc->oidarchivos) ?>',2);"><div id="elh_prefiliacionproc_oidarchivos" class="prefiliacionproc_oidarchivos">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $prefiliacionproc->oidarchivos->caption() ?></span><span class="ew-table-header-sort"><?php if ($prefiliacionproc->oidarchivos->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($prefiliacionproc->oidarchivos->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($prefiliacionproc->idrfccomprador->Visible) { // idrfccomprador ?>
	<?php if ($prefiliacionproc->sortUrl($prefiliacionproc->idrfccomprador) == "") { ?>
		<th data-name="idrfccomprador" class="<?php echo $prefiliacionproc->idrfccomprador->headerCellClass() ?>"><div id="elh_prefiliacionproc_idrfccomprador" class="prefiliacionproc_idrfccomprador"><div class="ew-table-header-caption"><?php echo $prefiliacionproc->idrfccomprador->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idrfccomprador" class="<?php echo $prefiliacionproc->idrfccomprador->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $prefiliacionproc->SortUrl($prefiliacionproc->idrfccomprador) ?>',2);"><div id="elh_prefiliacionproc_idrfccomprador" class="prefiliacionproc_idrfccomprador">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $prefiliacionproc->idrfccomprador->caption() ?></span><span class="ew-table-header-sort"><?php if ($prefiliacionproc->idrfccomprador->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($prefiliacionproc->idrfccomprador->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($prefiliacionproc->registros_totales->Visible) { // registros totales ?>
	<?php if ($prefiliacionproc->sortUrl($prefiliacionproc->registros_totales) == "") { ?>
		<th data-name="registros_totales" class="<?php echo $prefiliacionproc->registros_totales->headerCellClass() ?>"><div id="elh_prefiliacionproc_registros_totales" class="prefiliacionproc_registros_totales"><div class="ew-table-header-caption"><?php echo $prefiliacionproc->registros_totales->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="registros_totales" class="<?php echo $prefiliacionproc->registros_totales->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $prefiliacionproc->SortUrl($prefiliacionproc->registros_totales) ?>',2);"><div id="elh_prefiliacionproc_registros_totales" class="prefiliacionproc_registros_totales">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $prefiliacionproc->registros_totales->caption() ?></span><span class="ew-table-header-sort"><?php if ($prefiliacionproc->registros_totales->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($prefiliacionproc->registros_totales->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($prefiliacionproc->registros_validos->Visible) { // registros validos ?>
	<?php if ($prefiliacionproc->sortUrl($prefiliacionproc->registros_validos) == "") { ?>
		<th data-name="registros_validos" class="<?php echo $prefiliacionproc->registros_validos->headerCellClass() ?>"><div id="elh_prefiliacionproc_registros_validos" class="prefiliacionproc_registros_validos"><div class="ew-table-header-caption"><?php echo $prefiliacionproc->registros_validos->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="registros_validos" class="<?php echo $prefiliacionproc->registros_validos->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $prefiliacionproc->SortUrl($prefiliacionproc->registros_validos) ?>',2);"><div id="elh_prefiliacionproc_registros_validos" class="prefiliacionproc_registros_validos">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $prefiliacionproc->registros_validos->caption() ?></span><span class="ew-table-header-sort"><?php if ($prefiliacionproc->registros_validos->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($prefiliacionproc->registros_validos->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($prefiliacionproc->errores->Visible) { // errores ?>
	<?php if ($prefiliacionproc->sortUrl($prefiliacionproc->errores) == "") { ?>
		<th data-name="errores" class="<?php echo $prefiliacionproc->errores->headerCellClass() ?>"><div id="elh_prefiliacionproc_errores" class="prefiliacionproc_errores"><div class="ew-table-header-caption"><?php echo $prefiliacionproc->errores->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="errores" class="<?php echo $prefiliacionproc->errores->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $prefiliacionproc->SortUrl($prefiliacionproc->errores) ?>',2);"><div id="elh_prefiliacionproc_errores" class="prefiliacionproc_errores">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $prefiliacionproc->errores->caption() ?></span><span class="ew-table-header-sort"><?php if ($prefiliacionproc->errores->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($prefiliacionproc->errores->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$prefiliacionproc_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($prefiliacionproc->ExportAll && $prefiliacionproc->isExport()) {
	$prefiliacionproc_list->StopRec = $prefiliacionproc_list->TotalRecs;
} else {

	// Set the last record to display
	if ($prefiliacionproc_list->TotalRecs > $prefiliacionproc_list->StartRec + $prefiliacionproc_list->DisplayRecs - 1)
		$prefiliacionproc_list->StopRec = $prefiliacionproc_list->StartRec + $prefiliacionproc_list->DisplayRecs - 1;
	else
		$prefiliacionproc_list->StopRec = $prefiliacionproc_list->TotalRecs;
}
$prefiliacionproc_list->RecCnt = $prefiliacionproc_list->StartRec - 1;
if ($prefiliacionproc_list->Recordset && !$prefiliacionproc_list->Recordset->EOF) {
	$prefiliacionproc_list->Recordset->moveFirst();
	$selectLimit = $prefiliacionproc_list->UseSelectLimit;
	if (!$selectLimit && $prefiliacionproc_list->StartRec > 1)
		$prefiliacionproc_list->Recordset->move($prefiliacionproc_list->StartRec - 1);
} elseif (!$prefiliacionproc->AllowAddDeleteRow && $prefiliacionproc_list->StopRec == 0) {
	$prefiliacionproc_list->StopRec = $prefiliacionproc->GridAddRowCount;
}

// Initialize aggregate
$prefiliacionproc->RowType = ROWTYPE_AGGREGATEINIT;
$prefiliacionproc->resetAttributes();
$prefiliacionproc_list->renderRow();
while ($prefiliacionproc_list->RecCnt < $prefiliacionproc_list->StopRec) {
	$prefiliacionproc_list->RecCnt++;
	if ($prefiliacionproc_list->RecCnt >= $prefiliacionproc_list->StartRec) {
		$prefiliacionproc_list->RowCnt++;

		// Set up key count
		$prefiliacionproc_list->KeyCount = $prefiliacionproc_list->RowIndex;

		// Init row class and style
		$prefiliacionproc->resetAttributes();
		$prefiliacionproc->CssClass = "";
		if ($prefiliacionproc->isGridAdd()) {
		} else {
			$prefiliacionproc_list->loadRowValues($prefiliacionproc_list->Recordset); // Load row values
		}
		$prefiliacionproc->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$prefiliacionproc->RowAttrs = array_merge($prefiliacionproc->RowAttrs, array('data-rowindex'=>$prefiliacionproc_list->RowCnt, 'id'=>'r' . $prefiliacionproc_list->RowCnt . '_prefiliacionproc', 'data-rowtype'=>$prefiliacionproc->RowType));

		// Render row
		$prefiliacionproc_list->renderRow();

		// Render list options
		$prefiliacionproc_list->renderListOptions();
?>
	<tr<?php echo $prefiliacionproc->rowAttributes() ?>>
<?php

// Render list options (body, left)
$prefiliacionproc_list->ListOptions->render("body", "left", $prefiliacionproc_list->RowCnt);
?>
	<?php if ($prefiliacionproc->oidarchivos->Visible) { // oidarchivos ?>
		<td data-name="oidarchivos"<?php echo $prefiliacionproc->oidarchivos->cellAttributes() ?>>
<span id="el<?php echo $prefiliacionproc_list->RowCnt ?>_prefiliacionproc_oidarchivos" class="prefiliacionproc_oidarchivos">
<span<?php echo $prefiliacionproc->oidarchivos->viewAttributes() ?>>
<?php echo $prefiliacionproc->oidarchivos->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($prefiliacionproc->idrfccomprador->Visible) { // idrfccomprador ?>
		<td data-name="idrfccomprador"<?php echo $prefiliacionproc->idrfccomprador->cellAttributes() ?>>
<span id="el<?php echo $prefiliacionproc_list->RowCnt ?>_prefiliacionproc_idrfccomprador" class="prefiliacionproc_idrfccomprador">
<span<?php echo $prefiliacionproc->idrfccomprador->viewAttributes() ?>>
<?php echo $prefiliacionproc->idrfccomprador->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($prefiliacionproc->registros_totales->Visible) { // registros totales ?>
		<td data-name="registros_totales"<?php echo $prefiliacionproc->registros_totales->cellAttributes() ?>>
<span id="el<?php echo $prefiliacionproc_list->RowCnt ?>_prefiliacionproc_registros_totales" class="prefiliacionproc_registros_totales">
<span<?php echo $prefiliacionproc->registros_totales->viewAttributes() ?>>
<?php echo $prefiliacionproc->registros_totales->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($prefiliacionproc->registros_validos->Visible) { // registros validos ?>
		<td data-name="registros_validos"<?php echo $prefiliacionproc->registros_validos->cellAttributes() ?>>
<span id="el<?php echo $prefiliacionproc_list->RowCnt ?>_prefiliacionproc_registros_validos" class="prefiliacionproc_registros_validos">
<span<?php echo $prefiliacionproc->registros_validos->viewAttributes() ?>>
<?php echo $prefiliacionproc->registros_validos->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($prefiliacionproc->errores->Visible) { // errores ?>
		<td data-name="errores"<?php echo $prefiliacionproc->errores->cellAttributes() ?>>
<span id="el<?php echo $prefiliacionproc_list->RowCnt ?>_prefiliacionproc_errores" class="prefiliacionproc_errores">
<span<?php echo $prefiliacionproc->errores->viewAttributes() ?>>
<?php echo $prefiliacionproc->errores->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$prefiliacionproc_list->ListOptions->render("body", "right", $prefiliacionproc_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$prefiliacionproc->isGridAdd())
		$prefiliacionproc_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$prefiliacionproc->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($prefiliacionproc_list->Recordset)
	$prefiliacionproc_list->Recordset->Close();
?>
<?php if (!$prefiliacionproc->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$prefiliacionproc->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($prefiliacionproc_list->Pager)) $prefiliacionproc_list->Pager = new NumericPager($prefiliacionproc_list->StartRec, $prefiliacionproc_list->DisplayRecs, $prefiliacionproc_list->TotalRecs, $prefiliacionproc_list->RecRange, $prefiliacionproc_list->AutoHidePager) ?>
<?php if ($prefiliacionproc_list->Pager->RecordCount > 0 && $prefiliacionproc_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($prefiliacionproc_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $prefiliacionproc_list->pageUrl() ?>start=<?php echo $prefiliacionproc_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($prefiliacionproc_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $prefiliacionproc_list->pageUrl() ?>start=<?php echo $prefiliacionproc_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($prefiliacionproc_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $prefiliacionproc_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($prefiliacionproc_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $prefiliacionproc_list->pageUrl() ?>start=<?php echo $prefiliacionproc_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($prefiliacionproc_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $prefiliacionproc_list->pageUrl() ?>start=<?php echo $prefiliacionproc_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($prefiliacionproc_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $prefiliacionproc_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $prefiliacionproc_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $prefiliacionproc_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $prefiliacionproc_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($prefiliacionproc_list->TotalRecs == 0 && !$prefiliacionproc->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $prefiliacionproc_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$prefiliacionproc_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$prefiliacionproc->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$prefiliacionproc_list->terminate();
?>