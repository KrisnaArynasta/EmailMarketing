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
				<?php echo 'require "uri"<br>
							require "net/http"<br>
							<br>
							url = URI("http://webservice.krisnaarynasta.com/Guest")<br>
							<br>
							http = Net::HTTP.new(url.host, url.port)<br>
							<br>
							request = Net::HTTP::Post.new(url)<br>
							request["content-type"] = "application/x-www-form-urlencoded"<br>
							request["api_key"] = "(Your API Key)"<br>
							request["secret_key"] = "(Your Secret Key)"<br>
							request["cache-control"] = "no-cache"<br><br>
							request.body = "guest_user_id=(Your Guest Hotel ID)&guest_name=(Guest Name)&guest_email=(Guest Email)&guest_country=(Guest Country)"<br>
							<br>
							response = http.request(request)<br>
							puts response.read_body';
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
			<?php echo 'require "uri"<br>
						require "net/http"<br>
						<br>
						url = URI("http://webservice.krisnaarynasta.com/Guest")<br>
						<br>
						http = Net::HTTP.new(url.host, url.port)<br>
						<br>
						request = Net::HTTP::Put.new(url)<br>
							request["content-type"] = "application/x-www-form-urlencoded"<br>
							request["api_key"] = "(Your API Key)"<br>
							request["secret_key"] = "(Your Secret Key)"<br>
							request["cache-control"] = "no-cache"<br><br>
							//make sure your guest user ID is corrert, server will respone with error if the ID not found on server <br>
							// in the role key Select which command you want to do<br><br>
						request.body = "guest_user_id=(Your Guest Hotel ID)&guest_name=(Guest Name)&guest_email=(Guest Email)&guest_country=(Guest Country)&role=update/active/deactive"<br>
						<br>
						response = http.request(request)<br>
						puts response.read_body';
			?>	
			</p>
		</div>
	</div>
</div>