<?php
Route::get('/',                                                         'User\PageController@showHome');                                // READY
// USER AREA - GUEST //
Route::group(['middleware' => 'guest'], function () {
    // --- GUEST PAGES --- //
    Route::get('/register',                                             'User\PageController@showRegister');                            // TO-DO
    Route::get('/login',                                                'User\PageController@showLogin');                               // TO-DO
    Route::get('/forgotten-password',                                   'User\PageController@showForgottenPassword');                   // TO-DO
    Route::get('/forgotten-password/{uuid}/{forgottenPasswordKey}',     'User\PageController@showChangeForgottenPassword');             // TO-DO

    // --- GUEST ACTIONS --- //
    Route::post('/user/register',                                       'User\ActionController@register');                              // READY
    Route::get('/activate/{uuid}/{activationKey}',                      'User\ActionController@activate');                              // READY
    Route::post('/user/login',                                          'User\ActionController@login');                                 // READY
    Route::post('/user/submitForgottenPassword',                        'User\ActionController@submitForgottenPassword');               // READY
    Route::post('/user/changeForgottenPassword',                        'User\ActionController@changeForgottenPassword');               // READY
});
// END //

// USER AREA //
Route::group(['middleware' => 'auth'], function () {
    // --- USER PAGES --- //
    Route::get('/dashboard',                                            'User\PageController@showDashboard');                           // TO-DO
    Route::get('/orders/new',                                           'User\PageController@showOrdersNew');                           // TO-DO
    Route::get('/account',                                              'User\PageController@showAccount');                             // TO-DO
    // --- USER ACTIONS --- //
    Route::get('/logout',                                               'User\ActionController@logout');                                // READY
    // Account //
    Route::post('/user/updateAccount',                                  'User\ActionController@updateAccount');                         // TO-DO
    Route::post('/user/changePassword',                                 'User\ActionController@changePassword');                        // TO-DO
});
// END //