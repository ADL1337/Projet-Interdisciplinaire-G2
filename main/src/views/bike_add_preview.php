<div class="form1 bg_admin">
    <h2>Add a Bike</h2>
    <div class="addbike-container">
        <form action="/addBike" method="post" class="addBike">
            <div class="mb-5">
                <label for="bike_type">Bike type : </label>
                <select name="bike_type" id="">
                <?= $listBikeTypes ?>
                </select>
            </div>
            <div class="mb-5">
                <label for="size">Size : </label>
                    <select name="size" id="size">
                        <option value="1">Child</option>
                        <option value="2">Teenager</option>
                        <option value="3">Adult</option>
                    </select>
            </div>
            <div class="mb-5">
                <label for="color">Color : </label>
                <input type="text" name="color" placeholder="The color of the bike">
            </div>
            <div class="mb-51">
                <input type="submit" value="Add bike">
            </div>
        </form>
    </div>
</div>
</div>