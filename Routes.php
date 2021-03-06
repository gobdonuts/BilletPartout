<?php
//Redirected the page to a controller 
//and then create the view from the method View
Route::set('index.php',function() {
    HomeController::View('home');
});

Route::set('profile/login',function() {
    ProfileController::LoginView('login');
});
Route::set('profile/homepage',function() {
    ProfileController::HomepageView("homepage");
});
Route::set('profile/SignUp',function() {
    ProfileController::SignUpView("SignUp");
});
Route::set('profile/logout',function() {
    ProfileController::Logout();
});

Route::set('cart/checkout',function() {
    CartController::checkoutView('checkout');
});
Route::set('cart/invoice',function() {
    CartController::invoiceView('invoice');
});

Route::set('show/details',function() {
    ShowController::View('details');
});
Route::set('show/event-info',function() {
    ShowController::InfoView('eventInfo');
});
Route::set('show/list',function() {
    ShowController::ListView('list');
});


Route::set('admin/show',function() {
    AdminController::showView("Show");
});
Route::set('admin/location',function() {
    AdminController::locationView("location");
});
Route::set('admin/showlist',function() {
    AdminController::showListView("showList");
});
Route::set('admin/locationlist',function() {
    AdminController::locationListView("locationList");
});
Route::set('admin/clientlist',function() {
    AdminController::clientListView("clientList");
});
Route::set('admin/fidelitylist',function() {
    AdminController::fidelityListView("fidelityList");
});

if(!in_array($_GET['url'],Route::$validRoute)) {
    InvalidPageController::View('InvalidPage');

    //!!! Pour Développement seulement !!! 
    //echo ("Votre Url est: ".$_GET['url']."<br> Les URL valides sont: ");
    //print_r(Route::$validRoute);
}
?>