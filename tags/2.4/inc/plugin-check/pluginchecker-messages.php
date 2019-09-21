<?php 
// If Plugin isn't installed  
function ninja_form_no_installed() { ?>

	<div class="notice notice-error no-dismissible">
		<h2>Install & Activate Ninja Forms!</h2>
		<p>Please install Ninja Forms now. Click here: </p>
		<p>
            <a href="<?php echo admin_url( 'plugins.php?page=tgmpa-install-plugins');?>">Install & activate Ninja Forms now.</a>
		</p>
	</div>

<?php }

// If Ninja Fomrs no support an function
function nfmta_notice_no_plugin_support() { ?>

	<div class="notice notice-error no-dismissible">
		<h2>Ninja Forms Merge Tag Addon no support Ninja Forms in this Edition!</h2>
		<p>Please use different Editions of Ninja Forms or contact the Ninja Forms Team.</p>
		<p>
			<a href="<?php echo admin_url( 'plugins.php');?>">Deactivate this Plug-In now.</a>
		</p>
	</div>

<?php }