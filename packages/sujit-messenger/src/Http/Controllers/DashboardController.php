<?php


namespace Sujit\Messenger\Http\Controllers;


use Illuminate\Routing\Controller;

class DashboardController extends Controller
{

    public function index()
    {
        return view('messenger::messenger');
    }
}
