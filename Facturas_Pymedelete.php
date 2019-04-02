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
$Facturas_Pyme_delete = new Facturas_Pyme_delete();

// Run the page
$Facturas_Pyme_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Facturas_Pyme_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fFacturas_Pymedelete = currentForm = new ew.Form("fFacturas_Pymedelete", "delete");

// Form_CustomValidate event
fFacturas_Pymedelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fFacturas_Pymedelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $Facturas_Pyme_delete->showPageHeader(); ?>
<?php
$Facturas_Pyme_delete->showMessage();
?>
<form name="fFacturas_Pymedelete" id="fFacturas_Pymedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Facturas_Pyme_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $Facturas_Pyme_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Facturas_Pyme">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Facturas_Pyme_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($Facturas_Pyme->rfcfactura->Visible) { // rfcfactura ?>
		<th class="<?php echo $Facturas_Pyme->rfcfactura->headerCellClass() ?>"><span id="elh_Facturas_Pyme_rfcfactura" class="Facturas_Pyme_rfcfactura"><?php echo $Facturas_Pyme->rfcfactura->caption() ?></span></th>
<?php } ?>
<?php if ($Facturas_Pyme->idfactura->Visible) { // idfactura ?>
		<th class="<?php echo $Facturas_Pyme->idfactura->headerCellClass() ?>"><span id="elh_Facturas_Pyme_idfactura" class="Facturas_Pyme_idfactura"><?php echo $Facturas_Pyme->idfactura->caption() ?></span></th>
<?php } ?>
<?php if ($Facturas_Pyme->monto->Visible) { // monto ?>
		<th class="<?php echo $Facturas_Pyme->monto->headerCellClass() ?>"><span id="elh_Facturas_Pyme_monto" class="Facturas_Pyme_monto"><?php echo $Facturas_Pyme->monto->caption() ?></span></th>
<?php } ?>
<?php if ($Facturas_Pyme->estado_operacion->Visible) { // estado_operacion ?>
		<th class="<?php echo $Facturas_Pyme->estado_operacion->headerCellClass() ?>"><span id="elh_Facturas_Pyme_estado_operacion" class="Facturas_Pyme_estado_operacion"><?php echo $Facturas_Pyme->estado_operacion->caption() ?></span></th>
<?php } ?>
<?php if ($Facturas_Pyme->pymerfc->Visible) { // pymerfc ?>
		<th class="<?php echo $Facturas_Pyme->pymerfc->headerCellClass() ?>"><span id="elh_Facturas_Pyme_pymerfc" class="Facturas_Pyme_pymerfc"><?php echo $Facturas_Pyme->pymerfc->caption() ?></span></th>
<?php } ?>
<?php if ($Facturas_Pyme->compradorfc->Visible) { // compradorfc ?>
		<th class="<?php echo $Facturas_Pyme->compradorfc->headerCellClass() ?>"><span id="elh_Facturas_Pyme_compradorfc" class="Facturas_Pyme_compradorfc"><?php echo $Facturas_Pyme->compradorfc->caption() ?></span></th>
<?php } ?>
<?php if ($Facturas_Pyme->cadena->Visible) { // cadena ?>
		<th class="<?php echo $Facturas_Pyme->cadena->headerCellClass() ?>"><span id="elh_Facturas_Pyme_cadena" class="Facturas_Pyme_cadena"><?php echo $Facturas_Pyme->cadena->caption() ?></span></th>
<?php } ?>
<?php if ($Facturas_Pyme->vencimiento->Visible) { // vencimiento ?>
		<th class="<?php echo $Facturas_Pyme->vencimiento->headerCellClass() ?>"><span id="elh_Facturas_Pyme_vencimiento" class="Facturas_Pyme_vencimiento"><?php echo $Facturas_Pyme->vencimiento->caption() ?></span></th>
<?php } ?>
<?php if ($Facturas_Pyme->fondeadorfactura->Visible) { // fondeadorfactura ?>
		<th class="<?php echo $Facturas_Pyme->fondeadorfactura->headerCellClass() ?>"><span id="elh_Facturas_Pyme_fondeadorfactura" class="Facturas_Pyme_fondeadorfactura"><?php echo $Facturas_Pyme->fondeadorfactura->caption() ?></span></th>
<?php } ?>
<?php if ($Facturas_Pyme->estatusfactura->Visible) { // estatusfactura ?>
		<th class="<?php echo $Facturas_Pyme->estatusfactura->headerCellClass() ?>"><span id="elh_Facturas_Pyme_estatusfactura" class="Facturas_Pyme_estatusfactura"><?php echo $Facturas_Pyme->estatusfactura->caption() ?></span></th>
<?php } ?>
<?php if ($Facturas_Pyme->compradorid_comprador->Visible) { // compradorid_comprador ?>
		<th class="<?php echo $Facturas_Pyme->compradorid_comprador->headerCellClass() ?>"><span id="elh_Facturas_Pyme_compradorid_comprador" class="Facturas_Pyme_compradorid_comprador"><?php echo $Facturas_Pyme->compradorid_comprador->caption() ?></span></th>
<?php } ?>
<?php if ($Facturas_Pyme->fondeadorfacturaidfondeadorfact->Visible) { // fondeadorfacturaidfondeadorfact ?>
		<th class="<?php echo $Facturas_Pyme->fondeadorfacturaidfondeadorfact->headerCellClass() ?>"><span id="elh_Facturas_Pyme_fondeadorfacturaidfondeadorfact" class="Facturas_Pyme_fondeadorfacturaidfondeadorfact"><?php echo $Facturas_Pyme->fondeadorfacturaidfondeadorfact->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$Facturas_Pyme_delete->RecCnt = 0;
$i = 0;
while (!$Facturas_Pyme_delete->Recordset->EOF) {
	$Facturas_Pyme_delete->RecCnt++;
	$Facturas_Pyme_delete->RowCnt++;

	// Set row properties
	$Facturas_Pyme->resetAttributes();
	$Facturas_Pyme->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$Facturas_Pyme_delete->loadRowValues($Facturas_Pyme_delete->Recordset);

	// Render row
	$Facturas_Pyme_delete->renderRow();
?>
	<tr<?php echo $Facturas_Pyme->rowAttributes() ?>>
<?php if ($Facturas_Pyme->rfcfactura->Visible) { // rfcfactura ?>
		<td<?php echo $Facturas_Pyme->rfcfactura->cellAttributes() ?>>
<span id="el<?php echo $Facturas_Pyme_delete->RowCnt ?>_Facturas_Pyme_rfcfactura" class="Facturas_Pyme_rfcfactura">
<span<?php echo $Facturas_Pyme->rfcfactura->viewAttributes() ?>>
<?php echo $Facturas_Pyme->rfcfactura->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Facturas_Pyme->idfactura->Visible) { // idfactura ?>
		<td<?php echo $Facturas_Pyme->idfactura->cellAttributes() ?>>
<span id="el<?php echo $Facturas_Pyme_delete->RowCnt ?>_Facturas_Pyme_idfactura" class="Facturas_Pyme_idfactura">
<span<?php echo $Facturas_Pyme->idfactura->viewAttributes() ?>>
<?php echo $Facturas_Pyme->idfactura->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Facturas_Pyme->monto->Visible) { // monto ?>
		<td<?php echo $Facturas_Pyme->monto->cellAttributes() ?>>
<span id="el<?php echo $Facturas_Pyme_delete->RowCnt ?>_Facturas_Pyme_monto" class="Facturas_Pyme_monto">
<span<?php echo $Facturas_Pyme->monto->viewAttributes() ?>>
<?php echo $Facturas_Pyme->monto->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Facturas_Pyme->estado_operacion->Visible) { // estado_operacion ?>
		<td<?php echo $Facturas_Pyme->estado_operacion->cellAttributes() ?>>
<span id="el<?php echo $Facturas_Pyme_delete->RowCnt ?>_Facturas_Pyme_estado_operacion" class="Facturas_Pyme_estado_operacion">
<span<?php echo $Facturas_Pyme->estado_operacion->viewAttributes() ?>>
<?php echo $Facturas_Pyme->estado_operacion->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Facturas_Pyme->pymerfc->Visible) { // pymerfc ?>
		<td<?php echo $Facturas_Pyme->pymerfc->cellAttributes() ?>>
<span id="el<?php echo $Facturas_Pyme_delete->RowCnt ?>_Facturas_Pyme_pymerfc" class="Facturas_Pyme_pymerfc">
<span<?php echo $Facturas_Pyme->pymerfc->viewAttributes() ?>>
<?php echo $Facturas_Pyme->pymerfc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Facturas_Pyme->compradorfc->Visible) { // compradorfc ?>
		<td<?php echo $Facturas_Pyme->compradorfc->cellAttributes() ?>>
<span id="el<?php echo $Facturas_Pyme_delete->RowCnt ?>_Facturas_Pyme_compradorfc" class="Facturas_Pyme_compradorfc">
<span<?php echo $Facturas_Pyme->compradorfc->viewAttributes() ?>>
<?php echo $Facturas_Pyme->compradorfc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Facturas_Pyme->cadena->Visible) { // cadena ?>
		<td<?php echo $Facturas_Pyme->cadena->cellAttributes() ?>>
<span id="el<?php echo $Facturas_Pyme_delete->RowCnt ?>_Facturas_Pyme_cadena" class="Facturas_Pyme_cadena">
<span<?php echo $Facturas_Pyme->cadena->viewAttributes() ?>>
<?php echo $Facturas_Pyme->cadena->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Facturas_Pyme->vencimiento->Visible) { // vencimiento ?>
		<td<?php echo $Facturas_Pyme->vencimiento->cellAttributes() ?>>
<span id="el<?php echo $Facturas_Pyme_delete->RowCnt ?>_Facturas_Pyme_vencimiento" class="Facturas_Pyme_vencimiento">
<span<?php echo $Facturas_Pyme->vencimiento->viewAttributes() ?>>
<?php echo $Facturas_Pyme->vencimiento->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Facturas_Pyme->fondeadorfactura->Visible) { // fondeadorfactura ?>
		<td<?php echo $Facturas_Pyme->fondeadorfactura->cellAttributes() ?>>
<span id="el<?php echo $Facturas_Pyme_delete->RowCnt ?>_Facturas_Pyme_fondeadorfactura" class="Facturas_Pyme_fondeadorfactura">
<span<?php echo $Facturas_Pyme->fondeadorfactura->viewAttributes() ?>>
<?php echo $Facturas_Pyme->fondeadorfactura->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Facturas_Pyme->estatusfactura->Visible) { // estatusfactura ?>
		<td<?php echo $Facturas_Pyme->estatusfactura->cellAttributes() ?>>
<span id="el<?php echo $Facturas_Pyme_delete->RowCnt ?>_Facturas_Pyme_estatusfactura" class="Facturas_Pyme_estatusfactura">
<span<?php echo $Facturas_Pyme->estatusfactura->viewAttributes() ?>>
<?php echo $Facturas_Pyme->estatusfactura->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Facturas_Pyme->compradorid_comprador->Visible) { // compradorid_comprador ?>
		<td<?php echo $Facturas_Pyme->compradorid_comprador->cellAttributes() ?>>
<span id="el<?php echo $Facturas_Pyme_delete->RowCnt ?>_Facturas_Pyme_compradorid_comprador" class="Facturas_Pyme_compradorid_comprador">
<span<?php echo $Facturas_Pyme->compradorid_comprador->viewAttributes() ?>>
<?php echo $Facturas_Pyme->compradorid_comprador->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Facturas_Pyme->fondeadorfacturaidfondeadorfact->Visible) { // fondeadorfacturaidfondeadorfact ?>
		<td<?php echo $Facturas_Pyme->fondeadorfacturaidfondeadorfact->cellAttributes() ?>>
<span id="el<?php echo $Facturas_Pyme_delete->RowCnt ?>_Facturas_Pyme_fondeadorfacturaidfondeadorfact" class="Facturas_Pyme_fondeadorfacturaidfondeadorfact">
<span<?php echo $Facturas_Pyme->fondeadorfacturaidfondeadorfact->viewAttributes() ?>>
<?php echo $Facturas_Pyme->fondeadorfacturaidfondeadorfact->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$Facturas_Pyme_delete->Recordset->moveNext();
}
$Facturas_Pyme_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Facturas_Pyme_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Facturas_Pyme_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$Facturas_Pyme_delete->terminate();
?>