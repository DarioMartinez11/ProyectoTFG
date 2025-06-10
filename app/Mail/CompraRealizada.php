<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class CompraRealizada extends Mailable
{
    //este use es necesario para que funcione la cola de correos
    use Queueable, SerializesModels;

     // Propiedades públicas que estarán disponibles en las vistas (HTML y PDF)
    public $datos;
    public $productos;

    //Recibe los datos del cliente y los productos comprados, y los asigna a propiedades públicas
    public function __construct($datos, $productos)
    {
        $this->datos = $datos;
        $this->productos = $productos;
    }

  public function build()
{
    // Genera un PDF a partir de la vista 'pdf.pedido' y le pasa los datos necesarios
    $pdf = Pdf::loadView('pdf.pedido', [
        'datos' => $this->datos,
        'productos' => $this->productos,
    ]);

    // Retorna el correo con el asunto, la vista HTML y el PDF adjunto
    return $this->subject('🧾 Confirmación de compra - Pinturas General')
                ->view('emails.compra')
                ->attachData($pdf->output(), 'pedido.pdf', [
                    'mime' => 'application/pdf',
                ]);
}
}
