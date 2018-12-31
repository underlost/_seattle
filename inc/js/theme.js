var $win = jQuery(window);
var $doc = jQuery(document);
var $grid_elements = jQuery('.fade-item');
var $classes = {
    FsrHolder: 'fsr-holder',
    FsrImage: 'image-full',
};
var $body;

$doc.ready(function () {
  $body = jQuery('body');
  fullscreener(jQuery('.' + $classes.FsrImage));
  check_if_in_view();
  $('.fsr-lazy').Lazy();
});

function fullscreener(_container) {
  _container.each(function () {
      var _this = jQuery(this);
      //debugger;
      var _src = _this.attr('src');
      var _srcset = _this.attr('srcset');
      if (_srcset != null)
      {
          var screenWidth = $win.width();
          var src_arr = _parse_srcset(_srcset);
          for (var i in src_arr)
          {
              if (src_arr[i].width >= screenWidth)
              {
                  _src = src_arr[i].url;
                  break;
              }
          }
      }
      _this.parent().addClass($classes.FsrHolder).attr('style', 'background-image: url(' + _src + ');');
  });
}

function _parse_srcset(str) {
  var arr = str.split(', ');
  var srcset = new Array();
  for (var i in arr)
  {
      var tokens = arr[i].split(' ');
      var url = tokens[0];
      var w = tokens[1].replace('w', '');
      srcset.push({url: url, width: w});
  }

  srcset.sort(function (a, b) {
      return parseFloat(a.w) - parseFloat(b.w);
  });
  return srcset;
}

function check_if_in_view(){
  var window_height = $win.height();
  var window_top_position = $win.scrollTop();
  var window_bottom_position = (window_top_position + window_height);

  jQuery.each($grid_elements, function() {
      var $element = jQuery(this);
      var element_height = $element.outerHeight();
      var element_top_position = $element.offset().top;
      var element_bottom_position = (element_top_position + element_height);

      //check to see if this current container is within viewport
      if ((element_bottom_position >= window_top_position) &&
          (element_top_position <= window_bottom_position)) {
          $element.addClass('in-view');
      } else {
          $element.removeClass('in-view');
      }
  });
}
