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
$bitacora_factura_search = new bitacora_factura_search();

// Run the page
$bitacora_factura_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bitacora_factura_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "search";
<?php if ($bitacora_factura_search->IsModal) { ?>
var fbitacora_facturasearch = currentAdvancedSearchForm = new ew.Form("fbitacora_facturasearch", "search");
<?php } else { ?>
var fbitacora_facturasearch = currentForm = new ew.Form("fbitacora_facturasearch", "search");
<?php } ?>

// Form_CustomValidate event
fbitacora_facturasearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fbitacora_facturasearch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search
// Validate function for search

fbitacora_facturasearch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_fecha_movimiento");
	if (elm && !ew.checkDateDef(elm.value))
		return this.onError(elm, "<?php echo JsEncode($bitacora_factura->fecha_movimiento->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_fondeadore");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($bitacora_factura->fondeadore->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_movimiento");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($bitacora_factura->movimiento->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_oferta");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($bitacora_factura->oferta->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_Column");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($bitacora_factura->Column->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $bitacora_factura_search->showPageHeader(); ?>
<?php
$bitacora_factura_search->showMessage();
?>
<form name="fbitacora_facturasearch" id="fbitacora_facturasearch" class="<?php echo $bitacora_factura_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($bitacora_factura_search->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $bitacora_factura_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bitacora_factura">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$bitacora_factura_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($bitacora_factura->idfregfactura->Visible) { // idfregfactura ?>
	<div id="r_idfregfactura" class="form-group row">
		<label for="x_idfregfactura" class="<?php echo $bitacora_factura_search->LeftColumnClass ?>"><span id="elh_bitacora_factura_idfregfactura"><?php echo $bitacora_factura->idfregfactura->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_idfregfactura" id="z_idfregfactura" value="LIKE"></span>
		</label>
		<div class="<?php echo $bitacora_factura_search->RightColumnClass ?>"><div<?php echo $bitacora_factura->idfregfactura->cellAttributes() ?>>
			<span id="el_bitacora_factura_idfregfactura">
<input type="text" data-table="bitacora_factura" data-field="x_idfregfactura" name="x_idfregfactura" id="x_idfregfactura" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($bitacora_factura->idfregfactura->getPlaceHolder()) ?>" value="<?php echo $bitacora_factura->idfregfactura->EditValue ?>"<?php echo $bitacora_factura->idfregfactura->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($bitacora_factura->ofertacomision->Visible) { // ofertacomision ?>
	<div id="r_ofertacomision" class="form-group row">
		<label for="x_ofertacomision" class="<?php echo $bitacora_factura_search->LeftColumnClass ?>"><span id="elh_bitacora_factura_ofertacomision"><?php echo $bitacora_factura->ofertacomision->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_ofertacomision" id="z_ofertacomision" value="LIKE"></span>
		</label>
		<div class="<?php echo $bitacora_factura_search->RightColumnClass ?>"><div<?php echo $bitacora_factura->ofertacomision->cellAttributes() ?>>
			<span id="el_bitacora_factura_ofertacomision">
<input type="text" data-table="bitacora_factura" data-field="x_ofertacomision" name="x_ofertacomision" id="x_ofertacomision" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($bitacora_factura->ofertacomision->getPlaceHolder()) ?>" value="<?php echo $bitacora_factura->ofertacomision->EditValue ?>"<?php echo $bitacora_factura->ofertacomision->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($bitacora_factura->fecha_movimiento->Visible) { // fecha_movimiento ?>
	<div id="r_fecha_movimiento" class="form-group row">
		<label for="x_fecha_movimiento" class="<?php echo $bitacora_factura_search->LeftColumnClass ?>"><span id="elh_bitacora_factura_fecha_movimiento"><?php echo $bitacora_factura->fecha_movimiento->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_fecha_movimiento" id="z_fecha_movimiento" value="="></span>
		</label>
		<div class="<?php echo $bitacora_factura_search->RightColumnClass ?>"><div<?php echo $bitacora_factura->fecha_movimiento->cellAttributes() ?>>
			<span id="el_bitacora_factura_fecha_movimiento">
<input type="text" data-table="bitacora_factura" data-field="x_fecha_movimiento" name="x_fecha_movimiento" id="x_fecha_movimiento" placeholder="<?php echo HtmlEncode($bitacora_factura->fecha_movimiento->getPlaceHolder()) ?>" value="<?php echo $bitacora_factura->fecha_movimiento->EditValue ?>"<?php echo $bitacora_factura->fecha_movimiento->editAttributes() ?>>
<?php if (!$bitacora_factura->fecha_movimiento->ReadOnly && !$bitacora_factura->fecha_movimiento->Disabled && !isset($bitacora_factura->fecha_movimiento->EditAttrs["readonly"]) && !isset($bitacora_factura->fecha_movimiento->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fbitacora_facturasearch", "x_fecha_movimiento", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($bitacora_factura->fondeadore->Visible) { // fondeadore ?>
	<div id="r_fondeadore" class="form-group row">
		<label for="x_fondeadore" class="<?php echo $bitacora_factura_search->LeftColumnClass ?>"><span id="elh_bitacora_factura_fondeadore"><?php echo $bitacora_factura->fondeadore->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_fondeadore" id="z_fondeadore" value="="></span>
		</label>
		<div class="<?php echo $bitacora_factura_search->RightColumnClass ?>"><div<?php echo $bitacora_factura->fondeadore->cellAttributes() ?>>
			<span id="el_bitacora_factura_fondeadore">
<input type="text" data-table="bitacora_factura" data-field="x_fondeadore" name="x_fondeadore" id="x_fondeadore" size="30" placeholder="<?php echo HtmlEncode($bitacora_factura->fondeadore->getPlaceHolder()) ?>" value="<?php echo $bitacora_factura->fondeadore->EditValue ?>"<?php echo $bitacora_factura->fondeadore->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($bitacora_factura->movimiento->Visible) { // movimiento ?>
	<div id="r_movimiento" class="form-group row">
		<label for="x_movimiento" class="<?php echo $bitacora_factura_search->LeftColumnClass ?>"><span id="elh_bitacora_factura_movimiento"><?php echo $bitacora_factura->movimiento->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_movimiento" id="z_movimiento" value="="></span>
		</label>
		<div class="<?php echo $bitacora_factura_search->RightColumnClass ?>"><div<?php echo $bitacora_factura->movimiento->cellAttributes() ?>>
			<span id="el_bitacora_factura_movimiento">
<input type="text" data-table="bitacora_factura" data-field="x_movimiento" name="x_movimiento" id="x_movimiento" size="30" placeholder="<?php echo HtmlEncode($bitacora_factura->movimiento->getPlaceHolder()) ?>" value="<?php echo $bitacora_factura->movimiento->EditValue ?>"<?php echo $bitacora_factura->movimiento->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($bitacora_factura->oferta->Visible) { // oferta ?>
	<div id="r_oferta" class="form-group row">
		<label for="x_oferta" class="<?php echo $bitacora_factura_search->LeftColumnClass ?>"><span id="elh_bitacora_factura_oferta"><?php echo $bitacora_factura->oferta->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_oferta" id="z_oferta" value="="></span>
		</label>
		<div class="<?php echo $bitacora_factura_search->RightColumnClass ?>"><div<?php echo $bitacora_factura->oferta->cellAttributes() ?>>
			<span id="el_bitacora_factura_oferta">
<input type="text" data-table="bitacora_factura" data-field="x_oferta" name="x_oferta" id="x_oferta" size="30" placeholder="<?php echo HtmlEncode($bitacora_factura->oferta->getPlaceHolder()) ?>" value="<?php echo $bitacora_factura->oferta->EditValue ?>"<?php echo $bitacora_factura->oferta->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($bitacora_factura->factrfc_idfac->Visible) { // factrfc_idfac ?>
	<div id="r_factrfc_idfac" class="form-group row">
		<label for="x_factrfc_idfac" class="<?php echo $bitacora_factura_search->LeftColumnClass ?>"><span id="elh_bitacora_factura_factrfc_idfac"><?php echo $bitacora_factura->factrfc_idfac->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_factrfc_idfac" id="z_factrfc_idfac" value="LIKE"></span>
		</label>
		<div class="<?php echo $bitacora_factura_search->RightColumnClass ?>"><div<?php echo $bitacora_factura->factrfc_idfac->cellAttributes() ?>>
			<span id="el_bitacora_factura_factrfc_idfac">
<input type="text" data-table="bitacora_factura" data-field="x_factrfc_idfac" name="x_factrfc_idfac" id="x_factrfc_idfac" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($bitacora_factura->factrfc_idfac->getPlaceHolder()) ?>" value="<?php echo $bitacora_factura->factrfc_idfac->EditValue ?>"<?php echo $bitacora_factura->factrfc_idfac->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($bitacora_factura->Column->Visible) { // Column ?>
	<div id="r_Column" class="form-group row">
		<label for="x_Column" class="<?php echo $bitacora_factura_search->LeftColumnClass ?>"><span id="elh_bitacora_factura_Column"><?php echo $bitacora_factura->Column->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_Column" id="z_Column" value="="></span>
		</label>
		<div class="<?php echo $bitacora_factura_search->RightColumnClass ?>"><div<?php echo $bitacora_factura->Column->cellAttributes() ?>>
			<span id="el_bitacora_factura_Column">
<input type="text" data-table="bitacora_factura" data-field="x_Column" name="x_Column" id="x_Column" size="30" placeholder="<?php echo HtmlEncode($bitacora_factura->Column->getPlaceHolder()) ?>" value="<?php echo $bitacora_factura->Column->EditValue ?>"<?php echo $bitacora_factura->Column->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$bitacora_factura_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $bitacora_factura_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$bitacora_factura_search->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$bitacora_factura_search->terminate();
?>