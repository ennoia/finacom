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
$factura_search = new factura_search();

// Run the page
$factura_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$factura_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "search";
<?php if ($factura_search->IsModal) { ?>
var ffacturasearch = currentAdvancedSearchForm = new ew.Form("ffacturasearch", "search");
<?php } else { ?>
var ffacturasearch = currentForm = new ew.Form("ffacturasearch", "search");
<?php } ?>

// Form_CustomValidate event
ffacturasearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ffacturasearch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search
// Validate function for search

ffacturasearch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_idfactura");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($factura->idfactura->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_monto");
	if (elm && !ew.checkNumber(elm.value))
		return this.onError(elm, "<?php echo JsEncode($factura->monto->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_estado_operacion");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($factura->estado_operacion->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_vencimiento");
	if (elm && !ew.checkDateDef(elm.value))
		return this.onError(elm, "<?php echo JsEncode($factura->vencimiento->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_fondeadorfactura");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($factura->fondeadorfactura->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_estatusfactura");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($factura->estatusfactura->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_compradorid_comprador");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($factura->compradorid_comprador->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_fondeadorfacturaidfondeadorfact");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($factura->fondeadorfacturaidfondeadorfact->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $factura_search->showPageHeader(); ?>
<?php
$factura_search->showMessage();
?>
<form name="ffacturasearch" id="ffacturasearch" class="<?php echo $factura_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($factura_search->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $factura_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="factura">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$factura_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($factura->rfcfactura->Visible) { // rfcfactura ?>
	<div id="r_rfcfactura" class="form-group row">
		<label for="x_rfcfactura" class="<?php echo $factura_search->LeftColumnClass ?>"><span id="elh_factura_rfcfactura"><?php echo $factura->rfcfactura->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_rfcfactura" id="z_rfcfactura" value="LIKE"></span>
		</label>
		<div class="<?php echo $factura_search->RightColumnClass ?>"><div<?php echo $factura->rfcfactura->cellAttributes() ?>>
			<span id="el_factura_rfcfactura">
<input type="text" data-table="factura" data-field="x_rfcfactura" name="x_rfcfactura" id="x_rfcfactura" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($factura->rfcfactura->getPlaceHolder()) ?>" value="<?php echo $factura->rfcfactura->EditValue ?>"<?php echo $factura->rfcfactura->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($factura->idfactura->Visible) { // idfactura ?>
	<div id="r_idfactura" class="form-group row">
		<label for="x_idfactura" class="<?php echo $factura_search->LeftColumnClass ?>"><span id="elh_factura_idfactura"><?php echo $factura->idfactura->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_idfactura" id="z_idfactura" value="="></span>
		</label>
		<div class="<?php echo $factura_search->RightColumnClass ?>"><div<?php echo $factura->idfactura->cellAttributes() ?>>
			<span id="el_factura_idfactura">
<input type="text" data-table="factura" data-field="x_idfactura" name="x_idfactura" id="x_idfactura" size="30" placeholder="<?php echo HtmlEncode($factura->idfactura->getPlaceHolder()) ?>" value="<?php echo $factura->idfactura->EditValue ?>"<?php echo $factura->idfactura->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($factura->monto->Visible) { // monto ?>
	<div id="r_monto" class="form-group row">
		<label for="x_monto" class="<?php echo $factura_search->LeftColumnClass ?>"><span id="elh_factura_monto"><?php echo $factura->monto->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_monto" id="z_monto" value="="></span>
		</label>
		<div class="<?php echo $factura_search->RightColumnClass ?>"><div<?php echo $factura->monto->cellAttributes() ?>>
			<span id="el_factura_monto">
<input type="text" data-table="factura" data-field="x_monto" name="x_monto" id="x_monto" size="30" placeholder="<?php echo HtmlEncode($factura->monto->getPlaceHolder()) ?>" value="<?php echo $factura->monto->EditValue ?>"<?php echo $factura->monto->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($factura->estado_operacion->Visible) { // estado_operacion ?>
	<div id="r_estado_operacion" class="form-group row">
		<label for="x_estado_operacion" class="<?php echo $factura_search->LeftColumnClass ?>"><span id="elh_factura_estado_operacion"><?php echo $factura->estado_operacion->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_estado_operacion" id="z_estado_operacion" value="="></span>
		</label>
		<div class="<?php echo $factura_search->RightColumnClass ?>"><div<?php echo $factura->estado_operacion->cellAttributes() ?>>
			<span id="el_factura_estado_operacion">
<input type="text" data-table="factura" data-field="x_estado_operacion" name="x_estado_operacion" id="x_estado_operacion" size="30" placeholder="<?php echo HtmlEncode($factura->estado_operacion->getPlaceHolder()) ?>" value="<?php echo $factura->estado_operacion->EditValue ?>"<?php echo $factura->estado_operacion->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($factura->pymerfc->Visible) { // pymerfc ?>
	<div id="r_pymerfc" class="form-group row">
		<label for="x_pymerfc" class="<?php echo $factura_search->LeftColumnClass ?>"><span id="elh_factura_pymerfc"><?php echo $factura->pymerfc->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_pymerfc" id="z_pymerfc" value="LIKE"></span>
		</label>
		<div class="<?php echo $factura_search->RightColumnClass ?>"><div<?php echo $factura->pymerfc->cellAttributes() ?>>
			<span id="el_factura_pymerfc">
<input type="text" data-table="factura" data-field="x_pymerfc" name="x_pymerfc" id="x_pymerfc" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($factura->pymerfc->getPlaceHolder()) ?>" value="<?php echo $factura->pymerfc->EditValue ?>"<?php echo $factura->pymerfc->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($factura->compradorfc->Visible) { // compradorfc ?>
	<div id="r_compradorfc" class="form-group row">
		<label for="x_compradorfc" class="<?php echo $factura_search->LeftColumnClass ?>"><span id="elh_factura_compradorfc"><?php echo $factura->compradorfc->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_compradorfc" id="z_compradorfc" value="LIKE"></span>
		</label>
		<div class="<?php echo $factura_search->RightColumnClass ?>"><div<?php echo $factura->compradorfc->cellAttributes() ?>>
			<span id="el_factura_compradorfc">
<input type="text" data-table="factura" data-field="x_compradorfc" name="x_compradorfc" id="x_compradorfc" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($factura->compradorfc->getPlaceHolder()) ?>" value="<?php echo $factura->compradorfc->EditValue ?>"<?php echo $factura->compradorfc->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($factura->cadena->Visible) { // cadena ?>
	<div id="r_cadena" class="form-group row">
		<label for="x_cadena" class="<?php echo $factura_search->LeftColumnClass ?>"><span id="elh_factura_cadena"><?php echo $factura->cadena->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_cadena" id="z_cadena" value="LIKE"></span>
		</label>
		<div class="<?php echo $factura_search->RightColumnClass ?>"><div<?php echo $factura->cadena->cellAttributes() ?>>
			<span id="el_factura_cadena">
<input type="text" data-table="factura" data-field="x_cadena" name="x_cadena" id="x_cadena" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($factura->cadena->getPlaceHolder()) ?>" value="<?php echo $factura->cadena->EditValue ?>"<?php echo $factura->cadena->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($factura->vencimiento->Visible) { // vencimiento ?>
	<div id="r_vencimiento" class="form-group row">
		<label for="x_vencimiento" class="<?php echo $factura_search->LeftColumnClass ?>"><span id="elh_factura_vencimiento"><?php echo $factura->vencimiento->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_vencimiento" id="z_vencimiento" value="="></span>
		</label>
		<div class="<?php echo $factura_search->RightColumnClass ?>"><div<?php echo $factura->vencimiento->cellAttributes() ?>>
			<span id="el_factura_vencimiento">
<input type="text" data-table="factura" data-field="x_vencimiento" name="x_vencimiento" id="x_vencimiento" placeholder="<?php echo HtmlEncode($factura->vencimiento->getPlaceHolder()) ?>" value="<?php echo $factura->vencimiento->EditValue ?>"<?php echo $factura->vencimiento->editAttributes() ?>>
<?php if (!$factura->vencimiento->ReadOnly && !$factura->vencimiento->Disabled && !isset($factura->vencimiento->EditAttrs["readonly"]) && !isset($factura->vencimiento->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ffacturasearch", "x_vencimiento", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($factura->fondeadorfactura->Visible) { // fondeadorfactura ?>
	<div id="r_fondeadorfactura" class="form-group row">
		<label for="x_fondeadorfactura" class="<?php echo $factura_search->LeftColumnClass ?>"><span id="elh_factura_fondeadorfactura"><?php echo $factura->fondeadorfactura->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_fondeadorfactura" id="z_fondeadorfactura" value="="></span>
		</label>
		<div class="<?php echo $factura_search->RightColumnClass ?>"><div<?php echo $factura->fondeadorfactura->cellAttributes() ?>>
			<span id="el_factura_fondeadorfactura">
<input type="text" data-table="factura" data-field="x_fondeadorfactura" name="x_fondeadorfactura" id="x_fondeadorfactura" size="30" placeholder="<?php echo HtmlEncode($factura->fondeadorfactura->getPlaceHolder()) ?>" value="<?php echo $factura->fondeadorfactura->EditValue ?>"<?php echo $factura->fondeadorfactura->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($factura->estatusfactura->Visible) { // estatusfactura ?>
	<div id="r_estatusfactura" class="form-group row">
		<label for="x_estatusfactura" class="<?php echo $factura_search->LeftColumnClass ?>"><span id="elh_factura_estatusfactura"><?php echo $factura->estatusfactura->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_estatusfactura" id="z_estatusfactura" value="="></span>
		</label>
		<div class="<?php echo $factura_search->RightColumnClass ?>"><div<?php echo $factura->estatusfactura->cellAttributes() ?>>
			<span id="el_factura_estatusfactura">
<input type="text" data-table="factura" data-field="x_estatusfactura" name="x_estatusfactura" id="x_estatusfactura" size="30" placeholder="<?php echo HtmlEncode($factura->estatusfactura->getPlaceHolder()) ?>" value="<?php echo $factura->estatusfactura->EditValue ?>"<?php echo $factura->estatusfactura->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($factura->compradorid_comprador->Visible) { // compradorid_comprador ?>
	<div id="r_compradorid_comprador" class="form-group row">
		<label for="x_compradorid_comprador" class="<?php echo $factura_search->LeftColumnClass ?>"><span id="elh_factura_compradorid_comprador"><?php echo $factura->compradorid_comprador->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_compradorid_comprador" id="z_compradorid_comprador" value="="></span>
		</label>
		<div class="<?php echo $factura_search->RightColumnClass ?>"><div<?php echo $factura->compradorid_comprador->cellAttributes() ?>>
			<span id="el_factura_compradorid_comprador">
<input type="text" data-table="factura" data-field="x_compradorid_comprador" name="x_compradorid_comprador" id="x_compradorid_comprador" size="30" placeholder="<?php echo HtmlEncode($factura->compradorid_comprador->getPlaceHolder()) ?>" value="<?php echo $factura->compradorid_comprador->EditValue ?>"<?php echo $factura->compradorid_comprador->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($factura->fondeadorfacturaidfondeadorfact->Visible) { // fondeadorfacturaidfondeadorfact ?>
	<div id="r_fondeadorfacturaidfondeadorfact" class="form-group row">
		<label for="x_fondeadorfacturaidfondeadorfact" class="<?php echo $factura_search->LeftColumnClass ?>"><span id="elh_factura_fondeadorfacturaidfondeadorfact"><?php echo $factura->fondeadorfacturaidfondeadorfact->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_fondeadorfacturaidfondeadorfact" id="z_fondeadorfacturaidfondeadorfact" value="="></span>
		</label>
		<div class="<?php echo $factura_search->RightColumnClass ?>"><div<?php echo $factura->fondeadorfacturaidfondeadorfact->cellAttributes() ?>>
			<span id="el_factura_fondeadorfacturaidfondeadorfact">
<input type="text" data-table="factura" data-field="x_fondeadorfacturaidfondeadorfact" name="x_fondeadorfacturaidfondeadorfact" id="x_fondeadorfacturaidfondeadorfact" size="30" placeholder="<?php echo HtmlEncode($factura->fondeadorfacturaidfondeadorfact->getPlaceHolder()) ?>" value="<?php echo $factura->fondeadorfacturaidfondeadorfact->EditValue ?>"<?php echo $factura->fondeadorfacturaidfondeadorfact->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$factura_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $factura_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$factura_search->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$factura_search->terminate();
?>