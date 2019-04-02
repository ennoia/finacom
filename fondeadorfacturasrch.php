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
$fondeadorfactura_search = new fondeadorfactura_search();

// Run the page
$fondeadorfactura_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$fondeadorfactura_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "search";
<?php if ($fondeadorfactura_search->IsModal) { ?>
var ffondeadorfacturasearch = currentAdvancedSearchForm = new ew.Form("ffondeadorfacturasearch", "search");
<?php } else { ?>
var ffondeadorfacturasearch = currentForm = new ew.Form("ffondeadorfacturasearch", "search");
<?php } ?>

// Form_CustomValidate event
ffondeadorfacturasearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ffondeadorfacturasearch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search
// Validate function for search

ffondeadorfacturasearch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_idfondeadorfact");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($fondeadorfactura->idfondeadorfact->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_porcentajedescuento");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($fondeadorfactura->porcentajedescuento->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_fecha_movimiento");
	if (elm && !ew.checkDateDef(elm.value))
		return this.onError(elm, "<?php echo JsEncode($fondeadorfactura->fecha_movimiento->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $fondeadorfactura_search->showPageHeader(); ?>
<?php
$fondeadorfactura_search->showMessage();
?>
<form name="ffondeadorfacturasearch" id="ffondeadorfacturasearch" class="<?php echo $fondeadorfactura_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($fondeadorfactura_search->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $fondeadorfactura_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="fondeadorfactura">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$fondeadorfactura_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($fondeadorfactura->idfondeadorfact->Visible) { // idfondeadorfact ?>
	<div id="r_idfondeadorfact" class="form-group row">
		<label for="x_idfondeadorfact" class="<?php echo $fondeadorfactura_search->LeftColumnClass ?>"><span id="elh_fondeadorfactura_idfondeadorfact"><?php echo $fondeadorfactura->idfondeadorfact->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_idfondeadorfact" id="z_idfondeadorfact" value="="></span>
		</label>
		<div class="<?php echo $fondeadorfactura_search->RightColumnClass ?>"><div<?php echo $fondeadorfactura->idfondeadorfact->cellAttributes() ?>>
			<span id="el_fondeadorfactura_idfondeadorfact">
<input type="text" data-table="fondeadorfactura" data-field="x_idfondeadorfact" name="x_idfondeadorfact" id="x_idfondeadorfact" placeholder="<?php echo HtmlEncode($fondeadorfactura->idfondeadorfact->getPlaceHolder()) ?>" value="<?php echo $fondeadorfactura->idfondeadorfact->EditValue ?>"<?php echo $fondeadorfactura->idfondeadorfact->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($fondeadorfactura->rfcfondeador->Visible) { // rfcfondeador ?>
	<div id="r_rfcfondeador" class="form-group row">
		<label for="x_rfcfondeador" class="<?php echo $fondeadorfactura_search->LeftColumnClass ?>"><span id="elh_fondeadorfactura_rfcfondeador"><?php echo $fondeadorfactura->rfcfondeador->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_rfcfondeador" id="z_rfcfondeador" value="LIKE"></span>
		</label>
		<div class="<?php echo $fondeadorfactura_search->RightColumnClass ?>"><div<?php echo $fondeadorfactura->rfcfondeador->cellAttributes() ?>>
			<span id="el_fondeadorfactura_rfcfondeador">
<input type="text" data-table="fondeadorfactura" data-field="x_rfcfondeador" name="x_rfcfondeador" id="x_rfcfondeador" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($fondeadorfactura->rfcfondeador->getPlaceHolder()) ?>" value="<?php echo $fondeadorfactura->rfcfondeador->EditValue ?>"<?php echo $fondeadorfactura->rfcfondeador->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($fondeadorfactura->rfcfactura->Visible) { // rfcfactura ?>
	<div id="r_rfcfactura" class="form-group row">
		<label for="x_rfcfactura" class="<?php echo $fondeadorfactura_search->LeftColumnClass ?>"><span id="elh_fondeadorfactura_rfcfactura"><?php echo $fondeadorfactura->rfcfactura->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_rfcfactura" id="z_rfcfactura" value="LIKE"></span>
		</label>
		<div class="<?php echo $fondeadorfactura_search->RightColumnClass ?>"><div<?php echo $fondeadorfactura->rfcfactura->cellAttributes() ?>>
			<span id="el_fondeadorfactura_rfcfactura">
<input type="text" data-table="fondeadorfactura" data-field="x_rfcfactura" name="x_rfcfactura" id="x_rfcfactura" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($fondeadorfactura->rfcfactura->getPlaceHolder()) ?>" value="<?php echo $fondeadorfactura->rfcfactura->EditValue ?>"<?php echo $fondeadorfactura->rfcfactura->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($fondeadorfactura->porcentajedescuento->Visible) { // porcentajedescuento ?>
	<div id="r_porcentajedescuento" class="form-group row">
		<label for="x_porcentajedescuento" class="<?php echo $fondeadorfactura_search->LeftColumnClass ?>"><span id="elh_fondeadorfactura_porcentajedescuento"><?php echo $fondeadorfactura->porcentajedescuento->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_porcentajedescuento" id="z_porcentajedescuento" value="="></span>
		</label>
		<div class="<?php echo $fondeadorfactura_search->RightColumnClass ?>"><div<?php echo $fondeadorfactura->porcentajedescuento->cellAttributes() ?>>
			<span id="el_fondeadorfactura_porcentajedescuento">
<input type="text" data-table="fondeadorfactura" data-field="x_porcentajedescuento" name="x_porcentajedescuento" id="x_porcentajedescuento" size="30" placeholder="<?php echo HtmlEncode($fondeadorfactura->porcentajedescuento->getPlaceHolder()) ?>" value="<?php echo $fondeadorfactura->porcentajedescuento->EditValue ?>"<?php echo $fondeadorfactura->porcentajedescuento->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($fondeadorfactura->fecha_movimiento->Visible) { // fecha_movimiento ?>
	<div id="r_fecha_movimiento" class="form-group row">
		<label for="x_fecha_movimiento" class="<?php echo $fondeadorfactura_search->LeftColumnClass ?>"><span id="elh_fondeadorfactura_fecha_movimiento"><?php echo $fondeadorfactura->fecha_movimiento->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_fecha_movimiento" id="z_fecha_movimiento" value="="></span>
		</label>
		<div class="<?php echo $fondeadorfactura_search->RightColumnClass ?>"><div<?php echo $fondeadorfactura->fecha_movimiento->cellAttributes() ?>>
			<span id="el_fondeadorfactura_fecha_movimiento">
<input type="text" data-table="fondeadorfactura" data-field="x_fecha_movimiento" name="x_fecha_movimiento" id="x_fecha_movimiento" placeholder="<?php echo HtmlEncode($fondeadorfactura->fecha_movimiento->getPlaceHolder()) ?>" value="<?php echo $fondeadorfactura->fecha_movimiento->EditValue ?>"<?php echo $fondeadorfactura->fecha_movimiento->editAttributes() ?>>
<?php if (!$fondeadorfactura->fecha_movimiento->ReadOnly && !$fondeadorfactura->fecha_movimiento->Disabled && !isset($fondeadorfactura->fecha_movimiento->EditAttrs["readonly"]) && !isset($fondeadorfactura->fecha_movimiento->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ffondeadorfacturasearch", "x_fecha_movimiento", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($fondeadorfactura->fondeadorrfc->Visible) { // fondeadorrfc ?>
	<div id="r_fondeadorrfc" class="form-group row">
		<label for="x_fondeadorrfc" class="<?php echo $fondeadorfactura_search->LeftColumnClass ?>"><span id="elh_fondeadorfactura_fondeadorrfc"><?php echo $fondeadorfactura->fondeadorrfc->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_fondeadorrfc" id="z_fondeadorrfc" value="LIKE"></span>
		</label>
		<div class="<?php echo $fondeadorfactura_search->RightColumnClass ?>"><div<?php echo $fondeadorfactura->fondeadorrfc->cellAttributes() ?>>
			<span id="el_fondeadorfactura_fondeadorrfc">
<input type="text" data-table="fondeadorfactura" data-field="x_fondeadorrfc" name="x_fondeadorrfc" id="x_fondeadorrfc" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($fondeadorfactura->fondeadorrfc->getPlaceHolder()) ?>" value="<?php echo $fondeadorfactura->fondeadorrfc->EditValue ?>"<?php echo $fondeadorfactura->fondeadorrfc->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$fondeadorfactura_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $fondeadorfactura_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$fondeadorfactura_search->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$fondeadorfactura_search->terminate();
?>