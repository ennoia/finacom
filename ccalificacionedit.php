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
$ccalificacion_edit = new ccalificacion_edit();

// Run the page
$ccalificacion_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ccalificacion_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fccalificacionedit = currentForm = new ew.Form("fccalificacionedit", "edit");

// Validate form
fccalificacionedit.validate = function() {
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
		<?php if ($ccalificacion_edit->idcalificacion->Required) { ?>
			elm = this.getElements("x" + infix + "_idcalificacion");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ccalificacion->idcalificacion->caption(), $ccalificacion->idcalificacion->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($ccalificacion_edit->descripcion->Required) { ?>
			elm = this.getElements("x" + infix + "_descripcion");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ccalificacion->descripcion->caption(), $ccalificacion->descripcion->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($ccalificacion_edit->fondeadorrfc->Required) { ?>
			elm = this.getElements("x" + infix + "_fondeadorrfc");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ccalificacion->fondeadorrfc->caption(), $ccalificacion->fondeadorrfc->RequiredErrorMessage)) ?>");
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
fccalificacionedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fccalificacionedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $ccalificacion_edit->showPageHeader(); ?>
<?php
$ccalificacion_edit->showMessage();
?>
<form name="fccalificacionedit" id="fccalificacionedit" class="<?php echo $ccalificacion_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($ccalificacion_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $ccalificacion_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ccalificacion">
<input type="hidden" name="k_hash" id="k_hash" value="<?php echo $ccalificacion_edit->HashValue ?>">
<?php if ($ccalificacion->UpdateConflict == "U") { // Record already updated by other user ?>
<input type="hidden" name="conflict" id="conflict" value="1">
<?php } ?>
<?php if ($ccalificacion->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$ccalificacion_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($ccalificacion->idcalificacion->Visible) { // idcalificacion ?>
	<div id="r_idcalificacion" class="form-group row">
		<label id="elh_ccalificacion_idcalificacion" class="<?php echo $ccalificacion_edit->LeftColumnClass ?>"><?php echo $ccalificacion->idcalificacion->caption() ?><?php echo ($ccalificacion->idcalificacion->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ccalificacion_edit->RightColumnClass ?>"><div<?php echo $ccalificacion->idcalificacion->cellAttributes() ?>>
<?php if (!$ccalificacion->isConfirm()) { ?>
<span id="el_ccalificacion_idcalificacion">
<span<?php echo $ccalificacion->idcalificacion->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($ccalificacion->idcalificacion->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="ccalificacion" data-field="x_idcalificacion" name="x_idcalificacion" id="x_idcalificacion" value="<?php echo HtmlEncode($ccalificacion->idcalificacion->CurrentValue) ?>">
<?php } else { ?>
<span id="el_ccalificacion_idcalificacion">
<span<?php echo $ccalificacion->idcalificacion->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($ccalificacion->idcalificacion->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="ccalificacion" data-field="x_idcalificacion" name="x_idcalificacion" id="x_idcalificacion" value="<?php echo HtmlEncode($ccalificacion->idcalificacion->FormValue) ?>">
<?php } ?>
<?php echo $ccalificacion->idcalificacion->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ccalificacion->descripcion->Visible) { // descripcion ?>
	<div id="r_descripcion" class="form-group row">
		<label id="elh_ccalificacion_descripcion" for="x_descripcion" class="<?php echo $ccalificacion_edit->LeftColumnClass ?>"><?php echo $ccalificacion->descripcion->caption() ?><?php echo ($ccalificacion->descripcion->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ccalificacion_edit->RightColumnClass ?>"><div<?php echo $ccalificacion->descripcion->cellAttributes() ?>>
<?php if (!$ccalificacion->isConfirm()) { ?>
<span id="el_ccalificacion_descripcion">
<input type="text" data-table="ccalificacion" data-field="x_descripcion" name="x_descripcion" id="x_descripcion" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($ccalificacion->descripcion->getPlaceHolder()) ?>" value="<?php echo $ccalificacion->descripcion->EditValue ?>"<?php echo $ccalificacion->descripcion->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_ccalificacion_descripcion">
<span<?php echo $ccalificacion->descripcion->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($ccalificacion->descripcion->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="ccalificacion" data-field="x_descripcion" name="x_descripcion" id="x_descripcion" value="<?php echo HtmlEncode($ccalificacion->descripcion->FormValue) ?>">
<?php } ?>
<?php echo $ccalificacion->descripcion->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ccalificacion->fondeadorrfc->Visible) { // fondeadorrfc ?>
	<div id="r_fondeadorrfc" class="form-group row">
		<label id="elh_ccalificacion_fondeadorrfc" for="x_fondeadorrfc" class="<?php echo $ccalificacion_edit->LeftColumnClass ?>"><?php echo $ccalificacion->fondeadorrfc->caption() ?><?php echo ($ccalificacion->fondeadorrfc->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ccalificacion_edit->RightColumnClass ?>"><div<?php echo $ccalificacion->fondeadorrfc->cellAttributes() ?>>
<?php if (!$ccalificacion->isConfirm()) { ?>
<span id="el_ccalificacion_fondeadorrfc">
<input type="text" data-table="ccalificacion" data-field="x_fondeadorrfc" name="x_fondeadorrfc" id="x_fondeadorrfc" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($ccalificacion->fondeadorrfc->getPlaceHolder()) ?>" value="<?php echo $ccalificacion->fondeadorrfc->EditValue ?>"<?php echo $ccalificacion->fondeadorrfc->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_ccalificacion_fondeadorrfc">
<span<?php echo $ccalificacion->fondeadorrfc->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($ccalificacion->fondeadorrfc->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="ccalificacion" data-field="x_fondeadorrfc" name="x_fondeadorrfc" id="x_fondeadorrfc" value="<?php echo HtmlEncode($ccalificacion->fondeadorrfc->FormValue) ?>">
<?php } ?>
<?php echo $ccalificacion->fondeadorrfc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$ccalificacion_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ccalificacion_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if ($ccalificacion->UpdateConflict == "U") { // Record already updated by other user ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='overwrite';"><?php echo $Language->phrase("OverwriteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-reload" id="btn-reload" type="submit" onclick="this.form.action.value='show';"><?php echo $Language->phrase("ReloadBtn") ?></button>
<?php } else { ?>
<?php if (!$ccalificacion->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ccalificacion_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
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
$ccalificacion_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$ccalificacion_edit->terminate();
?>