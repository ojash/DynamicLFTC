<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 *
 */


class Cms_Form_AddContent extends Zend_Form
{
    
    public function init()
    {
        
        
          $this->setName('addContent')
            ->setMethod('post')
           ->setAttrib('class', 'formAddContent');
        
        
        //add an Menu element
          $menuList = array('1' => 'About',
                         '2' => 'Admission',
                         '3' => 'Notice',
                         '4' => 'Department',
                         '5' => 'Gallery'
              );
          
        $menu = new Zend_Form_Element_Select('menu_id');
        
        $menu->setLabel('Menu:')
                ->setAttrib('style', 'width: 300px;border-collapse:collapse; border: 1px solid gray;border-radius:5px;line-height:20px;')
            ->setMultiOptions($menuList);
        
        

        
        //add an Title element
        $title = new Zend_Form_Element_Text('title');
        
        $title->setFilters(array('StringTrim'))
                ->setValidators(array(array('Alnum', false,  array('allowWhiteSpace' => true), array('message' => array(Zend_Validate_Alnum::NOT_ALNUM=>'Title can only contain alphanumerics, with no spaces'))
                                                )))
                ->setRequired(true)
                ->setAttrib('style', 'width: 300px;border-collapse:collapse; border: 1px solid gray;border-radius:5px;line-height:20px;')
                ->setLabel('Title');
        
                
        

        
         // Add an Content element
        $content = new Zend_Form_Element_Textarea('content');
        
        $content->setLabel('Content')
                ->setRequired(true)
                ->setAttrib('style', 'width: 400px;height:300px;border-collapse:collapse; border: 1px solid gray;border-radius:5px;line-height:20px;')
                ->setFilters(array('StringTrim'));
        
        
        
        
        
        //add an status element
        $status = new Zend_Form_Element_Checkbox('status');
        $status->setLabel('Status')
                ->setCheckedValue('active')
                ->setUncheckedValue('inactive');
        
        
        
     
        
        //add an Submit element
        $submit = new Zend_Form_Element_Submit('submit');
        
        $submit->setLabel('Add Content')
                ->setIgnore(true)
                ->setRequired(true);
        
     
            
        $this->addElement($menu);
        $this->addElement($title);
        $this->addElement($content);
        $this->addElement($status);
        $this->addElement($submit);
        
        
   
    }
}

?>
