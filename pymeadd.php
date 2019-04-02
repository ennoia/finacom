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
$pyme_add = new pyme_add();

// Run the page
$pyme_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pyme_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fpymeadd = currentForm = new ew.Form("fpymeadd", "add");

// Validate form
fpymeadd.validate = function() {
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
		<?php if ($pyme_add->rfcpyme->Required) { ?>
			elm = this.getElements("x" + infix + "_rfcpyme");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pyme->rfcpyme->caption(), $pyme->rfcpyme->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($pyme_add->id_pyme->Required) { ?>
			elm = this.getElements("x" + infix + "_id_pyme");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pyme->id_pyme->caption(), $pyme->id_pyme->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_id_pyme");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($pyme->id_pyme->errorMessage()) ?>");
		<?php if ($pyme_add->razon_social->Required) { ?>
			elm = this.getElements("x" + infix + "_razon_social");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pyme->razon_social->caption(), $pyme->razon_social->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($pyme_add->calle->Required) { ?>
			elm = this.getElements("x" + infix + "_calle");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pyme->calle->caption(), $pyme->calle->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($pyme_add->colonia->Required) { ?>
			elm = this.getElements("x" + infix + "_colonia");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pyme->colonia->caption(), $pyme->colonia->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($pyme_add->ciudad->Required) { ?>
			elm = this.getElements("x" + infix + "_ciudad");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pyme->ciudad->caption(), $pyme->ciudad->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($pyme_add->codpostal->Required) { ?>
			elm = this.getElements("x" + infix + "_codpostal");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pyme->codpostal->caption(), $pyme->codpostal->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_codpostal");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($pyme->codpostal->errorMessage()) ?>");
		<?php if ($pyme_add->correo->Required) { ?>
			elm = this.getElements("x" + infix + "_correo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pyme->correo->caption(), $pyme->correo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($pyme_add->telefono->Required) { ?>
			elm = this.getElements("x" + infix + "_telefono");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pyme->telefono->caption(), $pyme->telefono->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($pyme_add->pais->Required) { ?>
			elm = this.getElements("x" + infix + "_pais");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pyme->pais->caption(), $pyme->pais->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_pais");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($pyme->pais->errorMessage()) ?>");
		<?php if ($pyme_add->contrato_firmado->Required) { ?>
			felm = this.getElements("x" + infix + "_contrato_firmado");
			elm = this.getElements("fn_x" + infix + "_contrato_firmado");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $pyme->contrato_firmado->caption(), $pyme->contrato_firmado->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($pyme_add->preafiliacion->Required) { ?>
			elm = this.getElements("x" + infix + "_preafiliacion");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pyme->preafiliacion->caption(), $pyme->preafiliacion->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_preafiliacion");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($pyme->preafiliacion->errorMessage()) ?>");
		<?php if ($pyme_add->edooperacionpyme->Required) { ?>
			elm = this.getElements("x" + infix + "_edooperacionpyme");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pyme->edooperacionpyme->caption(), $pyme->edooperacionpyme->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_edooperacionpyme");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($pyme->edooperacionpyme->errorMessage()) ?>");
		<?php if ($pyme_add->compradorrfc->Required) { ?>
			elm = this.getElements("x" + infix + "_compradorrfc");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pyme->compradorrfc->caption(), $pyme->compradorrfc->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($pyme_add->comprador->Required) { ?>
			elm = this.getElements("x" + infix + "_comprador");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pyme->comprador->caption(), $pyme->comprador->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_comprador");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($pyme->comprador->errorMessage()) ?>");

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
fpymeadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fpymeadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fpymeadd.lists["x_compradorrfc"] = <?php echo $pyme_add->compradorrfc->Lookup->toClientList() ?>;
fpymeadd.lists["x_compradorrfc"].options = <?php echo JsonEncode($pyme_add->compradorrfc->lookupOptions()) ?>;
fpymeadd.autoSuggests["x_compradorrfc"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $pyme_add->showPageHeader(); ?>
<?php
$pyme_add->showMessage();
?>
<form name="fpymeadd" id="fpymeadd" class="<?php echo $pyme_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($pyme_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $pyme_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pyme">
<?php if ($pyme->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$pyme_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($pyme->rfcpyme->Visible) { // rfcpyme ?>
	<div id="r_rfcpyme" class="form-group row">
		<label id="elh_pyme_rfcpyme" for="x_rfcpyme" class="<?php echo $pyme_add->LeftColumnClass ?>"><?php echo $pyme->rfcpyme->caption() ?><?php echo ($pyme->rfcpyme->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pyme_add->RightColumnClass ?>"><div<?php echo $pyme->rfcpyme->cellAttributes() ?>>
<?php if (!$pyme->isConfirm()) { ?>
<span id="el_pyme_rfcpyme">
<input type="text" data-table="pyme" data-field="x_rfcpyme" name="x_rfcpyme" id="x_rfcpyme" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($pyme->rfcpyme->getPlaceHolder()) ?>" value="<?php echo $pyme->rfcpyme->EditValue ?>"<?php echo $pyme->rfcpyme->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_pyme_rfcpyme">
<span<?php echo $pyme->rfcpyme->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($pyme->rfcpyme->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="pyme" data-field="x_rfcpyme" name="x_rfcpyme" id="x_rfcpyme" value="<?php echo HtmlEncode($pyme->rfcpyme->FormValue) ?>">
<?php } ?>
<?php echo $pyme->rfcpyme->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pyme->id_pyme->Visible) { // id_pyme ?>
	<div id="r_id_pyme" class="form-group row">
		<label id="elh_pyme_id_pyme" for="x_id_pyme" class="<?php echo $pyme_add->LeftColumnClass ?>"><?php echo $pyme->id_pyme->caption() ?><?php echo ($pyme->id_pyme->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pyme_add->RightColumnClass ?>"><div<?php echo $pyme->id_pyme->cellAttributes() ?>>
<?php if (!$pyme->isConfirm()) { ?>
<span id="el_pyme_id_pyme">
<input type="text" data-table="pyme" data-field="x_id_pyme" name="x_id_pyme" id="x_id_pyme" size="30" placeholder="<?php echo HtmlEncode($pyme->id_pyme->getPlaceHolder()) ?>" value="<?php echo $pyme->id_pyme->EditValue ?>"<?php echo $pyme->id_pyme->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_pyme_id_pyme">
<span<?php echo $pyme->id_pyme->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($pyme->id_pyme->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="pyme" data-field="x_id_pyme" name="x_id_pyme" id="x_id_pyme" value="<?php echo HtmlEncode($pyme->id_pyme->FormValue) ?>">
<?php } ?>
<?php echo $pyme->id_pyme->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pyme->razon_social->Visible) { // razon_social ?>
	<div id="r_razon_social" class="form-group row">
		<label id="elh_pyme_razon_social" for="x_razon_social" class="<?php echo $pyme_add->LeftColumnClass ?>"><?php echo $pyme->razon_social->caption() ?><?php echo ($pyme->razon_social->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pyme_add->RightColumnClass ?>"><div<?php echo $pyme->razon_social->cellAttributes() ?>>
<?php if (!$pyme->isConfirm()) { ?>
<span id="el_pyme_razon_social">
<input type="text" data-table="pyme" data-field="x_razon_social" name="x_razon_social" id="x_razon_social" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($pyme->razon_social->getPlaceHolder()) ?>" value="<?php echo $pyme->razon_social->EditValue ?>"<?php echo $pyme->razon_social->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_pyme_razon_social">
<span<?php echo $pyme->razon_social->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($pyme->razon_social->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="pyme" data-field="x_razon_social" name="x_razon_social" id="x_razon_social" value="<?php echo HtmlEncode($pyme->razon_social->FormValue) ?>">
<?php } ?>
<?php echo $pyme->razon_social->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pyme->calle->Visible) { // calle ?>
	<div id="r_calle" class="form-group row">
		<label id="elh_pyme_calle" for="x_calle" class="<?php echo $pyme_add->LeftColumnClass ?>"><?php echo $pyme->calle->caption() ?><?php echo ($pyme->calle->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pyme_add->RightColumnClass ?>"><div<?php echo $pyme->calle->cellAttributes() ?>>
<?php if (!$pyme->isConfirm()) { ?>
<span id="el_pyme_calle">
<input type="text" data-table="pyme" data-field="x_calle" name="x_calle" id="x_calle" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($pyme->calle->getPlaceHolder()) ?>" value="<?php echo $pyme->calle->EditValue ?>"<?php echo $pyme->calle->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_pyme_calle">
<span<?php echo $pyme->calle->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($pyme->calle->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="pyme" data-field="x_calle" name="x_calle" id="x_calle" value="<?php echo HtmlEncode($pyme->calle->FormValue) ?>">
<?php } ?>
<?php echo $pyme->calle->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pyme->colonia->Visible) { // colonia ?>
	<div id="r_colonia" class="form-group row">
		<label id="elh_pyme_colonia" for="x_colonia" class="<?php echo $pyme_add->LeftColumnClass ?>"><?php echo $pyme->colonia->caption() ?><?php echo ($pyme->colonia->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pyme_add->RightColumnClass ?>"><div<?php echo $pyme->colonia->cellAttributes() ?>>
<?php if (!$pyme->isConfirm()) { ?>
<span id="el_pyme_colonia">
<input type="text" data-table="pyme" data-field="x_colonia" name="x_colonia" id="x_colonia" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($pyme->colonia->getPlaceHolder()) ?>" value="<?php echo $pyme->colonia->EditValue ?>"<?php echo $pyme->colonia->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_pyme_colonia">
<span<?php echo $pyme->colonia->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($pyme->colonia->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="pyme" data-field="x_colonia" name="x_colonia" id="x_colonia" value="<?php echo HtmlEncode($pyme->colonia->FormValue) ?>">
<?php } ?>
<?php echo $pyme->colonia->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pyme->ciudad->Visible) { // ciudad ?>
	<div id="r_ciudad" class="form-group row">
		<label id="elh_pyme_ciudad" for="x_ciudad" class="<?php echo $pyme_add->LeftColumnClass ?>"><?php echo $pyme->ciudad->caption() ?><?php echo ($pyme->ciudad->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pyme_add->RightColumnClass ?>"><div<?php echo $pyme->ciudad->cellAttributes() ?>>
<?php if (!$pyme->isConfirm()) { ?>
<span id="el_pyme_ciudad">
<input type="text" data-table="pyme" data-field="x_ciudad" name="x_ciudad" id="x_ciudad" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($pyme->ciudad->getPlaceHolder()) ?>" value="<?php echo $pyme->ciudad->EditValue ?>"<?php echo $pyme->ciudad->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_pyme_ciudad">
<span<?php echo $pyme->ciudad->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($pyme->ciudad->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="pyme" data-field="x_ciudad" name="x_ciudad" id="x_ciudad" value="<?php echo HtmlEncode($pyme->ciudad->FormValue) ?>">
<?php } ?>
<?php echo $pyme->ciudad->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pyme->codpostal->Visible) { // codpostal ?>
	<div id="r_codpostal" class="form-group row">
		<label id="elh_pyme_codpostal" for="x_codpostal" class="<?php echo $pyme_add->LeftColumnClass ?>"><?php echo $pyme->codpostal->caption() ?><?php echo ($pyme->codpostal->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pyme_add->RightColumnClass ?>"><div<?php echo $pyme->codpostal->cellAttributes() ?>>
<?php if (!$pyme->isConfirm()) { ?>
<span id="el_pyme_codpostal">
<input type="text" data-table="pyme" data-field="x_codpostal" name="x_codpostal" id="x_codpostal" size="30" placeholder="<?php echo HtmlEncode($pyme->codpostal->getPlaceHolder()) ?>" value="<?php echo $pyme->codpostal->EditValue ?>"<?php echo $pyme->codpostal->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_pyme_codpostal">
<span<?php echo $pyme->codpostal->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($pyme->codpostal->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="pyme" data-field="x_codpostal" name="x_codpostal" id="x_codpostal" value="<?php echo HtmlEncode($pyme->codpostal->FormValue) ?>">
<?php } ?>
<?php echo $pyme->codpostal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pyme->correo->Visible) { // correo ?>
	<div id="r_correo" class="form-group row">
		<label id="elh_pyme_correo" for="x_correo" class="<?php echo $pyme_add->LeftColumnClass ?>"><?php echo $pyme->correo->caption() ?><?php echo ($pyme->correo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pyme_add->RightColumnClass ?>"><div<?php echo $pyme->correo->cellAttributes() ?>>
<?php if (!$pyme->isConfirm()) { ?>
<span id="el_pyme_correo">
<input type="text" data-table="pyme" data-field="x_correo" name="x_correo" id="x_correo" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($pyme->correo->getPlaceHolder()) ?>" value="<?php echo $pyme->correo->EditValue ?>"<?php echo $pyme->correo->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_pyme_correo">
<span<?php echo $pyme->correo->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($pyme->correo->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="pyme" data-field="x_correo" name="x_correo" id="x_correo" value="<?php echo HtmlEncode($pyme->correo->FormValue) ?>">
<?php } ?>
<?php echo $pyme->correo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pyme->telefono->Visible) { // telefono ?>
	<div id="r_telefono" class="form-group row">
		<label id="elh_pyme_telefono" for="x_telefono" class="<?php echo $pyme_add->LeftColumnClass ?>"><?php echo $pyme->telefono->caption() ?><?php echo ($pyme->telefono->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pyme_add->RightColumnClass ?>"><div<?php echo $pyme->telefono->cellAttributes() ?>>
<?php if (!$pyme->isConfirm()) { ?>
<span id="el_pyme_telefono">
<input type="text" data-table="pyme" data-field="x_telefono" name="x_telefono" id="x_telefono" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($pyme->telefono->getPlaceHolder()) ?>" value="<?php echo $pyme->telefono->EditValue ?>"<?php echo $pyme->telefono->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_pyme_telefono">
<span<?php echo $pyme->telefono->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($pyme->telefono->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="pyme" data-field="x_telefono" name="x_telefono" id="x_telefono" value="<?php echo HtmlEncode($pyme->telefono->FormValue) ?>">
<?php } ?>
<?php echo $pyme->telefono->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pyme->pais->Visible) { // pais ?>
	<div id="r_pais" class="form-group row">
		<label id="elh_pyme_pais" for="x_pais" class="<?php echo $pyme_add->LeftColumnClass ?>"><?php echo $pyme->pais->caption() ?><?php echo ($pyme->pais->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pyme_add->RightColumnClass ?>"><div<?php echo $pyme->pais->cellAttributes() ?>>
<?php if (!$pyme->isConfirm()) { ?>
<span id="el_pyme_pais">
<input type="text" data-table="pyme" data-field="x_pais" name="x_pais" id="x_pais" size="30" placeholder="<?php echo HtmlEncode($pyme->pais->getPlaceHolder()) ?>" value="<?php echo $pyme->pais->EditValue ?>"<?php echo $pyme->pais->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_pyme_pais">
<span<?php echo $pyme->pais->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($pyme->pais->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="pyme" data-field="x_pais" name="x_pais" id="x_pais" value="<?php echo HtmlEncode($pyme->pais->FormValue) ?>">
<?php } ?>
<?php echo $pyme->pais->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pyme->contrato_firmado->Visible) { // contrato_firmado ?>
	<div id="r_contrato_firmado" class="form-group row">
		<label id="elh_pyme_contrato_firmado" class="<?php echo $pyme_add->LeftColumnClass ?>"><?php echo $pyme->contrato_firmado->caption() ?><?php echo ($pyme->contrato_firmado->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pyme_add->RightColumnClass ?>"><div<?php echo $pyme->contrato_firmado->cellAttributes() ?>>
<span id="el_pyme_contrato_firmado">
<div id="fd_x_contrato_firmado">
<span title="<?php echo $pyme->contrato_firmado->title() ? $pyme->contrato_firmado->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($pyme->contrato_firmado->ReadOnly || $pyme->contrato_firmado->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="pyme" data-field="x_contrato_firmado" name="x_contrato_firmado" id="x_contrato_firmado"<?php echo $pyme->contrato_firmado->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_contrato_firmado" id= "fn_x_contrato_firmado" value="<?php echo $pyme->contrato_firmado->Upload->FileName ?>">
<input type="hidden" name="fa_x_contrato_firmado" id= "fa_x_contrato_firmado" value="0">
<input type="hidden" name="fs_x_contrato_firmado" id= "fs_x_contrato_firmado" value="0">
<input type="hidden" name="fx_x_contrato_firmado" id= "fx_x_contrato_firmado" value="<?php echo $pyme->contrato_firmado->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_contrato_firmado" id= "fm_x_contrato_firmado" value="<?php echo $pyme->contrato_firmado->UploadMaxFileSize ?>">
</div>
<table id="ft_x_contrato_firmado" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $pyme->contrato_firmado->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pyme->preafiliacion->Visible) { // preafiliacion ?>
	<div id="r_preafiliacion" class="form-group row">
		<label id="elh_pyme_preafiliacion" for="x_preafiliacion" class="<?php echo $pyme_add->LeftColumnClass ?>"><?php echo $pyme->preafiliacion->caption() ?><?php echo ($pyme->preafiliacion->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pyme_add->RightColumnClass ?>"><div<?php echo $pyme->preafiliacion->cellAttributes() ?>>
<?php if (!$pyme->isConfirm()) { ?>
<span id="el_pyme_preafiliacion">
<input type="text" data-table="pyme" data-field="x_preafiliacion" name="x_preafiliacion" id="x_preafiliacion" size="30" placeholder="<?php echo HtmlEncode($pyme->preafiliacion->getPlaceHolder()) ?>" value="<?php echo $pyme->preafiliacion->EditValue ?>"<?php echo $pyme->preafiliacion->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_pyme_preafiliacion">
<span<?php echo $pyme->preafiliacion->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($pyme->preafiliacion->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="pyme" data-field="x_preafiliacion" name="x_preafiliacion" id="x_preafiliacion" value="<?php echo HtmlEncode($pyme->preafiliacion->FormValue) ?>">
<?php } ?>
<?php echo $pyme->preafiliacion->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pyme->edooperacionpyme->Visible) { // edooperacionpyme ?>
	<div id="r_edooperacionpyme" class="form-group row">
		<label id="elh_pyme_edooperacionpyme" for="x_edooperacionpyme" class="<?php echo $pyme_add->LeftColumnClass ?>"><?php echo $pyme->edooperacionpyme->caption() ?><?php echo ($pyme->edooperacionpyme->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pyme_add->RightColumnClass ?>"><div<?php echo $pyme->edooperacionpyme->cellAttributes() ?>>
<?php if (!$pyme->isConfirm()) { ?>
<span id="el_pyme_edooperacionpyme">
<input type="text" data-table="pyme" data-field="x_edooperacionpyme" name="x_edooperacionpyme" id="x_edooperacionpyme" size="30" placeholder="<?php echo HtmlEncode($pyme->edooperacionpyme->getPlaceHolder()) ?>" value="<?php echo $pyme->edooperacionpyme->EditValue ?>"<?php echo $pyme->edooperacionpyme->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_pyme_edooperacionpyme">
<span<?php echo $pyme->edooperacionpyme->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($pyme->edooperacionpyme->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="pyme" data-field="x_edooperacionpyme" name="x_edooperacionpyme" id="x_edooperacionpyme" value="<?php echo HtmlEncode($pyme->edooperacionpyme->FormValue) ?>">
<?php } ?>
<?php echo $pyme->edooperacionpyme->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pyme->compradorrfc->Visible) { // compradorrfc ?>
	<div id="r_compradorrfc" class="form-group row">
		<label id="elh_pyme_compradorrfc" class="<?php echo $pyme_add->LeftColumnClass ?>"><?php echo $pyme->compradorrfc->caption() ?><?php echo ($pyme->compradorrfc->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pyme_add->RightColumnClass ?>"><div<?php echo $pyme->compradorrfc->cellAttributes() ?>>
<?php if (!$pyme->isConfirm()) { ?>
<span id="el_pyme_compradorrfc">
<?php
$wrkonchange = "" . trim(@$pyme->compradorrfc->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$pyme->compradorrfc->EditAttrs["onchange"] = "";
?>
<span id="as_x_compradorrfc" class="text-nowrap" style="z-index: 8860">
	<div class="input-group mb-3">
		<input type="text" class="form-control" name="sv_x_compradorrfc" id="sv_x_compradorrfc" value="<?php echo RemoveHtml($pyme->compradorrfc->EditValue) ?>" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($pyme->compradorrfc->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($pyme->compradorrfc->getPlaceHolder()) ?>"<?php echo $pyme->compradorrfc->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($pyme->compradorrfc->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_compradorrfc',m:0,n:50,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo (($pyme->compradorrfc->ReadOnly || $pyme->compradorrfc->Disabled) ? " disabled" : "")?>><i class="fa fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="pyme" data-field="x_compradorrfc" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $pyme->compradorrfc->displayValueSeparatorAttribute() ?>" name="x_compradorrfc" id="x_compradorrfc" value="<?php echo HtmlEncode($pyme->compradorrfc->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fpymeadd.createAutoSuggest({"id":"x_compradorrfc","forceSelect":false});
</script>
<?php echo $pyme->compradorrfc->Lookup->getParamTag("p_x_compradorrfc") ?>
</span>
<?php } else { ?>
<span id="el_pyme_compradorrfc">
<span<?php echo $pyme->compradorrfc->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($pyme->compradorrfc->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="pyme" data-field="x_compradorrfc" name="x_compradorrfc" id="x_compradorrfc" value="<?php echo HtmlEncode($pyme->compradorrfc->FormValue) ?>">
<?php } ?>
<?php echo $pyme->compradorrfc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pyme->comprador->Visible) { // comprador ?>
	<div id="r_comprador" class="form-group row">
		<label id="elh_pyme_comprador" for="x_comprador" class="<?php echo $pyme_add->LeftColumnClass ?>"><?php echo $pyme->comprador->caption() ?><?php echo ($pyme->comprador->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pyme_add->RightColumnClass ?>"><div<?php echo $pyme->comprador->cellAttributes() ?>>
<?php if (!$pyme->isConfirm()) { ?>
<span id="el_pyme_comprador">
<input type="text" data-table="pyme" data-field="x_comprador" name="x_comprador" id="x_comprador" size="30" placeholder="<?php echo HtmlEncode($pyme->comprador->getPlaceHolder()) ?>" value="<?php echo $pyme->comprador->EditValue ?>"<?php echo $pyme->comprador->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_pyme_comprador">
<span<?php echo $pyme->comprador->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($pyme->comprador->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="pyme" data-field="x_comprador" name="x_comprador" id="x_comprador" value="<?php echo HtmlEncode($pyme->comprador->FormValue) ?>">
<?php } ?>
<?php echo $pyme->comprador->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$pyme_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $pyme_add->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$pyme->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $pyme_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$pyme_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$pyme_add->terminate();
?>