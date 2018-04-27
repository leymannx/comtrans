(function ($, Drupal) {
  Drupal.behaviors.comTrans = {
    attach: function (context, settings) {
      $('article.comment', context).once('comTrans').each(function () {
        console.log('comment');
      });
    }
  };
})(jQuery, Drupal);