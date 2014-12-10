<?php
class Channel extends Eloquent {
    
	/**
    * Channels belong to many Users
    */
    public function users() {

        return $this->belongsToMany('User', 'user_channel', 'channel_id', 'user_id');
    }

    /**
    * Channels belong to many Links
    */
    public function links() {
        return $this->belongsToMany('Link');
    }

    public static function getAllChannelsHtml()
   	{
   		$html_for_all_channels = "";
		
		//get all channels
		$channels = Channel::all();

		foreach ($channels as $channel)
		{
		    $html_for_all_channels = $html_for_all_channels .  $channel->name . 
		    	' <input id=\'' . 'add' . $channel->id . 
		    			'\' type="image" src="plus_add_blue.png" onclick="updateFunction(this, \'' .
		    					 'add' . $channel->id . '\')" width="10" alt="Submit"><br /><br />';

		}
		return $html_for_all_channels;
   	}

   	public static function getUserChannelsHtml()
   	{
   		$html_for_users_channels = "";
   		$id = Auth::user()->id;
		$currentuser = User::find($id);

		foreach ($currentuser->channels as $channel)
		{
		    $html_for_users_channels = $html_for_users_channels .  $channel->name . 
		    	' <input id=\'' . 'erase' . $channel->id . 
		    			'\' type="image" src="erase.png" onclick="updateFunction(this, \'' .
		    					 'erase' . $channel->id . '\')" width="10" alt="Submit"><br /><br />';
		}

		return $html_for_users_channels;
   	}

   	public static function getAllChannelsHtmlWithPlayButton()
   	{
   		$html_for_all_channels = "";
		
		//get all channels
		$channels = Channel::all();

		foreach ($channels as $channel)
		{

		    $html_for_all_channels = $html_for_all_channels .  $channel->name . 
		    	' <input id=\'' . 'play' . $channel->id . 
		    			'\' type="image" src="play.png" onclick="playFunction(this, \'' .
		    					 'play' . $channel->id . '\')" width="10" alt="Submit"><br /><br />';

		}
		return $html_for_all_channels;
   	}

   	public static function getUserChannelsHtmlWithPlayButton()
   	{
   		$html_for_users_channels = "";
   		$id = Auth::user()->id;
		$currentuser = User::find($id);

		foreach ($currentuser->channels as $channel)
		{
		    $html_for_users_channels = $html_for_users_channels .  $channel->name . 
		    	' <input id=\'' . 'play' . $channel->id . 
		    			'\' type="image" src="play.png" onclick="playFunction(this, \'' .
		    					 'play' . $channel->id . '\')" width="10" alt="Submit"><br /><br />';
		}

		return $html_for_users_channels;
   	}

   	public static function getDefaultUserChannelsList()
   	{
   		$html_for_users_channels = "";

	   	$html_for_users_channels = $html_for_users_channels . '<li class="active"><a href="http://ht.cdn.turner.com/cnn/big/world/2014/05/22/idesk-darlington-brazil-transit-strike.cnn_22114008_1280x720_3500k.mp4">Brazil Strike</a></li>';
		$html_for_users_channels = $html_for_users_channels . '<li><a href="http://ht.cdn.turner.com/cnn/big/topvideos/2014/05/14/ac-intv-sterling-wife-relationship.cnn_14215109_1280x720_3500k.mp4">Sterling</a></li>';
	    $html_for_users_channels = $html_for_users_channels . '<li><a href="http://ht.cdn.turner.com/cnn/big/international/2014/05/06/anthony-bourdain-show-extension-russia-orig-ms.cnn_06173205_1280x720_3500k.mp4">Antony Burdain Russia</a></li>';
		$html_for_users_channels = $html_for_users_channels . '<li><a href="http://ht.cdn.turner.com/cnn/big/bestoftv/2014/04/15/ab-anthony-bourdain-parts-unknown-vegas-3.cnn_15160303_1280x720_3500k.mp4">Antony Burdain Great Meal Mexico</a></li>';
			
		return $html_for_users_channels;
   	}

   	public static function getDefaultUserChannelsListSports()
   	{
   		$html_for_users_channels = "";

	   	$html_for_users_channels = $html_for_users_channels . '<li class="active"><a href="http://www.dailymotion.com/cdn/H264-1920x1080/video/x1p1vmr.mp4?auth=1418402127-2562-e9k6rnpj-c50ce89a5d5c3aaf66fb08623ae414e4">The Worst Tackles</a></li>';
		$html_for_users_channels = $html_for_users_channels . '<li><a href="http://www.dailymotion.com/cdn/H264-1280x720/video/x23gkny.mp4?auth=1418402128-2562-cgl30rae-7e6876d8b8ca7a488c9e70ff3261e0ac">Another Football</a></li>';
			
		return $html_for_users_channels;
   	}

   	public static function getDefaultUserChannelsListComedy()
   	{
   		$html_for_users_channels = "";

	   	$html_for_users_channels = $html_for_users_channels . '<li class="active"><a href="http://www.dailymotion.com/cdn/H264-512x384/video/x2fdzh.mp4?auth=1418402126-2562-9ajpcp9b-f0e9b380e4bafa3f94212494fbcd3146">Conan O\'Brien</a></li>';
		$html_for_users_channels = $html_for_users_channels . '<li><a href="http://proxy-65.dailymotion.com/video/645/603/3306546_mp4_h264_aac.mp4?auth=1418237979-4098-2v767cvd-23a10f69c9d9eea7c7e78d3ef745082c#cell=core">Kelly Clarkson</a></li>';

			
		return $html_for_users_channels;
   	}



    # Model events...
	# http://laravel.com/docs/eloquent#model-events
	public static function boot() {
        parent::boot();
        static::deleting(function($channel) {
            DB::statement('DELETE FROM user_channel WHERE channel_id = ?', array($channel->id));
        });
	}
}