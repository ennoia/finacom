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
$cedopreafiliacion_search = new cedopreafiliacion_search();

// Run the page
$cedopreafiliacion_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cedopreafiliacion_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "search";
<?php if ($cedopreafiliacion_search->IsModal) { ?>
var fcedopreafiliacionsearch = currentAdvancedSearchForm = new ew.Form("fcedopreafiliacionsearch", "search");
<?php } else { ?>
var fcedopreafiliacionsearch = currentForm = new ew.Form("fcedopreafiliacionsearch", "search");
<?php } ?>

// Form_CustomValidate event
fcedopreafiliacionsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcedopreafiliacionsearch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search
// Validate function for search

fcedopreafiliacionsearch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_id_edopreafiliado");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($cedopreafiliacion->id_edopreafiliado->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $cedopreafiliacion_search->showPageHeader(); ?>
<?php
$cedopreafiliacion_search->showMessage();
?>
<form name="fcedopreafiliacionsearch" id="fcedopreafiliacionsearch" class="<?php echo $cedopreafiliacion_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($cedopreafiliacion_search->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $cedopreafiliacion_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cedopreafiliacion">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$cedopreafiliacion_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($cedopreafiliacion->id_edopreafiliado->Visible) { // id_edopreafiliado ?>
	<div id="r_id_edopreafiliado" class="form-group row">
		<label for="x_id_edopreafiliado" class="<?php echo $cedopreafiliacion_search->LeftColumnClass ?>"><span id="elh_cedopreafiliacion_id_edopreafiliado"><?php echo $cedopreafiliacion->id_edopreafiliado->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_id_edopreafiliado" id="z_id_edopreafiliado" value="="></span>
		</label>
		<div class="<?php echo $cedopreafiliacion_search->RightColumnClass ?>"><div<?php echo $cedopreafiliacion->id_edopreafiliado->cellAttributes() ?>>
			<span id="el_cedopreafiliacion_id_edopreafiliado">
<input type="text" data-table="cedopreafiliacion" data-field="x_id_edopreafiliado" name="x_id_edopreafiliado" id="x_id_edopreafiliado" placeholder="<?php echo HtmlEncode($cedopreafiliacion->id_edopreafiliado->getPlaceHolder()) ?>" value="<?php echo $cedopreafiliacion->id_edopreafiliado->EditValue ?>"<?php echo $cedopreafiliacion->id_edopreafiliado->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($cedopreafiliacion->descpreafiliado->Visible) { // descpreafiliado ?>
	<div id="r_descpreafiliado" class="form-group row">
		<label for="x_descpreafiliado" class="<?php echo $cedopreafiliacion_search->LeftColumnClass ?>"><span id="elh_cedopreafiliacion_descpreafiliado"><?php echo $cedopreafiliacion->descpreafiliado->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_descpreafiliado" id="z_descpreafiliado" value="LIKE"></span>
		</label>
		<div class="<?php echo $cedopreafiliacion_search->RightColumnClass ?>"><div<?php echo $cedopreafiliacion->descpreafiliado->cellAttributes() ?>>
			<span id="el_cedopreafiliacion_descpreafiliado">
<input type="text" data-table="cedopreafiliacion" data-field="x_descpreafiliado" name="x_descpreafiliado" id="x_descpreafiliado" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($cedopreafiliacion->descpreafiliado->getPlaceHolder()) ?>" value="<?php echo $cedopreafiliacion->descpreafiliado->EditValue ?>"<?php echo $cedopreafiliacion->descpreafiliado->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$cedopreafiliacion_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $cedopreafiliacion_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$cedopreafiliacion_search->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cedopreafiliacion_search->terminate();
?>