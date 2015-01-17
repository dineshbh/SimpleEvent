<?php

Route::filter('payment', '\Filters\PaymentFilter');

Route::when('admin/*', 'csrf', array('post'));
Route::when('panel/*', 'csrf', array('post'));
Route::when('recovery', 'csrf', array('post'));

Route::post('recovery', ['as' => 'recovery', 'uses' => '\User\LoginController@recovery']);

Route::get('admin/login', '\Admin\CMSController@loginPage');
Route::post('admin/login', '\Admin\CMSController@loginAction');
Route::get('admin/logout', '\Admin\CMSController@logoutAction');

// Admin routes
Route::group(array('prefix' => 'admin', 'before' => 'admin_auth', 'namespace' => 'Admin'), function() {
	// DONE
	Route::get('/', 'CMSController@indexPage');
    Route::get('principal', 'CMSController@indexPage');

    // CRUD páginas
    Route::get('paginas/{path?}', 'PagesController@listing');
    Route::get('paginas/{id}/editar', 'PagesController@edit');
    Route::post('paginas/{id}/editar', 'PagesController@save');

    // CRUD posts
    Route::get('noticias', 'PostsController@listing');
    Route::get('noticias/criar', 'PostsController@create');
    Route::post('noticias/criar/{id}/{creating}', 'PostsController@save');
    Route::get('noticias/{id}/editar', 'PostsController@edit');
    Route::post('noticias/{id}/editar', 'PostsController@save');
    Route::get('noticias/{id}/excluir', 'PostsController@delete');

    // CRUD Inscrições
    Route::get('inscricoes', 'SubscriptionsController@listing');
    Route::get('inscricoes/{id}', 'SubscriptionsController@listByParticipation');
    Route::get('inscricoes/inscricao/{id}', 'SubscriptionsController@inscricao');

    // CRUD Trabalhos
    Route::get('trabalhos', 'PapersController@listing');
    Route::get('trabalhos/{id}/editar', 'PapersController@edit');

    // CRUD Certificados
    Route::get('certificados', 'CertsController@listing');
    Route::get('certificados/{id}', 'CertsController@edit');

});

Route::get('panel/login', ['as' => 'user.login', 'uses' => '\User\LoginController@loginPage']);
Route::post('panel/login', ['as' => 'user.login', 'uses' => '\User\LoginController@loginAction']);
Route::get('panel/logout', ['as' => 'user.logout', 'uses' => '\User\LoginController@logoutAction']);

Route::group(array('prefix' => 'panel', 'before' => 'auth', 'namespace' => 'User'), function()
{

	Route::get('/', function() { return Redirect::route('papel.main'); });
    Route::get('main', ['as' => 'panel.main', 'uses' => 'ProfileController@indexPage']);

    Route::post('update', ['as' => 'user.update', 'uses' => 'ProfileController@update']);

    // Envio de Trabalhos
    Route::get('papers', ['as' => 'papers.list', 'uses' => 'PapersController@listing']);
    Route::get('paper/submit', ['as' => 'papers.submit', 'uses' => 'PapersController@create']);
    Route::post('paper/submit', ['as' => 'papers.submit', 'uses' => 'papersController@store']);
    Route::any('paper/search', ['as' => 'papers.search', 'uses' => 'PapersController@search']);
    Route::get('paper/{id}', ['as' => 'papers.view', 'uses' => 'PapersController@view']);

    // Envio de Mesa Redonda
    Route::get('talks', ['as' => 'talks.list', 'uses' => 'TalksController@listing']);
    Route::get('talk/submit', ['as' => 'talks.submit', 'uses' => 'TalksController@create']);
    Route::post('talk/submit', ['as' => 'talks.submit', 'uses' => 'TalksController@store']);
    Route::any('talk/search', ['as' => 'talks.search', 'uses' => 'TalksController@search']);

    // Envio de Salas
    Route::get('rooms', ['as' => 'rooms.list', 'uses' => 'RoomsController@listing']);
    Route::get('room/submit', ['as' => 'rooms.submit', 'uses' => 'RoomsController@create']);
    Route::post('room/submit', ['as' => 'rooms.submit', 'uses' => 'RoomsController@store']);
    Route::any('room/search', ['as' => 'rooms.search', 'uses' => 'RoomsController@search']);

    // Certificados
    Route::get('certificates', ['as' => 'certs.list', 'uses' => 'CertsController@listing']);

    // Métodos de Pagamento
    Route::post('payment', ['as' => 'payment', 'uses' => 'PaymentController@payment']);
});

Route::get('/pt/pagina-congressista', function() { return Redirect::route('user.login'); });
Route::get('/fr/page-personalle', function() { return Redirect::route('user.login'); });
Route::get('/en/congressist-profile', function() { return Redirect::route('user.login'); });

Route::get('/', ['as' => 'home', 'uses' => function() {
    return Redirect::to("http://www.jirs2015.com.br/index.php/" . \App::getLocale() . "/index");
}]);



// Formulário de cadastro
Route::get('/{lang}/inscricoes', 'SigninController@signupForm')->where(['lang' => 'pt']);
Route::get('/{lang}/registration', 'SigninController@signupForm')->where(['lang' => 'en']);
Route::get('/{lang}/inscriptions', 'SigninController@signupForm')->where(['lang' => 'fr']);
Route::post('signup', ['as' => 'signup', 'uses' => 'SigninController@processSignup']);

// Postagens
Route::get('/{lang}/post/{slug}', ['as' => 'posts', 'uses' => 'HomeController@showPost']);

// Páginas estáticas
Route::get('/{lang}/{slug}',  ['as' => 'statics', 'uses' => 'HomeController@showPage']);

Route::post('pagseguro/notification', ['as' => 'pagseguro.notification', 'uses' => 'HomeController@notification']);