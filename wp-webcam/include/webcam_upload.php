<?php
function webcam_upload_form()

	{
	  $imagewidth=get_option( 'webcam_image_width');
      $imageheight=get_option( 'webcam_image_height');
      $imageformat=get_option( 'webcam_image_format');
      $imagequality=get_option( 'webcam_image_quality');
      if(isset($_POST['iamgefile'])):
      $path= wp_upload_dir(date('Y').'/'.date('m'));
      $data = $_POST['iamgefile']; // image data 
      //changing data image into normal form
	  list($type, $data) = explode(';', $data); 
	  list(, $data)      = explode(',', $data);
      $data = str_replace(' ', '+', $data);
	  $data = base64_decode($data); // base 64 decoding 
	  $imagename=date('Ymi');
	  file_put_contents($path['path'].'/image_'.$imagename.'.jpeg', $data);
	  $viewimagelink= site_url('wp-content/uploads/'.date('Y').'/'.date('m').'/'.'image_'.$imagename.'.jpeg');
      echo '<div class="displayWebCamImage">
      		<span><img src="'.$viewimagelink.'"	/></span>
      		<div><a href="'.$viewimagelink.'" target="_blank">View Image ('.$viewimagelink.')</a></div>
      		</div>';
	endif;
	?>

    
	
	<div id="webcamsection" class="webcamsection">
		<h1>Webcam Upload pics</h1>
		<div id="results" class="webcamresult">Captured image will be display here...</div>

		<div id="my_camera" class="myCamera"></div>
		<div class="imgButton">
			<input type=button value="Take Snapshot" class="takesnapshot" onClick="take_snapshot()">
		</div>
		
	</div>
	
	<form method="post" id="imageupload">
	<input type="hidden" name="iamgefile" id="imagewebcam" value="">
	</form>

	<script language="JavaScript">
		Webcam.set({
			width: <?php echo $imagewidth;?>,
			height: <?php echo $imageheight;?>,
			image_format: '<?php echo $imageformat;?>',
			jpeg_quality: <?php echo $imagequality;?>
		});
		Webcam.attach( '#my_camera' );
	</script>
	<!-- Code to handle taking the snapshot and displaying it locally -->
	<script language="JavaScript">
		function take_snapshot() {
			// take snapshot and get image data
			Webcam.snap( function(data_uri) {
				// display results in page
				jQuery('#results').html('<h2>Here is your image:</h2>' + 
					'<img src="'+data_uri+'"/><br><button type="button" id="uploadpics" class="btn_upload">Upload</button>');
				jQuery('#imagewebcam').val(data_uri);
				/*
				document.getElementById('results').innerHTML = 
					'<h2>Here is your image:</h2>' + 
					'<img src="'+data_uri+'"/>';
				*/
			} );
		}
	</script>
	<script type="text/javascript">
		jQuery("body").on("click", "#uploadpics", function() {
			jQuery("#imageupload").submit();

	   } );
	</script>

<?php
  }
add_shortcode( 'webcam', 'webcam_upload_form' );
?>