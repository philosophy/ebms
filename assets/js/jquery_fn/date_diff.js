(function($) {
  $.date_diff = function(timestamp, format, otherDate) {
    format = (format) ? format : 'year';

    if ((timestamp instanceof Date) && (otherDate instanceof Date)) {
      return computeDiff(timestamp, format, otherDate);
    } else if (typeof timestamp === "string" && typeof otherDate === 'string') {
      return computeDiff($.date_diff.parse(timestamp), format, $.date_diff.parse(otherDate));
    }
  };
  var $t = $.date_diff;

  $.extend($.date_diff, {
    computeDiff: function(distanceMillis, format, otherDate) {
      var seconds = distanceMillis / 1000;
      var minutes = seconds / 60;
      var hours = minutes / 60;
      var days = hours / 24;
      var years = days / 364;

      var r;
      switch(format) {
        case 'second':
          r = seconds;
        break;
        case 'minute':
          r = minutes;
        break;
        case 'hour':
          r = hours;
        break;
        case 'day':
          r = days;
        break;
        default:
          r = years;
        break;
      }

      return Math.floor(r);
    },
    parse: function(iso8601) {
      var s = $.trim(iso8601);
      s = s.replace(/\.\d\d\d+/, ""); // remove milliseconds
      s = s.replace(/-/, "/").replace(/-/, "/");
      s = s.replace(/T/, " ").replace(/Z/, " UTC");
      s = s.replace(/([\+\-]\d\d)\:?(\d\d)/, " $1$2"); // -04:00 -> -0400
      return new Date(s);
    }
  });

  function computeDiff(date, format, otherDate) {
    return $t.computeDiff(distance(date, otherDate), format);
  }

  function distance(date, otherDate) {
    return (date.getTime() - otherDate);
  }
}(jQuery));