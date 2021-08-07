<!--<h2><?= $loginTitle ?></h2>-->

<form action="<?= \ItForFree\SimpleMVC\Url::link('login/login')?>"method="post" style="width: 50%;">
    <input type="hidden" name="login" value="true" />
    <?php 
    if (!empty($_GET['auth'])) {
        echo "Неверное имя пользователя или пароль";
    }
    ?>
    <?php if ( isset( $results['errorMessage'] ) ) { ?>
            <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
    <?php } ?>

    <ul>

        <li>
            <label for="username">Username</label>
            <input type="text" name="userName" id="username" placeholder="Your admin username" required autofocus maxlength="20" />
        </li>

        <li>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Your admin password" required maxlength="20" />
        </li>

    </ul>

    <div class="buttons">
        <input type="submit" name="login" value="Войти" />
    </div>
<!--    <div class="form-group">
        <label for="userName" >Введите имя пользователя</label>
        <input type="text"  class="form-control" id="userName"  name="userName" >
    </div>
    <div class="form-group">
        <label for="password" >Введите пароль</label>
        <input type="password" name="password"  class="form-control" id="userName"  name="userName" >
    </div>
    <input type="submit" class="btn btn-primary" name="login" value="Войти">-->


