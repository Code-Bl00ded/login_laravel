<?php

namespace App\Http\Controllers\Api\Auth;

use http\Env\Request;
use Illuminate\Routing\Route;

trait IssueTokenTrait{

    public function issueToken(Request $request, $grantType, $scope = "*"){
        $params = [
            'grant_type' => $grantType,
            'client_id' => $this->client->id,
            'client_secret' => $this->client->secret,
            'username' => $request->username ?: $request->email,
            'scope' => $scope
        ];

        $request->request->add($params);
        $proxy = \Illuminate\Http\Request::create('oauth/token','POST');
        return Route::dispatch($proxy);
    }
}
