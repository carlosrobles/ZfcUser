<?php

namespace ZfcUser\Authentication\Adapter;

use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result as AuthenticationResult;
use Zend\EventManager\Event;
use Zend\Stdlib\RequestInterface as Request;
use Zend\Stdlib\ResponseInterface as Response;
use ZfcBase\EventManager\EventProvider;
<<<<<<< HEAD
=======
use ZfcUser\Exception;
>>>>>>> fbbe5fdeabd9229bf7d1328358c2d95538a6081e

class AdapterChain extends EventProvider implements AdapterInterface
{
    /**
     * @var AdapterChainEvent
     */
    protected $event;

    /**
     * Returns the authentication result
     *
     * @return AuthenticationResult
     */
    public function authenticate()
    {
        $e = $this->getEvent();

        $result = new AuthenticationResult(
            $e->getCode(),
            $e->getIdentity(),
            $e->getMessages()
        );

        $this->resetAdapters();

        return $result;
    }

<<<<<<< HEAD
    public function prepareForAuthentication(Request $request)
    {
        $e = $this->getEvent()
                  ->setRequest($request);
=======
    /**
     * prepareForAuthentication
     *
     * @param  Request $request
     * @return Response|bool
     * @throws Exception\AuthenticationEventException
     */
    public function prepareForAuthentication(Request $request)
    {
        $e = $this->getEvent();
        $e->setRequest($request);
>>>>>>> fbbe5fdeabd9229bf7d1328358c2d95538a6081e

        $this->getEventManager()->trigger('authenticate.pre', $e);

        $result = $this->getEventManager()->trigger('authenticate', $e, function($test) {
            return ($test instanceof Response);
        });

        if ($result->stopped()) {
            if($result->last() instanceof Response) {
                return $result->last();
<<<<<<< HEAD
            } else {
                // throw new Exception('Auth event was stopped without a response.');
            }
=======
            }

            throw new Exception\AuthenticationEventException(
                sprintf(
                    'Auth event was stopped without a response. Got "%s" instead',
                    is_object($result->last()) ? get_class($result->last()) : gettype($result->last())
                )
            );
>>>>>>> fbbe5fdeabd9229bf7d1328358c2d95538a6081e
        }

        if ($e->getIdentity()) {
            return true;
        }

        return false;
    }

    /**
     * resetAdapters
     *
     * @return AdapterChain
     */
    public function resetAdapters()
    {
        $listeners = $this->getEventManager()->getListeners('authenticate');
        foreach ($listeners as $listener) {
            $listener = $listener->getCallback();
            if (is_array($listener) && $listener[0] instanceof ChainableAdapter) {
                $listener[0]->getStorage()->clear();
            }
        }
        return $this;
    }

    /**
     * logoutAdapters
     *
     * @return AdapterChain
     */
    public function logoutAdapters()
    {
        //Adapters might need to perform additional cleanup after logout
        $this->getEventManager()->trigger('logout', $this->getEvent());
    }

    /**
     * Get the auth event
     *
     * @return AdapterChainEvent
     */
    public function getEvent()
    {
        if (null === $this->event) {
            $this->setEvent(new AdapterChainEvent);
            $this->event->setTarget($this);
        }
        return $this->event;
    }

    /**
     * Set an event to use during dispatch
     *
     * By default, will re-cast to AdapterChainEvent if another event type is provided.
     *
     * @param  Event $e
     * @return AdapterChain
     */
    public function setEvent(Event $e)
    {
<<<<<<< HEAD
        if ($e instanceof Event && !$e instanceof AdapterChainEvent) {
            $eventParams = $e->getParams();
            $e = new AdapterChainEvent();
            $e->setParams($eventParams);
            unset($eventParams);
=======
        if (!$e instanceof AdapterChainEvent) {
            $eventParams = $e->getParams();
            $e = new AdapterChainEvent();
            $e->setParams($eventParams);
>>>>>>> fbbe5fdeabd9229bf7d1328358c2d95538a6081e
        }
        $this->event = $e;
        return $this;
    }
}
