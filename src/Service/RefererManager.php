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
    /**
     * @var array
     */
    private $configuration;

    public function __construct(array $configuration, RequestStack $requestStack, SessionInterface $session)
    {
        $this->configuration = $configuration;
        $this->requestStack = $requestStack;
        $this->session = $session;
    }

    public function checkReferer(Request $request, Response $response)
    {
        // http referer
        if(!$this->session->has('kikwik_referable.http_referer'))
        {
            $this->session->set('kikwik_referable.http_referer',$request->server->get('HTTP_REFERER'));
            $this->session->set('kikwik_referable.http_landing_url',$request->getUri());
        }

        // cookies
        foreach($this->configuration as $interfaceName => $interfaceConfig)
        {
            if(!$request->cookies->has($interfaceConfig['cookie_name'])) // check if the cookie was not already set
            {
                // get values from query params
                $cookieValue = [];
                foreach($interfaceConfig['query_params'] as $queryParam)
                {
                    if($request->query->has($queryParam))
                    {
                        $cookieValue[$queryParam] = $request->query->get($queryParam);
                    }
                }

                if(count($cookieValue)) // if values are present, save the cookie
                {
                    // send cookie with the response
                    $response->headers->setCookie(Cookie::create(
                        $interfaceConfig['cookie_name'],
                        $this->serialize($cookieValue),
                        strtotime($interfaceConfig['expire'])
                    ));

                    // save value also in session
                    $this->session->set('kikwik_referable.cookie.'.$interfaceConfig['cookie_name'],$this->serialize($cookieValue));
                }
            }
            elseif($this->session->get('kikwik_referable.clear_cookies',false))
            {
                $response->headers->clearCookie($interfaceConfig['cookie_name']);
                $this->session->clear('kikwik_referable.cookie.'.$interfaceConfig['cookie_name']);
            }
        }

        if($this->session->get('kikwik_referable.clear_cookies',false))
        {
            $this->session->remove('kikwik_referable.clear_cookies');
        }
    }

    public function getHttpReferer()
    {
        return $this->session->get('kikwik_referable.http_referer');
    }

    public function getHttpRefererLandingUrl()
    {
        return $this->session->get('kikwik_referable.http_landing_url');
    }

    public function getCookieValues():array
    {
        $result = [];
        foreach($this->configuration as $interfaceName => $interfaceConfig)
        {
            $result[$interfaceName] = $this->getCookieValue($interfaceConfig['cookie_name']);
        }
        return $result;
    }

    public function getCookieValue(string $cookieName):?array
    {
        $request = $this->requestStack->getCurrentRequest();
        if($request && $request->cookies->has($cookieName))
        {
            return $this->unserialize($request->cookies->get($cookieName));
        }
        elseif($this->session->has('kikwik_referable.cookie.'.$cookieName))
        {
            return $this->unserialize($this->session->get('kikwik_referable.cookie.'.$cookieName));
        }

        return null;
    }

    public function clearCookiesOnNextResponse()
    {
        // set a session variable that will clear cookies on next request
        $this->session->set('kikwik_referable.clear_cookies',true);
    }

    private function serialize($value)
    {
        return json_encode($value);
    }

    private function unserialize($value)
    {
        return json_decode($value, true);
    }
}