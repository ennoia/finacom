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
$ccalificacion_add = new ccalificacion_add();

// Run the page
$ccalificacion_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ccalificacion_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fccalificacionadd = currentForm = new ew.Form("fccalificacionadd", "add");

// Validate form
fccalificacionadd.validate = function() {
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
		<?php if ($ccalificacion_add->descripcion->Required) { ?>
			elm = this.getElements("x" + infix + "_descripcion");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ccalificacion->descripcion->caption(), $ccalificacion->descripcion->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($ccalificacion_add->fondeadorrfc->Required) { ?>
			elm = this.getElements("x" + infix + "_fondeadorrfc");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ccalificacion->fondeadorrfc->caption(), $ccalificacion->fondeadorrfc->RequiredErrorMessage)) ?>");
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
fccalificacionadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fccalificacionadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $ccalificacion_add->showPageHeader(); ?>
<?php
$ccalificacion_add->showMessage();
?>
<form name="fccalificacionadd" id="fccalificacionadd" class="<?php echo $ccalificacion_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($ccalificacion_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $ccalificacion_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ccalificacion">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$ccalificacion_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($ccalificacion->descripcion->Visible) { // descripcion ?>
	<div id="r_descripcion" class="form-group row">
		<label id="elh_ccalificacion_descripcion" for="x_descripcion" class="<?php echo $ccalificacion_add->LeftColumnClass ?>"><?php echo $ccalificacion->descripcion->caption() ?><?php echo ($ccalificacion->descripcion->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ccalificacion_add->RightColumnClass ?>"><div<?php echo $ccalificacion->descripcion->cellAttributes() ?>>
<span id="el_ccalificacion_descripcion">
<input type="text" data-table="ccalificacion" data-field="x_descripcion" name="x_descripcion" id="x_descripcion" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($ccalificacion->descripcion->getPlaceHolder()) ?>" value="<?php echo $ccalificacion->descripcion->EditValue ?>"<?php echo $ccalificacion->descripcion->editAttributes() ?>>
</span>
<?php echo $ccalificacion->descripcion->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ccalificacion->fondeadorrfc->Visible) { // fondeadorrfc ?>
	<div id="r_fondeadorrfc" class="form-group row">
		<label id="elh_ccalificacion_fondeadorrfc" for="x_fondeadorrfc" class="<?php echo $ccalificacion_add->LeftColumnClass ?>"><?php echo $ccalificacion->fondeadorrfc->caption() ?><?php echo ($ccalificacion->fondeadorrfc->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ccalificacion_add->RightColumnClass ?>"><div<?php echo $ccalificacion->fondeadorrfc->cellAttributes() ?>>
<span id="el_ccalificacion_fondeadorrfc">
<input type="text" data-table="ccalificacion" data-field="x_fondeadorrfc" name="x_fondeadorrfc" id="x_fondeadorrfc" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($ccalificacion->fondeadorrfc->getPlaceHolder()) ?>" value="<?php echo $ccalificacion->fondeadorrfc->EditValue ?>"<?php echo $ccalificacion->fondeadorrfc->editAttributes() ?>>
</span>
<?php echo $ccalificacion->fondeadorrfc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$ccalificacion_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ccalificacion_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ccalificacion_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$ccalificacion_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$ccalificacion_add->terminate();
?>