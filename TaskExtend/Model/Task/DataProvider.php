<?php

namespace Prashant\TaskExtend\Model\Task;

use Prashant\TaskExtend\Model\ResourceModel\TaskExtend\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Prashant\TaskExtend\Model\ResourceModel\TaskExtend\Collection
     */
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $taskCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $taskCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $taskCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
		
        foreach ($items as $task) {
            $this->loadedData[$task->getId()] = $task->getData();
        }

        $data = $this->dataPersistor->get('task');
        if (!empty($data)) {
            $task = $this->collection->getNewEmptyItem();
            $task->setData($data);
            $this->loadedData[$task->getId()] = $task->getData();
            $this->dataPersistor->clear('task');
        }

        return $this->loadedData;
    }
}
