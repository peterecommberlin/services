<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use Eventjuicer\Services\Personalizer;

use Eventjuicer\Models\Company;
use Eventjuicer\Services\CompanyData;

class ExhibitorInvite extends Mailable
{
    use Queueable, SerializesModels;

    public $company, $companydata, $subject, $imageEnc, $promolink, $body; 
  
    public function __construct(Company $company, $imageEnc, $promolink, $subject, $body)
    {
        $this->company      = $company;
        $this->imageEnc     = $imageEnc;
        $this->subject      = $subject;
        $this->promolink    = $promolink;
        $this->body         = $body;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(CompanyData $companydata)
    {

        $this->companydata = $companydata->toArray($this->company);

        return $this->subject($this->subject)->markdown($this->body);
    }
}
