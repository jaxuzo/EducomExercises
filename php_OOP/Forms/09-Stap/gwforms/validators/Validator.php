<?php
namespace GwForms\Validators;
class Validator
{
    protected \GwForms\Collections\FieldCollection $field_collection;

    public function __construct(\GwForms\Collections\FieldCollection $field_collection)
    {
        $this->field_collection = $field_collection;
    }        
    
    public function validate() : bool
    {
        $result = true;
        foreach ($this->field_collection->getFields() as $field)
        {
            if ($field->validate()===false)
            {
                $result = false;
            }   
        }
        return $result;
    }    
}
