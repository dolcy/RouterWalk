<?php

namespace RouterApp\Repository\Eloquent;

use Psr\Http\Message\ServerRequestInterface as Request;
use RouterApp\Repository\Contract\PatientRepositoryInterface;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\TextResponse;

class PatientRepository implements PatientRepositoryInterface
{
    /**
     * @var
     */
    protected $args;
    /**
     * @var App
     */
    protected $request;

    /**
     * patientIndex.
     */
    public function patientIndex(Request $request): Response
    {
        echo 'I am patientIndex';
    }

    /**
     * patientFindById.
     *
     * @param mixed $args
     *
     * @return mixed
     */
    public function patientFindById(Request $request, array $args): Response
    {
        $args = null;
        echo 'I am patientFindById';
    }

    /**
     * patientCreate.
     */
    public function patientCreate(Request $request): Response
    {
        echo 'I am patientCreate';
    }

    /**
     * patientUpdateById.
     *
     * @param mixed $args
     *
     * @return mixed
     */
    public function patientUpdateById(Request $request, array $args): Response
    {
        $args = null;
        echo 'I am patientUpdateById';
    }

    /**
     * patientDeleteById.
     *
     * @param mixed $args
     *
     * @return mixed
     */
    public function patientDeleteById(Request $request, array $args): TextResponse
    {
        $args = null;
        echo 'I am patientDeleteById';
    }
}
