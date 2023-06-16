<?php
define('LIVEAPIMODE',false);
//define('LIVEAPIMODE',false);
if(LIVEAPIMODE)
{
	#============= Live SERVER CREDENTIALS =============#
	define('_API_KEY_','412064383aa387-3b04-4b58-9d8a-ce668d88889e');
	define('_APISEARCH_','https://apitest.tripjack.com/fms/v1/air-search-all');
	                   
	               
/*	define('APIAUTHENTICATE','https://api.travelboutiqueonline.com/SharedAPI/SharedData.svc/rest/Authenticate');
	define('APISEARCH','https://tboapi.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/Search/');
	define('APIFARERULE','https://tboapi.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/FareRule/');
	define('APIFAREQUOTE','https://tboapi.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/FAREQUOTE/');
	define('APIFARECONFIRM','https://tboapi.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/PriceRBD/');
	define('APIBOOK','https://booking.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/Book/');
	define('APITICKET','https://booking.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/Ticket/');
	define('APIGETBOOKING','https://booking.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/GetBookingDetails/');
	
	define('APISSR','https://tboapi.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/SSR/');
	define('APIGETCALENDER','https://booking.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/GetCalendarFare/');
	define('APICalendar','https://tboapi.travelboutiqueonline.com/AirAPI_V10/AirService.svc/rest/UpdateCalendarFareOfDay/');*/
	#============= Live SERVER CREDENTIALS =============#
}
else
{
	#============= TEST SERVER CREDENTIALS =============#
	define('_API_KEY_','412064383aa387-3b04-4b58-9d8a-ce668d88889e');
	define('_APISEARCH_','https://apitest.tripjack.com/fms/v1/air-search-all');
	
	

	
/*	define('APISEARCH','http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/Search/');
	define('APIFARERULE','http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/FareRule/');
	define('APIFAREQUOTE','http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/FAREQUOTE/');
	define('APIFARECONFIRM','http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/PriceRBD/');
	define('APIBOOK','http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/Book/');
	define('APITICKET','http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/Ticket/');
	define('APIGETBOOKING','http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/GetBookingDetails/');
	
	define('APISSR','http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/SSR/');
	define('APIGETCALENDER','http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/GetCalendarFare/');
	define('APICalendar','http://api.tektravels.com/BookingEngineService_Air/AirService.svc/rest/UpdateCalendarFareOfDay/');*/


	#============= TEST SERVER CREDENTIALS =============#
	
}
?>