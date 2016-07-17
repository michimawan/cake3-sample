<?php
namespace App\Routing\Filter;

use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Routing\DispatcherFilter;

class ApiFilter extends DispatcherFilter
{
    public function beforeDispatch(Event $event)
    {
        $authToken = Configure::read('authToken.app');
        $request = $event->data['request'];

        if (! is_null($request->header('X-API-TOKEN')) &&
            $authToken == $request->header('X-API-TOKEN')) {
            return true;
        }

        echo 'Not allowed';
        die();
    }
}

