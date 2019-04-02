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
$preafiliacion_search = new preafiliacion_search();

// Run the page
$preafiliacion_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$preafiliacion_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "search";
<?php if ($preafiliacion_search->IsModal) { ?>
var fpreafiliacionsearch = currentAdvancedSearchForm = new ew.Form("fpreafiliacionsearch", "search");
<?php } else { ?>
var fpreafiliacionsearch = currentForm = new ew.Form("fpreafiliacionsearch", "search");
<?php } ?>

// Form_CustomValidate event
fpreafiliacionsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fpreafiliacionsearch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fpreafiliacionsearch.lists["x_estadopreaafilia"] = <?php echo $preafiliacion_search->estadopreaafilia->Lookup->toClientList() ?>;
fpreafiliacionsearch.lists["x_estadopreaafilia"].options = <?php echo JsonEncode($preafiliacion_search->estadopreaafilia->lookupOptions()) ?>;
fpreafiliacionsearch.autoSuggests["x_estadopreaafilia"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
// Validate function for search

fpreafiliacionsearch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_idafiliado");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($preafiliacion->idafiliado->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_fechaafiliacion");
	if (elm && !ew.checkDateDef(elm.value))
		return this.onError(elm, "<?php echo JsEncode($preafiliacion->fechaafiliacion->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_estadopreaafilia");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($preafiliacion->estadopreaafilia->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $preafiliacion_search->showPageHeader(); ?>
<?php
$preafiliacion_search->showMessage();
?>
<form name="fpreafiliacionsearch" id="fpreafiliacionsearch" class="<?php echo $preafiliacion_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($preafiliacion_search->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $preafiliacion_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="preafiliacion">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$preafiliacion_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($preafiliacion->idafiliado->Visible) { // idafiliado ?>
	<div id="r_idafiliado" class="form-group row">
		<label for="x_idafiliado" class="<?php echo $preafiliacion_search->LeftColumnClass ?>"><span id="elh_preafiliacion_idafiliado"><?php echo $preafiliacion->idafiliado->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_idafiliado" id="z_idafiliado" value="="></span>
		</label>
		<div class="<?php echo $preafiliacion_search->RightColumnClass ?>"><div<?php echo $preafiliacion->idafiliado->cellAttributes() ?>>
			<span id="el_preafiliacion_idafiliado">
<input type="text" data-table="preafiliacion" data-field="x_idafiliado" name="x_idafiliado" id="x_idafiliado" placeholder="<?php echo HtmlEncode($preafiliacion->idafiliado->getPlaceHolder()) ?>" value="<?php echo $preafiliacion->idafiliado->EditValue ?>"<?php echo $preafiliacion->idafiliado->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($preafiliacion->tipoentidad->Visible) { // tipoentidad ?>
	<div id="r_tipoentidad" class="form-group row">
		<label for="x_tipoentidad" class="<?php echo $preafiliacion_search->LeftColumnClass ?>"><span id="elh_preafiliacion_tipoentidad"><?php echo $preafiliacion->tipoentidad->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_tipoentidad" id="z_tipoentidad" value="LIKE"></span>
		</label>
		<div class="<?php echo $preafiliacion_search->RightColumnClass ?>"><div<?php echo $preafiliacion->tipoentidad->cellAttributes() ?>>
			<span id="el_preafiliacion_tipoentidad">
<input type="text" data-table="preafiliacion" data-field="x_tipoentidad" name="x_tipoentidad" id="x_tipoentidad" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($preafiliacion->tipoentidad->getPlaceHolder()) ?>" value="<?php echo $preafiliacion->tipoentidad->EditValue ?>"<?php echo $preafiliacion->tipoentidad->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($preafiliacion->fechaafiliacion->Visible) { // fechaafiliacion ?>
	<div id="r_fechaafiliacion" class="form-group row">
		<label for="x_fechaafiliacion" class="<?php echo $preafiliacion_search->LeftColumnClass ?>"><span id="elh_preafiliacion_fechaafiliacion"><?php echo $preafiliacion->fechaafiliacion->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_fechaafiliacion" id="z_fechaafiliacion" value="="></span>
		</label>
		<div class="<?php echo $preafiliacion_search->RightColumnClass ?>"><div<?php echo $preafiliacion->fechaafiliacion->cellAttributes() ?>>
			<span id="el_preafiliacion_fechaafiliacion">
<input type="text" data-table="preafiliacion" data-field="x_fechaafiliacion" name="x_fechaafiliacion" id="x_fechaafiliacion" placeholder="<?php echo HtmlEncode($preafiliacion->fechaafiliacion->getPlaceHolder()) ?>" value="<?php echo $preafiliacion->fechaafiliacion->EditValue ?>"<?php echo $preafiliacion->fechaafiliacion->editAttributes() ?>>
<?php if (!$preafiliacion->fechaafiliacion->ReadOnly && !$preafiliacion->fechaafiliacion->Disabled && !isset($preafiliacion->fechaafiliacion->EditAttrs["readonly"]) && !isset($preafiliacion->fechaafiliacion->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fpreafiliacionsearch", "x_fechaafiliacion", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($preafiliacion->nombrerazon->Visible) { // nombrerazon ?>
	<div id="r_nombrerazon" class="form-group row">
		<label for="x_nombrerazon" class="<?php echo $preafiliacion_search->LeftColumnClass ?>"><span id="elh_preafiliacion_nombrerazon"><?php echo $preafiliacion->nombrerazon->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_nombrerazon" id="z_nombrerazon" value="LIKE"></span>
		</label>
		<div class="<?php echo $preafiliacion_search->RightColumnClass ?>"><div<?php echo $preafiliacion->nombrerazon->cellAttributes() ?>>
			<span id="el_preafiliacion_nombrerazon">
<input type="text" data-table="preafiliacion" data-field="x_nombrerazon" name="x_nombrerazon" id="x_nombrerazon" size="30" maxlength="90" placeholder="<?php echo HtmlEncode($preafiliacion->nombrerazon->getPlaceHolder()) ?>" value="<?php echo $preafiliacion->nombrerazon->EditValue ?>"<?php echo $preafiliacion->nombrerazon->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($preafiliacion->telefono->Visible) { // telefono ?>
	<div id="r_telefono" class="form-group row">
		<label for="x_telefono" class="<?php echo $preafiliacion_search->LeftColumnClass ?>"><span id="elh_preafiliacion_telefono"><?php echo $preafiliacion->telefono->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_telefono" id="z_telefono" value="LIKE"></span>
		</label>
		<div class="<?php echo $preafiliacion_search->RightColumnClass ?>"><div<?php echo $preafiliacion->telefono->cellAttributes() ?>>
			<span id="el_preafiliacion_telefono">
<input type="text" data-table="preafiliacion" data-field="x_telefono" name="x_telefono" id="x_telefono" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($preafiliacion->telefono->getPlaceHolder()) ?>" value="<?php echo $preafiliacion->telefono->EditValue ?>"<?php echo $preafiliacion->telefono->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($preafiliacion->rfcentidad->Visible) { // rfcentidad ?>
	<div id="r_rfcentidad" class="form-group row">
		<label for="x_rfcentidad" class="<?php echo $preafiliacion_search->LeftColumnClass ?>"><span id="elh_preafiliacion_rfcentidad"><?php echo $preafiliacion->rfcentidad->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_rfcentidad" id="z_rfcentidad" value="LIKE"></span>
		</label>
		<div class="<?php echo $preafiliacion_search->RightColumnClass ?>"><div<?php echo $preafiliacion->rfcentidad->cellAttributes() ?>>
			<span id="el_preafiliacion_rfcentidad">
<input type="text" data-table="preafiliacion" data-field="x_rfcentidad" name="x_rfcentidad" id="x_rfcentidad" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($preafiliacion->rfcentidad->getPlaceHolder()) ?>" value="<?php echo $preafiliacion->rfcentidad->EditValue ?>"<?php echo $preafiliacion->rfcentidad->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($preafiliacion->estadopreaafilia->Visible) { // estadopreaafilia ?>
	<div id="r_estadopreaafilia" class="form-group row">
		<label class="<?php echo $preafiliacion_search->LeftColumnClass ?>"><span id="elh_preafiliacion_estadopreaafilia"><?php echo $preafiliacion->estadopreaafilia->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_estadopreaafilia" id="z_estadopreaafilia" value="="></span>
		</label>
		<div class="<?php echo $preafiliacion_search->RightColumnClass ?>"><div<?php echo $preafiliacion->estadopreaafilia->cellAttributes() ?>>
			<span id="el_preafiliacion_estadopreaafilia">
<?php
$wrkonchange = "" . trim(@$preafiliacion->estadopreaafilia->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$preafiliacion->estadopreaafilia->EditAttrs["onchange"] = "";
?>
<span id="as_x_estadopreaafilia" class="text-nowrap" style="z-index: 8930">
	<div class="input-group mb-3">
		<input type="text" class="form-control" name="sv_x_estadopreaafilia" id="sv_x_estadopreaafilia" value="<?php echo RemoveHtml($preafiliacion->estadopreaafilia->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($preafiliacion->estadopreaafilia->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($preafiliacion->estadopreaafilia->getPlaceHolder()) ?>"<?php echo $preafiliacion->estadopreaafilia->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($preafiliacion->estadopreaafilia->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_estadopreaafilia',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo (($preafiliacion->estadopreaafilia->ReadOnly || $preafiliacion->estadopreaafilia->Disabled) ? " disabled" : "")?>><i class="fa fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="preafiliacion" data-field="x_estadopreaafilia" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $preafiliacion->estadopreaafilia->displayValueSeparatorAttribute() ?>" name="x_estadopreaafilia" id="x_estadopreaafilia" value="<?php echo HtmlEncode($preafiliacion->estadopreaafilia->AdvancedSearch->SearchValue) ?>"<?php echo $wrkonchange ?>>
<script>
fpreafiliacionsearch.createAutoSuggest({"id":"x_estadopreaafilia","forceSelect":false});
</script>
<?php echo $preafiliacion->estadopreaafilia->Lookup->getParamTag("p_x_estadopreaafilia") ?>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$preafiliacion_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $preafiliacion_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$preafiliacion_search->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$preafiliacion_search->terminate();
?>