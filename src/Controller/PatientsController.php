<?php

declare(strict_types=1);

namespace RouterApp\Controller;

use Illuminate\Database\Capsule\Manager as DB;
use Psr\Http\Message\ServerRequestInterface as Request;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\TextResponse;

class PatientsController extends AbstractController
{
    /**
     * Index action resource.
     *
     * @param Request $request
     * @param array   $args
     *
     * @return Response
     */
    public function patientIndex(Request $request): Response
    {
        // Perform query
        $patients = DB::table('patients')
            ->select(
                'patients.id',
                'patients.name',
                'patients.age',
                'patients.location',
            )
            ->get();

        $response = new Response();

        try {
            $response->getBody()->write(json_encode($patients, JSON_PRETTY_PRINT));
        } catch (Exception $e) {
            throw $e;
        }
        return $response->withStatus(200);
    }

    /**
     * Get action resource.
     *
     * @param Request $request
     * @param array   $args
     *
     * @return Response
     */
    public function patientFindById(Request $request, array $args): Response
    {
        // Perform query
        $patients = DB::table('patients')
            ->where('patients.id', $args['id'])
            ->select(
                'patients.id',
                'patients.name',
                'patients.age',
                'patients.location'
            )
            ->first();

        $response = new Response();

        try {
            // check if patient exists before deleting
            if (null === $patients) {
                return new TextResponse('Patient id:'.$args['id'].' does not exist.', 404);
            }
            $response->getBody()->write(json_encode($patients, JSON_PRETTY_PRINT));
        } catch (Exception $e) {
            throw $e;
        }
        return $response->withStatus(200);
    }

    /**
     * Create resource action.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function patientCreate(Request $request): Response
    {
        // Perform update by id
        $patients = DB::table('patients')
            ->insert(
                [
                  'patients.name' => 'Jean Bain',
                  'patients.age' => '73',
                  'patients.location' => 'Newark, NJ',
                  'patients.created_at' => \Carbon\Carbon::now(),
                  'patients.updated_at' => \Carbon\Carbon::now(),
                ]
            );

        $response = new Response();

        try {
            // check if patient exists before creating
            if (null === $patients) {
                return new TextResponse('Sorry, an error occurred creating patient.', 400);
            }
            $response->getBody()->write(json_encode($patients, JSON_PRETTY_PRINT));
        } catch (Exception $e) {
            throw $e;
        }
        return new TextResponse('Patient has been created!', 200);
    }

    /**
     * Update resource action.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function patientUpdateById(Request $request, array $args): Response
    {
        // Perform update by id
        $patients = DB::table('patients')
            ->where('patients.id', $args['id'])
            ->update(
                [
                  'patients.name' => 'Rene Reynolds',
                  'patients.age' => '59',
                  'patients.location' => 'Brooklyn, NY',
                  'patients.updated_at' => \Carbon\Carbon::now(),
                ]
            );

        $response = new Response();

        try {
            $findPatient = DB::table('patients')->where('patients.id', $args['id'])->first();

            // check if patient exists before updating
            if (null === $findPatient) {
                return new TextResponse('Patient id:'.$args['id'].' does not exist!', 404);
            }

            $response->getBody()->write(json_encode($patients, JSON_PRETTY_PRINT));
        } catch (Exception $e) {
            throw $e;
        }
        return new TextResponse('Patient id:'.$args['id'].' has been updated!', 200);
    }

    /**
     * Delete resource action.
     *
     * @param Request $request
     *
     * @return TextResponse
     */
    public function patientDeleteById(Request $request, array $args): TextResponse
    {
        try {
            $patient = DB::table('patients')->where('patients.id', $args['id'])->first();

            // check if patient exists before deleting
            if (null === $patient) {
                return new TextResponse('Patient id:'.$args['id'].' does not exist.', 404);
            }
            // delete patient
            $patient = DB::table('patients')->where('patients.id', $args['id'])->delete();

            $response = new TextResponse('Patient id:'.$args['id'].' has been successfully deleted!');
        } catch (Exception $e) {
            throw $e;
        }
        return $response;
    }
}
