<?php

namespace Prashant\TaskExtend\Controller\Adminhtml\Index;

use Magento\Framework\Registry;

class Edit extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    protected $resultPageFactory;
	
	/**
     * @var \Prashant\TaskExtend\Model\TaskExtendFactory
     */
    protected $taskExtendFactory;
	
	/**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * @param \Magento\Backend\App\Action\Context $context
	 * @param \Prashant\TaskExtend\Model\TaskExtendFactory $taskExtendFactory,
     * @param \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
	 * @param Registry $coreRegistry
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
		\Prashant\TaskExtend\Model\TaskExtendFactory $taskExtendFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
		Registry $coreRegistry
    ) {
        $this->resultPageFactory = $resultPageFactory;
		$this->taskExtendFactory = $taskExtendFactory;
		$this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * Edit Task
     *
     * @return \Magento\Framework\Controller\ResultInterface
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('id');
        $model = $this->taskExtendFactory->create();

        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This Task no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $this->_coreRegistry->register('task', $model);

        // 5. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->addBreadcrumb(
            $id ? __('Edit Task') : __('New Task'),
            $id ? __('Edit Task') : __('New Task')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Tasks'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? $model->getTitle() : __('New Task'));
        return $resultPage;
    }
}
