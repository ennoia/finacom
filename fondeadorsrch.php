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
$fondeador_search = new fondeador_search();

// Run the page
$fondeador_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$fondeador_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "search";
<?php if ($fondeador_search->IsModal) { ?>
var ffondeadorsearch = currentAdvancedSearchForm = new ew.Form("ffondeadorsearch", "search");
<?php } else { ?>
var ffondeadorsearch = currentForm = new ew.Form("ffondeadorsearch", "search");
<?php } ?>

// Form_CustomValidate event
ffondeadorsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ffondeadorsearch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search
// Validate function for search

ffondeadorsearch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_id_fondeador");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($fondeador->id_fondeador->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_colonia");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($fondeador->colonia->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_codpostal");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($fondeador->codpostal->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_pais");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($fondeador->pais->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_fondeadorfactura");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($fondeador->fondeadorfactura->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_calificacion");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($fondeador->calificacion->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_cedooperacionfondeador");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($fondeador->cedooperacionfondeador->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $fondeador_search->showPageHeader(); ?>
<?php
$fondeador_search->showMessage();
?>
<form name="ffondeadorsearch" id="ffondeadorsearch" class="<?php echo $fondeador_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($fondeador_search->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $fondeador_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="fondeador">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$fondeador_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($fondeador->id_fondeador->Visible) { // id_fondeador ?>
	<div id="r_id_fondeador" class="form-group row">
		<label for="x_id_fondeador" class="<?php echo $fondeador_search->LeftColumnClass ?>"><span id="elh_fondeador_id_fondeador"><?php echo $fondeador->id_fondeador->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_id_fondeador" id="z_id_fondeador" value="="></span>
		</label>
		<div class="<?php echo $fondeador_search->RightColumnClass ?>"><div<?php echo $fondeador->id_fondeador->cellAttributes() ?>>
			<span id="el_fondeador_id_fondeador">
<input type="text" data-table="fondeador" data-field="x_id_fondeador" name="x_id_fondeador" id="x_id_fondeador" size="30" placeholder="<?php echo HtmlEncode($fondeador->id_fondeador->getPlaceHolder()) ?>" value="<?php echo $fondeador->id_fondeador->EditValue ?>"<?php echo $fondeador->id_fondeador->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($fondeador->rfcfondeador->Visible) { // rfcfondeador ?>
	<div id="r_rfcfondeador" class="form-group row">
		<label for="x_rfcfondeador" class="<?php echo $fondeador_search->LeftColumnClass ?>"><span id="elh_fondeador_rfcfondeador"><?php echo $fondeador->rfcfondeador->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_rfcfondeador" id="z_rfcfondeador" value="LIKE"></span>
		</label>
		<div class="<?php echo $fondeador_search->RightColumnClass ?>"><div<?php echo $fondeador->rfcfondeador->cellAttributes() ?>>
			<span id="el_fondeador_rfcfondeador">
<input type="text" data-table="fondeador" data-field="x_rfcfondeador" name="x_rfcfondeador" id="x_rfcfondeador" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($fondeador->rfcfondeador->getPlaceHolder()) ?>" value="<?php echo $fondeador->rfcfondeador->EditValue ?>"<?php echo $fondeador->rfcfondeador->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($fondeador->razon_social->Visible) { // razon_social ?>
	<div id="r_razon_social" class="form-group row">
		<label for="x_razon_social" class="<?php echo $fondeador_search->LeftColumnClass ?>"><span id="elh_fondeador_razon_social"><?php echo $fondeador->razon_social->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_razon_social" id="z_razon_social" value="LIKE"></span>
		</label>
		<div class="<?php echo $fondeador_search->RightColumnClass ?>"><div<?php echo $fondeador->razon_social->cellAttributes() ?>>
			<span id="el_fondeador_razon_social">
<input type="text" data-table="fondeador" data-field="x_razon_social" name="x_razon_social" id="x_razon_social" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($fondeador->razon_social->getPlaceHolder()) ?>" value="<?php echo $fondeador->razon_social->EditValue ?>"<?php echo $fondeador->razon_social->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($fondeador->calle->Visible) { // calle ?>
	<div id="r_calle" class="form-group row">
		<label for="x_calle" class="<?php echo $fondeador_search->LeftColumnClass ?>"><span id="elh_fondeador_calle"><?php echo $fondeador->calle->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_calle" id="z_calle" value="LIKE"></span>
		</label>
		<div class="<?php echo $fondeador_search->RightColumnClass ?>"><div<?php echo $fondeador->calle->cellAttributes() ?>>
			<span id="el_fondeador_calle">
<input type="text" data-table="fondeador" data-field="x_calle" name="x_calle" id="x_calle" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($fondeador->calle->getPlaceHolder()) ?>" value="<?php echo $fondeador->calle->EditValue ?>"<?php echo $fondeador->calle->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($fondeador->colonia->Visible) { // colonia ?>
	<div id="r_colonia" class="form-group row">
		<label for="x_colonia" class="<?php echo $fondeador_search->LeftColumnClass ?>"><span id="elh_fondeador_colonia"><?php echo $fondeador->colonia->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_colonia" id="z_colonia" value="="></span>
		</label>
		<div class="<?php echo $fondeador_search->RightColumnClass ?>"><div<?php echo $fondeador->colonia->cellAttributes() ?>>
			<span id="el_fondeador_colonia">
<input type="text" data-table="fondeador" data-field="x_colonia" name="x_colonia" id="x_colonia" size="30" placeholder="<?php echo HtmlEncode($fondeador->colonia->getPlaceHolder()) ?>" value="<?php echo $fondeador->colonia->EditValue ?>"<?php echo $fondeador->colonia->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($fondeador->ciudad->Visible) { // ciudad ?>
	<div id="r_ciudad" class="form-group row">
		<label for="x_ciudad" class="<?php echo $fondeador_search->LeftColumnClass ?>"><span id="elh_fondeador_ciudad"><?php echo $fondeador->ciudad->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_ciudad" id="z_ciudad" value="LIKE"></span>
		</label>
		<div class="<?php echo $fondeador_search->RightColumnClass ?>"><div<?php echo $fondeador->ciudad->cellAttributes() ?>>
			<span id="el_fondeador_ciudad">
<input type="text" data-table="fondeador" data-field="x_ciudad" name="x_ciudad" id="x_ciudad" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($fondeador->ciudad->getPlaceHolder()) ?>" value="<?php echo $fondeador->ciudad->EditValue ?>"<?php echo $fondeador->ciudad->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($fondeador->codpostal->Visible) { // codpostal ?>
	<div id="r_codpostal" class="form-group row">
		<label for="x_codpostal" class="<?php echo $fondeador_search->LeftColumnClass ?>"><span id="elh_fondeador_codpostal"><?php echo $fondeador->codpostal->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_codpostal" id="z_codpostal" value="="></span>
		</label>
		<div class="<?php echo $fondeador_search->RightColumnClass ?>"><div<?php echo $fondeador->codpostal->cellAttributes() ?>>
			<span id="el_fondeador_codpostal">
<input type="text" data-table="fondeador" data-field="x_codpostal" name="x_codpostal" id="x_codpostal" size="30" placeholder="<?php echo HtmlEncode($fondeador->codpostal->getPlaceHolder()) ?>" value="<?php echo $fondeador->codpostal->EditValue ?>"<?php echo $fondeador->codpostal->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($fondeador->telefono->Visible) { // telefono ?>
	<div id="r_telefono" class="form-group row">
		<label for="x_telefono" class="<?php echo $fondeador_search->LeftColumnClass ?>"><span id="elh_fondeador_telefono"><?php echo $fondeador->telefono->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_telefono" id="z_telefono" value="LIKE"></span>
		</label>
		<div class="<?php echo $fondeador_search->RightColumnClass ?>"><div<?php echo $fondeador->telefono->cellAttributes() ?>>
			<span id="el_fondeador_telefono">
<input type="text" data-table="fondeador" data-field="x_telefono" name="x_telefono" id="x_telefono" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($fondeador->telefono->getPlaceHolder()) ?>" value="<?php echo $fondeador->telefono->EditValue ?>"<?php echo $fondeador->telefono->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($fondeador->correo->Visible) { // correo ?>
	<div id="r_correo" class="form-group row">
		<label for="x_correo" class="<?php echo $fondeador_search->LeftColumnClass ?>"><span id="elh_fondeador_correo"><?php echo $fondeador->correo->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_correo" id="z_correo" value="LIKE"></span>
		</label>
		<div class="<?php echo $fondeador_search->RightColumnClass ?>"><div<?php echo $fondeador->correo->cellAttributes() ?>>
			<span id="el_fondeador_correo">
<input type="text" data-table="fondeador" data-field="x_correo" name="x_correo" id="x_correo" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($fondeador->correo->getPlaceHolder()) ?>" value="<?php echo $fondeador->correo->EditValue ?>"<?php echo $fondeador->correo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($fondeador->pais->Visible) { // pais ?>
	<div id="r_pais" class="form-group row">
		<label for="x_pais" class="<?php echo $fondeador_search->LeftColumnClass ?>"><span id="elh_fondeador_pais"><?php echo $fondeador->pais->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_pais" id="z_pais" value="="></span>
		</label>
		<div class="<?php echo $fondeador_search->RightColumnClass ?>"><div<?php echo $fondeador->pais->cellAttributes() ?>>
			<span id="el_fondeador_pais">
<input type="text" data-table="fondeador" data-field="x_pais" name="x_pais" id="x_pais" size="30" placeholder="<?php echo HtmlEncode($fondeador->pais->getPlaceHolder()) ?>" value="<?php echo $fondeador->pais->EditValue ?>"<?php echo $fondeador->pais->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($fondeador->fondeadorfactura->Visible) { // fondeadorfactura ?>
	<div id="r_fondeadorfactura" class="form-group row">
		<label for="x_fondeadorfactura" class="<?php echo $fondeador_search->LeftColumnClass ?>"><span id="elh_fondeador_fondeadorfactura"><?php echo $fondeador->fondeadorfactura->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_fondeadorfactura" id="z_fondeadorfactura" value="="></span>
		</label>
		<div class="<?php echo $fondeador_search->RightColumnClass ?>"><div<?php echo $fondeador->fondeadorfactura->cellAttributes() ?>>
			<span id="el_fondeador_fondeadorfactura">
<input type="text" data-table="fondeador" data-field="x_fondeadorfactura" name="x_fondeadorfactura" id="x_fondeadorfactura" size="30" placeholder="<?php echo HtmlEncode($fondeador->fondeadorfactura->getPlaceHolder()) ?>" value="<?php echo $fondeador->fondeadorfactura->EditValue ?>"<?php echo $fondeador->fondeadorfactura->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($fondeador->calificacion->Visible) { // calificacion ?>
	<div id="r_calificacion" class="form-group row">
		<label for="x_calificacion" class="<?php echo $fondeador_search->LeftColumnClass ?>"><span id="elh_fondeador_calificacion"><?php echo $fondeador->calificacion->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_calificacion" id="z_calificacion" value="="></span>
		</label>
		<div class="<?php echo $fondeador_search->RightColumnClass ?>"><div<?php echo $fondeador->calificacion->cellAttributes() ?>>
			<span id="el_fondeador_calificacion">
<input type="text" data-table="fondeador" data-field="x_calificacion" name="x_calificacion" id="x_calificacion" size="30" placeholder="<?php echo HtmlEncode($fondeador->calificacion->getPlaceHolder()) ?>" value="<?php echo $fondeador->calificacion->EditValue ?>"<?php echo $fondeador->calificacion->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($fondeador->cedooperacionfondeador->Visible) { // cedooperacionfondeador ?>
	<div id="r_cedooperacionfondeador" class="form-group row">
		<label for="x_cedooperacionfondeador" class="<?php echo $fondeador_search->LeftColumnClass ?>"><span id="elh_fondeador_cedooperacionfondeador"><?php echo $fondeador->cedooperacionfondeador->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_cedooperacionfondeador" id="z_cedooperacionfondeador" value="="></span>
		</label>
		<div class="<?php echo $fondeador_search->RightColumnClass ?>"><div<?php echo $fondeador->cedooperacionfondeador->cellAttributes() ?>>
			<span id="el_fondeador_cedooperacionfondeador">
<input type="text" data-table="fondeador" data-field="x_cedooperacionfondeador" name="x_cedooperacionfondeador" id="x_cedooperacionfondeador" size="30" placeholder="<?php echo HtmlEncode($fondeador->cedooperacionfondeador->getPlaceHolder()) ?>" value="<?php echo $fondeador->cedooperacionfondeador->EditValue ?>"<?php echo $fondeador->cedooperacionfondeador->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($fondeador->pymerfc->Visible) { // pymerfc ?>
	<div id="r_pymerfc" class="form-group row">
		<label for="x_pymerfc" class="<?php echo $fondeador_search->LeftColumnClass ?>"><span id="elh_fondeador_pymerfc"><?php echo $fondeador->pymerfc->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_pymerfc" id="z_pymerfc" value="LIKE"></span>
		</label>
		<div class="<?php echo $fondeador_search->RightColumnClass ?>"><div<?php echo $fondeador->pymerfc->cellAttributes() ?>>
			<span id="el_fondeador_pymerfc">
<input type="text" data-table="fondeador" data-field="x_pymerfc" name="x_pymerfc" id="x_pymerfc" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($fondeador->pymerfc->getPlaceHolder()) ?>" value="<?php echo $fondeador->pymerfc->EditValue ?>"<?php echo $fondeador->pymerfc->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$fondeador_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $fondeador_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$fondeador_search->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$fondeador_search->terminate();
?>