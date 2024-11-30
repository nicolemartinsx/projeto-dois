<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use Illuminate\Support\Facades\Storage;
use App\Mail\EnvioPeiEmail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;



class PdfController extends Controller
{

    //tabela com todos os peis adicionados
    public function tabela()
    {
        $pdfs = File::all(); 
        return view('pdf.tabela', compact('pdfs')); 
    }

    public function compartilhar($id)
    {
        $pdf = File::findOrFail($id);
        $professors = Professor::orderBy('name')->get();
        return view('pdf.selecao', compact('pdf', 'professors'));
    }

    public function enviarEmail(Request $request)
    {
        $professoresSelecionados = $request->input('professores');
        $pdfId = $request->input('pdf_id');

        //caso não tenha selecionado nenhum professor
        if (empty($professoresSelecionados)) {
            return redirect()->back()->with('error', 'Selecione pelo menos um professor.');
        }

        $professores = Professor::whereIn('id', $professoresSelecionados)->get();
        $emails = $professores->pluck('email')->toArray();
        $pdf = File::findOrFail($pdfId);

        foreach ($professores as $professor) {
            $dados = ['nome' => $professor->name, 'pdf' => $pdf];
            Mail::to($professor->email)->send(new EnvioPeiEmail($dados));
        }

        return redirect()->route('pdfs.tabela')->with('success', 'Email enviado com sucesso!');
    }
    public function index()
    {

    if (!Auth::check()) {
        return redirect()->route('login'); // Redireciona para a página de login se não estiver autenticado
    }
    
    $userId = Auth::user()->id;
    $pdfs = File::where('user_id', $userId)->get();

    return view('pdf.pei', compact('pdfs'));
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
        $pdf->original_name = $request->file('pdf')->getClientOriginalName();
        $pdf->nome_aluno = $request->input('nome_aluno'); 
        $pdf->save();


        return redirect()->back()->with('success', 'PDF enviado com sucesso!');
    }


    public function show($id)
        {
    $file = File::findOrFail($id); 
    $filePath = $file->file_path; 

    if (Storage::exists($filePath)) {
        return response()->file(Storage::path($filePath)); 
    } else {
        return response()->json(['message' => 'Arquivo não encontrado'], 404);
    }
    }

    public function download($id)
    {
        {
            $file = File::findOrFail($id); 
            $filePath = $file->file_path; 
    
         
            if (Storage::exists($filePath)) {
                return Storage::download($filePath); 
            } else {
                return response()->json(['message' => 'Arquivo não encontrado'], 404);
            }
    }
    }
    

    public function deletar($id)
    {
        $file = File::findOrFail($id); // Busca o arquivo pelo ID
        $filePath = $file->file_path; // Supondo que você tenha um campo 'file_path' no seu modelo

        // Verifica se o arquivo existe e o deleta
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }

        // Deleta o registro do banco de dados
        $file->delete();

        return redirect()->back()->with('success', 'Arquivo deletado com sucesso.');
    }
}