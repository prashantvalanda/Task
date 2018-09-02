<?php

namespace Prashant\TaskExtend\Block\Adminhtml\TaskExtend\Edit;

use Magento\Backend\Block\Widget\Context;
use Prashant\TaskExtend\Model\TaskExtendFactory;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class GenericButton
 */
class GenericButton
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var TaskExtendFactory
     */
    protected $taskExtendFactory;

    /**
     * @param Context $context
     * @param TaskExtendFactory $taskExtendFactory
     */
    public function __construct(
        Context $context,
        TaskExtendFactory $taskExtendFactory
    ) {
        $this->context = $context;
        $this->taskExtendFactory = $taskExtendFactory;
    }

    /**
     * Return Task ID
     *
     * @return int|null
     */
    public function getId()
    {
        try {
            $model = $this->taskExtendFactory->create();
			$id = $this->context->getRequest()->getParam('id');
			$model = $model->load($id);
			if($model){
				return $model->getId();
			}
        } catch (NoSuchEntityException $e) {
        }
        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
