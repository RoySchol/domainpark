<?php

namespace App\Http\Controllers;

use App\Models\Domain;

class DomainController extends Controller
{
    public function index()
    {
        $domains = Domain::paginate(10);
        return view('domains.index', compact('domains'));
    }
}

