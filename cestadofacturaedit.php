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
$cestadofactura_edit = new cestadofactura_edit();

// Run the page
$cestadofactura_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cestadofactura_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fcestadofacturaedit = currentForm = new ew.Form("fcestadofacturaedit", "edit");

// Validate form
fcestadofacturaedit.validate = function() {
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
		<?php if ($cestadofactura_edit->id_edofactura->Required) { ?>
			elm = this.getElements("x" + infix + "_id_edofactura");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cestadofactura->id_edofactura->caption(), $cestadofactura->id_edofactura->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($cestadofactura_edit->descedofactura->Required) { ?>
			elm = this.getElements("x" + infix + "_descedofactura");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cestadofactura->descedofactura->caption(), $cestadofactura->descedofactura->RequiredErrorMessage)) ?>");
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
fcestadofacturaedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcestadofacturaedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $cestadofactura_edit->showPageHeader(); ?>
<?php
$cestadofactura_edit->showMessage();
?>
<form name="fcestadofacturaedit" id="fcestadofacturaedit" class="<?php echo $cestadofactura_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($cestadofactura_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $cestadofactura_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cestadofactura">
<input type="hidden" name="k_hash" id="k_hash" value="<?php echo $cestadofactura_edit->HashValue ?>">
<?php if ($cestadofactura->UpdateConflict == "U") { // Record already updated by other user ?>
<input type="hidden" name="conflict" id="conflict" value="1">
<?php } ?>
<?php if ($cestadofactura->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$cestadofactura_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($cestadofactura->id_edofactura->Visible) { // id_edofactura ?>
	<div id="r_id_edofactura" class="form-group row">
		<label id="elh_cestadofactura_id_edofactura" class="<?php echo $cestadofactura_edit->LeftColumnClass ?>"><?php echo $cestadofactura->id_edofactura->caption() ?><?php echo ($cestadofactura->id_edofactura->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cestadofactura_edit->RightColumnClass ?>"><div<?php echo $cestadofactura->id_edofactura->cellAttributes() ?>>
<?php if (!$cestadofactura->isConfirm()) { ?>
<span id="el_cestadofactura_id_edofactura">
<span<?php echo $cestadofactura->id_edofactura->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($cestadofactura->id_edofactura->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="cestadofactura" data-field="x_id_edofactura" name="x_id_edofactura" id="x_id_edofactura" value="<?php echo HtmlEncode($cestadofactura->id_edofactura->CurrentValue) ?>">
<?php } else { ?>
<span id="el_cestadofactura_id_edofactura">
<span<?php echo $cestadofactura->id_edofactura->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($cestadofactura->id_edofactura->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="cestadofactura" data-field="x_id_edofactura" name="x_id_edofactura" id="x_id_edofactura" value="<?php echo HtmlEncode($cestadofactura->id_edofactura->FormValue) ?>">
<?php } ?>
<?php echo $cestadofactura->id_edofactura->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cestadofactura->descedofactura->Visible) { // descedofactura ?>
	<div id="r_descedofactura" class="form-group row">
		<label id="elh_cestadofactura_descedofactura" for="x_descedofactura" class="<?php echo $cestadofactura_edit->LeftColumnClass ?>"><?php echo $cestadofactura->descedofactura->caption() ?><?php echo ($cestadofactura->descedofactura->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cestadofactura_edit->RightColumnClass ?>"><div<?php echo $cestadofactura->descedofactura->cellAttributes() ?>>
<?php if (!$cestadofactura->isConfirm()) { ?>
<span id="el_cestadofactura_descedofactura">
<input type="text" data-table="cestadofactura" data-field="x_descedofactura" name="x_descedofactura" id="x_descedofactura" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($cestadofactura->descedofactura->getPlaceHolder()) ?>" value="<?php echo $cestadofactura->descedofactura->EditValue ?>"<?php echo $cestadofactura->descedofactura->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_cestadofactura_descedofactura">
<span<?php echo $cestadofactura->descedofactura->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($cestadofactura->descedofactura->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="cestadofactura" data-field="x_descedofactura" name="x_descedofactura" id="x_descedofactura" value="<?php echo HtmlEncode($cestadofactura->descedofactura->FormValue) ?>">
<?php } ?>
<?php echo $cestadofactura->descedofactura->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$cestadofactura_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $cestadofactura_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if ($cestadofactura->UpdateConflict == "U") { // Record already updated by other user ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='overwrite';"><?php echo $Language->phrase("OverwriteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-reload" id="btn-reload" type="submit" onclick="this.form.action.value='show';"><?php echo $Language->phrase("ReloadBtn") ?></button>
<?php } else { ?>
<?php if (!$cestadofactura->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $cestadofactura_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
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
$cestadofactura_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cestadofactura_edit->terminate();
?>