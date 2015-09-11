<?php namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model {

	protected $table = 'subscribers';
	protected $fillable = ['first_name', 'first_name', 'email', 'phone', 'verification_token', 'is_verified'];
	protected $hidden = [];


	/**
	 * returns a friendly date format for pusblished_at attrubute
	 * @return type
	 */
	public function getHumanPublishedAt()
    {
        return Carbon::parse($this->published_at)->format('d-M-Y');
    }

}
