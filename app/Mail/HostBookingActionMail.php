<?php
namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HostBookingActionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $action;

    public function __construct(Booking $booking, $action)
    {
        $this->booking = $booking;
        $this->action = $action;
    }

    public function build()
    {
        return $this->subject("You have {$this->action} a booking")
                    ->view('mail.host_action')
                    ->with([
                        'booking' => $this->booking,
                        'action' => $this->action,
                    ]);
    }
}
