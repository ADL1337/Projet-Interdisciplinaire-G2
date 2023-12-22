<form action="" method="get">
    <label for="date_from">Date of the start of the reservation : </label>
    <input type="date" name="date_from" id="date_from" min="<?= $today ?>" value="<?= $today ?>">
    <label for="date_end">Date of the end of the reservation</label>
    <input type="date" name="date_end" min="<?= $today ?>"  id="date_end" value="<?= $today ?>">
    <input type="submit" value="Changer la date de réservation">
</form>
<?php if(!is_null($bike)){ ?>
    <form action="" method="post">
        <select name="bike" id="bike">
            <?= $bike ?>
        </select>
        <input type="submit" value="Select bike">
    </form>
    <?php
} ?>