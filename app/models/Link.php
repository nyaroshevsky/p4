<?php
class Link extends Eloquent {
    
	/**
    * Channels belong to many Users
    */
    public function channels() {
        return $this->belongsToMany('Channel');
    }
}