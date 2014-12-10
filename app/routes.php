<?php

use Paste\Pre;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/**
* Index Page - Displays all the routes
*/
Route::get('/', 'IndexController@getIndex');

/**
* User
* (Explicit Routing)
*/
Route::get('/join','UserController@getJoin' );
Route::post('/join', 'UserController@postJoin' );

Route::get('/login', 'UserController@getLogin' );
Route::post('/login', 'UserController@postLogin' );

Route::get('/logout', 'UserController@getLogout' );

/**
* Channel
* (Explicit Routing)
*/

Route::get('/channel', 'ChannelController@getChannel' );

Route::post('/channel', 'ChannelController@postChannel' );



Route::get('/createChannel', 'ChannelController@createInitialChannel' );

Route::post('/createChannel', 'ChannelController@createInitialChannel' );

Route::post('/play', 'IndexController@playChannel' );

Route::post('/test', function() {

	$query  = Input::get('query');

	return $query;

    # We're demoing two possible return formats: JSON or HTML
    $format = Input::get('format');

    # Do the actual query
    $books  = Book::search($query);

    # Otherwise, loop through the results building the HTML View we'll return
    if($format == 'html') {

        $results = '';          
        foreach($books as $book) {
            # Created a "stub" of a view called book_search_result.php; all it is is a stub of code to display a book
            # For each book, we'll add a new stub to the results

            $results .= View::make('book_search_result')->with('book', $book)->render();   
        }

        # Return the HTML/View to JavaScript...
        return $results;
    }

});


Route::get('mysql-test', function() {

    # Print environment
    echo 'Environment: '.App::environment().'<br>';

    # Use the DB component to select all the databases
    $results = DB::select('SHOW DATABASES;');

    # If the "Pre" package is not installed, you should output using print_r instead
    echo Pre::render($results);

});

