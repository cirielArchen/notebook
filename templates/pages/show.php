<html>
    <div class="show">
        <h3>Notatka o numerze: <?php echo $params['note']['id'] ?> </h3>
        <ul>
            <li>Tytuł: <?php echo $params['note']['title'] ?></li>
            </br>
            <li>Opis: <?php echo $params['note']['description'] ?></li>
            </br>
            <li>Utworzono: <?php echo $params['note']['created'] ?></li>
        </ul>
        <div style="float: left; margin: 0px 3px 0px 3px;">
            <a href="/app/index.php">
            <button> Powrót do listy notatek </button>
            </a>
        </div>
        <div style="float: left; margin: 0px 3px 0px 3px;">
            <a href="/app/?action=edit&id=<?php echo $params['note']['id'] ?>">
            <button> Edytuj </button>
            </a>
        </div>
        <div style="float: left; margin: 0px 3px 0px 3px;">
        <a  href="/app/?action=delete&id=<?php echo $params['note']['id'] ?>"
            onclick="return confirm('Czy na pewno chcesz usunąć notatkę?')">
            <button> Usuń </button>
            </a>
        </div>
        </br>
        </br>
    </div> 
</html>