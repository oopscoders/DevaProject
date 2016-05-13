<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
<div class="container-fluid">
  <div class="slidebar"><?php require( DIR_APPLICATION.'view/template/module/ecslideshow/toolbar.tpl' ); ?></div>
    <?php if (isset($error_warning) && $error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="success"><?php echo $success; ?></div>
    <?php } ?>
    <div class="panel panel-default">
        <div class="panel-heading">
         <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $heading_title; ?></h3>
        </div>

        <div class="container-fluid" style="margin-top:10px">
          <div class="pull-left">
            <a onclick="$('#form').submit();" class="btn btn-primary"><?php echo $button_import; ?></a>
            <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
        </div>
        <div class="panel-body">
            <div class="well">
              <div class="row">
                <div class="col-sm-12">
                  <?php if(isset($message)) { 
                    echo $message;
                  } else { ?>
                  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
                    <div style="text-align:center">
                      <input type="hidden" name="action" id="action" value=""/>
                      <br/>
                      <input type="file" name="file" id="csvfile"/>
                      <br/>
                      <?php echo $text_help_import;?>
                  </div>
                  </form>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
      </div>
</div>
</div>
<?php echo $footer; ?>