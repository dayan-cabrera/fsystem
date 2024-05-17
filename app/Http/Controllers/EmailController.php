<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\FSystemMailable;
use Exception;
use Spatie\PdfToText\Pdf;

class EmailController extends Controller
{
    public function index()
    {
        return view('emails.index');
    }

    public function send_email(Request $request)
    {
        try {
            $datos = $request->validate([
                'asunto' => 'required',
                'destinatario' => 'required|email',
                'mensaje' => 'required',
                // 'archivos_pdf.*' => 'nullable|mimes:pdf|max:2048'
            ]);

            $attachments = [];
            if ($request->hasFile('archivos_pdf')) {
                foreach ($request->file('archivos_pdf') as $archivo) {
                    $contenidoPdf = $this->extractContentFromPdf($archivo->getPathName());
                    $attachments[] = $contenidoPdf; // Guarda el contenido del PDF en $attachments
                }
            }

            $correo = new FSystemMailable($datos['asunto'], $datos['mensaje'], $attachments);

            Mail::to($datos['destinatario'])->send($correo);

            return back()->with('success', 'ok');
        } catch (Exception $e) {
            dd($e);
            return back()->with('error', 'Algo salió mal.Revise su conexión a internet');
        }
    }

    private function extractContentFromPdf($pdfFilePath)
    {
        // $pdf = new Pdf($pdfFilePath);
        // $textContent = $pdf->getText();
        $textContent = Pdf::getText($pdfFilePath);

        return $textContent;
    }
}
