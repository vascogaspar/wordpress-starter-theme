// Replace URL Port in Development environment
import devEnv from 'utils/dev-env';

// dependencies
import Barba from 'barba.js';
import {TweenLite, TimelineMax} from 'gsap';

import SimpleFade from 'transitions/simple-fade';

$(function() {
  devEnv();

  // Greetings
  setTimeout(console.log.bind(console, "%cThis website was designed and developed with ❤️ by " + '%chttps://apelido-apelido.com', 'font-family: arial; color: #000; font-weight: normal; font-size: 18px', 'font-family: arial; background: #1100FF; color: #fff; font-size: 18px'), 0);

  // Keep track of last element clicked to decide which animation to trigger
  var lastClickedEl;
  Barba.Dispatcher.on('linkClicked', function(element, event) {
    lastClickedEl = element;
  });

  Barba.Dispatcher.on('newPageReady', function(element, event) {
    devEnv();
  });

  Barba.Pjax.getTransition = function() {
    /*** Usage: ***/

    // if ($(lastClickedEl).hasClass('some-class')) {
    //   return SomeTransition;
    // }

    /*** OR ***/

    // if (Barba.HistoryManager.currentStatus().url === some-url) {
    //   return SomeTransition;
    // }

    return SimpleFade;
  };

  // Barba Views
  // var SomeView = Barba.BaseView.extend({
  //   /* Name of the template file */
  //   namespace: 'someview.php',
  //   onEnterCompleted: function() {
  //     var items = $('.some-items');
  //     var timeline = new TimelineMax();
  //     timeline.staggerTo(items, 0.2, {opacity: 1}, 0.10);
  //   }
  // });

  // SomeView.init()

  Barba.Pjax.start();
  Barba.Prefetch.init();
});
