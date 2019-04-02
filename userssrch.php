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
$users_search = new users_search();

// Run the page
$users_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$users_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "search";
<?php if ($users_search->IsModal) { ?>
var fuserssearch = currentAdvancedSearchForm = new ew.Form("fuserssearch", "search");
<?php } else { ?>
var fuserssearch = currentForm = new ew.Form("fuserssearch", "search");
<?php } ?>

// Form_CustomValidate event
fuserssearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fuserssearch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fuserssearch.lists["x_IDuser"] = <?php echo $users_search->IDuser->Lookup->toClientList() ?>;
fuserssearch.lists["x_IDuser"].options = <?php echo JsonEncode($users_search->IDuser->lookupOptions()) ?>;
fuserssearch.lists["x_active[]"] = <?php echo $users_search->active->Lookup->toClientList() ?>;
fuserssearch.lists["x_active[]"].options = <?php echo JsonEncode($users_search->active->options(FALSE, TRUE)) ?>;
fuserssearch.lists["x_userlevel"] = <?php echo $users_search->userlevel->Lookup->toClientList() ?>;
fuserssearch.lists["x_userlevel"].options = <?php echo JsonEncode($users_search->userlevel->lookupOptions()) ?>;

// Form object for search
// Validate function for search

fuserssearch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $users_search->showPageHeader(); ?>
<?php
$users_search->showMessage();
?>
<form name="fuserssearch" id="fuserssearch" class="<?php echo $users_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($users_search->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $users_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="users">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$users_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($users->IDuser->Visible) { // IDuser ?>
	<div id="r_IDuser" class="form-group row">
		<label for="x_IDuser" class="<?php echo $users_search->LeftColumnClass ?>"><span id="elh_users_IDuser"><?php echo $users->IDuser->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_IDuser" id="z_IDuser" value="="></span>
		</label>
		<div class="<?php echo $users_search->RightColumnClass ?>"><div<?php echo $users->IDuser->cellAttributes() ?>>
			<span id="el_users_IDuser">
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($users->IDuser->EditValue) ?>">
<?php } else { ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_IDuser"><?php echo strval($users->IDuser->AdvancedSearch->ViewValue) == "" ? $Language->phrase("PleaseSelect") : $users->IDuser->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($users->IDuser->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo (($users->IDuser->ReadOnly || $users->IDuser->Disabled) ? " disabled" : "")?> onclick="ew.modalLookupShow({lnk:this,el:'x_IDuser',m:0,n:10});"><i class="fa fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $users->IDuser->Lookup->getParamTag("p_x_IDuser") ?>
<input type="hidden" data-table="users" data-field="x_IDuser" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $users->IDuser->displayValueSeparatorAttribute() ?>" name="x_IDuser" id="x_IDuser" value="<?php echo $users->IDuser->AdvancedSearch->SearchValue ?>"<?php echo $users->IDuser->editAttributes() ?>>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($users->password->Visible) { // password ?>
	<div id="r_password" class="form-group row">
		<label for="x_password" class="<?php echo $users_search->LeftColumnClass ?>"><span id="elh_users_password"><?php echo $users->password->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_password" id="z_password" value="LIKE"></span>
		</label>
		<div class="<?php echo $users_search->RightColumnClass ?>"><div<?php echo $users->password->cellAttributes() ?>>
			<span id="el_users_password">
<input type="text" data-table="users" data-field="x_password" name="x_password" id="x_password" size="30" maxlength="32" placeholder="<?php echo HtmlEncode($users->password->getPlaceHolder()) ?>" value="<?php echo $users->password->EditValue ?>"<?php echo $users->password->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($users->user->Visible) { // user ?>
	<div id="r_user" class="form-group row">
		<label for="x_user" class="<?php echo $users_search->LeftColumnClass ?>"><span id="elh_users_user"><?php echo $users->user->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_user" id="z_user" value="LIKE"></span>
		</label>
		<div class="<?php echo $users_search->RightColumnClass ?>"><div<?php echo $users->user->cellAttributes() ?>>
			<span id="el_users_user">
<input type="text" data-table="users" data-field="x_user" name="x_user" id="x_user" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($users->user->getPlaceHolder()) ?>" value="<?php echo $users->user->EditValue ?>"<?php echo $users->user->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($users->correo->Visible) { // correo ?>
	<div id="r_correo" class="form-group row">
		<label for="x_correo" class="<?php echo $users_search->LeftColumnClass ?>"><span id="elh_users_correo"><?php echo $users->correo->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_correo" id="z_correo" value="LIKE"></span>
		</label>
		<div class="<?php echo $users_search->RightColumnClass ?>"><div<?php echo $users->correo->cellAttributes() ?>>
			<span id="el_users_correo">
<input type="text" data-table="users" data-field="x_correo" name="x_correo" id="x_correo" size="30" maxlength="36" placeholder="<?php echo HtmlEncode($users->correo->getPlaceHolder()) ?>" value="<?php echo $users->correo->EditValue ?>"<?php echo $users->correo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($users->active->Visible) { // active ?>
	<div id="r_active" class="form-group row">
		<label class="<?php echo $users_search->LeftColumnClass ?>"><span id="elh_users_active"><?php echo $users->active->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_active" id="z_active" value="="></span>
		</label>
		<div class="<?php echo $users_search->RightColumnClass ?>"><div<?php echo $users->active->cellAttributes() ?>>
			<span id="el_users_active">
<?php
$selwrk = (ConvertToBool($users->active->AdvancedSearch->SearchValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="users" data-field="x_active" name="x_active[]" id="x_active[]" value="1"<?php echo $selwrk ?><?php echo $users->active->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($users->userlevel->Visible) { // userlevel ?>
	<div id="r_userlevel" class="form-group row">
		<label for="x_userlevel" class="<?php echo $users_search->LeftColumnClass ?>"><span id="elh_users_userlevel"><?php echo $users->userlevel->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_userlevel" id="z_userlevel" value="="></span>
		</label>
		<div class="<?php echo $users_search->RightColumnClass ?>"><div<?php echo $users->userlevel->cellAttributes() ?>>
			<span id="el_users_userlevel">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_userlevel"><?php echo strval($users->userlevel->AdvancedSearch->ViewValue) == "" ? $Language->phrase("PleaseSelect") : $users->userlevel->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($users->userlevel->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo (($users->userlevel->ReadOnly || $users->userlevel->Disabled) ? " disabled" : "")?> onclick="ew.modalLookupShow({lnk:this,el:'x_userlevel',m:0,n:10});"><i class="fa fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $users->userlevel->Lookup->getParamTag("p_x_userlevel") ?>
<input type="hidden" data-table="users" data-field="x_userlevel" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $users->userlevel->displayValueSeparatorAttribute() ?>" name="x_userlevel" id="x_userlevel" value="<?php echo $users->userlevel->AdvancedSearch->SearchValue ?>"<?php echo $users->userlevel->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($users->memo->Visible) { // memo ?>
	<div id="r_memo" class="form-group row">
		<label for="x_memo" class="<?php echo $users_search->LeftColumnClass ?>"><span id="elh_users_memo"><?php echo $users->memo->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_memo" id="z_memo" value="LIKE"></span>
		</label>
		<div class="<?php echo $users_search->RightColumnClass ?>"><div<?php echo $users->memo->cellAttributes() ?>>
			<span id="el_users_memo">
<input type="text" data-table="users" data-field="x_memo" name="x_memo" id="x_memo" size="35" placeholder="<?php echo HtmlEncode($users->memo->getPlaceHolder()) ?>" value="<?php echo $users->memo->EditValue ?>"<?php echo $users->memo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$users_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $users_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$users_search->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$users_search->terminate();
?>