<style> 
    
    textarea{
        height: 200%;
        width: 1110px;
        color: #003300;
    }
   
</style>

<?php include('includes/admin-articles-nav.php'); ?>
<h2><?= $addArticleTitle ?></h2>

<form id="addNote" method="post" action="<?= \ItForFree\SimpleMVC\Url::link("admin/articles/add")?>"> 
    <div class="form-group">
        <label for="title">Название новой заметки</label>
        <input type="text" class="form-control" name="title" id="title" placeholder="имя заметки">
    </div>
    <div class="form-group">
        <label for="content">Описание</label><br>
        <textarea type="description" name="summary" placeholred="описание заметки"  value=></textarea>
    </div>
    <div class="form-group">
        <label for="content">Содержание</label><br>
        <textarea type="description" name="content" placeholred="описание заметки"  value=></textarea>
    </div>
    <div class="form-group">
    <label for="categoryId">Article Category</label>
                <select name="categoryId">
                  <option value="0"<?php echo !$articles->categoryId ? " selected" : ""?>>(none)</option>
                <?php foreach ( $categories as $category ) { ?>
                  <option value="<?php echo $category->id?>"<?php echo ( $category->id == $articles->categoryId ) ? " selected" : ""?>><?php echo htmlspecialchars( $category->name )?></option>
                <?php } ?>
                </select>
    </div>
    <div class="form-group">
    <label for="subcategoryId">Article subcategory</label>
                <select name="subcategoryId">
                  <option value="0"<?php echo !$articles->subcategoryId ? " selected" : ""?>>(none)</option>
                <?php foreach ($subcategories  as $subcategory ) { ?>
                  <option value="<?php echo $subcategory->id?>"<?php echo ( $subcategory->id == $articles->subcategoryId ) ? " selected" : ""?>><?php echo htmlspecialchars( $subcategory->titleSubcat )?></option>
                <?php } ?>
                </select>
    </div>
    <input type="submit" class="btn btn-primary" name="saveNewNote" value="Сохранить">
    <input type="submit" class="btn" name="cancel" value="Назад">
</form>    
