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
$pyme_delete = new pyme_delete();

// Run the page
$pyme_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pyme_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fpymedelete = currentForm = new ew.Form("fpymedelete", "delete");

// Form_CustomValidate event
fpymedelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fpymedelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fpymedelete.lists["x_compradorrfc"] = <?php echo $pyme_delete->compradorrfc->Lookup->toClientList() ?>;
fpymedelete.lists["x_compradorrfc"].options = <?php echo JsonEncode($pyme_delete->compradorrfc->lookupOptions()) ?>;
fpymedelete.autoSuggests["x_compradorrfc"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $pyme_delete->showPageHeader(); ?>
<?php
$pyme_delete->showMessage();
?>
<form name="fpymedelete" id="fpymedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($pyme_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $pyme_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pyme">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($pyme_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($pyme->rfcpyme->Visible) { // rfcpyme ?>
		<th class="<?php echo $pyme->rfcpyme->headerCellClass() ?>"><span id="elh_pyme_rfcpyme" class="pyme_rfcpyme"><?php echo $pyme->rfcpyme->caption() ?></span></th>
<?php } ?>
<?php if ($pyme->id_pyme->Visible) { // id_pyme ?>
		<th class="<?php echo $pyme->id_pyme->headerCellClass() ?>"><span id="elh_pyme_id_pyme" class="pyme_id_pyme"><?php echo $pyme->id_pyme->caption() ?></span></th>
<?php } ?>
<?php if ($pyme->razon_social->Visible) { // razon_social ?>
		<th class="<?php echo $pyme->razon_social->headerCellClass() ?>"><span id="elh_pyme_razon_social" class="pyme_razon_social"><?php echo $pyme->razon_social->caption() ?></span></th>
<?php } ?>
<?php if ($pyme->calle->Visible) { // calle ?>
		<th class="<?php echo $pyme->calle->headerCellClass() ?>"><span id="elh_pyme_calle" class="pyme_calle"><?php echo $pyme->calle->caption() ?></span></th>
<?php } ?>
<?php if ($pyme->colonia->Visible) { // colonia ?>
		<th class="<?php echo $pyme->colonia->headerCellClass() ?>"><span id="elh_pyme_colonia" class="pyme_colonia"><?php echo $pyme->colonia->caption() ?></span></th>
<?php } ?>
<?php if ($pyme->ciudad->Visible) { // ciudad ?>
		<th class="<?php echo $pyme->ciudad->headerCellClass() ?>"><span id="elh_pyme_ciudad" class="pyme_ciudad"><?php echo $pyme->ciudad->caption() ?></span></th>
<?php } ?>
<?php if ($pyme->codpostal->Visible) { // codpostal ?>
		<th class="<?php echo $pyme->codpostal->headerCellClass() ?>"><span id="elh_pyme_codpostal" class="pyme_codpostal"><?php echo $pyme->codpostal->caption() ?></span></th>
<?php } ?>
<?php if ($pyme->correo->Visible) { // correo ?>
		<th class="<?php echo $pyme->correo->headerCellClass() ?>"><span id="elh_pyme_correo" class="pyme_correo"><?php echo $pyme->correo->caption() ?></span></th>
<?php } ?>
<?php if ($pyme->telefono->Visible) { // telefono ?>
		<th class="<?php echo $pyme->telefono->headerCellClass() ?>"><span id="elh_pyme_telefono" class="pyme_telefono"><?php echo $pyme->telefono->caption() ?></span></th>
<?php } ?>
<?php if ($pyme->pais->Visible) { // pais ?>
		<th class="<?php echo $pyme->pais->headerCellClass() ?>"><span id="elh_pyme_pais" class="pyme_pais"><?php echo $pyme->pais->caption() ?></span></th>
<?php } ?>
<?php if ($pyme->preafiliacion->Visible) { // preafiliacion ?>
		<th class="<?php echo $pyme->preafiliacion->headerCellClass() ?>"><span id="elh_pyme_preafiliacion" class="pyme_preafiliacion"><?php echo $pyme->preafiliacion->caption() ?></span></th>
<?php } ?>
<?php if ($pyme->edooperacionpyme->Visible) { // edooperacionpyme ?>
		<th class="<?php echo $pyme->edooperacionpyme->headerCellClass() ?>"><span id="elh_pyme_edooperacionpyme" class="pyme_edooperacionpyme"><?php echo $pyme->edooperacionpyme->caption() ?></span></th>
<?php } ?>
<?php if ($pyme->compradorrfc->Visible) { // compradorrfc ?>
		<th class="<?php echo $pyme->compradorrfc->headerCellClass() ?>"><span id="elh_pyme_compradorrfc" class="pyme_compradorrfc"><?php echo $pyme->compradorrfc->caption() ?></span></th>
<?php } ?>
<?php if ($pyme->comprador->Visible) { // comprador ?>
		<th class="<?php echo $pyme->comprador->headerCellClass() ?>"><span id="elh_pyme_comprador" class="pyme_comprador"><?php echo $pyme->comprador->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$pyme_delete->RecCnt = 0;
$i = 0;
while (!$pyme_delete->Recordset->EOF) {
	$pyme_delete->RecCnt++;
	$pyme_delete->RowCnt++;

	// Set row properties
	$pyme->resetAttributes();
	$pyme->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$pyme_delete->loadRowValues($pyme_delete->Recordset);

	// Render row
	$pyme_delete->renderRow();
?>
	<tr<?php echo $pyme->rowAttributes() ?>>
<?php if ($pyme->rfcpyme->Visible) { // rfcpyme ?>
		<td<?php echo $pyme->rfcpyme->cellAttributes() ?>>
<span id="el<?php echo $pyme_delete->RowCnt ?>_pyme_rfcpyme" class="pyme_rfcpyme">
<span<?php echo $pyme->rfcpyme->viewAttributes() ?>>
<?php echo $pyme->rfcpyme->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pyme->id_pyme->Visible) { // id_pyme ?>
		<td<?php echo $pyme->id_pyme->cellAttributes() ?>>
<span id="el<?php echo $pyme_delete->RowCnt ?>_pyme_id_pyme" class="pyme_id_pyme">
<span<?php echo $pyme->id_pyme->viewAttributes() ?>>
<?php echo $pyme->id_pyme->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pyme->razon_social->Visible) { // razon_social ?>
		<td<?php echo $pyme->razon_social->cellAttributes() ?>>
<span id="el<?php echo $pyme_delete->RowCnt ?>_pyme_razon_social" class="pyme_razon_social">
<span<?php echo $pyme->razon_social->viewAttributes() ?>>
<?php echo $pyme->razon_social->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pyme->calle->Visible) { // calle ?>
		<td<?php echo $pyme->calle->cellAttributes() ?>>
<span id="el<?php echo $pyme_delete->RowCnt ?>_pyme_calle" class="pyme_calle">
<span<?php echo $pyme->calle->viewAttributes() ?>>
<?php echo $pyme->calle->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pyme->colonia->Visible) { // colonia ?>
		<td<?php echo $pyme->colonia->cellAttributes() ?>>
<span id="el<?php echo $pyme_delete->RowCnt ?>_pyme_colonia" class="pyme_colonia">
<span<?php echo $pyme->colonia->viewAttributes() ?>>
<?php echo $pyme->colonia->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pyme->ciudad->Visible) { // ciudad ?>
		<td<?php echo $pyme->ciudad->cellAttributes() ?>>
<span id="el<?php echo $pyme_delete->RowCnt ?>_pyme_ciudad" class="pyme_ciudad">
<span<?php echo $pyme->ciudad->viewAttributes() ?>>
<?php echo $pyme->ciudad->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pyme->codpostal->Visible) { // codpostal ?>
		<td<?php echo $pyme->codpostal->cellAttributes() ?>>
<span id="el<?php echo $pyme_delete->RowCnt ?>_pyme_codpostal" class="pyme_codpostal">
<span<?php echo $pyme->codpostal->viewAttributes() ?>>
<?php echo $pyme->codpostal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pyme->correo->Visible) { // correo ?>
		<td<?php echo $pyme->correo->cellAttributes() ?>>
<span id="el<?php echo $pyme_delete->RowCnt ?>_pyme_correo" class="pyme_correo">
<span<?php echo $pyme->correo->viewAttributes() ?>>
<?php echo $pyme->correo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pyme->telefono->Visible) { // telefono ?>
		<td<?php echo $pyme->telefono->cellAttributes() ?>>
<span id="el<?php echo $pyme_delete->RowCnt ?>_pyme_telefono" class="pyme_telefono">
<span<?php echo $pyme->telefono->viewAttributes() ?>>
<?php echo $pyme->telefono->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pyme->pais->Visible) { // pais ?>
		<td<?php echo $pyme->pais->cellAttributes() ?>>
<span id="el<?php echo $pyme_delete->RowCnt ?>_pyme_pais" class="pyme_pais">
<span<?php echo $pyme->pais->viewAttributes() ?>>
<?php echo $pyme->pais->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pyme->preafiliacion->Visible) { // preafiliacion ?>
		<td<?php echo $pyme->preafiliacion->cellAttributes() ?>>
<span id="el<?php echo $pyme_delete->RowCnt ?>_pyme_preafiliacion" class="pyme_preafiliacion">
<span<?php echo $pyme->preafiliacion->viewAttributes() ?>>
<?php echo $pyme->preafiliacion->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pyme->edooperacionpyme->Visible) { // edooperacionpyme ?>
		<td<?php echo $pyme->edooperacionpyme->cellAttributes() ?>>
<span id="el<?php echo $pyme_delete->RowCnt ?>_pyme_edooperacionpyme" class="pyme_edooperacionpyme">
<span<?php echo $pyme->edooperacionpyme->viewAttributes() ?>>
<?php echo $pyme->edooperacionpyme->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pyme->compradorrfc->Visible) { // compradorrfc ?>
		<td<?php echo $pyme->compradorrfc->cellAttributes() ?>>
<span id="el<?php echo $pyme_delete->RowCnt ?>_pyme_compradorrfc" class="pyme_compradorrfc">
<span<?php echo $pyme->compradorrfc->viewAttributes() ?>>
<?php echo $pyme->compradorrfc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pyme->comprador->Visible) { // comprador ?>
		<td<?php echo $pyme->comprador->cellAttributes() ?>>
<span id="el<?php echo $pyme_delete->RowCnt ?>_pyme_comprador" class="pyme_comprador">
<span<?php echo $pyme->comprador->viewAttributes() ?>>
<?php echo $pyme->comprador->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$pyme_delete->Recordset->moveNext();
}
$pyme_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $pyme_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$pyme_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$pyme_delete->terminate();
?>