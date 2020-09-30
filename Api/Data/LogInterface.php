<?php
declare(strict_types=1);

namespace Arthurbes\ErpOrder\Api\Data;

interface LogInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const MESSAGE = 'message';
    const ID = 'id';
    const ERROR = 'error';
    const CREATED_AT = 'created_at';

    /**
     * Get id
     * @return string|null
     */
    public function getId();

    /**
     * Set id
     * @param string $id
     * @return \Arthurbes\ErpOrder\Api\Data\LogInterface
     */
    public function setId($id);

    /**
     * Get error
     * @return string|null
     */
    public function getError();

    /**
     * Set error
     * @param string $error
     * @return \Arthurbes\ErpOrder\Api\Data\LogInterface
     */
    public function setError($error);

    /**
     * Get message
     * @return string|null
     */
    public function getMessage();

    /**
     * Set message
     * @param string $message
     * @return \Arthurbes\ErpOrder\Api\Data\LogInterface
     */
    public function setMessage($message);

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $createdAt
     * @return \Arthurbes\ErpOrder\Api\Data\LogInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Arthurbes\ErpOrder\Api\Data\LogExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Arthurbes\ErpOrder\Api\Data\LogExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Arthurbes\ErpOrder\Api\Data\LogExtensionInterface $extensionAttributes
    );
}

