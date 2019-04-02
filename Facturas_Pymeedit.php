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
$Facturas_Pyme_edit = new Facturas_Pyme_edit();

// Run the page
$Facturas_Pyme_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Facturas_Pyme_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fFacturas_Pymeedit = currentForm = new ew.Form("fFacturas_Pymeedit", "edit");

// Validate form
fFacturas_Pymeedit.validate = function() {
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
		<?php if ($Facturas_Pyme_edit->rfcfactura->Required) { ?>
			elm = this.getElements("x" + infix + "_rfcfactura");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Facturas_Pyme->rfcfactura->caption(), $Facturas_Pyme->rfcfactura->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($Facturas_Pyme_edit->idfactura->Required) { ?>
			elm = this.getElements("x" + infix + "_idfactura");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Facturas_Pyme->idfactura->caption(), $Facturas_Pyme->idfactura->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_idfactura");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($Facturas_Pyme->idfactura->errorMessage()) ?>");
		<?php if ($Facturas_Pyme_edit->monto->Required) { ?>
			elm = this.getElements("x" + infix + "_monto");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Facturas_Pyme->monto->caption(), $Facturas_Pyme->monto->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_monto");
			if (elm && !ew.checkNumber(elm.value))
				return this.onError(elm, "<?php echo JsEncode($Facturas_Pyme->monto->errorMessage()) ?>");
		<?php if ($Facturas_Pyme_edit->estado_operacion->Required) { ?>
			elm = this.getElements("x" + infix + "_estado_operacion");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Facturas_Pyme->estado_operacion->caption(), $Facturas_Pyme->estado_operacion->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_estado_operacion");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($Facturas_Pyme->estado_operacion->errorMessage()) ?>");
		<?php if ($Facturas_Pyme_edit->pymerfc->Required) { ?>
			elm = this.getElements("x" + infix + "_pymerfc");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Facturas_Pyme->pymerfc->caption(), $Facturas_Pyme->pymerfc->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($Facturas_Pyme_edit->compradorfc->Required) { ?>
			elm = this.getElements("x" + infix + "_compradorfc");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Facturas_Pyme->compradorfc->caption(), $Facturas_Pyme->compradorfc->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($Facturas_Pyme_edit->cadena->Required) { ?>
			elm = this.getElements("x" + infix + "_cadena");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Facturas_Pyme->cadena->caption(), $Facturas_Pyme->cadena->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($Facturas_Pyme_edit->vencimiento->Required) { ?>
			elm = this.getElements("x" + infix + "_vencimiento");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Facturas_Pyme->vencimiento->caption(), $Facturas_Pyme->vencimiento->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_vencimiento");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($Facturas_Pyme->vencimiento->errorMessage()) ?>");
		<?php if ($Facturas_Pyme_edit->fondeadorfactura->Required) { ?>
			elm = this.getElements("x" + infix + "_fondeadorfactura");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Facturas_Pyme->fondeadorfactura->caption(), $Facturas_Pyme->fondeadorfactura->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_fondeadorfactura");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($Facturas_Pyme->fondeadorfactura->errorMessage()) ?>");
		<?php if ($Facturas_Pyme_edit->factura->Required) { ?>
			felm = this.getElements("x" + infix + "_factura");
			elm = this.getElements("fn_x" + infix + "_factura");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $Facturas_Pyme->factura->caption(), $Facturas_Pyme->factura->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($Facturas_Pyme_edit->estatusfactura->Required) { ?>
			elm = this.getElements("x" + infix + "_estatusfactura");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Facturas_Pyme->estatusfactura->caption(), $Facturas_Pyme->estatusfactura->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_estatusfactura");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($Facturas_Pyme->estatusfactura->errorMessage()) ?>");
		<?php if ($Facturas_Pyme_edit->compradorid_comprador->Required) { ?>
			elm = this.getElements("x" + infix + "_compradorid_comprador");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Facturas_Pyme->compradorid_comprador->caption(), $Facturas_Pyme->compradorid_comprador->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_compradorid_comprador");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($Facturas_Pyme->compradorid_comprador->errorMessage()) ?>");
		<?php if ($Facturas_Pyme_edit->fondeadorfacturaidfondeadorfact->Required) { ?>
			elm = this.getElements("x" + infix + "_fondeadorfacturaidfondeadorfact");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Facturas_Pyme->fondeadorfacturaidfondeadorfact->caption(), $Facturas_Pyme->fondeadorfacturaidfondeadorfact->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_fondeadorfacturaidfondeadorfact");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($Facturas_Pyme->fondeadorfacturaidfondeadorfact->errorMessage()) ?>");

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
fFacturas_Pymeedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fFacturas_Pymeedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $Facturas_Pyme_edit->showPageHeader(); ?>
<?php
$Facturas_Pyme_edit->showMessage();
?>
<form name="fFacturas_Pymeedit" id="fFacturas_Pymeedit" class="<?php echo $Facturas_Pyme_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Facturas_Pyme_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $Facturas_Pyme_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Facturas_Pyme">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$Facturas_Pyme_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Facturas_Pyme->rfcfactura->Visible) { // rfcfactura ?>
	<div id="r_rfcfactura" class="form-group row">
		<label id="elh_Facturas_Pyme_rfcfactura" for="x_rfcfactura" class="<?php echo $Facturas_Pyme_edit->LeftColumnClass ?>"><?php echo $Facturas_Pyme->rfcfactura->caption() ?><?php echo ($Facturas_Pyme->rfcfactura->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Facturas_Pyme_edit->RightColumnClass ?>"><div<?php echo $Facturas_Pyme->rfcfactura->cellAttributes() ?>>
<span id="el_Facturas_Pyme_rfcfactura">
<span<?php echo $Facturas_Pyme->rfcfactura->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($Facturas_Pyme->rfcfactura->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="Facturas_Pyme" data-field="x_rfcfactura" name="x_rfcfactura" id="x_rfcfactura" value="<?php echo HtmlEncode($Facturas_Pyme->rfcfactura->CurrentValue) ?>">
<?php echo $Facturas_Pyme->rfcfactura->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Facturas_Pyme->idfactura->Visible) { // idfactura ?>
	<div id="r_idfactura" class="form-group row">
		<label id="elh_Facturas_Pyme_idfactura" for="x_idfactura" class="<?php echo $Facturas_Pyme_edit->LeftColumnClass ?>"><?php echo $Facturas_Pyme->idfactura->caption() ?><?php echo ($Facturas_Pyme->idfactura->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Facturas_Pyme_edit->RightColumnClass ?>"><div<?php echo $Facturas_Pyme->idfactura->cellAttributes() ?>>
<span id="el_Facturas_Pyme_idfactura">
<span<?php echo $Facturas_Pyme->idfactura->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($Facturas_Pyme->idfactura->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="Facturas_Pyme" data-field="x_idfactura" name="x_idfactura" id="x_idfactura" value="<?php echo HtmlEncode($Facturas_Pyme->idfactura->CurrentValue) ?>">
<?php echo $Facturas_Pyme->idfactura->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Facturas_Pyme->monto->Visible) { // monto ?>
	<div id="r_monto" class="form-group row">
		<label id="elh_Facturas_Pyme_monto" for="x_monto" class="<?php echo $Facturas_Pyme_edit->LeftColumnClass ?>"><?php echo $Facturas_Pyme->monto->caption() ?><?php echo ($Facturas_Pyme->monto->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Facturas_Pyme_edit->RightColumnClass ?>"><div<?php echo $Facturas_Pyme->monto->cellAttributes() ?>>
<span id="el_Facturas_Pyme_monto">
<input type="text" data-table="Facturas_Pyme" data-field="x_monto" name="x_monto" id="x_monto" size="30" placeholder="<?php echo HtmlEncode($Facturas_Pyme->monto->getPlaceHolder()) ?>" value="<?php echo $Facturas_Pyme->monto->EditValue ?>"<?php echo $Facturas_Pyme->monto->editAttributes() ?>>
</span>
<?php echo $Facturas_Pyme->monto->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Facturas_Pyme->estado_operacion->Visible) { // estado_operacion ?>
	<div id="r_estado_operacion" class="form-group row">
		<label id="elh_Facturas_Pyme_estado_operacion" for="x_estado_operacion" class="<?php echo $Facturas_Pyme_edit->LeftColumnClass ?>"><?php echo $Facturas_Pyme->estado_operacion->caption() ?><?php echo ($Facturas_Pyme->estado_operacion->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Facturas_Pyme_edit->RightColumnClass ?>"><div<?php echo $Facturas_Pyme->estado_operacion->cellAttributes() ?>>
<span id="el_Facturas_Pyme_estado_operacion">
<input type="text" data-table="Facturas_Pyme" data-field="x_estado_operacion" name="x_estado_operacion" id="x_estado_operacion" size="30" placeholder="<?php echo HtmlEncode($Facturas_Pyme->estado_operacion->getPlaceHolder()) ?>" value="<?php echo $Facturas_Pyme->estado_operacion->EditValue ?>"<?php echo $Facturas_Pyme->estado_operacion->editAttributes() ?>>
</span>
<?php echo $Facturas_Pyme->estado_operacion->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Facturas_Pyme->pymerfc->Visible) { // pymerfc ?>
	<div id="r_pymerfc" class="form-group row">
		<label id="elh_Facturas_Pyme_pymerfc" for="x_pymerfc" class="<?php echo $Facturas_Pyme_edit->LeftColumnClass ?>"><?php echo $Facturas_Pyme->pymerfc->caption() ?><?php echo ($Facturas_Pyme->pymerfc->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Facturas_Pyme_edit->RightColumnClass ?>"><div<?php echo $Facturas_Pyme->pymerfc->cellAttributes() ?>>
<span id="el_Facturas_Pyme_pymerfc">
<input type="text" data-table="Facturas_Pyme" data-field="x_pymerfc" name="x_pymerfc" id="x_pymerfc" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($Facturas_Pyme->pymerfc->getPlaceHolder()) ?>" value="<?php echo $Facturas_Pyme->pymerfc->EditValue ?>"<?php echo $Facturas_Pyme->pymerfc->editAttributes() ?>>
</span>
<?php echo $Facturas_Pyme->pymerfc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Facturas_Pyme->compradorfc->Visible) { // compradorfc ?>
	<div id="r_compradorfc" class="form-group row">
		<label id="elh_Facturas_Pyme_compradorfc" for="x_compradorfc" class="<?php echo $Facturas_Pyme_edit->LeftColumnClass ?>"><?php echo $Facturas_Pyme->compradorfc->caption() ?><?php echo ($Facturas_Pyme->compradorfc->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Facturas_Pyme_edit->RightColumnClass ?>"><div<?php echo $Facturas_Pyme->compradorfc->cellAttributes() ?>>
<span id="el_Facturas_Pyme_compradorfc">
<input type="text" data-table="Facturas_Pyme" data-field="x_compradorfc" name="x_compradorfc" id="x_compradorfc" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($Facturas_Pyme->compradorfc->getPlaceHolder()) ?>" value="<?php echo $Facturas_Pyme->compradorfc->EditValue ?>"<?php echo $Facturas_Pyme->compradorfc->editAttributes() ?>>
</span>
<?php echo $Facturas_Pyme->compradorfc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Facturas_Pyme->cadena->Visible) { // cadena ?>
	<div id="r_cadena" class="form-group row">
		<label id="elh_Facturas_Pyme_cadena" for="x_cadena" class="<?php echo $Facturas_Pyme_edit->LeftColumnClass ?>"><?php echo $Facturas_Pyme->cadena->caption() ?><?php echo ($Facturas_Pyme->cadena->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Facturas_Pyme_edit->RightColumnClass ?>"><div<?php echo $Facturas_Pyme->cadena->cellAttributes() ?>>
<span id="el_Facturas_Pyme_cadena">
<input type="text" data-table="Facturas_Pyme" data-field="x_cadena" name="x_cadena" id="x_cadena" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($Facturas_Pyme->cadena->getPlaceHolder()) ?>" value="<?php echo $Facturas_Pyme->cadena->EditValue ?>"<?php echo $Facturas_Pyme->cadena->editAttributes() ?>>
</span>
<?php echo $Facturas_Pyme->cadena->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Facturas_Pyme->vencimiento->Visible) { // vencimiento ?>
	<div id="r_vencimiento" class="form-group row">
		<label id="elh_Facturas_Pyme_vencimiento" for="x_vencimiento" class="<?php echo $Facturas_Pyme_edit->LeftColumnClass ?>"><?php echo $Facturas_Pyme->vencimiento->caption() ?><?php echo ($Facturas_Pyme->vencimiento->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Facturas_Pyme_edit->RightColumnClass ?>"><div<?php echo $Facturas_Pyme->vencimiento->cellAttributes() ?>>
<span id="el_Facturas_Pyme_vencimiento">
<input type="text" data-table="Facturas_Pyme" data-field="x_vencimiento" name="x_vencimiento" id="x_vencimiento" placeholder="<?php echo HtmlEncode($Facturas_Pyme->vencimiento->getPlaceHolder()) ?>" value="<?php echo $Facturas_Pyme->vencimiento->EditValue ?>"<?php echo $Facturas_Pyme->vencimiento->editAttributes() ?>>
<?php if (!$Facturas_Pyme->vencimiento->ReadOnly && !$Facturas_Pyme->vencimiento->Disabled && !isset($Facturas_Pyme->vencimiento->EditAttrs["readonly"]) && !isset($Facturas_Pyme->vencimiento->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fFacturas_Pymeedit", "x_vencimiento", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $Facturas_Pyme->vencimiento->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Facturas_Pyme->fondeadorfactura->Visible) { // fondeadorfactura ?>
	<div id="r_fondeadorfactura" class="form-group row">
		<label id="elh_Facturas_Pyme_fondeadorfactura" for="x_fondeadorfactura" class="<?php echo $Facturas_Pyme_edit->LeftColumnClass ?>"><?php echo $Facturas_Pyme->fondeadorfactura->caption() ?><?php echo ($Facturas_Pyme->fondeadorfactura->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Facturas_Pyme_edit->RightColumnClass ?>"><div<?php echo $Facturas_Pyme->fondeadorfactura->cellAttributes() ?>>
<span id="el_Facturas_Pyme_fondeadorfactura">
<input type="text" data-table="Facturas_Pyme" data-field="x_fondeadorfactura" name="x_fondeadorfactura" id="x_fondeadorfactura" size="30" placeholder="<?php echo HtmlEncode($Facturas_Pyme->fondeadorfactura->getPlaceHolder()) ?>" value="<?php echo $Facturas_Pyme->fondeadorfactura->EditValue ?>"<?php echo $Facturas_Pyme->fondeadorfactura->editAttributes() ?>>
</span>
<?php echo $Facturas_Pyme->fondeadorfactura->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Facturas_Pyme->factura->Visible) { // factura ?>
	<div id="r_factura" class="form-group row">
		<label id="elh_Facturas_Pyme_factura" class="<?php echo $Facturas_Pyme_edit->LeftColumnClass ?>"><?php echo $Facturas_Pyme->factura->caption() ?><?php echo ($Facturas_Pyme->factura->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Facturas_Pyme_edit->RightColumnClass ?>"><div<?php echo $Facturas_Pyme->factura->cellAttributes() ?>>
<span id="el_Facturas_Pyme_factura">
<div id="fd_x_factura">
<span title="<?php echo $Facturas_Pyme->factura->title() ? $Facturas_Pyme->factura->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($Facturas_Pyme->factura->ReadOnly || $Facturas_Pyme->factura->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="Facturas_Pyme" data-field="x_factura" name="x_factura" id="x_factura"<?php echo $Facturas_Pyme->factura->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_factura" id= "fn_x_factura" value="<?php echo $Facturas_Pyme->factura->Upload->FileName ?>">
<?php if (Post("fa_x_factura") == "0") { ?>
<input type="hidden" name="fa_x_factura" id= "fa_x_factura" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_factura" id= "fa_x_factura" value="1">
<?php } ?>
<input type="hidden" name="fs_x_factura" id= "fs_x_factura" value="0">
<input type="hidden" name="fx_x_factura" id= "fx_x_factura" value="<?php echo $Facturas_Pyme->factura->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_factura" id= "fm_x_factura" value="<?php echo $Facturas_Pyme->factura->UploadMaxFileSize ?>">
</div>
<table id="ft_x_factura" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $Facturas_Pyme->factura->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Facturas_Pyme->estatusfactura->Visible) { // estatusfactura ?>
	<div id="r_estatusfactura" class="form-group row">
		<label id="elh_Facturas_Pyme_estatusfactura" for="x_estatusfactura" class="<?php echo $Facturas_Pyme_edit->LeftColumnClass ?>"><?php echo $Facturas_Pyme->estatusfactura->caption() ?><?php echo ($Facturas_Pyme->estatusfactura->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Facturas_Pyme_edit->RightColumnClass ?>"><div<?php echo $Facturas_Pyme->estatusfactura->cellAttributes() ?>>
<span id="el_Facturas_Pyme_estatusfactura">
<input type="text" data-table="Facturas_Pyme" data-field="x_estatusfactura" name="x_estatusfactura" id="x_estatusfactura" size="30" placeholder="<?php echo HtmlEncode($Facturas_Pyme->estatusfactura->getPlaceHolder()) ?>" value="<?php echo $Facturas_Pyme->estatusfactura->EditValue ?>"<?php echo $Facturas_Pyme->estatusfactura->editAttributes() ?>>
</span>
<?php echo $Facturas_Pyme->estatusfactura->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Facturas_Pyme->compradorid_comprador->Visible) { // compradorid_comprador ?>
	<div id="r_compradorid_comprador" class="form-group row">
		<label id="elh_Facturas_Pyme_compradorid_comprador" for="x_compradorid_comprador" class="<?php echo $Facturas_Pyme_edit->LeftColumnClass ?>"><?php echo $Facturas_Pyme->compradorid_comprador->caption() ?><?php echo ($Facturas_Pyme->compradorid_comprador->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Facturas_Pyme_edit->RightColumnClass ?>"><div<?php echo $Facturas_Pyme->compradorid_comprador->cellAttributes() ?>>
<span id="el_Facturas_Pyme_compradorid_comprador">
<input type="text" data-table="Facturas_Pyme" data-field="x_compradorid_comprador" name="x_compradorid_comprador" id="x_compradorid_comprador" size="30" placeholder="<?php echo HtmlEncode($Facturas_Pyme->compradorid_comprador->getPlaceHolder()) ?>" value="<?php echo $Facturas_Pyme->compradorid_comprador->EditValue ?>"<?php echo $Facturas_Pyme->compradorid_comprador->editAttributes() ?>>
</span>
<?php echo $Facturas_Pyme->compradorid_comprador->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Facturas_Pyme->fondeadorfacturaidfondeadorfact->Visible) { // fondeadorfacturaidfondeadorfact ?>
	<div id="r_fondeadorfacturaidfondeadorfact" class="form-group row">
		<label id="elh_Facturas_Pyme_fondeadorfacturaidfondeadorfact" for="x_fondeadorfacturaidfondeadorfact" class="<?php echo $Facturas_Pyme_edit->LeftColumnClass ?>"><?php echo $Facturas_Pyme->fondeadorfacturaidfondeadorfact->caption() ?><?php echo ($Facturas_Pyme->fondeadorfacturaidfondeadorfact->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Facturas_Pyme_edit->RightColumnClass ?>"><div<?php echo $Facturas_Pyme->fondeadorfacturaidfondeadorfact->cellAttributes() ?>>
<span id="el_Facturas_Pyme_fondeadorfacturaidfondeadorfact">
<input type="text" data-table="Facturas_Pyme" data-field="x_fondeadorfacturaidfondeadorfact" name="x_fondeadorfacturaidfondeadorfact" id="x_fondeadorfacturaidfondeadorfact" size="30" placeholder="<?php echo HtmlEncode($Facturas_Pyme->fondeadorfacturaidfondeadorfact->getPlaceHolder()) ?>" value="<?php echo $Facturas_Pyme->fondeadorfacturaidfondeadorfact->EditValue ?>"<?php echo $Facturas_Pyme->fondeadorfacturaidfondeadorfact->editAttributes() ?>>
</span>
<?php echo $Facturas_Pyme->fondeadorfacturaidfondeadorfact->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Facturas_Pyme_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $Facturas_Pyme_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Facturas_Pyme_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$Facturas_Pyme_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$Facturas_Pyme_edit->terminate();
?>