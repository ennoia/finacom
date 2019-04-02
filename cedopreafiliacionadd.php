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
$cedopreafiliacion_add = new cedopreafiliacion_add();

// Run the page
$cedopreafiliacion_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cedopreafiliacion_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fcedopreafiliacionadd = currentForm = new ew.Form("fcedopreafiliacionadd", "add");

// Validate form
fcedopreafiliacionadd.validate = function() {
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
		<?php if ($cedopreafiliacion_add->descpreafiliado->Required) { ?>
			elm = this.getElements("x" + infix + "_descpreafiliado");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cedopreafiliacion->descpreafiliado->caption(), $cedopreafiliacion->descpreafiliado->RequiredErrorMessage)) ?>");
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
fcedopreafiliacionadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcedopreafiliacionadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $cedopreafiliacion_add->showPageHeader(); ?>
<?php
$cedopreafiliacion_add->showMessage();
?>
<form name="fcedopreafiliacionadd" id="fcedopreafiliacionadd" class="<?php echo $cedopreafiliacion_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($cedopreafiliacion_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $cedopreafiliacion_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cedopreafiliacion">
<?php if ($cedopreafiliacion->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$cedopreafiliacion_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($cedopreafiliacion->descpreafiliado->Visible) { // descpreafiliado ?>
	<div id="r_descpreafiliado" class="form-group row">
		<label id="elh_cedopreafiliacion_descpreafiliado" for="x_descpreafiliado" class="<?php echo $cedopreafiliacion_add->LeftColumnClass ?>"><?php echo $cedopreafiliacion->descpreafiliado->caption() ?><?php echo ($cedopreafiliacion->descpreafiliado->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cedopreafiliacion_add->RightColumnClass ?>"><div<?php echo $cedopreafiliacion->descpreafiliado->cellAttributes() ?>>
<?php if (!$cedopreafiliacion->isConfirm()) { ?>
<span id="el_cedopreafiliacion_descpreafiliado">
<input type="text" data-table="cedopreafiliacion" data-field="x_descpreafiliado" name="x_descpreafiliado" id="x_descpreafiliado" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($cedopreafiliacion->descpreafiliado->getPlaceHolder()) ?>" value="<?php echo $cedopreafiliacion->descpreafiliado->EditValue ?>"<?php echo $cedopreafiliacion->descpreafiliado->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_cedopreafiliacion_descpreafiliado">
<span<?php echo $cedopreafiliacion->descpreafiliado->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($cedopreafiliacion->descpreafiliado->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="cedopreafiliacion" data-field="x_descpreafiliado" name="x_descpreafiliado" id="x_descpreafiliado" value="<?php echo HtmlEncode($cedopreafiliacion->descpreafiliado->FormValue) ?>">
<?php } ?>
<?php echo $cedopreafiliacion->descpreafiliado->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$cedopreafiliacion_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $cedopreafiliacion_add->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$cedopreafiliacion->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $cedopreafiliacion_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$cedopreafiliacion_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cedopreafiliacion_add->terminate();
?>