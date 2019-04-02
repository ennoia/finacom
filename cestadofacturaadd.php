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
$cestadofactura_add = new cestadofactura_add();

// Run the page
$cestadofactura_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cestadofactura_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fcestadofacturaadd = currentForm = new ew.Form("fcestadofacturaadd", "add");

// Validate form
fcestadofacturaadd.validate = function() {
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
		<?php if ($cestadofactura_add->descedofactura->Required) { ?>
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
fcestadofacturaadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcestadofacturaadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $cestadofactura_add->showPageHeader(); ?>
<?php
$cestadofactura_add->showMessage();
?>
<form name="fcestadofacturaadd" id="fcestadofacturaadd" class="<?php echo $cestadofactura_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($cestadofactura_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $cestadofactura_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cestadofactura">
<?php if ($cestadofactura->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$cestadofactura_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($cestadofactura->descedofactura->Visible) { // descedofactura ?>
	<div id="r_descedofactura" class="form-group row">
		<label id="elh_cestadofactura_descedofactura" for="x_descedofactura" class="<?php echo $cestadofactura_add->LeftColumnClass ?>"><?php echo $cestadofactura->descedofactura->caption() ?><?php echo ($cestadofactura->descedofactura->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cestadofactura_add->RightColumnClass ?>"><div<?php echo $cestadofactura->descedofactura->cellAttributes() ?>>
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
<?php if (!$cestadofactura_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $cestadofactura_add->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$cestadofactura->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $cestadofactura_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$cestadofactura_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cestadofactura_add->terminate();
?>