<?php


namespace Sujit\Messenger\Listeners;


use Sujit\Messenger\Events\MessageSentEvent;
use Sujit\Messenger\Models\MessengerLog;
use Sujit\Messenger\Models\MessengerThread;
use Sujit\Messenger\Models\ThreadMessage;
use Sujit\Messenger\Models\UserService;
use Sujit\Messenger\Models\VendorService;

abstract class BaseListener
{
    public $userServiceId;

    public $vendorServiceId;

    public $userId;

    public function handle($event)
    {
        $vendorId = $event->vendor->id;
        $serviceId = $event->service->id;
        $this->userId = $event->user->id;
        $vendorService = VendorService::where('vendor_id', $vendorId)->where('service_id', $serviceId)->first();
        if(!$vendorService)
        {
            return false;
        }
        $this->vendorServiceId = $vendorService->id;
        $userService = UserService::where('vendor_service_id', $vendorService->id)->where('user_id', $this->userId)->first();
        if(!$userService)
        {
            return false;
        }
        $this->userServiceId = $userService->id;
        $this->logMessage($event);
        $this->createMessageThread($event);

    }

    private function logMessage($event)
    {
        $data = [
            'user_id' => $this->userId,
            'vendor_service_id' => $this->vendorServiceId,
            'request_data' => json_encode($event->payload),
            'response' => $event->response ? json_encode($event->response) : null,
        ];
        MessengerLog::create($data);
    }

    private function createMessageThread($event)
    {
        $data = [
            'label' => $event->payload['to'],
            'user_id' => $this->userId,
            'user_service_id' => $this->userServiceId,
            'recipient' => $event->payload['to']
        ];
        $thread = MessengerThread::updateOrCreate([
            'user_id' => $this->userId,
            'user_service_id' => $this->userServiceId,
            'recipient' => $event->payload['to']
        ], $data);

        $data = [
            'messenger_thread_id' => $thread->id,
            'message' => $event->payload['message'],
            'status' => $event->payload['status'],
            'failed_reason' => isset($event->payload['failed_reason']) ? $event->payload['failed_reason'] : null,
        ];

        ThreadMessage::create($data);
    }

}
