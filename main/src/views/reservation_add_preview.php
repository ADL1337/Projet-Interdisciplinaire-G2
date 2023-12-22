<div class="user-reservation-wrapped">
    <h2>Reserve your bike now</h2>
    <form action="" method="get">
        <div class="tab">
            <div class="user-label">
                <label for="date_from">Date of the start of the reservation : </label>
                <input type="date" name="date_from" id="date_from" min="<?= $today ?>" value="<?= $today ?>">
            </div>
            <div class="user-label">
                <label for="date_end">Date of the end of the reservation</label>
                <input type="date" name="date_end" id="date_end" value="<?= $today ?>">
            </div>
            <div class="user-label1">
                <div class="user-submit">
                    <input type="submit" value="Validate reservation date">
                </div>
            </div>
        </div>
    </form>
    
</div>
<?php if(!is_null($bike)){ ?>
    <form action="" method="post">
    <div class="user-reservation-wrapped">
        <div class="tab1">
            <div class="user-label">
                <select name="bike" id="bike">
                    <?= $bike ?>
                </select>
            </div>
            <div class="user-label1">
                <input type="submit" value="Add bike">
            </div>
        </div>
    </div>
    </form>
    <?php
} ?>
<footer>
    <div class="return">
        <a href ="/login">Return to Dashboard</a>
    </div>
</footer>
<div class="bg_user"></div>