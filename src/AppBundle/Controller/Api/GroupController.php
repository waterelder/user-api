<?php

namespace AppBundle\Controller\Api;

use AppBundle\Api\Request\RequestDecoder;
use AppBundle\Entity\UserGroup;
use AppBundle\Forms\GroupType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
        return $this
            ->get('api.response.builder')
            ->createResponse(
                $this->getDoctrine()->getRepository('AppBundle:UserGroup')->findAll(),
                ['Default', 'groups']
            );
    }

    /**
     * @Route("/{id}", name="get_group", requirements={"id": "\d+"})
     * @Method("GET")
     *
     * @param UserGroup $group
     *
     * @return Response
     */
    public function getGroupAction(UserGroup $group)
    {
        return $this
            ->get('api.response.builder')
            ->createResponse($group, ['Default', 'groups']);
    }

    /**
     * @Route("/", name="create_group")
     * @Method("POST")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function createGroupAction(Request $request)
    {
        $form = $this->createForm(GroupType::class, new UserGroup());
        $form->submit(RequestDecoder::decodeRequestBody($request), ($request->getMethod() !== Request::METHOD_PATCH));

        if (!$form->isValid()) {
            $this->throwApiProblemValidationException($form);
        }

        $em = $this->getEm();

        $em->persist($newGroup);
        $em->flush();

        foreach ($newGroup->getUsers() as $user) {
            $user->setUserGroup($newGroup);
        }
        $em->flush();

        return $this
            ->get('api.response.builder')
            ->createResponse($newGroup, ['Default', 'groups'], Response::HTTP_CREATED);
    }

    /**
     * @Route("/{id}"), name="update_group", requirements={"id": "\d+"})
     * @Method({"PUT", "PATCH"})
     *
     * @param $id
     * @param Request $request
     *
     * @return Response
     */
    public function updateGroupAction(UserGroup $group, Request $request)
    {
        $form = $this->createForm(GroupType::class, $group);
        $form->submit(RequestDecoder::decodeRequestBody($request), ($request->getMethod() !== Request::METHOD_PATCH));

        if (!$form->isValid()) {
            $this->throwApiProblemValidationException($form);
        }

        $em = $this->getEm();
        $em->persist($group);
        $em->flush();

        foreach ($group->getUsers() as $user) {
            $user->setUserGroup($group);
        }
        $em->flush();

        return $this
            ->get('api.response.builder')
            ->createResponse($group, ['Default', 'groups']);
    }
}
