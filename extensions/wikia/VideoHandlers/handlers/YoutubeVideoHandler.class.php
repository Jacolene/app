<?php

class YoutubeVideoHandler extends VideoHandler {
	
	protected $apiName = 'YoutubeApiWrapper';
	protected static $aspectRatio = 1.7777778;
	protected static $urlTemplate = 'http://www.youtube.com/watch?v=';
	protected static $providerDetailUrlTemplate = 'http://www.youtube.com/watch?v=$1';
	protected static $providerHomeUrl = 'http://www.youtube.com/';
	
	public function getPlayerAssetUrl() {
		return JWPlayer::getJavascriptPlayerUrl();
	}
	
	public function getEmbed($articleId, $width, $autoplay=false, $isAjax=false, $postOnload=false) {
		$height =  $this->getHeight( $width );
		return JWPlayer::getEmbedCode($articleId, $this->getVideoId(), self::$urlTemplate.$this->getVideoId(), $this->getTitle(), $width, $height, false, $this->getDuration(), $this->isHd(), null, null, null, $autoplay, $isAjax, $postOnload);
	}
		
	private function getEmbedNative($width, $autoplay=false) {
		// YouTube parameters: http://code.google.com/apis/youtube/player_parameters.html
		$params = array('rel'=>0);
		if ($autoplay) $params['autoplay'] = 1;		
		$qs = http_build_query($params);
		
		$code = <<<EOT
<iframe width="$width" height="$height" src="http://www.youtube.com/embed/{$this->videoId}?$qs" frameborder="0" allowfullscreen></iframe>
EOT;
		
		return $code;
	}	
}
