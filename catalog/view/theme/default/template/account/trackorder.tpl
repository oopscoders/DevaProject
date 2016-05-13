<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <?php if ($success) { ?>
  <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?></div>
  <?php } ?>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <h2><?php echo $heading_title; ?></h2>
      <div id="track-order" class="form-horizontal">
        <fieldset>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-order"><?php echo $text_order; ?></label>
            <div class="col-sm-5">
              <input type="text" name="order_id" value="" placeholder="<?php echo $text_order; ?>" id="input-order" class="form-control" />
	            </div>
          </div>
					<div class="form-group required">
            <label class="col-sm-2 control-label" for="input-email"><?php echo $text_email; ?></label>
            <div class="col-sm-5">
              <input type="text" name="email" value="" placeholder="<?php echo $text_email; ?>" id="input-email" class="form-control" />
            </div>
          </div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-email">&nbsp;</label>
						<div class="col-sm-5">
							<button class="btn btn-primary" id="button-track"><?php echo $button_track; ?></button>	
						</div>			
          </div>			
				</fieldset>					
				<fieldset id="order_history"></fieldset>					
			</div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>

<script type="text/javascript"><!--
$('input[name="email"],input[name="order_id"]').keypress(function(event){
	var keycode = (event.keyCode ? event.keyCode : event.which);
	if(keycode == '13'){
		trackOrder();
	}
});

$('#button-track').click(function(){
	trackOrder();
});

function trackOrder() {
	$.ajax({
		url: 'index.php?route=account/trackorder/trackOrder',
		dataType: 'json',
		type: 'post',
		data: $('#track-order input[name="email"], #track-order input[name="order_id"]'),
		beforeSend: function() {
			$('#button-track').button('loading');
		},
		complete: function() {
			$('#button-track').button('reset');
		},
		success: function(json) {
			$('#track-order .form-group').removeClass('has-error');
			$('#track-order .text-danger, .alert').remove();
			if(json['error_order_id']) {
				$('#track-order input[name="order_id"]').after('<div class="text-danger">'+ json['error_order_id'] +'</div>');
				$('#track-order .text-danger').parent().parent().addClass('has-error');
			}
			
			
			if(json['error_email']) {
				$('#track-order input[name="email"]').after('<div class="text-danger">'+ json['error_email'] +'</div>');
				$('#track-order .text-danger').parent().parent().addClass('has-error');
			}	
			if(json['error_not_found']) {
				$('.breadcrumb').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> '+ json['error_not_found'] +'</div>');
  		}
			
			if(json['success']) {
				$('.breadcrumb').after('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+ json['success'] +'</div>');
			}
			
			if(json['order_html']) {
				$('#order_history').html(json['order_html']);
			}else{
				$('#order_history').html('');
			}
			
		},
	});
}
//--></script></div>
<?php echo $footer; ?>
