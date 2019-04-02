$(document).ready(function() {
    function setHeight() {
        windowHeight = $(window).innerHeight();
        $('.container-fluid').css('min-height', windowHeight-($('footer').height() + $('nav').height() + 26));
    };
    setHeight();

    $(window).resize(function() {
        setHeight();
    });
});

'use strict';

;( function ( document, window, index )
{
    var inputs = document.querySelectorAll( '.inputfile' );
    Array.prototype.forEach.call( inputs, function( input )
    {
        var label	 = input.nextElementSibling,
        labelVal = label.innerHTML;

        input.addEventListener( 'change', function( e )
        {
            var fileName = '';
            if( this.files && this.files.length > 1 )
                fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
            else
                fileName = e.target.value.split( '\\' ).pop();

            if( fileName )
                label.querySelector( 'span' ).innerHTML = fileName;
            else
                label.innerHTML = labelVal;
        });

        // Firefox bug fix
        input.addEventListener( 'focus', function(){ input.classList.add( 'has-focus' ); });
        input.addEventListener( 'blur', function(){ input.classList.remove( 'has-focus' ); });
    });
}( document, window, 0 ));


function adjustHeightTextArea(el){
    el.style.height = (el.scrollHeight > el.clientHeight) ? (el.scrollHeight)+"px" : "215px";
}

function adjustHeightTextAreaLittle(el){
    el.style.height = (el.scrollHeight > el.clientHeight) ? (el.scrollHeight)+"px" : "100px";
}


$('input').focus(function(){
    $(this).parents('.form-group').addClass('focused');
});

$('input').blur(function(){
    var inputValue = $(this).val();
    if ( inputValue == "" ) {
        $(this).removeClass('filled');
        $(this).parents('.form-group').removeClass('focused');
    } else {
        $(this).addClass('filled');
    }
});

// Page 'Creer un examen'


function ouvrirBox(compteur,nombre) {
    $('#box'+compteur).toggle();
    changerNomBouton(compteur);

    for (var i = 0 ; i < nombre ; i++) {

            if(document.getElementById("parametre"+i).options.length != 0){
                $('#buttonValider').removeAttr("disabled");
                $('#buttonValider').css('opacity', '1');
            }

            if(document.getElementById("liste"+i).options.length != 0){
                $('#buttonValider').removeAttr("disabled");
                $('#buttonValider').css('opacity', '1');
            }

            if(document.getElementById("parametre"+i).options.length == 0 && document.getElementById("liste"+i).options.length == 0) {
              $('#buttonValider').attr('disabled',"disabled");
              $('#buttonValider').css('opacity', '0.2');
            }


        }
}

function changerNomBouton(compteur) {
    var bouton = document.getElementById('btnAjout'+compteur);
    if (bouton.innerHTML != "Mes Valeurs") {
        bouton.innerHTML = "Mes valeurs";
    }
}

$(document).ready(function() {
    if(document.getElementById("box0") != undefined)
        $('.box').toggle();
});



// WARNING: tooltip
$(document).ready(function() {
    $('[data-toggle=tooltip]').tooltip();
});

$(document).ready(function () {

    //init pop-ups
    $(".popup").attr("data-close", false);

    //click on pop-up opener.
    //pop-up is expected to be a child of opener
    $(".more_info").click(function () {
        var $title = $(this).find(".popup");
        //open if not marked for closing
        if ($title.attr("data-close") === "false") {
            $title.show();
        }
        //reset popup
        $title.attr("data-close", false);
    });

    //mark pop-up for closing if clicked on
    //close is initiated by document.mouseup,
    //marker will stop opener from re-opening it
    $(".popup").click(function () {
        $(this).attr("data-close",true);
    });

    //hide all pop-ups
    $(document).mouseup(function () {
        $(".popup").hide();

    });

    //show on rollover if mouse is used
    $(".more_info").mouseenter(function () {
        var $title = $(this).find(".popup");
        $title.show();
    });

    //hide on roll-out
    $(".more_info").mouseleave(function () {
        var $title = $(this).find(".popup");
        $title.hide();
    });

});

function ajouterValeurDeParametre(event,idValeur,idListe,idExposantValeur,idUnite,idExposantUnite) {


    var valeur = document.getElementById(idValeur);
    var exposant = document.getElementById(idExposantValeur);
    var exposantUnite = document.getElementById(idExposantUnite);

    if(valeur.value == "" || exposant.value == "" || exposantUnite.value == ""){
        alert("Une ou plusieurs valeurs sont manquantes ou incorrectes !");
        return false;
    }
    var liste = document.getElementById(idListe);
    var exposantValeur = document.getElementById(idExposantValeur);
    var unite = document.getElementById(idUnite);
    var exposantUnite = document.getElementById(idExposantUnite);


    var option = document.createElement("option");
    option.text = valeur.value+" / "+exposantValeur.value+" / "+unite.value+" / "+exposantUnite.value;


    liste.add(option);
    event.preventDefault();
    valeur.value = null;
    return false;

}

function ajouterValeurDeParametreIntervalle(event,idValeur1,idValeur2,idPas,idListe,idExposantValeur1
    ,idExposantValeur2,idUnite,idExposantUnite) {


    var valeurMinimale = document.getElementById(idValeur1);
    var valeurMaximale = document.getElementById(idValeur2);
    var pas = document.getElementById(idPas)

    if(valeurMinimale.value == "" || valeurMaximale.value == "" || pas.value == ""){
        alert("Une ou plusieurs valeurs sont manquantes ou incorrectes !");
        return false;
    }

    if(valeurMinimale.value * Math.pow(10,document.getElementById(idExposantValeur1).value) >= valeurMaximale.value * Math.pow(10,document.getElementById(idExposantValeur2).value)){
      alert("La valeur maximale de l'intervalle ne peut être inférieur à la valeur minimale !");
      return false;
    }

    var liste = document.getElementById(idListe);
    var exposantValeur1 = document.getElementById(idExposantValeur1);
    var exposantValeur2 = document.getElementById(idExposantValeur2);
    var unite = document.getElementById(idUnite);
    var exposantUnite = document.getElementById(idExposantUnite);


    var option = document.createElement("option");
    option.text = valeurMinimale.value+" / "+exposantValeur1.value+" / "+valeurMaximale.value+" / "+exposantValeur2.value+" / "+pas.value+" / "+unite.value+" / "+exposantUnite.value;

    liste.add(option);
    event.preventDefault();
    valeurMinimale.value = null;
    valeurMaximale.value = null;
    pas.value = null;
    return false;

}

function ajouteEvent(objet, typeEvent, nomFonction, typePropagation){
  if (objet.addEventListener){
    objet.addEventListener(typeEvent, nomFonction, typePropagation);
}
else if (objet.attachEvent)         {
    objet.attachEvent('on'+typeEvent, nomFonction);
}
}

function supprimerSelection() {
  var i = 0;
  while(document.getElementById('bouton'+i) != undefined){
    var bouton = document.getElementById('bouton'+i);
    ajouteEvent (bouton, 'click',supprimerValeur, false);
    i++;
}
}

function supprimerValeur(i) {

    var liste = document.getElementById('parametre'+i);

    if(liste.options.selectedIndex >= 0) {
        var optionIndex = liste.options.selectedIndex;
        liste.options[optionIndex] = null;
    } else {
        i++;
    }
}

function supprimerValeurIntervalle(i) {

    var liste = document.getElementById('liste'+i);

    if(liste.options.selectedIndex >= 0) {
        var optionIndex = liste.options.selectedIndex;
        liste.options[optionIndex] = null;
    } else {
        i++;
    }
}

function affichageSaisieValeurUnique(i){
    document.getElementById('valeursUniques'+i).style.display = "block";
    document.getElementById('boutonUnique'+i).disabled = true ;
    document.getElementById('boutonIntervalle'+i).disabled = true ;
    document.getElementById('boutonUnique'+i).style.backgroundColor = "#ededed";
    document.getElementById('boutonIntervalle'+i).style.backgroundColor = "#ededed" ;
}

function affichageSaisieIntervalle(i){ //a completer
    document.getElementById('intervalle'+i).style.display = "block";
    document.getElementById('boutonUnique'+i).disabled = true ;
    document.getElementById('boutonIntervalle'+i).disabled = true;
    document.getElementById('boutonUnique'+i).style.backgroundColor = "#ededed";
    document.getElementById('boutonIntervalle'+i).style.backgroundColor = "#ededed" ;
}

function annulerSaisie(i){ //a completer
    if(document.getElementById('valeursUniques'+i).style.display == "block"){
        document.getElementById('valeursUniques'+i).style.display = "none";
        document.getElementById('saisieParametre'+i).value=null;
        document.getElementById('puissanceValeur'+i).value=null;
        document.getElementById('exposantValeur'+i).value=null;
        document.getElementById('parametre'+i).options.length = 0;
        document.getElementById('boutonUnique'+i).disabled = false ;
        document.getElementById('boutonIntervalle'+i).disabled = false ;
        document.getElementById('boutonUnique'+i).style.backgroundColor = "#333";
        document.getElementById('boutonIntervalle'+i).style.backgroundColor = "#333" ;
    } else {
        document.getElementById('intervalle'+i).style.display = "none";
        document.getElementById('saisieParametre'+i).value=null;
        document.getElementById('puissanceValeur'+i).value=null;
        document.getElementById('exposantValeur'+i).value=null;
        document.getElementById('liste'+i).options.length = 0;
        document.getElementById('boutonUnique'+i).disabled = false ;
        document.getElementById('boutonIntervalle'+i).disabled = false ;
        document.getElementById('boutonUnique'+i).style.backgroundColor = "#333";
        document.getElementById('boutonIntervalle'+i).style.backgroundColor = "#333" ;
    }

}

//----------------Partie créer un examen

//Gestion des questions

$(document).ready(function() {

  var compteurQuestion = 0;

  $('#buttonValider').attr('disabled',"disabled");
  $('#buttonValider').css('opacity', '0.2');

  $('.add-one').click(function(){
    //Ajout d'une question
    compteurQuestion++;

    //On ajoute le bloc dupliqué
    var blocAjoute = $('.dynamic-element').first().clone().appendTo('.dynamic-stuff').show();

    //On recupère chacun des inputs
    var intituleQuestion = blocAjoute.find("#intituleQuestion");
    var baremeQuestion = blocAjoute.find("#bareme");
    var labelZoneTolerance = blocAjoute.find("#labelZoneTolerance");
    var zoneTolerance = blocAjoute.find("#zoneTolerance");

    //On met à jour chacun des inputs
    intituleQuestion.attr('id', 'intituleQuestion'+compteurQuestion);
    intituleQuestion.attr('name', 'intituleQuestion'+compteurQuestion);
    intituleQuestion.prop('disabled',false);
    intituleQuestion.prop('required',true);

    baremeQuestion.attr('id', 'bareme'+compteurQuestion);
    baremeQuestion.attr('name', 'bareme'+compteurQuestion);
    baremeQuestion.prop('disabled',false);
    baremeQuestion.prop('required',true);

    labelZoneTolerance.attr('id', 'labelZoneTolerance'+compteurQuestion);
    labelZoneTolerance.attr('for', 'zoneTolerance'+compteurQuestion);

    zoneTolerance.attr('id', 'zoneTolerance'+compteurQuestion);
    zoneTolerance.attr('name', 'zoneTolerance'+compteurQuestion);

    //Suppression d'une question
    attach_delete();
});
});

//Attach functionality to delete buttons
function attach_delete(){
  $('.delete').off();

  $('.delete').click(function(){
    $(this).closest('.form-group').remove();
});
};

function recupSelect(compteur){ // rendre modulable via paramètre d'entrée ez puis insere en cookie

for (var i = 0; i <= compteur; i++) {


    var listeUnique = document.getElementById('parametre'+i);
    var listeIntervalle = document.getElementById('liste'+i);

    if(listeUnique != null && listeUnique.options.length > 0 ) {
        var point = new Array();
        for (var j = 0; j < listeUnique.options.length ; j++) {
            point.push(listeUnique.options[j].value);
            var string = "point"+i+"="+point[0];
            for(var k = 1; k < point.length; k++)
                var string = string+","+point[k];

            document.cookie = string;
        }
    } else if(listeIntervalle != null) {

        var point = new Array();
        for (var j = 0; j < listeIntervalle.options.length ; j++) {
            point.push(listeIntervalle.options[j].value);
            var string = "point"+i+"="+point[0];
            for(var k = 1; k < point.length; k++)
                var string = string+","+point[k];

            document.cookie = string;
        }

    }

}
}

function desactiverFormulaire() {

    var ajouter = document.getElementById("chemin");
    var supprimer = document.getElementById("supprimer");

    if(ajouter.value !=undefined){
      if(ajouter.value!="")
      supprimer.disabled=true;
    }
    if(supprimer.options.selectedIndex != 0){
      ajouter.disabled = true;
    }

}
