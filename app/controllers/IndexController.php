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

		return View::make('index');

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

}
