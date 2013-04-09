<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 *
 */


class Cms_Form_UpdateContent extends Zend_Form
{
    
    
    
    
    public function generateForm($contentx)
    {
//        echo "<pre>";
//        print_r($contentx);die;
//        echo "</pre>";
        
        
          $this->setName('addContent')
            ->setMethod('post')
           ->setAttrib('id', 'formAddContent');
        
        
        //add an Menu element
          $menuList = array('1' => 'About',
                         '2' => 'Admission',
                         '3' => 'Notice',
                         '4' => 'Department',
                         '5' => 'Gallery'
              );
          
        $menu = new Zend_Form_Element_Select('menu_id');
        
        $menu->setLabel('Menu:')
            ->setMultiOptions($menuList)
            ->setValue($contentx['menu_id']);        
        

        
        //add an Title element
        $title = new Zend_Form_Element_Text('title');
        
        $title->setFilters(array('StringTrim'))
                ->setValidators(array(array('Alnum', false,  array('allowWhiteSpace' => true), array('message' => array(Zend_Validate_Alnum::NOT_ALNUM=>'Title can only contain alphanumerics, with no spaces'))
                                                )))
                ->setRequired(true)
                ->setLabel('Title')
                ->setValue($contentx['title']);
                
        

        
         // Add an Content element
        $content = new Zend_Form_Element_Textarea('content');
        
        $content->setLabel('Content')
                ->setRequired(true)
                ->setFilters(array('StringTrim'))
                ->setValue($contentx['content']);
        
        
        
        
        
        //add an status element
        $status = new Zend_Form_Element_Checkbox('status');
        $status->setLabel('Status')
                ->setCheckedValue('active')
                ->setUncheckedValue('inactive')
                ->setValue($contentx['status']);
        
        
        
     
        
        //add an Submit element
        $submit = new Zend_Form_Element_Submit('submit');
        
        $submit->setLabel('Update Content')
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
