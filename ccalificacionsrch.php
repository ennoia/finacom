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
$ccalificacion_search = new ccalificacion_search();

// Run the page
$ccalificacion_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ccalificacion_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "search";
<?php if ($ccalificacion_search->IsModal) { ?>
var fccalificacionsearch = currentAdvancedSearchForm = new ew.Form("fccalificacionsearch", "search");
<?php } else { ?>
var fccalificacionsearch = currentForm = new ew.Form("fccalificacionsearch", "search");
<?php } ?>

// Form_CustomValidate event
fccalificacionsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fccalificacionsearch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search
// Validate function for search

fccalificacionsearch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_idcalificacion");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($ccalificacion->idcalificacion->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $ccalificacion_search->showPageHeader(); ?>
<?php
$ccalificacion_search->showMessage();
?>
<form name="fccalificacionsearch" id="fccalificacionsearch" class="<?php echo $ccalificacion_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($ccalificacion_search->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $ccalificacion_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ccalificacion">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$ccalificacion_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($ccalificacion->idcalificacion->Visible) { // idcalificacion ?>
	<div id="r_idcalificacion" class="form-group row">
		<label for="x_idcalificacion" class="<?php echo $ccalificacion_search->LeftColumnClass ?>"><span id="elh_ccalificacion_idcalificacion"><?php echo $ccalificacion->idcalificacion->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_idcalificacion" id="z_idcalificacion" value="="></span>
		</label>
		<div class="<?php echo $ccalificacion_search->RightColumnClass ?>"><div<?php echo $ccalificacion->idcalificacion->cellAttributes() ?>>
			<span id="el_ccalificacion_idcalificacion">
<input type="text" data-table="ccalificacion" data-field="x_idcalificacion" name="x_idcalificacion" id="x_idcalificacion" placeholder="<?php echo HtmlEncode($ccalificacion->idcalificacion->getPlaceHolder()) ?>" value="<?php echo $ccalificacion->idcalificacion->EditValue ?>"<?php echo $ccalificacion->idcalificacion->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ccalificacion->descripcion->Visible) { // descripcion ?>
	<div id="r_descripcion" class="form-group row">
		<label for="x_descripcion" class="<?php echo $ccalificacion_search->LeftColumnClass ?>"><span id="elh_ccalificacion_descripcion"><?php echo $ccalificacion->descripcion->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_descripcion" id="z_descripcion" value="LIKE"></span>
		</label>
		<div class="<?php echo $ccalificacion_search->RightColumnClass ?>"><div<?php echo $ccalificacion->descripcion->cellAttributes() ?>>
			<span id="el_ccalificacion_descripcion">
<input type="text" data-table="ccalificacion" data-field="x_descripcion" name="x_descripcion" id="x_descripcion" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($ccalificacion->descripcion->getPlaceHolder()) ?>" value="<?php echo $ccalificacion->descripcion->EditValue ?>"<?php echo $ccalificacion->descripcion->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ccalificacion->fondeadorrfc->Visible) { // fondeadorrfc ?>
	<div id="r_fondeadorrfc" class="form-group row">
		<label for="x_fondeadorrfc" class="<?php echo $ccalificacion_search->LeftColumnClass ?>"><span id="elh_ccalificacion_fondeadorrfc"><?php echo $ccalificacion->fondeadorrfc->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_fondeadorrfc" id="z_fondeadorrfc" value="LIKE"></span>
		</label>
		<div class="<?php echo $ccalificacion_search->RightColumnClass ?>"><div<?php echo $ccalificacion->fondeadorrfc->cellAttributes() ?>>
			<span id="el_ccalificacion_fondeadorrfc">
<input type="text" data-table="ccalificacion" data-field="x_fondeadorrfc" name="x_fondeadorrfc" id="x_fondeadorrfc" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($ccalificacion->fondeadorrfc->getPlaceHolder()) ?>" value="<?php echo $ccalificacion->fondeadorrfc->EditValue ?>"<?php echo $ccalificacion->fondeadorrfc->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$ccalificacion_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ccalificacion_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$ccalificacion_search->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$ccalificacion_search->terminate();
?>