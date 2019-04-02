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
$fondeadorfactura_add = new fondeadorfactura_add();

// Run the page
$fondeadorfactura_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$fondeadorfactura_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var ffondeadorfacturaadd = currentForm = new ew.Form("ffondeadorfacturaadd", "add");

// Validate form
ffondeadorfacturaadd.validate = function() {
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
		<?php if ($fondeadorfactura_add->rfcfondeador->Required) { ?>
			elm = this.getElements("x" + infix + "_rfcfondeador");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fondeadorfactura->rfcfondeador->caption(), $fondeadorfactura->rfcfondeador->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($fondeadorfactura_add->rfcfactura->Required) { ?>
			elm = this.getElements("x" + infix + "_rfcfactura");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fondeadorfactura->rfcfactura->caption(), $fondeadorfactura->rfcfactura->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($fondeadorfactura_add->porcentajedescuento->Required) { ?>
			elm = this.getElements("x" + infix + "_porcentajedescuento");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fondeadorfactura->porcentajedescuento->caption(), $fondeadorfactura->porcentajedescuento->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_porcentajedescuento");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($fondeadorfactura->porcentajedescuento->errorMessage()) ?>");
		<?php if ($fondeadorfactura_add->comprobante->Required) { ?>
			felm = this.getElements("x" + infix + "_comprobante");
			elm = this.getElements("fn_x" + infix + "_comprobante");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $fondeadorfactura->comprobante->caption(), $fondeadorfactura->comprobante->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($fondeadorfactura_add->fecha_movimiento->Required) { ?>
			elm = this.getElements("x" + infix + "_fecha_movimiento");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fondeadorfactura->fecha_movimiento->caption(), $fondeadorfactura->fecha_movimiento->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_fecha_movimiento");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($fondeadorfactura->fecha_movimiento->errorMessage()) ?>");
		<?php if ($fondeadorfactura_add->fondeadorrfc->Required) { ?>
			elm = this.getElements("x" + infix + "_fondeadorrfc");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fondeadorfactura->fondeadorrfc->caption(), $fondeadorfactura->fondeadorrfc->RequiredErrorMessage)) ?>");
		<?php } ?>

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
ffondeadorfacturaadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ffondeadorfacturaadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $fondeadorfactura_add->showPageHeader(); ?>
<?php
$fondeadorfactura_add->showMessage();
?>
<form name="ffondeadorfacturaadd" id="ffondeadorfacturaadd" class="<?php echo $fondeadorfactura_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($fondeadorfactura_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $fondeadorfactura_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="fondeadorfactura">
<?php if ($fondeadorfactura->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$fondeadorfactura_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($fondeadorfactura->rfcfondeador->Visible) { // rfcfondeador ?>
	<div id="r_rfcfondeador" class="form-group row">
		<label id="elh_fondeadorfactura_rfcfondeador" for="x_rfcfondeador" class="<?php echo $fondeadorfactura_add->LeftColumnClass ?>"><?php echo $fondeadorfactura->rfcfondeador->caption() ?><?php echo ($fondeadorfactura->rfcfondeador->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fondeadorfactura_add->RightColumnClass ?>"><div<?php echo $fondeadorfactura->rfcfondeador->cellAttributes() ?>>
<?php if (!$fondeadorfactura->isConfirm()) { ?>
<span id="el_fondeadorfactura_rfcfondeador">
<input type="text" data-table="fondeadorfactura" data-field="x_rfcfondeador" name="x_rfcfondeador" id="x_rfcfondeador" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($fondeadorfactura->rfcfondeador->getPlaceHolder()) ?>" value="<?php echo $fondeadorfactura->rfcfondeador->EditValue ?>"<?php echo $fondeadorfactura->rfcfondeador->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_fondeadorfactura_rfcfondeador">
<span<?php echo $fondeadorfactura->rfcfondeador->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($fondeadorfactura->rfcfondeador->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="fondeadorfactura" data-field="x_rfcfondeador" name="x_rfcfondeador" id="x_rfcfondeador" value="<?php echo HtmlEncode($fondeadorfactura->rfcfondeador->FormValue) ?>">
<?php } ?>
<?php echo $fondeadorfactura->rfcfondeador->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fondeadorfactura->rfcfactura->Visible) { // rfcfactura ?>
	<div id="r_rfcfactura" class="form-group row">
		<label id="elh_fondeadorfactura_rfcfactura" for="x_rfcfactura" class="<?php echo $fondeadorfactura_add->LeftColumnClass ?>"><?php echo $fondeadorfactura->rfcfactura->caption() ?><?php echo ($fondeadorfactura->rfcfactura->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fondeadorfactura_add->RightColumnClass ?>"><div<?php echo $fondeadorfactura->rfcfactura->cellAttributes() ?>>
<?php if (!$fondeadorfactura->isConfirm()) { ?>
<span id="el_fondeadorfactura_rfcfactura">
<input type="text" data-table="fondeadorfactura" data-field="x_rfcfactura" name="x_rfcfactura" id="x_rfcfactura" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($fondeadorfactura->rfcfactura->getPlaceHolder()) ?>" value="<?php echo $fondeadorfactura->rfcfactura->EditValue ?>"<?php echo $fondeadorfactura->rfcfactura->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_fondeadorfactura_rfcfactura">
<span<?php echo $fondeadorfactura->rfcfactura->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($fondeadorfactura->rfcfactura->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="fondeadorfactura" data-field="x_rfcfactura" name="x_rfcfactura" id="x_rfcfactura" value="<?php echo HtmlEncode($fondeadorfactura->rfcfactura->FormValue) ?>">
<?php } ?>
<?php echo $fondeadorfactura->rfcfactura->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fondeadorfactura->porcentajedescuento->Visible) { // porcentajedescuento ?>
	<div id="r_porcentajedescuento" class="form-group row">
		<label id="elh_fondeadorfactura_porcentajedescuento" for="x_porcentajedescuento" class="<?php echo $fondeadorfactura_add->LeftColumnClass ?>"><?php echo $fondeadorfactura->porcentajedescuento->caption() ?><?php echo ($fondeadorfactura->porcentajedescuento->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fondeadorfactura_add->RightColumnClass ?>"><div<?php echo $fondeadorfactura->porcentajedescuento->cellAttributes() ?>>
<?php if (!$fondeadorfactura->isConfirm()) { ?>
<span id="el_fondeadorfactura_porcentajedescuento">
<input type="text" data-table="fondeadorfactura" data-field="x_porcentajedescuento" name="x_porcentajedescuento" id="x_porcentajedescuento" size="30" placeholder="<?php echo HtmlEncode($fondeadorfactura->porcentajedescuento->getPlaceHolder()) ?>" value="<?php echo $fondeadorfactura->porcentajedescuento->EditValue ?>"<?php echo $fondeadorfactura->porcentajedescuento->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_fondeadorfactura_porcentajedescuento">
<span<?php echo $fondeadorfactura->porcentajedescuento->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($fondeadorfactura->porcentajedescuento->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="fondeadorfactura" data-field="x_porcentajedescuento" name="x_porcentajedescuento" id="x_porcentajedescuento" value="<?php echo HtmlEncode($fondeadorfactura->porcentajedescuento->FormValue) ?>">
<?php } ?>
<?php echo $fondeadorfactura->porcentajedescuento->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fondeadorfactura->comprobante->Visible) { // comprobante ?>
	<div id="r_comprobante" class="form-group row">
		<label id="elh_fondeadorfactura_comprobante" class="<?php echo $fondeadorfactura_add->LeftColumnClass ?>"><?php echo $fondeadorfactura->comprobante->caption() ?><?php echo ($fondeadorfactura->comprobante->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fondeadorfactura_add->RightColumnClass ?>"><div<?php echo $fondeadorfactura->comprobante->cellAttributes() ?>>
<span id="el_fondeadorfactura_comprobante">
<div id="fd_x_comprobante">
<span title="<?php echo $fondeadorfactura->comprobante->title() ? $fondeadorfactura->comprobante->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($fondeadorfactura->comprobante->ReadOnly || $fondeadorfactura->comprobante->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="fondeadorfactura" data-field="x_comprobante" name="x_comprobante" id="x_comprobante"<?php echo $fondeadorfactura->comprobante->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_comprobante" id= "fn_x_comprobante" value="<?php echo $fondeadorfactura->comprobante->Upload->FileName ?>">
<input type="hidden" name="fa_x_comprobante" id= "fa_x_comprobante" value="0">
<input type="hidden" name="fs_x_comprobante" id= "fs_x_comprobante" value="0">
<input type="hidden" name="fx_x_comprobante" id= "fx_x_comprobante" value="<?php echo $fondeadorfactura->comprobante->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_comprobante" id= "fm_x_comprobante" value="<?php echo $fondeadorfactura->comprobante->UploadMaxFileSize ?>">
</div>
<table id="ft_x_comprobante" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $fondeadorfactura->comprobante->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fondeadorfactura->fecha_movimiento->Visible) { // fecha_movimiento ?>
	<div id="r_fecha_movimiento" class="form-group row">
		<label id="elh_fondeadorfactura_fecha_movimiento" for="x_fecha_movimiento" class="<?php echo $fondeadorfactura_add->LeftColumnClass ?>"><?php echo $fondeadorfactura->fecha_movimiento->caption() ?><?php echo ($fondeadorfactura->fecha_movimiento->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fondeadorfactura_add->RightColumnClass ?>"><div<?php echo $fondeadorfactura->fecha_movimiento->cellAttributes() ?>>
<?php if (!$fondeadorfactura->isConfirm()) { ?>
<span id="el_fondeadorfactura_fecha_movimiento">
<input type="text" data-table="fondeadorfactura" data-field="x_fecha_movimiento" name="x_fecha_movimiento" id="x_fecha_movimiento" placeholder="<?php echo HtmlEncode($fondeadorfactura->fecha_movimiento->getPlaceHolder()) ?>" value="<?php echo $fondeadorfactura->fecha_movimiento->EditValue ?>"<?php echo $fondeadorfactura->fecha_movimiento->editAttributes() ?>>
<?php if (!$fondeadorfactura->fecha_movimiento->ReadOnly && !$fondeadorfactura->fecha_movimiento->Disabled && !isset($fondeadorfactura->fecha_movimiento->EditAttrs["readonly"]) && !isset($fondeadorfactura->fecha_movimiento->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ffondeadorfacturaadd", "x_fecha_movimiento", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_fondeadorfactura_fecha_movimiento">
<span<?php echo $fondeadorfactura->fecha_movimiento->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($fondeadorfactura->fecha_movimiento->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="fondeadorfactura" data-field="x_fecha_movimiento" name="x_fecha_movimiento" id="x_fecha_movimiento" value="<?php echo HtmlEncode($fondeadorfactura->fecha_movimiento->FormValue) ?>">
<?php } ?>
<?php echo $fondeadorfactura->fecha_movimiento->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fondeadorfactura->fondeadorrfc->Visible) { // fondeadorrfc ?>
	<div id="r_fondeadorrfc" class="form-group row">
		<label id="elh_fondeadorfactura_fondeadorrfc" for="x_fondeadorrfc" class="<?php echo $fondeadorfactura_add->LeftColumnClass ?>"><?php echo $fondeadorfactura->fondeadorrfc->caption() ?><?php echo ($fondeadorfactura->fondeadorrfc->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fondeadorfactura_add->RightColumnClass ?>"><div<?php echo $fondeadorfactura->fondeadorrfc->cellAttributes() ?>>
<?php if (!$fondeadorfactura->isConfirm()) { ?>
<span id="el_fondeadorfactura_fondeadorrfc">
<input type="text" data-table="fondeadorfactura" data-field="x_fondeadorrfc" name="x_fondeadorrfc" id="x_fondeadorrfc" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($fondeadorfactura->fondeadorrfc->getPlaceHolder()) ?>" value="<?php echo $fondeadorfactura->fondeadorrfc->EditValue ?>"<?php echo $fondeadorfactura->fondeadorrfc->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_fondeadorfactura_fondeadorrfc">
<span<?php echo $fondeadorfactura->fondeadorrfc->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($fondeadorfactura->fondeadorrfc->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="fondeadorfactura" data-field="x_fondeadorrfc" name="x_fondeadorrfc" id="x_fondeadorrfc" value="<?php echo HtmlEncode($fondeadorfactura->fondeadorrfc->FormValue) ?>">
<?php } ?>
<?php echo $fondeadorfactura->fondeadorrfc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$fondeadorfactura_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $fondeadorfactura_add->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$fondeadorfactura->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $fondeadorfactura_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$fondeadorfactura_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$fondeadorfactura_add->terminate();
?>