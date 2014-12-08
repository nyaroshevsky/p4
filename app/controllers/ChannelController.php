<?php
class ChannelController extends \BaseController {
	/**
	*
	*/
	public function __construct() {
		# Make sure BaseController construct gets called
		parent::__construct();
		$this->beforeFilter('auth', array('except' => ['getIndex','getDigest']));
	}

	public function getChannel() {
		
		$html_for_all_channels = "";
		$html_for_users_channels = "";

		$add_id_list_for_ajax = "";
		$add_id_list_for_ajax = '\'' . $add_id_list_for_ajax;

		$erase_id_list_for_ajax = "";
		$erase_id_list_for_ajax = '\'' . $erase_id_list_for_ajax;

		//get all channels
		$channels = Channel::all();

		$count = 0;
		foreach ($channels as $channel)
		{
			$count = $count + 1;
		    $html_for_all_channels = $html_for_all_channels .  $channel->name . ' <input id=\'' . 'add' . $channel->id . '\' type="image" src="plus_add_blue.png" width="10" alt="Submit"><br /><br />';

		    if ($count > 1)
		    	$add_id_list_for_ajax = $add_id_list_for_ajax . ', ';	
		    $add_id_list_for_ajax = $add_id_list_for_ajax . '#' . 'add' . $channel->id;

		}

		$add_id_list_for_ajax = $add_id_list_for_ajax . '\'';

		//get all channels for user

		$id = Auth::user()->id;
		$currentuser = User::find($id);

		$user_channels = $currentuser->channels();
		$count = 0;
		foreach ($user_channels as $channel)
		{
		    $html_for_users_channels = $html_for_users_channels .  $channel->name . ' <input id=\'' . 'remove' . $channel->id .  '\' type="image" src="erase.png" width="10" alt="Submit"><br /><br />';

		    if ($count > 1)
		    	$erase_id_list_for_ajax = $erase_id_list_for_ajax . ', ';	
		    $erase_id_list_for_ajax = $erase_id_list_for_ajax . '#' . 'remove' . $channel->id ;
		}

		$erase_id_list_for_ajax = $erase_id_list_for_ajax . '\'';


		return View::make('channel')->with('all_channels', 
						$html_for_all_channels)->with('add_id_list', 
						$add_id_list_for_ajax)->with('already_has_user_channels', 
						$html_for_users_channels)->with('erase_id_list', 
						$erase_id_list_for_ajax);


	}

	public function createInitialChannel() {
		$channel = new Channel;
		$channel->avatar    = "Cnn";
		$channel->name = "CNN";
		$channel->save();

		$channel = new Channel;
		$channel->avatar    = "MSNBC";
		$channel->name = "MSNBC";
		$channel->save();


		$channel = new Channel;
		$channel->avatar    = "Comedy";
		$channel->name = "Comedy";
		$channel->save();

		$channel = new Channel;
		$channel->avatar    = "Sports";
		$channel->name = "Sports";
		$channel->save();

		$channel = new Channel;
		$channel->avatar    = "Youtube";
		$channel->name = "Youtube";
		$channel->save();


		$channel = new Channel;
		$channel->avatar    = "Dailymotion";
		$channel->name = "Dailymotion";
		$channel->save();

		$channel = new Channel;
		$channel->avatar    = "World News";
		$channel->name = "World News";
		$channel->save();

		$channel = new Channel;
		$channel->avatar    = "NYTimes";
		$channel->name = "NYTimes";
		$channel->save();

	}

	public function postChannel() {
		if(Request::ajax()) {

	        $query  = Input::get('query');

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
    	}
	}
}