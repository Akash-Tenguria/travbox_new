<?php

define('LIVEAPIMODE',true);

//define('LIVEAPIMODE',false);

if(LIVEAPIMODE)

{

	#============= Live SERVER CREDENTIALS =============#

	$hostName="https://api.tripjack.com";

	

	define('_API_KEY_','710761800c1ff0ed-f1ec-4ca1-abea-8de4d3aeb7bd');

	define('_APISEARCH_',$hostName.'/fms/v1/air-search-all');

	define('_FARE_RULE_',$hostName.'/fms/v1/farerule');

	define('_REVIEW_SSR_',$hostName.'/fms/v1/review');

	define('_BOOKING_CONFIRM_URL_',$hostName.'/oms/v1/air/book');

	define('_BOOKING_DETAILS_URL_',$hostName.'/oms/v1/booking-details');

	                   

	               

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

	$hostName="https://apitest.tripjack.com";

	

	define('_API_KEY_','412064383aa387-3b04-4b58-9d8a-ce668d88889e');

	define('_APISEARCH_',$hostName.'/fms/v1/air-search-all');

	define('_FARE_RULE_',$hostName.'/fms/v1/farerule');

	define('_REVIEW_SSR_',$hostName.'/fms/v1/review');

	define('_BOOKING_CONFIRM_URL_',$hostName.'/oms/v1/air/book');

	define('_BOOKING_DETAILS_URL_',$hostName.'/oms/v1/booking-details');

	

	



	

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