<?php


namespace Kikwik\ReferableBundle\Service;


use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class RefererManager
{

    /**
     * @var \Symfony\Component\HttpFoundation\RequestStack
     */
    private $requestStack;
    /**
     * @var \Symfony\Component\HttpFoundation\Session\SessionInterface
     */
    private $session;

    public function __construct(RequestStack $requestStack, SessionInterface $session)
    {

        $this->requestStack = $requestStack;
        $this->session = $session;
    }

    public function checkReferer(Request $request, Response $response)
    {
        if($request->query->has('r')) // check query string for "r" parameter
        {
            if(!$request->cookies->has('r')) // check that the "r" cookie was not already set
            {
                // send cookie with the response
                $response->headers->setCookie(Cookie::create('r',$request->query->get('r'), strtotime('+30 days')));
            }
        }

        if(!$this->session->has('kikwik_referable.http_referer'))
        {
            $this->session->set('kikwik_referable.http_referer',$request->server->get('HTTP_REFERER'));
        }
    }

    public function getHttpReferer()
    {
        return $this->session->get('kikwik_referable.http_referer');
    }

    public function getCookieValue():?string
    {
        $request = $this->requestStack->getCurrentRequest();
        if($request && $request->cookies->has('r'))
        {
            return $request->cookies->get('r');
        }
        return null;
    }
}