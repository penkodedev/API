<?php

// Function to retrieve data to be used in the dropdown
function fetch_data() {
	
$api_url = ''; // ABSOLUTE URL OF JSON API DATA

// GET request to the API
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $api_url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
));

$response = curl_exec($curl);
curl_close($curl);

// Decode the JSON data
$data = json_decode($response, true);

// Use the data as needed
	return $data;
  }
  
  // Function to display the custom meta field
  function display_custom_meta_field() {
	$data = fetch_data();
	?>
	<select name="custom_meta_field_name">
	  <?php foreach ($data as $option) { ?>
		<option value="<?php echo $option; ?>"><?php echo $option; ?></option>
	  <?php } ?>
	</select>
	<?php
  }
  
  // Add the custom meta field to a metabox
  add_action('add_meta_boxes', 'add_custom_meta_box');
  function add_custom_meta_box() {
	add_meta_box(
	  'custom_meta_box_id',
	  'Custom Meta Box Title',
	  'display_custom_meta_field',
	  'page',
	  'normal',
	  'default'
	);
  }