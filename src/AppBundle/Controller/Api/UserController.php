<?php

namespace AppBundle\Controller\Api;

use AppBundle\Api\Exception\ApiProblem;
use AppBundle\Api\Exception\ApiProblemException;
use AppBundle\Entity\User;
use AppBundle\Forms\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/users")
 */
class UserController extends BaseController
{
    /**
     * @Route("/", name="get_all_users")
     * @Method("GET")
     */
    public function getAllUsersAction()
    {
        return $this->createResponse($this->getEm()->getRepository('AppBundle:User')->findAll(), array('Default', 'users'));
    }

    /**
     * @Route("/{id}", name="get_user",  requirements={"id": "\d+"})
     * @Method("GET")
     */
    public function getUserAction($id)
    {
        $user = $this->getEm()->getRepository('AppBundle:User')->findById($id);

        if (!$user) {
            throw new ApiProblemException(new ApiProblem(404, ApiProblem::TYPE_NOT_FOUND));
        }

        return $this->createResponse($user, array('Default', 'users'));
    }

    /**
     * @Route("/", name="create_user")
     * @Method("POST")
     */
    public function createUserAction(Request $request)
    {
        $newUser = $this->createAndProcessForm($request, UserType::class, new User());

        $this->getEm()->persist($newUser);

        $this->getEm()->flush();

        return $this->createResponse($newUser, array('Default', 'users'), 201);
    }

    /**
     * @Route("/{id}"), name="update_user")
     * @Method({"PUT", "PATCH"})
     */
    public function updateUserAction($id, Request $request)
    {
        $user = $this->getDoctrine()
            ->getRepository('AppBundle:User')
            ->findById($id);

        $user = $this->createAndProcessForm($request, UserType::class, $user);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);

        $em->flush();

        return $this->createResponse($user, array('Default', 'users'));
    }
}
