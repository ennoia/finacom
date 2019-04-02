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
$comprador_search = new comprador_search();

// Run the page
$comprador_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$comprador_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "search";
<?php if ($comprador_search->IsModal) { ?>
var fcompradorsearch = currentAdvancedSearchForm = new ew.Form("fcompradorsearch", "search");
<?php } else { ?>
var fcompradorsearch = currentForm = new ew.Form("fcompradorsearch", "search");
<?php } ?>

// Form_CustomValidate event
fcompradorsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcompradorsearch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcompradorsearch.lists["x_pymerfc"] = <?php echo $comprador_search->pymerfc->Lookup->toClientList() ?>;
fcompradorsearch.lists["x_pymerfc"].options = <?php echo JsonEncode($comprador_search->pymerfc->lookupOptions()) ?>;
fcompradorsearch.autoSuggests["x_pymerfc"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
// Validate function for search

fcompradorsearch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_id_comprador");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($comprador->id_comprador->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_codpostal");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($comprador->codpostal->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_pais");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($comprador->pais->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_pymerfc");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($comprador->pymerfc->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $comprador_search->showPageHeader(); ?>
<?php
$comprador_search->showMessage();
?>
<form name="fcompradorsearch" id="fcompradorsearch" class="<?php echo $comprador_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($comprador_search->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $comprador_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="comprador">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$comprador_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($comprador->id_comprador->Visible) { // id_comprador ?>
	<div id="r_id_comprador" class="form-group row">
		<label for="x_id_comprador" class="<?php echo $comprador_search->LeftColumnClass ?>"><span id="elh_comprador_id_comprador"><?php echo $comprador->id_comprador->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_id_comprador" id="z_id_comprador" value="="></span>
		</label>
		<div class="<?php echo $comprador_search->RightColumnClass ?>"><div<?php echo $comprador->id_comprador->cellAttributes() ?>>
			<span id="el_comprador_id_comprador">
<input type="text" data-table="comprador" data-field="x_id_comprador" name="x_id_comprador" id="x_id_comprador" size="30" placeholder="<?php echo HtmlEncode($comprador->id_comprador->getPlaceHolder()) ?>" value="<?php echo $comprador->id_comprador->EditValue ?>"<?php echo $comprador->id_comprador->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($comprador->razon_social->Visible) { // razon_social ?>
	<div id="r_razon_social" class="form-group row">
		<label for="x_razon_social" class="<?php echo $comprador_search->LeftColumnClass ?>"><span id="elh_comprador_razon_social"><?php echo $comprador->razon_social->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_razon_social" id="z_razon_social" value="LIKE"></span>
		</label>
		<div class="<?php echo $comprador_search->RightColumnClass ?>"><div<?php echo $comprador->razon_social->cellAttributes() ?>>
			<span id="el_comprador_razon_social">
<input type="text" data-table="comprador" data-field="x_razon_social" name="x_razon_social" id="x_razon_social" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($comprador->razon_social->getPlaceHolder()) ?>" value="<?php echo $comprador->razon_social->EditValue ?>"<?php echo $comprador->razon_social->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($comprador->rfc->Visible) { // rfc ?>
	<div id="r_rfc" class="form-group row">
		<label for="x_rfc" class="<?php echo $comprador_search->LeftColumnClass ?>"><span id="elh_comprador_rfc"><?php echo $comprador->rfc->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_rfc" id="z_rfc" value="LIKE"></span>
		</label>
		<div class="<?php echo $comprador_search->RightColumnClass ?>"><div<?php echo $comprador->rfc->cellAttributes() ?>>
			<span id="el_comprador_rfc">
<input type="text" data-table="comprador" data-field="x_rfc" name="x_rfc" id="x_rfc" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($comprador->rfc->getPlaceHolder()) ?>" value="<?php echo $comprador->rfc->EditValue ?>"<?php echo $comprador->rfc->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($comprador->calle->Visible) { // calle ?>
	<div id="r_calle" class="form-group row">
		<label for="x_calle" class="<?php echo $comprador_search->LeftColumnClass ?>"><span id="elh_comprador_calle"><?php echo $comprador->calle->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_calle" id="z_calle" value="LIKE"></span>
		</label>
		<div class="<?php echo $comprador_search->RightColumnClass ?>"><div<?php echo $comprador->calle->cellAttributes() ?>>
			<span id="el_comprador_calle">
<input type="text" data-table="comprador" data-field="x_calle" name="x_calle" id="x_calle" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($comprador->calle->getPlaceHolder()) ?>" value="<?php echo $comprador->calle->EditValue ?>"<?php echo $comprador->calle->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($comprador->colonia->Visible) { // colonia ?>
	<div id="r_colonia" class="form-group row">
		<label for="x_colonia" class="<?php echo $comprador_search->LeftColumnClass ?>"><span id="elh_comprador_colonia"><?php echo $comprador->colonia->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_colonia" id="z_colonia" value="LIKE"></span>
		</label>
		<div class="<?php echo $comprador_search->RightColumnClass ?>"><div<?php echo $comprador->colonia->cellAttributes() ?>>
			<span id="el_comprador_colonia">
<input type="text" data-table="comprador" data-field="x_colonia" name="x_colonia" id="x_colonia" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($comprador->colonia->getPlaceHolder()) ?>" value="<?php echo $comprador->colonia->EditValue ?>"<?php echo $comprador->colonia->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($comprador->codpostal->Visible) { // codpostal ?>
	<div id="r_codpostal" class="form-group row">
		<label for="x_codpostal" class="<?php echo $comprador_search->LeftColumnClass ?>"><span id="elh_comprador_codpostal"><?php echo $comprador->codpostal->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_codpostal" id="z_codpostal" value="="></span>
		</label>
		<div class="<?php echo $comprador_search->RightColumnClass ?>"><div<?php echo $comprador->codpostal->cellAttributes() ?>>
			<span id="el_comprador_codpostal">
<input type="text" data-table="comprador" data-field="x_codpostal" name="x_codpostal" id="x_codpostal" size="30" placeholder="<?php echo HtmlEncode($comprador->codpostal->getPlaceHolder()) ?>" value="<?php echo $comprador->codpostal->EditValue ?>"<?php echo $comprador->codpostal->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($comprador->ciudad->Visible) { // ciudad ?>
	<div id="r_ciudad" class="form-group row">
		<label for="x_ciudad" class="<?php echo $comprador_search->LeftColumnClass ?>"><span id="elh_comprador_ciudad"><?php echo $comprador->ciudad->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_ciudad" id="z_ciudad" value="LIKE"></span>
		</label>
		<div class="<?php echo $comprador_search->RightColumnClass ?>"><div<?php echo $comprador->ciudad->cellAttributes() ?>>
			<span id="el_comprador_ciudad">
<input type="text" data-table="comprador" data-field="x_ciudad" name="x_ciudad" id="x_ciudad" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($comprador->ciudad->getPlaceHolder()) ?>" value="<?php echo $comprador->ciudad->EditValue ?>"<?php echo $comprador->ciudad->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($comprador->telefono->Visible) { // telefono ?>
	<div id="r_telefono" class="form-group row">
		<label for="x_telefono" class="<?php echo $comprador_search->LeftColumnClass ?>"><span id="elh_comprador_telefono"><?php echo $comprador->telefono->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_telefono" id="z_telefono" value="LIKE"></span>
		</label>
		<div class="<?php echo $comprador_search->RightColumnClass ?>"><div<?php echo $comprador->telefono->cellAttributes() ?>>
			<span id="el_comprador_telefono">
<input type="text" data-table="comprador" data-field="x_telefono" name="x_telefono" id="x_telefono" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($comprador->telefono->getPlaceHolder()) ?>" value="<?php echo $comprador->telefono->EditValue ?>"<?php echo $comprador->telefono->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($comprador->correo->Visible) { // correo ?>
	<div id="r_correo" class="form-group row">
		<label for="x_correo" class="<?php echo $comprador_search->LeftColumnClass ?>"><span id="elh_comprador_correo"><?php echo $comprador->correo->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_correo" id="z_correo" value="LIKE"></span>
		</label>
		<div class="<?php echo $comprador_search->RightColumnClass ?>"><div<?php echo $comprador->correo->cellAttributes() ?>>
			<span id="el_comprador_correo">
<input type="text" data-table="comprador" data-field="x_correo" name="x_correo" id="x_correo" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($comprador->correo->getPlaceHolder()) ?>" value="<?php echo $comprador->correo->EditValue ?>"<?php echo $comprador->correo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($comprador->pais->Visible) { // pais ?>
	<div id="r_pais" class="form-group row">
		<label for="x_pais" class="<?php echo $comprador_search->LeftColumnClass ?>"><span id="elh_comprador_pais"><?php echo $comprador->pais->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_pais" id="z_pais" value="="></span>
		</label>
		<div class="<?php echo $comprador_search->RightColumnClass ?>"><div<?php echo $comprador->pais->cellAttributes() ?>>
			<span id="el_comprador_pais">
<input type="text" data-table="comprador" data-field="x_pais" name="x_pais" id="x_pais" size="30" placeholder="<?php echo HtmlEncode($comprador->pais->getPlaceHolder()) ?>" value="<?php echo $comprador->pais->EditValue ?>"<?php echo $comprador->pais->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($comprador->pymerfc->Visible) { // pymerfc ?>
	<div id="r_pymerfc" class="form-group row">
		<label class="<?php echo $comprador_search->LeftColumnClass ?>"><span id="elh_comprador_pymerfc"><?php echo $comprador->pymerfc->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_pymerfc" id="z_pymerfc" value="="></span>
		</label>
		<div class="<?php echo $comprador_search->RightColumnClass ?>"><div<?php echo $comprador->pymerfc->cellAttributes() ?>>
			<span id="el_comprador_pymerfc">
<?php
$wrkonchange = "" . trim(@$comprador->pymerfc->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$comprador->pymerfc->EditAttrs["onchange"] = "";
?>
<span id="as_x_pymerfc" class="text-nowrap" style="z-index: 8890">
	<div class="input-group mb-3">
		<input type="text" class="form-control" name="sv_x_pymerfc" id="sv_x_pymerfc" value="<?php echo RemoveHtml($comprador->pymerfc->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($comprador->pymerfc->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($comprador->pymerfc->getPlaceHolder()) ?>"<?php echo $comprador->pymerfc->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($comprador->pymerfc->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_pymerfc',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo (($comprador->pymerfc->ReadOnly || $comprador->pymerfc->Disabled) ? " disabled" : "")?>><i class="fa fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="comprador" data-field="x_pymerfc" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $comprador->pymerfc->displayValueSeparatorAttribute() ?>" name="x_pymerfc" id="x_pymerfc" value="<?php echo HtmlEncode($comprador->pymerfc->AdvancedSearch->SearchValue) ?>"<?php echo $wrkonchange ?>>
<script>
fcompradorsearch.createAutoSuggest({"id":"x_pymerfc","forceSelect":false});
</script>
<?php echo $comprador->pymerfc->Lookup->getParamTag("p_x_pymerfc") ?>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$comprador_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $comprador_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$comprador_search->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$comprador_search->terminate();
?>