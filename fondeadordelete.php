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
$fondeador_delete = new fondeador_delete();

// Run the page
$fondeador_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$fondeador_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ffondeadordelete = currentForm = new ew.Form("ffondeadordelete", "delete");

// Form_CustomValidate event
ffondeadordelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ffondeadordelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $fondeador_delete->showPageHeader(); ?>
<?php
$fondeador_delete->showMessage();
?>
<form name="ffondeadordelete" id="ffondeadordelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($fondeador_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $fondeador_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="fondeador">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($fondeador_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($fondeador->rfcfondeador->Visible) { // rfcfondeador ?>
		<th class="<?php echo $fondeador->rfcfondeador->headerCellClass() ?>"><span id="elh_fondeador_rfcfondeador" class="fondeador_rfcfondeador"><?php echo $fondeador->rfcfondeador->caption() ?></span></th>
<?php } ?>
<?php if ($fondeador->id_fondeador->Visible) { // id_fondeador ?>
		<th class="<?php echo $fondeador->id_fondeador->headerCellClass() ?>"><span id="elh_fondeador_id_fondeador" class="fondeador_id_fondeador"><?php echo $fondeador->id_fondeador->caption() ?></span></th>
<?php } ?>
<?php if ($fondeador->razon_social->Visible) { // razon_social ?>
		<th class="<?php echo $fondeador->razon_social->headerCellClass() ?>"><span id="elh_fondeador_razon_social" class="fondeador_razon_social"><?php echo $fondeador->razon_social->caption() ?></span></th>
<?php } ?>
<?php if ($fondeador->calle->Visible) { // calle ?>
		<th class="<?php echo $fondeador->calle->headerCellClass() ?>"><span id="elh_fondeador_calle" class="fondeador_calle"><?php echo $fondeador->calle->caption() ?></span></th>
<?php } ?>
<?php if ($fondeador->colonia->Visible) { // colonia ?>
		<th class="<?php echo $fondeador->colonia->headerCellClass() ?>"><span id="elh_fondeador_colonia" class="fondeador_colonia"><?php echo $fondeador->colonia->caption() ?></span></th>
<?php } ?>
<?php if ($fondeador->ciudad->Visible) { // ciudad ?>
		<th class="<?php echo $fondeador->ciudad->headerCellClass() ?>"><span id="elh_fondeador_ciudad" class="fondeador_ciudad"><?php echo $fondeador->ciudad->caption() ?></span></th>
<?php } ?>
<?php if ($fondeador->codpostal->Visible) { // codpostal ?>
		<th class="<?php echo $fondeador->codpostal->headerCellClass() ?>"><span id="elh_fondeador_codpostal" class="fondeador_codpostal"><?php echo $fondeador->codpostal->caption() ?></span></th>
<?php } ?>
<?php if ($fondeador->telefono->Visible) { // telefono ?>
		<th class="<?php echo $fondeador->telefono->headerCellClass() ?>"><span id="elh_fondeador_telefono" class="fondeador_telefono"><?php echo $fondeador->telefono->caption() ?></span></th>
<?php } ?>
<?php if ($fondeador->correo->Visible) { // correo ?>
		<th class="<?php echo $fondeador->correo->headerCellClass() ?>"><span id="elh_fondeador_correo" class="fondeador_correo"><?php echo $fondeador->correo->caption() ?></span></th>
<?php } ?>
<?php if ($fondeador->pais->Visible) { // pais ?>
		<th class="<?php echo $fondeador->pais->headerCellClass() ?>"><span id="elh_fondeador_pais" class="fondeador_pais"><?php echo $fondeador->pais->caption() ?></span></th>
<?php } ?>
<?php if ($fondeador->fondeadorfactura->Visible) { // fondeadorfactura ?>
		<th class="<?php echo $fondeador->fondeadorfactura->headerCellClass() ?>"><span id="elh_fondeador_fondeadorfactura" class="fondeador_fondeadorfactura"><?php echo $fondeador->fondeadorfactura->caption() ?></span></th>
<?php } ?>
<?php if ($fondeador->calificacion->Visible) { // calificacion ?>
		<th class="<?php echo $fondeador->calificacion->headerCellClass() ?>"><span id="elh_fondeador_calificacion" class="fondeador_calificacion"><?php echo $fondeador->calificacion->caption() ?></span></th>
<?php } ?>
<?php if ($fondeador->cedooperacionfondeador->Visible) { // cedooperacionfondeador ?>
		<th class="<?php echo $fondeador->cedooperacionfondeador->headerCellClass() ?>"><span id="elh_fondeador_cedooperacionfondeador" class="fondeador_cedooperacionfondeador"><?php echo $fondeador->cedooperacionfondeador->caption() ?></span></th>
<?php } ?>
<?php if ($fondeador->pymerfc->Visible) { // pymerfc ?>
		<th class="<?php echo $fondeador->pymerfc->headerCellClass() ?>"><span id="elh_fondeador_pymerfc" class="fondeador_pymerfc"><?php echo $fondeador->pymerfc->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$fondeador_delete->RecCnt = 0;
$i = 0;
while (!$fondeador_delete->Recordset->EOF) {
	$fondeador_delete->RecCnt++;
	$fondeador_delete->RowCnt++;

	// Set row properties
	$fondeador->resetAttributes();
	$fondeador->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$fondeador_delete->loadRowValues($fondeador_delete->Recordset);

	// Render row
	$fondeador_delete->renderRow();
?>
	<tr<?php echo $fondeador->rowAttributes() ?>>
<?php if ($fondeador->rfcfondeador->Visible) { // rfcfondeador ?>
		<td<?php echo $fondeador->rfcfondeador->cellAttributes() ?>>
<span id="el<?php echo $fondeador_delete->RowCnt ?>_fondeador_rfcfondeador" class="fondeador_rfcfondeador">
<span<?php echo $fondeador->rfcfondeador->viewAttributes() ?>>
<?php echo $fondeador->rfcfondeador->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($fondeador->id_fondeador->Visible) { // id_fondeador ?>
		<td<?php echo $fondeador->id_fondeador->cellAttributes() ?>>
<span id="el<?php echo $fondeador_delete->RowCnt ?>_fondeador_id_fondeador" class="fondeador_id_fondeador">
<span<?php echo $fondeador->id_fondeador->viewAttributes() ?>>
<?php echo $fondeador->id_fondeador->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($fondeador->razon_social->Visible) { // razon_social ?>
		<td<?php echo $fondeador->razon_social->cellAttributes() ?>>
<span id="el<?php echo $fondeador_delete->RowCnt ?>_fondeador_razon_social" class="fondeador_razon_social">
<span<?php echo $fondeador->razon_social->viewAttributes() ?>>
<?php echo $fondeador->razon_social->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($fondeador->calle->Visible) { // calle ?>
		<td<?php echo $fondeador->calle->cellAttributes() ?>>
<span id="el<?php echo $fondeador_delete->RowCnt ?>_fondeador_calle" class="fondeador_calle">
<span<?php echo $fondeador->calle->viewAttributes() ?>>
<?php echo $fondeador->calle->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($fondeador->colonia->Visible) { // colonia ?>
		<td<?php echo $fondeador->colonia->cellAttributes() ?>>
<span id="el<?php echo $fondeador_delete->RowCnt ?>_fondeador_colonia" class="fondeador_colonia">
<span<?php echo $fondeador->colonia->viewAttributes() ?>>
<?php echo $fondeador->colonia->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($fondeador->ciudad->Visible) { // ciudad ?>
		<td<?php echo $fondeador->ciudad->cellAttributes() ?>>
<span id="el<?php echo $fondeador_delete->RowCnt ?>_fondeador_ciudad" class="fondeador_ciudad">
<span<?php echo $fondeador->ciudad->viewAttributes() ?>>
<?php echo $fondeador->ciudad->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($fondeador->codpostal->Visible) { // codpostal ?>
		<td<?php echo $fondeador->codpostal->cellAttributes() ?>>
<span id="el<?php echo $fondeador_delete->RowCnt ?>_fondeador_codpostal" class="fondeador_codpostal">
<span<?php echo $fondeador->codpostal->viewAttributes() ?>>
<?php echo $fondeador->codpostal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($fondeador->telefono->Visible) { // telefono ?>
		<td<?php echo $fondeador->telefono->cellAttributes() ?>>
<span id="el<?php echo $fondeador_delete->RowCnt ?>_fondeador_telefono" class="fondeador_telefono">
<span<?php echo $fondeador->telefono->viewAttributes() ?>>
<?php echo $fondeador->telefono->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($fondeador->correo->Visible) { // correo ?>
		<td<?php echo $fondeador->correo->cellAttributes() ?>>
<span id="el<?php echo $fondeador_delete->RowCnt ?>_fondeador_correo" class="fondeador_correo">
<span<?php echo $fondeador->correo->viewAttributes() ?>>
<?php echo $fondeador->correo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($fondeador->pais->Visible) { // pais ?>
		<td<?php echo $fondeador->pais->cellAttributes() ?>>
<span id="el<?php echo $fondeador_delete->RowCnt ?>_fondeador_pais" class="fondeador_pais">
<span<?php echo $fondeador->pais->viewAttributes() ?>>
<?php echo $fondeador->pais->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($fondeador->fondeadorfactura->Visible) { // fondeadorfactura ?>
		<td<?php echo $fondeador->fondeadorfactura->cellAttributes() ?>>
<span id="el<?php echo $fondeador_delete->RowCnt ?>_fondeador_fondeadorfactura" class="fondeador_fondeadorfactura">
<span<?php echo $fondeador->fondeadorfactura->viewAttributes() ?>>
<?php echo $fondeador->fondeadorfactura->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($fondeador->calificacion->Visible) { // calificacion ?>
		<td<?php echo $fondeador->calificacion->cellAttributes() ?>>
<span id="el<?php echo $fondeador_delete->RowCnt ?>_fondeador_calificacion" class="fondeador_calificacion">
<span<?php echo $fondeador->calificacion->viewAttributes() ?>>
<?php echo $fondeador->calificacion->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($fondeador->cedooperacionfondeador->Visible) { // cedooperacionfondeador ?>
		<td<?php echo $fondeador->cedooperacionfondeador->cellAttributes() ?>>
<span id="el<?php echo $fondeador_delete->RowCnt ?>_fondeador_cedooperacionfondeador" class="fondeador_cedooperacionfondeador">
<span<?php echo $fondeador->cedooperacionfondeador->viewAttributes() ?>>
<?php echo $fondeador->cedooperacionfondeador->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($fondeador->pymerfc->Visible) { // pymerfc ?>
		<td<?php echo $fondeador->pymerfc->cellAttributes() ?>>
<span id="el<?php echo $fondeador_delete->RowCnt ?>_fondeador_pymerfc" class="fondeador_pymerfc">
<span<?php echo $fondeador->pymerfc->viewAttributes() ?>>
<?php echo $fondeador->pymerfc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$fondeador_delete->Recordset->moveNext();
}
$fondeador_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $fondeador_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$fondeador_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$fondeador_delete->terminate();
?>