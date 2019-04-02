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
$fondeador_add = new fondeador_add();

// Run the page
$fondeador_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$fondeador_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var ffondeadoradd = currentForm = new ew.Form("ffondeadoradd", "add");

// Validate form
ffondeadoradd.validate = function() {
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
		<?php if ($fondeador_add->id_fondeador->Required) { ?>
			elm = this.getElements("x" + infix + "_id_fondeador");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fondeador->id_fondeador->caption(), $fondeador->id_fondeador->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_id_fondeador");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($fondeador->id_fondeador->errorMessage()) ?>");
		<?php if ($fondeador_add->rfcfondeador->Required) { ?>
			elm = this.getElements("x" + infix + "_rfcfondeador");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fondeador->rfcfondeador->caption(), $fondeador->rfcfondeador->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($fondeador_add->razon_social->Required) { ?>
			elm = this.getElements("x" + infix + "_razon_social");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fondeador->razon_social->caption(), $fondeador->razon_social->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($fondeador_add->calle->Required) { ?>
			elm = this.getElements("x" + infix + "_calle");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fondeador->calle->caption(), $fondeador->calle->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($fondeador_add->colonia->Required) { ?>
			elm = this.getElements("x" + infix + "_colonia");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fondeador->colonia->caption(), $fondeador->colonia->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_colonia");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($fondeador->colonia->errorMessage()) ?>");
		<?php if ($fondeador_add->ciudad->Required) { ?>
			elm = this.getElements("x" + infix + "_ciudad");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fondeador->ciudad->caption(), $fondeador->ciudad->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($fondeador_add->codpostal->Required) { ?>
			elm = this.getElements("x" + infix + "_codpostal");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fondeador->codpostal->caption(), $fondeador->codpostal->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_codpostal");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($fondeador->codpostal->errorMessage()) ?>");
		<?php if ($fondeador_add->telefono->Required) { ?>
			elm = this.getElements("x" + infix + "_telefono");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fondeador->telefono->caption(), $fondeador->telefono->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($fondeador_add->correo->Required) { ?>
			elm = this.getElements("x" + infix + "_correo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fondeador->correo->caption(), $fondeador->correo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($fondeador_add->pais->Required) { ?>
			elm = this.getElements("x" + infix + "_pais");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fondeador->pais->caption(), $fondeador->pais->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_pais");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($fondeador->pais->errorMessage()) ?>");
		<?php if ($fondeador_add->fondeadorfactura->Required) { ?>
			elm = this.getElements("x" + infix + "_fondeadorfactura");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fondeador->fondeadorfactura->caption(), $fondeador->fondeadorfactura->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_fondeadorfactura");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($fondeador->fondeadorfactura->errorMessage()) ?>");
		<?php if ($fondeador_add->calificacion->Required) { ?>
			elm = this.getElements("x" + infix + "_calificacion");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fondeador->calificacion->caption(), $fondeador->calificacion->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_calificacion");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($fondeador->calificacion->errorMessage()) ?>");
		<?php if ($fondeador_add->cedooperacionfondeador->Required) { ?>
			elm = this.getElements("x" + infix + "_cedooperacionfondeador");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fondeador->cedooperacionfondeador->caption(), $fondeador->cedooperacionfondeador->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_cedooperacionfondeador");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($fondeador->cedooperacionfondeador->errorMessage()) ?>");
		<?php if ($fondeador_add->pymerfc->Required) { ?>
			elm = this.getElements("x" + infix + "_pymerfc");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fondeador->pymerfc->caption(), $fondeador->pymerfc->RequiredErrorMessage)) ?>");
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
ffondeadoradd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ffondeadoradd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $fondeador_add->showPageHeader(); ?>
<?php
$fondeador_add->showMessage();
?>
<form name="ffondeadoradd" id="ffondeadoradd" class="<?php echo $fondeador_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($fondeador_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $fondeador_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="fondeador">
<?php if ($fondeador->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$fondeador_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($fondeador->id_fondeador->Visible) { // id_fondeador ?>
	<div id="r_id_fondeador" class="form-group row">
		<label id="elh_fondeador_id_fondeador" for="x_id_fondeador" class="<?php echo $fondeador_add->LeftColumnClass ?>"><?php echo $fondeador->id_fondeador->caption() ?><?php echo ($fondeador->id_fondeador->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fondeador_add->RightColumnClass ?>"><div<?php echo $fondeador->id_fondeador->cellAttributes() ?>>
<?php if (!$fondeador->isConfirm()) { ?>
<span id="el_fondeador_id_fondeador">
<input type="text" data-table="fondeador" data-field="x_id_fondeador" name="x_id_fondeador" id="x_id_fondeador" size="30" placeholder="<?php echo HtmlEncode($fondeador->id_fondeador->getPlaceHolder()) ?>" value="<?php echo $fondeador->id_fondeador->EditValue ?>"<?php echo $fondeador->id_fondeador->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_fondeador_id_fondeador">
<span<?php echo $fondeador->id_fondeador->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($fondeador->id_fondeador->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="fondeador" data-field="x_id_fondeador" name="x_id_fondeador" id="x_id_fondeador" value="<?php echo HtmlEncode($fondeador->id_fondeador->FormValue) ?>">
<?php } ?>
<?php echo $fondeador->id_fondeador->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fondeador->rfcfondeador->Visible) { // rfcfondeador ?>
	<div id="r_rfcfondeador" class="form-group row">
		<label id="elh_fondeador_rfcfondeador" for="x_rfcfondeador" class="<?php echo $fondeador_add->LeftColumnClass ?>"><?php echo $fondeador->rfcfondeador->caption() ?><?php echo ($fondeador->rfcfondeador->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fondeador_add->RightColumnClass ?>"><div<?php echo $fondeador->rfcfondeador->cellAttributes() ?>>
<?php if (!$fondeador->isConfirm()) { ?>
<span id="el_fondeador_rfcfondeador">
<input type="text" data-table="fondeador" data-field="x_rfcfondeador" name="x_rfcfondeador" id="x_rfcfondeador" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($fondeador->rfcfondeador->getPlaceHolder()) ?>" value="<?php echo $fondeador->rfcfondeador->EditValue ?>"<?php echo $fondeador->rfcfondeador->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_fondeador_rfcfondeador">
<span<?php echo $fondeador->rfcfondeador->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($fondeador->rfcfondeador->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="fondeador" data-field="x_rfcfondeador" name="x_rfcfondeador" id="x_rfcfondeador" value="<?php echo HtmlEncode($fondeador->rfcfondeador->FormValue) ?>">
<?php } ?>
<?php echo $fondeador->rfcfondeador->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fondeador->razon_social->Visible) { // razon_social ?>
	<div id="r_razon_social" class="form-group row">
		<label id="elh_fondeador_razon_social" for="x_razon_social" class="<?php echo $fondeador_add->LeftColumnClass ?>"><?php echo $fondeador->razon_social->caption() ?><?php echo ($fondeador->razon_social->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fondeador_add->RightColumnClass ?>"><div<?php echo $fondeador->razon_social->cellAttributes() ?>>
<?php if (!$fondeador->isConfirm()) { ?>
<span id="el_fondeador_razon_social">
<input type="text" data-table="fondeador" data-field="x_razon_social" name="x_razon_social" id="x_razon_social" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($fondeador->razon_social->getPlaceHolder()) ?>" value="<?php echo $fondeador->razon_social->EditValue ?>"<?php echo $fondeador->razon_social->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_fondeador_razon_social">
<span<?php echo $fondeador->razon_social->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($fondeador->razon_social->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="fondeador" data-field="x_razon_social" name="x_razon_social" id="x_razon_social" value="<?php echo HtmlEncode($fondeador->razon_social->FormValue) ?>">
<?php } ?>
<?php echo $fondeador->razon_social->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fondeador->calle->Visible) { // calle ?>
	<div id="r_calle" class="form-group row">
		<label id="elh_fondeador_calle" for="x_calle" class="<?php echo $fondeador_add->LeftColumnClass ?>"><?php echo $fondeador->calle->caption() ?><?php echo ($fondeador->calle->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fondeador_add->RightColumnClass ?>"><div<?php echo $fondeador->calle->cellAttributes() ?>>
<?php if (!$fondeador->isConfirm()) { ?>
<span id="el_fondeador_calle">
<input type="text" data-table="fondeador" data-field="x_calle" name="x_calle" id="x_calle" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($fondeador->calle->getPlaceHolder()) ?>" value="<?php echo $fondeador->calle->EditValue ?>"<?php echo $fondeador->calle->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_fondeador_calle">
<span<?php echo $fondeador->calle->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($fondeador->calle->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="fondeador" data-field="x_calle" name="x_calle" id="x_calle" value="<?php echo HtmlEncode($fondeador->calle->FormValue) ?>">
<?php } ?>
<?php echo $fondeador->calle->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fondeador->colonia->Visible) { // colonia ?>
	<div id="r_colonia" class="form-group row">
		<label id="elh_fondeador_colonia" for="x_colonia" class="<?php echo $fondeador_add->LeftColumnClass ?>"><?php echo $fondeador->colonia->caption() ?><?php echo ($fondeador->colonia->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fondeador_add->RightColumnClass ?>"><div<?php echo $fondeador->colonia->cellAttributes() ?>>
<?php if (!$fondeador->isConfirm()) { ?>
<span id="el_fondeador_colonia">
<input type="text" data-table="fondeador" data-field="x_colonia" name="x_colonia" id="x_colonia" size="30" placeholder="<?php echo HtmlEncode($fondeador->colonia->getPlaceHolder()) ?>" value="<?php echo $fondeador->colonia->EditValue ?>"<?php echo $fondeador->colonia->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_fondeador_colonia">
<span<?php echo $fondeador->colonia->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($fondeador->colonia->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="fondeador" data-field="x_colonia" name="x_colonia" id="x_colonia" value="<?php echo HtmlEncode($fondeador->colonia->FormValue) ?>">
<?php } ?>
<?php echo $fondeador->colonia->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fondeador->ciudad->Visible) { // ciudad ?>
	<div id="r_ciudad" class="form-group row">
		<label id="elh_fondeador_ciudad" for="x_ciudad" class="<?php echo $fondeador_add->LeftColumnClass ?>"><?php echo $fondeador->ciudad->caption() ?><?php echo ($fondeador->ciudad->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fondeador_add->RightColumnClass ?>"><div<?php echo $fondeador->ciudad->cellAttributes() ?>>
<?php if (!$fondeador->isConfirm()) { ?>
<span id="el_fondeador_ciudad">
<input type="text" data-table="fondeador" data-field="x_ciudad" name="x_ciudad" id="x_ciudad" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($fondeador->ciudad->getPlaceHolder()) ?>" value="<?php echo $fondeador->ciudad->EditValue ?>"<?php echo $fondeador->ciudad->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_fondeador_ciudad">
<span<?php echo $fondeador->ciudad->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($fondeador->ciudad->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="fondeador" data-field="x_ciudad" name="x_ciudad" id="x_ciudad" value="<?php echo HtmlEncode($fondeador->ciudad->FormValue) ?>">
<?php } ?>
<?php echo $fondeador->ciudad->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fondeador->codpostal->Visible) { // codpostal ?>
	<div id="r_codpostal" class="form-group row">
		<label id="elh_fondeador_codpostal" for="x_codpostal" class="<?php echo $fondeador_add->LeftColumnClass ?>"><?php echo $fondeador->codpostal->caption() ?><?php echo ($fondeador->codpostal->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fondeador_add->RightColumnClass ?>"><div<?php echo $fondeador->codpostal->cellAttributes() ?>>
<?php if (!$fondeador->isConfirm()) { ?>
<span id="el_fondeador_codpostal">
<input type="text" data-table="fondeador" data-field="x_codpostal" name="x_codpostal" id="x_codpostal" size="30" placeholder="<?php echo HtmlEncode($fondeador->codpostal->getPlaceHolder()) ?>" value="<?php echo $fondeador->codpostal->EditValue ?>"<?php echo $fondeador->codpostal->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_fondeador_codpostal">
<span<?php echo $fondeador->codpostal->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($fondeador->codpostal->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="fondeador" data-field="x_codpostal" name="x_codpostal" id="x_codpostal" value="<?php echo HtmlEncode($fondeador->codpostal->FormValue) ?>">
<?php } ?>
<?php echo $fondeador->codpostal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fondeador->telefono->Visible) { // telefono ?>
	<div id="r_telefono" class="form-group row">
		<label id="elh_fondeador_telefono" for="x_telefono" class="<?php echo $fondeador_add->LeftColumnClass ?>"><?php echo $fondeador->telefono->caption() ?><?php echo ($fondeador->telefono->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fondeador_add->RightColumnClass ?>"><div<?php echo $fondeador->telefono->cellAttributes() ?>>
<?php if (!$fondeador->isConfirm()) { ?>
<span id="el_fondeador_telefono">
<input type="text" data-table="fondeador" data-field="x_telefono" name="x_telefono" id="x_telefono" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($fondeador->telefono->getPlaceHolder()) ?>" value="<?php echo $fondeador->telefono->EditValue ?>"<?php echo $fondeador->telefono->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_fondeador_telefono">
<span<?php echo $fondeador->telefono->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($fondeador->telefono->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="fondeador" data-field="x_telefono" name="x_telefono" id="x_telefono" value="<?php echo HtmlEncode($fondeador->telefono->FormValue) ?>">
<?php } ?>
<?php echo $fondeador->telefono->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fondeador->correo->Visible) { // correo ?>
	<div id="r_correo" class="form-group row">
		<label id="elh_fondeador_correo" for="x_correo" class="<?php echo $fondeador_add->LeftColumnClass ?>"><?php echo $fondeador->correo->caption() ?><?php echo ($fondeador->correo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fondeador_add->RightColumnClass ?>"><div<?php echo $fondeador->correo->cellAttributes() ?>>
<?php if (!$fondeador->isConfirm()) { ?>
<span id="el_fondeador_correo">
<input type="text" data-table="fondeador" data-field="x_correo" name="x_correo" id="x_correo" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($fondeador->correo->getPlaceHolder()) ?>" value="<?php echo $fondeador->correo->EditValue ?>"<?php echo $fondeador->correo->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_fondeador_correo">
<span<?php echo $fondeador->correo->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($fondeador->correo->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="fondeador" data-field="x_correo" name="x_correo" id="x_correo" value="<?php echo HtmlEncode($fondeador->correo->FormValue) ?>">
<?php } ?>
<?php echo $fondeador->correo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fondeador->pais->Visible) { // pais ?>
	<div id="r_pais" class="form-group row">
		<label id="elh_fondeador_pais" for="x_pais" class="<?php echo $fondeador_add->LeftColumnClass ?>"><?php echo $fondeador->pais->caption() ?><?php echo ($fondeador->pais->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fondeador_add->RightColumnClass ?>"><div<?php echo $fondeador->pais->cellAttributes() ?>>
<?php if (!$fondeador->isConfirm()) { ?>
<span id="el_fondeador_pais">
<input type="text" data-table="fondeador" data-field="x_pais" name="x_pais" id="x_pais" size="30" placeholder="<?php echo HtmlEncode($fondeador->pais->getPlaceHolder()) ?>" value="<?php echo $fondeador->pais->EditValue ?>"<?php echo $fondeador->pais->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_fondeador_pais">
<span<?php echo $fondeador->pais->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($fondeador->pais->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="fondeador" data-field="x_pais" name="x_pais" id="x_pais" value="<?php echo HtmlEncode($fondeador->pais->FormValue) ?>">
<?php } ?>
<?php echo $fondeador->pais->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fondeador->fondeadorfactura->Visible) { // fondeadorfactura ?>
	<div id="r_fondeadorfactura" class="form-group row">
		<label id="elh_fondeador_fondeadorfactura" for="x_fondeadorfactura" class="<?php echo $fondeador_add->LeftColumnClass ?>"><?php echo $fondeador->fondeadorfactura->caption() ?><?php echo ($fondeador->fondeadorfactura->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fondeador_add->RightColumnClass ?>"><div<?php echo $fondeador->fondeadorfactura->cellAttributes() ?>>
<?php if (!$fondeador->isConfirm()) { ?>
<span id="el_fondeador_fondeadorfactura">
<input type="text" data-table="fondeador" data-field="x_fondeadorfactura" name="x_fondeadorfactura" id="x_fondeadorfactura" size="30" placeholder="<?php echo HtmlEncode($fondeador->fondeadorfactura->getPlaceHolder()) ?>" value="<?php echo $fondeador->fondeadorfactura->EditValue ?>"<?php echo $fondeador->fondeadorfactura->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_fondeador_fondeadorfactura">
<span<?php echo $fondeador->fondeadorfactura->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($fondeador->fondeadorfactura->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="fondeador" data-field="x_fondeadorfactura" name="x_fondeadorfactura" id="x_fondeadorfactura" value="<?php echo HtmlEncode($fondeador->fondeadorfactura->FormValue) ?>">
<?php } ?>
<?php echo $fondeador->fondeadorfactura->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fondeador->calificacion->Visible) { // calificacion ?>
	<div id="r_calificacion" class="form-group row">
		<label id="elh_fondeador_calificacion" for="x_calificacion" class="<?php echo $fondeador_add->LeftColumnClass ?>"><?php echo $fondeador->calificacion->caption() ?><?php echo ($fondeador->calificacion->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fondeador_add->RightColumnClass ?>"><div<?php echo $fondeador->calificacion->cellAttributes() ?>>
<?php if (!$fondeador->isConfirm()) { ?>
<span id="el_fondeador_calificacion">
<input type="text" data-table="fondeador" data-field="x_calificacion" name="x_calificacion" id="x_calificacion" size="30" placeholder="<?php echo HtmlEncode($fondeador->calificacion->getPlaceHolder()) ?>" value="<?php echo $fondeador->calificacion->EditValue ?>"<?php echo $fondeador->calificacion->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_fondeador_calificacion">
<span<?php echo $fondeador->calificacion->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($fondeador->calificacion->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="fondeador" data-field="x_calificacion" name="x_calificacion" id="x_calificacion" value="<?php echo HtmlEncode($fondeador->calificacion->FormValue) ?>">
<?php } ?>
<?php echo $fondeador->calificacion->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fondeador->cedooperacionfondeador->Visible) { // cedooperacionfondeador ?>
	<div id="r_cedooperacionfondeador" class="form-group row">
		<label id="elh_fondeador_cedooperacionfondeador" for="x_cedooperacionfondeador" class="<?php echo $fondeador_add->LeftColumnClass ?>"><?php echo $fondeador->cedooperacionfondeador->caption() ?><?php echo ($fondeador->cedooperacionfondeador->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fondeador_add->RightColumnClass ?>"><div<?php echo $fondeador->cedooperacionfondeador->cellAttributes() ?>>
<?php if (!$fondeador->isConfirm()) { ?>
<span id="el_fondeador_cedooperacionfondeador">
<input type="text" data-table="fondeador" data-field="x_cedooperacionfondeador" name="x_cedooperacionfondeador" id="x_cedooperacionfondeador" size="30" placeholder="<?php echo HtmlEncode($fondeador->cedooperacionfondeador->getPlaceHolder()) ?>" value="<?php echo $fondeador->cedooperacionfondeador->EditValue ?>"<?php echo $fondeador->cedooperacionfondeador->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_fondeador_cedooperacionfondeador">
<span<?php echo $fondeador->cedooperacionfondeador->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($fondeador->cedooperacionfondeador->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="fondeador" data-field="x_cedooperacionfondeador" name="x_cedooperacionfondeador" id="x_cedooperacionfondeador" value="<?php echo HtmlEncode($fondeador->cedooperacionfondeador->FormValue) ?>">
<?php } ?>
<?php echo $fondeador->cedooperacionfondeador->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fondeador->pymerfc->Visible) { // pymerfc ?>
	<div id="r_pymerfc" class="form-group row">
		<label id="elh_fondeador_pymerfc" for="x_pymerfc" class="<?php echo $fondeador_add->LeftColumnClass ?>"><?php echo $fondeador->pymerfc->caption() ?><?php echo ($fondeador->pymerfc->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fondeador_add->RightColumnClass ?>"><div<?php echo $fondeador->pymerfc->cellAttributes() ?>>
<?php if (!$fondeador->isConfirm()) { ?>
<span id="el_fondeador_pymerfc">
<input type="text" data-table="fondeador" data-field="x_pymerfc" name="x_pymerfc" id="x_pymerfc" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($fondeador->pymerfc->getPlaceHolder()) ?>" value="<?php echo $fondeador->pymerfc->EditValue ?>"<?php echo $fondeador->pymerfc->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_fondeador_pymerfc">
<span<?php echo $fondeador->pymerfc->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($fondeador->pymerfc->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="fondeador" data-field="x_pymerfc" name="x_pymerfc" id="x_pymerfc" value="<?php echo HtmlEncode($fondeador->pymerfc->FormValue) ?>">
<?php } ?>
<?php echo $fondeador->pymerfc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$fondeador_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $fondeador_add->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$fondeador->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $fondeador_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$fondeador_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$fondeador_add->terminate();
?>