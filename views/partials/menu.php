<?php
if ( empty($menu) ) {
	return;
}
?>
<!-- Navigation -->
<ul class="navbar-nav">
	<?php
	$request = Flight::request();
	foreach ($menu as $data) {
	?>
	<li class="nav-item <?php echo get_url( $request->url ) == $data['url'] ? 'active' : ''; ?> ">
		<a class="nav-link " href="<?php echo $data['url']; ?>">
			<i class="<?php echo @$data['icon']; ?> text-primary"></i> <?php echo $data['text']; ?>
		</a>
	</li>
	<?php
	} ?>
</ul>