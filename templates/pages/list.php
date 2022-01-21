<html>
    <div class="list">
        <section>
            <div class="message">
                <?php 
                    if(!empty($params['error'])) {
                    switch($params['error']) {
                        case 'missingNoteId':
                            echo 'Niepoprawny identyfikator notatki.';
                            break;
                        case 'noteNotFound':
                            echo 'Notatka nie została znaleziona.';
                            break;
                    }
                }
                ?>
            </div>

            <div class="message">
                <?php 
                    if(!empty($params['before'])) {
                    switch($params['before']) {
                        case 'created':
                            echo 'Notatka została utworzona.';
                            break;
                        case 'edited':
                            echo 'Notatka została zaktualizowana';
                            break;
                        case 'deleted':
                            echo 'Notatka została usunięta';
                            break;
                    }
                }
                ?>
            </div>
            <?php 
                $sort = $params['sort'];
                $by = $sort['by'] ?? 'title';
                $order = $sort['order'] ?? 'desc';

                $page = $params['page'] ?? [];
                $size = $page['size'] ?? 10;
                $currentPage = $page['number'] ?? 1;
                $pages = $page['pages'] ?? 1;

                $phrase = $params['phrase'] ?? null;
                //dodać wyszukiwanie po dacie
            ?>
            <div>
                <form class="setting form" action="/app/index.php" method="GET">
                    <div>
                        <lable>Szukaj: <input type="text" name="phrase" value=<?php echo $phrase ?> ></lable>
                    </div>
                    <div>
                        <div>Sortuj po:</div>
                        <lable><input name="sortby" type="radio" value="title" <?php echo $by === 'title' ? 'checked' : '' ?>/>Tytule</lable>
                        <lable><input name="sortby" type="radio" value="created" <?php echo $by === 'created' ? 'checked' : '' ?>/>Dacie</lable>
                    </div>
                    <div>
                        <div>Kierunek sortowania:</div>
                        <lable><input name="sortorder" type="radio" value="asc" <?php echo $order === 'asc' ? 'checked' : '' ?>/>Rosnąco</lable>
                        <lable><input name="sortorder" type="radio" value="desc" <?php echo $order === 'desc' ? 'checked' : '' ?>/>Malejąco</lable>
                    </div>
                    <div>
                        <div>Rozmiar paczki</div>
                        <lable><input name="pagesize" type="radio" value="1"<?php echo $size === '1' ? 'checked' : '' ?>/>1</lable>
                        <lable><input name="pagesize" type="radio" value="5"<?php echo $size === '5' ? 'checked' : '' ?>/>5</lable>
                        <lable><input name="pagesize" type="radio" value="10"<?php echo $size === '10' ? 'checked' : '' ?>/>10</lable>
                        <lable><input name="pagesize" type="radio" value="25"<?php echo $size === '25' ? 'checked' : '' ?>/>25</lable>
                    </div>
                    <input type="submit" value="Sortuj" /> 
                </form>
            </div>

            <div class="tbl-header">
                <table cellpadding="0" cellspacing="0" border="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Tytuł</th>
                            <th>Data utworzenia</th>
                            <th>Opcje</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="tbl-content">
                <table cellpadding="0" cellspacing="0" border="0">
                    <tbody>
                        <?php foreach ($params['notes'] ?? [] as $note): ?>
                            <tr>
                                <td><?php echo (int) $note['id'] ?></td>
                                <td><?php echo $note['title'] ?></td>
                                <td><?php echo $note['created'] ?></td>
                                <td>
                                    <a href="/app/index.php/?action=show&id=<?php echo (int) $note['id'] ?>">
                                    <button>Szczegóły</button>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <?php
                $paginationUrl = "/app/index.php?phrase=$phrase&sortby=$by&sortorder=$order&pagesize=$size&page=";
            ?>
                <ul class='pagination'>
                    <?php if($currentPage > 1): ?>
                    <li>
                        <a href=<?php echo $paginationUrl.($currentPage-1)?>>
                            <button><?php echo '<' ?></button>
                        </a>
                    </li>
                    <?php endif ?>
                    <?php for($i = 1; $i <= $pages; $i++): ?>
                        <li>
                            <a href=<?php echo $paginationUrl.$i?>>
                                <button><?php echo $i ?></button>
                            </a>
                        </li>
                    <?php endfor; ?>
                    <?php if($currentPage < $pages): ?>
                    <li>
                        <a href=<?php echo $paginationUrl.($currentPage+1)?>>
                            <button><?php echo '>' ?></button>
                        </a>
                    </li>
                    <?php endif ?>
                </ul>
        </section>
    </div>
</html>