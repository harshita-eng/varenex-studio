<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Redirect, Session, Auth, Mail;

class PagesController extends Controller
{
    public function home() {

        $db = DB::connection('mysql')->select('SHOW TABLES'); 
        return view('Front.pages.home');
    }

    public function about() {

        return view('Front.pages.about');
    }

    public function service() {

        return view('Front.pages.service');
    }

    public function pricing() {

        return view('Front.pages.pricing');
    }

    public function contact() {

        return view('Front.pages.contact');
    }

    public function faqs() {

        return view('Front.pages.faqs');
    }

    public function testimonials() {

        return view('Front.pages.testimonials');
    }

    public function terms() {

        return view('Front.pages.terms');
    }
}
