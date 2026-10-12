<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DashboardController extends Controller
{
    public function admin(): View
    {
        return view('dashboard.admin');
    }

    public function editor(): View
    {
        return view('dashboard.editor');
    }

    public function user(): View
    {
        return view('dashboard.user');
    }
}