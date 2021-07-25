<style> 
    
    textarea{
        height: 200%;
        width: 1110px;
        color: #003300;
    }
   
</style>

<?php include('includes/admin-articles-nav.php'); ?>

<h2><?= $addArticleTitle ?></h2>

<?php if(isset($errorMessage)) { ?>
     <h4><?= $errorMessage?></h4>
   
<?php } ?>

<form id="addNote" method="post" action="<?= \ItForFree\SimpleMVC\Url::link("admin/articles/add")?>"> 
    <div class="form-group">
        <label for="title">Название новой статьи</label>
        <input type="text" name="title" class="form-control" placeholder="имя заметки" value="<?php echo htmlspecialchars( $articles->title )?>" />
        <!--<input type="text" class="form-control" name="title" id="title" placeholder="имя заметки">-->
    </div>
    <div class="form-group">
        <label for="summary">Описание</label><br>
        <textarea type="description" name="summary" placeholder="описание заметки" value=><?php echo htmlspecialchars( $articles->summary )?></textarea>
        <!--<textarea type="description" name="summary" placeholred="описание заметки"  value=></textarea>-->
    </div>
    <div class="form-group">
        <label for="content">Содержание</label><br>
        <textarea type="description" name="content" placeholder="содержание" value=><?php echo htmlspecialchars( $articles->content )?></textarea>
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
    <div class="form-group">
    <label for="authors[]">Все авторы</label>
            <select name="authors[]" multiple="multiple">
             <!--<option value="0"<?php echo !$articles->subcategoryId ? " selected" : ""?>>(none)</option>-->
           <?php foreach ($users  as $user ) { ?>
             <option value="<?php echo $user->id?>"><?php echo htmlspecialchars( $user->login )?></option>
           <?php } ?>
           </select>
    </div>
    <div>
        <label for="active">Active</label>
                <INPUT NAME="ActiveArticle" TYPE="CHECKBOX" VALUE="1"
                    <?php
                        if ($articles->active == 1){
                           echo "checked";
                        }
                    ?>  >
    </div>
    <input type="submit" class="btn btn-primary" name="saveNewArticle" value="Сохранить">
    <input type="submit" class="btn" name="cancel" value="Назад">
</form>    
