
<div class="wrap" id="rezgo_settings">
<img src="<?= rezgo_embed_settings_image('logo_rezgo.png') ?>"/>
<?php if($rezgoPluginUpdated) { ?>
    <p class="success">Your Rezgo options have been updated.</p>
<?php } ?>
<p>
    Rezgo makes it easy for you to accept bookings on your tour or activity business WordPress site. To manage your
    Rezgo account, <a href="http://login.rezgo.com" target="_blank">login here</a>.
</p>

<h3>Getting Started</h3>

<p>
<ol>
    <li><a href="http://www.rezgo.com">Sign-up for a Rezgo account</a>.
    <li>Setup your inventory and configure your account on Rezgo.
    <li>Complete the Rezgo WordPress Plugin settings below.
    <li>Create a Page and embed the Rezgo booking engine by using the shortcode: [rezgo_shortcode].
    <li>Ensure you are using a non default permalink structure.&nbsp;
        <?php if ($permalinkStructure == '') { ?>
            <div
                style="border:1px solid #9E0000; padding: 4px; padding-left:6px; padding-right:6px; background-color: #D97F7E; width:-moz-fit-content;">
                <strong>currently using [</strong>default<strong>] which may not work correctly! <a
                        href="/wp-admin/options-permalink.php" style="color:#333333;">Click here</a> to change
                    it.</strong>
            </div>
        <?php } else { ?>
            Your current structure should work!
        <?php } ?>
</ol>
</p>

<form method="post" action="">
<?= settings_fields('rezgo_options') ?>

<script>
    var cid_value = '<?= $rezgoCid ?>';
    var key_value = '<?= $rezgoApiKey ?>';
    function check_values() {
        var cid = $('#rezgo_cid').val();
        var key = $('#rezgo_api_key').val();

        // do nothing if we changed nothing
        if (cid_value != cid || key_value != key) {
            cid_value = cid;
            key_value = key;

            if (cid && key) {
                $('#check_values').html('<img src="<?= rezgo_embed_settings_image('load.gif') ?>">');
                $('#check_values').load('<?=REZGO_URL_BASE.'/settings/settings_ajax.php'?>?cid=' + cid.trim() + '&key=' + key.trim());
								
								
            } else {
                reset_check();
            }
        }
    }

    function reset_check() {
        $('#check_values').html('<span style="required_missing">Information is missing.</span>');
    }
</script>

<div class="field_frame">
    <fieldset>
        <legend class="account_info">Account Information</legend>

        <dl>
            <dt class=note>Your Company Code and API Key can be found on the Rezgo settings page.</dt>

            <br><br>

            <dt>Rezgo Company Code:</dt>
            <dd>
                <input type="text" name="rezgo_cid" id="rezgo_cid" size="10" value="<?= $rezgoCID ?>" onkeyup="check_values()" />
            </dd>
            <dt>Rezgo API Key:</dt>
            <dd>
                <input type="text" name="rezgo_api_key" id="rezgo_api_key" size="20" value="<?= $rezgoApiKey ?>" onkeyup="check_values()" /></dd>

            <div class="api_box" id="check_values">

                <?php
                if($rezgoCID && $rezgoApiKey) {
                    if(!empty($companyName)) { ?>
                        <span class="ajax_success">XML API Connected</span><br>
                        <span class="ajax_success_message"><?= $companyName ?></span>
                        <a href="http://<?= $companyDomain ?>.rezgo.com" class="ajax_success_url" target="_blank"><?= $companyDomain ?>.rezgo.com</a>
                    <?php } else { ?>
                        <span class="ajax_error">XML API Error</span><br>
                        <span class="ajax_error_message"><?= $companyError ?></span>
                    <?php }} else { ?>
                    <span style="required_missing">Information is missing</span>
                <?php } ?>
            </div>
        </dl>
    </fieldset>
</div>
<div class="field_frame">
    <fieldset>
        <legend class="recaptcha_key">Recaptcha API Keys</legend>

        <dl>
            <dt class=note>
                If you wish to use Recaptcha on your contact page, enter your API credentials here. You can get Recaptcha for free from
                <a href="http://www.google.com/recaptcha" target="_blank">Google</a>
            </dt>
            <br><br>
            <dt>Recaptcha Public Key:</dt>
            <dd>
                <input type="text" name="rezgo_captcha_pub_key" size="50"  value="<?= get_option('rezgo_captcha_pub_key') ?>" />
            </dd>
            <dt>Recaptcha Private Key:</dt>
            <dd>
                <input type="text" name="rezgo_captcha_priv_key" size="50" value="<?= get_option('rezgo_captcha_priv_key') ?>"/></dd>
        </dl>

    </fieldset>
</div>

<script type="text/javascript">

    jQuery(document).ready(function () {
        var tpl_text = {
            'default': 'This is the default Rezgo template.',
            'no-conflict': 'Default with jQuery in <em>noConflict</em> mode.',
            'custom': 'This is a custom template.'
        };

        <?php if (get_option('rezgo_template') == 'default' || get_option('rezgo_template') == 'no-conflict') { ?>
        jQuery('#template_description').html(tpl_text['<?= get_option('rezgo_template') ?>']);
        <?php } else { ?>
        jQuery('#template_description').html(tpl_text['custom']);
        jQuery('#tpl_custom').html(ucwords('<?= get_option('rezgo_template') ?>'));
        <?php } ?>

        jQuery('#template_select').change(function() {
            var tpl = jQuery(this).attr('value');

            switch (tpl) {
                case 'default':
                    jQuery('#template_description').html(tpl_text['default']);
                    break;
                case 'no-conflict':
                    jQuery('#template_description').html(tpl_text['no-conflict']);
                    break;
                default:
                    jQuery('#template_description').html(tpl_text['custom']);
                    jQuery('#tpl_custom').html(ucwords(tpl));
                    break;
            }
        });
    });
</script>

<div class="field_frame">
    <fieldset>
        <legend class="general_settings">General Settings</legend>
        <dl>
          <dt class=note>
            How many results do you want to show on each page? We suggest 10. Higher numbers may have an impact on performance.
            <br /><br />
          </dt>
          <?php
						$results_num = get_option('rezgo_result_num');
						if(!$results_num) $results_num = 10;
          ?>
          <dt>Number of results:</dt>
          <dd>
            <input type="text" name="rezgo_result_num" size="5" value="<?= $results_num ?>" />
          </dd>
          <?
						$template_url = REZGO_DIR.'/templates/';
					?>
          <dt class=note>
            The Rezgo template you want to use. Add new templates to <?= $template_url ?>
          </dt>
          <br><br>
          <dt>Template:</dt>
          <dd>
            <select name="rezgo_template" id="template_select">
              <?php
								$handle = opendir($_SERVER['DOCUMENT_ROOT'].$template_url);
								while (false !== ($file = readdir($handle))) {
									if ($file != "." && $file != "..") {
										$select = ($file == get_option('rezgo_template')) ? 'selected' : '';
										echo '<option value="'.$file.'" '.$select.'>'.$file.'</option>';
									}
								}
								closedir($handle);
              ?>
            </select>
            <div id="template_description"></div>
          </dd>
          <dt class=note>
              If you do not have your own security certificate, you can forward users to the Rezgo white-label for booking (we recommend this).
          </dt>
          <br><br>
          <?
						// if forward secure is not yet set to anything, check it as default
						if (get_option('rezgo_forward_secure') === '' || get_option('rezgo_forward_secure') === false) {
								$forward_secure_checked = 'checked';
						} else {
								$forward_secure_checked = (get_option('rezgo_forward_secure')) ? 'checked' : '';
						}
          ?>
          <dt>Forward secure page to Rezgo:</dt>
          <dd>
            <input type="checkbox" name="rezgo_forward_secure" value="1" <?= $forward_secure_checked ?>onclick="if(this.checked == true) { $('#alternate_url').fadeOut(); } else { $('#alternate_url').fadeIn(); }" />
          </dd>
        </dl>

        <div id="alternate_url" style="display: <?= (($forward_secure_checked) ? 'none' : '') ?>">
          <dl>
            <dt class="note">
              By default, Rezgo will use your current domain for the secure site. If you have another
              secure domain you want to use (such as secure.mysite.com) you can specify it here. Otherwise leave
              this blank.
            </dt>
            <dt>Alternate Secure URL:</dt>
            <dd>
                <input type="text" name="rezgo_secure_url" size="50" value="<?= get_option('rezgo_secure_url') ?>"/>
            </dd>
          </dl>
          <br clear="all"/>
        </div>

    </fieldset>
</div>
<br/>
<input type="submit" class="button-primary" value="Save Changes"/>
<input type="hidden" name="rezgo_update" value="1"/>
<input type="hidden" name="action" value="update"/>
<input type="hidden" name="page_options" value="rezgo_cid,rezgo_api_key,rezgo_uri,rezgo_result_num"/>

</form>
<br clear="all"/>
</div>