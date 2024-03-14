<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;

class ProviderController extends Controller
{
    public function redirect(){
        return Socialite::driver('google')->redirect();
    }
    public function callback(){
        try {
            // $user return id(int),nick(null),name(string),email,avatar(link img),token
            $SosialiteUser = Socialite::driver('google')->stateless()->user();
            $authUser = $this->findOrCreateUser($SosialiteUser);
            Auth::login($authUser);
            return redirect('/dashboard');
        } catch (\Exception $e) {
            return redirect('/login');
        }
    }
    public function findOrCreateUser($SosialiteUser){
        $user = User::where(['provider' => 'google','provider_id' => $SosialiteUser->id])->first();
        // cek apakah ada data $user dengan proverder google & proverder_id JIKA TIDAK ADA MAKA
        if (!$user) {
            $chekEmail = User::where('email',$SosialiteUser->getEmail())->first();
            // cek apakah ada user $chekEmail dengan email yang sama JIKA TIDAK ADA
            if (!$chekEmail) {
                // maka buat user baru di database
                $user = User::create([
                    'name' => $SosialiteUser->getName(),
                    'email' => $SosialiteUser->getEmail(),
                    'username' => User::generateUserName($SosialiteUser->getName(),$SosialiteUser->getId()),
                    'provider_id' => $SosialiteUser->getId(),
                    'provider' => 'google',
                    'provider_token' => $SosialiteUser->token,
                ]);
                //mengupdate field email_varified_at di data base
                $user->markEmailAsVerified();
                return $user;
            } else {
                // cek apakah ada user $chekEmail dengan email yang sama JIKA ADA MAKA
                $chekEmail->update([
                    'provider_id' => $SosialiteUser->getId(),
                    'provider' => 'google',
                    'provider_token' => $SosialiteUser->token,
                ]);
                return $chekEmail;
            }
            
        }else{
            //cek apakah ada data $user dengan proverder google & proverder_id JIKA ADA MAKA
            return $user;
        }
    }
}
