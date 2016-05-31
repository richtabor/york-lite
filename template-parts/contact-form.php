<?php
/**
 * The contact form.
 *
 * @package York
 */


if(isset($_POST['submitted'])) {

    if(trim($_POST['messageName']) === '') {
        $hasError = true;
    } else {
        $name = trim($_POST['messageName']);
    }
    
    if(trim($_POST['messageEmail']) === '')  {
        $hasError = true;
    } else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['messageEmail']))) {
        $hasError = true;
    } else {
        $email = trim($_POST['messageEmail']);
    }

    if(trim($_POST['messageContent']) === '') {
        $hasError = true;
    } else {
        if(function_exists('stripslashes')) {
            $content = stripslashes(trim($_POST['messageContent']));
        } else {
            $content = trim($_POST['messageContent']);
        }
    }
        
    if(!isset($hasError)) {
        
        $site_name = get_bloginfo('name');
        $contactEmail = get_theme_mod( 'contact_email');
        
        if (!isset($contactEmail) || ($contactEmail == '') ){
            $contactEmail = get_option('admin_email');
        }
        
        $subject = '['.$site_name.' Contact Form]';
        $body = "Name: $name \n\nEmail: $email \n\nMessage: $content";
    
        $headers = 'Reply-To: ' . $email;
        
        /*  
        By default, this form will send from wordpress@yourdomain.com in order to work with 
        a number of web hosts' anti-spam measures. If you want the from field to be the
        user sending the email, please uncomment the following line of code.
        */
        //$headers = 'From: '.$name.' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $email;
        
        wp_mail($contactEmail, $subject, $body, $headers);
        
        $emailSent = true;
    }
    
} 

if(isset($emailSent) && $emailSent == true ) : ?>
    
    <div class="contact-alert success">
        <?php _e('Your message was sent. Thanks.', 'york') ?>    
    </div>

<?php endif;

if(isset($hasError) || isset($captchaError)) : ?>

    <div class="contact-alert fail">
        <?php _e('An error occured. Try again.', 'york') ?>
    </div>
    
<?php endif; ?>

<form xid="contact-form" class="bean-contact-form" method="post" id="contact-form" >
    
    <div class="group name">
        <label for="messageName"><?php esc_html_e('Name ', 'york'); ?></label>
        <input type="text" name="messageName" id="messageName" value="<?php if(isset($_POST['messageName'])) echo esc_html($_POST['messageName']);?>" class="required requiredField" required/> 
    </div>
    
    <div class="group email">   
        <label for="messageEmail"><?php esc_html_e('Email ', 'york');  ?></label>
        <input type="text" name="messageEmail" id="messageEmail" value="<?php if(isset($_POST['messageEmail']))  echo esc_html($_POST['messageEmail']);?>" class="required requiredField email" required/>
    </div>

    <div class="group message last">
        <label for="messageContent"><?php esc_html_e('Message ', 'york'); ?></label>
        <textarea name="messageContent" id="messageContent" rows="20" cols="30" class="required requiredField" required><?php if(isset($_POST['messageContent'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['messageContent']); } else { echo esc_html($_POST['messageContent']); } } ?></textarea>
    </div>
    
    <div class="submit">
        <input type="hidden" name="submitted" id="submitted" value="true" />
        <button type="submit" class="button"><?php echo get_theme_mod('contact_button', 'Send');?></button>
    </div>

</form>