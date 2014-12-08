<?php
class Channel extends Eloquent {
    
	/**
    * Channels belong to many Users
    */
    public function users() {
        return $this->belongsToMany('User');
    }

    /**
    * Channels belong to many Links
    */
    public function links() {
        return $this->belongsToMany('Link');
    }
}