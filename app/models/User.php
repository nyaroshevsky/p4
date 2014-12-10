<?php
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
class User extends Eloquent implements UserInterface, RemindableInterface {
	use UserTrait, RemindableTrait;
	
	protected $table = 'users';
	
	protected $hidden = array('password', 'remember_token');

	public function channels()
    {
        return $this->belongsToMany('Channel', 'user_channel', 'user_id', 'channel_id');
    }
	
	public function sendWelcomeEmail() {
		# Create an array of data, which will be passed/available in the view
		$data = array('user' => Auth::user());
		Mail::send('emails.welcome', $data, function($message) {
			$recipient_email = $this->email;
			$recipient_name  = $this->first_name.' '.$this->last_name;
			$subject  = 'Welcome '.$this->first_name.'!';
    		$message->to($recipient_email, $recipient_name)->subject($subject);
		});
	}

	# Model events...
	# http://laravel.com/docs/eloquent#model-events
	public static function boot() {
        parent::boot();
        static::deleting(function($user) {
            DB::statement('DELETE FROM user_channel WHERE user_id = ?', array($user->id));
        });
	}
}