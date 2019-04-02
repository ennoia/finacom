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
$cestadofactura_search = new cestadofactura_search();

// Run the page
$cestadofactura_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cestadofactura_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "search";
<?php if ($cestadofactura_search->IsModal) { ?>
var fcestadofacturasearch = currentAdvancedSearchForm = new ew.Form("fcestadofacturasearch", "search");
<?php } else { ?>
var fcestadofacturasearch = currentForm = new ew.Form("fcestadofacturasearch", "search");
<?php } ?>

// Form_CustomValidate event
fcestadofacturasearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcestadofacturasearch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search
// Validate function for search

fcestadofacturasearch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_id_edofactura");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($cestadofactura->id_edofactura->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $cestadofactura_search->showPageHeader(); ?>
<?php
$cestadofactura_search->showMessage();
?>
<form name="fcestadofacturasearch" id="fcestadofacturasearch" class="<?php echo $cestadofactura_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($cestadofactura_search->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $cestadofactura_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cestadofactura">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$cestadofactura_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($cestadofactura->id_edofactura->Visible) { // id_edofactura ?>
	<div id="r_id_edofactura" class="form-group row">
		<label for="x_id_edofactura" class="<?php echo $cestadofactura_search->LeftColumnClass ?>"><span id="elh_cestadofactura_id_edofactura"><?php echo $cestadofactura->id_edofactura->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_id_edofactura" id="z_id_edofactura" value="="></span>
		</label>
		<div class="<?php echo $cestadofactura_search->RightColumnClass ?>"><div<?php echo $cestadofactura->id_edofactura->cellAttributes() ?>>
			<span id="el_cestadofactura_id_edofactura">
<input type="text" data-table="cestadofactura" data-field="x_id_edofactura" name="x_id_edofactura" id="x_id_edofactura" placeholder="<?php echo HtmlEncode($cestadofactura->id_edofactura->getPlaceHolder()) ?>" value="<?php echo $cestadofactura->id_edofactura->EditValue ?>"<?php echo $cestadofactura->id_edofactura->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cestadofactura->descedofactura->Visible) { // descedofactura ?>
	<div id="r_descedofactura" class="form-group row">
		<label for="x_descedofactura" class="<?php echo $cestadofactura_search->LeftColumnClass ?>"><span id="elh_cestadofactura_descedofactura"><?php echo $cestadofactura->descedofactura->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_descedofactura" id="z_descedofactura" value="LIKE"></span>
		</label>
		<div class="<?php echo $cestadofactura_search->RightColumnClass ?>"><div<?php echo $cestadofactura->descedofactura->cellAttributes() ?>>
			<span id="el_cestadofactura_descedofactura">
<input type="text" data-table="cestadofactura" data-field="x_descedofactura" name="x_descedofactura" id="x_descedofactura" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($cestadofactura->descedofactura->getPlaceHolder()) ?>" value="<?php echo $cestadofactura->descedofactura->EditValue ?>"<?php echo $cestadofactura->descedofactura->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$cestadofactura_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $cestadofactura_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$cestadofactura_search->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cestadofactura_search->terminate();
?>