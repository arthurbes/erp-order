<?php

declare(strict_types=1);

namespace Arthurbes\ErpOrder\Model\Data;

use Arthurbes\ErpOrder\Api\Data\LogInterface;
use Arthurbes\ErpOrder\Api\Data\LogExtensionInterface;

class Log extends \Magento\Framework\Api\AbstractExtensibleObject implements LogInterface
{

    /**
     * Get id
     * @return string|null
     */
    public function getId()
    {
        return $this->_get(self::ID);
    }

    /**
     * Set id
     * @param string $id
   
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * Get error
     * @return string|null
     */
    public function getError()
    {
        return $this->_get(self::ERROR);
    }

    /**
     * Set error
     * @param string $error
     * @return LogInterface
     */
    public function setError($error)
    {
        return $this->setData(self::ERROR, $error);
    }

    /**
     * Get message
     * @return string|null
     */
    public function getMessage()
    {
        return $this->_get(self::MESSAGE);
    }

    /**
     * Set message
     * @param string $message
     * @return LogInterface
     */
    public function setMessage($message)
    {
        return $this->setData(self::MESSAGE, $message);
    }

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt()
    {
        return $this->_get(self::CREATED_AT);
    }

    /**
     * Set created_at
     * @param string $createdAt
     * @return LogInterface
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return LogExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param LogExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(LogExtensionInterface $extensionAttributes) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }
}

