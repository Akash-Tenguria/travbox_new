<?php
//define('LIVEAPIMODE',true);
define('LIVEAPIMODE',false);
if(LIVEAPIMODE)
{
	#============= Live SERVER CREDENTIALS =============#
	define('ClientId','');
	define('APIUSERNAME','');
	define('APIPASSWORD','');
	                   
	               
	define('APIAUTHENTICATE','https://api.travelboutiqueonline.com/SharedAPI/SharedData.svc/rest/Authenticate');
	define('APISEARCH','https://tboapi.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/Search/');
	define('APIFARERULE','https://tboapi.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/FareRule/');
	define('APIFAREQUOTE','https://tboapi.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/FAREQUOTE/');
	define('APIFARECONFIRM','https://tboapi.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/PriceRBD/');
	define('APIBOOK','https://booking.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/Book/');
	define('APITICKET','https://booking.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/Ticket/');
	define('APIGETBOOKING','https://booking.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/GetBookingDetails/');
	
	define('APISSR','https://tboapi.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/SSR/');
	define('APIGETCALENDER','https://booking.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/GetCalendarFare/');
	define('APICalendar','https://tboapi.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/UpdateCalendarFareOfDay/');
	#============= Live SERVER CREDENTIALS =============#
}
else
{
	#============= TEST SERVER CREDENTIALS =============#
	define('APIAUTHENTICATE','http://api.tektravels.com/SharedServices/SharedData.svc/rest/Authenticate');
	define('APISEDL','http://api.tektravels.com/SharedServices/SharedData.svc/rest/Search/');
	define('ClientId','ApiIntegrationNew');
	define('APIUSERNAME','AirGennie');
	define('APIPASSWORD','AirGennie@1234');
	


	
	define('APISEARCH','http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/Search/');
	define('APIFARERULE','http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/FareRule/');
	define('APIFAREQUOTE','http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/FAREQUOTE/');
	define('APIFARECONFIRM','http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/PriceRBD/');
	define('APIBOOK','http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/Book/');
	define('APITICKET','http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/Ticket/');
	define('APIGETBOOKING','http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/GetBookingDetails/');
	
	define('APISSR','http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/SSR/');
	define('APIGETCALENDER','http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/GetCalendarFare/');
	define('APICalendar','http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/UpdateCalendarFareOfDay/');


	#============= TEST SERVER CREDENTIALS =============#
	
}
?>