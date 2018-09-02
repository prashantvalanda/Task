<?php
namespace Prashant\TaskExtend\Model\Source;
 
class Status implements \Magento\Framework\Data\OptionSourceInterface
{
 
    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options[] = ['label' => '', 'value' => ''];
        $availableOptions = $this->getOptionArray();
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
 
    public static function getOptionArray()
    {
        return [0 => __('To Do'), 1 => __('In Progress'), 2 => __('Done')];
    }
}