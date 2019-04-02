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
$comprador_add = new comprador_add();

// Run the page
$comprador_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$comprador_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fcompradoradd = currentForm = new ew.Form("fcompradoradd", "add");

// Validate form
fcompradoradd.validate = function() {
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
		<?php if ($comprador_add->id_comprador->Required) { ?>
			elm = this.getElements("x" + infix + "_id_comprador");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $comprador->id_comprador->caption(), $comprador->id_comprador->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_id_comprador");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($comprador->id_comprador->errorMessage()) ?>");
		<?php if ($comprador_add->razon_social->Required) { ?>
			elm = this.getElements("x" + infix + "_razon_social");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $comprador->razon_social->caption(), $comprador->razon_social->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($comprador_add->rfc->Required) { ?>
			elm = this.getElements("x" + infix + "_rfc");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $comprador->rfc->caption(), $comprador->rfc->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($comprador_add->calle->Required) { ?>
			elm = this.getElements("x" + infix + "_calle");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $comprador->calle->caption(), $comprador->calle->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($comprador_add->colonia->Required) { ?>
			elm = this.getElements("x" + infix + "_colonia");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $comprador->colonia->caption(), $comprador->colonia->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($comprador_add->codpostal->Required) { ?>
			elm = this.getElements("x" + infix + "_codpostal");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $comprador->codpostal->caption(), $comprador->codpostal->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_codpostal");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($comprador->codpostal->errorMessage()) ?>");
		<?php if ($comprador_add->ciudad->Required) { ?>
			elm = this.getElements("x" + infix + "_ciudad");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $comprador->ciudad->caption(), $comprador->ciudad->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($comprador_add->telefono->Required) { ?>
			elm = this.getElements("x" + infix + "_telefono");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $comprador->telefono->caption(), $comprador->telefono->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($comprador_add->correo->Required) { ?>
			elm = this.getElements("x" + infix + "_correo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $comprador->correo->caption(), $comprador->correo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($comprador_add->pais->Required) { ?>
			elm = this.getElements("x" + infix + "_pais");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $comprador->pais->caption(), $comprador->pais->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_pais");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($comprador->pais->errorMessage()) ?>");
		<?php if ($comprador_add->pymerfc->Required) { ?>
			elm = this.getElements("x" + infix + "_pymerfc");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $comprador->pymerfc->caption(), $comprador->pymerfc->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_pymerfc");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($comprador->pymerfc->errorMessage()) ?>");

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
fcompradoradd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcompradoradd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcompradoradd.lists["x_pymerfc"] = <?php echo $comprador_add->pymerfc->Lookup->toClientList() ?>;
fcompradoradd.lists["x_pymerfc"].options = <?php echo JsonEncode($comprador_add->pymerfc->lookupOptions()) ?>;
fcompradoradd.autoSuggests["x_pymerfc"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $comprador_add->showPageHeader(); ?>
<?php
$comprador_add->showMessage();
?>
<form name="fcompradoradd" id="fcompradoradd" class="<?php echo $comprador_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($comprador_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $comprador_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="comprador">
<?php if ($comprador->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$comprador_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($comprador->id_comprador->Visible) { // id_comprador ?>
	<div id="r_id_comprador" class="form-group row">
		<label id="elh_comprador_id_comprador" for="x_id_comprador" class="<?php echo $comprador_add->LeftColumnClass ?>"><?php echo $comprador->id_comprador->caption() ?><?php echo ($comprador->id_comprador->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $comprador_add->RightColumnClass ?>"><div<?php echo $comprador->id_comprador->cellAttributes() ?>>
<?php if (!$comprador->isConfirm()) { ?>
<span id="el_comprador_id_comprador">
<input type="text" data-table="comprador" data-field="x_id_comprador" name="x_id_comprador" id="x_id_comprador" size="30" placeholder="<?php echo HtmlEncode($comprador->id_comprador->getPlaceHolder()) ?>" value="<?php echo $comprador->id_comprador->EditValue ?>"<?php echo $comprador->id_comprador->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_comprador_id_comprador">
<span<?php echo $comprador->id_comprador->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($comprador->id_comprador->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="comprador" data-field="x_id_comprador" name="x_id_comprador" id="x_id_comprador" value="<?php echo HtmlEncode($comprador->id_comprador->FormValue) ?>">
<?php } ?>
<?php echo $comprador->id_comprador->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($comprador->razon_social->Visible) { // razon_social ?>
	<div id="r_razon_social" class="form-group row">
		<label id="elh_comprador_razon_social" for="x_razon_social" class="<?php echo $comprador_add->LeftColumnClass ?>"><?php echo $comprador->razon_social->caption() ?><?php echo ($comprador->razon_social->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $comprador_add->RightColumnClass ?>"><div<?php echo $comprador->razon_social->cellAttributes() ?>>
<?php if (!$comprador->isConfirm()) { ?>
<span id="el_comprador_razon_social">
<input type="text" data-table="comprador" data-field="x_razon_social" name="x_razon_social" id="x_razon_social" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($comprador->razon_social->getPlaceHolder()) ?>" value="<?php echo $comprador->razon_social->EditValue ?>"<?php echo $comprador->razon_social->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_comprador_razon_social">
<span<?php echo $comprador->razon_social->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($comprador->razon_social->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="comprador" data-field="x_razon_social" name="x_razon_social" id="x_razon_social" value="<?php echo HtmlEncode($comprador->razon_social->FormValue) ?>">
<?php } ?>
<?php echo $comprador->razon_social->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($comprador->rfc->Visible) { // rfc ?>
	<div id="r_rfc" class="form-group row">
		<label id="elh_comprador_rfc" for="x_rfc" class="<?php echo $comprador_add->LeftColumnClass ?>"><?php echo $comprador->rfc->caption() ?><?php echo ($comprador->rfc->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $comprador_add->RightColumnClass ?>"><div<?php echo $comprador->rfc->cellAttributes() ?>>
<?php if (!$comprador->isConfirm()) { ?>
<span id="el_comprador_rfc">
<input type="text" data-table="comprador" data-field="x_rfc" name="x_rfc" id="x_rfc" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($comprador->rfc->getPlaceHolder()) ?>" value="<?php echo $comprador->rfc->EditValue ?>"<?php echo $comprador->rfc->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_comprador_rfc">
<span<?php echo $comprador->rfc->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($comprador->rfc->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="comprador" data-field="x_rfc" name="x_rfc" id="x_rfc" value="<?php echo HtmlEncode($comprador->rfc->FormValue) ?>">
<?php } ?>
<?php echo $comprador->rfc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($comprador->calle->Visible) { // calle ?>
	<div id="r_calle" class="form-group row">
		<label id="elh_comprador_calle" for="x_calle" class="<?php echo $comprador_add->LeftColumnClass ?>"><?php echo $comprador->calle->caption() ?><?php echo ($comprador->calle->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $comprador_add->RightColumnClass ?>"><div<?php echo $comprador->calle->cellAttributes() ?>>
<?php if (!$comprador->isConfirm()) { ?>
<span id="el_comprador_calle">
<input type="text" data-table="comprador" data-field="x_calle" name="x_calle" id="x_calle" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($comprador->calle->getPlaceHolder()) ?>" value="<?php echo $comprador->calle->EditValue ?>"<?php echo $comprador->calle->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_comprador_calle">
<span<?php echo $comprador->calle->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($comprador->calle->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="comprador" data-field="x_calle" name="x_calle" id="x_calle" value="<?php echo HtmlEncode($comprador->calle->FormValue) ?>">
<?php } ?>
<?php echo $comprador->calle->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($comprador->colonia->Visible) { // colonia ?>
	<div id="r_colonia" class="form-group row">
		<label id="elh_comprador_colonia" for="x_colonia" class="<?php echo $comprador_add->LeftColumnClass ?>"><?php echo $comprador->colonia->caption() ?><?php echo ($comprador->colonia->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $comprador_add->RightColumnClass ?>"><div<?php echo $comprador->colonia->cellAttributes() ?>>
<?php if (!$comprador->isConfirm()) { ?>
<span id="el_comprador_colonia">
<input type="text" data-table="comprador" data-field="x_colonia" name="x_colonia" id="x_colonia" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($comprador->colonia->getPlaceHolder()) ?>" value="<?php echo $comprador->colonia->EditValue ?>"<?php echo $comprador->colonia->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_comprador_colonia">
<span<?php echo $comprador->colonia->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($comprador->colonia->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="comprador" data-field="x_colonia" name="x_colonia" id="x_colonia" value="<?php echo HtmlEncode($comprador->colonia->FormValue) ?>">
<?php } ?>
<?php echo $comprador->colonia->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($comprador->codpostal->Visible) { // codpostal ?>
	<div id="r_codpostal" class="form-group row">
		<label id="elh_comprador_codpostal" for="x_codpostal" class="<?php echo $comprador_add->LeftColumnClass ?>"><?php echo $comprador->codpostal->caption() ?><?php echo ($comprador->codpostal->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $comprador_add->RightColumnClass ?>"><div<?php echo $comprador->codpostal->cellAttributes() ?>>
<?php if (!$comprador->isConfirm()) { ?>
<span id="el_comprador_codpostal">
<input type="text" data-table="comprador" data-field="x_codpostal" name="x_codpostal" id="x_codpostal" size="30" placeholder="<?php echo HtmlEncode($comprador->codpostal->getPlaceHolder()) ?>" value="<?php echo $comprador->codpostal->EditValue ?>"<?php echo $comprador->codpostal->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_comprador_codpostal">
<span<?php echo $comprador->codpostal->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($comprador->codpostal->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="comprador" data-field="x_codpostal" name="x_codpostal" id="x_codpostal" value="<?php echo HtmlEncode($comprador->codpostal->FormValue) ?>">
<?php } ?>
<?php echo $comprador->codpostal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($comprador->ciudad->Visible) { // ciudad ?>
	<div id="r_ciudad" class="form-group row">
		<label id="elh_comprador_ciudad" for="x_ciudad" class="<?php echo $comprador_add->LeftColumnClass ?>"><?php echo $comprador->ciudad->caption() ?><?php echo ($comprador->ciudad->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $comprador_add->RightColumnClass ?>"><div<?php echo $comprador->ciudad->cellAttributes() ?>>
<?php if (!$comprador->isConfirm()) { ?>
<span id="el_comprador_ciudad">
<input type="text" data-table="comprador" data-field="x_ciudad" name="x_ciudad" id="x_ciudad" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($comprador->ciudad->getPlaceHolder()) ?>" value="<?php echo $comprador->ciudad->EditValue ?>"<?php echo $comprador->ciudad->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_comprador_ciudad">
<span<?php echo $comprador->ciudad->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($comprador->ciudad->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="comprador" data-field="x_ciudad" name="x_ciudad" id="x_ciudad" value="<?php echo HtmlEncode($comprador->ciudad->FormValue) ?>">
<?php } ?>
<?php echo $comprador->ciudad->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($comprador->telefono->Visible) { // telefono ?>
	<div id="r_telefono" class="form-group row">
		<label id="elh_comprador_telefono" for="x_telefono" class="<?php echo $comprador_add->LeftColumnClass ?>"><?php echo $comprador->telefono->caption() ?><?php echo ($comprador->telefono->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $comprador_add->RightColumnClass ?>"><div<?php echo $comprador->telefono->cellAttributes() ?>>
<?php if (!$comprador->isConfirm()) { ?>
<span id="el_comprador_telefono">
<input type="text" data-table="comprador" data-field="x_telefono" name="x_telefono" id="x_telefono" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($comprador->telefono->getPlaceHolder()) ?>" value="<?php echo $comprador->telefono->EditValue ?>"<?php echo $comprador->telefono->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_comprador_telefono">
<span<?php echo $comprador->telefono->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($comprador->telefono->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="comprador" data-field="x_telefono" name="x_telefono" id="x_telefono" value="<?php echo HtmlEncode($comprador->telefono->FormValue) ?>">
<?php } ?>
<?php echo $comprador->telefono->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($comprador->correo->Visible) { // correo ?>
	<div id="r_correo" class="form-group row">
		<label id="elh_comprador_correo" for="x_correo" class="<?php echo $comprador_add->LeftColumnClass ?>"><?php echo $comprador->correo->caption() ?><?php echo ($comprador->correo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $comprador_add->RightColumnClass ?>"><div<?php echo $comprador->correo->cellAttributes() ?>>
<?php if (!$comprador->isConfirm()) { ?>
<span id="el_comprador_correo">
<input type="text" data-table="comprador" data-field="x_correo" name="x_correo" id="x_correo" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($comprador->correo->getPlaceHolder()) ?>" value="<?php echo $comprador->correo->EditValue ?>"<?php echo $comprador->correo->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_comprador_correo">
<span<?php echo $comprador->correo->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($comprador->correo->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="comprador" data-field="x_correo" name="x_correo" id="x_correo" value="<?php echo HtmlEncode($comprador->correo->FormValue) ?>">
<?php } ?>
<?php echo $comprador->correo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($comprador->pais->Visible) { // pais ?>
	<div id="r_pais" class="form-group row">
		<label id="elh_comprador_pais" for="x_pais" class="<?php echo $comprador_add->LeftColumnClass ?>"><?php echo $comprador->pais->caption() ?><?php echo ($comprador->pais->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $comprador_add->RightColumnClass ?>"><div<?php echo $comprador->pais->cellAttributes() ?>>
<?php if (!$comprador->isConfirm()) { ?>
<span id="el_comprador_pais">
<input type="text" data-table="comprador" data-field="x_pais" name="x_pais" id="x_pais" size="30" placeholder="<?php echo HtmlEncode($comprador->pais->getPlaceHolder()) ?>" value="<?php echo $comprador->pais->EditValue ?>"<?php echo $comprador->pais->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_comprador_pais">
<span<?php echo $comprador->pais->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($comprador->pais->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="comprador" data-field="x_pais" name="x_pais" id="x_pais" value="<?php echo HtmlEncode($comprador->pais->FormValue) ?>">
<?php } ?>
<?php echo $comprador->pais->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($comprador->pymerfc->Visible) { // pymerfc ?>
	<div id="r_pymerfc" class="form-group row">
		<label id="elh_comprador_pymerfc" class="<?php echo $comprador_add->LeftColumnClass ?>"><?php echo $comprador->pymerfc->caption() ?><?php echo ($comprador->pymerfc->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $comprador_add->RightColumnClass ?>"><div<?php echo $comprador->pymerfc->cellAttributes() ?>>
<?php if (!$comprador->isConfirm()) { ?>
<span id="el_comprador_pymerfc">
<?php
$wrkonchange = "" . trim(@$comprador->pymerfc->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$comprador->pymerfc->EditAttrs["onchange"] = "";
?>
<span id="as_x_pymerfc" class="text-nowrap" style="z-index: 8890">
	<div class="input-group mb-3">
		<input type="text" class="form-control" name="sv_x_pymerfc" id="sv_x_pymerfc" value="<?php echo RemoveHtml($comprador->pymerfc->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($comprador->pymerfc->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($comprador->pymerfc->getPlaceHolder()) ?>"<?php echo $comprador->pymerfc->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($comprador->pymerfc->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_pymerfc',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo (($comprador->pymerfc->ReadOnly || $comprador->pymerfc->Disabled) ? " disabled" : "")?>><i class="fa fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="comprador" data-field="x_pymerfc" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $comprador->pymerfc->displayValueSeparatorAttribute() ?>" name="x_pymerfc" id="x_pymerfc" value="<?php echo HtmlEncode($comprador->pymerfc->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fcompradoradd.createAutoSuggest({"id":"x_pymerfc","forceSelect":false});
</script>
<?php echo $comprador->pymerfc->Lookup->getParamTag("p_x_pymerfc") ?>
</span>
<?php } else { ?>
<span id="el_comprador_pymerfc">
<span<?php echo $comprador->pymerfc->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($comprador->pymerfc->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="comprador" data-field="x_pymerfc" name="x_pymerfc" id="x_pymerfc" value="<?php echo HtmlEncode($comprador->pymerfc->FormValue) ?>">
<?php } ?>
<?php echo $comprador->pymerfc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$comprador_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $comprador_add->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$comprador->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $comprador_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$comprador_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$comprador_add->terminate();
?>