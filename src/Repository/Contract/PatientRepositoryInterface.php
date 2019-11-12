<?php

declare(strict_types=1);

namespace RouterApp\Repository\Contract;

use Psr\Http\Message\ServerRequestInterface as Request;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\TextResponse;

interface PatientRepositoryInterface
{
    /**
     * patientIndex.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function patientIndex(Request $request): Response;

    /**
     * patientFindById.
     *
     * @param Request $request
     * @param array   $args
     *
     * @return Response
     */
    public function patientFindById(Request $request, array $args): Response;

    /**
     * patientCreate.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function patientCreate(Request $request): Response;

    /**
     * patientUpdateById.
     *
     * @param Request $request
     * @param array   $args
     *
     * @return Response
     */
    public function patientUpdateById(Request $request, array $args): Response;

    /**
     * patientDeleteById.
     *
     * @param Request $request
     * @param array   $args
     *
     * @return TextResponse
     */
    public function patientDeleteById(Request $request, array $args): TextResponse;
}
