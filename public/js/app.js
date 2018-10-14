$(function() {


  var loggedInUser = '';
  var path = window.location.pathname;
  var showId = path.substring(path.lastIndexOf('/') + 1);


  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  // start listening to channels (backend events) and handle them accordingly
  function prepareEcho()
  {
    window.Echo = new Echo({
      broadcaster : 'pusher',
      key: '7703f827b85416632c52',
      cluster : 'eu',
      encrypted : true
    });
  
    if(typeof(showId) !== undefined) 
    {
      Echo.channel('show.' + showId)
          .listen('NewComment', function(comment) {
            var html = '<div class="comment"><h4>' + comment.author + '</h4><p>' +comment.body + '</p><p class="date">on ' + comment.date + '</p></div>';

            if($('#comments .comment').length != 0)
            {
              $('#comments .comment').prepend(html).hide().fadeIn(500);
            }
            else
            {
              $('#comments').append(html).hide().fadeIn(500);
            }
      });
    }
  }


 function prepareLayout()
  {
    var main = $('#ui main');

    if($(window).outerWidth() >= 768)
    {
      var navWidth =  $('#ui nav').outerWidth();
      var mainWidth = $(window).outerWidth() - navWidth;

      main.offset({top: 0, left: navWidth});
      main.css({width: mainWidth, 'max-width': mainWidth});
    }
    else {
      main.removeAttr('style');
    }
  };


  function enableDropdownMenu()
  {
    // animate the sidebar 
    $('nav > ul li').click(function() {
      $(this).children('.submenu').slideToggle();

      $(this).toggleClass('active');
    });
  }

  function enableResponsiveMenu()
  {
    $('#menu-btn').on('click', function() {
      $('#ui nav').addClass('open');
    });
  
    $('#close-btn').on('click',function() {
      $('#ui nav').removeClass('open');
    });
  }

  function changeActiveSeason()
  {
    // change which tv show season is being viewed (is 'active')
    $('#seasons a').click(function() {
      $(this).parents('ul').find('.active').removeClass('active');
      $(this).parent().addClass('active');
    })
  }

  function resizeIframes()
  {
    var windowWidth = $(window).outerWidth();

    switch(true)
    {
      case (windowWidth < 850):
        var containerWidth = $('.video > div').outerWidth();
        $('iframe').width(containerWidth - 30);
        $('iframe').height('210');
        break;
      case (windowWidth < 992):
        $('iframe').width('560');
        $('iframe').height('320');
        break;
      case (windowWidth < 1200):
        $('iframe').width('330');
        $('iframe').height('210');
        break;
      default:
        $('iframe').removeAttr('style');
    };
    // }
  };


  function loadMoreVideos(e) {
    e.preventDefault();
    var target = $(e.target);
    
    var id = target.data('id');
    var page = target.data('pg') || '';
    var season = target.data('season') || '';

    $.ajax({
      method: 'get',
      url: '/shows/' + id + '/seasons/' + season,
      data: {page: page},
      success: function(res)
      {
        $('#videos').html(res);
      }
    })
  };


  function postComment()
  {
  
    $('#comments button').click(function(e) {
      e.preventDefault();
      var form = $(this).parent('form');

      $.ajax({
        url: '/comments',
        method: 'POST',
        data: form.serialize(),
        success: function(res)
        {
        }
      })
    });
  }

  // load more tv shows from the season that is currently being viewed
  $('#season #seasons li a').click(function(e) {
    loadMoreVideos(e);
  });

  $('body').on('click', '#load-more-btn', function(e) {
    loadMoreVideos(e)
  });


  prepareEcho();
  enableDropdownMenu();
  enableResponsiveMenu();
  prepareLayout();
  changeActiveSeason();
  resizeIframes();
  postComment();


  $(window).on('resize', function() {
    prepareLayout();
    enableResponsiveMenu();
    resizeIframes();
  });

})

