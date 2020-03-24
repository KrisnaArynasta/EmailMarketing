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
				<?php echo 'var client = new RestClient("http://webservice.krisnaarynasta.com/Guest");<br>
							var request = new RestRequest(Method.POST);<br>
							request.AddHeader("cache-control", "no-cache");<br>
							request.AddHeader("secret_key", "(Your Secret Key)");<br>
							request.AddHeader("api_key", "(Your API Key)");<br>
							request.AddHeader("content-type", "application/x-www-form-urlencoded");<br><br>
							request.AddParameter("application/x-www-form-urlencoded", "guest_user_id=(Your Guest Hotel ID)&guest_name=(Guest Name)&guest_email=(Guest Email)&guest_country=(Guest Country)", ParameterType.RequestBody);<br>
							<br>
							IRestResponse response = client.Execute(request);';
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
			<?php echo 'var client = new RestClient("http://webservice.krisnaarynasta.com/Guest");<br>
						var request = new RestRequest(Method.PUT);<br>
						request.AddHeader("cache-control", "no-cache");<br>
						request.AddHeader("secret_key", "(Your Secret Key)");<br>
						request.AddHeader("api_key", "(Your API Key)");<br>
						request.AddHeader("content-type", "application/x-www-form-urlencoded");<br><br>
						//make sure your guest user ID is corrert, server will respone with error if the ID not found on server <br>
						// in the role key Select which command you want to do<br><br>	
						request.AddParameter("application/x-www-form-urlencoded", "guest_user_id=(Your Guest Hotel ID)&guest_name=(Guest Name)&guest_email=(Guest Email)&guest_country=(Guest Country)&role=update/active/deactive", ParameterType.RequestBody);<br>
						<br>
						IRestResponse response = client.Execute(request);';
			?>	
			</p>
		</div>
	</div>
</div>