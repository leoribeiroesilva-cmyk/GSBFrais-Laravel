<?php

namespace App\Services;

use App\Exceptions\UserException;
use App\Models\Etat;
use App\Models\Frais;
use Illuminate\Database\QueryException;

class FraisService
{
    public function getListFrais($id_visiteur){
        try {
            $liste = Frais::query()
                ->select('frais.*', 'etat.lib_etat')
                ->join('etat', 'etat.id_etat', '=', 'frais.id_etat')
                ->where('id_visiteur', '=', $id_visiteur)
                ->orderBy('frais.datemodification', 'DESC')
                ->get();
            return $liste;
        } catch (QueryException $exception) {
            $userMessage="Erreur d'accès à la base de données";
            throw new UserException($userMessage, $exception->getMessage(), $exception->getCode());
        }
    }
    public function saveFrais(Frais $frais)
    {
        try {
            $frais->save();
        } catch (QueryException $exception) {
            if ($frais->id_frais) {
                $userMessage = "Erreur de la modification à la base de données";
            } else {
                $userMessage = "Erreur de l'ajout à la base de données";
            }
            throw new UserException($userMessage, $exception->getMessage(), $exception->getCode());
        }
    }
    public function getFrais($id)
    {
        try {
            $frais = Frais::query()->find($id);
            return $frais;
        } catch (QueryException $exception) {
            $userMessage="Erreur de récupération à la base de données";
            throw new UserException($userMessage, $exception->getMessage(), $exception->getCode());
        }
    }
    //---------------------------- Etat ----------------------------
    public function getListEtats()
    {
        try {
            $liste = Etat::query()->get();
            return $liste;
        } catch (QueryException $exception) {
            $userMessage="Erreur d'accès aux Etats à la base de données";
            throw new UserException($userMessage, $exception->getMessage(), $exception->getCode());
        }
    }
    public function deleteFrais($id){
        try {
            $frais = Frais::query()->find($id);
            $frais->delete();
        } catch (QueryException $exception) {
            if ($exception->getCode() == 23000) {
                $userMessage = "Impossible de supprimer une fiche avec les frais saisis";
            } else {
                $userMessage = "Erreur de suppréssion à la base de données";
            }
            throw new UserException($userMessage, $exception->getMessage(), $exception->getCode());
        }
    }
}
