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
$pyme_search = new pyme_search();

// Run the page
$pyme_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pyme_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "search";
<?php if ($pyme_search->IsModal) { ?>
var fpymesearch = currentAdvancedSearchForm = new ew.Form("fpymesearch", "search");
<?php } else { ?>
var fpymesearch = currentForm = new ew.Form("fpymesearch", "search");
<?php } ?>

// Form_CustomValidate event
fpymesearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fpymesearch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fpymesearch.lists["x_compradorrfc"] = <?php echo $pyme_search->compradorrfc->Lookup->toClientList() ?>;
fpymesearch.lists["x_compradorrfc"].options = <?php echo JsonEncode($pyme_search->compradorrfc->lookupOptions()) ?>;
fpymesearch.autoSuggests["x_compradorrfc"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
// Validate function for search

fpymesearch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_id_pyme");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($pyme->id_pyme->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_codpostal");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($pyme->codpostal->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_pais");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($pyme->pais->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_preafiliacion");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($pyme->preafiliacion->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_edooperacionpyme");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($pyme->edooperacionpyme->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_comprador");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($pyme->comprador->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $pyme_search->showPageHeader(); ?>
<?php
$pyme_search->showMessage();
?>
<form name="fpymesearch" id="fpymesearch" class="<?php echo $pyme_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($pyme_search->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $pyme_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pyme">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$pyme_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($pyme->rfcpyme->Visible) { // rfcpyme ?>
	<div id="r_rfcpyme" class="form-group row">
		<label for="x_rfcpyme" class="<?php echo $pyme_search->LeftColumnClass ?>"><span id="elh_pyme_rfcpyme"><?php echo $pyme->rfcpyme->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_rfcpyme" id="z_rfcpyme" value="LIKE"></span>
		</label>
		<div class="<?php echo $pyme_search->RightColumnClass ?>"><div<?php echo $pyme->rfcpyme->cellAttributes() ?>>
			<span id="el_pyme_rfcpyme">
<input type="text" data-table="pyme" data-field="x_rfcpyme" name="x_rfcpyme" id="x_rfcpyme" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($pyme->rfcpyme->getPlaceHolder()) ?>" value="<?php echo $pyme->rfcpyme->EditValue ?>"<?php echo $pyme->rfcpyme->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($pyme->id_pyme->Visible) { // id_pyme ?>
	<div id="r_id_pyme" class="form-group row">
		<label for="x_id_pyme" class="<?php echo $pyme_search->LeftColumnClass ?>"><span id="elh_pyme_id_pyme"><?php echo $pyme->id_pyme->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_id_pyme" id="z_id_pyme" value="="></span>
		</label>
		<div class="<?php echo $pyme_search->RightColumnClass ?>"><div<?php echo $pyme->id_pyme->cellAttributes() ?>>
			<span id="el_pyme_id_pyme">
<input type="text" data-table="pyme" data-field="x_id_pyme" name="x_id_pyme" id="x_id_pyme" size="30" placeholder="<?php echo HtmlEncode($pyme->id_pyme->getPlaceHolder()) ?>" value="<?php echo $pyme->id_pyme->EditValue ?>"<?php echo $pyme->id_pyme->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($pyme->razon_social->Visible) { // razon_social ?>
	<div id="r_razon_social" class="form-group row">
		<label for="x_razon_social" class="<?php echo $pyme_search->LeftColumnClass ?>"><span id="elh_pyme_razon_social"><?php echo $pyme->razon_social->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_razon_social" id="z_razon_social" value="LIKE"></span>
		</label>
		<div class="<?php echo $pyme_search->RightColumnClass ?>"><div<?php echo $pyme->razon_social->cellAttributes() ?>>
			<span id="el_pyme_razon_social">
<input type="text" data-table="pyme" data-field="x_razon_social" name="x_razon_social" id="x_razon_social" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($pyme->razon_social->getPlaceHolder()) ?>" value="<?php echo $pyme->razon_social->EditValue ?>"<?php echo $pyme->razon_social->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($pyme->calle->Visible) { // calle ?>
	<div id="r_calle" class="form-group row">
		<label for="x_calle" class="<?php echo $pyme_search->LeftColumnClass ?>"><span id="elh_pyme_calle"><?php echo $pyme->calle->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_calle" id="z_calle" value="LIKE"></span>
		</label>
		<div class="<?php echo $pyme_search->RightColumnClass ?>"><div<?php echo $pyme->calle->cellAttributes() ?>>
			<span id="el_pyme_calle">
<input type="text" data-table="pyme" data-field="x_calle" name="x_calle" id="x_calle" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($pyme->calle->getPlaceHolder()) ?>" value="<?php echo $pyme->calle->EditValue ?>"<?php echo $pyme->calle->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($pyme->colonia->Visible) { // colonia ?>
	<div id="r_colonia" class="form-group row">
		<label for="x_colonia" class="<?php echo $pyme_search->LeftColumnClass ?>"><span id="elh_pyme_colonia"><?php echo $pyme->colonia->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_colonia" id="z_colonia" value="LIKE"></span>
		</label>
		<div class="<?php echo $pyme_search->RightColumnClass ?>"><div<?php echo $pyme->colonia->cellAttributes() ?>>
			<span id="el_pyme_colonia">
<input type="text" data-table="pyme" data-field="x_colonia" name="x_colonia" id="x_colonia" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($pyme->colonia->getPlaceHolder()) ?>" value="<?php echo $pyme->colonia->EditValue ?>"<?php echo $pyme->colonia->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($pyme->ciudad->Visible) { // ciudad ?>
	<div id="r_ciudad" class="form-group row">
		<label for="x_ciudad" class="<?php echo $pyme_search->LeftColumnClass ?>"><span id="elh_pyme_ciudad"><?php echo $pyme->ciudad->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_ciudad" id="z_ciudad" value="LIKE"></span>
		</label>
		<div class="<?php echo $pyme_search->RightColumnClass ?>"><div<?php echo $pyme->ciudad->cellAttributes() ?>>
			<span id="el_pyme_ciudad">
<input type="text" data-table="pyme" data-field="x_ciudad" name="x_ciudad" id="x_ciudad" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($pyme->ciudad->getPlaceHolder()) ?>" value="<?php echo $pyme->ciudad->EditValue ?>"<?php echo $pyme->ciudad->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($pyme->codpostal->Visible) { // codpostal ?>
	<div id="r_codpostal" class="form-group row">
		<label for="x_codpostal" class="<?php echo $pyme_search->LeftColumnClass ?>"><span id="elh_pyme_codpostal"><?php echo $pyme->codpostal->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_codpostal" id="z_codpostal" value="="></span>
		</label>
		<div class="<?php echo $pyme_search->RightColumnClass ?>"><div<?php echo $pyme->codpostal->cellAttributes() ?>>
			<span id="el_pyme_codpostal">
<input type="text" data-table="pyme" data-field="x_codpostal" name="x_codpostal" id="x_codpostal" size="30" placeholder="<?php echo HtmlEncode($pyme->codpostal->getPlaceHolder()) ?>" value="<?php echo $pyme->codpostal->EditValue ?>"<?php echo $pyme->codpostal->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($pyme->correo->Visible) { // correo ?>
	<div id="r_correo" class="form-group row">
		<label for="x_correo" class="<?php echo $pyme_search->LeftColumnClass ?>"><span id="elh_pyme_correo"><?php echo $pyme->correo->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_correo" id="z_correo" value="LIKE"></span>
		</label>
		<div class="<?php echo $pyme_search->RightColumnClass ?>"><div<?php echo $pyme->correo->cellAttributes() ?>>
			<span id="el_pyme_correo">
<input type="text" data-table="pyme" data-field="x_correo" name="x_correo" id="x_correo" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($pyme->correo->getPlaceHolder()) ?>" value="<?php echo $pyme->correo->EditValue ?>"<?php echo $pyme->correo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($pyme->telefono->Visible) { // telefono ?>
	<div id="r_telefono" class="form-group row">
		<label for="x_telefono" class="<?php echo $pyme_search->LeftColumnClass ?>"><span id="elh_pyme_telefono"><?php echo $pyme->telefono->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_telefono" id="z_telefono" value="LIKE"></span>
		</label>
		<div class="<?php echo $pyme_search->RightColumnClass ?>"><div<?php echo $pyme->telefono->cellAttributes() ?>>
			<span id="el_pyme_telefono">
<input type="text" data-table="pyme" data-field="x_telefono" name="x_telefono" id="x_telefono" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($pyme->telefono->getPlaceHolder()) ?>" value="<?php echo $pyme->telefono->EditValue ?>"<?php echo $pyme->telefono->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($pyme->pais->Visible) { // pais ?>
	<div id="r_pais" class="form-group row">
		<label for="x_pais" class="<?php echo $pyme_search->LeftColumnClass ?>"><span id="elh_pyme_pais"><?php echo $pyme->pais->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_pais" id="z_pais" value="="></span>
		</label>
		<div class="<?php echo $pyme_search->RightColumnClass ?>"><div<?php echo $pyme->pais->cellAttributes() ?>>
			<span id="el_pyme_pais">
<input type="text" data-table="pyme" data-field="x_pais" name="x_pais" id="x_pais" size="30" placeholder="<?php echo HtmlEncode($pyme->pais->getPlaceHolder()) ?>" value="<?php echo $pyme->pais->EditValue ?>"<?php echo $pyme->pais->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($pyme->preafiliacion->Visible) { // preafiliacion ?>
	<div id="r_preafiliacion" class="form-group row">
		<label for="x_preafiliacion" class="<?php echo $pyme_search->LeftColumnClass ?>"><span id="elh_pyme_preafiliacion"><?php echo $pyme->preafiliacion->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_preafiliacion" id="z_preafiliacion" value="="></span>
		</label>
		<div class="<?php echo $pyme_search->RightColumnClass ?>"><div<?php echo $pyme->preafiliacion->cellAttributes() ?>>
			<span id="el_pyme_preafiliacion">
<input type="text" data-table="pyme" data-field="x_preafiliacion" name="x_preafiliacion" id="x_preafiliacion" size="30" placeholder="<?php echo HtmlEncode($pyme->preafiliacion->getPlaceHolder()) ?>" value="<?php echo $pyme->preafiliacion->EditValue ?>"<?php echo $pyme->preafiliacion->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($pyme->edooperacionpyme->Visible) { // edooperacionpyme ?>
	<div id="r_edooperacionpyme" class="form-group row">
		<label for="x_edooperacionpyme" class="<?php echo $pyme_search->LeftColumnClass ?>"><span id="elh_pyme_edooperacionpyme"><?php echo $pyme->edooperacionpyme->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_edooperacionpyme" id="z_edooperacionpyme" value="="></span>
		</label>
		<div class="<?php echo $pyme_search->RightColumnClass ?>"><div<?php echo $pyme->edooperacionpyme->cellAttributes() ?>>
			<span id="el_pyme_edooperacionpyme">
<input type="text" data-table="pyme" data-field="x_edooperacionpyme" name="x_edooperacionpyme" id="x_edooperacionpyme" size="30" placeholder="<?php echo HtmlEncode($pyme->edooperacionpyme->getPlaceHolder()) ?>" value="<?php echo $pyme->edooperacionpyme->EditValue ?>"<?php echo $pyme->edooperacionpyme->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($pyme->compradorrfc->Visible) { // compradorrfc ?>
	<div id="r_compradorrfc" class="form-group row">
		<label class="<?php echo $pyme_search->LeftColumnClass ?>"><span id="elh_pyme_compradorrfc"><?php echo $pyme->compradorrfc->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_compradorrfc" id="z_compradorrfc" value="LIKE"></span>
		</label>
		<div class="<?php echo $pyme_search->RightColumnClass ?>"><div<?php echo $pyme->compradorrfc->cellAttributes() ?>>
			<span id="el_pyme_compradorrfc">
<?php
$wrkonchange = "" . trim(@$pyme->compradorrfc->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$pyme->compradorrfc->EditAttrs["onchange"] = "";
?>
<span id="as_x_compradorrfc" class="text-nowrap" style="z-index: 8860">
	<div class="input-group mb-3">
		<input type="text" class="form-control" name="sv_x_compradorrfc" id="sv_x_compradorrfc" value="<?php echo RemoveHtml($pyme->compradorrfc->EditValue) ?>" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($pyme->compradorrfc->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($pyme->compradorrfc->getPlaceHolder()) ?>"<?php echo $pyme->compradorrfc->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($pyme->compradorrfc->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_compradorrfc',m:0,n:50,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo (($pyme->compradorrfc->ReadOnly || $pyme->compradorrfc->Disabled) ? " disabled" : "")?>><i class="fa fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="pyme" data-field="x_compradorrfc" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $pyme->compradorrfc->displayValueSeparatorAttribute() ?>" name="x_compradorrfc" id="x_compradorrfc" value="<?php echo HtmlEncode($pyme->compradorrfc->AdvancedSearch->SearchValue) ?>"<?php echo $wrkonchange ?>>
<script>
fpymesearch.createAutoSuggest({"id":"x_compradorrfc","forceSelect":false});
</script>
<?php echo $pyme->compradorrfc->Lookup->getParamTag("p_x_compradorrfc") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($pyme->comprador->Visible) { // comprador ?>
	<div id="r_comprador" class="form-group row">
		<label for="x_comprador" class="<?php echo $pyme_search->LeftColumnClass ?>"><span id="elh_pyme_comprador"><?php echo $pyme->comprador->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_comprador" id="z_comprador" value="="></span>
		</label>
		<div class="<?php echo $pyme_search->RightColumnClass ?>"><div<?php echo $pyme->comprador->cellAttributes() ?>>
			<span id="el_pyme_comprador">
<input type="text" data-table="pyme" data-field="x_comprador" name="x_comprador" id="x_comprador" size="30" placeholder="<?php echo HtmlEncode($pyme->comprador->getPlaceHolder()) ?>" value="<?php echo $pyme->comprador->EditValue ?>"<?php echo $pyme->comprador->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$pyme_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $pyme_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$pyme_search->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$pyme_search->terminate();
?>