<?php
namespace GwForms\Collections;
use GwForms\Factories\FieldFactory;
class FieldCollection
{
    protected array $fields;
    protected FieldFactory $factory;
    
    public function __construct(array $field_info, FieldFactory $field_factory)
    {
        $this->factory = $field_factory;
        $this->createFields($field_info);
    }        
    
    public function getFields() : array
    {
        return $this->fields;
    }    
    
    protected function createFields(array $field_info) : void
    {
        $this->fields = [];
        foreach ($field_info as $name => $info)
        {
            $this->fields[] = $this->factory->createField(
                    $name,
                    $info['type'],
                    $info['label']
            );
        }    
    }    
}
