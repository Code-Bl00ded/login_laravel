<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use http\Client;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class RegisterController extends Controller
{
    use IssueTokenTrait;
    private $client;

    public function __construct()
    {
        $this->client = Client::find(1);
    }

    public function register (Request $request){

        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'

        ]);

        $user = user::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt('password')
        ]);


        return $this->issueToken($request,'password');

    }
}
