<script
  src="https://code.jquery.com/jquery-3.6.3.js"
  integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
  crossorigin="anonymous"></script>
<form>
    <input type="url" name="image_url" placeholder="URL imagen" style="width: 100%;" />
    <?php for($i = 0; $i < 5; $i++) { ?>
        Zona <?=($i+1);?><br/>
        <input type="number" name="zone[<?=$i;?>][width]" placeholder="Ancho en porcentaje" min="0" max="100" />
        <input type="number" name="zone[<?=$i;?>][height]" placeholder="Alto en porcentaje" min="0" max="100" />
        <input type="number" name="zone[<?=$i;?>][x]" placeholder="X en porcentaje" min="0" max="100" />
        <input type="number" name="zone[<?=$i;?>][y]" placeholder="Y en porcentaje" min="0" max="100" />
        <hr/>
    <?php } ?>
    <button>Crear</button>
<form>
<div><img src="" /></div>
<script>
jQuery("button").click(function(e) {
    e.preventDefault();
    var url = "/urko-bn/image.php?image_url="+jQuery("input[name=image_url]").val();
    jQuery("input[type=number]").each(function() {
        console.log(jQuery(this).attr("name")+"="+jQuery(this).val());
        if(jQuery(this).val() != '') url = url + "&"+jQuery(this).attr("name")+"="+jQuery(this).val();
    });
    jQuery("img").attr("src", url);
});
</script>