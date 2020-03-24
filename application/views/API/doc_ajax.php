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
				<?php echo 'var settings = {<br>
							  "async": true,<br>
							  "crossDomain": true,<br>
							  "url": "http://webservice.krisnaarynasta.com/Guest",<br>
							  "method": "POST",<br><br>
							  "headers": {<br>
								"content-type": "application/x-www-form-urlencoded",<br>
								"api_key": "(Your API Key)",<br>
								"secret_key": "(Your Secret Key)",<br>
								"cache-control": "no-cache"<br>
							  },<br><br>
							  "data": {<br>
								"guest_user_id": "(Your Guest Hotel ID)",<br>
								"guest_name": "(Guest Name)",<br>
								"guest_email": "(Guest Email)",<br>
								"guest_country": "(Guest Country)"<br>
							  }<br>
							}<br>
							<br>
							$.ajax(settings).done(function (response) {<br>
							  console.log(response);<br>
							});';
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
			<?php echo 'var settings = {<br>
						  "async": true,<br>
						  "crossDomain": true,<br>
						  "url": "http://webservice.krisnaarynasta.com/Guest",<br>
						  "method": "PUT",<br><br>
						  "headers": {<br>
							"content-type": "application/x-www-form-urlencoded",<br>
							"api_key": "(Your API Key)",<br>
							"secret_key": "(Your Secret Key)",<br>
							"cache-control": "no-cache"<br>
						  },<br><br>
						  "data": {<br>
							"guest_user_id": "(Your Guest Hotel ID)", //make sure your guest user ID is corrert, server will respone with error if the ID not found on server<br>
							"guest_name": "(Guest Name)",<br>
							"guest_email": "(Guest Email)",<br>
							"guest_country": "(Guest Country)",<br>
							"role": "update/active/deactive" // in the role key Select which command you want to do<br>
						  }<br>
						}<br>
						<br>
						$.ajax(settings).done(function (response) {<br>
						  console.log(response);<br>
						});';
			?>	
			</p>
		</div>
	</div>
</div>