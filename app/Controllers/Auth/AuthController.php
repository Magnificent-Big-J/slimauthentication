<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\User;
use Respect\Validation\Validator as v;

class AuthController extends Controller
{
    public function getSignUp($request, $response)
    {
        return $this->view->render($response, 'auth/signup.twig');
    }
    public function postSignUp($request, $response)
    {
        $validation =  $this->validator->validate($request, [
            'email' => v::noWhitespace()->notEmpty()->email(),
            'name' => v::notEmpty(),
            'password' => v::noWhitespace()->notEmpty(),
        ]);

        if ($validation->failed()) {

            return  $response->withRedirect($this->router->pathFor('auth.sign'));
        }
        $user = User::create([
            'email' => $request->getParam('email'),
            'username' => $request->getParam('name'),
            'password' => password_hash($request->getParam('password'), PASSWORD_BCRYPT)
        ]);

        return $response->withRedirect($this->router->pathFor('home'));

    }
}