<?php
/**
 * Copyright (C) 2019 Xibo Signage Ltd
 *
 * Xibo - Digital Signage - http://www.xibo.org.uk
 *
 * This file is part of Xibo.
 *
 * Xibo is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 *
 * Xibo is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with Xibo.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Xibo\Factory;

use Stash\Interfaces\PoolInterface;
use Xibo\Entity\ReportSchedule;
use Xibo\Entity\User;
use Xibo\Exception\NotFoundException;
use Xibo\Service\ConfigServiceInterface;
use Xibo\Service\DateServiceInterface;
use Xibo\Service\LogServiceInterface;
use Xibo\Service\SanitizerServiceInterface;
use Xibo\Storage\StorageServiceInterface;

/**
 * Class ReportScheduleFactory
 * @package Xibo\Factory
 */
class ReportScheduleFactory extends BaseFactory
{
    /**
     * @var ConfigServiceInterface
     */
    private $config;

    /** @var PoolInterface  */
    private $pool;

    /** @var  DateServiceInterface */
    private $dateService;

    /**
     * Construct a factory
     * @param StorageServiceInterface $store
     * @param LogServiceInterface $log
     * @param SanitizerServiceInterface $sanitizerService
     * @param User $user
     * @param UserFactory $userFactory
     * @param ConfigServiceInterface $config
     * @param PoolInterface $pool
     * @param DateServiceInterface $date
     */
    public function __construct($store, $log, $sanitizerService, $user, $userFactory, $config, $pool, $date)
    {
        $this->setCommonDependencies($store, $log, $sanitizerService);
        $this->setAclDependencies($user, $userFactory);

        $this->config = $config;
        $this->pool = $pool;
        $this->dateService = $date;
    }

    /**
     * Create Empty
     * @return ReportSchedule
     */
    public function createEmpty()
    {
        return new ReportSchedule(
            $this->getStore(),
            $this->getLog()
        );
    }

    /**
     * Loads only the reportSchedule information
     * @param int $reportScheduleId
     * @return ReportSchedule
     * @throws NotFoundException
     */
    public function getById($reportScheduleId, $disableUserCheck = 0)
    {

        if ($reportScheduleId == 0)
            throw new NotFoundException();

        $reportSchedules = $this->query(null, ['reportScheduleId' => $reportScheduleId, 'disableUserCheck' => $disableUserCheck]);

        if (count($reportSchedules) <= 0) {
            throw new NotFoundException(\__('Report Schedule not found'));
        }

        // Set our reportSchedule
        return $reportSchedules[0];
    }

    /**
     * @param null $sortOrder
     * @param array $filterBy
     * @return ReportSchedule[]
     */
    public function query($sortOrder = null, $filterBy = [])
    {
        if ($sortOrder == null) {
            $sortOrder = ['name'];
        }
        
        $sanitizedFilter = $this->getSanitizer($filterBy);
        $entries = [];
        $params = [];
        $select = '
            SELECT 
                reportschedule.reportScheduleId, 
                reportschedule.name, 
                reportschedule.lastSavedReportId, 
                reportschedule.reportName, 
                reportschedule.filterCriteria, 
                reportschedule.schedule, 
                reportschedule.lastRunDt, 
                reportschedule.previousRunDt, 
                reportschedule.createdDt, 
                reportschedule.userId,
                reportschedule.isActive,
                reportschedule.message,
               `user`.UserName AS owner 
           ';

        $body = ' FROM `reportschedule` ';

        $body .= "   LEFT OUTER JOIN `user` ON `user`.userId = `reportschedule`.userId ";

        $body .= " WHERE 1 = 1 ";

        // View Permissions
        if ($this->getUser()->userTypeId != 1) {
            $this->viewPermissionSql('Xibo\Entity\ReportSchedule', $body, $params, '`reportschedule`.reportScheduleId', '`reportschedule`.userId', $filterBy);
        }

        // Like
        if ($sanitizedFilter->getString('name') != '') {
            $terms = explode(',', $sanitizedFilter->getString('name'));
            $this->nameFilter('reportschedule', 'name', $terms, $body, $params);
        }

        if ($sanitizedFilter->getInt('reportScheduleId', ['default' => 0]) != 0) {
            $params['reportScheduleId'] = $sanitizedFilter->getInt('reportScheduleId', ['default' => 0]);
            $body .= " AND reportschedule.reportScheduleId = :reportScheduleId ";
        }

        // Owner filter
        if ($sanitizedFilter->getInt('userId', ['default' => 0]) != 0) {
            $body .= " AND reportschedule.userid = :userId ";
            $params['userId'] = $sanitizedFilter->getInt('userId', ['default' => 0]);
        }

        if ( $sanitizedFilter->getCheckbox('onlyMySchedules') == 1) {
            $body .= ' AND reportschedule.userid = :currentUserId ';
            $params['currentUserId'] = $this->getUser()->userId;
        }

        // Report Name
        if ($sanitizedFilter->getString('reportName') != '') {
            $body .= " AND reportschedule.reportName = :reportName ";
            $params['reportName'] = $sanitizedFilter->getString('reportName');
        }

        // isActive
        if ($sanitizedFilter->getInt('isActive') !== null) {
            $body .= " AND reportschedule.isActive = :isActive ";
            $params['isActive'] = $sanitizedFilter->getInt('isActive');
        }

        // Sorting?
        $order = '';
        if (is_array($sortOrder))
            $order .= 'ORDER BY ' . implode(',', $sortOrder);

        $limit = '';
        // Paging
        if ($filterBy !== null && $sanitizedFilter->getInt('start') !== null && $sanitizedFilter->getInt('length') !== null) {
            $limit = ' LIMIT ' . intval($sanitizedFilter->getInt('start'), 0) . ', ' . $sanitizedFilter->getInt('length', ['default' => 10]);
        }

        $sql = $select . $body . $order . $limit;

        foreach ($this->getStore()->select($sql, $params) as $row) {
            $entries[] = $this->createEmpty()->hydrate($row, [
                'intProperties' => [
                    'reportScheduleId', 'lastRunDt', 'previousRunDt', 'lastSavedReportId', 'isActive'
                ]
            ]);
        }

        // Paging
        if ($limit != '' && count($entries) > 0) {
            $results = $this->getStore()->select('SELECT COUNT(*) AS total ' . $body, $params);
            $this->_countLast = intval($results[0]['total']);
        }

        return $entries;
    }
}