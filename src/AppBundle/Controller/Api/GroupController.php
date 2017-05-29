<?php

namespace AppBundle\Controller\Api;

use AppBundle\Api\Exception\ApiProblem;
use AppBundle\Api\Exception\ApiProblemException;
use AppBundle\Entity\UserGroup;
use AppBundle\Forms\GroupType;
use AppBundle\Forms\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/groups")
 */
class GroupController extends BaseController
{


    /**
     * @Route("/", name="get_all_groups")
     * @Method("GET")
     */
    public function getAllGroupsAction()
    {
        return $this->createResponse($this->getEm()->getRepository('AppBundle:UserGroup')->findAll(), array('Default', 'groups'));
    }


    /**
     * @Route("/{id}", name="get_group",  requirements={"id": "\d+"})
     * @Method("GET")
     */
    public function getGroupAction($id)
    {
        $group = $this->getEm()->getRepository('AppBundle:UserGroup')->findById($id);

        if (!$group) {
            throw new ApiProblemException(new ApiProblem(404, ApiProblem::TYPE_NOT_FOUND));
        }


        return $this->createResponse($group, array('Default', 'groups'));
    }

    /**
     * @Route("/", name="create_group")
     * @Method("POST")
     */
    public function createGroupAction(Request $request)
    {

        $newGroup = $this->createAndProcessForm($request, GroupType::class, new UserGroup());

        $this->getEm()->persist($newGroup);

        $this->getEm()->flush();

        foreach ($newGroup->getUsers() as $user) {
            $user->setUserGroup($newGroup);

        }
        $this->getEm()->flush();

        return $this->createResponse($newGroup, array('Default', 'groups'), 201);
    }


    /**
     * @Route("/{id}"), name="update_group")
     * @Method({"PUT", "PATCH"})
     */
    public function updateGroupAction($id, Request $request)
    {
        $group = $this->getDoctrine()
            ->getRepository('AppBundle:UserGroup')
            ->findById($id);

        $group = $this->createAndProcessForm($request, GroupType::class, $group);


        $em = $this->getDoctrine()->getManager();
        $em->persist($group);
        $em->flush();

        foreach ($group->getUsers() as $user) {
            $user->setUserGroup($group);

        }
        $this->getEm()->flush();


        return $this->createResponse($group, array('Default', 'groups'));
    }


}