<?php

namespace AppBundle\Controller\API;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations as Rest;


class SecurityController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     *
     * @ApiDoc(
     *  description="Login",
     *  section="Security",
     *  parameters={
     *      {"name"="_username", "dataType"="string", "required"=true},
     *      {"name"="_password", "dataType"="string", "required"=true,}
     *  },
     * )
     *
     * @Rest\Post("/login_check", name="login_check", options={ "method_prefix" = false })
     */
    public function loginCheckAction()
    {
        throw new \RuntimeException('You must configure the check path to be handled by the firewall using form_login in your security firewall configuration.');
    }
}