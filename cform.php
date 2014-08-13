<?php
// cform style, feel free to edit it
echo "
<style type=\"text/css\">
<!--
html, body { border: 0; margin: 0; padding: 0; }
body { font: 62.5% Arial, sans-serif; min-width: 100%; color: #666; }
p, label, legend { font: 1.5em Arial, sans-serif; }
h1 { margin: 10px 0 10px; font-size: 24px; color: #333333; }
hr { color: inherit; height: 0; margin: 6px 0 6px 0; padding: 0; border: 1px solid #d9d9d9; border-style: none none solid; }
#contact { display: block; width: 650px; margin: 70px auto; padding: 35px; border: 1px solid #cbcbcb; background-color: #FFF; }

/* Form style */
label { display: inline-block; float: left; height: 26px; line-height: 26px; width: 155px; font-size: 1.5em; }
input, textarea, select { margin: 0; padding: 5px; color: #666; background: #f5f5f5; border: 1px solid #ccc; margin: 5px 0; font:1.5em Arial, sans-serif; }   
input:focus, textarea:focus, select:focus { border: 1px solid #999; background-color: #fff; color:#333; }
input.submit { cursor: pointer; border: 1px solid #222; background:#333; color:#fff; -moz-border-radius: 5px; -webkit-border-radius:5px; }
input.submit:hover { background:#444; }
fieldset { padding:20px; border:1px solid #eee;  }
legend { padding:7px 10px; font-weight:bold; color:#000; border:1px solid #eee;  }
span.required{ font-size: 13px; color: #ff0000; } /* Select the colour of the * if the field is required. */

/* Style for the error message */
.error_message { display: block; height: 22px; line-height: 22px; background: #FBE3E4; padding: 3px 10px 3px 35px; margin: 10px 0; color:#8a1f11;border: 1px solid #FBC2C4; }
#succsess_page h1 {  }
-->
</style>
";

echo '<div id="contact">';

        // Configuration option.
		// Each option that is easily editable has a modified example given.

		$error    = '';
        $name     = ''; 
        $email    = ''; 
        $phone    = ''; //Put on inforont of the $phone // tags and to deactive phone number
        $subject  = ''; 
        $comments = ''; 
        $verify   = '';
		
        if(isset($_POST['contactus'])) {
        
		$name     = $_POST['name'];
        $email    = $_POST['email'];
        $phone   = $_POST['phone']; //Put on inforont of the $phone // tags and to deactive phone number
        $subject  = $_POST['subject'];
        $comments = $_POST['comments'];
        $verify   = $_POST['verify'];
		
        // Configuration option.
		// You may change the error messages below.
		// e.g. $error = 'Attention! This is a customised error message!';
		
        if(trim($name) == '') {
        	$error = '<div class="error_message">Внимание! Трябва да въведете вашето име.</div>'; //Attention! You must enter your name
        } else if(trim($email) == '') {
        	$error = '<div class="error_message">Внимание! Моля въведете имейл адрес.</div>'; //Attention! Please enter a valid email address
       
       } else if(trim($phone) == '') {
		$error = '<div class="error_message">Внимание! Моля въведете телефон за връзка.</div>'; //Attention! Please enter phone number.
       // Configuration option.
       // Remove the // tags below to active phone number.
	   } else if(!is_numeric($phone)) {
          $error = '<div class="error_message">Внимание! Телефоният номер може да съдържа само цифри.</div>'; //Attention! Phone number can only contain digits
       
        } else if(!isEmail($email)) {
        	$error = '<div class="error_message">Внимание! Въвели сте невалиден имейл адрес, опитайте отново.</div>'; //Attention! You have enter an invalid e-mail address, try again
        }
		
        if(trim($subject) == '') {
        	$error = '<div class="error_message">Внимание! Полето "Относно" е празно. Моля попълнете го.</div>'; //Attention! Please enter a subject.
        } else if(trim($comments) == '') {
        	$error = '<div class="error_message">Внимание! Моля въведете вашето съобщение.</div>'; //Attention! Please enter your message
        } else if(trim($verify) == '') {
	    	$error = '<div class="error_message">Внимание! Моля въведете номера за проверка.</div>'; //Attention! Please enter the verification number.
	    } else if(trim($verify) != '3') {
	    	$error = '<div class="error_message">Внимание! Номерът за проверка, който се въвели е неправилен.</div>'; //Attention! The verification number you entered is incorrect.
	    }
		
        if($error == '') {
        
			if(get_magic_quotes_gpc()) {
            	$comments = stripslashes($comments);
            }


         // Configuration option.
		 // Enter the email address that you want to emails to be sent to.
		 // Example $address = "joe.doe@yourdomain.com";
		 
         $address = "ppopstoyanov@gmail.com";


         // Configuration option.
         // i.e. The standard subject will appear as, "You've been contacted by John Doe."
		 
         // Example, $e_subject = '$name . ' has contacted you via Your Website.';
         $e_subject = 'You\'ve been contacted by ' . $name . '.';


         // Configuration option.
		 // You can change this if you feel that you need to.
		 // Developers, you may wish to add more fields to the form, in which case you must be sure to add them here.
					
		 $e_body = "You have been contacted by $name with regards to $subject, their additional message is as follows.\r\n\n";
		 $e_content = "\"$comments\"\r\n\n";
		 
		 // Configuration option.
       	 // RIf you active phone number, swap the tags of $e-reply below to include phone number.
		 $e_reply = "You can contact $name via email, $email or via phone $phone";
		 //$e_reply = "You can contact $name via email, $email";
					
         $msg = $e_body . $e_content . $e_reply;

         mail($address, $e_subject, $msg, "From: $email\r\nReply-To: $email\r\nReturn-Path: $email\r\n");


		 //Email has sent successfully, echo a success page.
					
		 echo "<div id='succsess_page'>";
		 echo "<h1>Имейла беше изпратен успешно.</h1>"; //Email Sent Successfully.
		 echo "<p>Благодарим Ви <strong>$name</strong>, вашето съобщение беше подадено до нас.</p>"; //Thank you <strong>$name</strong>, your message has been submitted to us.
		 echo '<font size = "2"><a href="index.php">Kъм главното меню</a></font>';
		 echo "</div>";
                
		}
	}
	
         if(!isset($_POST['contactus']) || $error != '') // Do not edit.
         {
?>

            <h1>Много бърза форма за контакт</h1> <!-- Very fast contact form -->
            
            <?php echo $error; ?>
            
            <fieldset>
            
            <legend>Моля попълнете следният формуляр за да се свържете с нас</legend> <!-- Please fill form to contact us -->

            <form  method="post" action="">

			<label for=name accesskey=U><span class="required">*</span> Вашето име</label> <!-- Name -->
            <input name="name" type="text" id="name" size="30" value="<?php echo $name;?>" />

			<br />
            <label for=email accesskey=E><span class="required">*</span> Вашият имейл</label> <!-- Email -->
            <input name="email" type="text" id="email" size="30" value="<?php echo $email;?>" />

			<br />
            <label for=phone accesskey=P><span class="required">*</span> Телефон за връзка</label> <!-- Phone -->
            <input name="phone" type="text" id="phone" size="30" value="<?php echo $phone;?>" />

			<br />
            
            <label for=subject accesskey=S><span class="required">*</span> Относно</label> <!-- Subject -->
            <select name="subject" type="text" id="subject">
              <option value="Support">Информация, въпроси и предложения</option> <!-- Suggestions -->
              <option value="Motaquip Parts">Резервни части</option> <!-- Motaquip Parts -->
              <option value="Job">Работа при нас</option> <!-- Job -->
	      <option value="Online Reservation">Резервирай час</option> <!-- Online Rezervation -->
	      <option value="a Bug fix">Съобщи за грешка</option> <!-- Report a bug -->
            </select>

			<br />
            <label for=comments accesskey=C><span class="required">*</span> Коментар</label> <!-- Comment -->
            <textarea name="comments" cols="40" rows="3"  id="comments"><?php echo $comments;?></textarea>

            <hr />
            
            <p><span class="required">*</span> Човек ли сте?</p> <!-- Are you human -->
            
            <label for=verify accesskey=V>&nbsp;&nbsp;&nbsp;2 + 1 =</label>
			<input name="verify" type="text" id="verify" size="4" value="<?php echo $verify;?>" /><br /><br />

            <input name="contactus" type="submit" class="submit" id="contactus" value="Изпрати" /> <!-- Submit -->
            </form>
            
            </fieldset>
	    <br />
	    <font size = "2">
	    <a href="index.php">Назад към главното меню</a></font>
<?php } 	
function isEmail($email) { // Email address verification, do not edit.
return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i",$email));
}
//echo base64_decode("PGEgaHJlZj0iaHR0cDovL3d3dy5uZXhvbnNvZnQuZXUiIHRhcmdldD0iX2JsYW5rIiB0aXRsZT0iTmV4b25Tb2Z0IFdlYiBEZXZlbG9wbWVudCBBZ2VuY3kiIHN0eWxlPSJzaXplOjdweDtjb2xvcjojOTk5O21hcmdpbjoxMHB4OyI+RGV2ZWxvcGVkIGJ5IE5leG9uU29mdDwvYT4=");
//echo "</div>";
?>
