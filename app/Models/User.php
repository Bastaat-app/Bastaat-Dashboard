<?php

/**
 * Created by Reliese Model.
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
	protected $table = 'users';

	protected $casts = [
		'is_phone_verified' => 'bool',
		'email_verified_at' => 'datetime',
		'status' => 'bool',
		'order_count' => 'int',
		'zone_id' => 'int',
		'wallet_balance' => 'float',
		'loyalty_point' => 'float'
	];

	protected $hidden = [
		'password',
		'email_verification_token',
		'remember_token',
		'cm_firebase_token'
	];

	protected $fillable = [
		'f_name',
		'l_name',
		'phone',
		'email',
		'image',
		'is_phone_verified',
		'email_verified_at',
		'password',
		'email_verification_token',
		'remember_token',
		'interest',
		'cm_firebase_token',
		'status',
		'order_count',
		'login_medium',
		'social_id',
		'zone_id',
		'wallet_balance',
		'loyalty_point',
		'ref_code'
	];
    public function userinfo()
    {
        return $this->hasOne(UserInfo::class,'user_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function addresses(){
        return $this->hasMany(CustomerAddress::class);
    }

    public function loyalty_point_transaction()
    {
        return $this->hasMany(LoyaltyPointTransaction::class);
    }

    public function wallet_transaction()
    {
        return $this->hasMany(WalletTransaction::class);
    }

}
