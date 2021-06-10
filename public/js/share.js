$(document).ready(function (){

	$('.btn_action_wtspp').click(function(event) {
      let op = $(this).data('option');
      let text = op == 0 ? message_whatsapp : '';
      let number = op == 0 ? whatsapp : '';
      event.preventDefault();
      if (navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i)) {
           // Para enviar whatsapp mobile
           if (number == '') {
              var LinkTextToShareMobile = 'https://api.whatsapp.com/send?text=' + text;
           }else{
              var LinkTextToShareMobile = 'https://api.whatsapp.com/send?phone=+' + number + '&text=' + text;
           }
           window.open(LinkTextToShareMobile, "_blank");
      } else {
          //Enviar en móvil
          if (number == '') {
              var LinkTextToShare = 'https://web.whatsapp.com/send?l=es&text=' + text;
           }else{
              var LinkTextToShare = 'https://web.whatsapp.com/send?l=es&phone=+'+number+'&text=' + text;
           }
           window.open(LinkTextToShare, "_blank");           
      }
  });
	$('.btn_share_facebook').click(function(event) {
        let urlShare = $(this).data('url');
        event.preventDefault();
        var urlFacebook = 'http://www.facebook.com/share.php?u='+urlShare;
        window.open(urlFacebook, "Papyser","status = 1, height = 500, width = 500, resizable = 0");
  });

  $('.btn_share_linkedin').click(function(event) {
        let urlShare = $(this).data('url');
        event.preventDefault();
        var urlLinkedin = 'https://www.linkedin.com/shareArticle?url='+urlShare;
  			window.open(urlLinkedin, "Papyser","status = 1, height = 500, width = 500, resizable = 0");

  });

    $(".btn_share_twitter").click(function(event) {
        let urlShare = $(this).data('url');
        var urlTwitter = 'http://twitter.com/intent/tweet?status=Papyser - '+ urlShare;
        window.open(urlTwitter, "Papyser","status = 1, height = 500, width = 500, resizable = 0");
  	});


	$('.btn_share_whatsapp').click(function(event) {
	    let urlShare = $(this).data('url');
	    event.preventDefault();
	    if (navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i)) {
	        // Para enviar whatsapp mobile
	        var LinkTextToShareMobile = 'https://api.whatsapp.com/send?text=' + encodeURIComponent(urlShare);
	        window.open(LinkTextToShareMobile, "_blank");
	    } else {
	        // Para enviar whatsapp web
	        var LinkTextToShare = 'https://web.whatsapp.com/send?l=en&text=' + encodeURIComponent(urlShare);
	        window.open(LinkTextToShare, "_blank");
	  }
	});
});