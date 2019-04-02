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
$parametros_edit = new parametros_edit();

// Run the page
$parametros_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$parametros_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fparametrosedit = currentForm = new ew.Form("fparametrosedit", "edit");

// Validate form
fparametrosedit.validate = function() {
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
		<?php if ($parametros_edit->id_parametro->Required) { ?>
			elm = this.getElements("x" + infix + "_id_parametro");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $parametros->id_parametro->caption(), $parametros->id_parametro->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($parametros_edit->diascalculo->Required) { ?>
			elm = this.getElements("x" + infix + "_diascalculo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $parametros->diascalculo->caption(), $parametros->diascalculo->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_diascalculo");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($parametros->diascalculo->errorMessage()) ?>");
		<?php if ($parametros_edit->modulo->Required) { ?>
			elm = this.getElements("x" + infix + "_modulo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $parametros->modulo->caption(), $parametros->modulo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($parametros_edit->unidadmedida->Required) { ?>
			elm = this.getElements("x" + infix + "_unidadmedida");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $parametros->unidadmedida->caption(), $parametros->unidadmedida->RequiredErrorMessage)) ?>");
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
fparametrosedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fparametrosedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $parametros_edit->showPageHeader(); ?>
<?php
$parametros_edit->showMessage();
?>
<form name="fparametrosedit" id="fparametrosedit" class="<?php echo $parametros_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($parametros_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $parametros_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="parametros">
<input type="hidden" name="k_hash" id="k_hash" value="<?php echo $parametros_edit->HashValue ?>">
<?php if ($parametros->UpdateConflict == "U") { // Record already updated by other user ?>
<input type="hidden" name="conflict" id="conflict" value="1">
<?php } ?>
<?php if ($parametros->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$parametros_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($parametros->id_parametro->Visible) { // id_parametro ?>
	<div id="r_id_parametro" class="form-group row">
		<label id="elh_parametros_id_parametro" class="<?php echo $parametros_edit->LeftColumnClass ?>"><?php echo $parametros->id_parametro->caption() ?><?php echo ($parametros->id_parametro->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $parametros_edit->RightColumnClass ?>"><div<?php echo $parametros->id_parametro->cellAttributes() ?>>
<?php if (!$parametros->isConfirm()) { ?>
<span id="el_parametros_id_parametro">
<span<?php echo $parametros->id_parametro->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($parametros->id_parametro->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="parametros" data-field="x_id_parametro" name="x_id_parametro" id="x_id_parametro" value="<?php echo HtmlEncode($parametros->id_parametro->CurrentValue) ?>">
<?php } else { ?>
<span id="el_parametros_id_parametro">
<span<?php echo $parametros->id_parametro->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($parametros->id_parametro->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="parametros" data-field="x_id_parametro" name="x_id_parametro" id="x_id_parametro" value="<?php echo HtmlEncode($parametros->id_parametro->FormValue) ?>">
<?php } ?>
<?php echo $parametros->id_parametro->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($parametros->diascalculo->Visible) { // diascalculo ?>
	<div id="r_diascalculo" class="form-group row">
		<label id="elh_parametros_diascalculo" for="x_diascalculo" class="<?php echo $parametros_edit->LeftColumnClass ?>"><?php echo $parametros->diascalculo->caption() ?><?php echo ($parametros->diascalculo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $parametros_edit->RightColumnClass ?>"><div<?php echo $parametros->diascalculo->cellAttributes() ?>>
<?php if (!$parametros->isConfirm()) { ?>
<span id="el_parametros_diascalculo">
<input type="text" data-table="parametros" data-field="x_diascalculo" name="x_diascalculo" id="x_diascalculo" size="30" placeholder="<?php echo HtmlEncode($parametros->diascalculo->getPlaceHolder()) ?>" value="<?php echo $parametros->diascalculo->EditValue ?>"<?php echo $parametros->diascalculo->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_parametros_diascalculo">
<span<?php echo $parametros->diascalculo->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($parametros->diascalculo->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="parametros" data-field="x_diascalculo" name="x_diascalculo" id="x_diascalculo" value="<?php echo HtmlEncode($parametros->diascalculo->FormValue) ?>">
<?php } ?>
<?php echo $parametros->diascalculo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($parametros->modulo->Visible) { // modulo ?>
	<div id="r_modulo" class="form-group row">
		<label id="elh_parametros_modulo" for="x_modulo" class="<?php echo $parametros_edit->LeftColumnClass ?>"><?php echo $parametros->modulo->caption() ?><?php echo ($parametros->modulo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $parametros_edit->RightColumnClass ?>"><div<?php echo $parametros->modulo->cellAttributes() ?>>
<?php if (!$parametros->isConfirm()) { ?>
<span id="el_parametros_modulo">
<input type="text" data-table="parametros" data-field="x_modulo" name="x_modulo" id="x_modulo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($parametros->modulo->getPlaceHolder()) ?>" value="<?php echo $parametros->modulo->EditValue ?>"<?php echo $parametros->modulo->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_parametros_modulo">
<span<?php echo $parametros->modulo->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($parametros->modulo->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="parametros" data-field="x_modulo" name="x_modulo" id="x_modulo" value="<?php echo HtmlEncode($parametros->modulo->FormValue) ?>">
<?php } ?>
<?php echo $parametros->modulo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($parametros->unidadmedida->Visible) { // unidadmedida ?>
	<div id="r_unidadmedida" class="form-group row">
		<label id="elh_parametros_unidadmedida" for="x_unidadmedida" class="<?php echo $parametros_edit->LeftColumnClass ?>"><?php echo $parametros->unidadmedida->caption() ?><?php echo ($parametros->unidadmedida->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $parametros_edit->RightColumnClass ?>"><div<?php echo $parametros->unidadmedida->cellAttributes() ?>>
<?php if (!$parametros->isConfirm()) { ?>
<span id="el_parametros_unidadmedida">
<input type="text" data-table="parametros" data-field="x_unidadmedida" name="x_unidadmedida" id="x_unidadmedida" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($parametros->unidadmedida->getPlaceHolder()) ?>" value="<?php echo $parametros->unidadmedida->EditValue ?>"<?php echo $parametros->unidadmedida->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_parametros_unidadmedida">
<span<?php echo $parametros->unidadmedida->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($parametros->unidadmedida->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="parametros" data-field="x_unidadmedida" name="x_unidadmedida" id="x_unidadmedida" value="<?php echo HtmlEncode($parametros->unidadmedida->FormValue) ?>">
<?php } ?>
<?php echo $parametros->unidadmedida->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$parametros_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $parametros_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if ($parametros->UpdateConflict == "U") { // Record already updated by other user ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='overwrite';"><?php echo $Language->phrase("OverwriteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-reload" id="btn-reload" type="submit" onclick="this.form.action.value='show';"><?php echo $Language->phrase("ReloadBtn") ?></button>
<?php } else { ?>
<?php if (!$parametros->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $parametros_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
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
$parametros_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$parametros_edit->terminate();
?>