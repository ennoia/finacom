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
$preafiliacion_add = new preafiliacion_add();

// Run the page
$preafiliacion_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$preafiliacion_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fpreafiliacionadd = currentForm = new ew.Form("fpreafiliacionadd", "add");

// Validate form
fpreafiliacionadd.validate = function() {
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
		<?php if ($preafiliacion_add->tipoentidad->Required) { ?>
			elm = this.getElements("x" + infix + "_tipoentidad");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $preafiliacion->tipoentidad->caption(), $preafiliacion->tipoentidad->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($preafiliacion_add->fechaafiliacion->Required) { ?>
			elm = this.getElements("x" + infix + "_fechaafiliacion");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $preafiliacion->fechaafiliacion->caption(), $preafiliacion->fechaafiliacion->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_fechaafiliacion");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($preafiliacion->fechaafiliacion->errorMessage()) ?>");
		<?php if ($preafiliacion_add->nombrerazon->Required) { ?>
			elm = this.getElements("x" + infix + "_nombrerazon");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $preafiliacion->nombrerazon->caption(), $preafiliacion->nombrerazon->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($preafiliacion_add->telefono->Required) { ?>
			elm = this.getElements("x" + infix + "_telefono");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $preafiliacion->telefono->caption(), $preafiliacion->telefono->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($preafiliacion_add->rfcentidad->Required) { ?>
			elm = this.getElements("x" + infix + "_rfcentidad");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $preafiliacion->rfcentidad->caption(), $preafiliacion->rfcentidad->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($preafiliacion_add->estadopreaafilia->Required) { ?>
			elm = this.getElements("x" + infix + "_estadopreaafilia");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $preafiliacion->estadopreaafilia->caption(), $preafiliacion->estadopreaafilia->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_estadopreaafilia");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($preafiliacion->estadopreaafilia->errorMessage()) ?>");

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
fpreafiliacionadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fpreafiliacionadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fpreafiliacionadd.lists["x_estadopreaafilia"] = <?php echo $preafiliacion_add->estadopreaafilia->Lookup->toClientList() ?>;
fpreafiliacionadd.lists["x_estadopreaafilia"].options = <?php echo JsonEncode($preafiliacion_add->estadopreaafilia->lookupOptions()) ?>;
fpreafiliacionadd.autoSuggests["x_estadopreaafilia"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $preafiliacion_add->showPageHeader(); ?>
<?php
$preafiliacion_add->showMessage();
?>
<form name="fpreafiliacionadd" id="fpreafiliacionadd" class="<?php echo $preafiliacion_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($preafiliacion_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $preafiliacion_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="preafiliacion">
<?php if ($preafiliacion->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$preafiliacion_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($preafiliacion->tipoentidad->Visible) { // tipoentidad ?>
	<div id="r_tipoentidad" class="form-group row">
		<label id="elh_preafiliacion_tipoentidad" for="x_tipoentidad" class="<?php echo $preafiliacion_add->LeftColumnClass ?>"><?php echo $preafiliacion->tipoentidad->caption() ?><?php echo ($preafiliacion->tipoentidad->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $preafiliacion_add->RightColumnClass ?>"><div<?php echo $preafiliacion->tipoentidad->cellAttributes() ?>>
<?php if (!$preafiliacion->isConfirm()) { ?>
<span id="el_preafiliacion_tipoentidad">
<input type="text" data-table="preafiliacion" data-field="x_tipoentidad" name="x_tipoentidad" id="x_tipoentidad" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($preafiliacion->tipoentidad->getPlaceHolder()) ?>" value="<?php echo $preafiliacion->tipoentidad->EditValue ?>"<?php echo $preafiliacion->tipoentidad->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_preafiliacion_tipoentidad">
<span<?php echo $preafiliacion->tipoentidad->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($preafiliacion->tipoentidad->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="preafiliacion" data-field="x_tipoentidad" name="x_tipoentidad" id="x_tipoentidad" value="<?php echo HtmlEncode($preafiliacion->tipoentidad->FormValue) ?>">
<?php } ?>
<?php echo $preafiliacion->tipoentidad->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($preafiliacion->fechaafiliacion->Visible) { // fechaafiliacion ?>
	<div id="r_fechaafiliacion" class="form-group row">
		<label id="elh_preafiliacion_fechaafiliacion" for="x_fechaafiliacion" class="<?php echo $preafiliacion_add->LeftColumnClass ?>"><?php echo $preafiliacion->fechaafiliacion->caption() ?><?php echo ($preafiliacion->fechaafiliacion->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $preafiliacion_add->RightColumnClass ?>"><div<?php echo $preafiliacion->fechaafiliacion->cellAttributes() ?>>
<?php if (!$preafiliacion->isConfirm()) { ?>
<span id="el_preafiliacion_fechaafiliacion">
<input type="text" data-table="preafiliacion" data-field="x_fechaafiliacion" name="x_fechaafiliacion" id="x_fechaafiliacion" placeholder="<?php echo HtmlEncode($preafiliacion->fechaafiliacion->getPlaceHolder()) ?>" value="<?php echo $preafiliacion->fechaafiliacion->EditValue ?>"<?php echo $preafiliacion->fechaafiliacion->editAttributes() ?>>
<?php if (!$preafiliacion->fechaafiliacion->ReadOnly && !$preafiliacion->fechaafiliacion->Disabled && !isset($preafiliacion->fechaafiliacion->EditAttrs["readonly"]) && !isset($preafiliacion->fechaafiliacion->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fpreafiliacionadd", "x_fechaafiliacion", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_preafiliacion_fechaafiliacion">
<span<?php echo $preafiliacion->fechaafiliacion->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($preafiliacion->fechaafiliacion->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="preafiliacion" data-field="x_fechaafiliacion" name="x_fechaafiliacion" id="x_fechaafiliacion" value="<?php echo HtmlEncode($preafiliacion->fechaafiliacion->FormValue) ?>">
<?php } ?>
<?php echo $preafiliacion->fechaafiliacion->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($preafiliacion->nombrerazon->Visible) { // nombrerazon ?>
	<div id="r_nombrerazon" class="form-group row">
		<label id="elh_preafiliacion_nombrerazon" for="x_nombrerazon" class="<?php echo $preafiliacion_add->LeftColumnClass ?>"><?php echo $preafiliacion->nombrerazon->caption() ?><?php echo ($preafiliacion->nombrerazon->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $preafiliacion_add->RightColumnClass ?>"><div<?php echo $preafiliacion->nombrerazon->cellAttributes() ?>>
<?php if (!$preafiliacion->isConfirm()) { ?>
<span id="el_preafiliacion_nombrerazon">
<input type="text" data-table="preafiliacion" data-field="x_nombrerazon" name="x_nombrerazon" id="x_nombrerazon" size="30" maxlength="90" placeholder="<?php echo HtmlEncode($preafiliacion->nombrerazon->getPlaceHolder()) ?>" value="<?php echo $preafiliacion->nombrerazon->EditValue ?>"<?php echo $preafiliacion->nombrerazon->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_preafiliacion_nombrerazon">
<span<?php echo $preafiliacion->nombrerazon->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($preafiliacion->nombrerazon->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="preafiliacion" data-field="x_nombrerazon" name="x_nombrerazon" id="x_nombrerazon" value="<?php echo HtmlEncode($preafiliacion->nombrerazon->FormValue) ?>">
<?php } ?>
<?php echo $preafiliacion->nombrerazon->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($preafiliacion->telefono->Visible) { // telefono ?>
	<div id="r_telefono" class="form-group row">
		<label id="elh_preafiliacion_telefono" for="x_telefono" class="<?php echo $preafiliacion_add->LeftColumnClass ?>"><?php echo $preafiliacion->telefono->caption() ?><?php echo ($preafiliacion->telefono->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $preafiliacion_add->RightColumnClass ?>"><div<?php echo $preafiliacion->telefono->cellAttributes() ?>>
<?php if (!$preafiliacion->isConfirm()) { ?>
<span id="el_preafiliacion_telefono">
<input type="text" data-table="preafiliacion" data-field="x_telefono" name="x_telefono" id="x_telefono" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($preafiliacion->telefono->getPlaceHolder()) ?>" value="<?php echo $preafiliacion->telefono->EditValue ?>"<?php echo $preafiliacion->telefono->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_preafiliacion_telefono">
<span<?php echo $preafiliacion->telefono->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($preafiliacion->telefono->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="preafiliacion" data-field="x_telefono" name="x_telefono" id="x_telefono" value="<?php echo HtmlEncode($preafiliacion->telefono->FormValue) ?>">
<?php } ?>
<?php echo $preafiliacion->telefono->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($preafiliacion->rfcentidad->Visible) { // rfcentidad ?>
	<div id="r_rfcentidad" class="form-group row">
		<label id="elh_preafiliacion_rfcentidad" for="x_rfcentidad" class="<?php echo $preafiliacion_add->LeftColumnClass ?>"><?php echo $preafiliacion->rfcentidad->caption() ?><?php echo ($preafiliacion->rfcentidad->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $preafiliacion_add->RightColumnClass ?>"><div<?php echo $preafiliacion->rfcentidad->cellAttributes() ?>>
<?php if (!$preafiliacion->isConfirm()) { ?>
<span id="el_preafiliacion_rfcentidad">
<input type="text" data-table="preafiliacion" data-field="x_rfcentidad" name="x_rfcentidad" id="x_rfcentidad" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($preafiliacion->rfcentidad->getPlaceHolder()) ?>" value="<?php echo $preafiliacion->rfcentidad->EditValue ?>"<?php echo $preafiliacion->rfcentidad->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_preafiliacion_rfcentidad">
<span<?php echo $preafiliacion->rfcentidad->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($preafiliacion->rfcentidad->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="preafiliacion" data-field="x_rfcentidad" name="x_rfcentidad" id="x_rfcentidad" value="<?php echo HtmlEncode($preafiliacion->rfcentidad->FormValue) ?>">
<?php } ?>
<?php echo $preafiliacion->rfcentidad->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($preafiliacion->estadopreaafilia->Visible) { // estadopreaafilia ?>
	<div id="r_estadopreaafilia" class="form-group row">
		<label id="elh_preafiliacion_estadopreaafilia" class="<?php echo $preafiliacion_add->LeftColumnClass ?>"><?php echo $preafiliacion->estadopreaafilia->caption() ?><?php echo ($preafiliacion->estadopreaafilia->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $preafiliacion_add->RightColumnClass ?>"><div<?php echo $preafiliacion->estadopreaafilia->cellAttributes() ?>>
<?php if (!$preafiliacion->isConfirm()) { ?>
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
<input type="hidden" data-table="preafiliacion" data-field="x_estadopreaafilia" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $preafiliacion->estadopreaafilia->displayValueSeparatorAttribute() ?>" name="x_estadopreaafilia" id="x_estadopreaafilia" value="<?php echo HtmlEncode($preafiliacion->estadopreaafilia->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fpreafiliacionadd.createAutoSuggest({"id":"x_estadopreaafilia","forceSelect":false});
</script>
<?php echo $preafiliacion->estadopreaafilia->Lookup->getParamTag("p_x_estadopreaafilia") ?>
</span>
<?php } else { ?>
<span id="el_preafiliacion_estadopreaafilia">
<span<?php echo $preafiliacion->estadopreaafilia->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($preafiliacion->estadopreaafilia->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="preafiliacion" data-field="x_estadopreaafilia" name="x_estadopreaafilia" id="x_estadopreaafilia" value="<?php echo HtmlEncode($preafiliacion->estadopreaafilia->FormValue) ?>">
<?php } ?>
<?php echo $preafiliacion->estadopreaafilia->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$preafiliacion_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $preafiliacion_add->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$preafiliacion->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $preafiliacion_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$preafiliacion_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$preafiliacion_add->terminate();
?>