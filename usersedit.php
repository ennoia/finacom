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
$users_edit = new users_edit();

// Run the page
$users_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$users_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fusersedit = currentForm = new ew.Form("fusersedit", "edit");

// Validate form
fusersedit.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
	if ($fobj.find("#confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		<?php if ($users_edit->IDuser->Required) { ?>
			elm = this.getElements("x" + infix + "_IDuser");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users->IDuser->caption(), $users->IDuser->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($users_edit->password->Required) { ?>
			elm = this.getElements("x" + infix + "_password");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users->password->caption(), $users->password->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($users_edit->user->Required) { ?>
			elm = this.getElements("x" + infix + "_user");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users->user->caption(), $users->user->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($users_edit->correo->Required) { ?>
			elm = this.getElements("x" + infix + "_correo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users->correo->caption(), $users->correo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($users_edit->active->Required) { ?>
			elm = this.getElements("x" + infix + "_active[]");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users->active->caption(), $users->active->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($users_edit->userlevel->Required) { ?>
			elm = this.getElements("x" + infix + "_userlevel");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users->userlevel->caption(), $users->userlevel->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($users_edit->memo->Required) { ?>
			elm = this.getElements("x" + infix + "_memo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users->memo->caption(), $users->memo->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ew.forms[val])
			if (!ew.forms[val].validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
fusersedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fusersedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fusersedit.lists["x_IDuser"] = <?php echo $users_edit->IDuser->Lookup->toClientList() ?>;
fusersedit.lists["x_IDuser"].options = <?php echo JsonEncode($users_edit->IDuser->lookupOptions()) ?>;
fusersedit.lists["x_active[]"] = <?php echo $users_edit->active->Lookup->toClientList() ?>;
fusersedit.lists["x_active[]"].options = <?php echo JsonEncode($users_edit->active->options(FALSE, TRUE)) ?>;
fusersedit.lists["x_userlevel"] = <?php echo $users_edit->userlevel->Lookup->toClientList() ?>;
fusersedit.lists["x_userlevel"].options = <?php echo JsonEncode($users_edit->userlevel->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $users_edit->showPageHeader(); ?>
<?php
$users_edit->showMessage();
?>
<form name="fusersedit" id="fusersedit" class="<?php echo $users_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($users_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $users_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="users">
<input type="hidden" name="k_hash" id="k_hash" value="<?php echo $users_edit->HashValue ?>">
<?php if ($users->UpdateConflict == "U") { // Record already updated by other user ?>
<input type="hidden" name="conflict" id="conflict" value="1">
<?php } ?>
<?php if ($users->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$users_edit->IsModal ?>">
<!-- Fields to prevent google autofill -->
<input class="d-none" type="text" name="<?php echo Encrypt(Random()) ?>">
<input class="d-none" type="password" name="<?php echo Encrypt(Random()) ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($users->IDuser->Visible) { // IDuser ?>
	<div id="r_IDuser" class="form-group row">
		<label id="elh_users_IDuser" for="x_IDuser" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users->IDuser->caption() ?><?php echo ($users->IDuser->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div<?php echo $users->IDuser->cellAttributes() ?>>
<?php if (!$users->isConfirm()) { ?>
<span id="el_users_IDuser">
<span<?php echo $users->IDuser->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($users->IDuser->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="users" data-field="x_IDuser" name="x_IDuser" id="x_IDuser" value="<?php echo HtmlEncode($users->IDuser->CurrentValue) ?>">
<?php } else { ?>
<span id="el_users_IDuser">
<span<?php echo $users->IDuser->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($users->IDuser->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="users" data-field="x_IDuser" name="x_IDuser" id="x_IDuser" value="<?php echo HtmlEncode($users->IDuser->FormValue) ?>">
<?php } ?>
<?php echo $users->IDuser->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users->password->Visible) { // password ?>
	<div id="r_password" class="form-group row">
		<label id="elh_users_password" for="x_password" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users->password->caption() ?><?php echo ($users->password->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div<?php echo $users->password->cellAttributes() ?>>
<?php if (!$users->isConfirm()) { ?>
<span id="el_users_password">
<input type="text" data-table="users" data-field="x_password" name="x_password" id="x_password" size="30" maxlength="32" placeholder="<?php echo HtmlEncode($users->password->getPlaceHolder()) ?>" value="<?php echo $users->password->EditValue ?>"<?php echo $users->password->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_users_password">
<span<?php echo $users->password->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($users->password->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="users" data-field="x_password" name="x_password" id="x_password" value="<?php echo HtmlEncode($users->password->FormValue) ?>">
<?php } ?>
<?php echo $users->password->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users->user->Visible) { // user ?>
	<div id="r_user" class="form-group row">
		<label id="elh_users_user" for="x_user" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users->user->caption() ?><?php echo ($users->user->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div<?php echo $users->user->cellAttributes() ?>>
<?php if (!$users->isConfirm()) { ?>
<span id="el_users_user">
<input type="text" data-table="users" data-field="x_user" name="x_user" id="x_user" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($users->user->getPlaceHolder()) ?>" value="<?php echo $users->user->EditValue ?>"<?php echo $users->user->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_users_user">
<span<?php echo $users->user->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($users->user->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="users" data-field="x_user" name="x_user" id="x_user" value="<?php echo HtmlEncode($users->user->FormValue) ?>">
<?php } ?>
<?php echo $users->user->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users->correo->Visible) { // correo ?>
	<div id="r_correo" class="form-group row">
		<label id="elh_users_correo" for="x_correo" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users->correo->caption() ?><?php echo ($users->correo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div<?php echo $users->correo->cellAttributes() ?>>
<?php if (!$users->isConfirm()) { ?>
<span id="el_users_correo">
<span<?php echo $users->correo->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($users->correo->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="users" data-field="x_correo" name="x_correo" id="x_correo" value="<?php echo HtmlEncode($users->correo->CurrentValue) ?>">
<?php } else { ?>
<span id="el_users_correo">
<span<?php echo $users->correo->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($users->correo->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="users" data-field="x_correo" name="x_correo" id="x_correo" value="<?php echo HtmlEncode($users->correo->FormValue) ?>">
<?php } ?>
<?php echo $users->correo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users->active->Visible) { // active ?>
	<div id="r_active" class="form-group row">
		<label id="elh_users_active" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users->active->caption() ?><?php echo ($users->active->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div<?php echo $users->active->cellAttributes() ?>>
<?php if (!$users->isConfirm()) { ?>
<span id="el_users_active">
<?php
$selwrk = (ConvertToBool($users->active->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="users" data-field="x_active" name="x_active[]" id="x_active[]" value="1"<?php echo $selwrk ?><?php echo $users->active->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_users_active">
<span<?php echo $users->active->viewAttributes() ?>>
<?php if (ConvertToBool($users->active->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $users->active->ViewValue ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $users->active->ViewValue ?>" disabled>
<?php } ?>
</span>
</span>
<input type="hidden" data-table="users" data-field="x_active" name="x_active" id="x_active" value="<?php echo HtmlEncode($users->active->FormValue) ?>">
<?php } ?>
<?php echo $users->active->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users->userlevel->Visible) { // userlevel ?>
	<div id="r_userlevel" class="form-group row">
		<label id="elh_users_userlevel" for="x_userlevel" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users->userlevel->caption() ?><?php echo ($users->userlevel->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div<?php echo $users->userlevel->cellAttributes() ?>>
<?php if (!$users->isConfirm()) { ?>
<span id="el_users_userlevel">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_userlevel"><?php echo strval($users->userlevel->ViewValue) == "" ? $Language->phrase("PleaseSelect") : $users->userlevel->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($users->userlevel->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo (($users->userlevel->ReadOnly || $users->userlevel->Disabled) ? " disabled" : "")?> onclick="ew.modalLookupShow({lnk:this,el:'x_userlevel',m:0,n:10});"><i class="fa fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $users->userlevel->Lookup->getParamTag("p_x_userlevel") ?>
<input type="hidden" data-table="users" data-field="x_userlevel" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $users->userlevel->displayValueSeparatorAttribute() ?>" name="x_userlevel" id="x_userlevel" value="<?php echo $users->userlevel->CurrentValue ?>"<?php echo $users->userlevel->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_users_userlevel">
<span<?php echo $users->userlevel->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($users->userlevel->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="users" data-field="x_userlevel" name="x_userlevel" id="x_userlevel" value="<?php echo HtmlEncode($users->userlevel->FormValue) ?>">
<?php } ?>
<?php echo $users->userlevel->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users->memo->Visible) { // memo ?>
	<div id="r_memo" class="form-group row">
		<label id="elh_users_memo" for="x_memo" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users->memo->caption() ?><?php echo ($users->memo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div<?php echo $users->memo->cellAttributes() ?>>
<?php if (!$users->isConfirm()) { ?>
<span id="el_users_memo">
<textarea data-table="users" data-field="x_memo" name="x_memo" id="x_memo" cols="35" rows="4" placeholder="<?php echo HtmlEncode($users->memo->getPlaceHolder()) ?>"<?php echo $users->memo->editAttributes() ?>><?php echo $users->memo->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el_users_memo">
<span<?php echo $users->memo->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($users->memo->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="users" data-field="x_memo" name="x_memo" id="x_memo" value="<?php echo HtmlEncode($users->memo->FormValue) ?>">
<?php } ?>
<?php echo $users->memo->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$users_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $users_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if ($users->UpdateConflict == "U") { // Record already updated by other user ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='overwrite';"><?php echo $Language->phrase("OverwriteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-reload" id="btn-reload" type="submit" onclick="this.form.action.value='show';"><?php echo $Language->phrase("ReloadBtn") ?></button>
<?php } else { ?>
<?php if (!$users->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $users_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$users_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$users_edit->terminate();
?>