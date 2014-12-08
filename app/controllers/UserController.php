<?php
class UserController extends BaseController {
	/**
	*
	*/
	public function __construct() {
		# Make sure BaseController construct gets called
		parent::__construct();
        $this->beforeFilter('guest',
        	array(
        		'only' => array('getLogin','getSignup')
        	));
    }
    

	public function getJoin() {
		return View::make('user_join');
	}
	

	public function postJoin() {
		# Step 1) Define the rules
		$rules = array(
			'email' => 'required|email|unique:users,email',
			'password' => 'required|min:6'
		);
		# Step 2)
		$validator = Validator::make(Input::all(), $rules);
		# Step 3
		if($validator->fails()) {
			return Redirect::to('/join')
				->with('flash_message', 'Sign up failed; please fix the errors listed below.')
				->withInput()
				->withErrors($validator);
		}
		$user = new User;
		$user->email    = Input::get('email');
		$user->password = Hash::make(Input::get('password'));
		try {
			$user->save();
		}
		catch (Exception $e) {
			return Redirect::to('/join')
				->with('flash_message', 'Sign up failed; please try again.')
				->withInput();
		}
		# Log in
		Auth::login($user);
		$user->sendWelcomeEmail();
		return Redirect::to('/')->with('flash_message', 'Welcome to Pult!');
	}
	

	public function getLogin() {
		return View::make('user_login');
	}
	

	public function postLogin() {
		$credentials = Input::only('email', 'password');
		# Note we don't have to hash the password before attempting to auth - Auth::attempt will take care of that for us
		if (Auth::attempt($credentials, $remember = false)) {
			return Redirect::intended('/')->with('flash_message', 'Welcome Back!');
		}
		else {
			return Redirect::to('/login')
				->with('flash_message', 'Log in failed; please try again.')
				->withInput();
		}
	}
	

	public function getLogout() {
		# Log out
		Auth::logout();
		# Send them to the homepage
		return Redirect::to('/');
	}
}
