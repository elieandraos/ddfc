<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model {

	protected $table = 'subscribers';
	protected $fillable = ['first_name', 'first_name', 'email', 'phone', 'verification_token', 'is_verified'];
	protected $hidden = [];

}
