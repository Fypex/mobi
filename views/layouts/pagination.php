<ul class="uk-pagination" uk-margin>
    <?
    for ($i = 1; $i <= $pages; $i++) {
        echo '<li><a href="?ord='.$_GET['ord'].'&sort='.$_GET['sort'].'&page='.$i.'"><span>'.$i.'</span></a></li>';
    }
    ?>

</ul>