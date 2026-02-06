jQuery(document).ready(function(){

    // Exibe a mensagem se o botao de remover for ativo
    jQuery( ".-cancel" ).click(function() {
        jQuery(".acf-field.hide-message .description").show();
    });

    // Inclui o id no arquivo na url da biblioteca
    var dataId = jQuery("input[data-name='id']").val();
    if(dataId){
        var href = jQuery('.link-archive').attr('href');
        jQuery(".link-archive").attr("href", href + dataId);
    }
    
    // Incluir mensagem no Upload de Arquivos
    jQuery(".uploader-inline-content").prepend( '<div class="alert-info grid-mode"><strong>AVISO!</strong> “Este não é um espaço de edição de documentos. Só se deve subir documentos finalizados e públicos. Aqui não serão mantidas diferentes versões de um mesmo documento, portanto, caso seja necessário, mantenha as versões guardadas em seu computador. Não é permitido subir cópias de livros! Respeite os direitos autorais”.</div>' );

    jQuery("#plupload-upload-ui").prepend( '<div class="alert-info media-new"><strong>AVISO!</strong> “Este não é um espaço de edição de documentos. Só se deve subir documentos finalizados e públicos. Aqui não serão mantidas diferentes versões de um mesmo documento, portanto, caso seja necessário, mantenha as versões guardadas em seu computador. Não é permitido subir cópias de livros! Respeite os direitos autorais”.</div>' );

    // Repetidor Campo 1
    var campo1 = jQuery('input[name="acf[field_5f6af266d9f83][row-0][field_5f6af349d9f84]"]');
    jQuery(campo1).attr('data-default', campo1.val());
    var id1 = campo1.data('default');    

    jQuery('input[name="acf[field_5f6af266d9f83][row-0][field_5f6af349d9f84]"]').bind("change paste keyup", function() {
        var href = jQuery('.link-archive').attr('href').split('?')[0];        
        console.log(href);
        jQuery(".link-archive").attr("href", href + "?item=" + id1);
    });

    // Repetidor Campo 2
    var campo2 = jQuery('input[name="acf[field_5f6af266d9f83][row-1][field_5f6af349d9f84]"]');
    jQuery(campo2).attr('data-default', campo2.val());
    var id2 = campo2.data('default');    

    jQuery('input[name="acf[field_5f6af266d9f83][row-1][field_5f6af349d9f84]"]').bind("change paste keyup", function() {
        var href = jQuery('.link-archive').attr('href').split('?')[0];
        jQuery(".link-archive").attr("href", href + "?item=" + id2);
    });

    // Repetidor Campo 3
    var campo3 = jQuery('input[name="acf[field_5f6af266d9f83][row-2][field_5f6af349d9f84]"]');
    jQuery(campo3).attr('data-default', campo3.val());
    var id3 = campo3.data('default');    

    jQuery('input[name="acf[field_5f6af266d9f83][row-2][field_5f6af349d9f84]"]').bind("change paste keyup", function() {
        var href = jQuery('.link-archive').attr('href').split('?')[0];
        jQuery(".link-archive").attr("href", href + "?item=" + id3);
    });

    // Repetidor Campo 4
    var campo4 = jQuery('input[name="acf[field_5f6af266d9f83][row-3][field_5f6af349d9f84]"]');
    jQuery(campo4).attr('data-default', campo4.val());
    var id4 = campo4.data('default');    

    jQuery('input[name="acf[field_5f6af266d9f83][row-3][field_5f6af349d9f84]"]').bind("change paste keyup", function() {
        var href = jQuery('.link-archive').attr('href').split('?')[0];
        jQuery(".link-archive").attr("href", href + "?item=" + id4);
    });

    // Repetidor Campo 5
    var campo5 = jQuery('input[name="acf[field_5f6af266d9f83][row-4][field_5f6af349d9f84]"]');
    jQuery(campo5).attr('data-default', campo5.val());
    var id5 = campo5.data('default');    

    jQuery('input[name="acf[field_5f6af266d9f83][row-4][field_5f6af349d9f84]"]').bind("change paste keyup", function() {
        var href = jQuery('.link-archive').attr('href').split('?')[0];
        jQuery(".link-archive").attr("href", href + "?item=" + id5);
    });
});