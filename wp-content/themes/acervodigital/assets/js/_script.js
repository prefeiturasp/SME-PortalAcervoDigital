//search hide and show
jQuery(document).ready(function(){
  jQuery("#hide").click(function(){
	  jQuery("#simpleform").show();
	  jQuery("#advancedform").hide();
  });
  jQuery("#show").click(function(){
	  jQuery("#simpleform").hide();
      jQuery("#advancedform").show();
      jQuery('.campo-busca').val('');
  });

  jQuery('.search-submit').click(function() {    
    var busca = jQuery('.campo-busca').val();
    var buscaAv = jQuery('.campo-busca-avanc').val();
    var categoria = jQuery('select[name ="categoria_acervo"]').children("option:selected").val();
    var palavra = jQuery('select[name ="palavra"]').children("option:selected").val();
    var idioma = jQuery('select[name ="idioma"]').children("option:selected").val();
    var ano = jQuery('select[name ="ano_select"]').children("option:selected").val();
    var setor = jQuery('select[name ="setor"]').children("option:selected").val();
    var autor = jQuery('select[name ="autor"]').children("option:selected").val();

    

    if(busca.length == 0){
        busca = false;
        
    } else if(buscaAv.length == 0) {
        buscaAv = false;
        
    }

    if(busca || buscaAv || categoria || palavra || idioma || ano || setor || autor){    
        jQuery("#empty-field").hide();
    } else {
        jQuery("#empty-field").show();
        jQuery("#simpleform").hide();
	    jQuery("#advancedform").show();
        event.preventDefault();
    }
    
  });
    
});


//remove duplicados da lista de ano de publicação
var code = {};
jQuery("select[id='ano_select'] > option").each(function () {
    if(code[this.text]) {
        jQuery(this).remove();
    } else {
        code[this.text] = this.value;
    }
});
var code2 = {};
jQuery("select[id='ano_select_box'] > option").each(function () {
    if(code2[this.text]) {
        jQuery(this).remove();
    } else {
        code2[this.text] = this.value;
    }
});