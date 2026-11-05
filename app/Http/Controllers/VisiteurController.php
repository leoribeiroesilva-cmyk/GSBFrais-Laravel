<?php

namespace App\Http\Controllers;

use App\Services\VisiteurService;
use Illuminate\Http\Request;

class VisiteurController extends Controller
{
    public function login(){
        // Affichage du formulaire de connexion
        return view('formLogin');
    }
    public function auth(Request $request){
        $login = $request->input('login');
        $pwd = $request->input('pwd');

        $service = new VisiteurService();
        if ($service->singIn($login, $pwd)) {
            return redirect(url('/'));
        } else {
            $erreur = "login ou mot de passe incorrect";
            return view('formLogin', compact('erreur'));
        }
    }
    public function logout(){
        $service = new VisiteurService();
        $service->singOut();
        return redirect(url('/'));
    }
}
