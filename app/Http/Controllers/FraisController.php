<?php

namespace App\Http\Controllers;

use App\Models\Frais;
use App\Services\FraisService;
use Exception;
use Illuminate\Http\Request;


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
            $services = new FraisService();
            $etats = $services->getListEtats();
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
            } else {
                $frais = new Frais();
            }

            $frais->id_visiteur = session('id_visiteur');
            $frais->anneemois = $request->input('mois');
            $frais->nbjustificatifs = $request->input('nbjustif');
            $frais->montantvalide = $request->input('valide');
            $frais->id_etat = $request->input('etat');
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
            return view('formFrais', compact('frais', 'etats'));
        } catch (Exception $exception){
            return view('error', compact('exception'));
        }
    }
}
