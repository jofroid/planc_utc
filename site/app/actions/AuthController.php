<?php

use \SimpleXMLElement;
use \Httpful\Request;

class AuthenticationFailure extends \Exception {};

class AuthController extends BaseController
{
    protected $url;
    protected $timeout;
    
    public function __construct()
    {
        $this->url = Atomik::get("cas_url");
        $this->timeout = Atomik::get("cas_timeout");
    }

    public function login($ticket = null)
    {
        // Si l'utilisateur est connecté, on le redirige, (rien à faire ici)
        if ($this->_isLogged())
        {
            Atomik::redirect("accueil/index");
        }
        // Connexion par le CAS
        if ($ticket == null)
        {
            $url = $this->url . "login?service=" . Atomik::url();
            Atomik::redirect($url);
        }
        else
        {
            if ($login = $this->authenticate($ticket, Atomik::url()))
            {
                    $this->etudiant = Etudiant::avecLogin($login);
                    $cookie = $this->etudiant->genIdTemporaire();
                    setcookie("id_temporaire", $cookie['id_temporaire'], $cookie['date_expiration'], '/');
                    setcookie("id_persistant", $this->etudiant->id_persistant, $cookie['date_expiration'], '/');
                    Atomik::redirect("accueil");
            }
        }
    }
    public function authenticate($ticket, $service)
    {
        $r = Request::get($this->getValidateUrl($ticket, $service))
          ->sendsXml()
          ->timeoutIn($this->timeout)
          ->send();
        $r->body = str_replace("\n", "", $r->body);
        try {
            $xml = new SimpleXMLElement($r->body);
        }
        catch (\Exception $e) {
            throw new \UnexpectedValueException("Return cannot be parsed : '{$r->body}'");
        }
        
        $namespaces = $xml->getNamespaces();
        
        $serviceResponse = $xml->children($namespaces['cas']);
        $user = $serviceResponse->authenticationSuccess->user;
        
        if ($user) {
            return (string)$user; // cast simplexmlelement to string
        }
        else {
            $authFailed = $serviceResponse->authenticationFailure;
            if ($authFailed) {
                $attributes = $authFailed->attributes();
                throw new AuthenticationFailure((string)$attributes['code']);
            }
            else {
                Log::error("Cas return is weird : '{$r->body}'");
                throw new \UnexpectedValueException($r->body);
            }
        }
        // never reach there
    }
    
    public function getValidateUrl($ticket, $service)
    {
        return $this->url."serviceValidate?ticket=".urlencode($ticket)."&service=".urlencode($service);
    }
};

