<?php

namespace Rosesareblue\JenkinsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Rosesareblue\JenkinsBundle\Forms\BuildForm;

/**
 * A wizard for setting up builds.
 *
 * @author russell.geraghty
 */
class DefaultController extends Controller {

    public function indexAction() {
        $build = new BuildForm();

        $form = $this->createFormBuilder($build)
                ->add('refresh', 'integer')
                ->add('buildUrl', 'url')
                ->add('save', 'submit')
                ->getForm();

        return $this->render('RosesareblueJenkinsBundle:Default:index.html.twig', array('form' => $form->createView()));
    }

}

?>
