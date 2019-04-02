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
$cestadosolicitud_search = new cestadosolicitud_search();

// Run the page
$cestadosolicitud_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cestadosolicitud_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "search";
<?php if ($cestadosolicitud_search->IsModal) { ?>
var fcestadosolicitudsearch = currentAdvancedSearchForm = new ew.Form("fcestadosolicitudsearch", "search");
<?php } else { ?>
var fcestadosolicitudsearch = currentForm = new ew.Form("fcestadosolicitudsearch", "search");
<?php } ?>

// Form_CustomValidate event
fcestadosolicitudsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcestadosolicitudsearch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search
// Validate function for search

fcestadosolicitudsearch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_id_edosolicitud");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($cestadosolicitud->id_edosolicitud->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $cestadosolicitud_search->showPageHeader(); ?>
<?php
$cestadosolicitud_search->showMessage();
?>
<form name="fcestadosolicitudsearch" id="fcestadosolicitudsearch" class="<?php echo $cestadosolicitud_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($cestadosolicitud_search->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $cestadosolicitud_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cestadosolicitud">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$cestadosolicitud_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($cestadosolicitud->id_edosolicitud->Visible) { // id_edosolicitud ?>
	<div id="r_id_edosolicitud" class="form-group row">
		<label for="x_id_edosolicitud" class="<?php echo $cestadosolicitud_search->LeftColumnClass ?>"><span id="elh_cestadosolicitud_id_edosolicitud"><?php echo $cestadosolicitud->id_edosolicitud->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_id_edosolicitud" id="z_id_edosolicitud" value="="></span>
		</label>
		<div class="<?php echo $cestadosolicitud_search->RightColumnClass ?>"><div<?php echo $cestadosolicitud->id_edosolicitud->cellAttributes() ?>>
			<span id="el_cestadosolicitud_id_edosolicitud">
<input type="text" data-table="cestadosolicitud" data-field="x_id_edosolicitud" name="x_id_edosolicitud" id="x_id_edosolicitud" size="30" placeholder="<?php echo HtmlEncode($cestadosolicitud->id_edosolicitud->getPlaceHolder()) ?>" value="<?php echo $cestadosolicitud->id_edosolicitud->EditValue ?>"<?php echo $cestadosolicitud->id_edosolicitud->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cestadosolicitud->descestadooperacion->Visible) { // descestadooperacion ?>
	<div id="r_descestadooperacion" class="form-group row">
		<label for="x_descestadooperacion" class="<?php echo $cestadosolicitud_search->LeftColumnClass ?>"><span id="elh_cestadosolicitud_descestadooperacion"><?php echo $cestadosolicitud->descestadooperacion->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_descestadooperacion" id="z_descestadooperacion" value="LIKE"></span>
		</label>
		<div class="<?php echo $cestadosolicitud_search->RightColumnClass ?>"><div<?php echo $cestadosolicitud->descestadooperacion->cellAttributes() ?>>
			<span id="el_cestadosolicitud_descestadooperacion">
<input type="text" data-table="cestadosolicitud" data-field="x_descestadooperacion" name="x_descestadooperacion" id="x_descestadooperacion" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($cestadosolicitud->descestadooperacion->getPlaceHolder()) ?>" value="<?php echo $cestadosolicitud->descestadooperacion->EditValue ?>"<?php echo $cestadosolicitud->descestadooperacion->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$cestadosolicitud_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $cestadosolicitud_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$cestadosolicitud_search->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cestadosolicitud_search->terminate();
?>