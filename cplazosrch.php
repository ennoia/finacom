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
$cplazo_search = new cplazo_search();

// Run the page
$cplazo_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cplazo_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "search";
<?php if ($cplazo_search->IsModal) { ?>
var fcplazosearch = currentAdvancedSearchForm = new ew.Form("fcplazosearch", "search");
<?php } else { ?>
var fcplazosearch = currentForm = new ew.Form("fcplazosearch", "search");
<?php } ?>

// Form_CustomValidate event
fcplazosearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcplazosearch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search
// Validate function for search

fcplazosearch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_id_plazo");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($cplazo->id_plazo->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $cplazo_search->showPageHeader(); ?>
<?php
$cplazo_search->showMessage();
?>
<form name="fcplazosearch" id="fcplazosearch" class="<?php echo $cplazo_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($cplazo_search->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $cplazo_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cplazo">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$cplazo_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($cplazo->id_plazo->Visible) { // id_plazo ?>
	<div id="r_id_plazo" class="form-group row">
		<label for="x_id_plazo" class="<?php echo $cplazo_search->LeftColumnClass ?>"><span id="elh_cplazo_id_plazo"><?php echo $cplazo->id_plazo->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_id_plazo" id="z_id_plazo" value="="></span>
		</label>
		<div class="<?php echo $cplazo_search->RightColumnClass ?>"><div<?php echo $cplazo->id_plazo->cellAttributes() ?>>
			<span id="el_cplazo_id_plazo">
<input type="text" data-table="cplazo" data-field="x_id_plazo" name="x_id_plazo" id="x_id_plazo" placeholder="<?php echo HtmlEncode($cplazo->id_plazo->getPlaceHolder()) ?>" value="<?php echo $cplazo->id_plazo->EditValue ?>"<?php echo $cplazo->id_plazo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cplazo->Tipo_Plazo->Visible) { // Tipo Plazo ?>
	<div id="r_Tipo_Plazo" class="form-group row">
		<label for="x_Tipo_Plazo" class="<?php echo $cplazo_search->LeftColumnClass ?>"><span id="elh_cplazo_Tipo_Plazo"><?php echo $cplazo->Tipo_Plazo->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_Tipo_Plazo" id="z_Tipo_Plazo" value="LIKE"></span>
		</label>
		<div class="<?php echo $cplazo_search->RightColumnClass ?>"><div<?php echo $cplazo->Tipo_Plazo->cellAttributes() ?>>
			<span id="el_cplazo_Tipo_Plazo">
<input type="text" data-table="cplazo" data-field="x_Tipo_Plazo" name="x_Tipo_Plazo" id="x_Tipo_Plazo" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($cplazo->Tipo_Plazo->getPlaceHolder()) ?>" value="<?php echo $cplazo->Tipo_Plazo->EditValue ?>"<?php echo $cplazo->Tipo_Plazo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$cplazo_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $cplazo_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$cplazo_search->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cplazo_search->terminate();
?>