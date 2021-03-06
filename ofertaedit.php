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
$oferta_edit = new oferta_edit();

// Run the page
$oferta_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$oferta_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fofertaedit = currentForm = new ew.Form("fofertaedit", "edit");

// Validate form
fofertaedit.validate = function() {
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
		<?php if ($oferta_edit->idoferta->Required) { ?>
			elm = this.getElements("x" + infix + "_idoferta");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $oferta->idoferta->caption(), $oferta->idoferta->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($oferta_edit->fechaoferta->Required) { ?>
			elm = this.getElements("x" + infix + "_fechaoferta");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $oferta->fechaoferta->caption(), $oferta->fechaoferta->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_fechaoferta");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($oferta->fechaoferta->errorMessage()) ?>");
		<?php if ($oferta_edit->descripcionoferta->Required) { ?>
			elm = this.getElements("x" + infix + "_descripcionoferta");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $oferta->descripcionoferta->caption(), $oferta->descripcionoferta->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_descripcionoferta");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($oferta->descripcionoferta->errorMessage()) ?>");

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
fofertaedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fofertaedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $oferta_edit->showPageHeader(); ?>
<?php
$oferta_edit->showMessage();
?>
<form name="fofertaedit" id="fofertaedit" class="<?php echo $oferta_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($oferta_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $oferta_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="oferta">
<input type="hidden" name="k_hash" id="k_hash" value="<?php echo $oferta_edit->HashValue ?>">
<?php if ($oferta->UpdateConflict == "U") { // Record already updated by other user ?>
<input type="hidden" name="conflict" id="conflict" value="1">
<?php } ?>
<?php if ($oferta->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$oferta_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($oferta->idoferta->Visible) { // idoferta ?>
	<div id="r_idoferta" class="form-group row">
		<label id="elh_oferta_idoferta" for="x_idoferta" class="<?php echo $oferta_edit->LeftColumnClass ?>"><?php echo $oferta->idoferta->caption() ?><?php echo ($oferta->idoferta->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $oferta_edit->RightColumnClass ?>"><div<?php echo $oferta->idoferta->cellAttributes() ?>>
<?php if (!$oferta->isConfirm()) { ?>
<span id="el_oferta_idoferta">
<span<?php echo $oferta->idoferta->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($oferta->idoferta->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="oferta" data-field="x_idoferta" name="x_idoferta" id="x_idoferta" value="<?php echo HtmlEncode($oferta->idoferta->CurrentValue) ?>">
<?php } else { ?>
<span id="el_oferta_idoferta">
<span<?php echo $oferta->idoferta->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($oferta->idoferta->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="oferta" data-field="x_idoferta" name="x_idoferta" id="x_idoferta" value="<?php echo HtmlEncode($oferta->idoferta->FormValue) ?>">
<?php } ?>
<?php echo $oferta->idoferta->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($oferta->fechaoferta->Visible) { // fechaoferta ?>
	<div id="r_fechaoferta" class="form-group row">
		<label id="elh_oferta_fechaoferta" for="x_fechaoferta" class="<?php echo $oferta_edit->LeftColumnClass ?>"><?php echo $oferta->fechaoferta->caption() ?><?php echo ($oferta->fechaoferta->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $oferta_edit->RightColumnClass ?>"><div<?php echo $oferta->fechaoferta->cellAttributes() ?>>
<?php if (!$oferta->isConfirm()) { ?>
<span id="el_oferta_fechaoferta">
<input type="text" data-table="oferta" data-field="x_fechaoferta" name="x_fechaoferta" id="x_fechaoferta" size="30" placeholder="<?php echo HtmlEncode($oferta->fechaoferta->getPlaceHolder()) ?>" value="<?php echo $oferta->fechaoferta->EditValue ?>"<?php echo $oferta->fechaoferta->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_oferta_fechaoferta">
<span<?php echo $oferta->fechaoferta->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($oferta->fechaoferta->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="oferta" data-field="x_fechaoferta" name="x_fechaoferta" id="x_fechaoferta" value="<?php echo HtmlEncode($oferta->fechaoferta->FormValue) ?>">
<?php } ?>
<?php echo $oferta->fechaoferta->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($oferta->descripcionoferta->Visible) { // descripcionoferta ?>
	<div id="r_descripcionoferta" class="form-group row">
		<label id="elh_oferta_descripcionoferta" for="x_descripcionoferta" class="<?php echo $oferta_edit->LeftColumnClass ?>"><?php echo $oferta->descripcionoferta->caption() ?><?php echo ($oferta->descripcionoferta->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $oferta_edit->RightColumnClass ?>"><div<?php echo $oferta->descripcionoferta->cellAttributes() ?>>
<?php if (!$oferta->isConfirm()) { ?>
<span id="el_oferta_descripcionoferta">
<input type="text" data-table="oferta" data-field="x_descripcionoferta" name="x_descripcionoferta" id="x_descripcionoferta" size="30" placeholder="<?php echo HtmlEncode($oferta->descripcionoferta->getPlaceHolder()) ?>" value="<?php echo $oferta->descripcionoferta->EditValue ?>"<?php echo $oferta->descripcionoferta->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_oferta_descripcionoferta">
<span<?php echo $oferta->descripcionoferta->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($oferta->descripcionoferta->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="oferta" data-field="x_descripcionoferta" name="x_descripcionoferta" id="x_descripcionoferta" value="<?php echo HtmlEncode($oferta->descripcionoferta->FormValue) ?>">
<?php } ?>
<?php echo $oferta->descripcionoferta->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$oferta_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $oferta_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if ($oferta->UpdateConflict == "U") { // Record already updated by other user ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='overwrite';"><?php echo $Language->phrase("OverwriteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-reload" id="btn-reload" type="submit" onclick="this.form.action.value='show';"><?php echo $Language->phrase("ReloadBtn") ?></button>
<?php } else { ?>
<?php if (!$oferta->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $oferta_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
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
$oferta_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$oferta_edit->terminate();
?>