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

	   	$html_for_users_channels = $html_for_users_channels . '<li class="active"><a href="https://r13---sn-ab5l6n76.googlevideo.com/videoplayback?ratebypass=yes&fexp=905639%2C907259%2C913441%2C923345%2C927622%2C932404%2C936118%2C941004%2C943917%2C947209%2C948124%2C948808%2C952302%2C952605%2C952901%2C953912%2C957103%2C957105%2C957201&dur=241.348&sver=3&source=youtube&upn=-dsEezBiecw&ipbits=0&requiressl=yes&id=o-ACR3lp_XVJRSNv77oAsG2wTZMns3e6lxGg7RBzeSMrcx&ms=au&mt=1418177435&mv=m&initcwndbps=1497500&expire=1418199085&signature=78FF16CC1F9D419D57F4D7FD20FB64E378A857AA.C43F904C5A4583BA56F608604E671B0378DE49E8&ip=73.167.237.85&key=yt5&mm=31&itag=22&sparams=dur%2Cid%2Cinitcwndbps%2Cip%2Cipbits%2Citag%2Cmm%2Cms%2Cmv%2Cratebypass%2Crequiressl%2Csource%2Cupn%2Cexpire">The Worst Tackles</a></li>';
		$html_for_users_channels = $html_for_users_channels . '<li><a href="https://r6---sn-ab5l6ned.googlevideo.com/videoplayback?id=o-AER1S11pp66rZhYnRjvAwEug331mkzWOyTqVbLrI0JYa&fexp=907259%2C908203%2C914951%2C927622%2C931359%2C932404%2C933226%2C943917%2C945907%2C947209%2C948124%2C949414%2C952302%2C952605%2C952901%2C953912%2C957103%2C957105%2C957201&mm=31&expire=1418199477&key=yt5&sparams=dur%2Cid%2Cinitcwndbps%2Cip%2Cipbits%2Citag%2Cmm%2Cms%2Cmv%2Cratebypass%2Crequiressl%2Csource%2Cupn%2Cexpire&source=youtube&requiressl=yes&ms=au&ipbits=0&initcwndbps=1495000&mv=m&dur=471.388&signature=F07B7E9F6C59ECDCA54D62376905BBC7FABFEEDF.C6014C3695768E89F280CA9A0FD413B430D22407&mt=1418177838&ratebypass=yes&sver=3&upn=frIWukQ19GY&ip=73.167.237.85&itag=22">Soccer</a></li>';
	    $html_for_users_channels = $html_for_users_channels . '<li><a href="http://ht.cdn.turner.com/cnn/big/international/2014/05/06/anthony-bourdain-show-extension-russia-orig-ms.cnn_06173205_1280x720_3500k.mp4">Antony Burdain Russia</a></li>';
		$html_for_users_channels = $html_for_users_channels . '<li><a href="http://ht.cdn.turner.com/cnn/big/bestoftv/2014/04/15/ab-anthony-bourdain-parts-unknown-vegas-3.cnn_15160303_1280x720_3500k.mp4">Antony Burdain Great Meal Mexico</a></li>';
			
		return $html_for_users_channels;
   	}

   	public static function getDefaultUserChannelsListComedy()
   	{
   		$html_for_users_channels = "";

	   	$html_for_users_channels = $html_for_users_channels . '<li class="active"><a href="https://r1---sn-ab5l6n7e.googlevideo.com/videoplayback?ip=73.167.237.85&ipbits=0&requiressl=yes&signature=386E28F498C5328CCE7DCCF95D7F71BE8734641B.599D42DD04037A8B839BC4AEBFAF9E80CDD4B6A0&gcr=us&expire=1418199258&id=o-AKzfo1Etccmsuga35cIswi201tcVt9qIo2CuvX8WYckg&fexp=900161%2C907259%2C927622%2C932404%2C943917%2C947209%2C948124%2C952302%2C952605%2C952901%2C953912%2C957103%2C957105%2C957201&sver=3&mt=1418177640&mm=31&source=youtube&ratebypass=yes&mv=m&dur=729.361&initcwndbps=1467500&itag=22&ms=au&upn=DXgQmRQ0HwU&sparams=dur%2Cgcr%2Cid%2Cinitcwndbps%2Cip%2Cipbits%2Citag%2Cmm%2Cms%2Cmv%2Cratebypass%2Crequiressl%2Csource%2Cupn%2Cexpire&key=yt5">Conan O\'Brien</a></li>';
		$html_for_users_channels = $html_for_users_channels . '<li><a href="http://ht.cdn.turner.com/cnn/big/topvideos/2014/05/14/ac-intv-sterling-wife-relationship.cnn_14215109_1280x720_3500k.mp4">Jon Stewart</a></li>';

			
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