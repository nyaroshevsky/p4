<?php
class IndexController extends BaseController {
	/**
	*
	*/
	public function __construct() {
		# Make sure BaseController construct gets called
		parent::__construct();
	}
	/**
	* Makes index with default available channels
	*/
	public function getIndex() {

		$channelsHtml = "<span class=\"auto-style1\"><strong>Favorites:</strong></span><br />";
		$allChannelsHtml = '<span class="auto-style1"><strong>All Channels:</strong></span><br /><br />';
		if (Auth::check())
		{
			$id = Auth::user()->id;
			$currentuser = User::find($id);
			if ($currentuser->channels->isEmpty())
		    {
		       $channelsHtml = $channelsHtml . '<small>You don\'t have any channels, <a href="/channel">click here to add</a></small>';
		    }
		    else
		    {
		    	$channelsHtml = $channelsHtml . '<small><a href="/channel">click here to edit</a></small>';	
		    }

		    $channelsHtml =  $channelsHtml .  '<br /><br />' . Channel::getUserChannelsHtmlWithPlayButton();
		}


		$allChannelsHtml =  $allChannelsHtml  . Channel::getAllChannelsHtmlWithPlayButton();	

		return View::make('index')->with('yourChannels', $channelsHtml)->with('allChannels', $allChannelsHtml);
	}

	/**
	* Makes index with default available channels
	*/
	public function getIndex2() {

		if (Auth::check())
		{
		    // The user is logged in...
		    //if logged in then see if person has channels
			return View::make('index');
		}
		
		// if not logged in give regular index with all default channels
		return View::make('index');
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

}
