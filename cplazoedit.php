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
$cplazo_edit = new cplazo_edit();

// Run the page
$cplazo_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cplazo_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fcplazoedit = currentForm = new ew.Form("fcplazoedit", "edit");

// Validate form
fcplazoedit.validate = function() {
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
		<?php if ($cplazo_edit->id_plazo->Required) { ?>
			elm = this.getElements("x" + infix + "_id_plazo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cplazo->id_plazo->caption(), $cplazo->id_plazo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($cplazo_edit->Tipo_Plazo->Required) { ?>
			elm = this.getElements("x" + infix + "_Tipo_Plazo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cplazo->Tipo_Plazo->caption(), $cplazo->Tipo_Plazo->RequiredErrorMessage)) ?>");
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
fcplazoedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcplazoedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $cplazo_edit->showPageHeader(); ?>
<?php
$cplazo_edit->showMessage();
?>
<form name="fcplazoedit" id="fcplazoedit" class="<?php echo $cplazo_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($cplazo_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $cplazo_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cplazo">
<input type="hidden" name="k_hash" id="k_hash" value="<?php echo $cplazo_edit->HashValue ?>">
<?php if ($cplazo->UpdateConflict == "U") { // Record already updated by other user ?>
<input type="hidden" name="conflict" id="conflict" value="1">
<?php } ?>
<?php if ($cplazo->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$cplazo_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($cplazo->id_plazo->Visible) { // id_plazo ?>
	<div id="r_id_plazo" class="form-group row">
		<label id="elh_cplazo_id_plazo" class="<?php echo $cplazo_edit->LeftColumnClass ?>"><?php echo $cplazo->id_plazo->caption() ?><?php echo ($cplazo->id_plazo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cplazo_edit->RightColumnClass ?>"><div<?php echo $cplazo->id_plazo->cellAttributes() ?>>
<?php if (!$cplazo->isConfirm()) { ?>
<span id="el_cplazo_id_plazo">
<span<?php echo $cplazo->id_plazo->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($cplazo->id_plazo->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="cplazo" data-field="x_id_plazo" name="x_id_plazo" id="x_id_plazo" value="<?php echo HtmlEncode($cplazo->id_plazo->CurrentValue) ?>">
<?php } else { ?>
<span id="el_cplazo_id_plazo">
<span<?php echo $cplazo->id_plazo->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($cplazo->id_plazo->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="cplazo" data-field="x_id_plazo" name="x_id_plazo" id="x_id_plazo" value="<?php echo HtmlEncode($cplazo->id_plazo->FormValue) ?>">
<?php } ?>
<?php echo $cplazo->id_plazo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cplazo->Tipo_Plazo->Visible) { // Tipo Plazo ?>
	<div id="r_Tipo_Plazo" class="form-group row">
		<label id="elh_cplazo_Tipo_Plazo" for="x_Tipo_Plazo" class="<?php echo $cplazo_edit->LeftColumnClass ?>"><?php echo $cplazo->Tipo_Plazo->caption() ?><?php echo ($cplazo->Tipo_Plazo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cplazo_edit->RightColumnClass ?>"><div<?php echo $cplazo->Tipo_Plazo->cellAttributes() ?>>
<?php if (!$cplazo->isConfirm()) { ?>
<span id="el_cplazo_Tipo_Plazo">
<input type="text" data-table="cplazo" data-field="x_Tipo_Plazo" name="x_Tipo_Plazo" id="x_Tipo_Plazo" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($cplazo->Tipo_Plazo->getPlaceHolder()) ?>" value="<?php echo $cplazo->Tipo_Plazo->EditValue ?>"<?php echo $cplazo->Tipo_Plazo->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_cplazo_Tipo_Plazo">
<span<?php echo $cplazo->Tipo_Plazo->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($cplazo->Tipo_Plazo->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="cplazo" data-field="x_Tipo_Plazo" name="x_Tipo_Plazo" id="x_Tipo_Plazo" value="<?php echo HtmlEncode($cplazo->Tipo_Plazo->FormValue) ?>">
<?php } ?>
<?php echo $cplazo->Tipo_Plazo->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$cplazo_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $cplazo_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if ($cplazo->UpdateConflict == "U") { // Record already updated by other user ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='overwrite';"><?php echo $Language->phrase("OverwriteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-reload" id="btn-reload" type="submit" onclick="this.form.action.value='show';"><?php echo $Language->phrase("ReloadBtn") ?></button>
<?php } else { ?>
<?php if (!$cplazo->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $cplazo_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
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
$cplazo_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cplazo_edit->terminate();
?>