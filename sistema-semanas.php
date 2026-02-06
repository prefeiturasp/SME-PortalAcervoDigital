<style>
    body {
        font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif;
     
    }
    button {
        background: #284472;
    padding: 10px;
    width: 100px;
    color: white;
    border-radius: 10px;
    }
    input {
    padding: 7px;
    border-radius: 4px;
    border-color: #284472;
    margin-right: 10px;
}
    .containa {
           display: flex;
    }
    .instance_x  {
        display: flex;
        margin-top: 15px;
    }
    .titulo_x,
    .titulo_x_fake
    {
    min-width: 200px;
}
.instance-of-results {
    flex: 50%;
}
</style>

<form action="?" method="GET">

  <label for="birthday">Data Inicial:</label>
  <input type="date" id="initialdate" name="initialdate">
  
    <label for="birthday">Data Final:</label>
  <input type="date" id="finaldate" name="finaldate">

<button type="submit">Ok</button>
</form>
<?php
require_once('wp-load.php');

function semanasAtras($posttype) {

$contador = 0;
$the_array = [];


$articles = get_posts(
 array(
  'numberposts' => -1,
  'post_status' => 'any',
  'post_type' => $posttype,
    'date_query' => array(
      [
            'after'=>   $_GET['initialdate'],
            'before' => $_GET['finaldate'],
             'inclusive' => true, 
       ] 
    )
 )
);


echo '<div class="instance-of-results">';
foreach ($articles as $article) { 
$contador++;
array_push($the_array,$article->post_title);
}

echo '<div class="instance_x"><div class="titulo_x_fake"><b>Título</b></div><div class="dados_x_fake">  <b>Contagem de '.$posttype.'s</b> </div></div>';


foreach (array_count_values($the_array) as $key => $value) {
    echo "<div class='instance_x'><div class='titulo_x'>".$key . '</div><div class="dados_x">  ' . $value . '<br></div></div>';
}
echo '</div>';
return $contador;
}
echo '<input type="text" id="myInput" onkeyup="busca()" placeholder="Busque por títulos" title="Pesquise por título">';
echo '<div class="containa" id="myUL">';
semanasAtras(('download'));
semanasAtras(('acesso'));
echo '</div>';
?>

<script>
function busca() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByClassName("titulo_x");
    for (i = 0; i < li.length; i++) {
        a = li[i];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].parentNode.style.display = "";
        } else {
            li[i].parentNode.style.display = "none";
        }
    }

}
</script>



