<?php 
use ItForFree\SimpleMVC\Config;

$User = Config::getObject('core.user.class');
?>
<?php // include('includes/admin-notes-nav.php'); ?>

<h2>Все авторы</h2>

<?php if (!empty($authors)): ?>
<table class="table">
    <thead>
    <tr>
      <th scope="col">Дата регистрации</th>
      <th scope="col">Автор</th>

    </tr>
     </thead>
    <tbody>
    <?php foreach($authors as $author): ?>
    <tr>
        <td> <?= $author->timestamp ?> </td>
        <td> <?= "<a href=" . \ItForFree\SimpleMVC\Url::link('admin/authors/index&id=' 
		. $author->id . ">{$author->login}</a>" ) ?> </td>
        
    </tr>
    <?php endforeach; ?>

    </tbody>
</table>

<?php else:?>
    <p> Список заметок пуст</p>
<?php endif; ?>

