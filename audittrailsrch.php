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
$audittrail_search = new audittrail_search();

// Run the page
$audittrail_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$audittrail_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "search";
<?php if ($audittrail_search->IsModal) { ?>
var faudittrailsearch = currentAdvancedSearchForm = new ew.Form("faudittrailsearch", "search");
<?php } else { ?>
var faudittrailsearch = currentForm = new ew.Form("faudittrailsearch", "search");
<?php } ?>

// Form_CustomValidate event
faudittrailsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
faudittrailsearch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search
// Validate function for search

faudittrailsearch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_id");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($audittrail->id->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_datetime");
	if (elm && !ew.checkDateDef(elm.value))
		return this.onError(elm, "<?php echo JsEncode($audittrail->datetime->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $audittrail_search->showPageHeader(); ?>
<?php
$audittrail_search->showMessage();
?>
<form name="faudittrailsearch" id="faudittrailsearch" class="<?php echo $audittrail_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($audittrail_search->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $audittrail_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="audittrail">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$audittrail_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($audittrail->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label for="x_id" class="<?php echo $audittrail_search->LeftColumnClass ?>"><span id="elh_audittrail_id"><?php echo $audittrail->id->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_id" id="z_id" value="="></span>
		</label>
		<div class="<?php echo $audittrail_search->RightColumnClass ?>"><div<?php echo $audittrail->id->cellAttributes() ?>>
			<span id="el_audittrail_id">
<input type="text" data-table="audittrail" data-field="x_id" name="x_id" id="x_id" placeholder="<?php echo HtmlEncode($audittrail->id->getPlaceHolder()) ?>" value="<?php echo $audittrail->id->EditValue ?>"<?php echo $audittrail->id->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($audittrail->datetime->Visible) { // datetime ?>
	<div id="r_datetime" class="form-group row">
		<label for="x_datetime" class="<?php echo $audittrail_search->LeftColumnClass ?>"><span id="elh_audittrail_datetime"><?php echo $audittrail->datetime->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_datetime" id="z_datetime" value="="></span>
		</label>
		<div class="<?php echo $audittrail_search->RightColumnClass ?>"><div<?php echo $audittrail->datetime->cellAttributes() ?>>
			<span id="el_audittrail_datetime">
<input type="text" data-table="audittrail" data-field="x_datetime" name="x_datetime" id="x_datetime" placeholder="<?php echo HtmlEncode($audittrail->datetime->getPlaceHolder()) ?>" value="<?php echo $audittrail->datetime->EditValue ?>"<?php echo $audittrail->datetime->editAttributes() ?>>
<?php if (!$audittrail->datetime->ReadOnly && !$audittrail->datetime->Disabled && !isset($audittrail->datetime->EditAttrs["readonly"]) && !isset($audittrail->datetime->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("faudittrailsearch", "x_datetime", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($audittrail->script->Visible) { // script ?>
	<div id="r_script" class="form-group row">
		<label for="x_script" class="<?php echo $audittrail_search->LeftColumnClass ?>"><span id="elh_audittrail_script"><?php echo $audittrail->script->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_script" id="z_script" value="LIKE"></span>
		</label>
		<div class="<?php echo $audittrail_search->RightColumnClass ?>"><div<?php echo $audittrail->script->cellAttributes() ?>>
			<span id="el_audittrail_script">
<input type="text" data-table="audittrail" data-field="x_script" name="x_script" id="x_script" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($audittrail->script->getPlaceHolder()) ?>" value="<?php echo $audittrail->script->EditValue ?>"<?php echo $audittrail->script->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($audittrail->user->Visible) { // user ?>
	<div id="r_user" class="form-group row">
		<label for="x_user" class="<?php echo $audittrail_search->LeftColumnClass ?>"><span id="elh_audittrail_user"><?php echo $audittrail->user->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_user" id="z_user" value="LIKE"></span>
		</label>
		<div class="<?php echo $audittrail_search->RightColumnClass ?>"><div<?php echo $audittrail->user->cellAttributes() ?>>
			<span id="el_audittrail_user">
<input type="text" data-table="audittrail" data-field="x_user" name="x_user" id="x_user" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($audittrail->user->getPlaceHolder()) ?>" value="<?php echo $audittrail->user->EditValue ?>"<?php echo $audittrail->user->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($audittrail->_action->Visible) { // action ?>
	<div id="r__action" class="form-group row">
		<label for="x__action" class="<?php echo $audittrail_search->LeftColumnClass ?>"><span id="elh_audittrail__action"><?php echo $audittrail->_action->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z__action" id="z__action" value="LIKE"></span>
		</label>
		<div class="<?php echo $audittrail_search->RightColumnClass ?>"><div<?php echo $audittrail->_action->cellAttributes() ?>>
			<span id="el_audittrail__action">
<input type="text" data-table="audittrail" data-field="x__action" name="x__action" id="x__action" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($audittrail->_action->getPlaceHolder()) ?>" value="<?php echo $audittrail->_action->EditValue ?>"<?php echo $audittrail->_action->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($audittrail->_table->Visible) { // table ?>
	<div id="r__table" class="form-group row">
		<label for="x__table" class="<?php echo $audittrail_search->LeftColumnClass ?>"><span id="elh_audittrail__table"><?php echo $audittrail->_table->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z__table" id="z__table" value="LIKE"></span>
		</label>
		<div class="<?php echo $audittrail_search->RightColumnClass ?>"><div<?php echo $audittrail->_table->cellAttributes() ?>>
			<span id="el_audittrail__table">
<input type="text" data-table="audittrail" data-field="x__table" name="x__table" id="x__table" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($audittrail->_table->getPlaceHolder()) ?>" value="<?php echo $audittrail->_table->EditValue ?>"<?php echo $audittrail->_table->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($audittrail->field->Visible) { // field ?>
	<div id="r_field" class="form-group row">
		<label for="x_field" class="<?php echo $audittrail_search->LeftColumnClass ?>"><span id="elh_audittrail_field"><?php echo $audittrail->field->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_field" id="z_field" value="LIKE"></span>
		</label>
		<div class="<?php echo $audittrail_search->RightColumnClass ?>"><div<?php echo $audittrail->field->cellAttributes() ?>>
			<span id="el_audittrail_field">
<input type="text" data-table="audittrail" data-field="x_field" name="x_field" id="x_field" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($audittrail->field->getPlaceHolder()) ?>" value="<?php echo $audittrail->field->EditValue ?>"<?php echo $audittrail->field->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($audittrail->keyvalue->Visible) { // keyvalue ?>
	<div id="r_keyvalue" class="form-group row">
		<label for="x_keyvalue" class="<?php echo $audittrail_search->LeftColumnClass ?>"><span id="elh_audittrail_keyvalue"><?php echo $audittrail->keyvalue->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_keyvalue" id="z_keyvalue" value="LIKE"></span>
		</label>
		<div class="<?php echo $audittrail_search->RightColumnClass ?>"><div<?php echo $audittrail->keyvalue->cellAttributes() ?>>
			<span id="el_audittrail_keyvalue">
<input type="text" data-table="audittrail" data-field="x_keyvalue" name="x_keyvalue" id="x_keyvalue" size="35" placeholder="<?php echo HtmlEncode($audittrail->keyvalue->getPlaceHolder()) ?>" value="<?php echo $audittrail->keyvalue->EditValue ?>"<?php echo $audittrail->keyvalue->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($audittrail->oldvalue->Visible) { // oldvalue ?>
	<div id="r_oldvalue" class="form-group row">
		<label for="x_oldvalue" class="<?php echo $audittrail_search->LeftColumnClass ?>"><span id="elh_audittrail_oldvalue"><?php echo $audittrail->oldvalue->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_oldvalue" id="z_oldvalue" value="LIKE"></span>
		</label>
		<div class="<?php echo $audittrail_search->RightColumnClass ?>"><div<?php echo $audittrail->oldvalue->cellAttributes() ?>>
			<span id="el_audittrail_oldvalue">
<input type="text" data-table="audittrail" data-field="x_oldvalue" name="x_oldvalue" id="x_oldvalue" size="35" placeholder="<?php echo HtmlEncode($audittrail->oldvalue->getPlaceHolder()) ?>" value="<?php echo $audittrail->oldvalue->EditValue ?>"<?php echo $audittrail->oldvalue->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($audittrail->newvalue->Visible) { // newvalue ?>
	<div id="r_newvalue" class="form-group row">
		<label for="x_newvalue" class="<?php echo $audittrail_search->LeftColumnClass ?>"><span id="elh_audittrail_newvalue"><?php echo $audittrail->newvalue->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_newvalue" id="z_newvalue" value="LIKE"></span>
		</label>
		<div class="<?php echo $audittrail_search->RightColumnClass ?>"><div<?php echo $audittrail->newvalue->cellAttributes() ?>>
			<span id="el_audittrail_newvalue">
<input type="text" data-table="audittrail" data-field="x_newvalue" name="x_newvalue" id="x_newvalue" size="35" placeholder="<?php echo HtmlEncode($audittrail->newvalue->getPlaceHolder()) ?>" value="<?php echo $audittrail->newvalue->EditValue ?>"<?php echo $audittrail->newvalue->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$audittrail_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $audittrail_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$audittrail_search->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$audittrail_search->terminate();
?>