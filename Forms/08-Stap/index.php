<?php
include '..\_src\testpage.php';
include '..\_src\request.php';
include '..\_src\data.php';
include '..\_src\menu.php';
require_once 'FieldFactory.php';
require_once 'FieldCollection.php';

openTestPage('FORMTEST 8','','Oop versie met collection en factory');
showMenu(getMenuItems());
$request = getRequest();

$field_collection = new FieldCollection(
       field_info : getExtendedFieldsByPage($request['page']), 
       field_factory  : new FieldFactory() 
);

if ($request['posted'])
{
    require_once 'Validator.php';
    $validator = new Validator($field_collection);
    if ($validator->validate())
    {
        foreach ($field_collection->getFields() as $field)
        {
            dump($field->getName(), $field->getValue());
        }
    }    
    else
    {
        require_once 'Form.php';
        $form = new Form(
            page   : $request['page'],   
            action : 'index.php', 
            method : 'POST', 
            submit_caption : 'Send',
            field_collection :  $field_collection   
        );
        $form->show();
    }		
}		
else
{
        require_once 'Form.php';
        $form = new Form(
            page   : $request['page'],   
            action : 'index.php', 
            method : 'POST', 
            submit_caption : 'Send',
            field_collection :  $field_collection   
        );
        $form->show();
}   

closeTestPage('');




