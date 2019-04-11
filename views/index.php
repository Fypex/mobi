<?php Flight::render('layouts/header'); ?>
<body>
    <nav class="uk-navbar-container" uk-navbar>
        <div class="uk-navbar-left">

        </div>
    </nav>
    <h2 class="uk-heading-divider uk-margin-small-top"><div class="uk-container"><?= $_ENV['ST_NAME'] ?></div></h2>
    <div class="wrapper">
        <div class="uk-container uk-margin-medium-top">
            <p uk-margin>
                <a onclick="grecaptcha.reset();" class="uk-button uk-button-default uk-margin-remove" href="#addRecord" uk-toggle>Добавить запись</a>
                <a id="for_name" href="?ord=name&sort=&page=<?= $_GET['page']?>" class="uk-button uk-button-default">По имени</a>
                <a id="for_email" href="?ord=email&sort=&page=<?= $_GET['page']?>" class="uk-button uk-button-default">По почте</a>
                <a id="for_date" href="?ord=date&sort=&page=<?= $_GET['page']?>" class="uk-button uk-button-default">По дате</a>
                <a id="for_date" href="/" class="uk-button uk-button-default">Сбросить</a>
            </p>

            <? Flight::render('layouts/pagination'); ?>
            <table class="uk-table uk-table-small uk-table-divider">
                <thead>
                <tr>
                    <th>Имя пользователя</th>
                    <th>Почта</th>
                    <th>Текст сообщения</th>
                    <th>Вложение</th>
                </tr>
                </thead>
                <tbody id="table-body">

                <?php foreach ($records as $record): ?>
                    <tr class="records">
                        <td><?= $record['name'] ?></td>
                        <td><?= $record['email'] ?></td>
                        <td><?= $record['text'] ?></td>
                        <td style="padding: 2px;">
                            <?php if ($record['path'] != ''): ?>
                                <a href="<?= $record['path'] ?>/<?= $record['expansion'] ?>" class="uk-button uk-button-primary table-button">Скачать вложение | <?= $record['expansion'] ?></a>
                            <?php else: ?>
                                <a class="uk-button uk-button-default uk-disabled table-button" >Вложение отсутствует</a>
                            <?php endif ?>
                          </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
            <? Flight::render('layouts/pagination'); ?>

        </div>





    </div>
    <? Flight::render('modals/AddRecordModal'); ?>
</body>
<?php Flight::render('layouts/footer'); ?>