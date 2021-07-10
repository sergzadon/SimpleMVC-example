<?php 
use ItForFree\SimpleMVC\Config;

$User = Config::getObject('core.user.class');
?>


<table class="table">
    <thead>
    <tr>
      <th scope="col">Оглавление</th>
      <th scope="col">Посвящается</th>
      <th scope="col">Дата</th>
      <th scope="col"></th>
    </tr>
     </thead>
    <tbody>
    <?php foreach($articles as $article): ?>
    <tr>
        <td> <?= "<a href=" . \ItForFree\SimpleMVC\Url::link('admin/notes/index&id=' 
		. $article->id . ">{$article->title}</a>" ) ?> </td>
        <td> <?= $article->content ?> </td>
        <td> <?= $article->publicationDate ?> </td>
    </tr>
    <?php endforeach; ?>

    </tbody>
</table>


    <p> Список заметок пуст</p>
