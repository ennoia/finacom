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
$userlevelpermissions_search = new userlevelpermissions_search();

// Run the page
$userlevelpermissions_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$userlevelpermissions_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "search";
<?php if ($userlevelpermissions_search->IsModal) { ?>
var fuserlevelpermissionssearch = currentAdvancedSearchForm = new ew.Form("fuserlevelpermissionssearch", "search");
<?php } else { ?>
var fuserlevelpermissionssearch = currentForm = new ew.Form("fuserlevelpermissionssearch", "search");
<?php } ?>

// Form_CustomValidate event
fuserlevelpermissionssearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fuserlevelpermissionssearch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search
// Validate function for search

fuserlevelpermissionssearch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_userlevelid");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($userlevelpermissions->userlevelid->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_permission");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($userlevelpermissions->permission->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $userlevelpermissions_search->showPageHeader(); ?>
<?php
$userlevelpermissions_search->showMessage();
?>
<form name="fuserlevelpermissionssearch" id="fuserlevelpermissionssearch" class="<?php echo $userlevelpermissions_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($userlevelpermissions_search->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $userlevelpermissions_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="userlevelpermissions">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$userlevelpermissions_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($userlevelpermissions->userlevelid->Visible) { // userlevelid ?>
	<div id="r_userlevelid" class="form-group row">
		<label for="x_userlevelid" class="<?php echo $userlevelpermissions_search->LeftColumnClass ?>"><span id="elh_userlevelpermissions_userlevelid"><?php echo $userlevelpermissions->userlevelid->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_userlevelid" id="z_userlevelid" value="="></span>
		</label>
		<div class="<?php echo $userlevelpermissions_search->RightColumnClass ?>"><div<?php echo $userlevelpermissions->userlevelid->cellAttributes() ?>>
			<span id="el_userlevelpermissions_userlevelid">
<input type="text" data-table="userlevelpermissions" data-field="x_userlevelid" name="x_userlevelid" id="x_userlevelid" size="30" placeholder="<?php echo HtmlEncode($userlevelpermissions->userlevelid->getPlaceHolder()) ?>" value="<?php echo $userlevelpermissions->userlevelid->EditValue ?>"<?php echo $userlevelpermissions->userlevelid->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($userlevelpermissions->_tablename->Visible) { // tablename ?>
	<div id="r__tablename" class="form-group row">
		<label for="x__tablename" class="<?php echo $userlevelpermissions_search->LeftColumnClass ?>"><span id="elh_userlevelpermissions__tablename"><?php echo $userlevelpermissions->_tablename->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z__tablename" id="z__tablename" value="LIKE"></span>
		</label>
		<div class="<?php echo $userlevelpermissions_search->RightColumnClass ?>"><div<?php echo $userlevelpermissions->_tablename->cellAttributes() ?>>
			<span id="el_userlevelpermissions__tablename">
<input type="text" data-table="userlevelpermissions" data-field="x__tablename" name="x__tablename" id="x__tablename" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($userlevelpermissions->_tablename->getPlaceHolder()) ?>" value="<?php echo $userlevelpermissions->_tablename->EditValue ?>"<?php echo $userlevelpermissions->_tablename->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($userlevelpermissions->permission->Visible) { // permission ?>
	<div id="r_permission" class="form-group row">
		<label for="x_permission" class="<?php echo $userlevelpermissions_search->LeftColumnClass ?>"><span id="elh_userlevelpermissions_permission"><?php echo $userlevelpermissions->permission->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_permission" id="z_permission" value="="></span>
		</label>
		<div class="<?php echo $userlevelpermissions_search->RightColumnClass ?>"><div<?php echo $userlevelpermissions->permission->cellAttributes() ?>>
			<span id="el_userlevelpermissions_permission">
<input type="text" data-table="userlevelpermissions" data-field="x_permission" name="x_permission" id="x_permission" size="30" placeholder="<?php echo HtmlEncode($userlevelpermissions->permission->getPlaceHolder()) ?>" value="<?php echo $userlevelpermissions->permission->EditValue ?>"<?php echo $userlevelpermissions->permission->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$userlevelpermissions_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $userlevelpermissions_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$userlevelpermissions_search->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$userlevelpermissions_search->terminate();
?>