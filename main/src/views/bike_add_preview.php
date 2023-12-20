<h2>add a Bike</h2>
<a href="/addBikeType">Did you wanted to add a type of bike ?</a>

<form action="/addBike" method="post">
<select name="bike_type" id="">
<?= $listBikeTypes ?>
</select>
<label for="size">Size : </label>
<select name="size" id="size">
    <option value="1">Child</option>
    <option value="2">Teenager</option>
    <option value="3">Adult</option>
</select>
<input type="text" name="color" placeholder="The color of the bike">
<input type="submit" value="Add bike">
</form>