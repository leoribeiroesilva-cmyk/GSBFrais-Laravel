<?php

namespace App\Http\Controllers;

use App\Models\Etat;
use App\Models\Frais;
use App\Services\FraisService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class FraisController extends Controller
{
    public function listFrais()
    {
        try {
            $services = new FraisService();
            $id_visiteur = session('id_visiteur');
            $fiches = $services->getListFrais($id_visiteur);
            return view('listFrais', compact('fiches'));
        } catch (Exception $exception){
            return view('error', compact('exception'));
        }
    }
    public function addFrais()
    {
        try {
            $frais = new Frais();
            $frais->anneemois = date("Y-m");
            $etats = [new Etat()];
            $etats[0]->lib_etat = "Création en cours";
            return view('formFrais', compact('frais','etats'));
        }catch (Exception $exception){
            return view('error', compact('exception'));
        }
    }

    public function validFrais(Request $request)
    {
        try {
            $id = $request->input('id');
            if ($id) {
                $services = new FraisService();
                $frais = $services->getFrais($id);
                $frais->id_etat = $request->input('etat');
            } else {
                $frais = new Frais();
                $frais->id_etat = 2;
            }

            $frais->id_visiteur = session('id_visiteur');
            $frais->anneemois = $request->input('mois');
            $frais->titre = $request->input('titre');
            $frais->nbjustificatifs = $request->input('nbjustif');
            $frais->montantvalide = $request->input('valide');
            $frais->datemodification = date("y-m-d");

            $services = new FraisService();
            $services->saveFrais($frais);

            return redirect('/listerFrais');
        } catch (Exception $exception) {
            return view('error', compact('exception'));
        }
    }
    public function editFrais($id)
    {
        try {
            $services = new FraisService();
            $frais = $services->getFrais($id);
            $etats = $services->getListEtats();
            $erreur = Session::get('erreur');
            Session::remove('erreur');
            return view('formFrais', compact('frais', 'etats', 'erreur'));
        } catch (Exception $exception){

            return view('error', compact('exception'));
        }
    }
    public function removeFrais($id)
    {
        try {
            $service = new FraisService();
            $service->deleteFrais($id);
            return redirect('/listerFrais');
        } catch (Exception $exception) {
            if ($exception->getCode() == '23000') {
                Session::put('erreur', $exception->getUserMessage());
                return redirect(url('/editerFrais/'.$id));
            } else {
                return view('error', compact('exception'));
            }
        }
    }
}
