<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // private const PATH_VIEW = 'admin.statistic.index';
    private const PATH_VIEW = 'admin.index';
    public function index()
    {
        return view(self::PATH_VIEW);
    }
}
