<?php
 
namespace Prashant\TaskExtend\Controller\Adminhtml\Index;
 
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
 
class Index extends \Magento\Backend\App\Action
{   
    const ADMIN_RESOURCE = 'Prashant_TaskExtend::index';
 
        /**
         * @var \Magento\Framework\View\Result\PageFactory
         */
        protected $resultPageFactory;
 
        /**
         * @param \Magento\Framework\App\Action\Context $context
         * @param \Magento\Framework\View\Result\PageFactory resultPageFactory
         */
        public function __construct(
            \Magento\Framework\App\Action\Context $context,
            \Magento\Framework\View\Result\PageFactory $resultPageFactory
        )
        {
            parent::__construct($context);
            $this->resultPageFactory = $resultPageFactory;
        }
		
		/**
		 * Default customer account page
		 *
		 * @return void
		 */
		public function execute()
		{
			$resultPage = $this->resultPageFactory->create();
			$resultPage->setActiveMenu('Prashant_TaskExtend::taskextend');
			$resultPage->addBreadcrumb(__('Task'), __('Manage'));
			$resultPage->addBreadcrumb(__('Task'), __('Manage'));
			$resultPage->getConfig()->getTitle()->prepend(__('Task Manage'));
	 
			return $resultPage;
		}
}?>