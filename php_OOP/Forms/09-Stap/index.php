<?php
include __DIR__ . '/vendor/autoload.php';

include '..\_src\testpage.php';
include '..\_src\request.php';
include '..\_src\data.php';
include '..\_src\menu.php';

openTestPage('FORMTEST 7','','Oop versie met namespace en autoloader');
showMenu(getMenuItems());
$request = getRequest();

$field_collection = new \GwForms\Collections\FieldCollection(
       field_info : getExtendedFieldsByPage($request['page']), 
       field_factory  : new \GwForms\Factories\FieldFactory() 
);

if ($request['posted'])
{
    $validator = new \GwForms\Validators\Validator($field_collection);
    if ($validator->validate())
    {
        foreach ($field_collection->getFields() as $field)
        {
            dump($field->getName(), $field->getValue());
        }
    }    
    else
    {
        $form = new \GwForms\Forms\Form(
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
    $form = new \GwForms\Forms\Form(
        page   : $request['page'],   
        action : 'index.php', 
        method : 'POST', 
        submit_caption : 'Send',
        field_collection :  $field_collection   
    );
    $form->show();
}   

closeTestPage('');




