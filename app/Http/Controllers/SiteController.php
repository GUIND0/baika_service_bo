<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {

        return view('pages.site_vitrine.index');
    }

    public function about()
    {

        return view('pages.site_vitrine.about');
    }

    public function contact()
    {

        return view('pages.site_vitrine.contact');
    }

    public function domaine()
    {

        return view('pages.site_vitrine.domaine');
    }
}
