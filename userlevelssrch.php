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
$userlevels_search = new userlevels_search();

// Run the page
$userlevels_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$userlevels_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "search";
<?php if ($userlevels_search->IsModal) { ?>
var fuserlevelssearch = currentAdvancedSearchForm = new ew.Form("fuserlevelssearch", "search");
<?php } else { ?>
var fuserlevelssearch = currentForm = new ew.Form("fuserlevelssearch", "search");
<?php } ?>

// Form_CustomValidate event
fuserlevelssearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fuserlevelssearch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search
// Validate function for search

fuserlevelssearch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_userlevelid");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($userlevels->userlevelid->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $userlevels_search->showPageHeader(); ?>
<?php
$userlevels_search->showMessage();
?>
<form name="fuserlevelssearch" id="fuserlevelssearch" class="<?php echo $userlevels_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($userlevels_search->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $userlevels_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="userlevels">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$userlevels_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($userlevels->userlevelid->Visible) { // userlevelid ?>
	<div id="r_userlevelid" class="form-group row">
		<label for="x_userlevelid" class="<?php echo $userlevels_search->LeftColumnClass ?>"><span id="elh_userlevels_userlevelid"><?php echo $userlevels->userlevelid->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_userlevelid" id="z_userlevelid" value="="></span>
		</label>
		<div class="<?php echo $userlevels_search->RightColumnClass ?>"><div<?php echo $userlevels->userlevelid->cellAttributes() ?>>
			<span id="el_userlevels_userlevelid">
<input type="text" data-table="userlevels" data-field="x_userlevelid" name="x_userlevelid" id="x_userlevelid" size="30" placeholder="<?php echo HtmlEncode($userlevels->userlevelid->getPlaceHolder()) ?>" value="<?php echo $userlevels->userlevelid->EditValue ?>"<?php echo $userlevels->userlevelid->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($userlevels->userlevelname->Visible) { // userlevelname ?>
	<div id="r_userlevelname" class="form-group row">
		<label for="x_userlevelname" class="<?php echo $userlevels_search->LeftColumnClass ?>"><span id="elh_userlevels_userlevelname"><?php echo $userlevels->userlevelname->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_userlevelname" id="z_userlevelname" value="LIKE"></span>
		</label>
		<div class="<?php echo $userlevels_search->RightColumnClass ?>"><div<?php echo $userlevels->userlevelname->cellAttributes() ?>>
			<span id="el_userlevels_userlevelname">
<input type="text" data-table="userlevels" data-field="x_userlevelname" name="x_userlevelname" id="x_userlevelname" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($userlevels->userlevelname->getPlaceHolder()) ?>" value="<?php echo $userlevels->userlevelname->EditValue ?>"<?php echo $userlevels->userlevelname->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$userlevels_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $userlevels_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$userlevels_search->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$userlevels_search->terminate();
?>