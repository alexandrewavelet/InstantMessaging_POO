<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script type="text/javascript">
  $(function() {
    var buttonInscription = $('.inscription');
    var btnFormInscr = $('.btnInscr');
    var buttonConnexion = $('.connexion');
    var btnFormConn = $('.btnConn');
    var formulaire = $('.formHome');
    buttonInscription.on('click', function(){
      if (formulaire.hasClass('ins')) {
        formulaire.toggleClass('formulaire');
        formulaire.toggleClass('formulaire_visible');
        btnFormInscr.toggleClass('invisible');
        btnFormInscr.toggleClass('visible');
        formulaire.toggleClass('ins');
      }
      else if (formulaire.hasClass('con')) {
        btnFormInscr.toggleClass('invisible');
        btnFormInscr.toggleClass('visible');
        btnFormConn.toggleClass('invisible');
        btnFormConn.toggleClass('visible');
        formulaire.toggleClass('con');
        formulaire.toggleClass('ins');
      }
      else{
        formulaire.toggleClass('formulaire');
        formulaire.toggleClass('formulaire_visible');
        btnFormInscr.toggleClass('invisible');
        btnFormInscr.toggleClass('visible');
        formulaire.toggleClass('ins');
      }
    });
    buttonConnexion.on('click', function(){
      if (formulaire.hasClass('ins')) {
        btnFormInscr.toggleClass('invisible');
        btnFormInscr.toggleClass('visible');
        btnFormConn.toggleClass('invisible');
        btnFormConn.toggleClass('visible');
        formulaire.toggleClass('con');
        formulaire.toggleClass('ins');
      }
      else if (formulaire.hasClass('con')) {
        formulaire.toggleClass('formulaire');
        formulaire.toggleClass('formulaire_visible');
        btnFormInscr.toggleClass('invisible');
        btnFormInscr.toggleClass('visible');
        formulaire.toggleClass('con');
      }
      else{
        formulaire.toggleClass('formulaire');
        formulaire.toggleClass('formulaire_visible');
        btnFormInscr.toggleClass('invisible');
        btnFormInscr.toggleClass('visible');
        formulaire.toggleClass('con');
      }
    });
  });
</script>