<?php

namespace App\Models;

//use Illuminate\Notifications\Notifiable;
//use Illuminate\Contracts\Auth\MustVerifyEmail;
//use Illuminate\Foundation\Auth\User as Authenticatable;

use Carbon\Carbon;

class User extends Model { //extends Authenticatable{

//    use Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','avatar', 'cover', 'status', 'sign' ,'role', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
//    protected $hidden = [
//        'password', 'remember_token',
//    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    protected $status_field = [
        'normal', 'ban', 'ban_forever'
    ];

    public function scopeWhereBanned($query){
        return $query->whereIn('status', [
            1,2
        ]);
    }

    public function getStatusAttribute($value){
        return $this->status_field[$value];
    }

    public function setStatusAttribute($value){
        return array_search($value, $this->status_field);
    }


    public function getCreatedAtAttribute($date)
    {
        if (Carbon::now() > Carbon::parse($date)->addDays(10)){
            return $date;
        }

        return Carbon::parse($date)->diffForHumans();
    }

    static function unblock($id){
        self::where('id', $id)->update([
            'status' => 0, 'ban_reason' => null, 'ban_time' => null
        ]);
    }

    static function block($id, $time, $reason){
        User::where('id', $id)->update([
            'status' => 1, 'ban_reason' => $reason, 'ban_time' => time() + $time * 86400
        ]);
    }

    static function blockForever($id,$reason){
        User::where('id', $id)->update([
            'status' => 2, 'ban_reason' => $reason
        ]);
    }

    public function statusLabel(){
        $label = [
            'normal'=>'blue', 'ban'=>'yellow', 'ban_forever'=>'red'
        ][$this->status];
        return '<span class="badge bg-' . $label . '">' . $this->status . '</span>';
    }
}
