<!--<h2><?= $loginTitle ?></h2>-->

<form method="post" action="<?= \ItForFree\SimpleMVC\Url::link('login/login')?>">
    
    <?php 
    if (!empty($_GET['auth'])) {
        echo "Неверное имя пользователя или пароль";
    }
    ?>
<!--    <div class="form-group">
        <label for="userName" >Введите имя пользователя</label>
        <input type="text"  class="form-control" id="userName"  name="userName" >
    </div>
    <div class="form-group">
        <label for="password" >Введите пароль</label>
        <input type="password" name="password"  class="form-control" id="userName"  name="userName" >
    </div>
    <input type="submit" class="btn btn-primary" name="login" value="Войти">-->
    
    <ul>

            <li>
                <label for="userName">Username</label>
                <input type="text" name="userName" id="userName" placeholder="Your admin username" required autofocus maxlength="20" />
            </li>

            <li>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Your admin password" required maxlength="20" />
            </li>

        </ul>

        <div class="buttons">
            <input type="submit" name="login" value="Войти" />
        </div>

    </form>
   
</form>

