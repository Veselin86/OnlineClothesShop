<?php

namespace App\Mail;

use App\Models\Sale;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoicesMailabel extends Mailable
{
    use Queueable, SerializesModels;

    public $sale;
    public $user;


    /**
     * Create a new message instance.
     */
    public function __construct(Sale $sale, User $user )
    {
        $this->sale = $sale;
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            /* from: new Address('info@fashionshop.com', 'Fashion Shop'), */
            subject: 'Compra realizada',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.invoiceMail',
                         with: [
                'sale' => $this->sale,
                'user' => $this->user 
            ] 
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            /* Attachment::fromPath('/path/to/file'), */
            /* Attachment::fromData(fn () => $this->pdf, 'invoice.pdf') */];
    }


    public function build()
    {
        return $this->view('emails.invoiceMail')
            ->attach(storage_path("app/public/sales/invoice_{$this->sale->id}.pdf"));
    }
}
