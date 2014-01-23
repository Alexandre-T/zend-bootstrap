<?php
namespace BootstrapTest\Entity;

/**
 *
 * @author alexandre
 *        
 */
class Category
 {
     /**
      * @var string
      */
     protected $name;

     /**
      * @param string $name
      * @return Category
      */
     public function setName($name)
     {
         $this->name = $name;
         return $this;
     }

     /**
      * @return string
      */
     public function getName()
     {
         return $this->name;
     }
 }

?>