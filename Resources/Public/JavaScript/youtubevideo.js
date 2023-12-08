youTubeApiIsLoaded = 0;
gdprAgreedOnce = 0;

// Read consent status from localStorage
function getConsentStatus() {
  return localStorage.getItem('youtubevideo-consent');
}

// Cancel without playing the video
function gdprCancel() {
  var el = (event.target || event.srcElement);
  dataYtUid = 0;
  dataYtUid = el.getAttribute('data-yt-uid');
  document.getElementById('gdpr-' + dataYtUid).style.display = 'none';
}

// Agree and remember by setting localStorage
function gdprAgree() {
  localStorage.setItem('youtubevideo-consent', '1');
  var el = (event.target || event.srcElement);
  dataYtUid = 0;
  dataYtUid = el.getAttribute('data-yt-uid');
  document.getElementById('gdpr-' + dataYtUid).style.display = 'none';
  document.getElementById('coverimage-' + dataYtUid).click();
}

// Agree once but ask again next time
function gdprAgreeOnce() {
  var el = (event.target || event.srcElement);
  dataYtUid = 0;
  dataYtUid = el.getAttribute('data-yt-uid');
  gdprAgreedOnce = dataYtUid;
  document.getElementById('gdpr-' + dataYtUid).style.display = 'none';
  document.getElementById('coverimage-' + dataYtUid).click();
}

// What happens on clicking the cover image
function coverimageClick(event) {
  if (!event) {
    event = window.event;
  }
  var el = (event.target || event.srcElement);
  playerId = 0;
  playerId = el.getAttribute('data-yt-id');
  dataYtCode = 0;
  dataYtCode = el.getAttribute('data-yt-code');
  dataYtVars = 0;
  dataYtVars = JSON.parse('{' + el.getAttribute('data-yt-vars').replace(/,\s*$/, "") + '}');
  dataYtHost = 0;
  dataYtHost = el.getAttribute('data-yt-host');
  dataYtUid = 0;
  dataYtUid = el.getAttribute('data-yt-uid');

  if (getConsentStatus() || (gdprAgreedOnce == dataYtUid) || disableGdpr) {
    if (youTubeApiIsLoaded) {
      loadPlayer();
    } else {
      loadYouTubeApi();
    }
    el.classList.add('play');
  } else {
    document.getElementById('gdpr-' + dataYtUid).style.display = 'block';
  }
}

// Load YouTube API
function loadYouTubeApi() {
  var tag = document.createElement('script');
  tag.src = "https://www.youtube.com/iframe_api";
  var firstScriptTag = document.getElementsByTagName('script')[0];
  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
  youTubeApiIsLoaded = 1;
}

// Load YouTube player with video settings
function loadPlayer() {
  player = new YT.Player(playerId, {
    height: '390',
    width: '640',
    videoId: dataYtCode,
    host: dataYtHost,
    playerVars: dataYtVars,
    events: {
      'onReady': onPlayerReady,
      'onStateChange': onPlayerStateChange
    }
  });
}

function onYouTubeIframeAPIReady() {
  loadPlayer();
}

function onPlayerReady(event) {
  player.setPlaybackRate(1);
  player.playVideo();
}

function onPlayerStateChange(event) {}

function stopVideo() {
  player.stopVideo();
}



// Set video window breakpoint classes for 'small' and 'tiny'
function youtubevideoDetectWidth(a) {
  var container = document.getElementsByClassName(a);
  for (var i = 0; i < container.length; ++i) {
    var item = container[i];
    var width = container[i].clientWidth;
    if (width < containerBreakpointSmall) {
      item.classList.add('small');
    } else {
      item.classList.remove('small');
    }
    if (width < containerBreakpointTiny) {
      item.classList.add('tiny');
    } else {
      item.classList.remove('tiny');
    }
  }
}

youtubevideoDetectWidth('youtubevideo');
window.addEventListener("resize", function() {
  youtubevideoDetectWidth('youtubevideo');
});
