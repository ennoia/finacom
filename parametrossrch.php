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
$parametros_search = new parametros_search();

// Run the page
$parametros_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$parametros_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "search";
<?php if ($parametros_search->IsModal) { ?>
var fparametrossearch = currentAdvancedSearchForm = new ew.Form("fparametrossearch", "search");
<?php } else { ?>
var fparametrossearch = currentForm = new ew.Form("fparametrossearch", "search");
<?php } ?>

// Form_CustomValidate event
fparametrossearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fparametrossearch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search
// Validate function for search

fparametrossearch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_id_parametro");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($parametros->id_parametro->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_diascalculo");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($parametros->diascalculo->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $parametros_search->showPageHeader(); ?>
<?php
$parametros_search->showMessage();
?>
<form name="fparametrossearch" id="fparametrossearch" class="<?php echo $parametros_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($parametros_search->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $parametros_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="parametros">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$parametros_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($parametros->id_parametro->Visible) { // id_parametro ?>
	<div id="r_id_parametro" class="form-group row">
		<label for="x_id_parametro" class="<?php echo $parametros_search->LeftColumnClass ?>"><span id="elh_parametros_id_parametro"><?php echo $parametros->id_parametro->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_id_parametro" id="z_id_parametro" value="="></span>
		</label>
		<div class="<?php echo $parametros_search->RightColumnClass ?>"><div<?php echo $parametros->id_parametro->cellAttributes() ?>>
			<span id="el_parametros_id_parametro">
<input type="text" data-table="parametros" data-field="x_id_parametro" name="x_id_parametro" id="x_id_parametro" placeholder="<?php echo HtmlEncode($parametros->id_parametro->getPlaceHolder()) ?>" value="<?php echo $parametros->id_parametro->EditValue ?>"<?php echo $parametros->id_parametro->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($parametros->diascalculo->Visible) { // diascalculo ?>
	<div id="r_diascalculo" class="form-group row">
		<label for="x_diascalculo" class="<?php echo $parametros_search->LeftColumnClass ?>"><span id="elh_parametros_diascalculo"><?php echo $parametros->diascalculo->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_diascalculo" id="z_diascalculo" value="="></span>
		</label>
		<div class="<?php echo $parametros_search->RightColumnClass ?>"><div<?php echo $parametros->diascalculo->cellAttributes() ?>>
			<span id="el_parametros_diascalculo">
<input type="text" data-table="parametros" data-field="x_diascalculo" name="x_diascalculo" id="x_diascalculo" size="30" placeholder="<?php echo HtmlEncode($parametros->diascalculo->getPlaceHolder()) ?>" value="<?php echo $parametros->diascalculo->EditValue ?>"<?php echo $parametros->diascalculo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($parametros->modulo->Visible) { // modulo ?>
	<div id="r_modulo" class="form-group row">
		<label for="x_modulo" class="<?php echo $parametros_search->LeftColumnClass ?>"><span id="elh_parametros_modulo"><?php echo $parametros->modulo->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_modulo" id="z_modulo" value="LIKE"></span>
		</label>
		<div class="<?php echo $parametros_search->RightColumnClass ?>"><div<?php echo $parametros->modulo->cellAttributes() ?>>
			<span id="el_parametros_modulo">
<input type="text" data-table="parametros" data-field="x_modulo" name="x_modulo" id="x_modulo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($parametros->modulo->getPlaceHolder()) ?>" value="<?php echo $parametros->modulo->EditValue ?>"<?php echo $parametros->modulo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($parametros->unidadmedida->Visible) { // unidadmedida ?>
	<div id="r_unidadmedida" class="form-group row">
		<label for="x_unidadmedida" class="<?php echo $parametros_search->LeftColumnClass ?>"><span id="elh_parametros_unidadmedida"><?php echo $parametros->unidadmedida->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_unidadmedida" id="z_unidadmedida" value="LIKE"></span>
		</label>
		<div class="<?php echo $parametros_search->RightColumnClass ?>"><div<?php echo $parametros->unidadmedida->cellAttributes() ?>>
			<span id="el_parametros_unidadmedida">
<input type="text" data-table="parametros" data-field="x_unidadmedida" name="x_unidadmedida" id="x_unidadmedida" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($parametros->unidadmedida->getPlaceHolder()) ?>" value="<?php echo $parametros->unidadmedida->EditValue ?>"<?php echo $parametros->unidadmedida->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$parametros_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $parametros_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$parametros_search->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$parametros_search->terminate();
?>