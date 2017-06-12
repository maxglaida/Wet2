<?php if ($_SESSION['priviliges'] == 2) { ?>
    <!--Formular zum Gutschein erstellen-->
    <div class="col-md-4">
        <h2>Anlegen</h2>
        <form class="form-horizontal" method="post" action="index.php?site=Gutscheine verwalten">
            <div class="form-group">
                <label for="Wert" class="col-sm-6 control-label">Wert</label>
                <div class="col-sm-6">
                    <?php
                    if (isset($_POST['Erstellen']) && $_POST['Erstellen'] == 'Erstellen' && isset($_POST['Wert']) && !isset($_POST['Gueltigkeit'])) {
                        echo '<input type="number" class="form-control" id="Wert" name="Wert" min="0" placeholder="0" step="0.01" value="' . $_POST['Wert'] . '">';
                    } else {
                        echo '<input type="number" class="form-control" id="Wert" name="Wert" min="0" placeholder="0" step="0.01">';
                    }
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="Gueltigkeit" class="col-sm-6 control-label">Gültig Tage</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="Gueltigkeit" id="Gueltigkeit" min="1">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" name="Erstellen" value="Erstellen">
                </div>
            </div>
        </form>
    </div>
    <?php
} else
    header("location: index.php");