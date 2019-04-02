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
$comprador_delete = new comprador_delete();

// Run the page
$comprador_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$comprador_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fcompradordelete = currentForm = new ew.Form("fcompradordelete", "delete");

// Form_CustomValidate event
fcompradordelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcompradordelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $comprador_delete->showPageHeader(); ?>
<?php
$comprador_delete->showMessage();
?>
<form name="fcompradordelete" id="fcompradordelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($comprador_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $comprador_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="comprador">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($comprador_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($comprador->rfc->Visible) { // rfc ?>
		<th class="<?php echo $comprador->rfc->headerCellClass() ?>"><span id="elh_comprador_rfc" class="comprador_rfc"><?php echo $comprador->rfc->caption() ?></span></th>
<?php } ?>
<?php if ($comprador->id_comprador->Visible) { // id_comprador ?>
		<th class="<?php echo $comprador->id_comprador->headerCellClass() ?>"><span id="elh_comprador_id_comprador" class="comprador_id_comprador"><?php echo $comprador->id_comprador->caption() ?></span></th>
<?php } ?>
<?php if ($comprador->razon_social->Visible) { // razon_social ?>
		<th class="<?php echo $comprador->razon_social->headerCellClass() ?>"><span id="elh_comprador_razon_social" class="comprador_razon_social"><?php echo $comprador->razon_social->caption() ?></span></th>
<?php } ?>
<?php if ($comprador->calle->Visible) { // calle ?>
		<th class="<?php echo $comprador->calle->headerCellClass() ?>"><span id="elh_comprador_calle" class="comprador_calle"><?php echo $comprador->calle->caption() ?></span></th>
<?php } ?>
<?php if ($comprador->colonia->Visible) { // colonia ?>
		<th class="<?php echo $comprador->colonia->headerCellClass() ?>"><span id="elh_comprador_colonia" class="comprador_colonia"><?php echo $comprador->colonia->caption() ?></span></th>
<?php } ?>
<?php if ($comprador->codpostal->Visible) { // codpostal ?>
		<th class="<?php echo $comprador->codpostal->headerCellClass() ?>"><span id="elh_comprador_codpostal" class="comprador_codpostal"><?php echo $comprador->codpostal->caption() ?></span></th>
<?php } ?>
<?php if ($comprador->ciudad->Visible) { // ciudad ?>
		<th class="<?php echo $comprador->ciudad->headerCellClass() ?>"><span id="elh_comprador_ciudad" class="comprador_ciudad"><?php echo $comprador->ciudad->caption() ?></span></th>
<?php } ?>
<?php if ($comprador->telefono->Visible) { // telefono ?>
		<th class="<?php echo $comprador->telefono->headerCellClass() ?>"><span id="elh_comprador_telefono" class="comprador_telefono"><?php echo $comprador->telefono->caption() ?></span></th>
<?php } ?>
<?php if ($comprador->correo->Visible) { // correo ?>
		<th class="<?php echo $comprador->correo->headerCellClass() ?>"><span id="elh_comprador_correo" class="comprador_correo"><?php echo $comprador->correo->caption() ?></span></th>
<?php } ?>
<?php if ($comprador->pais->Visible) { // pais ?>
		<th class="<?php echo $comprador->pais->headerCellClass() ?>"><span id="elh_comprador_pais" class="comprador_pais"><?php echo $comprador->pais->caption() ?></span></th>
<?php } ?>
<?php if ($comprador->pymerfc->Visible) { // pymerfc ?>
		<th class="<?php echo $comprador->pymerfc->headerCellClass() ?>"><span id="elh_comprador_pymerfc" class="comprador_pymerfc"><?php echo $comprador->pymerfc->caption() ?></span></th>
<?php } ?>
<?php if ($comprador->edooperacion->Visible) { // edooperacion ?>
		<th class="<?php echo $comprador->edooperacion->headerCellClass() ?>"><span id="elh_comprador_edooperacion" class="comprador_edooperacion"><?php echo $comprador->edooperacion->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$comprador_delete->RecCnt = 0;
$i = 0;
while (!$comprador_delete->Recordset->EOF) {
	$comprador_delete->RecCnt++;
	$comprador_delete->RowCnt++;

	// Set row properties
	$comprador->resetAttributes();
	$comprador->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$comprador_delete->loadRowValues($comprador_delete->Recordset);

	// Render row
	$comprador_delete->renderRow();
?>
	<tr<?php echo $comprador->rowAttributes() ?>>
<?php if ($comprador->rfc->Visible) { // rfc ?>
		<td<?php echo $comprador->rfc->cellAttributes() ?>>
<span id="el<?php echo $comprador_delete->RowCnt ?>_comprador_rfc" class="comprador_rfc">
<span<?php echo $comprador->rfc->viewAttributes() ?>>
<?php echo $comprador->rfc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($comprador->id_comprador->Visible) { // id_comprador ?>
		<td<?php echo $comprador->id_comprador->cellAttributes() ?>>
<span id="el<?php echo $comprador_delete->RowCnt ?>_comprador_id_comprador" class="comprador_id_comprador">
<span<?php echo $comprador->id_comprador->viewAttributes() ?>>
<?php echo $comprador->id_comprador->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($comprador->razon_social->Visible) { // razon_social ?>
		<td<?php echo $comprador->razon_social->cellAttributes() ?>>
<span id="el<?php echo $comprador_delete->RowCnt ?>_comprador_razon_social" class="comprador_razon_social">
<span<?php echo $comprador->razon_social->viewAttributes() ?>>
<?php echo $comprador->razon_social->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($comprador->calle->Visible) { // calle ?>
		<td<?php echo $comprador->calle->cellAttributes() ?>>
<span id="el<?php echo $comprador_delete->RowCnt ?>_comprador_calle" class="comprador_calle">
<span<?php echo $comprador->calle->viewAttributes() ?>>
<?php echo $comprador->calle->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($comprador->colonia->Visible) { // colonia ?>
		<td<?php echo $comprador->colonia->cellAttributes() ?>>
<span id="el<?php echo $comprador_delete->RowCnt ?>_comprador_colonia" class="comprador_colonia">
<span<?php echo $comprador->colonia->viewAttributes() ?>>
<?php echo $comprador->colonia->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($comprador->codpostal->Visible) { // codpostal ?>
		<td<?php echo $comprador->codpostal->cellAttributes() ?>>
<span id="el<?php echo $comprador_delete->RowCnt ?>_comprador_codpostal" class="comprador_codpostal">
<span<?php echo $comprador->codpostal->viewAttributes() ?>>
<?php echo $comprador->codpostal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($comprador->ciudad->Visible) { // ciudad ?>
		<td<?php echo $comprador->ciudad->cellAttributes() ?>>
<span id="el<?php echo $comprador_delete->RowCnt ?>_comprador_ciudad" class="comprador_ciudad">
<span<?php echo $comprador->ciudad->viewAttributes() ?>>
<?php echo $comprador->ciudad->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($comprador->telefono->Visible) { // telefono ?>
		<td<?php echo $comprador->telefono->cellAttributes() ?>>
<span id="el<?php echo $comprador_delete->RowCnt ?>_comprador_telefono" class="comprador_telefono">
<span<?php echo $comprador->telefono->viewAttributes() ?>>
<?php echo $comprador->telefono->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($comprador->correo->Visible) { // correo ?>
		<td<?php echo $comprador->correo->cellAttributes() ?>>
<span id="el<?php echo $comprador_delete->RowCnt ?>_comprador_correo" class="comprador_correo">
<span<?php echo $comprador->correo->viewAttributes() ?>>
<?php echo $comprador->correo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($comprador->pais->Visible) { // pais ?>
		<td<?php echo $comprador->pais->cellAttributes() ?>>
<span id="el<?php echo $comprador_delete->RowCnt ?>_comprador_pais" class="comprador_pais">
<span<?php echo $comprador->pais->viewAttributes() ?>>
<?php echo $comprador->pais->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($comprador->pymerfc->Visible) { // pymerfc ?>
		<td<?php echo $comprador->pymerfc->cellAttributes() ?>>
<span id="el<?php echo $comprador_delete->RowCnt ?>_comprador_pymerfc" class="comprador_pymerfc">
<span<?php echo $comprador->pymerfc->viewAttributes() ?>>
<?php echo $comprador->pymerfc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($comprador->edooperacion->Visible) { // edooperacion ?>
		<td<?php echo $comprador->edooperacion->cellAttributes() ?>>
<span id="el<?php echo $comprador_delete->RowCnt ?>_comprador_edooperacion" class="comprador_edooperacion">
<span<?php echo $comprador->edooperacion->viewAttributes() ?>>
<?php echo $comprador->edooperacion->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$comprador_delete->Recordset->moveNext();
}
$comprador_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $comprador_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$comprador_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$comprador_delete->terminate();
?>