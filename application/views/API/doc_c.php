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
				<?php echo 'CURL *hnd = curl_easy_init();<br>
							<br>
							curl_easy_setopt(hnd, CURLOPT_CUSTOMREQUEST, "POST");<br><br>
							curl_easy_setopt(hnd, CURLOPT_URL, "http://webservice.krisnaarynasta.com/Guest");<br>
							<br>
							struct curl_slist *headers = NULL;<br><br>
							headers = curl_slist_append(headers, "cache-control: no-cache");<br><br>
							headers = curl_slist_append(headers, "secret_key: (Your Secret Key)");<br><br>
							headers = curl_slist_append(headers, "api_key: (Your API Key)");<br><br>
							headers = curl_slist_append(headers, "content-type: application/x-www-form-urlencoded");<br><br>
							curl_easy_setopt(hnd, CURLOPT_HTTPHEADER, headers);<br>
							<br>
							curl_easy_setopt(hnd, CURLOPT_POSTFIELDS, "guest_user_id=(Your Guest Hotel ID)&guest_name=(Guest Name)&guest_email=(Guest Email)&guest_country=(Guest Country)");<br>
							<br>
							CURLcode ret = curl_easy_perform(hnd);';
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
			<?php echo 'CURL *hnd = curl_easy_init();<br>
						<br>
						curl_easy_setopt(hnd, CURLOPT_CUSTOMREQUEST, "PUT");<br><br>
						curl_easy_setopt(hnd, CURLOPT_URL, "http://webservice.krisnaarynasta.com/Guest");<br>
						<br>
						struct curl_slist *headers = NULL;<br><br>
						headers = curl_slist_append(headers, "cache-control: no-cache");<br><br>
						headers = curl_slist_append(headers, "secret_key: (Your Secret Key)");<br><br>
						headers = curl_slist_append(headers, "api_key: (Your API Key)");<br><br>
						headers = curl_slist_append(headers, "content-type: application/x-www-form-urlencoded");<br><br>
						curl_easy_setopt(hnd, CURLOPT_HTTPHEADER, headers);<br>
						<br>
						//make sure your guest user ID is corrert, server will respone with error if the ID not found on server <br>
						// in the role key Select which command you want to do<br><br>							
						curl_easy_setopt(hnd, CURLOPT_POSTFIELDS, "guest_user_id=(Your Guest Hotel ID)&guest_name=(Guest Name)&guest_email=(Guest Email)&guest_country=(Guest Country)&role=update/active/deactive");<br>
						<br>
						CURLcode ret = curl_easy_perform(hnd);';
			?>	
			</p>
		</div>
	</div>
</div>