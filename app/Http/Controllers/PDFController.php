<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function generateInscriptionPDF(Request $request)
    {
        $data = $request->all();

        // Log activity
        auth()->user()->activities()->create([
            'type' => 'inscription',
            'data' => [
                'etablissement' => $data['etbl'],
                'date' => $data['dateDM'],
                'cycle' => $data['typ'],
                'filiere' => $data['flr'],
                'students_count' => count($data['students'] ?? [])
            ]
        ]);

        $pdf = Pdf::loadView('pdf.inscription-annee-anterieure', compact('data'));
        return $pdf->download('inscription_annee_anterieure_'.now()->format('YmdHis').'.pdf');
    }

    public function generateComptePDF(Request $request)
    {
        $data = $request->all();

        // Log activity
        auth()->user()->activities()->create([
            'type' => 'compte',
            'data' => [
                'etablissement' => $data['etbl'],
                'date' => $data['dateDM'],
                'nom' => $data['nomPrenomUser'],
                'username' => $data['userName'],
                'fonction' => $data['fonction']
            ]
        ]);

        $pdf = Pdf::loadView('pdf.compte-fonctionnel-apogee', compact('data'));
        return $pdf->download('compte_fonctionnel_apogee_'.now()->format('YmdHis').'.pdf');
    }

    public function generateResultatPDF(Request $request)
    {
        $data = $request->all();

        // Validate the modules array exists
        if (!isset($data['modules'])) {
            $data['modules'] = [];
        }

        // Log activity
        auth()->user()->activities()->create([
            'type' => 'resultat_etudiant',
            'data' => [
                'etablissement' => $data['etbl'],
                'date' => $data['dateDM'],
                'nom_etudiant' => $data['NomPrenom'],
                'apogee' => $data['NumApogee'],
                'modules_count' => count($data['modules'])
            ]
        ]);

        $pdf = Pdf::loadView('pdf.insertion-resultat-etudiant', compact('data'));
        return $pdf->download('resultat_etudiant_'.now()->format('YmdHis').'.pdf');
    }

    public function generateResultatModulePDF(Request $request)
    {
        $data = $request->all();

        // Validate the students array exists
        if (!isset($data['students'])) {
            $data['students'] = [];
        }

        // Log activity
        auth()->user()->activities()->create([
            'type' => 'resultat_module',
            'data' => [
                'etablissement' => $data['etbl'],
                'date' => $data['dateDM'],
                'module' => $data['module'],
                'students_count' => count($data['students'])
            ]
        ]);

        $pdf = Pdf::loadView('pdf.insertion-resultat-module', compact('data'));
        return $pdf->download('resultat_module_'.now()->format('YmdHis').'.pdf');
    }
}
