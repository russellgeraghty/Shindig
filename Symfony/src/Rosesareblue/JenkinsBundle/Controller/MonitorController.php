<?php

namespace Rosesareblue\JenkinsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MonitorController extends Controller {

    public function indexAction($url, $refresh, $buildName) {

        $response = false;
        $theUrl = urldecode($url);
        $theBuildName = urldecode($buildName);

        // Check the types
        if (is_numeric($refresh) && $this->isValidURL($theUrl)) {
            $params = array();
            $params['url'] = $theUrl;
            $params['refresh'] = $refresh;
            $params['buildName'] = $theBuildName;
            $response = $this->render('RosesareblueJenkinsBundle:Default:monitor.xml.twig', $params);
            $response->headers->set('Content-Type', 'application/xml');
        } else {
            $errors = array();
            if (!$this->isValidURL($theUrl)) {
                $errors[] = "The first parameter must be the address of the build server. Received |$theUrl|";
            }

            if (!is_numeric($refresh)) {
                $errors[] = "The second parameter must be a number. Received |$refresh|";
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
        return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
    }

}
