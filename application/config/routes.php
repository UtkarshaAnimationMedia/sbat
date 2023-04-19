<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Home';


$route['get-panchangam'] = 'Home/getpanchangamData';
$route['event/(:any)/(:any)'] = 'Home/GetUpcomingEventById/$1/$2';
$route['all-upcoming-events'] = 'Home/allUpcomingEvents';

$route['calendar'] = 'Home/Calendar';
$route['gallery'] = 'Home/Gallery';
// $route['services'] = 'Home/Services';
$route['services'] = 'Services';
$route['contact-us'] = 'Home/Contact_us';
$route['signin'] = 'Home/Login';
$route['signup'] = 'Home/SignUp';
$route['logout'] = 'Home/Logout';
$route['donations'] = 'Home/Donations';
$route['gallery/(:any)/(:any)'] = 'Home/FilterGalleryBy/$1/$2';
$route['check-login-status'] = 'Home/checkLoginStatus';
$route['get-services'] = 'Home/getServices';


$route['checkout/(:any)'] = 'Checkout/index/$1';



$route['send-email-otp'] = 'Home/sendEmailOTP';
$route['email-otp-verification'] = 'Home/verifyEmailOTP';

$route['send-mobile-otp'] = 'Home/mobileAuth';
$route['phone-login'] = 'Home/Login';
$route['add-service-cart'] = 'Home/addServiceCart';

$route['get-panchangam'] = 'Home/getpanchangamData';
 $route['event/(:any)/(:any)'] = 'Home/GetUpcomingEventById/$1/$2';
  $route['all-upcoming-events'] = 'Home/allUpcomingEvents';


$route['about-temple'] = 'About_Temple/About_temple';
$route['about-committee'] = 'About_Temple/About_committee';
$route['about-deities'] = 'About_Temple/About_deity';
$route['about-priest'] = 'About_Temple/About_priest';
$route['general-reference'] = 'About_Temple/General_reference';
$route['financial-statements'] = 'About_Temple/Financial_statements';
$route['volunteer'] = 'Forms/Volunteers';
$route['membership'] = 'Forms/Membership';

$route['add-volunteer'] = 'Forms/AddVolunteer';
$route['send/your-query'] = 'Home/submitContactForm';



// Admin Redirections

$route['admin/dashboard'] = 'Admin/Dashboard';
$route['admin/in-temple-bookings'] = 'Admin/Dashboard/In_Temple_Bookings';
$route['admin/away-temple-bookings'] = 'Admin/Dashboard/Away_Temple_Bookings';
$route['admin/events-bookings'] = 'Admin/Dashboard/Events_Bookings';
$route['admin/my-donations'] = 'Admin/Dashboard/MyDonations';
$route['admin/my-orders'] = 'Admin/Dashboard/MyOrders';
$route['admin/my-service-request'] = 'Admin/ServiceRequest';

$route['admin/my-profile'] = 'Admin/Dashboard/MyProfile';
$route['admin/update-profile'] = 'Admin/Dashboard/EditProfile';
$route['admin/update/profile'] = 'Admin/Dashboard/UpdateProfile';


$route['admin/getCityByState'] = 'Admin/Dashboard/GetCity';

$route['admin/my-payments'] = 'Admin/Dashboard/MyPayments';


$route['admin/download-reciept/(:any)/(:any)'] = 'Admin/Dashboard/download_reciept/$1/$2';
$route['admin/ServiceRequest'] = 'Admin/ServiceRequest/ServiceRequest';


$route['admin/GetServicesByCategory'] = 'Admin/ServiceRequest/GetServicesByCategory';

$route['admin/service-request'] = 'Admin/ServiceRequest/addServiceRequest';
$route['admin/getPriestByEmail'] = 'Admin/ServiceRequest/getPriestByEmail';


$route['admin/filterBookingData/(:any)'] = 'Admin/Dashboard/FilterBookingData/$1';


$route['admin/yearly/Tax-Letter'] = 'Admin/Dashboard/YearlyTaxLetter';
$route['admin/download/yearly/Tax-Letter'] = 'Admin/Dashboard/DownlaodTaxLetter';







$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;