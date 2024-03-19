<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'provider',
        'provider_id',
        'provider_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function generateUserName($username,$id){
        // jika username null
        if($username == null){
            $username = Str::lower(Str::random(8));
        }
        // jika username ada di database & jika ada user provider_id di database tidak sama dengan $id
        if(User::whereUsername($username)->exists() && User::whereProviderId($id)->first()->provider_id !== $id){
            //tambahkan string random
            $newUsername = $username . Str::lower(Str::random(5));
            $username = self::generateUserName($newUsername,$id);
        }
        return $username;
    }
}
 