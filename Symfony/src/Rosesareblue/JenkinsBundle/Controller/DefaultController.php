<?php

namespace Rosesareblue\JenkinsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Rosesareblue\JenkinsBundle\Forms\BuildForm;

/**
 * A wizard for setting up builds.
 *
 * @author russell.geraghty
 */
class DefaultController extends Controller {

    public function indexAction(Request $request) {
        $build = new BuildForm();

        $form = $this->createFormBuilder($build)
                ->add('buildName', 'text')
                ->add('refresh', 'integer')
                ->add('buildUrl', 'url')
                ->add('save', 'submit')
                ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $params = array();
            $data = $form->getData();
            $urlParams = array();
            $urlParams['url'] = urlencode($data->getBuildUrl());
            $urlParams['refresh'] = $data->getRefresh();
            $urlParams['buildName'] = $data->getBuildName();
            $params['url'] = $this->generateUrl('rosesareblue_jenkins_monitor', $urlParams);

            return $this->render('RosesareblueJenkinsBundle:Default:dashboard-url.html.twig', $params);
        } else {
            return $this->render('RosesareblueJenkinsBundle:Default:index.html.twig', array('form' => $form->createView()));
        }
    }

}

?>
