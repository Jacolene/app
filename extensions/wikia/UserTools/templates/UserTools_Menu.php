<?php foreach ($items as $item):
	switch ($item['type']):
	case 'follow': ?>
<li class="overflow">
	<a accesskey="w" id="<?= Sanitizer::encodeAttribute( $item['link-id'] ); ?>" href="<?= Sanitizer::encodeAttribute( $item['href'] ); ?>" data-name="<?= Sanitizer::encodeAttribute( $item['tracker-name'] ); ?>"><?= htmlspecialchars( $item['caption'] ); ?></a>
</li>
<?php break; ?>
<?php case 'menu': ?>
<li class="mytools menu">
	<span class="arrow-icon-ctr"><span class="arrow-icon arrow-icon-single"></span></span>
	<a href="#"><?= htmlspecialchars( $item['caption'] ); ?></a>
	<ul id="my-tools-menu" class="tools-menu">
		<?= F::app()->renderView( 'UserTools', 'Menu', [ 'format' => 'html', 'type' => 'submenu', 'items' => $item['items'] ] ); ?>
	</ul>
</li>
<?php break; ?>
<?php case 'link': ?>
<li class="overflow">
	<a href="<?= Sanitizer::encodeAttribute( $item['href'] ); ?>" data-name="<?= Sanitizer::encodeAttribute( $item['tracker-name'] ); ?>"><?= htmlspecialchars( $item['caption'] ); ?></a>
</li>
<?php break; ?>
<?php case 'html': ?>
<li>
	<?= $item['html']; ?>
</li>
<?php break; ?>
<?php case 'customize': ?>
<li>
	<img height="16" width="16" class="sprite gear" src="<?= $wg->BlankImgUrl; ?>">
	<a class="tools-customize" href="#" data-name="customize"><?= wfMessage( 'user-tools-customize' )->escaped(); ?></a>
</li>
<?php break; ?>
<?php case 'disabled': ?>
<li class="overflow">
	<span title="<?= Sanitizer::encodeAttribute( $item['error-message'] ); ?>"><?= htmlspecialchars( $item['caption'] ); ?></span>
</li>
<?php break; ?>
<?php endswitch; ?>
<?php endforeach; ?>
