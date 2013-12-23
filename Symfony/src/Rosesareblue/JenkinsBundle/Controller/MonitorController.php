<?php

namespace Rosesareblue\JenkinsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction($url, $refresh) {

        $response = false;

        // Check the types
        if (is_int($refresh) && $this->isValidURL($url)) {
            $params = array();
            $params['url'] = $url;
            $params['refresh'] = $refresh;
            $response = $this->render('RosesareblueJenkinsBundle:Default:monitor.xml.twig', $params);
            $response->headers->set('Content-Type', 'application/xml');
        } else {
            $errors = array();
            if (!$this->isValidURL($url)) {
                $errors[] = "The first paramter must be the address of the build server";
            }

            if (!is_int($refresh)) {
                $errors[] = "The second paramter must be a number";
            }

            $params = array();
            $params['errors'] = $errors;
            $response = $this->render('RosesareblueJenkinsBundle:Default:error.xml.twig', $params);
            $response->headers->set('Content-Type', 'application/xml');
        }

        return $response;
    }

    /**
     * Validate a URL.
     * @param String $url The string URL
     * @return Boolean True if valid.
     */
    function isValidURL($url) {
        return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*
        (:[0-9]+)?(/.*)?$|i', $url);
    }

}
