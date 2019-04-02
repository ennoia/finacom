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
$register = new register();

// Run the page
$register->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$register->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "register";
var fregister = currentForm = new ew.Form("fregister", "register");

// Validate form
fregister.validate = function() {
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
		<?php if ($register->password->Required) { ?>
			elm = this.getElements("x" + infix + "_password");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, ew.language.phrase("EnterPassword"));
		<?php } ?>
			if (fobj.c_password.value != fobj.x_password.value)
				return this.onError(fobj.c_password, ew.language.phrase("MismatchPassword"));
		<?php if ($register->user->Required) { ?>
			elm = this.getElements("x" + infix + "_user");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, ew.language.phrase("EnterUserName"));
		<?php } ?>
		<?php if ($register->correo->Required) { ?>
			elm = this.getElements("x" + infix + "_correo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users->correo->caption(), $users->correo->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
fregister.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fregister.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $register->showPageHeader(); ?>
<?php
$register->showMessage();
?>
<form name="fregister" id="fregister" class="<?php echo $register->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($register->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $register->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="users">
<input type="hidden" name="action" id="action" value="insert">
<!-- Fields to prevent google autofill -->
<input type="hidden" type="text" name="<?php echo Encrypt(Random()) ?>">
<input type="hidden" type="password" name="<?php echo Encrypt(Random()) ?>">
<?php if ($users->isConfirm()) { // Confirm page ?>
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } ?>
<div class="ew-register-div"><!-- page* -->
<?php if ($users->password->Visible) { // password ?>
	<div id="r_password" class="form-group row">
		<label id="elh_users_password" for="x_password" class="<?php echo $register->LeftColumnClass ?>"><?php echo $users->password->caption() ?><?php echo ($users->password->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $users->password->cellAttributes() ?>>
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
<?php if ($users->password->Visible) { // password ?>
	<div id="r_c_password" class="form-group row">
		<label id="elh_c_users_password" for="c_password" class="<?php echo $register->LeftColumnClass ?>"><?php echo $Language->phrase("Confirm") ?> <?php echo $users->password->caption() ?><?php echo ($users->password->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $users->password->cellAttributes() ?>>
<?php if (!$users->isConfirm()) { ?>
<span id="el_c_users_password">
<input type="text" data-table="users" data-field="c_password" name="c_password" id="c_password" size="30" maxlength="32" placeholder="<?php echo HtmlEncode($users->password->getPlaceHolder()) ?>" value="<?php echo $users->password->EditValue ?>"<?php echo $users->password->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_c_users_password">
<span<?php echo $users->password->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($users->password->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="users" data-field="c_password" name="c_password" id="c_password" value="<?php echo HtmlEncode($users->password->FormValue) ?>">
<?php } ?>
</div></div>
	</div>
<?php } ?>
<?php if ($users->user->Visible) { // user ?>
	<div id="r_user" class="form-group row">
		<label id="elh_users_user" for="x_user" class="<?php echo $register->LeftColumnClass ?>"><?php echo $users->user->caption() ?><?php echo ($users->user->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $users->user->cellAttributes() ?>>
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
		<label id="elh_users_correo" for="x_correo" class="<?php echo $register->LeftColumnClass ?>"><?php echo $users->correo->caption() ?><?php echo ($users->correo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $users->correo->cellAttributes() ?>>
<?php if (!$users->isConfirm()) { ?>
<span id="el_users_correo">
<input type="text" data-table="users" data-field="x_correo" name="x_correo" id="x_correo" size="30" maxlength="36" placeholder="<?php echo HtmlEncode($users->correo->getPlaceHolder()) ?>" value="<?php echo $users->correo->EditValue ?>"<?php echo $users->correo->editAttributes() ?>>
</span>
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
</div><!-- /page* -->
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $register->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$users->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("RegisterBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
</form>
<?php
$register->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$register->terminate();
?>