<?php

namespace App;

use BeyondCode\Mailbox\InboundEmail;
use Illuminate\Support\Facades\Storage;

class TrashBinMailbox
{
    private $status;

    public function __invoke(InboundEmail $email)
    {
        if (strpos($email->text(), '*Trash*') !== false) {
            $this->status = 'trash';
        }
        if (strpos($email->text(), '*Recycling*') !== false) {
            $this->status = 'both';
        }
        Storage::disk('local')->put('status.txt', $this->status);
    }
}
