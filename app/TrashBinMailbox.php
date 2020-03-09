<?php

namespace App;

use Illuminate\Support\Facades\Log;
use BeyondCode\Mailbox\InboundEmail;
use Illuminate\Support\Facades\Storage;

class TrashBinMailbox
{
    private $status;

    public function __invoke(InboundEmail $email)
    {
        if (strpos($email->html(), '<strong>Trash') !== false) {
            $this->status = 'bin-status trash';
        }
        if (strpos($email->html(), '<strong>Recycling') !== false) {
            $this->status = 'bin-status both';
        }
        Log::info('Status: ' . $this->status);
        Storage::disk('local')->put('status.txt', $this->status);
    }
}
