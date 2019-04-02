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
$ctipomonto_search = new ctipomonto_search();

// Run the page
$ctipomonto_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ctipomonto_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "search";
<?php if ($ctipomonto_search->IsModal) { ?>
var fctipomontosearch = currentAdvancedSearchForm = new ew.Form("fctipomontosearch", "search");
<?php } else { ?>
var fctipomontosearch = currentForm = new ew.Form("fctipomontosearch", "search");
<?php } ?>

// Form_CustomValidate event
fctipomontosearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fctipomontosearch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search
// Validate function for search

fctipomontosearch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_idtipomonto");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($ctipomonto->idtipomonto->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $ctipomonto_search->showPageHeader(); ?>
<?php
$ctipomonto_search->showMessage();
?>
<form name="fctipomontosearch" id="fctipomontosearch" class="<?php echo $ctipomonto_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($ctipomonto_search->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $ctipomonto_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ctipomonto">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$ctipomonto_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($ctipomonto->idtipomonto->Visible) { // idtipomonto ?>
	<div id="r_idtipomonto" class="form-group row">
		<label for="x_idtipomonto" class="<?php echo $ctipomonto_search->LeftColumnClass ?>"><span id="elh_ctipomonto_idtipomonto"><?php echo $ctipomonto->idtipomonto->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_idtipomonto" id="z_idtipomonto" value="="></span>
		</label>
		<div class="<?php echo $ctipomonto_search->RightColumnClass ?>"><div<?php echo $ctipomonto->idtipomonto->cellAttributes() ?>>
			<span id="el_ctipomonto_idtipomonto">
<input type="text" data-table="ctipomonto" data-field="x_idtipomonto" name="x_idtipomonto" id="x_idtipomonto" placeholder="<?php echo HtmlEncode($ctipomonto->idtipomonto->getPlaceHolder()) ?>" value="<?php echo $ctipomonto->idtipomonto->EditValue ?>"<?php echo $ctipomonto->idtipomonto->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ctipomonto->descripcion->Visible) { // descripcion ?>
	<div id="r_descripcion" class="form-group row">
		<label for="x_descripcion" class="<?php echo $ctipomonto_search->LeftColumnClass ?>"><span id="elh_ctipomonto_descripcion"><?php echo $ctipomonto->descripcion->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_descripcion" id="z_descripcion" value="LIKE"></span>
		</label>
		<div class="<?php echo $ctipomonto_search->RightColumnClass ?>"><div<?php echo $ctipomonto->descripcion->cellAttributes() ?>>
			<span id="el_ctipomonto_descripcion">
<input type="text" data-table="ctipomonto" data-field="x_descripcion" name="x_descripcion" id="x_descripcion" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($ctipomonto->descripcion->getPlaceHolder()) ?>" value="<?php echo $ctipomonto->descripcion->EditValue ?>"<?php echo $ctipomonto->descripcion->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$ctipomonto_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ctipomonto_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$ctipomonto_search->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$ctipomonto_search->terminate();
?>