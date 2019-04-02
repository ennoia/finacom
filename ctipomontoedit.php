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
$ctipomonto_edit = new ctipomonto_edit();

// Run the page
$ctipomonto_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ctipomonto_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fctipomontoedit = currentForm = new ew.Form("fctipomontoedit", "edit");

// Validate form
fctipomontoedit.validate = function() {
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
		<?php if ($ctipomonto_edit->idtipomonto->Required) { ?>
			elm = this.getElements("x" + infix + "_idtipomonto");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ctipomonto->idtipomonto->caption(), $ctipomonto->idtipomonto->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($ctipomonto_edit->descripcion->Required) { ?>
			elm = this.getElements("x" + infix + "_descripcion");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ctipomonto->descripcion->caption(), $ctipomonto->descripcion->RequiredErrorMessage)) ?>");
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
fctipomontoedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fctipomontoedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $ctipomonto_edit->showPageHeader(); ?>
<?php
$ctipomonto_edit->showMessage();
?>
<form name="fctipomontoedit" id="fctipomontoedit" class="<?php echo $ctipomonto_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($ctipomonto_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $ctipomonto_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ctipomonto">
<input type="hidden" name="k_hash" id="k_hash" value="<?php echo $ctipomonto_edit->HashValue ?>">
<?php if ($ctipomonto->UpdateConflict == "U") { // Record already updated by other user ?>
<input type="hidden" name="conflict" id="conflict" value="1">
<?php } ?>
<?php if ($ctipomonto->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$ctipomonto_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($ctipomonto->idtipomonto->Visible) { // idtipomonto ?>
	<div id="r_idtipomonto" class="form-group row">
		<label id="elh_ctipomonto_idtipomonto" class="<?php echo $ctipomonto_edit->LeftColumnClass ?>"><?php echo $ctipomonto->idtipomonto->caption() ?><?php echo ($ctipomonto->idtipomonto->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ctipomonto_edit->RightColumnClass ?>"><div<?php echo $ctipomonto->idtipomonto->cellAttributes() ?>>
<?php if (!$ctipomonto->isConfirm()) { ?>
<span id="el_ctipomonto_idtipomonto">
<span<?php echo $ctipomonto->idtipomonto->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($ctipomonto->idtipomonto->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="ctipomonto" data-field="x_idtipomonto" name="x_idtipomonto" id="x_idtipomonto" value="<?php echo HtmlEncode($ctipomonto->idtipomonto->CurrentValue) ?>">
<?php } else { ?>
<span id="el_ctipomonto_idtipomonto">
<span<?php echo $ctipomonto->idtipomonto->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($ctipomonto->idtipomonto->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="ctipomonto" data-field="x_idtipomonto" name="x_idtipomonto" id="x_idtipomonto" value="<?php echo HtmlEncode($ctipomonto->idtipomonto->FormValue) ?>">
<?php } ?>
<?php echo $ctipomonto->idtipomonto->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ctipomonto->descripcion->Visible) { // descripcion ?>
	<div id="r_descripcion" class="form-group row">
		<label id="elh_ctipomonto_descripcion" for="x_descripcion" class="<?php echo $ctipomonto_edit->LeftColumnClass ?>"><?php echo $ctipomonto->descripcion->caption() ?><?php echo ($ctipomonto->descripcion->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ctipomonto_edit->RightColumnClass ?>"><div<?php echo $ctipomonto->descripcion->cellAttributes() ?>>
<?php if (!$ctipomonto->isConfirm()) { ?>
<span id="el_ctipomonto_descripcion">
<input type="text" data-table="ctipomonto" data-field="x_descripcion" name="x_descripcion" id="x_descripcion" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($ctipomonto->descripcion->getPlaceHolder()) ?>" value="<?php echo $ctipomonto->descripcion->EditValue ?>"<?php echo $ctipomonto->descripcion->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_ctipomonto_descripcion">
<span<?php echo $ctipomonto->descripcion->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($ctipomonto->descripcion->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="ctipomonto" data-field="x_descripcion" name="x_descripcion" id="x_descripcion" value="<?php echo HtmlEncode($ctipomonto->descripcion->FormValue) ?>">
<?php } ?>
<?php echo $ctipomonto->descripcion->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$ctipomonto_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ctipomonto_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if ($ctipomonto->UpdateConflict == "U") { // Record already updated by other user ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='overwrite';"><?php echo $Language->phrase("OverwriteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-reload" id="btn-reload" type="submit" onclick="this.form.action.value='show';"><?php echo $Language->phrase("ReloadBtn") ?></button>
<?php } else { ?>
<?php if (!$ctipomonto->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ctipomonto_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
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
$ctipomonto_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$ctipomonto_edit->terminate();
?>