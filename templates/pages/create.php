<html>
    <div>
        <h3>Dodawanie notatki</h3>
        <div>
            <form class="note-form" action="/app/index.php/?action=create" method="post">
                <ul>
                    <li>
                        <label>Tytuł <span class="required">*</span></label>
                        <input type="text" name="title" class="field-long" />
                    </li>
                    <li>
                        <label>Treść</lable>
                        <textarea name="description" id="field5"
                        class="field-long field-textarea"></textarea>
                    </li>
                    <li>
                        <input type="submit" value="Utwórz" /> 
                    </li>
                </ul>
            </form>
        </div>
    </div>    
</html>