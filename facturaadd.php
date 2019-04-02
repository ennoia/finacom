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
$factura_add = new factura_add();

// Run the page
$factura_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$factura_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var ffacturaadd = currentForm = new ew.Form("ffacturaadd", "add");

// Validate form
ffacturaadd.validate = function() {
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
		<?php if ($factura_add->rfcfactura->Required) { ?>
			elm = this.getElements("x" + infix + "_rfcfactura");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $factura->rfcfactura->caption(), $factura->rfcfactura->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($factura_add->idfactura->Required) { ?>
			elm = this.getElements("x" + infix + "_idfactura");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $factura->idfactura->caption(), $factura->idfactura->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_idfactura");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($factura->idfactura->errorMessage()) ?>");
		<?php if ($factura_add->monto->Required) { ?>
			elm = this.getElements("x" + infix + "_monto");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $factura->monto->caption(), $factura->monto->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_monto");
			if (elm && !ew.checkNumber(elm.value))
				return this.onError(elm, "<?php echo JsEncode($factura->monto->errorMessage()) ?>");
		<?php if ($factura_add->estado_operacion->Required) { ?>
			elm = this.getElements("x" + infix + "_estado_operacion");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $factura->estado_operacion->caption(), $factura->estado_operacion->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_estado_operacion");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($factura->estado_operacion->errorMessage()) ?>");
		<?php if ($factura_add->pymerfc->Required) { ?>
			elm = this.getElements("x" + infix + "_pymerfc");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $factura->pymerfc->caption(), $factura->pymerfc->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($factura_add->compradorfc->Required) { ?>
			elm = this.getElements("x" + infix + "_compradorfc");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $factura->compradorfc->caption(), $factura->compradorfc->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($factura_add->cadena->Required) { ?>
			elm = this.getElements("x" + infix + "_cadena");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $factura->cadena->caption(), $factura->cadena->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($factura_add->vencimiento->Required) { ?>
			elm = this.getElements("x" + infix + "_vencimiento");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $factura->vencimiento->caption(), $factura->vencimiento->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_vencimiento");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($factura->vencimiento->errorMessage()) ?>");
		<?php if ($factura_add->fondeadorfactura->Required) { ?>
			elm = this.getElements("x" + infix + "_fondeadorfactura");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $factura->fondeadorfactura->caption(), $factura->fondeadorfactura->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_fondeadorfactura");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($factura->fondeadorfactura->errorMessage()) ?>");
		<?php if ($factura_add->factura->Required) { ?>
			felm = this.getElements("x" + infix + "_factura");
			elm = this.getElements("fn_x" + infix + "_factura");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $factura->factura->caption(), $factura->factura->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($factura_add->estatusfactura->Required) { ?>
			elm = this.getElements("x" + infix + "_estatusfactura");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $factura->estatusfactura->caption(), $factura->estatusfactura->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_estatusfactura");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($factura->estatusfactura->errorMessage()) ?>");
		<?php if ($factura_add->compradorid_comprador->Required) { ?>
			elm = this.getElements("x" + infix + "_compradorid_comprador");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $factura->compradorid_comprador->caption(), $factura->compradorid_comprador->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_compradorid_comprador");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($factura->compradorid_comprador->errorMessage()) ?>");
		<?php if ($factura_add->fondeadorfacturaidfondeadorfact->Required) { ?>
			elm = this.getElements("x" + infix + "_fondeadorfacturaidfondeadorfact");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $factura->fondeadorfacturaidfondeadorfact->caption(), $factura->fondeadorfacturaidfondeadorfact->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_fondeadorfacturaidfondeadorfact");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($factura->fondeadorfacturaidfondeadorfact->errorMessage()) ?>");

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
ffacturaadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ffacturaadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $factura_add->showPageHeader(); ?>
<?php
$factura_add->showMessage();
?>
<form name="ffacturaadd" id="ffacturaadd" class="<?php echo $factura_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($factura_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $factura_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="factura">
<?php if ($factura->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$factura_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($factura->rfcfactura->Visible) { // rfcfactura ?>
	<div id="r_rfcfactura" class="form-group row">
		<label id="elh_factura_rfcfactura" for="x_rfcfactura" class="<?php echo $factura_add->LeftColumnClass ?>"><?php echo $factura->rfcfactura->caption() ?><?php echo ($factura->rfcfactura->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $factura_add->RightColumnClass ?>"><div<?php echo $factura->rfcfactura->cellAttributes() ?>>
<?php if (!$factura->isConfirm()) { ?>
<span id="el_factura_rfcfactura">
<input type="text" data-table="factura" data-field="x_rfcfactura" name="x_rfcfactura" id="x_rfcfactura" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($factura->rfcfactura->getPlaceHolder()) ?>" value="<?php echo $factura->rfcfactura->EditValue ?>"<?php echo $factura->rfcfactura->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_factura_rfcfactura">
<span<?php echo $factura->rfcfactura->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($factura->rfcfactura->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="factura" data-field="x_rfcfactura" name="x_rfcfactura" id="x_rfcfactura" value="<?php echo HtmlEncode($factura->rfcfactura->FormValue) ?>">
<?php } ?>
<?php echo $factura->rfcfactura->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($factura->idfactura->Visible) { // idfactura ?>
	<div id="r_idfactura" class="form-group row">
		<label id="elh_factura_idfactura" for="x_idfactura" class="<?php echo $factura_add->LeftColumnClass ?>"><?php echo $factura->idfactura->caption() ?><?php echo ($factura->idfactura->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $factura_add->RightColumnClass ?>"><div<?php echo $factura->idfactura->cellAttributes() ?>>
<?php if (!$factura->isConfirm()) { ?>
<span id="el_factura_idfactura">
<input type="text" data-table="factura" data-field="x_idfactura" name="x_idfactura" id="x_idfactura" size="30" placeholder="<?php echo HtmlEncode($factura->idfactura->getPlaceHolder()) ?>" value="<?php echo $factura->idfactura->EditValue ?>"<?php echo $factura->idfactura->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_factura_idfactura">
<span<?php echo $factura->idfactura->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($factura->idfactura->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="factura" data-field="x_idfactura" name="x_idfactura" id="x_idfactura" value="<?php echo HtmlEncode($factura->idfactura->FormValue) ?>">
<?php } ?>
<?php echo $factura->idfactura->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($factura->monto->Visible) { // monto ?>
	<div id="r_monto" class="form-group row">
		<label id="elh_factura_monto" for="x_monto" class="<?php echo $factura_add->LeftColumnClass ?>"><?php echo $factura->monto->caption() ?><?php echo ($factura->monto->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $factura_add->RightColumnClass ?>"><div<?php echo $factura->monto->cellAttributes() ?>>
<?php if (!$factura->isConfirm()) { ?>
<span id="el_factura_monto">
<input type="text" data-table="factura" data-field="x_monto" name="x_monto" id="x_monto" size="30" placeholder="<?php echo HtmlEncode($factura->monto->getPlaceHolder()) ?>" value="<?php echo $factura->monto->EditValue ?>"<?php echo $factura->monto->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_factura_monto">
<span<?php echo $factura->monto->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($factura->monto->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="factura" data-field="x_monto" name="x_monto" id="x_monto" value="<?php echo HtmlEncode($factura->monto->FormValue) ?>">
<?php } ?>
<?php echo $factura->monto->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($factura->estado_operacion->Visible) { // estado_operacion ?>
	<div id="r_estado_operacion" class="form-group row">
		<label id="elh_factura_estado_operacion" for="x_estado_operacion" class="<?php echo $factura_add->LeftColumnClass ?>"><?php echo $factura->estado_operacion->caption() ?><?php echo ($factura->estado_operacion->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $factura_add->RightColumnClass ?>"><div<?php echo $factura->estado_operacion->cellAttributes() ?>>
<?php if (!$factura->isConfirm()) { ?>
<span id="el_factura_estado_operacion">
<input type="text" data-table="factura" data-field="x_estado_operacion" name="x_estado_operacion" id="x_estado_operacion" size="30" placeholder="<?php echo HtmlEncode($factura->estado_operacion->getPlaceHolder()) ?>" value="<?php echo $factura->estado_operacion->EditValue ?>"<?php echo $factura->estado_operacion->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_factura_estado_operacion">
<span<?php echo $factura->estado_operacion->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($factura->estado_operacion->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="factura" data-field="x_estado_operacion" name="x_estado_operacion" id="x_estado_operacion" value="<?php echo HtmlEncode($factura->estado_operacion->FormValue) ?>">
<?php } ?>
<?php echo $factura->estado_operacion->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($factura->pymerfc->Visible) { // pymerfc ?>
	<div id="r_pymerfc" class="form-group row">
		<label id="elh_factura_pymerfc" for="x_pymerfc" class="<?php echo $factura_add->LeftColumnClass ?>"><?php echo $factura->pymerfc->caption() ?><?php echo ($factura->pymerfc->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $factura_add->RightColumnClass ?>"><div<?php echo $factura->pymerfc->cellAttributes() ?>>
<?php if (!$factura->isConfirm()) { ?>
<span id="el_factura_pymerfc">
<input type="text" data-table="factura" data-field="x_pymerfc" name="x_pymerfc" id="x_pymerfc" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($factura->pymerfc->getPlaceHolder()) ?>" value="<?php echo $factura->pymerfc->EditValue ?>"<?php echo $factura->pymerfc->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_factura_pymerfc">
<span<?php echo $factura->pymerfc->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($factura->pymerfc->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="factura" data-field="x_pymerfc" name="x_pymerfc" id="x_pymerfc" value="<?php echo HtmlEncode($factura->pymerfc->FormValue) ?>">
<?php } ?>
<?php echo $factura->pymerfc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($factura->compradorfc->Visible) { // compradorfc ?>
	<div id="r_compradorfc" class="form-group row">
		<label id="elh_factura_compradorfc" for="x_compradorfc" class="<?php echo $factura_add->LeftColumnClass ?>"><?php echo $factura->compradorfc->caption() ?><?php echo ($factura->compradorfc->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $factura_add->RightColumnClass ?>"><div<?php echo $factura->compradorfc->cellAttributes() ?>>
<?php if (!$factura->isConfirm()) { ?>
<span id="el_factura_compradorfc">
<input type="text" data-table="factura" data-field="x_compradorfc" name="x_compradorfc" id="x_compradorfc" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($factura->compradorfc->getPlaceHolder()) ?>" value="<?php echo $factura->compradorfc->EditValue ?>"<?php echo $factura->compradorfc->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_factura_compradorfc">
<span<?php echo $factura->compradorfc->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($factura->compradorfc->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="factura" data-field="x_compradorfc" name="x_compradorfc" id="x_compradorfc" value="<?php echo HtmlEncode($factura->compradorfc->FormValue) ?>">
<?php } ?>
<?php echo $factura->compradorfc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($factura->cadena->Visible) { // cadena ?>
	<div id="r_cadena" class="form-group row">
		<label id="elh_factura_cadena" for="x_cadena" class="<?php echo $factura_add->LeftColumnClass ?>"><?php echo $factura->cadena->caption() ?><?php echo ($factura->cadena->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $factura_add->RightColumnClass ?>"><div<?php echo $factura->cadena->cellAttributes() ?>>
<?php if (!$factura->isConfirm()) { ?>
<span id="el_factura_cadena">
<input type="text" data-table="factura" data-field="x_cadena" name="x_cadena" id="x_cadena" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($factura->cadena->getPlaceHolder()) ?>" value="<?php echo $factura->cadena->EditValue ?>"<?php echo $factura->cadena->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_factura_cadena">
<span<?php echo $factura->cadena->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($factura->cadena->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="factura" data-field="x_cadena" name="x_cadena" id="x_cadena" value="<?php echo HtmlEncode($factura->cadena->FormValue) ?>">
<?php } ?>
<?php echo $factura->cadena->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($factura->vencimiento->Visible) { // vencimiento ?>
	<div id="r_vencimiento" class="form-group row">
		<label id="elh_factura_vencimiento" for="x_vencimiento" class="<?php echo $factura_add->LeftColumnClass ?>"><?php echo $factura->vencimiento->caption() ?><?php echo ($factura->vencimiento->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $factura_add->RightColumnClass ?>"><div<?php echo $factura->vencimiento->cellAttributes() ?>>
<?php if (!$factura->isConfirm()) { ?>
<span id="el_factura_vencimiento">
<input type="text" data-table="factura" data-field="x_vencimiento" name="x_vencimiento" id="x_vencimiento" placeholder="<?php echo HtmlEncode($factura->vencimiento->getPlaceHolder()) ?>" value="<?php echo $factura->vencimiento->EditValue ?>"<?php echo $factura->vencimiento->editAttributes() ?>>
<?php if (!$factura->vencimiento->ReadOnly && !$factura->vencimiento->Disabled && !isset($factura->vencimiento->EditAttrs["readonly"]) && !isset($factura->vencimiento->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ffacturaadd", "x_vencimiento", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_factura_vencimiento">
<span<?php echo $factura->vencimiento->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($factura->vencimiento->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="factura" data-field="x_vencimiento" name="x_vencimiento" id="x_vencimiento" value="<?php echo HtmlEncode($factura->vencimiento->FormValue) ?>">
<?php } ?>
<?php echo $factura->vencimiento->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($factura->fondeadorfactura->Visible) { // fondeadorfactura ?>
	<div id="r_fondeadorfactura" class="form-group row">
		<label id="elh_factura_fondeadorfactura" for="x_fondeadorfactura" class="<?php echo $factura_add->LeftColumnClass ?>"><?php echo $factura->fondeadorfactura->caption() ?><?php echo ($factura->fondeadorfactura->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $factura_add->RightColumnClass ?>"><div<?php echo $factura->fondeadorfactura->cellAttributes() ?>>
<?php if (!$factura->isConfirm()) { ?>
<span id="el_factura_fondeadorfactura">
<input type="text" data-table="factura" data-field="x_fondeadorfactura" name="x_fondeadorfactura" id="x_fondeadorfactura" size="30" placeholder="<?php echo HtmlEncode($factura->fondeadorfactura->getPlaceHolder()) ?>" value="<?php echo $factura->fondeadorfactura->EditValue ?>"<?php echo $factura->fondeadorfactura->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_factura_fondeadorfactura">
<span<?php echo $factura->fondeadorfactura->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($factura->fondeadorfactura->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="factura" data-field="x_fondeadorfactura" name="x_fondeadorfactura" id="x_fondeadorfactura" value="<?php echo HtmlEncode($factura->fondeadorfactura->FormValue) ?>">
<?php } ?>
<?php echo $factura->fondeadorfactura->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($factura->factura->Visible) { // factura ?>
	<div id="r_factura" class="form-group row">
		<label id="elh_factura_factura" class="<?php echo $factura_add->LeftColumnClass ?>"><?php echo $factura->factura->caption() ?><?php echo ($factura->factura->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $factura_add->RightColumnClass ?>"><div<?php echo $factura->factura->cellAttributes() ?>>
<span id="el_factura_factura">
<div id="fd_x_factura">
<span title="<?php echo $factura->factura->title() ? $factura->factura->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($factura->factura->ReadOnly || $factura->factura->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="factura" data-field="x_factura" name="x_factura" id="x_factura"<?php echo $factura->factura->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_factura" id= "fn_x_factura" value="<?php echo $factura->factura->Upload->FileName ?>">
<input type="hidden" name="fa_x_factura" id= "fa_x_factura" value="0">
<input type="hidden" name="fs_x_factura" id= "fs_x_factura" value="0">
<input type="hidden" name="fx_x_factura" id= "fx_x_factura" value="<?php echo $factura->factura->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_factura" id= "fm_x_factura" value="<?php echo $factura->factura->UploadMaxFileSize ?>">
</div>
<table id="ft_x_factura" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $factura->factura->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($factura->estatusfactura->Visible) { // estatusfactura ?>
	<div id="r_estatusfactura" class="form-group row">
		<label id="elh_factura_estatusfactura" for="x_estatusfactura" class="<?php echo $factura_add->LeftColumnClass ?>"><?php echo $factura->estatusfactura->caption() ?><?php echo ($factura->estatusfactura->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $factura_add->RightColumnClass ?>"><div<?php echo $factura->estatusfactura->cellAttributes() ?>>
<?php if (!$factura->isConfirm()) { ?>
<span id="el_factura_estatusfactura">
<input type="text" data-table="factura" data-field="x_estatusfactura" name="x_estatusfactura" id="x_estatusfactura" size="30" placeholder="<?php echo HtmlEncode($factura->estatusfactura->getPlaceHolder()) ?>" value="<?php echo $factura->estatusfactura->EditValue ?>"<?php echo $factura->estatusfactura->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_factura_estatusfactura">
<span<?php echo $factura->estatusfactura->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($factura->estatusfactura->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="factura" data-field="x_estatusfactura" name="x_estatusfactura" id="x_estatusfactura" value="<?php echo HtmlEncode($factura->estatusfactura->FormValue) ?>">
<?php } ?>
<?php echo $factura->estatusfactura->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($factura->compradorid_comprador->Visible) { // compradorid_comprador ?>
	<div id="r_compradorid_comprador" class="form-group row">
		<label id="elh_factura_compradorid_comprador" for="x_compradorid_comprador" class="<?php echo $factura_add->LeftColumnClass ?>"><?php echo $factura->compradorid_comprador->caption() ?><?php echo ($factura->compradorid_comprador->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $factura_add->RightColumnClass ?>"><div<?php echo $factura->compradorid_comprador->cellAttributes() ?>>
<?php if (!$factura->isConfirm()) { ?>
<span id="el_factura_compradorid_comprador">
<input type="text" data-table="factura" data-field="x_compradorid_comprador" name="x_compradorid_comprador" id="x_compradorid_comprador" size="30" placeholder="<?php echo HtmlEncode($factura->compradorid_comprador->getPlaceHolder()) ?>" value="<?php echo $factura->compradorid_comprador->EditValue ?>"<?php echo $factura->compradorid_comprador->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_factura_compradorid_comprador">
<span<?php echo $factura->compradorid_comprador->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($factura->compradorid_comprador->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="factura" data-field="x_compradorid_comprador" name="x_compradorid_comprador" id="x_compradorid_comprador" value="<?php echo HtmlEncode($factura->compradorid_comprador->FormValue) ?>">
<?php } ?>
<?php echo $factura->compradorid_comprador->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($factura->fondeadorfacturaidfondeadorfact->Visible) { // fondeadorfacturaidfondeadorfact ?>
	<div id="r_fondeadorfacturaidfondeadorfact" class="form-group row">
		<label id="elh_factura_fondeadorfacturaidfondeadorfact" for="x_fondeadorfacturaidfondeadorfact" class="<?php echo $factura_add->LeftColumnClass ?>"><?php echo $factura->fondeadorfacturaidfondeadorfact->caption() ?><?php echo ($factura->fondeadorfacturaidfondeadorfact->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $factura_add->RightColumnClass ?>"><div<?php echo $factura->fondeadorfacturaidfondeadorfact->cellAttributes() ?>>
<?php if (!$factura->isConfirm()) { ?>
<span id="el_factura_fondeadorfacturaidfondeadorfact">
<input type="text" data-table="factura" data-field="x_fondeadorfacturaidfondeadorfact" name="x_fondeadorfacturaidfondeadorfact" id="x_fondeadorfacturaidfondeadorfact" size="30" placeholder="<?php echo HtmlEncode($factura->fondeadorfacturaidfondeadorfact->getPlaceHolder()) ?>" value="<?php echo $factura->fondeadorfacturaidfondeadorfact->EditValue ?>"<?php echo $factura->fondeadorfacturaidfondeadorfact->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_factura_fondeadorfacturaidfondeadorfact">
<span<?php echo $factura->fondeadorfacturaidfondeadorfact->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($factura->fondeadorfacturaidfondeadorfact->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="factura" data-field="x_fondeadorfacturaidfondeadorfact" name="x_fondeadorfacturaidfondeadorfact" id="x_fondeadorfacturaidfondeadorfact" value="<?php echo HtmlEncode($factura->fondeadorfacturaidfondeadorfact->FormValue) ?>">
<?php } ?>
<?php echo $factura->fondeadorfacturaidfondeadorfact->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$factura_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $factura_add->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$factura->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $factura_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$factura_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$factura_add->terminate();
?>