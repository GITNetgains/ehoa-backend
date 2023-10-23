<!-- <h1>To Verify Your Email Click on the below link</h1> -->



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<!---for email template-->
<table bgcolor="#fbfbfb" width="400" border="0" align="center" cellpadding="4" cellspacing="0" style="border:solid 1px #ccc; padding:20px;">
  <tr>
    <td align="center"><img src="https://wahine.netgains.org/public/template/img/ehoa.png" /></td>
  </tr>
  <tr>
    <td align="center" style="font-size:18px; font-family:Arial, Helvetica, sans-serif; font-weight:bold;">You have to verify your email through this link! Kindly click on link</td>
    
  </tr>
  <tr><td>&nbsp;</td></tr>
  <tr>
    <td align="center" style="background:#090; color:#fff; border-radius:5px; padding:5px;">
    <a href="{{asset('/email-verify-msg')}}/{{$token}}/{{$user_id}}" style="color:#fff; text-decoration:none; text-transform:uppercase; font-size:15px">verify email</a></td>
  </tr>
</table>






</body>
</html>
