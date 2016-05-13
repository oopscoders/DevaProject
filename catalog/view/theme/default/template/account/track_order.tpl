<?php echo $header; ?>
<style>
input, select, textarea{
    color: #f00;
}
</style>
<div class="contact-page">
   <div class="container">
<div class="row">
	<?php echo $column_left; ?>
		<?php echo $content_top; ?>
		
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>

        
		

		<?php if (isset($error_warning)) { ?>
		<div class="alert alert-error" style="color:red;"><?php echo $error_warning; ?></div>
		<?php } ?>
<div class="col-md-9">
<div class="content" >
<?php
if(empty($histories))
{
?>
<div class="row " align="left">
<h2>Track Your Order</h2>
<br />
</div>
		
<form class="form-horizontal"  action="<?php echo $action; ?>" method="post">
			<!--<input type="hidden" name="route" value="account/track_order" />-->
            
            <div class="row">
            
            <div class="col-md-6">
            <label style="font-size:20px;">Enter Order Id&nbsp;</label>
			<input type="text" name="order_id" class="form-control"  placeholder="Please Enter Order Id" required >
            </div>
            </div>
            <br />
            <div class="row">
           
            <div class="col-md-6">
            <label style="font-size:20px;">Enter Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
			<input type="text"   name="email" class="form-control" placeholder="Please Type Email" required>
            </div>
            </div>
            
            
            <br />
            <div class="row colg">
            
            <div class="col-md-6 ">
			<button type="submit" class="btn btn-primary"><?php echo $btn_track_order; ?></button>
            </div>
            </div>
		</form>
<?php } 
else
{
?>
<div class="row" style="font-size:15px;">
<div class="alert-info"> Product Details</div>

<div class="row">
<div class="col-md-2">Order ID</div>
<div class="col-md-4">Product Name</div>
<div class="col-md-4">Product Price</div>
<div class="col-md-2">Order Date</div>
</div>

<div class="row">
<div class="col-md-2"><?=$order_info['order_id']?></div>
<div class="col-md-4"><?=$products['name']?></div>
<div class="col-md-4"><?=$products['total']?></div>
<div class="col-md-2"><?=$order_info['date_added']?></div>
</div>


</div>
<br />

<div class="row" style="font-size:14px;"> 
<div class="col-md-2 alert-warning">Date</div>
<div class="col-md-2 alert-warning">Status</div>
<div class="col-md-2 alert-warning">Comment</div>
</div>

<?php foreach($histories as $history): ?>
<div class="row">
<div class="col-md-2"><?=$history['date_added']?></div>
<div class="col-md-2"><?=$history['status']?></div>
<div class="col-md-2"><?=$history['comment']?></div>
</div>
<?php endforeach ?>




<?php
}
?>
        
        </div>
</div>
		

		<?php echo $content_bottom; ?>
        <?php echo $column_right; ?>
	
</div>
</div>
</div>
<?php echo $footer; ?>