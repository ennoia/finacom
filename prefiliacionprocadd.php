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
$prefiliacionproc_add = new prefiliacionproc_add();

// Run the page
$prefiliacionproc_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$prefiliacionproc_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fprefiliacionprocadd = currentForm = new ew.Form("fprefiliacionprocadd", "add");

// Validate form
fprefiliacionprocadd.validate = function() {
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
		<?php if ($prefiliacionproc_add->oidarchivos->Required) { ?>
			elm = this.getElements("x" + infix + "_oidarchivos");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $prefiliacionproc->oidarchivos->caption(), $prefiliacionproc->oidarchivos->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_oidarchivos");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($prefiliacionproc->oidarchivos->errorMessage()) ?>");
		<?php if ($prefiliacionproc_add->idrfccomprador->Required) { ?>
			elm = this.getElements("x" + infix + "_idrfccomprador");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $prefiliacionproc->idrfccomprador->caption(), $prefiliacionproc->idrfccomprador->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_idrfccomprador");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($prefiliacionproc->idrfccomprador->errorMessage()) ?>");
		<?php if ($prefiliacionproc_add->registros_totales->Required) { ?>
			elm = this.getElements("x" + infix + "_registros_totales");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $prefiliacionproc->registros_totales->caption(), $prefiliacionproc->registros_totales->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_registros_totales");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($prefiliacionproc->registros_totales->errorMessage()) ?>");
		<?php if ($prefiliacionproc_add->registros_validos->Required) { ?>
			elm = this.getElements("x" + infix + "_registros_validos");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $prefiliacionproc->registros_validos->caption(), $prefiliacionproc->registros_validos->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_registros_validos");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($prefiliacionproc->registros_validos->errorMessage()) ?>");
		<?php if ($prefiliacionproc_add->errores->Required) { ?>
			elm = this.getElements("x" + infix + "_errores");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $prefiliacionproc->errores->caption(), $prefiliacionproc->errores->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_errores");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($prefiliacionproc->errores->errorMessage()) ?>");
		<?php if ($prefiliacionproc_add->archivo->Required) { ?>
			felm = this.getElements("x" + infix + "_archivo");
			elm = this.getElements("fn_x" + infix + "_archivo");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $prefiliacionproc->archivo->caption(), $prefiliacionproc->archivo->RequiredErrorMessage)) ?>");
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
fprefiliacionprocadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fprefiliacionprocadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $prefiliacionproc_add->showPageHeader(); ?>
<?php
$prefiliacionproc_add->showMessage();
?>
<form name="fprefiliacionprocadd" id="fprefiliacionprocadd" class="<?php echo $prefiliacionproc_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($prefiliacionproc_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $prefiliacionproc_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="prefiliacionproc">
<?php if ($prefiliacionproc->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$prefiliacionproc_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($prefiliacionproc->oidarchivos->Visible) { // oidarchivos ?>
	<div id="r_oidarchivos" class="form-group row">
		<label id="elh_prefiliacionproc_oidarchivos" for="x_oidarchivos" class="<?php echo $prefiliacionproc_add->LeftColumnClass ?>"><?php echo $prefiliacionproc->oidarchivos->caption() ?><?php echo ($prefiliacionproc->oidarchivos->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $prefiliacionproc_add->RightColumnClass ?>"><div<?php echo $prefiliacionproc->oidarchivos->cellAttributes() ?>>
<?php if (!$prefiliacionproc->isConfirm()) { ?>
<span id="el_prefiliacionproc_oidarchivos">
<input type="text" data-table="prefiliacionproc" data-field="x_oidarchivos" name="x_oidarchivos" id="x_oidarchivos" size="30" placeholder="<?php echo HtmlEncode($prefiliacionproc->oidarchivos->getPlaceHolder()) ?>" value="<?php echo $prefiliacionproc->oidarchivos->EditValue ?>"<?php echo $prefiliacionproc->oidarchivos->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_prefiliacionproc_oidarchivos">
<span<?php echo $prefiliacionproc->oidarchivos->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($prefiliacionproc->oidarchivos->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="prefiliacionproc" data-field="x_oidarchivos" name="x_oidarchivos" id="x_oidarchivos" value="<?php echo HtmlEncode($prefiliacionproc->oidarchivos->FormValue) ?>">
<?php } ?>
<?php echo $prefiliacionproc->oidarchivos->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($prefiliacionproc->idrfccomprador->Visible) { // idrfccomprador ?>
	<div id="r_idrfccomprador" class="form-group row">
		<label id="elh_prefiliacionproc_idrfccomprador" for="x_idrfccomprador" class="<?php echo $prefiliacionproc_add->LeftColumnClass ?>"><?php echo $prefiliacionproc->idrfccomprador->caption() ?><?php echo ($prefiliacionproc->idrfccomprador->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $prefiliacionproc_add->RightColumnClass ?>"><div<?php echo $prefiliacionproc->idrfccomprador->cellAttributes() ?>>
<?php if (!$prefiliacionproc->isConfirm()) { ?>
<span id="el_prefiliacionproc_idrfccomprador">
<input type="text" data-table="prefiliacionproc" data-field="x_idrfccomprador" name="x_idrfccomprador" id="x_idrfccomprador" size="30" placeholder="<?php echo HtmlEncode($prefiliacionproc->idrfccomprador->getPlaceHolder()) ?>" value="<?php echo $prefiliacionproc->idrfccomprador->EditValue ?>"<?php echo $prefiliacionproc->idrfccomprador->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_prefiliacionproc_idrfccomprador">
<span<?php echo $prefiliacionproc->idrfccomprador->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($prefiliacionproc->idrfccomprador->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="prefiliacionproc" data-field="x_idrfccomprador" name="x_idrfccomprador" id="x_idrfccomprador" value="<?php echo HtmlEncode($prefiliacionproc->idrfccomprador->FormValue) ?>">
<?php } ?>
<?php echo $prefiliacionproc->idrfccomprador->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($prefiliacionproc->registros_totales->Visible) { // registros totales ?>
	<div id="r_registros_totales" class="form-group row">
		<label id="elh_prefiliacionproc_registros_totales" for="x_registros_totales" class="<?php echo $prefiliacionproc_add->LeftColumnClass ?>"><?php echo $prefiliacionproc->registros_totales->caption() ?><?php echo ($prefiliacionproc->registros_totales->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $prefiliacionproc_add->RightColumnClass ?>"><div<?php echo $prefiliacionproc->registros_totales->cellAttributes() ?>>
<?php if (!$prefiliacionproc->isConfirm()) { ?>
<span id="el_prefiliacionproc_registros_totales">
<input type="text" data-table="prefiliacionproc" data-field="x_registros_totales" name="x_registros_totales" id="x_registros_totales" size="30" placeholder="<?php echo HtmlEncode($prefiliacionproc->registros_totales->getPlaceHolder()) ?>" value="<?php echo $prefiliacionproc->registros_totales->EditValue ?>"<?php echo $prefiliacionproc->registros_totales->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_prefiliacionproc_registros_totales">
<span<?php echo $prefiliacionproc->registros_totales->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($prefiliacionproc->registros_totales->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="prefiliacionproc" data-field="x_registros_totales" name="x_registros_totales" id="x_registros_totales" value="<?php echo HtmlEncode($prefiliacionproc->registros_totales->FormValue) ?>">
<?php } ?>
<?php echo $prefiliacionproc->registros_totales->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($prefiliacionproc->registros_validos->Visible) { // registros validos ?>
	<div id="r_registros_validos" class="form-group row">
		<label id="elh_prefiliacionproc_registros_validos" for="x_registros_validos" class="<?php echo $prefiliacionproc_add->LeftColumnClass ?>"><?php echo $prefiliacionproc->registros_validos->caption() ?><?php echo ($prefiliacionproc->registros_validos->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $prefiliacionproc_add->RightColumnClass ?>"><div<?php echo $prefiliacionproc->registros_validos->cellAttributes() ?>>
<?php if (!$prefiliacionproc->isConfirm()) { ?>
<span id="el_prefiliacionproc_registros_validos">
<input type="text" data-table="prefiliacionproc" data-field="x_registros_validos" name="x_registros_validos" id="x_registros_validos" size="30" placeholder="<?php echo HtmlEncode($prefiliacionproc->registros_validos->getPlaceHolder()) ?>" value="<?php echo $prefiliacionproc->registros_validos->EditValue ?>"<?php echo $prefiliacionproc->registros_validos->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_prefiliacionproc_registros_validos">
<span<?php echo $prefiliacionproc->registros_validos->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($prefiliacionproc->registros_validos->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="prefiliacionproc" data-field="x_registros_validos" name="x_registros_validos" id="x_registros_validos" value="<?php echo HtmlEncode($prefiliacionproc->registros_validos->FormValue) ?>">
<?php } ?>
<?php echo $prefiliacionproc->registros_validos->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($prefiliacionproc->errores->Visible) { // errores ?>
	<div id="r_errores" class="form-group row">
		<label id="elh_prefiliacionproc_errores" for="x_errores" class="<?php echo $prefiliacionproc_add->LeftColumnClass ?>"><?php echo $prefiliacionproc->errores->caption() ?><?php echo ($prefiliacionproc->errores->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $prefiliacionproc_add->RightColumnClass ?>"><div<?php echo $prefiliacionproc->errores->cellAttributes() ?>>
<?php if (!$prefiliacionproc->isConfirm()) { ?>
<span id="el_prefiliacionproc_errores">
<input type="text" data-table="prefiliacionproc" data-field="x_errores" name="x_errores" id="x_errores" size="30" placeholder="<?php echo HtmlEncode($prefiliacionproc->errores->getPlaceHolder()) ?>" value="<?php echo $prefiliacionproc->errores->EditValue ?>"<?php echo $prefiliacionproc->errores->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_prefiliacionproc_errores">
<span<?php echo $prefiliacionproc->errores->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($prefiliacionproc->errores->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="prefiliacionproc" data-field="x_errores" name="x_errores" id="x_errores" value="<?php echo HtmlEncode($prefiliacionproc->errores->FormValue) ?>">
<?php } ?>
<?php echo $prefiliacionproc->errores->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($prefiliacionproc->archivo->Visible) { // archivo ?>
	<div id="r_archivo" class="form-group row">
		<label id="elh_prefiliacionproc_archivo" class="<?php echo $prefiliacionproc_add->LeftColumnClass ?>"><?php echo $prefiliacionproc->archivo->caption() ?><?php echo ($prefiliacionproc->archivo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $prefiliacionproc_add->RightColumnClass ?>"><div<?php echo $prefiliacionproc->archivo->cellAttributes() ?>>
<span id="el_prefiliacionproc_archivo">
<div id="fd_x_archivo">
<span title="<?php echo $prefiliacionproc->archivo->title() ? $prefiliacionproc->archivo->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($prefiliacionproc->archivo->ReadOnly || $prefiliacionproc->archivo->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="prefiliacionproc" data-field="x_archivo" name="x_archivo" id="x_archivo"<?php echo $prefiliacionproc->archivo->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_archivo" id= "fn_x_archivo" value="<?php echo $prefiliacionproc->archivo->Upload->FileName ?>">
<input type="hidden" name="fa_x_archivo" id= "fa_x_archivo" value="0">
<input type="hidden" name="fs_x_archivo" id= "fs_x_archivo" value="0">
<input type="hidden" name="fx_x_archivo" id= "fx_x_archivo" value="<?php echo $prefiliacionproc->archivo->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_archivo" id= "fm_x_archivo" value="<?php echo $prefiliacionproc->archivo->UploadMaxFileSize ?>">
</div>
<table id="ft_x_archivo" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $prefiliacionproc->archivo->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$prefiliacionproc_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $prefiliacionproc_add->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$prefiliacionproc->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $prefiliacionproc_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$prefiliacionproc_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$prefiliacionproc_add->terminate();
?>