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
$cedooperacionpyme_search = new cedooperacionpyme_search();

// Run the page
$cedooperacionpyme_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cedooperacionpyme_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "search";
<?php if ($cedooperacionpyme_search->IsModal) { ?>
var fcedooperacionpymesearch = currentAdvancedSearchForm = new ew.Form("fcedooperacionpymesearch", "search");
<?php } else { ?>
var fcedooperacionpymesearch = currentForm = new ew.Form("fcedooperacionpymesearch", "search");
<?php } ?>

// Form_CustomValidate event
fcedooperacionpymesearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcedooperacionpymesearch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search
// Validate function for search

fcedooperacionpymesearch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_id_estaus");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($cedooperacionpyme->id_estaus->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $cedooperacionpyme_search->showPageHeader(); ?>
<?php
$cedooperacionpyme_search->showMessage();
?>
<form name="fcedooperacionpymesearch" id="fcedooperacionpymesearch" class="<?php echo $cedooperacionpyme_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($cedooperacionpyme_search->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $cedooperacionpyme_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cedooperacionpyme">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$cedooperacionpyme_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($cedooperacionpyme->id_estaus->Visible) { // id_estaus ?>
	<div id="r_id_estaus" class="form-group row">
		<label for="x_id_estaus" class="<?php echo $cedooperacionpyme_search->LeftColumnClass ?>"><span id="elh_cedooperacionpyme_id_estaus"><?php echo $cedooperacionpyme->id_estaus->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_id_estaus" id="z_id_estaus" value="="></span>
		</label>
		<div class="<?php echo $cedooperacionpyme_search->RightColumnClass ?>"><div<?php echo $cedooperacionpyme->id_estaus->cellAttributes() ?>>
			<span id="el_cedooperacionpyme_id_estaus">
<input type="text" data-table="cedooperacionpyme" data-field="x_id_estaus" name="x_id_estaus" id="x_id_estaus" placeholder="<?php echo HtmlEncode($cedooperacionpyme->id_estaus->getPlaceHolder()) ?>" value="<?php echo $cedooperacionpyme->id_estaus->EditValue ?>"<?php echo $cedooperacionpyme->id_estaus->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cedooperacionpyme->descripcion->Visible) { // descripcion ?>
	<div id="r_descripcion" class="form-group row">
		<label for="x_descripcion" class="<?php echo $cedooperacionpyme_search->LeftColumnClass ?>"><span id="elh_cedooperacionpyme_descripcion"><?php echo $cedooperacionpyme->descripcion->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_descripcion" id="z_descripcion" value="LIKE"></span>
		</label>
		<div class="<?php echo $cedooperacionpyme_search->RightColumnClass ?>"><div<?php echo $cedooperacionpyme->descripcion->cellAttributes() ?>>
			<span id="el_cedooperacionpyme_descripcion">
<input type="text" data-table="cedooperacionpyme" data-field="x_descripcion" name="x_descripcion" id="x_descripcion" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($cedooperacionpyme->descripcion->getPlaceHolder()) ?>" value="<?php echo $cedooperacionpyme->descripcion->EditValue ?>"<?php echo $cedooperacionpyme->descripcion->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$cedooperacionpyme_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $cedooperacionpyme_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$cedooperacionpyme_search->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cedooperacionpyme_search->terminate();
?>