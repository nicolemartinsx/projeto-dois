<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use Illuminate\Support\Facades\Storage;
use App\Mail\EnvioPeiEmail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
class PdfController extends Controller
{
    public function tabela()
    {
        if (Auth::user()->google_id) {
            $professor = Professor::where('email', Auth::user()->email)->first();
            $pdfs = $professor->files()->get();
        } else {
            $pdfs = File::all();
        }
        return view('pdf.tabela', compact('pdfs'));
    }

    public function compartilhar($id)
    {
        $pdf = File::findOrFail($id);
        $professors = Professor::orderBy('name')->get();
        return view('pdf.selecao', compact('pdf', 'professors'));
    }

    public function tabelaProfessor($id)
    {
        $professor = Professor::findOrFail($id);
        $pdfs = $professor->files()->get();
        foreach ($pdfs as $pdf) {
            $pdf->visualizado = $pdf->pivot->visualizado;
            $pdf->confirmado = $pdf->pivot->confirmado;
        }
        return view('pdf.professor', compact('pdfs', 'professor'));
    }

    public function enviarEmail(Request $request)
    {
        $professoresSelecionados = $request->input('professores');
        $pdfId = $request->input('pdf_id');

        if (empty($professoresSelecionados)) {
            return redirect()->back()->with('error', 'Selecione pelo menos um professor.');
        }

        $professores = Professor::whereIn('id', $professoresSelecionados)->get();
        $pdf = File::findOrFail($pdfId);

        foreach ($professores as $professor) {
            $dados = ['nome' => $professor->name, 'pdf' => $pdf];
            Mail::to($professor->email)->send(new EnvioPeiEmail($dados));
            $professor->files()->save($pdf);
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
        $userId = Auth::user()->id;
        $path = $request->file('pdf')->store("pdfs/{$userId}");

        $pdf = new File();
        $pdf->file_path = $path;
        $pdf->user_id = $userId;
        $pdf->original_name = $request->file('pdf')->getClientOriginalName();
        $pdf->nome_aluno = $request->input('nome_aluno');
        $pdf->registro_academico = $request ->input ('registro_academico');
        $pdf->save();

        return redirect()->back()->with('success', 'PDF enviado com sucesso!');
    }

    public function show($id)
    {
        $file = File::findOrFail($id);

        $professor = Professor::where('email', Auth::user()->email)->first();
        $file->professors()->updateExistingPivot($professor->id, [
            'visualizado' => true
        ]);

        $filePath = $file->file_path;
        if (Storage::exists($filePath)) {
            return response()->file(Storage::path($filePath));
        } else {
            return response()->json(['message' => 'Arquivo não encontrado'], 404);
        }
    }

    public function download($id)
    {
        $file = File::findOrFail($id);
        $filePath = $file->file_path;

        if (Storage::exists($filePath)) {
            return Storage::download($filePath);
        } else {
            return response()->json(['message' => 'Arquivo não encontrado'], 404);
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



    //talvez eu possa separar tudo que ta aqui embaixo para outro controlador

    // aqui é a função do PEISHOW q eu adicionei @celson

    public function confirmacaoPei($dados)
    {

        list($nome, $numero) = explode('-', $dados);

        $file = File::where('registro_academico', $numero)->first();// eu tenho um arquivo aqui, pq eu preciso o getPei ali embaixo? eu tbm não sei
       
    /**  
        if(!Auth::user()->role=='admin'){
           
            $file->professors()->updateExistingPivot($professor->id, [
                'visualizado' => true,
            ]);
        }
    */

        $professor = Professor::where('email', Auth::user()->email)->first();

        $pivotRecord = $file->professors()->where('professor_id', $professor->id)->first()->pivot;
        
  



        /*
        Esse IF aqui é para definir se o url vai ser para apenas o pdf ou a confirmação
        */

        if ($pivotRecord->confirmado) {// era para caso o pei ja tenha sido lido e confirmado apenas mostrar o pdf não levar para a confirmação denovo 
            echo "O professor já foi visualizado.";
            $id_arquivo = $pivotRecord->file_id;
           
            //return view('pdfs.show', compact( $id_arquivo));

            return redirect('pdfs/'.$id_arquivo.'')->with('success', 'Confirmação recebida com sucesso!');

            
        } else {

            return view('pdf.confirmarPei', compact( 'file','nome', 'numero'));
     
        }

       

        
        

    }

    /*
    Pode ter sido uma gambiarra, provavelmente existe uma maneira mais facil de eu fazer esse tipo de iframe, até mesmo usando a mesma rota
    porem me pareceu mais facil fazer uma rota especifica para conseguir o pdf do PEI. 

    */
    public function getPei($dados){ // Eu posso reutilizar essa função varias vezes 
        list($nome, $numero) = explode('-', $dados);
        $pdf = File::where('registro_academico', $numero)->first();
        if (!$pdf || !Storage::exists($pdf->file_path)) {
            return response()->json(['message' => 'PDF não encontrado.'], 404);
        }   // Até aqui mostrar pdfs usando o novo url está funcionando 
        
       if (Storage::exists($pdf->file_path)) {
            return response()->file(Storage::path($pdf->file_path));
        } else {
            return response()->json(['message' => 'Arquivo não encontrado'], 404);
        }

    }

    public function confirmarLeitura(Request $request,$fileId)// tem um problema no confirmar leitura e provavelmente é relacionado ao ID do arquivo
    {

      


      


      //  $request->validate([
      //        'email_recebido' => 'required|boolean',
      //      'leitura_confirmada' => 'required|boolean',
      //  ]); //por algum motivo não consigo fazer validate 
        
       
        

        $file = File::findOrFail($fileId);
        $professor = Professor::where('email', Auth::user()->email)->first();

        $file->professors()->updateExistingPivot($professor->id, [
            'visualizado' => true,
            'confirmado' => true
        ]);

      
        if (!$professor) {
            return redirect()->back()->with('error', 'Professor não encontrado.');
        }
        return redirect('/tabela')->with('success', 'Confirmação recebida com sucesso!');
    }

}
