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
$parametros_add = new parametros_add();

// Run the page
$parametros_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$parametros_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fparametrosadd = currentForm = new ew.Form("fparametrosadd", "add");

// Validate form
fparametrosadd.validate = function() {
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
		<?php if ($parametros_add->diascalculo->Required) { ?>
			elm = this.getElements("x" + infix + "_diascalculo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $parametros->diascalculo->caption(), $parametros->diascalculo->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_diascalculo");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($parametros->diascalculo->errorMessage()) ?>");
		<?php if ($parametros_add->modulo->Required) { ?>
			elm = this.getElements("x" + infix + "_modulo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $parametros->modulo->caption(), $parametros->modulo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($parametros_add->unidadmedida->Required) { ?>
			elm = this.getElements("x" + infix + "_unidadmedida");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $parametros->unidadmedida->caption(), $parametros->unidadmedida->RequiredErrorMessage)) ?>");
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
fparametrosadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fparametrosadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $parametros_add->showPageHeader(); ?>
<?php
$parametros_add->showMessage();
?>
<form name="fparametrosadd" id="fparametrosadd" class="<?php echo $parametros_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($parametros_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $parametros_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="parametros">
<?php if ($parametros->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$parametros_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($parametros->diascalculo->Visible) { // diascalculo ?>
	<div id="r_diascalculo" class="form-group row">
		<label id="elh_parametros_diascalculo" for="x_diascalculo" class="<?php echo $parametros_add->LeftColumnClass ?>"><?php echo $parametros->diascalculo->caption() ?><?php echo ($parametros->diascalculo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $parametros_add->RightColumnClass ?>"><div<?php echo $parametros->diascalculo->cellAttributes() ?>>
<?php if (!$parametros->isConfirm()) { ?>
<span id="el_parametros_diascalculo">
<input type="text" data-table="parametros" data-field="x_diascalculo" name="x_diascalculo" id="x_diascalculo" size="30" placeholder="<?php echo HtmlEncode($parametros->diascalculo->getPlaceHolder()) ?>" value="<?php echo $parametros->diascalculo->EditValue ?>"<?php echo $parametros->diascalculo->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_parametros_diascalculo">
<span<?php echo $parametros->diascalculo->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($parametros->diascalculo->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="parametros" data-field="x_diascalculo" name="x_diascalculo" id="x_diascalculo" value="<?php echo HtmlEncode($parametros->diascalculo->FormValue) ?>">
<?php } ?>
<?php echo $parametros->diascalculo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($parametros->modulo->Visible) { // modulo ?>
	<div id="r_modulo" class="form-group row">
		<label id="elh_parametros_modulo" for="x_modulo" class="<?php echo $parametros_add->LeftColumnClass ?>"><?php echo $parametros->modulo->caption() ?><?php echo ($parametros->modulo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $parametros_add->RightColumnClass ?>"><div<?php echo $parametros->modulo->cellAttributes() ?>>
<?php if (!$parametros->isConfirm()) { ?>
<span id="el_parametros_modulo">
<input type="text" data-table="parametros" data-field="x_modulo" name="x_modulo" id="x_modulo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($parametros->modulo->getPlaceHolder()) ?>" value="<?php echo $parametros->modulo->EditValue ?>"<?php echo $parametros->modulo->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_parametros_modulo">
<span<?php echo $parametros->modulo->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($parametros->modulo->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="parametros" data-field="x_modulo" name="x_modulo" id="x_modulo" value="<?php echo HtmlEncode($parametros->modulo->FormValue) ?>">
<?php } ?>
<?php echo $parametros->modulo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($parametros->unidadmedida->Visible) { // unidadmedida ?>
	<div id="r_unidadmedida" class="form-group row">
		<label id="elh_parametros_unidadmedida" for="x_unidadmedida" class="<?php echo $parametros_add->LeftColumnClass ?>"><?php echo $parametros->unidadmedida->caption() ?><?php echo ($parametros->unidadmedida->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $parametros_add->RightColumnClass ?>"><div<?php echo $parametros->unidadmedida->cellAttributes() ?>>
<?php if (!$parametros->isConfirm()) { ?>
<span id="el_parametros_unidadmedida">
<input type="text" data-table="parametros" data-field="x_unidadmedida" name="x_unidadmedida" id="x_unidadmedida" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($parametros->unidadmedida->getPlaceHolder()) ?>" value="<?php echo $parametros->unidadmedida->EditValue ?>"<?php echo $parametros->unidadmedida->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_parametros_unidadmedida">
<span<?php echo $parametros->unidadmedida->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($parametros->unidadmedida->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="parametros" data-field="x_unidadmedida" name="x_unidadmedida" id="x_unidadmedida" value="<?php echo HtmlEncode($parametros->unidadmedida->FormValue) ?>">
<?php } ?>
<?php echo $parametros->unidadmedida->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$parametros_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $parametros_add->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$parametros->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $parametros_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$parametros_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$parametros_add->terminate();
?>