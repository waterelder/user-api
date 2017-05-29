<?php


namespace AppBundle\Controller\Api;


use AppBundle\Api\Exception\ApiProblem;
use AppBundle\Api\Exception\ApiProblemException;
use AppBundle\Api\Serialization\SerializationExclusionStrategy;
use Hateoas\HateoasBuilder;
use JMS\Serializer\SerializationContext;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Tests\Fixtures\Entity;


class BaseController extends Controller
{


    public function getEm()
    {
        return $this->getDoctrine()->getManager();
    }


    public function createResponse($data, $groups = null, $statusCode = 200)
    {


        $response = new Response($this->serialize($data, $groups, 'json'), $statusCode, array(
            'Content-Type' => 'application/hal+json',
        ));

        return $response;
    }


    private function serialize($data, $groups, $acceptableContentTypes)
    {


        $context = SerializationContext::create();
        if ($groups != null) {
            $context->setGroups($groups);
        }
        $context->enableMaxDepthChecks();

        return $this->get('serializer')->serialize($data, $acceptableContentTypes, $context);
    }

    protected function decodeRequestBody(Request $request)
    {
        $content = $request->getContent();

        if (!$content) {
            return array();
        }


        $content = json_decode($content, true);


        if ($content === null) {
            $apiProblem = new ApiProblem(400, ApiProblem::TYPE_INVALID_REQUEST_BODY_FORMAT);
            throw new ApiProblemException($apiProblem);
        }


        return $content;
    }


    protected function createAndProcessForm(Request $request, $entityFormType,  $entity)
    {


        if (!$entity) {
            $apiProblem = new ApiProblem(
                404,
                ApiProblem::TYPE_NOT_FOUND
            );
            throw new ApiProblemException($apiProblem);
        }


        $form = $this->createForm($entityFormType, $entity);


        $this->processForm($request, $form);

        if (!$form->isValid()) {
            $this->throwApiProblemValidationException($form);
        }

        return $entity;

    }

    protected
    function processForm(Request $request, FormInterface $form)
    {


        $data = $this->decodeRequestBody($request);
        $clearMissing = $request->getMethod() != 'PATCH';
        $form->submit($data, $clearMissing);
    }


    protected
    function getErrorsFromForm(FormInterface $form)
    {
        $errors = array();
        foreach ($form->getErrors() as $error) {
            $errors[] = $error->getMessage();
        }

        foreach ($form->all() as $childForm) {
            if ($childForm instanceof FormInterface) {
                if ($childErrors = $this->getErrorsFromForm($childForm)) {
                    $errors[$childForm->getName()] = $childErrors;
                }
            }
        }

        return $errors;
    }

    protected
    function throwApiProblemValidationException(FormInterface $form)
    {
        $errors = $this->getErrorsFromForm($form);

        $apiProblem = new ApiProblem(
            400,
            ApiProblem::TYPE_VALIDATION_ERROR
        );
        $apiProblem->set('errors', $errors);

        throw new ApiProblemException($apiProblem);
    }

}