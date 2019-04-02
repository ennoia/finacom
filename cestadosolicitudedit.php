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
$cestadosolicitud_edit = new cestadosolicitud_edit();

// Run the page
$cestadosolicitud_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cestadosolicitud_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fcestadosolicitudedit = currentForm = new ew.Form("fcestadosolicitudedit", "edit");

// Validate form
fcestadosolicitudedit.validate = function() {
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
		<?php if ($cestadosolicitud_edit->id_edosolicitud->Required) { ?>
			elm = this.getElements("x" + infix + "_id_edosolicitud");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cestadosolicitud->id_edosolicitud->caption(), $cestadosolicitud->id_edosolicitud->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_id_edosolicitud");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($cestadosolicitud->id_edosolicitud->errorMessage()) ?>");
		<?php if ($cestadosolicitud_edit->descestadooperacion->Required) { ?>
			elm = this.getElements("x" + infix + "_descestadooperacion");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cestadosolicitud->descestadooperacion->caption(), $cestadosolicitud->descestadooperacion->RequiredErrorMessage)) ?>");
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
fcestadosolicitudedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcestadosolicitudedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $cestadosolicitud_edit->showPageHeader(); ?>
<?php
$cestadosolicitud_edit->showMessage();
?>
<form name="fcestadosolicitudedit" id="fcestadosolicitudedit" class="<?php echo $cestadosolicitud_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($cestadosolicitud_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $cestadosolicitud_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cestadosolicitud">
<input type="hidden" name="k_hash" id="k_hash" value="<?php echo $cestadosolicitud_edit->HashValue ?>">
<?php if ($cestadosolicitud->UpdateConflict == "U") { // Record already updated by other user ?>
<input type="hidden" name="conflict" id="conflict" value="1">
<?php } ?>
<?php if ($cestadosolicitud->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$cestadosolicitud_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($cestadosolicitud->id_edosolicitud->Visible) { // id_edosolicitud ?>
	<div id="r_id_edosolicitud" class="form-group row">
		<label id="elh_cestadosolicitud_id_edosolicitud" for="x_id_edosolicitud" class="<?php echo $cestadosolicitud_edit->LeftColumnClass ?>"><?php echo $cestadosolicitud->id_edosolicitud->caption() ?><?php echo ($cestadosolicitud->id_edosolicitud->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cestadosolicitud_edit->RightColumnClass ?>"><div<?php echo $cestadosolicitud->id_edosolicitud->cellAttributes() ?>>
<?php if (!$cestadosolicitud->isConfirm()) { ?>
<span id="el_cestadosolicitud_id_edosolicitud">
<span<?php echo $cestadosolicitud->id_edosolicitud->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($cestadosolicitud->id_edosolicitud->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="cestadosolicitud" data-field="x_id_edosolicitud" name="x_id_edosolicitud" id="x_id_edosolicitud" value="<?php echo HtmlEncode($cestadosolicitud->id_edosolicitud->CurrentValue) ?>">
<?php } else { ?>
<span id="el_cestadosolicitud_id_edosolicitud">
<span<?php echo $cestadosolicitud->id_edosolicitud->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($cestadosolicitud->id_edosolicitud->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="cestadosolicitud" data-field="x_id_edosolicitud" name="x_id_edosolicitud" id="x_id_edosolicitud" value="<?php echo HtmlEncode($cestadosolicitud->id_edosolicitud->FormValue) ?>">
<?php } ?>
<?php echo $cestadosolicitud->id_edosolicitud->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cestadosolicitud->descestadooperacion->Visible) { // descestadooperacion ?>
	<div id="r_descestadooperacion" class="form-group row">
		<label id="elh_cestadosolicitud_descestadooperacion" for="x_descestadooperacion" class="<?php echo $cestadosolicitud_edit->LeftColumnClass ?>"><?php echo $cestadosolicitud->descestadooperacion->caption() ?><?php echo ($cestadosolicitud->descestadooperacion->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cestadosolicitud_edit->RightColumnClass ?>"><div<?php echo $cestadosolicitud->descestadooperacion->cellAttributes() ?>>
<?php if (!$cestadosolicitud->isConfirm()) { ?>
<span id="el_cestadosolicitud_descestadooperacion">
<input type="text" data-table="cestadosolicitud" data-field="x_descestadooperacion" name="x_descestadooperacion" id="x_descestadooperacion" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($cestadosolicitud->descestadooperacion->getPlaceHolder()) ?>" value="<?php echo $cestadosolicitud->descestadooperacion->EditValue ?>"<?php echo $cestadosolicitud->descestadooperacion->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_cestadosolicitud_descestadooperacion">
<span<?php echo $cestadosolicitud->descestadooperacion->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($cestadosolicitud->descestadooperacion->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="cestadosolicitud" data-field="x_descestadooperacion" name="x_descestadooperacion" id="x_descestadooperacion" value="<?php echo HtmlEncode($cestadosolicitud->descestadooperacion->FormValue) ?>">
<?php } ?>
<?php echo $cestadosolicitud->descestadooperacion->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$cestadosolicitud_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $cestadosolicitud_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if ($cestadosolicitud->UpdateConflict == "U") { // Record already updated by other user ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='overwrite';"><?php echo $Language->phrase("OverwriteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-reload" id="btn-reload" type="submit" onclick="this.form.action.value='show';"><?php echo $Language->phrase("ReloadBtn") ?></button>
<?php } else { ?>
<?php if (!$cestadosolicitud->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $cestadosolicitud_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
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
$cestadosolicitud_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cestadosolicitud_edit->terminate();
?>