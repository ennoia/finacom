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
$bitacora_factura_edit = new bitacora_factura_edit();

// Run the page
$bitacora_factura_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bitacora_factura_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fbitacora_facturaedit = currentForm = new ew.Form("fbitacora_facturaedit", "edit");

// Validate form
fbitacora_facturaedit.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
	if ($fobj.find("#confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		<?php if ($bitacora_factura_edit->idfregfactura->Required) { ?>
			elm = this.getElements("x" + infix + "_idfregfactura");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bitacora_factura->idfregfactura->caption(), $bitacora_factura->idfregfactura->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($bitacora_factura_edit->ofertacomision->Required) { ?>
			elm = this.getElements("x" + infix + "_ofertacomision");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bitacora_factura->ofertacomision->caption(), $bitacora_factura->ofertacomision->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($bitacora_factura_edit->fecha_movimiento->Required) { ?>
			elm = this.getElements("x" + infix + "_fecha_movimiento");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bitacora_factura->fecha_movimiento->caption(), $bitacora_factura->fecha_movimiento->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_fecha_movimiento");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($bitacora_factura->fecha_movimiento->errorMessage()) ?>");
		<?php if ($bitacora_factura_edit->fondeadore->Required) { ?>
			elm = this.getElements("x" + infix + "_fondeadore");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bitacora_factura->fondeadore->caption(), $bitacora_factura->fondeadore->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_fondeadore");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($bitacora_factura->fondeadore->errorMessage()) ?>");
		<?php if ($bitacora_factura_edit->movimiento->Required) { ?>
			elm = this.getElements("x" + infix + "_movimiento");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bitacora_factura->movimiento->caption(), $bitacora_factura->movimiento->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_movimiento");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($bitacora_factura->movimiento->errorMessage()) ?>");
		<?php if ($bitacora_factura_edit->oferta->Required) { ?>
			elm = this.getElements("x" + infix + "_oferta");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bitacora_factura->oferta->caption(), $bitacora_factura->oferta->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_oferta");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($bitacora_factura->oferta->errorMessage()) ?>");
		<?php if ($bitacora_factura_edit->factrfc_idfac->Required) { ?>
			elm = this.getElements("x" + infix + "_factrfc_idfac");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bitacora_factura->factrfc_idfac->caption(), $bitacora_factura->factrfc_idfac->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($bitacora_factura_edit->Column->Required) { ?>
			elm = this.getElements("x" + infix + "_Column");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bitacora_factura->Column->caption(), $bitacora_factura->Column->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Column");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($bitacora_factura->Column->errorMessage()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ew.forms[val])
			if (!ew.forms[val].validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
fbitacora_facturaedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fbitacora_facturaedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $bitacora_factura_edit->showPageHeader(); ?>
<?php
$bitacora_factura_edit->showMessage();
?>
<form name="fbitacora_facturaedit" id="fbitacora_facturaedit" class="<?php echo $bitacora_factura_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($bitacora_factura_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $bitacora_factura_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bitacora_factura">
<input type="hidden" name="k_hash" id="k_hash" value="<?php echo $bitacora_factura_edit->HashValue ?>">
<?php if ($bitacora_factura->UpdateConflict == "U") { // Record already updated by other user ?>
<input type="hidden" name="conflict" id="conflict" value="1">
<?php } ?>
<?php if ($bitacora_factura->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$bitacora_factura_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($bitacora_factura->idfregfactura->Visible) { // idfregfactura ?>
	<div id="r_idfregfactura" class="form-group row">
		<label id="elh_bitacora_factura_idfregfactura" for="x_idfregfactura" class="<?php echo $bitacora_factura_edit->LeftColumnClass ?>"><?php echo $bitacora_factura->idfregfactura->caption() ?><?php echo ($bitacora_factura->idfregfactura->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bitacora_factura_edit->RightColumnClass ?>"><div<?php echo $bitacora_factura->idfregfactura->cellAttributes() ?>>
<?php if (!$bitacora_factura->isConfirm()) { ?>
<span id="el_bitacora_factura_idfregfactura">
<span<?php echo $bitacora_factura->idfregfactura->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($bitacora_factura->idfregfactura->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="bitacora_factura" data-field="x_idfregfactura" name="x_idfregfactura" id="x_idfregfactura" value="<?php echo HtmlEncode($bitacora_factura->idfregfactura->CurrentValue) ?>">
<?php } else { ?>
<span id="el_bitacora_factura_idfregfactura">
<span<?php echo $bitacora_factura->idfregfactura->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($bitacora_factura->idfregfactura->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="bitacora_factura" data-field="x_idfregfactura" name="x_idfregfactura" id="x_idfregfactura" value="<?php echo HtmlEncode($bitacora_factura->idfregfactura->FormValue) ?>">
<?php } ?>
<?php echo $bitacora_factura->idfregfactura->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bitacora_factura->ofertacomision->Visible) { // ofertacomision ?>
	<div id="r_ofertacomision" class="form-group row">
		<label id="elh_bitacora_factura_ofertacomision" for="x_ofertacomision" class="<?php echo $bitacora_factura_edit->LeftColumnClass ?>"><?php echo $bitacora_factura->ofertacomision->caption() ?><?php echo ($bitacora_factura->ofertacomision->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bitacora_factura_edit->RightColumnClass ?>"><div<?php echo $bitacora_factura->ofertacomision->cellAttributes() ?>>
<?php if (!$bitacora_factura->isConfirm()) { ?>
<span id="el_bitacora_factura_ofertacomision">
<input type="text" data-table="bitacora_factura" data-field="x_ofertacomision" name="x_ofertacomision" id="x_ofertacomision" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($bitacora_factura->ofertacomision->getPlaceHolder()) ?>" value="<?php echo $bitacora_factura->ofertacomision->EditValue ?>"<?php echo $bitacora_factura->ofertacomision->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_bitacora_factura_ofertacomision">
<span<?php echo $bitacora_factura->ofertacomision->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($bitacora_factura->ofertacomision->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="bitacora_factura" data-field="x_ofertacomision" name="x_ofertacomision" id="x_ofertacomision" value="<?php echo HtmlEncode($bitacora_factura->ofertacomision->FormValue) ?>">
<?php } ?>
<?php echo $bitacora_factura->ofertacomision->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bitacora_factura->fecha_movimiento->Visible) { // fecha_movimiento ?>
	<div id="r_fecha_movimiento" class="form-group row">
		<label id="elh_bitacora_factura_fecha_movimiento" for="x_fecha_movimiento" class="<?php echo $bitacora_factura_edit->LeftColumnClass ?>"><?php echo $bitacora_factura->fecha_movimiento->caption() ?><?php echo ($bitacora_factura->fecha_movimiento->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bitacora_factura_edit->RightColumnClass ?>"><div<?php echo $bitacora_factura->fecha_movimiento->cellAttributes() ?>>
<?php if (!$bitacora_factura->isConfirm()) { ?>
<span id="el_bitacora_factura_fecha_movimiento">
<input type="text" data-table="bitacora_factura" data-field="x_fecha_movimiento" name="x_fecha_movimiento" id="x_fecha_movimiento" placeholder="<?php echo HtmlEncode($bitacora_factura->fecha_movimiento->getPlaceHolder()) ?>" value="<?php echo $bitacora_factura->fecha_movimiento->EditValue ?>"<?php echo $bitacora_factura->fecha_movimiento->editAttributes() ?>>
<?php if (!$bitacora_factura->fecha_movimiento->ReadOnly && !$bitacora_factura->fecha_movimiento->Disabled && !isset($bitacora_factura->fecha_movimiento->EditAttrs["readonly"]) && !isset($bitacora_factura->fecha_movimiento->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fbitacora_facturaedit", "x_fecha_movimiento", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_bitacora_factura_fecha_movimiento">
<span<?php echo $bitacora_factura->fecha_movimiento->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($bitacora_factura->fecha_movimiento->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="bitacora_factura" data-field="x_fecha_movimiento" name="x_fecha_movimiento" id="x_fecha_movimiento" value="<?php echo HtmlEncode($bitacora_factura->fecha_movimiento->FormValue) ?>">
<?php } ?>
<?php echo $bitacora_factura->fecha_movimiento->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bitacora_factura->fondeadore->Visible) { // fondeadore ?>
	<div id="r_fondeadore" class="form-group row">
		<label id="elh_bitacora_factura_fondeadore" for="x_fondeadore" class="<?php echo $bitacora_factura_edit->LeftColumnClass ?>"><?php echo $bitacora_factura->fondeadore->caption() ?><?php echo ($bitacora_factura->fondeadore->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bitacora_factura_edit->RightColumnClass ?>"><div<?php echo $bitacora_factura->fondeadore->cellAttributes() ?>>
<?php if (!$bitacora_factura->isConfirm()) { ?>
<span id="el_bitacora_factura_fondeadore">
<input type="text" data-table="bitacora_factura" data-field="x_fondeadore" name="x_fondeadore" id="x_fondeadore" size="30" placeholder="<?php echo HtmlEncode($bitacora_factura->fondeadore->getPlaceHolder()) ?>" value="<?php echo $bitacora_factura->fondeadore->EditValue ?>"<?php echo $bitacora_factura->fondeadore->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_bitacora_factura_fondeadore">
<span<?php echo $bitacora_factura->fondeadore->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($bitacora_factura->fondeadore->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="bitacora_factura" data-field="x_fondeadore" name="x_fondeadore" id="x_fondeadore" value="<?php echo HtmlEncode($bitacora_factura->fondeadore->FormValue) ?>">
<?php } ?>
<?php echo $bitacora_factura->fondeadore->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bitacora_factura->movimiento->Visible) { // movimiento ?>
	<div id="r_movimiento" class="form-group row">
		<label id="elh_bitacora_factura_movimiento" for="x_movimiento" class="<?php echo $bitacora_factura_edit->LeftColumnClass ?>"><?php echo $bitacora_factura->movimiento->caption() ?><?php echo ($bitacora_factura->movimiento->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bitacora_factura_edit->RightColumnClass ?>"><div<?php echo $bitacora_factura->movimiento->cellAttributes() ?>>
<?php if (!$bitacora_factura->isConfirm()) { ?>
<span id="el_bitacora_factura_movimiento">
<input type="text" data-table="bitacora_factura" data-field="x_movimiento" name="x_movimiento" id="x_movimiento" size="30" placeholder="<?php echo HtmlEncode($bitacora_factura->movimiento->getPlaceHolder()) ?>" value="<?php echo $bitacora_factura->movimiento->EditValue ?>"<?php echo $bitacora_factura->movimiento->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_bitacora_factura_movimiento">
<span<?php echo $bitacora_factura->movimiento->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($bitacora_factura->movimiento->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="bitacora_factura" data-field="x_movimiento" name="x_movimiento" id="x_movimiento" value="<?php echo HtmlEncode($bitacora_factura->movimiento->FormValue) ?>">
<?php } ?>
<?php echo $bitacora_factura->movimiento->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bitacora_factura->oferta->Visible) { // oferta ?>
	<div id="r_oferta" class="form-group row">
		<label id="elh_bitacora_factura_oferta" for="x_oferta" class="<?php echo $bitacora_factura_edit->LeftColumnClass ?>"><?php echo $bitacora_factura->oferta->caption() ?><?php echo ($bitacora_factura->oferta->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bitacora_factura_edit->RightColumnClass ?>"><div<?php echo $bitacora_factura->oferta->cellAttributes() ?>>
<?php if (!$bitacora_factura->isConfirm()) { ?>
<span id="el_bitacora_factura_oferta">
<input type="text" data-table="bitacora_factura" data-field="x_oferta" name="x_oferta" id="x_oferta" size="30" placeholder="<?php echo HtmlEncode($bitacora_factura->oferta->getPlaceHolder()) ?>" value="<?php echo $bitacora_factura->oferta->EditValue ?>"<?php echo $bitacora_factura->oferta->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_bitacora_factura_oferta">
<span<?php echo $bitacora_factura->oferta->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($bitacora_factura->oferta->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="bitacora_factura" data-field="x_oferta" name="x_oferta" id="x_oferta" value="<?php echo HtmlEncode($bitacora_factura->oferta->FormValue) ?>">
<?php } ?>
<?php echo $bitacora_factura->oferta->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bitacora_factura->factrfc_idfac->Visible) { // factrfc_idfac ?>
	<div id="r_factrfc_idfac" class="form-group row">
		<label id="elh_bitacora_factura_factrfc_idfac" for="x_factrfc_idfac" class="<?php echo $bitacora_factura_edit->LeftColumnClass ?>"><?php echo $bitacora_factura->factrfc_idfac->caption() ?><?php echo ($bitacora_factura->factrfc_idfac->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bitacora_factura_edit->RightColumnClass ?>"><div<?php echo $bitacora_factura->factrfc_idfac->cellAttributes() ?>>
<?php if (!$bitacora_factura->isConfirm()) { ?>
<span id="el_bitacora_factura_factrfc_idfac">
<input type="text" data-table="bitacora_factura" data-field="x_factrfc_idfac" name="x_factrfc_idfac" id="x_factrfc_idfac" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($bitacora_factura->factrfc_idfac->getPlaceHolder()) ?>" value="<?php echo $bitacora_factura->factrfc_idfac->EditValue ?>"<?php echo $bitacora_factura->factrfc_idfac->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_bitacora_factura_factrfc_idfac">
<span<?php echo $bitacora_factura->factrfc_idfac->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($bitacora_factura->factrfc_idfac->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="bitacora_factura" data-field="x_factrfc_idfac" name="x_factrfc_idfac" id="x_factrfc_idfac" value="<?php echo HtmlEncode($bitacora_factura->factrfc_idfac->FormValue) ?>">
<?php } ?>
<?php echo $bitacora_factura->factrfc_idfac->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bitacora_factura->Column->Visible) { // Column ?>
	<div id="r_Column" class="form-group row">
		<label id="elh_bitacora_factura_Column" for="x_Column" class="<?php echo $bitacora_factura_edit->LeftColumnClass ?>"><?php echo $bitacora_factura->Column->caption() ?><?php echo ($bitacora_factura->Column->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bitacora_factura_edit->RightColumnClass ?>"><div<?php echo $bitacora_factura->Column->cellAttributes() ?>>
<?php if (!$bitacora_factura->isConfirm()) { ?>
<span id="el_bitacora_factura_Column">
<input type="text" data-table="bitacora_factura" data-field="x_Column" name="x_Column" id="x_Column" size="30" placeholder="<?php echo HtmlEncode($bitacora_factura->Column->getPlaceHolder()) ?>" value="<?php echo $bitacora_factura->Column->EditValue ?>"<?php echo $bitacora_factura->Column->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_bitacora_factura_Column">
<span<?php echo $bitacora_factura->Column->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($bitacora_factura->Column->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="bitacora_factura" data-field="x_Column" name="x_Column" id="x_Column" value="<?php echo HtmlEncode($bitacora_factura->Column->FormValue) ?>">
<?php } ?>
<?php echo $bitacora_factura->Column->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$bitacora_factura_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $bitacora_factura_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if ($bitacora_factura->UpdateConflict == "U") { // Record already updated by other user ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='overwrite';"><?php echo $Language->phrase("OverwriteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-reload" id="btn-reload" type="submit" onclick="this.form.action.value='show';"><?php echo $Language->phrase("ReloadBtn") ?></button>
<?php } else { ?>
<?php if (!$bitacora_factura->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $bitacora_factura_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$bitacora_factura_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$bitacora_factura_edit->terminate();
?>