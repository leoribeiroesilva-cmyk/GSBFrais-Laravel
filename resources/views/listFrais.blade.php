@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>liste des employes</h1>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Mois</th>
            <th>Montant saisi</th>
            <th>Nb Justificatifs</th>
            <th>Montant validé</th>
            <th>Etat</th>
            <th></th>
        </tr>
        </thead>
        @foreach($fiches as $fiche)
            <tr>
                <td>{{$fiche->anneemois}}</td>
                <td></td>
                <td>{{$fiche->nbjustificatifs}}</td>
                <td>{{$fiche->montantvalide}}</td>
                <td>{{$fiche->id_etat}}</td>
                <td><a href="{{ url('/editerFrais/'.$fiche->id_frais) }}">Modifier</a> </td>
            </tr>
        @endforeach
    </table>
@endsection
