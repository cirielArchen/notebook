<html>
    <div>
        <h3>Edycja notatki o  numerze <?php echo $params['note']['id'] ?></h3>
        <div>
            <?php if(!empty($params['note'])): ?>
            <form class="note-form" action="/app/index.php/?action=edit" method="post">
                <input name="id" type="hidden" value="<?php echo $params['note']['id'] ?>" />
                <ul>
                    <li>
                        <label>Tytuł <span class="required">*</span></label>
                        <input type="text" name="title" class="field-long" value="<?php echo $params['note']['title'] ?>" />
                    </li>
                    <li>
                        <label>Treść</lable>
                        <textarea name="description" id="field5"
                        class="field-long field-textarea"><?php echo $params['note']['description'] ?></textarea>
                    </li>
                    <li>
                        <input type="submit" value="Edytuj" /> 
                    </li>
                </ul>
            </form>
            <?php else: ?>
                <div>
                    Brak danych do wyświetlenia
                    <a href="/app/"><button>Powrót do listy notatek</button></a>
                </div>
            <?php endif; ?>
        </div>
    </div>    
</html>