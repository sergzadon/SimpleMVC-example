<?php
use ItForFree\SimpleMVC\Config;
use ItForFree\SimpleMVC\Url;


$User = Config::getObject('core.user.class');


//ppre($User->explainAccess("admin/adminusers/index"));
$n = 0;
?>
<?php if($n == 0) { ?>
            <div id="footer">
                Простая PHP CMS &copy; 2017. Все права принадлежат всем. ;) <a href="<?= Url::link("login/login") ?>">Site Admin</a>
            </div>
        </div>
    </body>
</html>
 <?php } 
else { ?>
        <div class="footer">
                Простая PHP CMS &copy; 2017. Все права принадлежат всем. ;) <a href="<?= Url::link("admin/adminusers/index") ?>"> Site Admin </a>
        </div>

        </div>
    </body>
</html>
 <?php } ?>

<!--<div class="footer">
    Простая PHP CMS &copy; 2017. Все права принадлежат всем. ;) <a href="<?= Url::link("admin/adminusers/index") ?>"> Site Admin </a>-->

<!--        <div class="footer">
                Простая PHP CMS &copy; 2017. Все права принадлежат всем. ;) <a href="<?= Url::link("login/login") ?>"> Site Admin </a>
            </div>

        </div>
    </body>
</html>
 -->

 

