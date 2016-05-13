<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-product_zipcode" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-product_zipcode" class="form-horizontal">
          <div class="form-group required">
						<label class="col-sm-2 control-label" for="input-product"><span data-toggle="tooltip" title="<?php echo $help_product; ?>"><?php echo $entry_product; ?></span></label>
						<div class="col-sm-10">
							<input type="text" name="product" value="<?php echo $product ?>" placeholder="<?php echo $entry_product; ?>" id="input-product" class="form-control" />
							<input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
							<?php if($error_product) { ?>
							<div class="text-danger"><?php echo $error_product; ?></div>
							<?php } ?>
						</div>
					</div>
          <table id="zipcodes" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <td class="text-left"><?php echo $entry_zipcode; ?></td>
                <td></td>
              </tr>
            </thead>
            <tbody>
              <?php $zipcode_row = 0; ?>
              <?php foreach ($product_zipcodes as $product_zipcode) { ?>
              <tr id="zipcode-row<?php echo $zipcode_row; ?>">
                <td class="text-left"><input type="text" name="product_zipcode[<?php echo $zipcode_row; ?>][zipcode]" value="<?php echo $product_zipcode['zipcode']; ?>" placeholder="<?php echo $entry_zipcode; ?>" class="form-control" />
								<?php if(isset($error_zipcode[$zipcode_row]['zipcode'])) { ?>
								<div class="text-danger"><?php echo $error_zipcode[$zipcode_row]['zipcode']; ?></div>
								<?php } ?>
								</td>
								<td class="text-left"><button type="button" onclick="$('#zipcode-row<?php echo $zipcode_row; ?>, .tooltip').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
              </tr>
              <?php $zipcode_row++; ?>
              <?php } ?>
            </tbody>
            <tfoot>
              <tr>
                <td></td>
                <td class="text-left"><button id="button-add-zipcode" type="button" onclick="addZipcode();" data-toggle="tooltip" title="<?php echo $button_product_zipcode_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
              </tr>
            </tfoot>
          </table>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript"><!--
var zipcode_row = <?php echo $zipcode_row; ?>;
function addZipcode() {
	html  = '<tr id="zipcode-row' + zipcode_row + '">';
  html += '  <td class="text-right" ><input type="text" name="product_zipcode[' + zipcode_row + '][zipcode]" value="" placeholder="<?php echo $entry_zipcode; ?>" class="form-control" /></td>';
	html += '  <td class="text-left"><button type="button" onclick="$(\'#zipcode-row' + zipcode_row  + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';
	
	$('#zipcodes tbody').append(html);
	
	zipcode_row++;
}
//--></script>
<script type="text/javascript"><!--
// Product
$('input[name=\'product\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				json.unshift({
					product_id: 0,
					name: '<?php echo $text_none; ?>'
				});

				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['product_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'product\']').val(item['label']);
		$('input[name=\'product_id\']').val(item['value']);
	}
});
//--></script>
<script type="text/javascript"><!--
<?php if(!$product_zipcodes) { ?>
$('#button-add-zipcode').trigger('click');
<?php } ?>
//--></script>
</div>
<?php echo $footer; ?>
