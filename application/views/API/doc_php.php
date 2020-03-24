<div class="container">
	<div class="row">
		<div class="col-md-6">
			<h4>
				<b>Method: POST</b>
			</h4>
			<p>
				this function is used for sending a new guest data to PEMS web service
			</p>
			
			<p style="font-family:courier new;font-size:14px;border:1px solid #d8d7db;padding:5px">
				<?php echo '<&#63;php<br>
						<br>
						$curl = curl_init();<br>
						<br>
						curl_setopt_array($curl, array(<br>
						  CURLOPT_URL => "http://webservice.krisnaarynasta.com/Guest",<br>
						  CURLOPT_RETURNTRANSFER => true,<br>
						  CURLOPT_ENCODING => "",<br>
						  CURLOPT_MAXREDIRS => 10,<br>
						  CURLOPT_TIMEOUT => 30,<br>
						  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,<br>
						  CURLOPT_CUSTOMREQUEST => "POST",<br><br>
						  CURLOPT_POSTFIELDS => "guest_user_id=(Your Guest Hotel ID)&guest_name=(Guest Name)&guest_email=(Guest Email)&guest_country=(Guest Country)",<br><br>
						  CURLOPT_HTTPHEADER => array(<br>
							"api_key: (Your API Key)",<br>
							"cache-control: no-cache",<br>
							"content-type: application/x-www-form-urlencoded",<br>
							"secret_key: (Your Secret Key)"<br>
						  ),<br>
						));<br><br>

						$response = curl_exec($curl);<br>
						$err = curl_error($curl);<br>
						<br>
						curl_close($curl);<br>
						<br>
						if ($err) {<br>
						  echo "cURL Error #:" . $err;<br>
						} else {<br>
						  echo $response;<br>
						}<br><br>
					?>';
				?>
			</p>
		</div>
			
		<div class="col-md-6">
			<h4>
				<b>Method: PUT</b>
			</h4>
			<p>
				this function is used for update or deactive or acivating a new guest data to PEMS web service
			</p>
			
			<p style="font-family:courier new;font-size:14px;border:1px solid #d8d7db;padding:5px">
			<?php echo '<&#63;php<br>
				<br>
				$curl = curl_init();<br>
				<br>		
				curl_setopt_array($curl, array(<br>
				  CURLOPT_URL => "http://webservice.krisnaarynasta.com/Guest",<br>
				  CURLOPT_RETURNTRANSFER => true,<br>
				  CURLOPT_ENCODING => "",<br>
				  CURLOPT_MAXREDIRS => 10,<br>
				  CURLOPT_TIMEOUT => 30,<br>
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,<br>
				  CURLOPT_CUSTOMREQUEST => "PUT",<br>
				  <br>
				  //make sure your guest user ID is corrert, server will respone with error if the ID not found on server <br>
				  // in the role key Select which command you want to do<br>
				  CURLOPT_POSTFIELDS => "guest_user_id=(Your%20Guest%20Hotel%20ID)&guest_name=(Guest%20Name)&guest_email=(Guest%20Email)&guest_country=(Guest%20Country)&role=update/active/deactive",<br><br>
				  CURLOPT_HTTPHEADER => array(<br>
					"api_key: (Your API Key)",<br>
					"cache-control: no-cache",<br>
					"content-type: application/x-www-form-urlencoded",<br>
					"secret_key: (Your Secret Key)"<br>
				  ),<br>
				));<br><br>
				<br>
				$response = curl_exec($curl);<br>
				$err = curl_error($curl);<br>
				<br>
				curl_close($curl);<br>
				<br>
				if ($err) {<br>
				  echo "cURL Error #:" . $err;<br>
				} else {<br>
				  echo $response;<br>
				}<br><br>
				?>';
			?>	
			</p>
		</div>
	</div>
</div>