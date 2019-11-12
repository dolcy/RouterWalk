<?php

namespace RouterApp\Repository\Eloquent;

use Illuminate\Database\Capsule\Manager as DB;
use RouterApp\Repository\Contract\PatientMetricRepositoryInterface;

class PatientMetricRepository implements PatientMetricRepositoryInterface
{
    /**
     * patientMetricIndex.
     *
     * @param mixed $args
     */
    public function patientMetricIndex($args)
    {
        // Perform query
        $data = DB::table('patients')
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

        return $data;
    }

    /**
     * patientMetricFindById.
     *
     * @param mixed $args
     *
     * @return mixed
     */
    public function patientMetricFindById($args)
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

        // Process argument array
        $data = [
          'id' => $patientsMetrics->id,
          'patientName' => $patientsMetrics->name,
          'patientAge' => $patientsMetrics->age,
          'patientLocation' => $patientsMetrics->location,
          'metricType' => $patientsMetrics->type,
          'metricRiskLevel' => $patientsMetrics->risk_level,
          'any' => $args['any'],
        ];

        return $data;
    }

    /**
     * patientMetricDeleteById.
     *
     * @param mixed $args
     *
     * @return mixed
     */
    public function patientMetricDeleteById($args)
    {
        $data = DB::table('patients')->where('patients.id', $args['id'])->delete();
        // $patient = DB::table('patients')->where('patients.id', $args['id'])->delete();

        return $data;
    }

    /**
     * patientMetricCreate.
     */
    public function patientMetricCreate()
    {
      // Stuff here
    }

    /**
     * patientMetricUpdateById.
     *
     * @param mixed $args
     *
     * @return mixed
     */
    public function patientMetricUpdateById($args)
    {
        // Perform update by id
        $data = DB::table('patients')
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

        return $data;
    }
}
