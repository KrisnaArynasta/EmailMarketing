CRON JOB
	wget https://krisnaarynasta.com/EmailSenderAuto ✔
	wget https://krisnaarynasta.com/EmailSenderEvent ✔


	udh bisa login, udh bisa nampilin sesson ✔
	Logo aplikasi ✔
	
REVISI
	skenario sidang ✔
	CRUD data tamu ✔
	insert bulk data tamu ✔
	unsubscribe ✔
	registrasi google ✔
	profile user d dashboard ✔
	create email server ✔
	
DASHBOARD 
	hitung event yg dikirim hari ini ✔
	hitung total event yang belum dikirim ✔
	total data tamu ✔
	total respond quisoner
	preview respond tamu 5 ✔
	preview 5 inbox tamu ✔

GET MESSAGE
     get message parameter last get email di db pas load email simpen tanggalnya. ✔
	 get detail email dgn ajax ✔
 
     encode base64url (gmail)
	 encode utf-8 (yahoo)
	 
	 Imap get inbox dari lebih dari 1 email dan pengirim ✔
     limit message  (via tanggal) ✔
     get message spesific from   ✔
     get mesaage SENT label (ambil dari database)  ✔
	 
	 kalo host tidak valid jadi gk bisa ngambil emailnya
	 
SEND MESSAGE
	
	send tamplate event email ✔
	
	insert data ke outbox ✔
	buat controler, model ✔
	buat controler email sender flag 0 ✔
	
	pas ngirim email auto :
	update status sent ✔
	update tgl & waktu kirim  ✔

	kirim email ke spesific user secara masal ✔
	
	kirim email sesuai event yang berlangsung ✔
	
	limit email sender ✔
	
	get email from multi account ✔

	get email from multi host ✔
	
	sort email by time receive 
	
	read single email ✔

	*pesan dikirm tidak dapat dilakukan dengan gmail API karna 
	account sender tidak dapat diset secara permanent. 
	
	Balas pesan manual ✔
	
	makai cronjob php atau build dengan python ? cronjob ✔

	email di ganti ketika id tamu masih ada yang belum d kirimkan email suatu event ✔
	
	
OUTBOX
	view message ✔
	seach and pagination ✔
	view detail email ✔
	view by event or direct message ✔
	
	
	
CRUD EVENT
	Create event
		datepicker validation
		tooltip
		validation 
		multi event photos ✔
	Read event
		search ✔
		paggination ✔
		show email tamplate ✔
	Edit event
		multi event photos ✔
		validation 
	Non-actived event 
		activating or deactivating using ajax ✔
	Delete event ✔	 
	

ACCOUNT (inget build API key)
	Create User	
		register user ✔
			captcha 
		emails sender user 
			create ✔
			update ✔
			de/activate ✔
		edit account user ✔
		change password ✔

GUEST
 	GUEST data XCL upload
	view guest ✔
 
WEBSERVICE
	create guest  ✔
	update guest  ✔
	deactived guest  ✔
	update visiting guest data  ✔
	guest photos create  (single upload) ✔
		create folder per user ✔
		rename nama foto ✔
	//guest photo delete ?
	

QUESTIONNAIRE 
	view Questionnaire ✔
		view respond
	create Questionnaire ✔
		multi question ✔
		multi option ✔
	edit Questionnaire 
		edit multi question ✔
		edit multi option ✔
	send Questionnaire ✔
	delete Questionnaire ✔
	fill Questionnaire ✔
	Questionnaire result ✔
	

BUILD API DOCUMENTASION 
(aplikasi pengguna ditanamkan cooding untuk mengirimkan data ke servis kita) ✔

WEBSERVICE
	insert guest data ✔
	update guest data ✔
	delete guest data ✔

kuisoner
form create user - value dinamis di setup pengguna ✔
jawabn tamu 
rating dan review
perlu webservice


    Login to your gmail account, enable imap.

    Let the access here first: https://www.google.com/settings/security/lesssecureapps

    Go to: https://accounts.google.com/b/0/DisplayUnlockCaptcha and enable access.
		