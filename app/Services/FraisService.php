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
            $liste = Frais::query()->where('id_visiteur', '=', $id_visiteur)->get();
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
            $userMessage="Erreur d'accès aux Etats a la base de données";
            throw new UserException($userMessage, $exception->getMessage(), $exception->getCode());
        }
    }
}
