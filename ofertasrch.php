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
$oferta_search = new oferta_search();

// Run the page
$oferta_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$oferta_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "search";
<?php if ($oferta_search->IsModal) { ?>
var fofertasearch = currentAdvancedSearchForm = new ew.Form("fofertasearch", "search");
<?php } else { ?>
var fofertasearch = currentForm = new ew.Form("fofertasearch", "search");
<?php } ?>

// Form_CustomValidate event
fofertasearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fofertasearch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search
// Validate function for search

fofertasearch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_fechaoferta");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($oferta->fechaoferta->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_descripcionoferta");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($oferta->descripcionoferta->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $oferta_search->showPageHeader(); ?>
<?php
$oferta_search->showMessage();
?>
<form name="fofertasearch" id="fofertasearch" class="<?php echo $oferta_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($oferta_search->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $oferta_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="oferta">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$oferta_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($oferta->idoferta->Visible) { // idoferta ?>
	<div id="r_idoferta" class="form-group row">
		<label for="x_idoferta" class="<?php echo $oferta_search->LeftColumnClass ?>"><span id="elh_oferta_idoferta"><?php echo $oferta->idoferta->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_idoferta" id="z_idoferta" value="LIKE"></span>
		</label>
		<div class="<?php echo $oferta_search->RightColumnClass ?>"><div<?php echo $oferta->idoferta->cellAttributes() ?>>
			<span id="el_oferta_idoferta">
<input type="text" data-table="oferta" data-field="x_idoferta" name="x_idoferta" id="x_idoferta" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($oferta->idoferta->getPlaceHolder()) ?>" value="<?php echo $oferta->idoferta->EditValue ?>"<?php echo $oferta->idoferta->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($oferta->fechaoferta->Visible) { // fechaoferta ?>
	<div id="r_fechaoferta" class="form-group row">
		<label for="x_fechaoferta" class="<?php echo $oferta_search->LeftColumnClass ?>"><span id="elh_oferta_fechaoferta"><?php echo $oferta->fechaoferta->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_fechaoferta" id="z_fechaoferta" value="="></span>
		</label>
		<div class="<?php echo $oferta_search->RightColumnClass ?>"><div<?php echo $oferta->fechaoferta->cellAttributes() ?>>
			<span id="el_oferta_fechaoferta">
<input type="text" data-table="oferta" data-field="x_fechaoferta" name="x_fechaoferta" id="x_fechaoferta" size="30" placeholder="<?php echo HtmlEncode($oferta->fechaoferta->getPlaceHolder()) ?>" value="<?php echo $oferta->fechaoferta->EditValue ?>"<?php echo $oferta->fechaoferta->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($oferta->descripcionoferta->Visible) { // descripcionoferta ?>
	<div id="r_descripcionoferta" class="form-group row">
		<label for="x_descripcionoferta" class="<?php echo $oferta_search->LeftColumnClass ?>"><span id="elh_oferta_descripcionoferta"><?php echo $oferta->descripcionoferta->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_descripcionoferta" id="z_descripcionoferta" value="="></span>
		</label>
		<div class="<?php echo $oferta_search->RightColumnClass ?>"><div<?php echo $oferta->descripcionoferta->cellAttributes() ?>>
			<span id="el_oferta_descripcionoferta">
<input type="text" data-table="oferta" data-field="x_descripcionoferta" name="x_descripcionoferta" id="x_descripcionoferta" size="30" placeholder="<?php echo HtmlEncode($oferta->descripcionoferta->getPlaceHolder()) ?>" value="<?php echo $oferta->descripcionoferta->EditValue ?>"<?php echo $oferta->descripcionoferta->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$oferta_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $oferta_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$oferta_search->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$oferta_search->terminate();
?>