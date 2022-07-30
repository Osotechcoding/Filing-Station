<?php
//send_mail.php

if(isset($_POST['email_data']))
{
 require 'class/class.phpmailer.php';
 $output = '';
 foreach($_POST['email_data'] as $row)
 {
  $mail = new PHPMailer;
  $mail->IsSMTP();        //Sets Mailer to send message using SMTP
  $mail->Host = 'smtpout.secureserver.net';  //Sets the SMTP hosts of your Email hosting, this for Godaddy
  $mail->Port = '80';        //Sets the default SMTP server port
  $mail->SMTPAuth = true;       //Sets SMTP authentication. Utilizes the Username and Password variables
  $mail->Username = 'xxxxxxxxxx';     //Sets SMTP username
  $mail->Password = 'xxxxxxxxxx';     //Sets SMTP password
  $mail->SMTPSecure = '';       //Sets connection prefix. Options are "", "ssl" or "tls"
  $mail->From = 'info@webslesson.com';   //Sets the From email address for the message
  $mail->FromName = 'Webslesson';     //Sets the From name of the message
  $mail->AddAddress($row["email"], $row["name"]); //Adds a "To" address
  $mail->WordWrap = 50;       //Sets word wrapping on the body of the message to a given number of characters
  $mail->IsHTML(true);       //Sets message type to HTML
  $mail->Subject = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit'; //Sets the Subject of the message
  //An HTML or plain text message body
  $mail->Body = '
  <p>Sed at odio sapien. Vivamus efficitur, nibh sit amet consequat suscipit, ante quam eleifend felis, mattis dignissim lectus ipsum eget lectus. Nullam aliquam tellus vitae nisi lobortis, in hendrerit metus facilisis. Donec iaculis viverra purus a efficitur. Maecenas dignissim finibus ultricies. Curabitur ultricies tempor mi ut malesuada. Morbi placerat neque blandit, volutpat felis et, tincidunt nisl.</p>
  <p>In imperdiet congue sollicitudin. Quisque finibus, ipsum eget sagittis pellentesque, eros leo tempor ante, interdum mollis tortor diam ut nisl. Vivamus odio mi, congue eu ipsum vulputate, consequat hendrerit sapien. Aenean mauris nibh, ultrices accumsan ultricies eget, ultrices ut dui. Donec bibendum lectus a nibh interdum, vel condimentum eros auctor.</p>
  <p>Quisque dignissim pharetra tortor, sit amet auctor enim euismod at. Sed vitae enim at augue convallis pellentesque. Donec rhoncus nisi et posuere fringilla. Phasellus elementum iaculis convallis. Curabitur laoreet, dui eget lacinia suscipit, quam erat vehicula nulla, non ultrices elit massa eu dolor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vulputate mauris vel ultricies tempor.</p>
  <p>Mauris est leo, tincidunt sit amet lacinia eget, consequat convallis justo. Morbi sollicitudin purus arcu. Suspendisse pellentesque interdum enim non consectetur. Etiam eleifend pharetra ante a feugiat.</p>
  ';

  $mail->AltBody = '';

  $result = $mail->Send();      //Send an Email. Return true on success or false on error

  if($result["code"] == '400')
  {
   $output .= html_entity_decode($result['full_error']);
  }

 }
 if($output == '')
 {
  echo 'ok';
 }
 else
 {
  echo $output;
 }
}

?>



<?php
//index.php
$connect = new PDO("mysql:host=localhost;dbname=testing", "root", "");
$query = "SELECT * FROM customer ORDER BY customer_id";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
?>
<!DOCTYPE html>
<html>
 <head>
  <title>Send Bulk Email using PHPMailer with PHP Ajax</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
  <br />
  <div class="container">
   <h3 align="center">Send Bulk Email using PHPMailer with PHP Ajax</h3>
   <br />
   <div class="table-responsive">
    <table class="table table-bordered table-striped">
     <tr>
      <th>Customer Name</th>
      <th>Email</th>
      <th>Select</th>
      <th>Action</th>
     </tr>
     <?php
     $count = 0;
     foreach($result as $row)
     {
      $count++;
      echo '
      <tr>
       <td>'.$row["customer_name"].'</td>
       <td>'.$row["customer_email"].'</td>
       <td>
        <input type="checkbox" name="single_select" class="single_select" data-email="'.$row["customer_email"].'" data-name="'.$row["customer_name"].'" />
       </td>
       <td><button type="button" name="email_button" class="btn btn-info btn-xs email_button" id="'.$count.'" data-email="'.$row["customer_email"].'" data-name="'.$row["customer_name"].'" data-action="single">Send Single</button></td>
      </tr>
      ';
     }
     ?>
     <tr>
      <td colspan="3"></td>
      <td><button type="button" name="bulk_email" class="btn btn-info email_button" id="bulk_email" data-action="bulk">Send Bulk</button></td></td>
     </td>
    </table>
   </div>
  </div>
 </body>
</html>

<script>
$(document).ready(function(){
 $('.email_button').click(function(){
  $(this).attr('disabled', 'disabled');
  var id = $(this).attr("id");
  var action = $(this).data("action");
  var email_data = [];
  if(action == 'single')
  {
   email_data.push({
    email: $(this).data("email"),
    name: $(this).data("name")
   });
  }
  else
  {
   $('.single_select').each(function(){
    if($(this). prop("checked") == true)
    {
     email_data.push({
      email: $(this).data("email"),
      name: $(this).data('name')
     });
    }
   });
  }
  
  $.ajax({
   url:"send_mail.php",
   method:"POST",
   data:{email_data:email_data},
   beforeSend:function(){
    $('#'+id).html('Sending...');
    $('#'+id).addClass('btn-danger');
   },
   success:function(data){
    if(data = 'ok')
    {
     $('#'+id).text('Success');
     $('#'+id).removeClass('btn-danger');
     $('#'+id).removeClass('btn-info');
     $('#'+id).addClass('btn-success');
    }
    else
    {
     $('#'+id).text(data);
    }
    $('#'+id).attr('disabled', false);
   }
   
  });
 });
});
</script>

