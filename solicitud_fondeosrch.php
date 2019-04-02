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
$solicitud_fondeo_search = new solicitud_fondeo_search();

// Run the page
$solicitud_fondeo_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$solicitud_fondeo_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "search";
<?php if ($solicitud_fondeo_search->IsModal) { ?>
var fsolicitud_fondeosearch = currentAdvancedSearchForm = new ew.Form("fsolicitud_fondeosearch", "search");
<?php } else { ?>
var fsolicitud_fondeosearch = currentForm = new ew.Form("fsolicitud_fondeosearch", "search");
<?php } ?>

// Form_CustomValidate event
fsolicitud_fondeosearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fsolicitud_fondeosearch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fsolicitud_fondeosearch.lists["x_evaluacion[]"] = <?php echo $solicitud_fondeo_search->evaluacion->Lookup->toClientList() ?>;
fsolicitud_fondeosearch.lists["x_evaluacion[]"].options = <?php echo JsonEncode($solicitud_fondeo_search->evaluacion->options(FALSE, TRUE)) ?>;

// Form object for search
// Validate function for search

fsolicitud_fondeosearch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_id_solicitud");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($solicitud_fondeo->id_solicitud->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_fondeador");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($solicitud_fondeo->fondeador->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_monto");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($solicitud_fondeo->monto->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_plazo");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($solicitud_fondeo->plazo->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_fecha_fondeo");
	if (elm && !ew.checkDateDef(elm.value))
		return this.onError(elm, "<?php echo JsEncode($solicitud_fondeo->fecha_fondeo->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_estado_operacion");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($solicitud_fondeo->estado_operacion->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_vencimiento");
	if (elm && !ew.checkDateDef(elm.value))
		return this.onError(elm, "<?php echo JsEncode($solicitud_fondeo->vencimiento->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_pronostico_vencimiento");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($solicitud_fondeo->pronostico_vencimiento->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_fecha_solicitud");
	if (elm && !ew.checkDateDef(elm.value))
		return this.onError(elm, "<?php echo JsEncode($solicitud_fondeo->fecha_solicitud->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_compradorid_comprador");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($solicitud_fondeo->compradorid_comprador->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $solicitud_fondeo_search->showPageHeader(); ?>
<?php
$solicitud_fondeo_search->showMessage();
?>
<form name="fsolicitud_fondeosearch" id="fsolicitud_fondeosearch" class="<?php echo $solicitud_fondeo_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($solicitud_fondeo_search->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $solicitud_fondeo_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="solicitud_fondeo">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$solicitud_fondeo_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($solicitud_fondeo->id_solicitud->Visible) { // id_solicitud ?>
	<div id="r_id_solicitud" class="form-group row">
		<label for="x_id_solicitud" class="<?php echo $solicitud_fondeo_search->LeftColumnClass ?>"><span id="elh_solicitud_fondeo_id_solicitud"><?php echo $solicitud_fondeo->id_solicitud->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_id_solicitud" id="z_id_solicitud" value="="></span>
		</label>
		<div class="<?php echo $solicitud_fondeo_search->RightColumnClass ?>"><div<?php echo $solicitud_fondeo->id_solicitud->cellAttributes() ?>>
			<span id="el_solicitud_fondeo_id_solicitud">
<input type="text" data-table="solicitud_fondeo" data-field="x_id_solicitud" name="x_id_solicitud" id="x_id_solicitud" placeholder="<?php echo HtmlEncode($solicitud_fondeo->id_solicitud->getPlaceHolder()) ?>" value="<?php echo $solicitud_fondeo->id_solicitud->EditValue ?>"<?php echo $solicitud_fondeo->id_solicitud->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($solicitud_fondeo->fondeador->Visible) { // fondeador ?>
	<div id="r_fondeador" class="form-group row">
		<label for="x_fondeador" class="<?php echo $solicitud_fondeo_search->LeftColumnClass ?>"><span id="elh_solicitud_fondeo_fondeador"><?php echo $solicitud_fondeo->fondeador->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_fondeador" id="z_fondeador" value="="></span>
		</label>
		<div class="<?php echo $solicitud_fondeo_search->RightColumnClass ?>"><div<?php echo $solicitud_fondeo->fondeador->cellAttributes() ?>>
			<span id="el_solicitud_fondeo_fondeador">
<input type="text" data-table="solicitud_fondeo" data-field="x_fondeador" name="x_fondeador" id="x_fondeador" size="30" placeholder="<?php echo HtmlEncode($solicitud_fondeo->fondeador->getPlaceHolder()) ?>" value="<?php echo $solicitud_fondeo->fondeador->EditValue ?>"<?php echo $solicitud_fondeo->fondeador->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($solicitud_fondeo->monto->Visible) { // monto ?>
	<div id="r_monto" class="form-group row">
		<label for="x_monto" class="<?php echo $solicitud_fondeo_search->LeftColumnClass ?>"><span id="elh_solicitud_fondeo_monto"><?php echo $solicitud_fondeo->monto->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_monto" id="z_monto" value="="></span>
		</label>
		<div class="<?php echo $solicitud_fondeo_search->RightColumnClass ?>"><div<?php echo $solicitud_fondeo->monto->cellAttributes() ?>>
			<span id="el_solicitud_fondeo_monto">
<input type="text" data-table="solicitud_fondeo" data-field="x_monto" name="x_monto" id="x_monto" size="30" placeholder="<?php echo HtmlEncode($solicitud_fondeo->monto->getPlaceHolder()) ?>" value="<?php echo $solicitud_fondeo->monto->EditValue ?>"<?php echo $solicitud_fondeo->monto->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($solicitud_fondeo->plazo->Visible) { // plazo ?>
	<div id="r_plazo" class="form-group row">
		<label for="x_plazo" class="<?php echo $solicitud_fondeo_search->LeftColumnClass ?>"><span id="elh_solicitud_fondeo_plazo"><?php echo $solicitud_fondeo->plazo->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_plazo" id="z_plazo" value="="></span>
		</label>
		<div class="<?php echo $solicitud_fondeo_search->RightColumnClass ?>"><div<?php echo $solicitud_fondeo->plazo->cellAttributes() ?>>
			<span id="el_solicitud_fondeo_plazo">
<input type="text" data-table="solicitud_fondeo" data-field="x_plazo" name="x_plazo" id="x_plazo" size="30" placeholder="<?php echo HtmlEncode($solicitud_fondeo->plazo->getPlaceHolder()) ?>" value="<?php echo $solicitud_fondeo->plazo->EditValue ?>"<?php echo $solicitud_fondeo->plazo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($solicitud_fondeo->fecha_fondeo->Visible) { // fecha_fondeo ?>
	<div id="r_fecha_fondeo" class="form-group row">
		<label for="x_fecha_fondeo" class="<?php echo $solicitud_fondeo_search->LeftColumnClass ?>"><span id="elh_solicitud_fondeo_fecha_fondeo"><?php echo $solicitud_fondeo->fecha_fondeo->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_fecha_fondeo" id="z_fecha_fondeo" value="="></span>
		</label>
		<div class="<?php echo $solicitud_fondeo_search->RightColumnClass ?>"><div<?php echo $solicitud_fondeo->fecha_fondeo->cellAttributes() ?>>
			<span id="el_solicitud_fondeo_fecha_fondeo">
<input type="text" data-table="solicitud_fondeo" data-field="x_fecha_fondeo" name="x_fecha_fondeo" id="x_fecha_fondeo" placeholder="<?php echo HtmlEncode($solicitud_fondeo->fecha_fondeo->getPlaceHolder()) ?>" value="<?php echo $solicitud_fondeo->fecha_fondeo->EditValue ?>"<?php echo $solicitud_fondeo->fecha_fondeo->editAttributes() ?>>
<?php if (!$solicitud_fondeo->fecha_fondeo->ReadOnly && !$solicitud_fondeo->fecha_fondeo->Disabled && !isset($solicitud_fondeo->fecha_fondeo->EditAttrs["readonly"]) && !isset($solicitud_fondeo->fecha_fondeo->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fsolicitud_fondeosearch", "x_fecha_fondeo", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($solicitud_fondeo->estado_operacion->Visible) { // estado_operacion ?>
	<div id="r_estado_operacion" class="form-group row">
		<label for="x_estado_operacion" class="<?php echo $solicitud_fondeo_search->LeftColumnClass ?>"><span id="elh_solicitud_fondeo_estado_operacion"><?php echo $solicitud_fondeo->estado_operacion->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_estado_operacion" id="z_estado_operacion" value="="></span>
		</label>
		<div class="<?php echo $solicitud_fondeo_search->RightColumnClass ?>"><div<?php echo $solicitud_fondeo->estado_operacion->cellAttributes() ?>>
			<span id="el_solicitud_fondeo_estado_operacion">
<input type="text" data-table="solicitud_fondeo" data-field="x_estado_operacion" name="x_estado_operacion" id="x_estado_operacion" size="30" placeholder="<?php echo HtmlEncode($solicitud_fondeo->estado_operacion->getPlaceHolder()) ?>" value="<?php echo $solicitud_fondeo->estado_operacion->EditValue ?>"<?php echo $solicitud_fondeo->estado_operacion->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($solicitud_fondeo->vencimiento->Visible) { // vencimiento ?>
	<div id="r_vencimiento" class="form-group row">
		<label for="x_vencimiento" class="<?php echo $solicitud_fondeo_search->LeftColumnClass ?>"><span id="elh_solicitud_fondeo_vencimiento"><?php echo $solicitud_fondeo->vencimiento->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_vencimiento" id="z_vencimiento" value="="></span>
		</label>
		<div class="<?php echo $solicitud_fondeo_search->RightColumnClass ?>"><div<?php echo $solicitud_fondeo->vencimiento->cellAttributes() ?>>
			<span id="el_solicitud_fondeo_vencimiento">
<input type="text" data-table="solicitud_fondeo" data-field="x_vencimiento" name="x_vencimiento" id="x_vencimiento" placeholder="<?php echo HtmlEncode($solicitud_fondeo->vencimiento->getPlaceHolder()) ?>" value="<?php echo $solicitud_fondeo->vencimiento->EditValue ?>"<?php echo $solicitud_fondeo->vencimiento->editAttributes() ?>>
<?php if (!$solicitud_fondeo->vencimiento->ReadOnly && !$solicitud_fondeo->vencimiento->Disabled && !isset($solicitud_fondeo->vencimiento->EditAttrs["readonly"]) && !isset($solicitud_fondeo->vencimiento->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fsolicitud_fondeosearch", "x_vencimiento", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($solicitud_fondeo->pymerfc->Visible) { // pymerfc ?>
	<div id="r_pymerfc" class="form-group row">
		<label for="x_pymerfc" class="<?php echo $solicitud_fondeo_search->LeftColumnClass ?>"><span id="elh_solicitud_fondeo_pymerfc"><?php echo $solicitud_fondeo->pymerfc->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_pymerfc" id="z_pymerfc" value="LIKE"></span>
		</label>
		<div class="<?php echo $solicitud_fondeo_search->RightColumnClass ?>"><div<?php echo $solicitud_fondeo->pymerfc->cellAttributes() ?>>
			<span id="el_solicitud_fondeo_pymerfc">
<input type="text" data-table="solicitud_fondeo" data-field="x_pymerfc" name="x_pymerfc" id="x_pymerfc" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($solicitud_fondeo->pymerfc->getPlaceHolder()) ?>" value="<?php echo $solicitud_fondeo->pymerfc->EditValue ?>"<?php echo $solicitud_fondeo->pymerfc->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($solicitud_fondeo->compradorrfc->Visible) { // compradorrfc ?>
	<div id="r_compradorrfc" class="form-group row">
		<label for="x_compradorrfc" class="<?php echo $solicitud_fondeo_search->LeftColumnClass ?>"><span id="elh_solicitud_fondeo_compradorrfc"><?php echo $solicitud_fondeo->compradorrfc->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_compradorrfc" id="z_compradorrfc" value="LIKE"></span>
		</label>
		<div class="<?php echo $solicitud_fondeo_search->RightColumnClass ?>"><div<?php echo $solicitud_fondeo->compradorrfc->cellAttributes() ?>>
			<span id="el_solicitud_fondeo_compradorrfc">
<input type="text" data-table="solicitud_fondeo" data-field="x_compradorrfc" name="x_compradorrfc" id="x_compradorrfc" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($solicitud_fondeo->compradorrfc->getPlaceHolder()) ?>" value="<?php echo $solicitud_fondeo->compradorrfc->EditValue ?>"<?php echo $solicitud_fondeo->compradorrfc->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($solicitud_fondeo->facturarfc->Visible) { // facturarfc ?>
	<div id="r_facturarfc" class="form-group row">
		<label for="x_facturarfc" class="<?php echo $solicitud_fondeo_search->LeftColumnClass ?>"><span id="elh_solicitud_fondeo_facturarfc"><?php echo $solicitud_fondeo->facturarfc->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_facturarfc" id="z_facturarfc" value="LIKE"></span>
		</label>
		<div class="<?php echo $solicitud_fondeo_search->RightColumnClass ?>"><div<?php echo $solicitud_fondeo->facturarfc->cellAttributes() ?>>
			<span id="el_solicitud_fondeo_facturarfc">
<input type="text" data-table="solicitud_fondeo" data-field="x_facturarfc" name="x_facturarfc" id="x_facturarfc" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($solicitud_fondeo->facturarfc->getPlaceHolder()) ?>" value="<?php echo $solicitud_fondeo->facturarfc->EditValue ?>"<?php echo $solicitud_fondeo->facturarfc->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($solicitud_fondeo->pronostico_vencimiento->Visible) { // pronostico_vencimiento ?>
	<div id="r_pronostico_vencimiento" class="form-group row">
		<label for="x_pronostico_vencimiento" class="<?php echo $solicitud_fondeo_search->LeftColumnClass ?>"><span id="elh_solicitud_fondeo_pronostico_vencimiento"><?php echo $solicitud_fondeo->pronostico_vencimiento->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_pronostico_vencimiento" id="z_pronostico_vencimiento" value="="></span>
		</label>
		<div class="<?php echo $solicitud_fondeo_search->RightColumnClass ?>"><div<?php echo $solicitud_fondeo->pronostico_vencimiento->cellAttributes() ?>>
			<span id="el_solicitud_fondeo_pronostico_vencimiento">
<input type="text" data-table="solicitud_fondeo" data-field="x_pronostico_vencimiento" name="x_pronostico_vencimiento" id="x_pronostico_vencimiento" size="30" placeholder="<?php echo HtmlEncode($solicitud_fondeo->pronostico_vencimiento->getPlaceHolder()) ?>" value="<?php echo $solicitud_fondeo->pronostico_vencimiento->EditValue ?>"<?php echo $solicitud_fondeo->pronostico_vencimiento->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($solicitud_fondeo->evaluacion->Visible) { // evaluacion ?>
	<div id="r_evaluacion" class="form-group row">
		<label class="<?php echo $solicitud_fondeo_search->LeftColumnClass ?>"><span id="elh_solicitud_fondeo_evaluacion"><?php echo $solicitud_fondeo->evaluacion->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_evaluacion" id="z_evaluacion" value="="></span>
		</label>
		<div class="<?php echo $solicitud_fondeo_search->RightColumnClass ?>"><div<?php echo $solicitud_fondeo->evaluacion->cellAttributes() ?>>
			<span id="el_solicitud_fondeo_evaluacion">
<?php
$selwrk = (ConvertToBool($solicitud_fondeo->evaluacion->AdvancedSearch->SearchValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="solicitud_fondeo" data-field="x_evaluacion" name="x_evaluacion[]" id="x_evaluacion[]" value="1"<?php echo $selwrk ?><?php echo $solicitud_fondeo->evaluacion->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($solicitud_fondeo->fecha_solicitud->Visible) { // fecha_solicitud ?>
	<div id="r_fecha_solicitud" class="form-group row">
		<label for="x_fecha_solicitud" class="<?php echo $solicitud_fondeo_search->LeftColumnClass ?>"><span id="elh_solicitud_fondeo_fecha_solicitud"><?php echo $solicitud_fondeo->fecha_solicitud->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_fecha_solicitud" id="z_fecha_solicitud" value="="></span>
		</label>
		<div class="<?php echo $solicitud_fondeo_search->RightColumnClass ?>"><div<?php echo $solicitud_fondeo->fecha_solicitud->cellAttributes() ?>>
			<span id="el_solicitud_fondeo_fecha_solicitud">
<input type="text" data-table="solicitud_fondeo" data-field="x_fecha_solicitud" name="x_fecha_solicitud" id="x_fecha_solicitud" placeholder="<?php echo HtmlEncode($solicitud_fondeo->fecha_solicitud->getPlaceHolder()) ?>" value="<?php echo $solicitud_fondeo->fecha_solicitud->EditValue ?>"<?php echo $solicitud_fondeo->fecha_solicitud->editAttributes() ?>>
<?php if (!$solicitud_fondeo->fecha_solicitud->ReadOnly && !$solicitud_fondeo->fecha_solicitud->Disabled && !isset($solicitud_fondeo->fecha_solicitud->EditAttrs["readonly"]) && !isset($solicitud_fondeo->fecha_solicitud->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fsolicitud_fondeosearch", "x_fecha_solicitud", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($solicitud_fondeo->oferta->Visible) { // oferta ?>
	<div id="r_oferta" class="form-group row">
		<label for="x_oferta" class="<?php echo $solicitud_fondeo_search->LeftColumnClass ?>"><span id="elh_solicitud_fondeo_oferta"><?php echo $solicitud_fondeo->oferta->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_oferta" id="z_oferta" value="LIKE"></span>
		</label>
		<div class="<?php echo $solicitud_fondeo_search->RightColumnClass ?>"><div<?php echo $solicitud_fondeo->oferta->cellAttributes() ?>>
			<span id="el_solicitud_fondeo_oferta">
<input type="text" data-table="solicitud_fondeo" data-field="x_oferta" name="x_oferta" id="x_oferta" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($solicitud_fondeo->oferta->getPlaceHolder()) ?>" value="<?php echo $solicitud_fondeo->oferta->EditValue ?>"<?php echo $solicitud_fondeo->oferta->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($solicitud_fondeo->compradorid_comprador->Visible) { // compradorid_comprador ?>
	<div id="r_compradorid_comprador" class="form-group row">
		<label for="x_compradorid_comprador" class="<?php echo $solicitud_fondeo_search->LeftColumnClass ?>"><span id="elh_solicitud_fondeo_compradorid_comprador"><?php echo $solicitud_fondeo->compradorid_comprador->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_compradorid_comprador" id="z_compradorid_comprador" value="="></span>
		</label>
		<div class="<?php echo $solicitud_fondeo_search->RightColumnClass ?>"><div<?php echo $solicitud_fondeo->compradorid_comprador->cellAttributes() ?>>
			<span id="el_solicitud_fondeo_compradorid_comprador">
<input type="text" data-table="solicitud_fondeo" data-field="x_compradorid_comprador" name="x_compradorid_comprador" id="x_compradorid_comprador" size="30" placeholder="<?php echo HtmlEncode($solicitud_fondeo->compradorid_comprador->getPlaceHolder()) ?>" value="<?php echo $solicitud_fondeo->compradorid_comprador->EditValue ?>"<?php echo $solicitud_fondeo->compradorid_comprador->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$solicitud_fondeo_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $solicitud_fondeo_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$solicitud_fondeo_search->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$solicitud_fondeo_search->terminate();
?>