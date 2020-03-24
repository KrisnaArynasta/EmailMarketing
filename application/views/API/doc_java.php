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
				<?php echo 'OkHttpClient client = new OkHttpClient();<br>
							<br>
							MediaType mediaType = MediaType.parse("application/x-www-form-urlencoded");<br><br>
							RequestBody body = RequestBody.create(mediaType, "guest_user_id=(Your Guest Hotel ID)&guest_name=(Guest Name)&guest_email=(Guest Email)&guest_country=(Guest Country)");<br><br>
							Request request = new Request.Builder()<br><br>
							  .url("http://webservice.krisnaarynasta.com/Guest")<br>
							  .post(body)<br>
							  .addHeader("content-type", "application/x-www-form-urlencoded")<br>
							  .addHeader("api_key", "(Your API Key)")<br>
							  .addHeader("secret_key", "(Your Secret Key)")<br>
							  .addHeader("cache-control", "no-cache")<br>
							  .build();<br>
								<br>
							Response response = client.newCall(request).execute();';
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
			<?php echo 'OkHttpClient client = new OkHttpClient();<br>
						<br>
						MediaType mediaType = MediaType.parse("application/x-www-form-urlencoded");<br><br>
						//make sure your guest user ID is corrert, server will respone with error if the ID not found on server <br>
						// in the role key Select which command you want to do<br><br>
						RequestBody body = RequestBody.create(mediaType, "guest_user_id=(Your Guest Hotel ID)&guest_name=(Guest Name)&guest_email=(Guest Email)&guest_country=(Guest Country)&role=update/active/deactive");<br><br>
						Request request = new Request.Builder()<br>
						  .url("http://webservice.krisnaarynasta.com/Guest")<br>
						  .put(body)<br>
						  .addHeader("content-type", "application/x-www-form-urlencoded")<br>
						  .addHeader("api_key", "(Your API Key)")<br>
						  .addHeader("secret_key", "(Your Secret Key)")<br>
						  .addHeader("cache-control", "no-cache")<br>
						  .build();<br>
						<br>
						Response response = client.newCall(request).execute();';
			?>	
			</p>
		</div>
	</div>
</div>