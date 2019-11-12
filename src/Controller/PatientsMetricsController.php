<?php

declare(strict_types=1);

namespace RouterApp\Controller;

use Exception;
use Illuminate\Database\Capsule\Manager as DB;
use Psr\Http\Message\ServerRequestInterface as Request;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\TextResponse;

class PatientsMetricsController extends AbstractController
{
    /**
     * Index action resource.
     *
     * @param Request $request
     * @param array   $args
     *
     * @return Response
     */
    public function patientMetricIndex(Request $request, array $args): Response
    {
        // Perform query
        $patientsMetrics = DB::table('patients')
            ->where('patients.id', $args['id'])
            ->join('metrics', 'patients.id', '=', 'metrics.patient_id')
            ->select(
                'patients.id',
                'patients.name',
                'patients.age',
                'patients.location',
                'metrics.id',
                'metrics.patient_id',
                'metrics.type',
                'metrics.risk_level'
            )
            ->first();
        // check if patient exists before deleting
        if (null === $patientsMetrics) {
            return new TextResponse('Patient id:'.$args['id'].' does not exist.', 404);
        }

        // Process argument array
        $args = [
                 'id' => $patientsMetrics->id,
                 'patientName' => $patientsMetrics->name,
                 'patientAge' => $patientsMetrics->age,
                 'patientLocation' => $patientsMetrics->location,
                 'metricType' => $patientsMetrics->type,
                 'metricRiskLevel' => $patientsMetrics->risk_level,
               ];

        $response = new Response();

        try {
            $response->getBody()->write(json_encode($args));
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
    public function patientMetricFindById(Request $request, array $args): Response
    {
        // Perform query
        $patientsMetrics = DB::table('patients')
            ->where('patients.id', $args['id'])
            ->join('metrics', 'patients.id', '=', 'metrics.patient_id')
            ->select(
                'patients.id',
                'patients.name',
                'patients.age',
                'patients.location',
                'metrics.id',
                'metrics.patient_id',
                'metrics.type',
                'metrics.risk_level'
            )
            ->first();

        // check if patient exists before deleting
        if (null === $patientsMetrics) {
            return new TextResponse('Patient id:'.$args['id'].' does not exist.', 404);
        }

        // Process argument array
        $args = [
              'id' => $patientsMetrics->id,
              'patientName' => $patientsMetrics->name,
              'patientAge' => $patientsMetrics->age,
              'patientLocation' => $patientsMetrics->location,
              'metricType' => $patientsMetrics->type,
              'metricRiskLevel' => $patientsMetrics->risk_level,
              'any' => $args['any'],
            ];

        $response = new Response();

        try {
            $response->getBody()->write(json_encode($args, JSON_PRETTY_PRINT));
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
    public function patientMetricCreate(Request $request): Response
    {
        // Perform update by id
        $patientsMetrics = DB::table('patients')
            ->insert(
                [
                  'patients.name' => 'Jean Bain',
                  'patients.age' => '73',
                  'patients.location' => 'Newwark, NJ',
                  'patients.created_at' => \Carbon\Carbon::now(),
                  'patients.updated_at' => \Carbon\Carbon::now(),
                ]
            );

        // check if patient exists before creating
        if (null === $patientsMetrics) {
            return new TextResponse('Sorry, an error occurred creating patient.', 400);
        }

        $response = new Response();

        try {
            $response->getBody()->write(json_encode($patientsMetrics, JSON_PRETTY_PRINT));
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
    public function patientMetricUpdateById(Request $request, array $args): Response
    {
        // Perform update by id
        $patientsMetrics = DB::table('patients')
            ->where('patients.id', $args['id'])
            ->join('metrics', 'patients.id', '=', 'metrics.patient_id')
            ->update(
                [
                  'patients.name' => $args['any'],
                  'patients.age' => '88',
                  'patients.location' => 'Bronx, NY',
                  'metrics.type' => 'Dementia',
                  'metrics.risk_level' => 'Low',
                ]
            );

        $response = new Response();

        try {
            $findPatient = DB::table('patients')->where('patients.id', $args['id'])->first();

            // check if patient exists before updating
            if (null === $findPatient) {
                return new TextResponse('Patient id:'.$args['id'].' does not exist!', 404);
            }
            $response->getBody()->write(json_encode($patientsMetrics, JSON_PRETTY_PRINT));
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
    public function patientMetricDeleteById(Request $request, array $args): TextResponse
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
