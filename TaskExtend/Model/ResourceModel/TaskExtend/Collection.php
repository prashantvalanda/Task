<?php

namespace Prashant\TaskExtend\Model\ResourceModel\TaskExtend;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	/**
     * @var string
     */
    protected $_idFieldName = 'id';
	
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Prashant\TaskExtend\Model\TaskExtend', 'Prashant\TaskExtend\Model\ResourceModel\TaskExtend');
    }

}
?>