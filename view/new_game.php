<?php defined("CHECK") or die("Access denied!"); ?>
<article class="col border-line col-game-spacing">
    <article class="subtitle-row">
        <h2>Новая игра</h2>
    </article>
    <article class="container-row form">
        <form enctype="multipart/form-data" class="form-content" action="index.php?view=playing&game=newGame" method="post">
            <label for="photo">Загрузить фото <span class="optional right"> по желанию </span></label>
            <input id="photo" type="file" name="photo"><br>
            <input type="submit" name="" id="start" value="Начать игру">
        </form>
        <?php
            if(isset($_SESSION['image_error'])){
                echo $_SESSION['image_error'];
                unset($_SESSION['image_error']);
            }
        ?>
    </article>
</article>