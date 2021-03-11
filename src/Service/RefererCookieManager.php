<?php


namespace Kikwik\ReferableBundle\Service;


use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;

class RefererCookieManager
{

    /**
     * @var \Symfony\Component\HttpFoundation\RequestStack
     */
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {

        $this->requestStack = $requestStack;
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