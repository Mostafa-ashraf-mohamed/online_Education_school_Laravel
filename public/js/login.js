const exit = document.querySelector("#exit");
const account = document.querySelector("#account");

/*=======================*/
function closeAlert() {
  setTimeout(function () {
    $(".more-ot-alert").fadeOut("fast");
  }, 100);
}

function openAlert() {
  $(".more-ot-alert").fadeIn("fast");
  // IE8 animation polyfill
  if ($("html").hasClass("lt-ie9")) {
    var speed = 300;
    var times = 3;
    var loop = setInterval(anim, 300);

    function anim() {
      times--;
      if (times === 0) {
        clearInterval(loop);
      }
      $(".more-ot-alert").animate({
        left: 450
      }, speed).animate({
        left: 440
      }, speed);
      //.stop( true, true ).fadeIn();
    };
    anim();
  };
  $(".closeAl").on("click", function () {
    closeAlert()
  });
}
/** notification js */
(function(){

    /*
    * Get all the buttons actions
    */
    let optionBtns = document.querySelectorAll( '.js-option' );

    for(var i = 0; i < optionBtns.length; i++ ) {

      /*
      * When click to a button
      */
      optionBtns[i].addEventListener( 'click', function ( e ){

        var notificationCard = this.parentNode.parentNode;
        var clickBtn = this;
        /*
        * Execute the delete or Archive animation
        */
        requestAnimationFrame( function(){

          archiveOrDelete( clickBtn, notificationCard );

          /*
          * Add transition
          * That smoothly remove the blank space
          * Leaves by the deleted notification card
          */
          window.setTimeout( function( ){
            requestAnimationFrame( function() {
              notificationCard.style.transition = 'all .4s ease';
              notificationCard.style.height = 0;
              notificationCard.style.margin = 0;
              notificationCard.style.padding = 0;
            });

            /*
            * Delete definitely the animation card
            */
            window.setTimeout( function( ){
              notificationCard.parentNode.removeChild( notificationCard );
            }, 1500 );
          }, 1500 );
        });
      })
    }

    /*
    * Function that adds
    * delete or archive class
    * To a notification card
    */
    var archiveOrDelete = function( clickBtn, notificationCard ){
      if( clickBtn.classList.contains( 'archive' ) ){
        notificationCard.classList.add( 'archive' );
      } else if( clickBtn.classList.contains( 'delete' ) ){
        notificationCard.classList.add( 'delete' );
      }
    }

  })()
