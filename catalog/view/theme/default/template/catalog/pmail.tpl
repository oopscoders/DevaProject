<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php if($seller){ ?>
<title><?php echo $text_sellersubject; ?></title>
<?php }elseif($admin){ ?>
<title><?php echo $text_adminsubject; ?></title>
<?php } ?>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000000;background:#f1f1f1; padding: 10px 0px;
width: 99%;">

<div class="msgdiv" style="font-size:12px;	width:100%;	padding:20px; background:#fff;border:1px solid #ccc;width: 93%;">
<a href="<?php echo $store_url; ?>" title="<?php echo $store_name; ?>"><img src="<?php echo $logo; ?>" alt="<?php echo $store_name; ?>" id="logo"  style="max-width:200px; max-height:200px;margin-bottom: 10px;"/></a><br>

	<?php if($seller){ ?>

		<span class="hi" style="font-size:22px;color:#004274;display: block;"><?php echo $text_hello.$customer['firstname'].' '.$customer['lastname'].' ,'; ?></span>
		
		<span style=" display: block;margin: 5px 0px;color: #004274;font-size: 13px; "> <?php echo $text_to_seller; ?></span>

		<?php if($autoApprove){ ?>
			<span style=" display: block;margin: 1px 0px;color: #004274;font-size: 13px; "><?php echo $text_auto; ?> </span>
			<br>
		<?php } ?>	

</div>
<div class="bottom" style="width: 100%;margin: auto;font-size: 14px;font-weight: bold;padding-top: 8px;text-align: center;"><?php echo $text_thanksadmin.$name; ?></div>	

	<?php }elseif($admin){ ?>

	<span class="hi"  style="font-size:22px;color:#004274;display: block;"><?php echo $text_hello.$name.','; ?></span>	
	<span style=" display: block;margin: 3px 0px;color: #004274;font-size: 13px; "> <?php echo $text_name.' : '.$customer['firstname'].' '.$customer['lastname']; ?></span>
	<span style=" display: block;margin: 3px 0px;color: #004274;font-size: 13px; "><?php echo $text_email.' : '.$customer['email']; ?> </span>	
	<span style=" display: block;margin: 3px 0px;color: #004274;font-size: 13px; "> <?php echo $text_to_admin; ?></span>
	<span style=" display: block;margin: 3px 0px;color: #004274;font-size: 13px; "><?php echo $text_pname; ?></span>
	<br>

</div>
<div class="bottom" style="width: 100%;margin: auto;font-size: 14px;font-weight: bold;padding-top: 8px;text-align: center;"><?php echo $text_thanksadmin.$customer['firstname']; ?></div>

	<?php } ?>

</body>
</html>
