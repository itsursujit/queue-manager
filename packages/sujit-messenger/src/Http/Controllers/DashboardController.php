<?php


namespace Sujit\Messenger\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Sujit\Messenger\Events\MessageCallbackReceivedEvent;
use Sujit\Messenger\Events\MessageReceivedEvent;
use Sujit\Messenger\Events\MessageSentEvent;
use Sujit\Messenger\Facades\MessengerFacade;
use Sujit\Messenger\Models\MessageVendor;

class DashboardController extends Controller
{

    public function index()
    {
        $payload = [
            'body' => 'this is test',
            'to' => '+9779856034616',
            'from' => 'sujit',
            'message' => 'this is test',
            'status' => 'PENDING'
        ];
        $vendor = MessageVendor::where('slug', 'routee')->first();
        $service = $vendor->services()->first();
        $user = User::first();
        event(new MessageSentEvent($user, $vendor, $service, $payload, []));
        /*$service = MessengerFacade::channel($service->slug)
            ->withVendor($vendor)
            ->withService($service->pivot)
            ->auth()
            ->send($payload);*/
        dd($service);
        dd(3);
        return view('messenger::messenger');
    }

    public function receiveMessage(Request $request, $vendor, $service)
    {
        $payload = [
            'body' => 'this is test',
            'to' => '+9779856034616',
            'from' => 'sujit',
            'message' => 'this is test',
            'status' => 'RECEIVING'
        ];
        $vendor = MessageVendor::where('slug', 'routee')->first();
        $service = $vendor->services()->first();
        $user = User::first();
        event(new MessageReceivedEvent($user, $vendor, $service, $payload, []));
    }

    public function receiveCallback(Request $request, $vendor, $service)
    {
        $payload = [
            'body' => 'this is test',
            'to' => '+9779856034616',
            'from' => 'sujit',
            'message' => 'this is test',
            'status' => 'CALLBACK'
        ];
        $vendor = MessageVendor::where('slug', 'routee')->first();
        $service = $vendor->services()->first();
        $user = User::first();
        event(new MessageCallbackReceivedEvent($user, $vendor, $service, $payload, []));
    }
}
