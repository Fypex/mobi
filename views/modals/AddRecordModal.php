<div id="addRecord" uk-modal bg-close="false">
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Добавление записи</h2>
        </div>
        <div class="uk-modal-body uk-padding-remove-bottom  ">
            <form action="record/add" id="addRecordForm" method="post" enctype="multipart/form-data">

                    <div class="uk-margin">
                        <input required class="uk-input" type="text" name="name" placeholder="Имя пользователя" uk-tooltip="title: Обязательное поле; pos: top-right">
                    </div>
                    <div class="uk-margin">
                        <input required class="uk-input" type="email" name="email" placeholder="Почта" uk-tooltip="title: Обязательное поле; pos: top-right">
                    </div>
                    <div class="uk-margin">
                        <input class="uk-input" type="text" name="page" placeholder="Домашняя страница" uk-tooltip="title: Не обязательное поле; pos: top-right">
                    </div>
                    <div class="uk-margin">
                        <textarea required class="uk-textarea" rows="5" name="text" placeholder="Текст" uk-tooltip="title: Обязательное поле; pos: top-right"></textarea>
                    </div>

                    <div class="file-upload">
                        <div class="file-select">
                            <div class="file-select-button" id="fileName">Выбрать файл</div>
                            <div class="file-select-name" id="noFile">Файл не выбран...</div>
                            <input type="file" name="file" id="chooseFile" accept=".jpg, .png, .gif, .txt">
                        </div>
                    </div>
                    <br>
                    <div class="g-recaptcha" data-sitekey="6Le2qp0UAAAAAJr3rm-cRfL6qYjIamgpMo_6uVT-"></div>
                    <div class="uk-modal-footer uk-text-right uk-padding-remove-horizontal uk-margin-small-top">
                        <button class="uk-button uk-button-default uk-modal-close" type="button">Закрыть</button>
                        <input type="submit"  class="uk-button uk-button-primary" id="submit" value="Отправить">
                    </div>

            </form>

        </div>

    </div>
</div>