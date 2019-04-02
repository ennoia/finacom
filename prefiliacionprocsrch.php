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
$prefiliacionproc_search = new prefiliacionproc_search();

// Run the page
$prefiliacionproc_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$prefiliacionproc_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "search";
<?php if ($prefiliacionproc_search->IsModal) { ?>
var fprefiliacionprocsearch = currentAdvancedSearchForm = new ew.Form("fprefiliacionprocsearch", "search");
<?php } else { ?>
var fprefiliacionprocsearch = currentForm = new ew.Form("fprefiliacionprocsearch", "search");
<?php } ?>

// Form_CustomValidate event
fprefiliacionprocsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fprefiliacionprocsearch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search
// Validate function for search

fprefiliacionprocsearch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_oidarchivos");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($prefiliacionproc->oidarchivos->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_idrfccomprador");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($prefiliacionproc->idrfccomprador->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_registros_totales");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($prefiliacionproc->registros_totales->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_registros_validos");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($prefiliacionproc->registros_validos->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_errores");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($prefiliacionproc->errores->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $prefiliacionproc_search->showPageHeader(); ?>
<?php
$prefiliacionproc_search->showMessage();
?>
<form name="fprefiliacionprocsearch" id="fprefiliacionprocsearch" class="<?php echo $prefiliacionproc_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($prefiliacionproc_search->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $prefiliacionproc_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="prefiliacionproc">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$prefiliacionproc_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($prefiliacionproc->oidarchivos->Visible) { // oidarchivos ?>
	<div id="r_oidarchivos" class="form-group row">
		<label for="x_oidarchivos" class="<?php echo $prefiliacionproc_search->LeftColumnClass ?>"><span id="elh_prefiliacionproc_oidarchivos"><?php echo $prefiliacionproc->oidarchivos->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_oidarchivos" id="z_oidarchivos" value="="></span>
		</label>
		<div class="<?php echo $prefiliacionproc_search->RightColumnClass ?>"><div<?php echo $prefiliacionproc->oidarchivos->cellAttributes() ?>>
			<span id="el_prefiliacionproc_oidarchivos">
<input type="text" data-table="prefiliacionproc" data-field="x_oidarchivos" name="x_oidarchivos" id="x_oidarchivos" size="30" placeholder="<?php echo HtmlEncode($prefiliacionproc->oidarchivos->getPlaceHolder()) ?>" value="<?php echo $prefiliacionproc->oidarchivos->EditValue ?>"<?php echo $prefiliacionproc->oidarchivos->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($prefiliacionproc->idrfccomprador->Visible) { // idrfccomprador ?>
	<div id="r_idrfccomprador" class="form-group row">
		<label for="x_idrfccomprador" class="<?php echo $prefiliacionproc_search->LeftColumnClass ?>"><span id="elh_prefiliacionproc_idrfccomprador"><?php echo $prefiliacionproc->idrfccomprador->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_idrfccomprador" id="z_idrfccomprador" value="="></span>
		</label>
		<div class="<?php echo $prefiliacionproc_search->RightColumnClass ?>"><div<?php echo $prefiliacionproc->idrfccomprador->cellAttributes() ?>>
			<span id="el_prefiliacionproc_idrfccomprador">
<input type="text" data-table="prefiliacionproc" data-field="x_idrfccomprador" name="x_idrfccomprador" id="x_idrfccomprador" size="30" placeholder="<?php echo HtmlEncode($prefiliacionproc->idrfccomprador->getPlaceHolder()) ?>" value="<?php echo $prefiliacionproc->idrfccomprador->EditValue ?>"<?php echo $prefiliacionproc->idrfccomprador->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($prefiliacionproc->registros_totales->Visible) { // registros totales ?>
	<div id="r_registros_totales" class="form-group row">
		<label for="x_registros_totales" class="<?php echo $prefiliacionproc_search->LeftColumnClass ?>"><span id="elh_prefiliacionproc_registros_totales"><?php echo $prefiliacionproc->registros_totales->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_registros_totales" id="z_registros_totales" value="="></span>
		</label>
		<div class="<?php echo $prefiliacionproc_search->RightColumnClass ?>"><div<?php echo $prefiliacionproc->registros_totales->cellAttributes() ?>>
			<span id="el_prefiliacionproc_registros_totales">
<input type="text" data-table="prefiliacionproc" data-field="x_registros_totales" name="x_registros_totales" id="x_registros_totales" size="30" placeholder="<?php echo HtmlEncode($prefiliacionproc->registros_totales->getPlaceHolder()) ?>" value="<?php echo $prefiliacionproc->registros_totales->EditValue ?>"<?php echo $prefiliacionproc->registros_totales->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($prefiliacionproc->registros_validos->Visible) { // registros validos ?>
	<div id="r_registros_validos" class="form-group row">
		<label for="x_registros_validos" class="<?php echo $prefiliacionproc_search->LeftColumnClass ?>"><span id="elh_prefiliacionproc_registros_validos"><?php echo $prefiliacionproc->registros_validos->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_registros_validos" id="z_registros_validos" value="="></span>
		</label>
		<div class="<?php echo $prefiliacionproc_search->RightColumnClass ?>"><div<?php echo $prefiliacionproc->registros_validos->cellAttributes() ?>>
			<span id="el_prefiliacionproc_registros_validos">
<input type="text" data-table="prefiliacionproc" data-field="x_registros_validos" name="x_registros_validos" id="x_registros_validos" size="30" placeholder="<?php echo HtmlEncode($prefiliacionproc->registros_validos->getPlaceHolder()) ?>" value="<?php echo $prefiliacionproc->registros_validos->EditValue ?>"<?php echo $prefiliacionproc->registros_validos->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($prefiliacionproc->errores->Visible) { // errores ?>
	<div id="r_errores" class="form-group row">
		<label for="x_errores" class="<?php echo $prefiliacionproc_search->LeftColumnClass ?>"><span id="elh_prefiliacionproc_errores"><?php echo $prefiliacionproc->errores->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_errores" id="z_errores" value="="></span>
		</label>
		<div class="<?php echo $prefiliacionproc_search->RightColumnClass ?>"><div<?php echo $prefiliacionproc->errores->cellAttributes() ?>>
			<span id="el_prefiliacionproc_errores">
<input type="text" data-table="prefiliacionproc" data-field="x_errores" name="x_errores" id="x_errores" size="30" placeholder="<?php echo HtmlEncode($prefiliacionproc->errores->getPlaceHolder()) ?>" value="<?php echo $prefiliacionproc->errores->EditValue ?>"<?php echo $prefiliacionproc->errores->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$prefiliacionproc_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $prefiliacionproc_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$prefiliacionproc_search->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$prefiliacionproc_search->terminate();
?>