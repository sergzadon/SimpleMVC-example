<?php

namespace application\assets;
use ItForFree\SimpleAsset\SimpleAsset;
use application\assets\BootstrapAsset;

/* 
 * Класс ассетов для CSS стилей. Пользовательский
 * 
 */

class FrontCSSAsset extends SimpleAsset {
    
    public $basePath = '/';
    
    public $css = [
        'CSS/newstyle.css'
    ];     
    
}


