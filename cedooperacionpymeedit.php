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
$cedooperacionpyme_edit = new cedooperacionpyme_edit();

// Run the page
$cedooperacionpyme_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cedooperacionpyme_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fcedooperacionpymeedit = currentForm = new ew.Form("fcedooperacionpymeedit", "edit");

// Validate form
fcedooperacionpymeedit.validate = function() {
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
		<?php if ($cedooperacionpyme_edit->id_estaus->Required) { ?>
			elm = this.getElements("x" + infix + "_id_estaus");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cedooperacionpyme->id_estaus->caption(), $cedooperacionpyme->id_estaus->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($cedooperacionpyme_edit->descripcion->Required) { ?>
			elm = this.getElements("x" + infix + "_descripcion");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cedooperacionpyme->descripcion->caption(), $cedooperacionpyme->descripcion->RequiredErrorMessage)) ?>");
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
fcedooperacionpymeedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcedooperacionpymeedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $cedooperacionpyme_edit->showPageHeader(); ?>
<?php
$cedooperacionpyme_edit->showMessage();
?>
<form name="fcedooperacionpymeedit" id="fcedooperacionpymeedit" class="<?php echo $cedooperacionpyme_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($cedooperacionpyme_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $cedooperacionpyme_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cedooperacionpyme">
<input type="hidden" name="k_hash" id="k_hash" value="<?php echo $cedooperacionpyme_edit->HashValue ?>">
<?php if ($cedooperacionpyme->UpdateConflict == "U") { // Record already updated by other user ?>
<input type="hidden" name="conflict" id="conflict" value="1">
<?php } ?>
<?php if ($cedooperacionpyme->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$cedooperacionpyme_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($cedooperacionpyme->id_estaus->Visible) { // id_estaus ?>
	<div id="r_id_estaus" class="form-group row">
		<label id="elh_cedooperacionpyme_id_estaus" class="<?php echo $cedooperacionpyme_edit->LeftColumnClass ?>"><?php echo $cedooperacionpyme->id_estaus->caption() ?><?php echo ($cedooperacionpyme->id_estaus->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cedooperacionpyme_edit->RightColumnClass ?>"><div<?php echo $cedooperacionpyme->id_estaus->cellAttributes() ?>>
<?php if (!$cedooperacionpyme->isConfirm()) { ?>
<span id="el_cedooperacionpyme_id_estaus">
<span<?php echo $cedooperacionpyme->id_estaus->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($cedooperacionpyme->id_estaus->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="cedooperacionpyme" data-field="x_id_estaus" name="x_id_estaus" id="x_id_estaus" value="<?php echo HtmlEncode($cedooperacionpyme->id_estaus->CurrentValue) ?>">
<?php } else { ?>
<span id="el_cedooperacionpyme_id_estaus">
<span<?php echo $cedooperacionpyme->id_estaus->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($cedooperacionpyme->id_estaus->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="cedooperacionpyme" data-field="x_id_estaus" name="x_id_estaus" id="x_id_estaus" value="<?php echo HtmlEncode($cedooperacionpyme->id_estaus->FormValue) ?>">
<?php } ?>
<?php echo $cedooperacionpyme->id_estaus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cedooperacionpyme->descripcion->Visible) { // descripcion ?>
	<div id="r_descripcion" class="form-group row">
		<label id="elh_cedooperacionpyme_descripcion" for="x_descripcion" class="<?php echo $cedooperacionpyme_edit->LeftColumnClass ?>"><?php echo $cedooperacionpyme->descripcion->caption() ?><?php echo ($cedooperacionpyme->descripcion->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cedooperacionpyme_edit->RightColumnClass ?>"><div<?php echo $cedooperacionpyme->descripcion->cellAttributes() ?>>
<?php if (!$cedooperacionpyme->isConfirm()) { ?>
<span id="el_cedooperacionpyme_descripcion">
<input type="text" data-table="cedooperacionpyme" data-field="x_descripcion" name="x_descripcion" id="x_descripcion" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($cedooperacionpyme->descripcion->getPlaceHolder()) ?>" value="<?php echo $cedooperacionpyme->descripcion->EditValue ?>"<?php echo $cedooperacionpyme->descripcion->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_cedooperacionpyme_descripcion">
<span<?php echo $cedooperacionpyme->descripcion->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($cedooperacionpyme->descripcion->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="cedooperacionpyme" data-field="x_descripcion" name="x_descripcion" id="x_descripcion" value="<?php echo HtmlEncode($cedooperacionpyme->descripcion->FormValue) ?>">
<?php } ?>
<?php echo $cedooperacionpyme->descripcion->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$cedooperacionpyme_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $cedooperacionpyme_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if ($cedooperacionpyme->UpdateConflict == "U") { // Record already updated by other user ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='overwrite';"><?php echo $Language->phrase("OverwriteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-reload" id="btn-reload" type="submit" onclick="this.form.action.value='show';"><?php echo $Language->phrase("ReloadBtn") ?></button>
<?php } else { ?>
<?php if (!$cedooperacionpyme->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $cedooperacionpyme_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
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
$cedooperacionpyme_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cedooperacionpyme_edit->terminate();
?>