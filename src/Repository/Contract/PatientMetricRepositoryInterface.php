<?php declare(strict_types=1);

namespace RouterApp\Repository\Contract;

interface PatientMetricRepositoryInterface
{
    /**
     * patientMetricIndex
     *
     * @return mixed
     */
    public function patientMetricIndex($args);

    /**
     * patientMetricFindById
     *
     * @return mixed
     */
    public function patientMetricFindById($args);

    /**
     * patientMetricDeleteById
     *
     * @return mixed
     */
    public function patientMetricDeleteById($args);

    /**
     * patientMetricCreate
     *
     * @return mixed
     */
    public function patientMetricCreate($args);

    /**
     * patientMetricUpdateById
     *
     * @return mixed
     */
    public function patientMetricUpdateById($args);
}
