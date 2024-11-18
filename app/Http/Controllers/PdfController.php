<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\File;

use Illuminate\Support\Facades\Auth;



class PdfController extends Controller
{

    public function index()
{

    if (!Auth::check()) {
        return redirect()->route('login'); // Redireciona para a página de login se não estiver autenticado
    }
    
    $userId = Auth::user()->id;
    $pdfs = Storage::disk('private')->files("pdfs/{$userId}");

    return view('dashboard', compact('pdfs'));
}

    public function uploadPDF(Request $request)
    {
        $request->validate([
            'pdf' => 'required|file|mimes:pdf|max:2048', //PDF de no máximo 2MB
        ]);
        $userId = Auth::user() ->id;
        $path = $request->file('pdf')->store("pdfs/{$userId}");


        $pdf = new File();
        $pdf->file_path = $path; 
        $pdf->user_id = $userId; 
       // $pdf->original_name = $request->file('pdf')->getClientOriginalName(); 
        $pdf->save(); 


        return redirect()->back()->with('success', 'PDF enviado com sucesso!');
    }

    public function show($filename)
{
    $userId = Auth::user()->id; // Obtém o ID do usuário autenticado

    // Verifica se o arquivo específico existe no diretório do usuário
    if (!Storage::disk('private')->exists("pdfs/{$userId}/{$filename}")) {
        abort(404); // Retorna 404 se o arquivo não existir
    }

    // Retorna o arquivo PDF para download
    return response()->file(storage_path("app/private/pdfs/{$userId}/{$filename}"));
}


    public function download($filename)
    {
        $userId = Auth::user()->id; 
        // Verifica se o arquivo existe
        if (!Storage::disk('private')->exists("pdfs/{$userId}/{$filename}")) {
            abort(404); 
        }
        return response()->download(storage_path("app/private/pdfs/{$userId}/{$filename}"));
    }
    

    public function deletar($filename)
    {
    $path = storage_path("app/private/pdfs/" . Auth::user()->id . "/{$filename}");

    // Verifica se o arquivo existe
    if (file_exists($path)) {
        // Deleta o arquivo
        unlink($path);
        return redirect()->route('dashboard')->with('success', 'PDF deletado com sucesso.');
    } else {
        return redirect()->route('dashboard')->with('error', 'Arquivo não encontrado.');
    }
}
}