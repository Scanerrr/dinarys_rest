<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token', 'latitude', 'longitude'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token'
    ];


    /**
     * Encrypt password
     *
     * @param $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    /**
     *  Set latitude & longitude
     *
     * @param $lat float latitude
     * @param $lng float  longitude
     * @return bool
     */
    public function setCoordinates($lat, $lng)
    {
        return $this->update(compact($lat, $lng));
    }

    public function getByDistance($lat, $lng, $max_distance)
    {
        $circle_radius = 6371; //3959 for miles
        $results = DB::select("SELECT id, ( $circle_radius * acos( cos( radians(37) ) * cos( radians( $lat ) ) * cos( radians( $lng ) - radians(-122) ) + sin( radians(37) ) * sin( radians( $lat ) ) ) ) AS distance FROM users HAVING distance < $max_distance ORDER BY distance LIMIT 0 , 20;");
        return $results;
    }

    public static function form()
    {
        return [
            'name' => '',
            'email' => '',
            'password' => '',
            'latitude' => '',
            'longitude' => '',
        ];
    }
}
