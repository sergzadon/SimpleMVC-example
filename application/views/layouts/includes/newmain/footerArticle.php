<?php
use ItForFree\SimpleMVC\Config;
use ItForFree\SimpleMVC\Url;


$User = Config::getObject('core.user.class');

<!--
<div class="footer">
    <div class="container">
       <span title="orioginal text:  2017. All rights reserved. I will find you." style="color: #cbc4c4"> 
            <span class="copyleft">&copy;</span>
           SimpleMVC -- учебный проект 
           <a href="http://fkn.ktu10.com/?q=node/7716" class="footer-link" target="__blank">курса backend программирования</a>
           от ITForFree.   
       </span>
    </div>
   
</div>
-->

            <div class="footer">
                Простая PHP CMS &copy; 2017. Все права принадлежат всем. ;) <a href="<?= Url::link("admin/articles/index") ?>"> Site ITForFree</a>
            </div>





<!--               <div id="footer">
                Простая PHP CMS &copy; 2017. Все права принадлежат всем. ;) <a href="<?= Url::link("admin/articles/index") ?>"> Site Admin </a>
            </div>-->

 