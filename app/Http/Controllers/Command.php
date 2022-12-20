<?php

namespace App\Http\Controllers;

use App\Console\Commands\PurchasePodcast;
use Illuminate\Http\Request;

class Command extends Controller
{
    public function purchasePodcast()
    {
        $this->dispatch(
            new PurchasePodcast('hello')
        );
    }
}
