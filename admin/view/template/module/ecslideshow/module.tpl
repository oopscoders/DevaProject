<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-ecslideshow" title="" class="btn btn-primary"><?php echo $button_save; ?></button>
        <a onclick="$('#action').val('save_stay');$('#form-ecslideshow').submit();" title="" class="btn btn-info"><?php echo $button_save_stay; ?></a>
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
    <div class="slidebar"><?php require( DIR_APPLICATION.'view/template/module/ecslideshow/toolbar.tpl' ); ?></div>
    <?php if (isset($error_warning) && $error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-th-large"></i> <?php echo $text_module_setting; ?></h3>
      </div>
    <div class="panel-body">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-ecslideshow" class="form-horizontal">
        <input type="hidden" name="action" id="action" value=""/>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
            <div class="col-sm-10">
              <input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
              <?php if ($error_name) { ?>
              <div class="text-danger"><?php echo $error_name; ?></div>
              <?php } ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="status" id="input-status" class="form-control">
                <?php if ($status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_support_rtl; ?></label>
            <div class="col-sm-8"><select class="form-control" name="support_rtl">
                <?php 
                 if($yesno){
                  foreach($yesno as $key=>$val){
                    if($key == $support_rtl){
                    ?>
                      <option value="<?php echo $key; ?>" selected="selected"><?php echo $val; ?></option>
                    <?php
                    }else{
                      ?>
                      <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                      <?php
                    }
                  }
                 }
                ?>
              </select></div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_async_loading; ?></label>
            <div class="col-sm-8"><select class="form-control" name="enable_async">
                <?php 
                 if($yesno){
                  foreach($yesno as $key=>$val){
                    if($key == $enable_async){
                    ?>
                      <option value="<?php echo $key; ?>" selected="selected"><?php echo $val; ?></option>
                    <?php
                    }else{
                      ?>
                      <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                      <?php
                    }
                  }
                 }
                ?>
              </select></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_banner; ?></label>
            <div class="col-sm-8"><select class="form-control" size="10" name="banner_id">
              <option value="0"><?php echo $text_select_banner;?></option>
                <?php 
                 if($banners){
                  foreach($banners as $banner){
                    if($banner['ecbanner_id'] == $banner_id){
                    ?>
                      <option value="<?php echo $banner['ecbanner_id'] ?>" selected="selected"><?php echo $banner['name']; ?></option>
                    <?php
                    }else{
                      ?>
                       <option value="<?php echo $banner['ecbanner_id'] ?>"><?php echo $banner['name']; ?></option>
                      <?php
                    }
                  }
                 }
                ?>
              </select></div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_limit; ?></label>
            <div class="col-sm-8"><input class="form-control" type="text" name="limit" value="<?php echo $limit; ?>" size="10" /></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_random_slider; ?></label>
            <div class="col-sm-8"><select class="form-control" name="random_mode">
                <?php 
                 if($yesno){
                  foreach($yesno as $key=>$val){
                    if($key == $random_mode){
                    ?>
                      <option value="<?php echo $key; ?>" selected="selected"><?php echo $val; ?></option>
                    <?php
                    }else{
                      ?>
                      <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                      <?php
                    }
                  }
                 }
                ?>
              </select></div>
          </div>

           <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_module_width; ?></label>
            <div class="col-sm-8"><input class="form-control" type="text" name="module_width" value="<?php echo $module_width; ?>" size="10" /></div>
          </div>
           <div class="form-group" style="display:none">
            <label class="col-sm-2 control-label"><?php echo $entry_module_height; ?></label>
            <div class="col-sm-8"><input class="form-control" type="text" name="module_height" value="<?php echo $module_height; ?>" size="10" /></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_module_height; ?></label>
            <div class="col-sm-8"><input class="form-control" type="text" name="height" value="<?php echo $height; ?>" size="10" /></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_main_width; ?></label>
            <div class="col-sm-8"><input class="form-control" type="text" name="main_width" value="<?php echo $main_width; ?>" size="10" /></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_main_height; ?></label>
            <div class="col-sm-8"><input class="form-control" type="text" name="main_height" value="<?php echo $main_height; ?>" size="10" /></div>
          </div>
           <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_thumbnail_width; ?></label>
            <div class="col-sm-8"><input class="form-control" type="text" name="thumbnail_width" value="<?php echo $thumbnail_width; ?>" size="10" /></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_thumbnail_height; ?></label>
            <div class="col-sm-8"><input class="form-control" type="text" name="thumbnail_height" value="<?php echo $thumbnail_height; ?>" size="10" /></div>
          </div>
           <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_resize_main_image; ?></label>
            <div class="col-sm-8"><select class="form-control" name="resize_image">
                 <?php 
                 if($yesno){
                  foreach($yesno as $key=>$val){
                    if($key == $resize_image){
                    ?>
                      <option value="<?php echo $key; ?>" selected="selected"><?php echo $val; ?></option>
                    <?php
                    }else{
                      ?>
                      <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                      <?php
                    }
                  }
                 }
                ?>
              </select></div>
          </div>
           <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_resize_type; ?></label>
            <div class="col-sm-8"><select class="form-control" name="resize_type">
                <?php 
                 if($resiztypes){
                  foreach($resiztypes as $key=>$val){
                    if($key == $resize_type){
                    ?>
                      <option value="<?php echo $key; ?>" selected="selected"><?php echo $val; ?></option>
                    <?php
                    }else{
                      ?>
                      <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                      <?php
                    }
                  }
                 }
                ?>
              </select></div>
          </div>
          <div class="form-group">
            <div colspan="2"><b><?php echo $entry_slider_caption; ?></b></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_show_caption; ?></label>
            <div class="col-sm-8"><select class="form-control" name="show_caption">
                <?php 
                 if($yesno){
                  foreach($yesno as $key=>$val){
                    if($key == $show_caption){
                    ?>
                      <option value="<?php echo $key; ?>" selected="selected"><?php echo $val; ?></option>
                    <?php
                    }else{
                      ?>
                      <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                      <?php
                    }
                  }
                 }
                ?>
              </select></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_strip_html_code; ?></label>
            <div class="col-sm-8"><select class="form-control" name="is_striped">
                <?php 
                 if($yesno){
                  foreach($yesno as $key=>$val){
                    if($key == $is_striped){
                    ?>
                      <option value="<?php echo $key; ?>" selected="selected"><?php echo $val; ?></option>
                    <?php
                    }else{
                      ?>
                      <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                      <?php
                    }
                  }
                 }
                ?>
              </select></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_show_custom_code; ?></label>
            <div class="col-sm-8"><select class="form-control" name="show_custom_code">
                <?php 
                 if($yesno){
                  foreach($yesno as $key=>$val){
                    if($key == $show_custom_code){
                    ?>
                      <option value="<?php echo $key; ?>" selected="selected"><?php echo $val; ?></option>
                    <?php
                    }else{
                      ?>
                      <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                      <?php
                    }
                  }
                 }
                ?>
              </select></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_caption_effect; ?></label>
            <div class="col-sm-8"><select class="form-control" name="caption_effect">
                <?php 
                 if($caption_effects){
                  foreach($caption_effects as $val){
                    if($val == $caption_effect){
                    ?>
                      <option value="<?php echo $val; ?>" selected="selected"><?php echo $val; ?></option>
                    <?php
                    }else{
                      ?>
                      <option value="<?php echo $val; ?>"><?php echo $val; ?></option>
                      <?php
                    }
                  }
                 }
                ?>
              </select></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_show_product_info; ?></label>
            <div class="col-sm-8"><select class="form-control" name="show_product_info">
                <?php 
                 if($yesno){
                  foreach($yesno as $key=>$val){
                    if($key == $show_product_info){
                    ?>
                      <option value="<?php echo $key; ?>" selected="selected"><?php echo $val; ?></option>
                    <?php
                    }else{
                      ?>
                      <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                      <?php
                    }
                  }
                 }
                ?>
              </select></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_title_max_chars; ?></label>
            <div class="col-sm-8"><input class="form-control" type="text" name="title_max_chars" value="<?php echo $title_max_chars; ?>" size="10" /></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_description_max_chars; ?></label>
            <div class="col-sm-8"><input class="form-control" type="text" name="description_max_chars" value="<?php echo $description_max_chars; ?>" size="10" /></div>
          </div>
           <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_caption_background_color; ?></label>
            <div class="col-sm-8"><input class="form-control" type="text" name="background_color" value="<?php echo isset($background_color)?$background_color:""; ?>" class="picker" id="background_color" style="border-color:<?php echo isset($background_color)?"#".$background_color:""; ?>"/></div>
          </div>
           <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_caption_text_color; ?></label>
            <div class="col-sm-8"><input class="form-control" type="text" name="text_color" value="<?php echo isset($text_color)?$text_color:""; ?>" class="picker" id="text_color" style="border-color:<?php echo isset($text_color)?"#".$text_color:""; ?>"/></div>
          </div>
           <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_caption_link_color; ?></label>
            <div class="col-sm-8"><input class="form-control" type="text" name="link_color" value="<?php echo isset($link_color)?$link_color:""; ?>" class="picker" id="link_color" style="border-color:<?php echo isset($link_color)?"#".$link_color:""; ?>"/></div>
          </div>
           <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_addtocart_bg_color; ?></label>
            <div class="col-sm-8"><input class="form-control" type="text" name="addtocart_bg_color" value="<?php echo isset($addtocart_bg_color)?$addtocart_bg_color:""; ?>" class="picker" id="addtocart_bg_color" style="border-color:<?php echo isset($addtocart_bg_color)?"#".$addtocart_bg_color:""; ?>"/></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_addtocart_color; ?></label>
            <div class="col-sm-8"><input class="form-control" type="text" name="addtocart_color" value="<?php echo isset($addtocart_color)?$addtocart_color:""; ?>" class="picker" id="addtocart_color" style="border-color:<?php echo isset($addtocart_color)?"#".$addtocart_color:""; ?>"/></div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_price_color; ?></label>
            <div class="col-sm-8"><input class="form-control" type="text" name="price_color" value="<?php echo isset($price_color)?$price_color:""; ?>" class="picker" id="price_color" style="border-color:<?php echo isset($price_color)?"#".$price_color:""; ?>"/></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_special_price_color; ?></label>
            <div class="col-sm-8"><input class="form-control" type="text" name="special_price_color" value="<?php echo isset($special_price_color)?$special_price_color:""; ?>" class="picker" id="special_price_color" style="border-color:<?php echo isset($special_price_color)?"#".$special_price_color:""; ?>"/></div>
          </div>
           <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_custom_css; ?></label>
            <div class="col-sm-8"><textarea class="form-control" cols="10" rows="15" name="custom_css"><?php echo isset($custom_css)?$custom_css:""; ?></textarea></div>
          </div>
          <div class="form-group">
            <div><b><?php echo $entry_slider_effect; ?></b></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_skin; ?></label>
            <div class="col-sm-8"><select class="form-control" name="skin">
                <?php 
                 if($skins){
                  foreach($skins as $skin){
                    $skin_name = str_replace("_", " ", $skin);
                    if($skin == $skin){
                    ?>
                      <option value="<?php echo $skin; ?>" selected="selected"><?php echo $skin_name; ?></option>
                    <?php
                    }else{
                      ?>
                      <option value="<?php echo $skin; ?>"><?php echo $skin_name; ?></option>
                      <?php
                    }
                  }
                 }
                ?>
              </select></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_alignment; ?></label>
            <div class="col-sm-8"><select class="form-control" name="alignment">
                <?php 
                 if($alignments){
                  foreach($alignments as $key){
                    if($key == $alignment){
                    ?>
                      <option value="<?php echo $key; ?>" selected="selected"><?php echo $key; ?></option>
                    <?php
                    }else{
                      ?>
                      <option value="<?php echo $key; ?>"><?php echo $key; ?></option>
                      <?php
                    }
                  }
                 }
                ?>
              </select></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_auto_advance; ?></label>
            <div class="col-sm-8"><select class="form-control" name="auto_advance">
                <?php 
                 if($yesno){
                  foreach($yesno as $key=>$val){
                    if($key == $auto_advance){
                    ?>
                      <option value="<?php echo $key; ?>" selected="selected"><?php echo $val; ?></option>
                    <?php
                    }else{
                      ?>
                      <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                      <?php
                    }
                  }
                 }
                ?>
              </select></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_mobile_auto_advance; ?></label>
            <div class="col-sm-8"><select class="form-control" name="mobile_auto_advance">
                <?php 
                 if($yesno){
                  foreach($yesno as $key=>$val){
                    if($key == $mobile_auto_advance){
                    ?>
                      <option value="<?php echo $key; ?>" selected="selected"><?php echo $val; ?></option>
                    <?php
                    }else{
                      ?>
                      <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                      <?php
                    }
                  }
                 }
                ?>
              </select></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_bar_direction; ?></label>
            <div class="col-sm-8"><select class="form-control" name="bar_direction">
                <?php 
                 if($directions){
                  foreach($directions as $val){
                    if($val == $bar_direction){
                    ?>
                      <option value="<?php echo $val; ?>" selected="selected"><?php echo $val; ?></option>
                    <?php
                    }else{
                      ?>
                      <option value="<?php echo $val; ?>"><?php echo $val; ?></option>
                      <?php
                    }
                  }
                 }
                ?>
              </select></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_bar_position; ?></label>
            <div class="col-sm-8"><select class="form-control" name="bar_position">
                <?php 
                 if($bar_positions){
                  foreach($bar_positions as $val){
                    if($val == $bar_position){
                    ?>
                      <option value="<?php echo $val; ?>" selected="selected"><?php echo $val; ?></option>
                    <?php
                    }else{
                      ?>
                      <option value="<?php echo $val; ?>"><?php echo $val; ?></option>
                      <?php
                    }
                  }
                 }
                ?>
              </select></div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_min_height; ?></label>
            <div class="col-sm-8"><input class="form-control" type="text" name="min_height" value="<?php echo $min_height; ?>" size="10" /></div>
          </div>
           <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_cols; ?></label>
            <div class="col-sm-8"><input class="form-control" type="text" name="cols" value="<?php echo $cols; ?>" size="10" /></div>
          </div>
           <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_rows; ?></label>
            <div class="col-sm-8"><input class="form-control" type="text" name="rows" value="<?php echo $rows; ?>" size="10" /></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_easing; ?></label>
            <div class="col-sm-8"><select class="form-control" name="easing">
                <?php 
                 if($easings){
                  foreach($easings as $val){
                    if($val == $easing){
                    ?>
                      <option value="<?php echo $val; ?>" selected="selected"><?php echo $val; ?></option>
                    <?php
                    }else{
                      ?>
                      <option value="<?php echo $val; ?>"><?php echo $val; ?></option>
                      <?php
                    }
                  }
                 }
                ?>
              </select></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_fx; ?></label>
            <div class="col-sm-8"><select class="form-control" multiple="multiple" name="fx[]" size="10">
                <?php 
                 if($effects){
                  foreach($effects as $val){
                    if(in_array($val, $fx)){
                    ?>
                      <option value="<?php echo $val; ?>" selected="selected"><?php echo $val; ?></option>
                    <?php
                    }else{
                      ?>
                      <option value="<?php echo $val; ?>"><?php echo $val; ?></option>
                      <?php
                    }
                  }
                 }
                ?>
              </select></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_hover; ?></label>
            <div class="col-sm-8"><select class="form-control" name="hover">
                <?php 
                 if($yesno){
                  foreach($yesno as $key=>$val){
                    if($key == $hover){
                    ?>
                      <option value="<?php echo $key; ?>" selected="selected"><?php echo $val; ?></option>
                    <?php
                    }else{
                      ?>
                      <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                      <?php
                    }
                  }
                 }
                ?>
              </select></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_loader; ?></label>
            <div class="col-sm-8"><select class="form-control" name="loader">
                <?php 
                 if($loaders){
                  foreach($loaders as $val){
                    if($val == $loader){
                    ?>
                      <option value="<?php echo $val; ?>" selected="selected"><?php echo $val; ?></option>
                    <?php
                    }else{
                      ?>
                      <option value="<?php echo $val; ?>"><?php echo $val; ?></option>
                      <?php
                    }
                  }
                 }
                ?>
              </select></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_navigation; ?></label>
            <div class="col-sm-8"><select class="form-control" name="navigation">
                <?php 
                 if($yesno){
                  foreach($yesno as $key=>$val){
                    if($key == $navigation){
                    ?>
                      <option value="<?php echo $key; ?>" selected="selected"><?php echo $val; ?></option>
                    <?php
                    }else{
                      ?>
                      <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                      <?php
                    }
                  }
                 }
                ?>
              </select></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_navigation_hover; ?></label>
            <div class="col-sm-8"><select class="form-control" name="navigation_hover">
                <?php 
                 if($yesno){
                  foreach($yesno as $key=>$val){
                    if($key == $navigation_hover){
                    ?>
                      <option value="<?php echo $key; ?>" selected="selected"><?php echo $val; ?></option>
                    <?php
                    }else{
                      ?>
                      <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                      <?php
                    }
                  }
                 }
                ?>
              </select></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_pagination; ?></label>
            <div class="col-sm-8"><select class="form-control" name="pagination">
                <?php 
                 if($yesno){
                  foreach($yesno as $key=>$val){
                    if($key == $pagination){
                    ?>
                      <option value="<?php echo $key; ?>" selected="selected"><?php echo $val; ?></option>
                    <?php
                    }else{
                      ?>
                      <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                      <?php
                    }
                  }
                 }
                ?>
              </select></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_play_pause; ?></label>
            <div class="col-sm-8"><select class="form-control" name="play_pause">
                <?php 
                 if($yesno){
                  foreach($yesno as $key=>$val){
                    if($key == $play_pause){
                    ?>
                      <option value="<?php echo $key; ?>" selected="selected"><?php echo $val; ?></option>
                    <?php
                    }else{
                      ?>
                      <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                      <?php
                    }
                  }
                 }
                ?>
              </select></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_thumbnails; ?></label>
            <div class="col-sm-8"><select class="form-control" name="thumbnails">
                <?php 
                 if($yesno){
                  foreach($yesno as $key=>$val){
                    if($key == $thumbnails){
                    ?>
                      <option value="<?php echo $key; ?>" selected="selected"><?php echo $val; ?></option>
                    <?php
                    }else{
                      ?>
                      <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                      <?php
                    }
                  }
                 }
                ?>
              </select></div>
          </div>
           <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_time; ?></label>
            <div class="col-sm-8"><input class="form-control" type="text" name="time" value="<?php echo $time; ?>" size="10" /></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_trans_period; ?></label>
            <div class="col-sm-8"><input class="form-control" type="text" name="trans_period" value="<?php echo $trans_period; ?>" size="10" /></div>
          </div>
      </form>
    </div>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
$('#language-general a').tab();
//--></script>
<script type="text/javascript"><!--

$('#background_color').colpick({
  layout:'hex',
  submit:0,
  colorScheme:'dark',
  color: $('#background_color').val(),
  onChange:function(hsb,hex,rgb,fromSetColor) {
    if(!fromSetColor) $('#background_color').val(hex).css('border-color','#'+hex);
  }
}).keyup(function(){
  $(this).colpickSetColor(this.value);
});

$('#text_color').colpick({
  layout:'hex',
  submit:0,
  colorScheme:'dark',
  color: $('#text_color').val(),
  onChange:function(hsb,hex,rgb,fromSetColor) {
    if(!fromSetColor) $('#text_color').val(hex).css('border-color','#'+hex);
  }
}).keyup(function(){
  $(this).colpickSetColor(this.value);
});

$('#link_color').colpick({
  layout:'hex',
  submit:0,
  colorScheme:'dark',
  color: $('#link_color').val(),
  onChange:function(hsb,hex,rgb,fromSetColor) {
    if(!fromSetColor) $('#link_color').val(hex).css('border-color','#'+hex);
  }
}).keyup(function(){
  $(this).colpickSetColor(this.value);
});

$('#link_color').colpick({
  layout:'hex',
  submit:0,
  colorScheme:'dark',
  color: $('#link_color').val(),
  onChange:function(hsb,hex,rgb,fromSetColor) {
    if(!fromSetColor) $('#link_color').val(hex).css('border-color','#'+hex);
  }
}).keyup(function(){
  $(this).colpickSetColor(this.value);
});

$('#addtocart_color').colpick({
  layout:'hex',
  submit:0,
  colorScheme:'dark',
  color: $('#addtocart_color').val(),
  onChange:function(hsb,hex,rgb,fromSetColor) {
    if(!fromSetColor) $('#addtocart_color').val(hex).css('border-color','#'+hex);
  }
}).keyup(function(){
  $(this).colpickSetColor(this.value);
});

$('#price_color').colpick({
  layout:'hex',
  submit:0,
  colorScheme:'dark',
  color: $('#price_color').val(),
  onChange:function(hsb,hex,rgb,fromSetColor) {
    if(!fromSetColor) $('#price_color').val(hex).css('border-color','#'+hex);
  }
}).keyup(function(){
  $(this).colpickSetColor(this.value);
});


$('#special_price_color').colpick({
  layout:'hex',
  submit:0,
  colorScheme:'dark',
  color: $('#special_price_color').val(),
  onChange:function(hsb,hex,rgb,fromSetColor) {
    if(!fromSetColor) $('#special_price_color').val(hex).css('border-color','#'+hex);
  }
}).keyup(function(){
  $(this).colpickSetColor(this.value);
});

$('#addtocart_bg_color').colpick({
  layout:'hex',
  submit:0,
  colorScheme:'dark',
  color: $('#addtocart_bg_color').val(),
  onChange:function(hsb,hex,rgb,fromSetColor) {
    if(!fromSetColor) $('#addtocart_bg_color').val(hex).css('border-color','#'+hex);
  }
}).keyup(function(){
  $(this).colpickSetColor(this.value);
});
//--></script>
<?php echo $footer; ?>