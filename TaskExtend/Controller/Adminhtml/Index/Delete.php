<?php

namespace Prashant\TaskExtend\Controller\Adminhtml\Index;

class Delete extends \Magento\Backend\App\Action
{
	/**
     * @var \Magento\Backend\Model\View\Result\Redirect
     */
    protected $resultRedirectFactory;
	
	/**
     * @var \Prashant\TaskExtend\Model\TaskExtendFactory
     */
    protected $taskExtendFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Prashant\TaskExtend\Model\TaskExtendFactory $taskExtendFactory,
     * @param \Magento\Backend\Model\View\Result\Redirect $resultRedirect
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
		\Prashant\TaskExtend\Model\TaskExtendFactory $taskExtendFactory,
        \Magento\Backend\Model\View\Result\Redirect $resultRedirect
    ) {
        $this->resultRedirectFactory = $resultRedirect;
		$this->taskExtendFactory = $taskExtendFactory;
        parent::__construct($context);
    }
	
    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->taskExtendFactory->create();
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccess(__('You deleted the task.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addError(__('We can\'t find a task to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
