<?php

namespace Prashant\TaskExtend\Model;

use Magento\Framework\Model\AbstractModel;

class TaskExtend extends AbstractModel
{
        public function _construct() {
         $this->_init('Prashant\TaskExtend\Model\ResourceModel\TaskExtend');
    }     
}