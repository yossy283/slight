var isLowPowerMode = false;
var detectVideo = document.getElementById('video');

//detectVideo の再生エラーを検出する
var video_promise = detectVideo.play();
video_promise.catch(function(error){
  isLowPowerMode = true;

  //演出目的の大きい動画のautoplay属性を外し、不要なリクエストを発生させない
  //detectVideo.removeAttribute("autoplay"); 
});