<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 *
 */


class Cms_Form_AddContent extends Zend_Form
{
    
    public  function init()
    {
//        print_r($menuArray);
        
      
    
          $this->setName('addContent')
            ->setMethod('post')
           ->setAttrib('id', 'formAddContent');
        
        
//        //add an Menu element
          $menuList = array('1' => 'About',
                         '2' => 'Admission',
                         '3' => 'Notice',
                         '4' => 'Department',
                         '5' => 'Gallery'
              );
          
        $menu = new Zend_Form_Element_Select('menu_id');
        
        $menu->setLabel('Menu:')
            ->setMultiOptions($menuList);
        
        $this->addElement($menu);

        
        //add an Title element
        $title = new Zend_Form_Element_Text('title');
        
        $title->setFilters(array('StringTrim'))
                ->setValidators(array(array('Alnum', false,  array('allowWhiteSpace' => true), array('message' => array(Zend_Validate_Alnum::NOT_ALNUM=>'Title can only contain alphanumerics, with no spaces'))
                                                )))
                ->setRequired(true)
                ->setLabel('Title');
   
        $this->addElement($title);

        
         // Add an Content element
        $content = new Zend_Form_Element_Textarea('content');
        
        $content->setLabel('Content')
                ->setRequired(true)
                ->setFilters(array('StringTrim'));
        
        $this->addElement($content);
        
        
        
        //add an status element
        $status = new Zend_Form_Element_Checkbox('status');
        $status->setLabel('Status')
                ->setCheckedValue('active')
                ->setUncheckedValue('inactive');
        
        $this->addElement($status);
        
     
        
        //add an Submit element
        $submit = new Zend_Form_Element_Submit('submit');
        
        $submit->setLabel('Add Content')
                ->setIgnore(true)
                ->setRequired(true);
        
        $this->addElement($submit);
   
    }
}

?>
