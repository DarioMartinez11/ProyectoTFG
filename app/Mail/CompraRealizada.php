<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class CompraRealizada extends Mailable
{
    use Queueable, SerializesModels;

    public $datos;
    public $productos;

    public function __construct($datos, $productos)
    {
        $this->datos = $datos;
        $this->productos = $productos;
    }

  public function build()
{
    $pdf = Pdf::loadView('pdf.pedido', [
        'datos' => $this->datos,
        'productos' => $this->productos,
    ]);

    return $this->subject('🧾 Confirmación de compra - Pinturas General')
                ->view('emails.compra')
                ->attachData($pdf->output(), 'pedido.pdf', [
                    'mime' => 'application/pdf',
                ]);
}
}
