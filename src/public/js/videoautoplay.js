var isLowPowerMode = false;
var detectVideo = document.getElementById('video');

//detectVideo の再生エラーを検出する
var video_promise = detectVideo.play();
