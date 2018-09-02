<?php

namespace Prashant\TaskExtend\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class TaskExtend extends AbstractDb
{
     public function _construct() {
         $this->_init('task','id');
    }     
}