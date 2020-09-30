<?php
declare(strict_types=1);

namespace Arthurbes\ErpOrder\Api\Data;

interface LogSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Log list.
     * @return \Arthurbes\ErpOrder\Api\Data\LogInterface[]
     */
    public function getItems();

    /**
     * Set id list.
     * @param \Arthurbes\ErpOrder\Api\Data\LogInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

