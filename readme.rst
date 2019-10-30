	udh bisa login, udh bisa nampilin sesson ✔

GET MESSAGE
     get message parameter last get email di db pas load email simpen tanggalnya. ✔
	 get detail email dgn ajax 
 
     encode base64url (gmail)
	 encode utf-8 (yahoo)
	 
	 Imap get inbox dari lebih dari 1 email dan pengirim ✔
     limit message  (via tanggal) ✔
     get message spesific from   ✔
     get mesaage SENT label (ambil dari database)  ✔
	 
	 
SEND MESSAGE
	
	insert data ke outbox ✔
	buat controler, model ✔
	buat controler email sender flag 0 ✔
	
	pas ngirim email auto :
	update status sent
	update tgl & waktu kirim 

	kirim email ke spesific user secara masal ✔
	
	kirim email sesuai event yang berlangsung ✔
	
	limit email sender ✔
	
	get email from multi account ✔

	get email from multi host ✔
	
	sort email by time receive 
	
	read single email

	*pesan dikirm tidak dapat dilakukan dengan gmail API karna 
	account sender tidak dapat diset secara permanent. 
	
	Balas pesan manual
	
	makai cronjob php atau build dengan python ? cronjob

	email di ganti ketika id tamu masih ada yang belum d kirimkan email suatu event
	

	
CRUD EVENT
	Create event
		datepicker
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
	Delete event 	
	

CRUD USER (inget build API key)
	create emails user

apa perlu CRUD GUEST ?
 	GUEST data XCL upload
 
WEBSERVICE
	create guest  ✔
	update guest  ✔
	deactived guest  ✔
	update visiting guest data  ✔
	guest photos create  (single upload) ✔
		create folder per user ✔
		rename nama foto ✔
	guest photo delete ?
	

BUILD API DOCUMENTASION 
(aplikasi pengguna ditanamkan cooding untuk mengirimkan data ke servis kita)

uji coba 
bab 3
sop