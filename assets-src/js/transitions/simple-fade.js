import {TimelineMax, TweenLite} from 'gsap';
var Barba = require('barba.js');

function simpleFade(scope) {
  var $oldPage = scope.oldContainer;
  var $newPage = scope.newContainer;
  var timeline = new TimelineMax();

  function onEnd() {
    window.scrollTo(0, 0);
    timeline.to($newPage, 1, {
      opacity: 1,
    });
    scope.done();
  }

  timeline.set($newPage, {
    opacity: 0,
    visibility: 'visible'
  });

  timeline.to($oldPage, 1, {
    opacity: 0,
    onComplete: onEnd
  });
}

export default Barba.BaseTransition.extend({
 start: function() {
   Promise.all([this.newContainerLoading]).then(this.movePages.bind(this));
 },
 movePages: function() {
   var scope = this;
   simpleFade(scope);
 }
});
