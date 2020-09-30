<?php
declare(strict_types=1);

namespace Arthurbes\ErpOrder\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface LogRepositoryInterface
{

    /**
     * Save Log
     * @param \Arthurbes\ErpOrder\Api\Data\LogInterface $log
     * @return \Arthurbes\ErpOrder\Api\Data\LogInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Arthurbes\ErpOrder\Api\Data\LogInterface $log
    );

    /**
     * Retrieve Log
     * @param string $id
     * @return \Arthurbes\ErpOrder\Api\Data\LogInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($id);

    /**
     * Retrieve Log matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Arthurbes\ErpOrder\Api\Data\LogSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Log
     * @param \Arthurbes\ErpOrder\Api\Data\LogInterface $log
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Arthurbes\ErpOrder\Api\Data\LogInterface $log
    );

    /**
     * Delete Log by ID
     * @param string $id
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($id);
}

