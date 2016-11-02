(function ($, Drupal) {
  Drupal.behaviors.bulletinBoard = {
    attach: function (context, settings) {
    var date = $.now();
    $.cookie("bulletin-board", date);
    }
  };
})(jQuery, Drupal);