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
		
		$html_for_all_channels = Channel::getAllChannelsHtml();
		$html_for_users_channels = Channel::getUserChannelsHtml();

		return View::make('channel')->with('all_channels', 
						$html_for_all_channels)->with('already_has_user_channels', 
						$html_for_users_channels);

	}

	

	public function postChannel() {
		if(Request::ajax()) {

	        $query  = Input::get('query');

		    $html_for_users_channels = "";
    
		    
     		if (0 === strpos($query, 'add')) {
			   $new_channel_id = str_replace("add", "", $query);

	           #get all users channels
	           $id = Auth::user()->id;

			   $currentuser = User::find($id);

			   $new_channel = Channel::find($new_channel_id);

			   if ( !$currentuser->channels->contains($new_channel) )
			   {
			       $currentuser->channels()->attach($new_channel->id);
			   }

			   $html_for_users_channels = Channel::getUserChannelsHtml();

	           return $html_for_users_channels;
			}
			elseif (0 === strpos($query, 'erase')) {
				$new_channel_id = str_replace("erase", "", $query);
	            
	            #get all users channels
	            
	            $id = Auth::user()->id;
 
			    $currentuser = User::find($id);
 
			    $new_channel = Channel::find($new_channel_id);
 
			    if ($currentuser->channels->contains($new_channel))
			    {
			        $currentuser->channels()->detach($new_channel->id);
			    }
 
			    $html_for_users_channels = Channel::getUserChannelsHtml();
 
	            return $html_for_users_channels;
			}
	        else
	        {
	        	return Channel::getUserChannelsHtml();
	        }	
    	}
	}

	public function playChannel() {
		if(Request::ajax()) {

			$html_for_users_channels = "";

	        $query  = Input::get('query');
	        
     		if (0 === strpos($query, 'play')) {
			   $new_channel_id = str_replace("play", "", $query);

			   $new_channel = Channel::find($new_channel_id);

			   if ($new_channel->name == "Sports")
			   {
			   		$html_for_users_channels = Channel::getDefaultUserChannelsListSports();
			   }
			   elseif ($new_channel->name == "Comedy")
			   {
			   		$html_for_users_channels = Channel::getDefaultUserChannelsListComedy();
			   }
			   else
			   {
			   		$html_for_users_channels = Channel::getDefaultUserChannelsList();
			   }
			  
	           $newChannelName = $new_channel->name . " Channel";

	           $returnArray = array($html_for_users_channels, $newChannelName);
	        	return $returnArray;
			}
	        else
	        {
	        	
	        	$html_for_users_channels =  Channel::getDefaultUserChannelsList();
	        	$returnArray = array($html_for_users_channels, "CNN Channel");
	        	return $returnArray;
	        }	
    	}
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


}