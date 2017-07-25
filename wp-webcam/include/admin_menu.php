<?php
  /*adding Menu and submenu in admin*/
  function webcam_admin_menu()
    {
    add_menu_page(__('webcam-registration', 'webcam_table'), __('webcam upload', 'ac-webcam_table'), 'activate_plugins', 'Webcam', 'create_webcam_form',plugins_url('/wp-webcam/img/webcam.png'));
    }
  add_action('admin_menu', 'webcam_admin_menu');
  
        /*adding Menu and submenu in admin end */
    function create_webcam_form()
    {
      if(isset($_POST['submit'])):
        if($_POST['image_width']==''||$_POST['image_height']==''||$_POST['image_format']==''||$_POST['image_quality']==''):
          $errormessage='Please fill all the required field';
          else:
          $image_width=$_POST['image_width'];
          $image_height=$_POST['image_height'];
          $image_format=$_POST['image_format'];
          $image_quality=$_POST['image_quality'];
          update_option( 'webcam_image_width', $image_width);
          update_option( 'webcam_image_height', $image_height);
          update_option( 'webcam_image_format', $image_format);
          update_option( 'webcam_image_quality', $image_quality);
           $message="Updated sucessfully";
        endif;
      endif;
        
      $imagewidth=get_option( 'webcam_image_width');
      $imageheight=get_option( 'webcam_image_height');
      $imageformat=get_option( 'webcam_image_format');
      $imagequality=get_option( 'webcam_image_quality');
  
  ?>
<?php if(isset($message)):?>
<div id="message" class="updated notice notice-success is-dismissible">
  <p><?php echo $message;?>.</p>
  <button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
</div>
<?php endif;?>
<?php if(isset($errormessage)):?>
<div id="message" class="updated notice notice-success is-dismissible">
  <p style="color:red"><?php echo $errormessage;?>.</p>
  <button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
</div>
<?php endif;?>
<form method="post">
  <table class="form-table">
    <tbody>
      <tr>
        <td colspan="2">
          <h2>Webcam Settings</h2>
        </td>
      </tr>
      <tr class="form-field form-required">
        <th scope="row"><label for="image_width">Image Width<span class="description">*</span></label></th>
        <td><input type="text" id="image_width" required="" name="image_width" value="<?php echo $imagewidth;?>"></td>
      </tr>
      <tr class="form-field form-required">
        <th scope="row"><label for="image_height">Image Height<span class="description">*</span></label></th>
        <td><input type="text" id="image_height" required="" name="image_height" value="<?php echo $imageheight;?>"></td>
      </tr>
      <tr class="form-field form-required">
        <th scope="row"><label for="image_format">Image Format<span class="description">*</span></label>
         
        </th>
        <td><input type="text" id="image_format" required="" name="image_format" value="<?php echo $imageformat;?>"><br/>
          <span>Image formate should be JPEG|PNG|GIF|JPG</span>
        </td>
      </tr>
      <tr class="form-field form-required">
        <th scope="row"><label for="image_quality">Image_Quality<span class="description">*</span></label></th>
        <td><input type="text" id="image_quality" required="" name="image_quality" value="<?php echo $imagequality;?>"><br/>
        <span>Please Enter Image quality between 1 to 100</span>
        </td>
      </tr>
      <tr>
        
            <th scope="row" colspan="2">Note:
            <h1>How to use webcam upload</h1>
            Add this plugin in your local system or <strong>https</strong> based server and set the webcam height,width, and image quality from back end and add sort code [webcam] in any page/post to view webcam.</th>
        

      </tr>
    </tbody>
  </table>
  <p class="submit" style="float: right; padding-right: 50px;"><input type="submit" name="submit" id="submit" class="button button-primary" value="SUBMIT "></p>
</form>
<?php
  }
  ?>