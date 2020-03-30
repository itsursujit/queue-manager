<?php


namespace Sujit\Messenger\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Sujit\Messenger\Facades\MessengerFacade;
use Sujit\Messenger\Models\MessageVendor;

class DashboardController extends Controller
{

    public function index()
    {
        $payload = [
            'body' => 'this is test',
            'to' => '+9779856034616',
            'from' => 'sujit'
        ];
        $vendor = MessageVendor::where('slug', 'routee')->first();
        $service = $vendor->services()->first();
        $service = MessengerFacade::channel($service->slug)
            ->withVendor($vendor)
            ->withService($service->pivot)
            ->auth()
            ->send($payload);
        dd($service);
        return view('messenger::messenger');
    }

    public function receiveMessage(Request $request, $vendor, $service)
    {
        dd(1);
    }

    public function receiveCallback(Request $request, $vendor, $service)
    {
        dd(2);
    }
}
