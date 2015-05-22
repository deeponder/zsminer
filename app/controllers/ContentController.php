<?php
class ContentController
{
  function getXBXX($f3)
  {
     $f3->set('template','XBResult.htm');
     echo Template::instance()->render('layout.htm');
     //echo "<script>alert('hello');</script>";
  }
  function getJYXX($f3)
  {
     $f3->set('template','JYResult.htm');
     echo Template::instance()->render('layout.htm');
     //echo "<script>alert('hello');</script>";
  }
}