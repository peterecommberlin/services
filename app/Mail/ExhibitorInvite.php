<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use Eventjuicer\Services\Personalizer;

use Eventjuicer\Models\Company;
use Eventjuicer\Services\Exhibitors\CompanyData;

class ExhibitorInvite extends Mailable
{
    use Queueable, SerializesModels;

    public $cd, $companydata, $subject, $imageEnc, $promolink, $body; 
  
    public function __construct(CompanyData $cd, $subject, $body)
    {
        $this->cd           = $cd;
        $this->subject      = $subject;
        $this->body         = $body;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $this->imageEnc     = $this->cd->logotype()->thumb();
    
        $this->promolink    = $this->cd->trackingLink("email", "button");

        $this->companydata = $this->cd->companyData();

        return $this->subject($this->subject)->markdown($this->body);
    }
}
