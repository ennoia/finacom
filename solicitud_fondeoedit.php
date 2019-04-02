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
$solicitud_fondeo_edit = new solicitud_fondeo_edit();

// Run the page
$solicitud_fondeo_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$solicitud_fondeo_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fsolicitud_fondeoedit = currentForm = new ew.Form("fsolicitud_fondeoedit", "edit");

// Validate form
fsolicitud_fondeoedit.validate = function() {
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
		<?php if ($solicitud_fondeo_edit->id_solicitud->Required) { ?>
			elm = this.getElements("x" + infix + "_id_solicitud");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $solicitud_fondeo->id_solicitud->caption(), $solicitud_fondeo->id_solicitud->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($solicitud_fondeo_edit->fondeador->Required) { ?>
			elm = this.getElements("x" + infix + "_fondeador");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $solicitud_fondeo->fondeador->caption(), $solicitud_fondeo->fondeador->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_fondeador");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($solicitud_fondeo->fondeador->errorMessage()) ?>");
		<?php if ($solicitud_fondeo_edit->monto->Required) { ?>
			elm = this.getElements("x" + infix + "_monto");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $solicitud_fondeo->monto->caption(), $solicitud_fondeo->monto->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_monto");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($solicitud_fondeo->monto->errorMessage()) ?>");
		<?php if ($solicitud_fondeo_edit->plazo->Required) { ?>
			elm = this.getElements("x" + infix + "_plazo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $solicitud_fondeo->plazo->caption(), $solicitud_fondeo->plazo->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_plazo");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($solicitud_fondeo->plazo->errorMessage()) ?>");
		<?php if ($solicitud_fondeo_edit->fecha_fondeo->Required) { ?>
			elm = this.getElements("x" + infix + "_fecha_fondeo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $solicitud_fondeo->fecha_fondeo->caption(), $solicitud_fondeo->fecha_fondeo->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_fecha_fondeo");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($solicitud_fondeo->fecha_fondeo->errorMessage()) ?>");
		<?php if ($solicitud_fondeo_edit->estado_operacion->Required) { ?>
			elm = this.getElements("x" + infix + "_estado_operacion");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $solicitud_fondeo->estado_operacion->caption(), $solicitud_fondeo->estado_operacion->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_estado_operacion");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($solicitud_fondeo->estado_operacion->errorMessage()) ?>");
		<?php if ($solicitud_fondeo_edit->vencimiento->Required) { ?>
			elm = this.getElements("x" + infix + "_vencimiento");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $solicitud_fondeo->vencimiento->caption(), $solicitud_fondeo->vencimiento->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_vencimiento");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($solicitud_fondeo->vencimiento->errorMessage()) ?>");
		<?php if ($solicitud_fondeo_edit->pymerfc->Required) { ?>
			elm = this.getElements("x" + infix + "_pymerfc");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $solicitud_fondeo->pymerfc->caption(), $solicitud_fondeo->pymerfc->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($solicitud_fondeo_edit->compradorrfc->Required) { ?>
			elm = this.getElements("x" + infix + "_compradorrfc");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $solicitud_fondeo->compradorrfc->caption(), $solicitud_fondeo->compradorrfc->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($solicitud_fondeo_edit->facturarfc->Required) { ?>
			elm = this.getElements("x" + infix + "_facturarfc");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $solicitud_fondeo->facturarfc->caption(), $solicitud_fondeo->facturarfc->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($solicitud_fondeo_edit->pronostico_vencimiento->Required) { ?>
			elm = this.getElements("x" + infix + "_pronostico_vencimiento");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $solicitud_fondeo->pronostico_vencimiento->caption(), $solicitud_fondeo->pronostico_vencimiento->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_pronostico_vencimiento");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($solicitud_fondeo->pronostico_vencimiento->errorMessage()) ?>");
		<?php if ($solicitud_fondeo_edit->evaluacion->Required) { ?>
			elm = this.getElements("x" + infix + "_evaluacion[]");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $solicitud_fondeo->evaluacion->caption(), $solicitud_fondeo->evaluacion->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($solicitud_fondeo_edit->fecha_solicitud->Required) { ?>
			elm = this.getElements("x" + infix + "_fecha_solicitud");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $solicitud_fondeo->fecha_solicitud->caption(), $solicitud_fondeo->fecha_solicitud->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_fecha_solicitud");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($solicitud_fondeo->fecha_solicitud->errorMessage()) ?>");
		<?php if ($solicitud_fondeo_edit->oferta->Required) { ?>
			elm = this.getElements("x" + infix + "_oferta");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $solicitud_fondeo->oferta->caption(), $solicitud_fondeo->oferta->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($solicitud_fondeo_edit->compradorid_comprador->Required) { ?>
			elm = this.getElements("x" + infix + "_compradorid_comprador");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $solicitud_fondeo->compradorid_comprador->caption(), $solicitud_fondeo->compradorid_comprador->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_compradorid_comprador");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($solicitud_fondeo->compradorid_comprador->errorMessage()) ?>");

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
fsolicitud_fondeoedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fsolicitud_fondeoedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fsolicitud_fondeoedit.lists["x_evaluacion[]"] = <?php echo $solicitud_fondeo_edit->evaluacion->Lookup->toClientList() ?>;
fsolicitud_fondeoedit.lists["x_evaluacion[]"].options = <?php echo JsonEncode($solicitud_fondeo_edit->evaluacion->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $solicitud_fondeo_edit->showPageHeader(); ?>
<?php
$solicitud_fondeo_edit->showMessage();
?>
<form name="fsolicitud_fondeoedit" id="fsolicitud_fondeoedit" class="<?php echo $solicitud_fondeo_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($solicitud_fondeo_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $solicitud_fondeo_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="solicitud_fondeo">
<input type="hidden" name="k_hash" id="k_hash" value="<?php echo $solicitud_fondeo_edit->HashValue ?>">
<?php if ($solicitud_fondeo->UpdateConflict == "U") { // Record already updated by other user ?>
<input type="hidden" name="conflict" id="conflict" value="1">
<?php } ?>
<?php if ($solicitud_fondeo->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$solicitud_fondeo_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($solicitud_fondeo->id_solicitud->Visible) { // id_solicitud ?>
	<div id="r_id_solicitud" class="form-group row">
		<label id="elh_solicitud_fondeo_id_solicitud" class="<?php echo $solicitud_fondeo_edit->LeftColumnClass ?>"><?php echo $solicitud_fondeo->id_solicitud->caption() ?><?php echo ($solicitud_fondeo->id_solicitud->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $solicitud_fondeo_edit->RightColumnClass ?>"><div<?php echo $solicitud_fondeo->id_solicitud->cellAttributes() ?>>
<?php if (!$solicitud_fondeo->isConfirm()) { ?>
<span id="el_solicitud_fondeo_id_solicitud">
<span<?php echo $solicitud_fondeo->id_solicitud->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($solicitud_fondeo->id_solicitud->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="solicitud_fondeo" data-field="x_id_solicitud" name="x_id_solicitud" id="x_id_solicitud" value="<?php echo HtmlEncode($solicitud_fondeo->id_solicitud->CurrentValue) ?>">
<?php } else { ?>
<span id="el_solicitud_fondeo_id_solicitud">
<span<?php echo $solicitud_fondeo->id_solicitud->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($solicitud_fondeo->id_solicitud->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="solicitud_fondeo" data-field="x_id_solicitud" name="x_id_solicitud" id="x_id_solicitud" value="<?php echo HtmlEncode($solicitud_fondeo->id_solicitud->FormValue) ?>">
<?php } ?>
<?php echo $solicitud_fondeo->id_solicitud->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($solicitud_fondeo->fondeador->Visible) { // fondeador ?>
	<div id="r_fondeador" class="form-group row">
		<label id="elh_solicitud_fondeo_fondeador" for="x_fondeador" class="<?php echo $solicitud_fondeo_edit->LeftColumnClass ?>"><?php echo $solicitud_fondeo->fondeador->caption() ?><?php echo ($solicitud_fondeo->fondeador->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $solicitud_fondeo_edit->RightColumnClass ?>"><div<?php echo $solicitud_fondeo->fondeador->cellAttributes() ?>>
<?php if (!$solicitud_fondeo->isConfirm()) { ?>
<span id="el_solicitud_fondeo_fondeador">
<input type="text" data-table="solicitud_fondeo" data-field="x_fondeador" name="x_fondeador" id="x_fondeador" size="30" placeholder="<?php echo HtmlEncode($solicitud_fondeo->fondeador->getPlaceHolder()) ?>" value="<?php echo $solicitud_fondeo->fondeador->EditValue ?>"<?php echo $solicitud_fondeo->fondeador->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_solicitud_fondeo_fondeador">
<span<?php echo $solicitud_fondeo->fondeador->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($solicitud_fondeo->fondeador->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="solicitud_fondeo" data-field="x_fondeador" name="x_fondeador" id="x_fondeador" value="<?php echo HtmlEncode($solicitud_fondeo->fondeador->FormValue) ?>">
<?php } ?>
<?php echo $solicitud_fondeo->fondeador->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($solicitud_fondeo->monto->Visible) { // monto ?>
	<div id="r_monto" class="form-group row">
		<label id="elh_solicitud_fondeo_monto" for="x_monto" class="<?php echo $solicitud_fondeo_edit->LeftColumnClass ?>"><?php echo $solicitud_fondeo->monto->caption() ?><?php echo ($solicitud_fondeo->monto->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $solicitud_fondeo_edit->RightColumnClass ?>"><div<?php echo $solicitud_fondeo->monto->cellAttributes() ?>>
<?php if (!$solicitud_fondeo->isConfirm()) { ?>
<span id="el_solicitud_fondeo_monto">
<input type="text" data-table="solicitud_fondeo" data-field="x_monto" name="x_monto" id="x_monto" size="30" placeholder="<?php echo HtmlEncode($solicitud_fondeo->monto->getPlaceHolder()) ?>" value="<?php echo $solicitud_fondeo->monto->EditValue ?>"<?php echo $solicitud_fondeo->monto->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_solicitud_fondeo_monto">
<span<?php echo $solicitud_fondeo->monto->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($solicitud_fondeo->monto->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="solicitud_fondeo" data-field="x_monto" name="x_monto" id="x_monto" value="<?php echo HtmlEncode($solicitud_fondeo->monto->FormValue) ?>">
<?php } ?>
<?php echo $solicitud_fondeo->monto->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($solicitud_fondeo->plazo->Visible) { // plazo ?>
	<div id="r_plazo" class="form-group row">
		<label id="elh_solicitud_fondeo_plazo" for="x_plazo" class="<?php echo $solicitud_fondeo_edit->LeftColumnClass ?>"><?php echo $solicitud_fondeo->plazo->caption() ?><?php echo ($solicitud_fondeo->plazo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $solicitud_fondeo_edit->RightColumnClass ?>"><div<?php echo $solicitud_fondeo->plazo->cellAttributes() ?>>
<?php if (!$solicitud_fondeo->isConfirm()) { ?>
<span id="el_solicitud_fondeo_plazo">
<input type="text" data-table="solicitud_fondeo" data-field="x_plazo" name="x_plazo" id="x_plazo" size="30" placeholder="<?php echo HtmlEncode($solicitud_fondeo->plazo->getPlaceHolder()) ?>" value="<?php echo $solicitud_fondeo->plazo->EditValue ?>"<?php echo $solicitud_fondeo->plazo->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_solicitud_fondeo_plazo">
<span<?php echo $solicitud_fondeo->plazo->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($solicitud_fondeo->plazo->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="solicitud_fondeo" data-field="x_plazo" name="x_plazo" id="x_plazo" value="<?php echo HtmlEncode($solicitud_fondeo->plazo->FormValue) ?>">
<?php } ?>
<?php echo $solicitud_fondeo->plazo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($solicitud_fondeo->fecha_fondeo->Visible) { // fecha_fondeo ?>
	<div id="r_fecha_fondeo" class="form-group row">
		<label id="elh_solicitud_fondeo_fecha_fondeo" for="x_fecha_fondeo" class="<?php echo $solicitud_fondeo_edit->LeftColumnClass ?>"><?php echo $solicitud_fondeo->fecha_fondeo->caption() ?><?php echo ($solicitud_fondeo->fecha_fondeo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $solicitud_fondeo_edit->RightColumnClass ?>"><div<?php echo $solicitud_fondeo->fecha_fondeo->cellAttributes() ?>>
<?php if (!$solicitud_fondeo->isConfirm()) { ?>
<span id="el_solicitud_fondeo_fecha_fondeo">
<input type="text" data-table="solicitud_fondeo" data-field="x_fecha_fondeo" name="x_fecha_fondeo" id="x_fecha_fondeo" placeholder="<?php echo HtmlEncode($solicitud_fondeo->fecha_fondeo->getPlaceHolder()) ?>" value="<?php echo $solicitud_fondeo->fecha_fondeo->EditValue ?>"<?php echo $solicitud_fondeo->fecha_fondeo->editAttributes() ?>>
<?php if (!$solicitud_fondeo->fecha_fondeo->ReadOnly && !$solicitud_fondeo->fecha_fondeo->Disabled && !isset($solicitud_fondeo->fecha_fondeo->EditAttrs["readonly"]) && !isset($solicitud_fondeo->fecha_fondeo->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fsolicitud_fondeoedit", "x_fecha_fondeo", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_solicitud_fondeo_fecha_fondeo">
<span<?php echo $solicitud_fondeo->fecha_fondeo->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($solicitud_fondeo->fecha_fondeo->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="solicitud_fondeo" data-field="x_fecha_fondeo" name="x_fecha_fondeo" id="x_fecha_fondeo" value="<?php echo HtmlEncode($solicitud_fondeo->fecha_fondeo->FormValue) ?>">
<?php } ?>
<?php echo $solicitud_fondeo->fecha_fondeo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($solicitud_fondeo->estado_operacion->Visible) { // estado_operacion ?>
	<div id="r_estado_operacion" class="form-group row">
		<label id="elh_solicitud_fondeo_estado_operacion" for="x_estado_operacion" class="<?php echo $solicitud_fondeo_edit->LeftColumnClass ?>"><?php echo $solicitud_fondeo->estado_operacion->caption() ?><?php echo ($solicitud_fondeo->estado_operacion->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $solicitud_fondeo_edit->RightColumnClass ?>"><div<?php echo $solicitud_fondeo->estado_operacion->cellAttributes() ?>>
<?php if (!$solicitud_fondeo->isConfirm()) { ?>
<span id="el_solicitud_fondeo_estado_operacion">
<input type="text" data-table="solicitud_fondeo" data-field="x_estado_operacion" name="x_estado_operacion" id="x_estado_operacion" size="30" placeholder="<?php echo HtmlEncode($solicitud_fondeo->estado_operacion->getPlaceHolder()) ?>" value="<?php echo $solicitud_fondeo->estado_operacion->EditValue ?>"<?php echo $solicitud_fondeo->estado_operacion->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_solicitud_fondeo_estado_operacion">
<span<?php echo $solicitud_fondeo->estado_operacion->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($solicitud_fondeo->estado_operacion->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="solicitud_fondeo" data-field="x_estado_operacion" name="x_estado_operacion" id="x_estado_operacion" value="<?php echo HtmlEncode($solicitud_fondeo->estado_operacion->FormValue) ?>">
<?php } ?>
<?php echo $solicitud_fondeo->estado_operacion->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($solicitud_fondeo->vencimiento->Visible) { // vencimiento ?>
	<div id="r_vencimiento" class="form-group row">
		<label id="elh_solicitud_fondeo_vencimiento" for="x_vencimiento" class="<?php echo $solicitud_fondeo_edit->LeftColumnClass ?>"><?php echo $solicitud_fondeo->vencimiento->caption() ?><?php echo ($solicitud_fondeo->vencimiento->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $solicitud_fondeo_edit->RightColumnClass ?>"><div<?php echo $solicitud_fondeo->vencimiento->cellAttributes() ?>>
<?php if (!$solicitud_fondeo->isConfirm()) { ?>
<span id="el_solicitud_fondeo_vencimiento">
<input type="text" data-table="solicitud_fondeo" data-field="x_vencimiento" name="x_vencimiento" id="x_vencimiento" placeholder="<?php echo HtmlEncode($solicitud_fondeo->vencimiento->getPlaceHolder()) ?>" value="<?php echo $solicitud_fondeo->vencimiento->EditValue ?>"<?php echo $solicitud_fondeo->vencimiento->editAttributes() ?>>
<?php if (!$solicitud_fondeo->vencimiento->ReadOnly && !$solicitud_fondeo->vencimiento->Disabled && !isset($solicitud_fondeo->vencimiento->EditAttrs["readonly"]) && !isset($solicitud_fondeo->vencimiento->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fsolicitud_fondeoedit", "x_vencimiento", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_solicitud_fondeo_vencimiento">
<span<?php echo $solicitud_fondeo->vencimiento->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($solicitud_fondeo->vencimiento->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="solicitud_fondeo" data-field="x_vencimiento" name="x_vencimiento" id="x_vencimiento" value="<?php echo HtmlEncode($solicitud_fondeo->vencimiento->FormValue) ?>">
<?php } ?>
<?php echo $solicitud_fondeo->vencimiento->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($solicitud_fondeo->pymerfc->Visible) { // pymerfc ?>
	<div id="r_pymerfc" class="form-group row">
		<label id="elh_solicitud_fondeo_pymerfc" for="x_pymerfc" class="<?php echo $solicitud_fondeo_edit->LeftColumnClass ?>"><?php echo $solicitud_fondeo->pymerfc->caption() ?><?php echo ($solicitud_fondeo->pymerfc->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $solicitud_fondeo_edit->RightColumnClass ?>"><div<?php echo $solicitud_fondeo->pymerfc->cellAttributes() ?>>
<?php if (!$solicitud_fondeo->isConfirm()) { ?>
<span id="el_solicitud_fondeo_pymerfc">
<input type="text" data-table="solicitud_fondeo" data-field="x_pymerfc" name="x_pymerfc" id="x_pymerfc" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($solicitud_fondeo->pymerfc->getPlaceHolder()) ?>" value="<?php echo $solicitud_fondeo->pymerfc->EditValue ?>"<?php echo $solicitud_fondeo->pymerfc->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_solicitud_fondeo_pymerfc">
<span<?php echo $solicitud_fondeo->pymerfc->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($solicitud_fondeo->pymerfc->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="solicitud_fondeo" data-field="x_pymerfc" name="x_pymerfc" id="x_pymerfc" value="<?php echo HtmlEncode($solicitud_fondeo->pymerfc->FormValue) ?>">
<?php } ?>
<?php echo $solicitud_fondeo->pymerfc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($solicitud_fondeo->compradorrfc->Visible) { // compradorrfc ?>
	<div id="r_compradorrfc" class="form-group row">
		<label id="elh_solicitud_fondeo_compradorrfc" for="x_compradorrfc" class="<?php echo $solicitud_fondeo_edit->LeftColumnClass ?>"><?php echo $solicitud_fondeo->compradorrfc->caption() ?><?php echo ($solicitud_fondeo->compradorrfc->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $solicitud_fondeo_edit->RightColumnClass ?>"><div<?php echo $solicitud_fondeo->compradorrfc->cellAttributes() ?>>
<?php if (!$solicitud_fondeo->isConfirm()) { ?>
<span id="el_solicitud_fondeo_compradorrfc">
<input type="text" data-table="solicitud_fondeo" data-field="x_compradorrfc" name="x_compradorrfc" id="x_compradorrfc" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($solicitud_fondeo->compradorrfc->getPlaceHolder()) ?>" value="<?php echo $solicitud_fondeo->compradorrfc->EditValue ?>"<?php echo $solicitud_fondeo->compradorrfc->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_solicitud_fondeo_compradorrfc">
<span<?php echo $solicitud_fondeo->compradorrfc->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($solicitud_fondeo->compradorrfc->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="solicitud_fondeo" data-field="x_compradorrfc" name="x_compradorrfc" id="x_compradorrfc" value="<?php echo HtmlEncode($solicitud_fondeo->compradorrfc->FormValue) ?>">
<?php } ?>
<?php echo $solicitud_fondeo->compradorrfc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($solicitud_fondeo->facturarfc->Visible) { // facturarfc ?>
	<div id="r_facturarfc" class="form-group row">
		<label id="elh_solicitud_fondeo_facturarfc" for="x_facturarfc" class="<?php echo $solicitud_fondeo_edit->LeftColumnClass ?>"><?php echo $solicitud_fondeo->facturarfc->caption() ?><?php echo ($solicitud_fondeo->facturarfc->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $solicitud_fondeo_edit->RightColumnClass ?>"><div<?php echo $solicitud_fondeo->facturarfc->cellAttributes() ?>>
<?php if (!$solicitud_fondeo->isConfirm()) { ?>
<span id="el_solicitud_fondeo_facturarfc">
<input type="text" data-table="solicitud_fondeo" data-field="x_facturarfc" name="x_facturarfc" id="x_facturarfc" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($solicitud_fondeo->facturarfc->getPlaceHolder()) ?>" value="<?php echo $solicitud_fondeo->facturarfc->EditValue ?>"<?php echo $solicitud_fondeo->facturarfc->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_solicitud_fondeo_facturarfc">
<span<?php echo $solicitud_fondeo->facturarfc->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($solicitud_fondeo->facturarfc->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="solicitud_fondeo" data-field="x_facturarfc" name="x_facturarfc" id="x_facturarfc" value="<?php echo HtmlEncode($solicitud_fondeo->facturarfc->FormValue) ?>">
<?php } ?>
<?php echo $solicitud_fondeo->facturarfc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($solicitud_fondeo->pronostico_vencimiento->Visible) { // pronostico_vencimiento ?>
	<div id="r_pronostico_vencimiento" class="form-group row">
		<label id="elh_solicitud_fondeo_pronostico_vencimiento" for="x_pronostico_vencimiento" class="<?php echo $solicitud_fondeo_edit->LeftColumnClass ?>"><?php echo $solicitud_fondeo->pronostico_vencimiento->caption() ?><?php echo ($solicitud_fondeo->pronostico_vencimiento->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $solicitud_fondeo_edit->RightColumnClass ?>"><div<?php echo $solicitud_fondeo->pronostico_vencimiento->cellAttributes() ?>>
<?php if (!$solicitud_fondeo->isConfirm()) { ?>
<span id="el_solicitud_fondeo_pronostico_vencimiento">
<input type="text" data-table="solicitud_fondeo" data-field="x_pronostico_vencimiento" name="x_pronostico_vencimiento" id="x_pronostico_vencimiento" size="30" placeholder="<?php echo HtmlEncode($solicitud_fondeo->pronostico_vencimiento->getPlaceHolder()) ?>" value="<?php echo $solicitud_fondeo->pronostico_vencimiento->EditValue ?>"<?php echo $solicitud_fondeo->pronostico_vencimiento->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_solicitud_fondeo_pronostico_vencimiento">
<span<?php echo $solicitud_fondeo->pronostico_vencimiento->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($solicitud_fondeo->pronostico_vencimiento->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="solicitud_fondeo" data-field="x_pronostico_vencimiento" name="x_pronostico_vencimiento" id="x_pronostico_vencimiento" value="<?php echo HtmlEncode($solicitud_fondeo->pronostico_vencimiento->FormValue) ?>">
<?php } ?>
<?php echo $solicitud_fondeo->pronostico_vencimiento->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($solicitud_fondeo->evaluacion->Visible) { // evaluacion ?>
	<div id="r_evaluacion" class="form-group row">
		<label id="elh_solicitud_fondeo_evaluacion" class="<?php echo $solicitud_fondeo_edit->LeftColumnClass ?>"><?php echo $solicitud_fondeo->evaluacion->caption() ?><?php echo ($solicitud_fondeo->evaluacion->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $solicitud_fondeo_edit->RightColumnClass ?>"><div<?php echo $solicitud_fondeo->evaluacion->cellAttributes() ?>>
<?php if (!$solicitud_fondeo->isConfirm()) { ?>
<span id="el_solicitud_fondeo_evaluacion">
<?php
$selwrk = (ConvertToBool($solicitud_fondeo->evaluacion->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="solicitud_fondeo" data-field="x_evaluacion" name="x_evaluacion[]" id="x_evaluacion[]" value="1"<?php echo $selwrk ?><?php echo $solicitud_fondeo->evaluacion->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_solicitud_fondeo_evaluacion">
<span<?php echo $solicitud_fondeo->evaluacion->viewAttributes() ?>>
<?php if (ConvertToBool($solicitud_fondeo->evaluacion->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $solicitud_fondeo->evaluacion->ViewValue ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $solicitud_fondeo->evaluacion->ViewValue ?>" disabled>
<?php } ?>
</span>
</span>
<input type="hidden" data-table="solicitud_fondeo" data-field="x_evaluacion" name="x_evaluacion" id="x_evaluacion" value="<?php echo HtmlEncode($solicitud_fondeo->evaluacion->FormValue) ?>">
<?php } ?>
<?php echo $solicitud_fondeo->evaluacion->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($solicitud_fondeo->fecha_solicitud->Visible) { // fecha_solicitud ?>
	<div id="r_fecha_solicitud" class="form-group row">
		<label id="elh_solicitud_fondeo_fecha_solicitud" for="x_fecha_solicitud" class="<?php echo $solicitud_fondeo_edit->LeftColumnClass ?>"><?php echo $solicitud_fondeo->fecha_solicitud->caption() ?><?php echo ($solicitud_fondeo->fecha_solicitud->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $solicitud_fondeo_edit->RightColumnClass ?>"><div<?php echo $solicitud_fondeo->fecha_solicitud->cellAttributes() ?>>
<?php if (!$solicitud_fondeo->isConfirm()) { ?>
<span id="el_solicitud_fondeo_fecha_solicitud">
<input type="text" data-table="solicitud_fondeo" data-field="x_fecha_solicitud" name="x_fecha_solicitud" id="x_fecha_solicitud" placeholder="<?php echo HtmlEncode($solicitud_fondeo->fecha_solicitud->getPlaceHolder()) ?>" value="<?php echo $solicitud_fondeo->fecha_solicitud->EditValue ?>"<?php echo $solicitud_fondeo->fecha_solicitud->editAttributes() ?>>
<?php if (!$solicitud_fondeo->fecha_solicitud->ReadOnly && !$solicitud_fondeo->fecha_solicitud->Disabled && !isset($solicitud_fondeo->fecha_solicitud->EditAttrs["readonly"]) && !isset($solicitud_fondeo->fecha_solicitud->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fsolicitud_fondeoedit", "x_fecha_solicitud", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_solicitud_fondeo_fecha_solicitud">
<span<?php echo $solicitud_fondeo->fecha_solicitud->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($solicitud_fondeo->fecha_solicitud->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="solicitud_fondeo" data-field="x_fecha_solicitud" name="x_fecha_solicitud" id="x_fecha_solicitud" value="<?php echo HtmlEncode($solicitud_fondeo->fecha_solicitud->FormValue) ?>">
<?php } ?>
<?php echo $solicitud_fondeo->fecha_solicitud->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($solicitud_fondeo->oferta->Visible) { // oferta ?>
	<div id="r_oferta" class="form-group row">
		<label id="elh_solicitud_fondeo_oferta" for="x_oferta" class="<?php echo $solicitud_fondeo_edit->LeftColumnClass ?>"><?php echo $solicitud_fondeo->oferta->caption() ?><?php echo ($solicitud_fondeo->oferta->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $solicitud_fondeo_edit->RightColumnClass ?>"><div<?php echo $solicitud_fondeo->oferta->cellAttributes() ?>>
<?php if (!$solicitud_fondeo->isConfirm()) { ?>
<span id="el_solicitud_fondeo_oferta">
<input type="text" data-table="solicitud_fondeo" data-field="x_oferta" name="x_oferta" id="x_oferta" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($solicitud_fondeo->oferta->getPlaceHolder()) ?>" value="<?php echo $solicitud_fondeo->oferta->EditValue ?>"<?php echo $solicitud_fondeo->oferta->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_solicitud_fondeo_oferta">
<span<?php echo $solicitud_fondeo->oferta->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($solicitud_fondeo->oferta->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="solicitud_fondeo" data-field="x_oferta" name="x_oferta" id="x_oferta" value="<?php echo HtmlEncode($solicitud_fondeo->oferta->FormValue) ?>">
<?php } ?>
<?php echo $solicitud_fondeo->oferta->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($solicitud_fondeo->compradorid_comprador->Visible) { // compradorid_comprador ?>
	<div id="r_compradorid_comprador" class="form-group row">
		<label id="elh_solicitud_fondeo_compradorid_comprador" for="x_compradorid_comprador" class="<?php echo $solicitud_fondeo_edit->LeftColumnClass ?>"><?php echo $solicitud_fondeo->compradorid_comprador->caption() ?><?php echo ($solicitud_fondeo->compradorid_comprador->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $solicitud_fondeo_edit->RightColumnClass ?>"><div<?php echo $solicitud_fondeo->compradorid_comprador->cellAttributes() ?>>
<?php if (!$solicitud_fondeo->isConfirm()) { ?>
<span id="el_solicitud_fondeo_compradorid_comprador">
<input type="text" data-table="solicitud_fondeo" data-field="x_compradorid_comprador" name="x_compradorid_comprador" id="x_compradorid_comprador" size="30" placeholder="<?php echo HtmlEncode($solicitud_fondeo->compradorid_comprador->getPlaceHolder()) ?>" value="<?php echo $solicitud_fondeo->compradorid_comprador->EditValue ?>"<?php echo $solicitud_fondeo->compradorid_comprador->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_solicitud_fondeo_compradorid_comprador">
<span<?php echo $solicitud_fondeo->compradorid_comprador->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($solicitud_fondeo->compradorid_comprador->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="solicitud_fondeo" data-field="x_compradorid_comprador" name="x_compradorid_comprador" id="x_compradorid_comprador" value="<?php echo HtmlEncode($solicitud_fondeo->compradorid_comprador->FormValue) ?>">
<?php } ?>
<?php echo $solicitud_fondeo->compradorid_comprador->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$solicitud_fondeo_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $solicitud_fondeo_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if ($solicitud_fondeo->UpdateConflict == "U") { // Record already updated by other user ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='overwrite';"><?php echo $Language->phrase("OverwriteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-reload" id="btn-reload" type="submit" onclick="this.form.action.value='show';"><?php echo $Language->phrase("ReloadBtn") ?></button>
<?php } else { ?>
<?php if (!$solicitud_fondeo->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $solicitud_fondeo_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
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
$solicitud_fondeo_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$solicitud_fondeo_edit->terminate();
?>