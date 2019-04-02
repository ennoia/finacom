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
$cestadosolicitud_add = new cestadosolicitud_add();

// Run the page
$cestadosolicitud_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cestadosolicitud_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fcestadosolicitudadd = currentForm = new ew.Form("fcestadosolicitudadd", "add");

// Validate form
fcestadosolicitudadd.validate = function() {
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
		<?php if ($cestadosolicitud_add->id_edosolicitud->Required) { ?>
			elm = this.getElements("x" + infix + "_id_edosolicitud");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cestadosolicitud->id_edosolicitud->caption(), $cestadosolicitud->id_edosolicitud->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_id_edosolicitud");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($cestadosolicitud->id_edosolicitud->errorMessage()) ?>");
		<?php if ($cestadosolicitud_add->descestadooperacion->Required) { ?>
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
fcestadosolicitudadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcestadosolicitudadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $cestadosolicitud_add->showPageHeader(); ?>
<?php
$cestadosolicitud_add->showMessage();
?>
<form name="fcestadosolicitudadd" id="fcestadosolicitudadd" class="<?php echo $cestadosolicitud_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($cestadosolicitud_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $cestadosolicitud_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cestadosolicitud">
<?php if ($cestadosolicitud->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$cestadosolicitud_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($cestadosolicitud->id_edosolicitud->Visible) { // id_edosolicitud ?>
	<div id="r_id_edosolicitud" class="form-group row">
		<label id="elh_cestadosolicitud_id_edosolicitud" for="x_id_edosolicitud" class="<?php echo $cestadosolicitud_add->LeftColumnClass ?>"><?php echo $cestadosolicitud->id_edosolicitud->caption() ?><?php echo ($cestadosolicitud->id_edosolicitud->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cestadosolicitud_add->RightColumnClass ?>"><div<?php echo $cestadosolicitud->id_edosolicitud->cellAttributes() ?>>
<?php if (!$cestadosolicitud->isConfirm()) { ?>
<span id="el_cestadosolicitud_id_edosolicitud">
<input type="text" data-table="cestadosolicitud" data-field="x_id_edosolicitud" name="x_id_edosolicitud" id="x_id_edosolicitud" size="30" placeholder="<?php echo HtmlEncode($cestadosolicitud->id_edosolicitud->getPlaceHolder()) ?>" value="<?php echo $cestadosolicitud->id_edosolicitud->EditValue ?>"<?php echo $cestadosolicitud->id_edosolicitud->editAttributes() ?>>
</span>
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
		<label id="elh_cestadosolicitud_descestadooperacion" for="x_descestadooperacion" class="<?php echo $cestadosolicitud_add->LeftColumnClass ?>"><?php echo $cestadosolicitud->descestadooperacion->caption() ?><?php echo ($cestadosolicitud->descestadooperacion->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cestadosolicitud_add->RightColumnClass ?>"><div<?php echo $cestadosolicitud->descestadooperacion->cellAttributes() ?>>
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
<?php if (!$cestadosolicitud_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $cestadosolicitud_add->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$cestadosolicitud->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $cestadosolicitud_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$cestadosolicitud_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cestadosolicitud_add->terminate();
?>